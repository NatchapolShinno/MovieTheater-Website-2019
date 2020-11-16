NOTES FOR CPE231 DATABASE PROJECT:  Telechubbies Theater

1) DATABASE & WEBSITE INFORMATION

The database is hosted on Google Cloud Platform's SQL Service with the following information:
	IP: 34.87.179.193
	User: root
	Password: telechubbies
	Database: telechubbies_theater

You may wish to directly manipulate or view the database through a DBMS with the given information.

The website itself must be hosted locally with XAMPP, and all files are hosted locally.

The SQL file for the database (exported from phpMyAdmin), with data, is also provided in the case that you wish to import the database. If you wish to use the locally hosted database for the website, the PHP connection settings must then be manually changed in connectDB.php and several other .php files.

***********************************************************************************************************

2) USER ROLES AND LOGIN CREDENTIALS

There are several test accounts for testing user roles: Member, Employee, and Manager.
Member:
	E-mail: johndoe@mail.com
	Password: password

Employee (more can be found in the database, in the employee table):
	E-mail: tech@mail.com
	Password: telechubbies

	E-mail: tech.stark@mail.com
	Password: telechubbies

Manager:
	E-mail: manager@mail.com
	Password: telechubbies

For employees and manager, upon logging in, the user will be taken to the theater management system (separate from the customer pages), for their own role. Ie. employees will be taken to the employee home, manager taken to the manager home, which have different menus.


**************************************************************************************************************

3) NOTES ABOUT FUNCTIONALITY

- There are several features omitted from the midterm report, some of which are covered in the video. The ER diagram has also been modified to meet the project requirements; this is discussed in the video, and the diagram is also included in the .ZIP file.

- Some forms are noticeably absent, such as the forms to add theaters or branches, as **the requirements for the simple forms have already been met**. Adding more branches or theater will require the user to manually insert them into the database through the DBMS.

- Attempts to access pages by directly accessing the URL may result in erroneous webpages, such as the page not showing data, or showing error messages. All pages must be accessed through the navbar, as we do not guarantee website correctness from attempts of doing otherwise.

- Some pages may take some time to load and display correctly, namely the movie listing page (movielist.php), as the process of loading the video file for the promotional trailer may take some time.

- The website is designed to be opened in a full-sized browser window, we cannot guarantee 100% functionality and aesthetics for smaller windows, although most pages will handle it correctly (through Bootstrap's fluid container).

- Any forms with an image upload only accepts .jpg (and not .jpeg or other types) files, however it is not validated (while not best practices, it is not stated in the requirements). Please take this into consideration when testing such forms.



	We hope you will give us the kindest consideration.

	Sincerely,

		The Telechubbies Team.