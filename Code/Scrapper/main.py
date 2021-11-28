import mysql.connector
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from socket import gaierror
import smtplib
import json
import linkedin_scraper
import indeed_scraper
import monster_scraper
import scrapper_goingglobal
import helper
import time

def run():
    properties = open('parameters.json')
    data = json.load(properties)
    connection = db_connect(properties)
    all_skills = get_all_skills(connection)
    resume_skills = get_resume_skills(connection)
    email_id_list = get_emailing_list(connection)
    data = get_user_notification_info(connection)
    user_info = generate_user_info(data)
    user_job_board_list = generate_user_job_board_list(data)
    # print(user_info)
    # print(user_job_board_list)
    job_board_role_mp = generate_job_board_role_mp(user_job_board_list, user_info)

    all_skills = helper.get_all_skills()
    job_map = generate_job_map(job_board_role_mp, all_skills)

    user_jobs = generate_user_jobs_mp(user_info, user_job_board_list, job_map)
    send_mail(user_jobs, user_info)

def generate_user_info(data):
    user_info = {}
    for d in data:
        user_info[d[0]] = (d[3], d[2], d[1])
    return user_info

def generate_user_job_board_list(data):
    list = []
    for d in data:
        list.append((d[0], d[4]))
    return list

def generate_user_jobs_mp(user_info, user_job_board_list, job_map):
    user_jobs = {}
    for uj in user_job_board_list:
        user = uj[0]
        if user not in user_jobs:
            user_jobs[user] = []
        user_job_req = (user_info[user][0], user_info[user][1])
        jobs = job_map[uj[1]][user_job_req]
        user_jobs[user].extend(jobs)
    return user_jobs

# This function generates a map of job board and map of pair of role and location
# and jobs with that role and Location
# example:
#     {'LINKEDIN' : {
#         ('Software Developer Intern', 'Raleigh'): [{
#             'title': ..,
#             'url':..,
#             'skills':..
#             }]
#         }
#     }
def generate_job_map(job_board_role_mp, all_skills):
    job_map = {}
    for jb in job_board_role_mp.keys():
        job_map[jb] = {}
        for rl in job_board_role_mp[jb]:
            time.sleep(30)
            j = []
            if (jb == 'LINKEDIN'):
                j = linkedin_scraper.get_jobs(rl[0],rl[1],10, all_skills)
            elif (jb == 'INDEED'):
                j = indeed_scraper.get_jobs(rl[0],rl[1],10, all_skills)
            elif (jb == 'MONSTER'):
                j = monster_scraper.get_jobs(rl[0],rl[1],10, all_skills)
            elif (jb == 'GOINGLOBAL'):
                j = scrapper_goingglobal.get_jobs(rl[0],rl[1],10, all_skills)
            job_map[jb][rl] = j
    return job_map


# This function generates a map of job boards and list of pair of job role and location.
# example:
#   {'LINKEDIN': [('Software Developer Intern', 'Raleigh')]}
def generate_job_board_role_mp(user_job_board_list, user_info):
    job_board_role_mp = {}
    for uj in user_job_board_list:
        if uj[1] not in job_board_role_mp:
            job_board_role_mp[uj[1]] = []
        u_info = user_info[uj[0]]
        job_board_role_mp[uj[1]].append((u_info[0], u_info[1]))
    return job_board_role_mp

def send_mail(user_jobs, user_info):
    port = 587
    smtp_server = "smtp.gmail.com"
    login = "srijas.alerts@gmail.com"
    password = "SRIJASGMAILPWD"
    sender = "srijas.alerts@gmail.com"
    for user in user_info.keys():
         receiver = user
         jobs = user_jobs[user]
         if len(jobs) == 0:
             continue
         msg = MIMEMultipart()
         msg['From'] = sender
         msg['To'] = receiver
         msg['Subject'] = 'SRIJAS - Job List'

         body = """\n Hi """+ user_info[user][2] +""",\n Good News !! \n We have found """+str(len(jobs)) +""" job that match your resume \n"""
         msg.attach(MIMEText(body, 'plain'))

         temp_body =""
         html_start = """<html><head></head><body><p><ol>"""
         for job in jobs:
             temp_body +="<li>"+ job['title'] + "<a href=\""+ job['url'] + "\"> Click to Apply </a>"
         html_end= """</ol></p></body> </html>"""

         html= html_start + temp_body + html_end

         msg.attach( MIMEText(html, 'html'))

         msg.attach(MIMEText("\n\n Regards, \nTeam SRIJAS", 'plain'))
         text = msg.as_string()

         try:
              server = smtplib.SMTP(smtp_server, port)
              server.connect(smtp_server,port)
              server.ehlo()
              server.starttls()
              server.ehlo()
              print(login,password)
              server.login(login, password)
              server.sendmail(sender, receiver, text)
              server.quit()                                                                                # tell the script to report if your message was sent or which errors need to be fixed
              print('Sent')
         except (gaierror, ConnectionRefusedError):
              print('Failed to connect to the server. Bad connection settings?')
         except smtplib.SMTPServerDisconnected as e:
              print('Failed to connect to the server. Wrong user/password?')
              print(str(e))
         except smtplib.SMTPException as e:
              print('SMTP error occurred: ' + str(e))


def db_connect(properties):
    properties = open('parameters.json')
    data = json.load(properties)
    server_name = data['server_name']
    user_name = data['user_name']
    password = data['password']
    db_name = data['db_name']
    connection = mysql.connector.connect(host=server_name, database=db_name, user=user_name, password=password)
    return connection

def clean_data(connection):
    cursor = connection.cursor()
    offsafety = "SET SQL_SAFE_UPDATES = 0"
    query1 = "delete from user_resume"
    query2 = "delete from resume_skills"
    query3 = "delete from resume_master"
    query4 = "delete from user_master"
    onsafety = "SET SQL_SAFE_UPDATES = 1"
    cursor.execute(offsafety)
    cursor.execute(query1)
    cursor.execute(query2)
    cursor.execute(query3)
    cursor.execute(query4)
    cursor.execute(onsafety)
    connection.commit()
    pass


def get_all_skills(connection):
    sql_select_Query = "select DISTINCT skill_id,skill_title from skill_master"
    cursor=connection.cursor()
    cursor.execute(sql_select_Query)
    records=cursor.fetchall()
    all_skills={}
    for row in records:
        all_skills[row[0]]=row[1]
    return all_skills


def get_resume_skills(connection):
    sql_select_Query2="select  resume_id,skill_id from resume_skills"
    cursor=connection.cursor()
    cursor.execute(sql_select_Query2)
    records2=cursor.fetchall()
    resume_skills={}
    for row in records2:
        if(row[0]) in resume_skills:
            resume_skills[row[0]].append(row[1])
        else:
            resume_skills[row[0]]=[row[1]]
    return resume_skills


def get_emailing_list(connection):
    email_id_list={}
    sql_select_Query3="SELECT resume_id,user_email,user_fname from user_master um join user_resume ur on um.user_id=ur.user_id"
    cursor=connection.cursor()
    cursor.execute(sql_select_Query3)
    records_email=cursor.fetchall()
    for row in records_email:
        email_id_list[row[0]]=[row[1],row[2]]
    return email_id_list

def get_user_notification_info(connection):
    query = "SELECT um.user_email, um.user_fname, um.location, jm.job_title, jb.name from user_master um, job_board jb, job_master jm, user_notification un where um.user_preferred_job_id = jm.job_id and um.user_id = un.user_id and un.job_board_id = jb.job_board_id"
    cursor=connection.cursor()
    cursor.execute(query)
    return cursor.fetchall()


if __name__ =='__main__':
    run()
