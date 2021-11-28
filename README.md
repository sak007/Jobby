![SRIJAS_LOGO](https://user-images.githubusercontent.com/40118578/135184051-73acf9be-07c1-4c98-9730-68fa161f6a1b.png)



[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![Github](https://img.shields.io/badge/language-python-red.svg)
[![GitHub issues](https://img.shields.io/github/issues/sak007/SRIJAS)](https://github.com/sak007/SRIJAS/issues?q=is%3Aopen+is%3Aissue)
[![GitHub closed issues](https://img.shields.io/github/issues-closed/sak007/SRIJAS)](https://github.com/sak007/SRIJAS/issues?q=is%3Aissue+is%3Aclosed)
[![Github pull requests](https://img.shields.io/github/issues-pr/sak007/SRIJAS)](https://github.com/sak007/SRIJAS/pulls)
[![Github closed pull requests](https://img.shields.io/github/issues-pr-closed/sak007/SRIJAS)](https://github.com/sak007/SRIJAS/pulls?q=is%3Apr+is%3Aclosed)
[![DOI](https://zenodo.org/badge/DOI/10.5281/zenodo.5646667.svg)](https://doi.org/10.5281/zenodo.5646667)
[![Build Status](https://circleci.com/gh/sak007/SRIJAS/tree/main.svg?style=svg)](https://circleci.com/gh/sak007/SRIJAS/tree/main)
[![codecov](https://codecov.io/gh/sak007/SRIJAS/branch/main/graph/badge.svg?token=Z9MGKKAXN6)](https://codecov.io/gh/sak007/SRIJAS)
[![version](https://img.shields.io/badge/version-2.0-blue)](https://github.com/sak007/SRIJAS/releases/tag/v2.0)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/unit_test.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/unit_test.yml)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/style_checker.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/style_checker.yml)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/main.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/main.yml)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/code_formatter.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/code_formatter.yml)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/code_cov.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/code_cov.yml)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/close_as_a_feature.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/close_as_a_feature.yml)
[![github workflow](https://github.com/sak007/SRIJAS/actions/workflows/Respost.yml/badge.svg)](https://github.com/sak007/SRIJAS/actions/workflows/Respost.yml)





## Phase 2

https://user-images.githubusercontent.com/32881355/140453003-f6133bbc-b7ec-4d4a-bb2e-f6744236884f.mp4





# Jobby
## Job Search was never this easy
Smart-Resume-Interpreter-And-Job-Alert-System is an application that makes your job search easy and less frustrating.
With SRIJAS, you can upload your resume and job which you want to search for. The application will browse Linkedin and Glassdoor websites to search for the jobs.
The links of the jobs that matches with the skills in your resume, will be sent to you via email.

This is our submission for the Project for Software Engineering CSC 510 Fall 2021.

## Infrastructure Description:
![Infrastructure](https://github.com/SmayanaReddy/SRIJAS/blob/main/images/Infrastructure.jpg)

## Database Schema:
![DB_Schema](https://github.com/SmayanaReddy/SRIJAS/blob/main/images/database.jpeg)

## Overview
<table border="2" bordercolorlight="#b9dcff" bordercolordark="#006fdd">

  <tr style="background: #010203 ">
    <td valign="left"> 
      <p style="color: #FF7A59"> 1.This is the main SRIJAS web page 
      </p>
      <a href="./images/home_page.png"> 
        <img src="./images/home_page.png" >      
      </a>
    </td>
    <td valign="center"> 
      <p style="color: #FF7A59"> 2.User have to upload their resume file and enter the details
      </p>
      <a href="./images/resume_upload.png">
        <img src="./images/resume_upload.png"> 
      </a>
    </td>
  </tr>
  <tr style="background: #010203;"> 
    <td colspan = "2">
      <p style="color: #FF7A59"> 3.The application matches the job postings with the skills and send email to the user.
      </p>  
      <a href="./images/Email2.jpeg">
        <img src="./images/Email2.jpeg">    
      </a>
     </td>
    </td>
  </tr>
  </table>

## Plan Of Action:

### Phase 1:
- [ ] Designing the infrastructure for hosting the web application, database and other required services.
- [ ] Taking Resume, User Email and other basic User Details from the User using a portal.
- [ ] Design Database to support all phases of development.
- [ ] Scraping data from job posting websites like LinkedIn.
- [ ] Developing an Email or Notification Service.
- [ ] Extract knowledge from scraped data.
- [ ] Match user skillsets with the skillsets extracted from scraped data.


### Phase 2:
- [ ] Take more advanced filters from the user.
- [ ] Allow users to choose the threshold of matching of Skills.
- [ ] Integrate the basic portal with a login service.
- [ ] Create a system that stores user profiles and can generate insights from it.
- [ ] Allow users to select previously uploaded resumes.

### Phase 3:
- [ ] Develop a dashboard.
- [ ] Summarize and generate a graph about how the user's resume has progressed.
- [ ] Allow users to generate insights from how the uploaded resume compares with job descriptions in the market.
- [ ] Generate insights from all collected data.

🔱: Installation
---
1. Clone the Github repository to a desired location on your computer. You will need [git](https://git-scm.com/) to be preinstalled on your machine. Once the repository is cloned, you will then ```cd``` into the local repository.
```
git clone https://github.com/SmayanaReddy/SRIJAS.git
cd SRIJAS
```
2. This project uses Python 3, so make sure that [Python](https://www.python.org/downloads/) and [Pip](https://pip.pypa.io/en/stable/installation/) are preinstalled. All requirements of the project are listed in the ```requirements.txt``` file. Use pip to install all of those.
```
pip install -r requirements.txt
```


## Team Members
  * Ashok Kumar Selvam (aselvam@ncsu.edu)
  * Rithik Jain (rjain25@ncsu.edu)
  * Sri Athithya Kruth Babu (sbabu@ncsu.edu)
  * Subramanian Venkatraman (svenka25@ncsu.edu)
  * Zunaid Sorathiya (zhsoarth@ncsu.edu) 

