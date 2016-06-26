##Deployment Instructions:
1. Ensure packages are installed: $ sudo apt get install php-cli php*mysql
2. Navigate to the web/php directory.
3. Initialize database in mysql with the following commands:
  1. $ CREATE DATABASE project_db
  2. $ USE project_db
  3. $ SOURCE project_db.sql
4. To view page:
  1. Launch the server with the following command in the web/php/ directory: $ php -S localhost:8080
  2. Copy http://localhost:8080 and paste into browser.
  3. If you would like to login as a demo user to view current features and client experience: Username: WTC, Password: password
