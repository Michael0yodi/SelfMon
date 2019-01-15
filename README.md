# SelfMon
SelfMon Web Service example to allow Selfmon.co.uk to send Galaxy alarm status updates to your web server and control other actions
Included in the example is a way to control Telldus Live 

Installation:

* Enable a Web server with PHP of your choice (Ex. nginx with php)

* Copy control.php to your html folder (Ex. /var/www/html/)

* Copy control.sh to somewhere on your web server

* Trigger control.sh with Cron (Ex. */5 * * * * /path/to/control.sh)

* Ask selfmon.co.uk to add your webserver under URL Calling (Ex. http://yourdomainexample.com/control.php)

* Done!

Note:

http://yourdomainexample.com/status/monstatus.txt can be used with ex. Home assistant to read and set sensors where you can automate based on the Selfmon status.
