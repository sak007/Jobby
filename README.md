## Phase 3 Project Presentation - [Video](https://drive.google.com/file/d/1KCsdtXT9xtVYV2-zRX0HUUuTJPHlqG4b/view?usp=sharing) (NCSU account required to access)

![Jobby_Logo](https://user-images.githubusercontent.com/25822636/143766903-78c31e5e-508d-42fa-8313-c741d278f476.jpg)


[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![version](https://img.shields.io/badge/version-3.0-blue)](https://github.com/sak007/Jobby/releases/tag/v3.0)
[![Build Status](https://circleci.com/gh/sak007/Jobby/tree/main.svg?style=svg)](https://circleci.com/gh/sak007/Jobby/tree/main)
[![codecov](https://codecov.io/gh/sak007/Jobby/branch/main/graph/badge.svg?token=Z9MGKKAXN6)](https://codecov.io/gh/sak007/Jobby)
[![DOI](https://zenodo.org/badge/{704729732}.svg)](https://zenodo.org/badge/latestdoi/{704729732})

[![GitHub issues](https://img.shields.io/github/issues/Swaranjali167/Jobify)](https://github.com/Swaranjali167/Jobify/issues)
[![GitHub closed issues](https://img.shields.io/github/issues-closed/Swaranjali167/Jobify)](https://github.com/Swaranjali167/Jobify/issues?q=is%3Aissue+is%3Aclosed)
[![Github pull requests](https://img.shields.io/github/issues-pr/Swaranjali167/Jobify)](https://github.com/Swaranjali167/Jobify/pulls?q=is%3Aopen+is%3Apr)
[![Github closed pull requests](https://img.shields.io/github/issues-pr-closed/Swaranjali167/Jobify)](https://github.com/Swaranjali167/Jobify/pulls?q=is%3Apr+is%3Aclosed)

[![github workflow](https://github.com/sak007/Jobby/actions/workflows/style_checker.yml/badge.svg)](https://github.com/sak007/Jobby/actions/workflows/style_checker.yml)
[![github workflow](https://github.com/sak007/Jobby/actions/workflows/main.yml/badge.svg)](https://github.com/sak007/Jobby/actions/workflows/main.yml)
[![github workflow](https://github.com/sak007/Jobby/actions/workflows/code_cov.yml/badge.svg)](https://github.com/sak007/Jobby/actions/workflows/code_cov.yml)


# Project 2
=Jobify: Your Gateway to Endless Opportunities

![](https://media.giphy.com/media/12df9hrmdliYc8/giphy.gif)


# Jobify: Job Hunting Made Easy
"Introducing Jobify, your ultimate destination for simplifying your job hunt, making it a breeze rather than a burden".

With Jobify, you have the power to upload your resume and specify your desired job criteria. Our innovative application diligently scours numerous job portals, ensuring that it identifies the positions that align perfectly with your skills and requirements.

What sets us apart is our commitment to keeping you in the loop. Every day at 10:30 AM EST, you'll receive tailored job opportunities straight to your email inbox. Say goodbye to missed job postings and hello to the opportunities you've been searching for."

This is our submission for the Project for Software Engineering CSC 510 Fall 2021.

# Contents
  <ol>
    <li><a href="#working-demo">Working Demo</a></li>
    <li><a href="#whats-new-delta-new-features">What's new? (Delta, New Features)</a></li>
    <li><a href="#work-for-the-upcoming-iteration">Roadmap - Work for the upcoming iteration</a></li>
    <li><a href="#-installation-guide">Installation Guide</a></li>
    <li><a href="#testing">Testing</a></li>
    <li><a href="#code-coverage">Code Coverage</a></li>
    <li><a href="#team-members">Team Members</a></li>
  </ol>

## Working Demo

https://user-images.githubusercontent.com/28624935/143986517-158d58bf-e920-431f-9170-33ea5e8ff292.mp4


## What's new? (Delta, New Features)
- Code Refactoring: Modularization the codebase. We reconfigured the database and implemented cascading features to simplify operations. Also, we split the functionalities into multiple files to create modularity and reduce single source of failure.

- New Job Boards: We added scraping features to new Job Boards - Indeed, Monster, GoinGlobal and Simplyhired. Even though the previous iteration had 2 popular job boards, we decided to increase the search space in order to contribute an adequate number of roles for user's perusal and also provide sheer variety to the Job search space.

- UI and UX: We completely changed the UI and UX of the Job aggregator to make it easier for user as well as owner to manage, edit and work smoothly. The new UI uses minimalism and provides only required data in a concise format.

- Edit your Resume Feature: User's resume keeps changing from time to time. We identified that the previous iteration did not provide an option for the user to update the resume. We decided it was important for the job seeker to have the ease of access instead of creating multiple accounts for every resume change.

- Right to be forgotten: Users must have the choice to remove their data from any application without leaving any trace as and when they wish to do so. This was another feature we identified missing from the previous iteration which we felt was paramount and allowed user to delete account at any point.

- Code Coverage: Test Cases The project had very few test cases when we took over. From there, we have added test cases for both existing and new features. Our code coverage currently stands at 96%, with 40+ test cases.

## Work for the upcoming iteration

- Include additional job posting platforms.
- Enhance filtering options by incorporating criteria such as degree prerequisites, visa sponsorship availability, years of experience required, and salary ranges.
- Integrate Single Sign-On (SSO) authentication with popular services like Gmail, Github, and Indeed.
- Develop a homepage dashboard to display the count of job listings per job board and the best match percentage for each posting.
- Give users the option to select their preferred notification method, whether it's via email or SMS.
- Implement job data caching for a specified duration to prevent redundant entries.

🔱: Installation Guide
---
- After Cloning the Github repository (git clone https://github.com/sak007/Jobby.git) to a desired location on your computer. Please follow the steps given below to set up the project to a working condition.
- Host your MySQL DB using an application by following these steps.
  * **Create a MySQL instance in your local** 
    + [Installation instruction for local](https://dev.mysql.com/doc/mysql-getting-started/en/#mysql-getting-started-installing)
  or
  * **Create a MySQL instance in AWS**
    + [Installation instruction AWS](https://www.youtube.com/watch?v=Ng_zi11N4_c)
- Execute Jobby/code/Database/schema/srijas.sql file in the created db
- Update your DB credentials in the db.properties.template file.
- Provide executable permissions for setup.sh and execute the file.
This will install all the required packages from requirements.txt and create a parameters.json file which is required for accessing the DB.
- You can either choose to host the project on any online hosting platform or use an application to test the application locally. We used two applications to host the webpage in local -> XAMPP and MAMP Pro
  * [MAMP Pro](https://www.mamp.info/en/downloads/)
    + [Installation instructions](https://documentation.mamp.info/en/MAMP-PRO-Mac/)
  * [XAMPP](https://www.apachefriends.org/download.html)
    + If you wish to use XAMPP, download the application and click on the Config button (see picture below)
    
      <img width="607" alt="xampp-conf" src="https://user-images.githubusercontent.com/28624935/143979475-f2d4b1d6-297c-43ff-8cb5-d243e59ebc57.png">
    + Click the Apache(httpd.conf) file and add the your project's directory under "DocumentRoot:"
      ```
        DocumentRoot ".../Jobby/code/Web_app"
        <Directory ".../Jobby/code/Web_app">
      ```
- After setting up the project, create executable permissions for the following files - run_notifier.sh and start_server.sh
  * To run the job notifier once -> execute run_notifier.sh
  * To run the scheduler -> execute start_server.sh

- You should be good to start working on the application now.

![Success](https://tenor.com/view/success-kid-hells-yes-i-did-it-fuck-yeah-success-gif-5207407.gif)

## Testing

We use pytest to perform testing on all unit tests together. The command needs to be run from the home directory of the project. The command is:
```
python -m pytest test/
```

## Code Coverage

Code coverage is part of the build. Every time new code is pushed to the repository, the build is run, and along with it, code coverage is computed. This can be viewed by selecting the build, and then choosing the codecov pop-up on hover.

Locally, we use the coverage package in python for code coverage. The commands to check code coverage in python are as follows:

```
coverage run -m pytest test/
coverage report
```


## Team Members
  * Neha Jagtap (njagtap@ncsu.edu)
  * Swaranjali Jadhav (smjadhav@ncsu.edu)
  * Pranjali Jadhav(psjadhav@ncsu.edu)
  * Shardul Khandekar (sskhande@ncsu.edu)
  
