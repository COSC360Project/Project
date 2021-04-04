# Project


To setup and launch database:
1. Launch xampp. Once started, on the control panel, start "Apache" and "MySQL"
2. Click the 'Admin' button. phpMyAdmin dashboard should launch in browser. If xampp is freshly installed, the credentials located in the db_connection.php file should work. If you have configured settings, you have to change the info in db_connection.php.
3. Databases are located in the left hand side column. Create a database called 'cosc360_projectdb'. If you want to name it something else, update your db_credentials.php file.
4. Create a new tab in the browser, and in the search bar, type: 'localhost/[path to project]/Project/db_info/restoredb.php'
5. Upon searching this for the first time, assuming the connection is established correctly, the message 'Error Restoring Database!' should display. Refresh the page, and this message should be replaced by 'Database Restored Successfully!'. The database should be loaded and accessible on your local machine. If you navigate over to phpMyAdmin and click on the database you created in step 3, you should see a list of tables. If you click on a table, you should be able to see its contents. The content for these tables are configured in dbdata.txt and the sql queries to create these tables are launched in restoreddb.php. If you modify dbdata.txt, do not leave any empty lines!

If you are having troubles connecting the database, this link might help:
https://www.cloudways.com/blog/connect-mysql-with-php/


Until we have the session variables set up on login, use 'dummysession.php' to set session variables. Session variables must be set for the header to work correctly.