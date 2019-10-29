# SelfMon

SelfMon Web Service example to allow Selfmon.co.uk to send Galaxy alarm status updates via LCE-01 module and your Galaxy home alarm system directly to your web server and let you control other actions based on state. 
Included in the example is an integration to Home Assistant https://www.home-assistant.io/ and also some automations that utilize status from Selfmon integrations and also an example to trigger the SelfMon VirtualKeypad and read the LCD display from your alarm system and integrate all of this in Home Assistant.


Basic Setup:

* Enable a Web server with PHP of your choice (Ex. nginx with php)
* Copy control.php to your html folder (Ex. /var/www/html/)
* Ask selfmon.co.uk to add your webserver under URL Calling (Ex. http://yourdomainexample.com/control.php)
* Done!

VirtualKeypoad (VKP) setup:

!! This require you to run the JAR file as a service on an exsing Local server in your home
(dont run it as root..)

* Download VKP https://www.sm-alarms.co.uk/main/getVKPfaq.php
* Install JRE (ex apt-get install java-common)
*  Run:
   *  sudo cp selfmon.service  /etc/systemd/system/syslog.service
   *  sudo cp selfmon-run.sh /home/<linux user>/selfmon-run.sh
   *  sudo systemctl daemon-reload
   *  sudo systemctl enable selfmon.service
   *  sudo systemctl start selfmon.service
   *  sudo systemctl status selfmon.service
  
 You should see this if everything is working:
 
  user@linux:/root# sudo systemctl status selfmon.service
   selfmon.service - Java SelfMon
   Loaded: loaded (/etc/systemd/system/selfmon.service; enabled; vendor preset: enabled)
   Active: active (running) since Mon 2019-10-28 08:10:07 CET; 1 day 7h ago

* Setup json creation from LCD data
   * Download generate_json.sh (this will run every second - change as needed)
   * Setup a Cron job: * * * * * killall generate_json.sh ; /path/to/generate_json.sh


Home Assistant

Please see example HA yaml files to read data from "Basic Setup" and also "VirtualKeypoad (VKP) setup"


Other:
Control.sh contains example to trigger actions directly on the server, run it with cron (Ex. */5 * * * * /path/to/control.sh)




