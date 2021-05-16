# Tibe Condo
Sample Project for Tribe Condominium Visitor Log Management [Demo](http://ec2-18-141-24-108.ap-southeast-1.compute.amazonaws.com/tribe)

<br/>

*Objective*

As a digitized , realtime visitor logs tool


<br/>

*Features*

- Visitor check in/ check out
- Occupant management
- Unit mangement (with capacity)
- User management

<br/>

*Demo*

Click [here](http://ec2-18-141-24-108.ap-southeast-1.compute.amazonaws.com/tribe)

<br/>

*Installation*

- Git Clone/ Download the source code
- Copy/ Move source code to the root directory of web server 
- Rename project directory name from "tribe-condo" to "tribe"
- Under "config" directory, rename app_local.example.php to app_local.php, and configure database access (Datasources section) accordingly 
- Run SQL script tribe-condo.sql in database server
- Login using "admin", default password "simple123"

<br/>

*versions*

- v0.80\
Initial commit

<br/>

*Known Bugs/ Features Improvement*

- Dynamic rounting (currently project MUST reside in WEB_ROOT/tribe to function)
- Authorization (not implemented)



