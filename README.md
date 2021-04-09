# Project


To setup and launch database:
1. Launch xampp. Once started, on the control panel, start "Apache" and "MySQL"
2. Click the 'Admin' button. phpMyAdmin dashboard should launch in browser. If xampp is freshly installed, the credentials located in the db_connection.php file should work. If you have configured settings, you have to change the info in db_connection.php.
3. Databases are located in the left hand side column. Create a database called 'cosc360_projectdb'. If you want to name it something else, update your db_credentials.php file.
4. In your newly created database, click 'import' and select the 'dbdata.sql' file. Click 'Go' at the bottom, and the database should load.

If you are having trouble, see the instructions for loading a database in phpMyAdmin given in Lab 9.