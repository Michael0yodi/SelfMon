<?php
mkdir("/tmp/selfmonlog/");
$aActionFile = fopen("/tmp/selfmon_action.log", "w") or die("Unable to open A-file!");
$aStatusFile = fopen("status/monstatus.txt", "w") or die("Unable to open S-file!");
$aStatusFile2 = fopen("status/monstatus2.txt", "w") or die("Unable to open S-file!");
$aDebugFile = fopen("/tmp/selfmonlog/selfmon_debug.log", "a") or die("Unable to open D-file!");
$txt =  $_GET['payload'];
$txt = str_replace(array("\n", "\t", "\r"), ';', $txt);
$txt = str_replace("▒", 'a', $txt);
$txt .= "\n";

if (preg_match('/Partially armed system disarmed./',$txt))
$sActionTxt = 'Night;Off';

if (preg_match('/Close Area. The system partially armed./',$txt))
$sActionTxt = 'Night;On';

if (preg_match('/System armed normally./',$txt))
$sActionTxt = 'Normal;On';

if (preg_match('/Opening report. System disarmed./',$txt))
$sActionTxt = 'Normal;Off';

preg_match('/Xtra=.[A-z]{1,10}.[A-z]{2}.[A-z].[A-z]{1,10}/',$txt,$sActionTxtXtra);
preg_match('/Usr=.[0-9]{1,3}/',$txt,$sActionTxtUsr);

echo $txt; //debug print
echo 'status:';
echo $sActionTxt;

fwrite($aDebugFile, $txt);
fclose($aDebugFile);
fwrite($aActionFile, $sActionTxt);
fclose($aActionFile);
fwrite($aStatusFile, $sActionTxt);
fclose($aStatusFile);

fwrite($aStatusFile2, $sActionTxt . ";" . substr($sActionTxtXtra[0],6) . ";" . substr($sActionTxtUsr[0],5));
fclose($aStatusFile2);

chmod("/tmp/selfmon_action.log", 0666);

?>

