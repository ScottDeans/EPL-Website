#EPL Kit Tracking System
Our goal is to make a simple application for the Edmonton Public Library to track the kits they book out to other locations.
Users of the system will be able to log in with their EPL login and be able to book kits, edit kits, delete kits, edit bookings,
view bookings, and view transfers of bookings for their branch. Admin users will be able to add new kit types, and manage users.

The system makes use of the Laravel 5 framework and is written in a combination of php and HTML 5.

#Laravel 5 changes
Laravel 5 has some different changes over Laravel 4, particularly the file system. Any files pertaining to the views are found in
resources/views/, the routes.php file is located in app/Http/, controllers are found in app/Http/Controllers, form requests are found
in app/Http/Requests/, models are found in app/models/, the css file is located in public/css

#Database

Currently, ../config/database.php is pointing at a database called CMPT395_hucatog, with the standard CS50 username and
password (jharvard and crimson, respectively). To add this database, navigate to localhost/phpmyadmin in your browser, log in
using the standard CS50 username and password, then navigate to "Databases" and create one named "CMPT395_hucatog".

#Cron Scheduling

This package contains a cron schedule script (crontab.txt) in the laravel folder to check daily (at 05:30) to build the transfers table. You will need to edit the path for your local machine, then enter the command: 
>$ crontab crontab.txt

You can confirm that the command was added by entering 
>$ crontab -l 

and noting that the job listed in the crontab.txt file appears.

#Mailing

In the package, the mailer is currently set up to simply log all outgoing messages. This can be changed in the laravel\config\mail.blade.php
