#!/bin/bash

ConstrolID=1234567 // Example added to control Telldus Live enabled devices
LogFile="/tmp/selfmondir/control.log"
ActionFile="/tmp/selfmon_action.log"

if [ -f "$ActionFile" ]
then
SelfmonAction=$(<$ActionFile)

case "$SelfmonAction" in
        "Normal;On") echo "$(date) Normal On" >>$LogFile
         /path/to/tdtool.py --on $ConstrolID >>$LogFile // CHANGE AND/OR ADD ACTION HERE
           ;;
         "Normal;Off") echo "$(date) Normal Off" >>$LogFile
          /path/to/tdtool.py --on $ConstrolID >>$LogFile // CHANGE AND/OR ADD ACTION HERE
           ;;
         "Night;On") echo "$(date) Night On" >>$LogFile
            ;;
         "Night;Off") echo "$(date) Night Off" >>$LogFile
             ;;
esac

else
         echo "No command.."
fi

rm -f $ActionFile
