while [ $SECONDS -lt $end ]; do

lcda=$(curl -k --silent "http://<your_vkp_java_server:port>/KP.xml" | grep -o -P '(?<=A v=").*(?="/><B)' | awk '{$1=$1};1')
lcdb=$(curl -k --silent "http://<your_vkp_java_server:port>/KP.xml" | grep -o -P '(?<=B v=").*(?="/>)' | awk '{$1=$1};1')

json_lcd='{"lcda":"%s","lcdb":"%s"}\n'
printf "$json_lcd" "$lcda" "$lcdb"
printf "$json_lcd" "$lcda" "$lcdb" >/var/www/html/status/vkp.json

sleep 1
    :
done
