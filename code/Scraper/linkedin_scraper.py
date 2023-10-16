import helper
import requests
from bs4 import BeautifulSoup
import traceback
import re


def get_jobs(role, location, no_of_jobs_to_retrieve, all_skills):
    url = "https://www.linkedin.com/jobs/jobs-in-" + location + "?keywords=" + role
    url = url.replace(' ', '%20')
    k1 = requests.get(url)
    # print(type(k1))
    print(k1.status_code)
    if k1.status_code != 200:
        print(url)
        print("Connection Failed")
    soup1 = BeautifulSoup(k1.content, 'html.parser')
    print("----------------------------------------------------")
    print("Step 1 - Soup1 :\n ")
    d = str((soup1).encode('utf-8'))
    file1 = open("myscrpper.txt","w")
    if file1.write(d):
        print("Data written into file successfully!!!")
    file1.close()
    string1 = soup1.find_all("a", {"class": "base-card__full-link"})
    jobs = []
    job_role = []
    job_details = {}
    print("----------------------------------------------------")
    print("Step 2 : base-card__full-link \n")
    try:
        for i in range(len(string1)):
            if no_of_jobs_to_retrieve > 0:
                job = {}
                print("In the scrpper function foe vaue i in base card : ",string1[i])
                job["title"] = string1[i].get_text().replace('\n', ' ').replace(' ', '')
                job["url"] = string1[i]['href']
                job_details[job["url"]] = [job["title"], ""]
                job_role.append(string1[i].get_text().replace('\n', ' ').replace(' ', ''))
                str4 = soup1.find_all("a", {"class": "hidden-nested-link"})
                comp_name = str4[i].get_text().replace('\n', ' ').replace(' ', '')
                print("Company_Name: ", comp_name)
                job['company_name'] = comp_name
                str5 = soup1.find_all("time",{"class":"job-search-card__listdate"})
                job_posted_date = str5[i]["datetime"]
                print("job_posted_date", job_posted_date)
                job["job_posted_date"] = job_posted_date
                days_after_posting = str5[i].get_text().replace('\n', ' ')
                print("days_after_posting : ",days_after_posting)
                job["days_after_posting"] = days_after_posting
                no_of_jobs_to_retrieve -= 1
                k = requests.get(string1[i]['href']).text
                #print("Printing k:", k)
                soup = BeautifulSoup(k, 'html.parser')
                str2 = soup.find_all("div", {"class": "description__text"})
                # print("String2 : description__text \n",str2)
                skills = []
                if len(str2) > 0:
                    str3 = str2[0].get_text()
                    #print("string 3 :\n")
                    skills = helper.extract_skills(str3, all_skills)
                job["skills"] = skills
                jobs.append(job)
        
    except Exception:
        traceback.print_exc()
    return jobs