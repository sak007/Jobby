# About Jobby's main.py File
This file contains code for the main.py file in Jobby. This file runs all scrapers and handles the main processing in the back end.

# Location of Code for this Feature
The code that implements this feature can be found [here](https://github.com/sak007/Jobby/blob/main/code/Scraper/main.py)

# Code Description
## Functions

1. run()
The main file that takes care of most tasks in main.py
It gets a connection using helper.db_connect(), then gets notification information, user information and job boards information for users using other functions in the same class. It gets all skills using helper.all_skills, generates jobs for each user, maps skills and sends email alerts using other functions in this module.

2. def generate_user_info(data):
Takes one argument data, which is a list containing user information. It creates a mapping of user email to other data of the user, and then returns it.

3. def generate_user_job_board_list(data):
Takes one argument data, which is a list containing user information. It creates a mapping of user email to the selected job boards of the user, and then returns it.

4. def generate_user_jobs_mp(user_info, user_job_board_list, job_map):
Takes 3 arguments - user_info, which is user information, user_job_board_list which is a list of the job boards the user has chosen and job_map. Returns a mapping of users to all jobs found according to their chosen job boards.

5. def generate_job_map(job_board_role_mp, all_skills):
This function generates a map of job board and map of pair of role and location
and jobs with that role and Location
example:
    {'LINKEDIN' : {
        ('Software Developer Intern', 'Raleigh'): [{
            'title': ..,
            'url':..,
            'skills':..
            }]
        }
    }

6. def generate_job_board_role_mp(user_job_board_list, user_info):
This function generates a map of job boards and list of pair of job role and location.
example:
  {'LINKEDIN': [('Software Developer Intern', 'Raleigh')]}

7. def send_mail(user_jobs, user_info, user_skills):
This function takes the user's selected jobs, their information like email address and their skills and then uses the python MIME SMTP libraries to send them an email alerts with the jobs that match their skills.

8. def get_user_notification_info(connection):
Takes 1 argument - connection object to the database and gets all users' details including email address, which are returned as a cursor.

9. def get_count_per_dashboard(job_map):
Takes job_map as argument and generates the number of jobs per dashboard.


# How to run this feature?
This file is run when the user selects the indeed scraper in web app. The file is run to scrape jobs based on the user location, and then it matches the job skills with the user's skills and returns the matching skills for each job position. 
