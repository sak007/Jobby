# Backend Documentation (PHP)

## Files:
1. **login.php**
- This is the login page of the website, where user can login to their account.

2. **signup.php**
- This page helps user create a new account on the website. It collects initial data such as Name, Email, Preferred location of Work, Job Type and Resume.

3. **home.php**
- The Homepage of the website, where user can check his data and navigate to other functionalities in the website.

4. **register.php**
- This page helps user to register to different Job Boards, by toggling On/OFF against each Job Board. Once the options are selected, the user can click on Apply to save the changes to the DB.

5. **updateResume.php**
- This page helps user update their Resume.

6. **logout.php**
- Kills the user session and logs the user out of the website

7. **registerUser.php**
- This is the meat and potatoes of the backend code. All of the good stuff happens here – including but
not limited to database updating, test case verification, file transfer, pdf parsing, and regular expression matching.

8. **test.php**
- This is the test file designed to run parts of the code of registerUser.php and return the results of those test cases. It works by checking if the correct entries are entered into the database and if the IDs of the tables are correctly mapped to each other.

9. **connectDB.php**
- This file helps establish the connection between the website and backend DB, using the parameters.json file.

10. **forgot.php**
- This file is used to send password recovery link to the user on his/her email ID in case of forgotten password.

11. **reset-password.php**
- This file helps the user to reset the old password by providing a new one.
