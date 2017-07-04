<?php

mkdir("/tmp/selfmondir/");
$aActionFile = fopen("/tmp/selfmondir/selfmon_action.log", "w") or die("Unable to open Action-file!");
$aDebugFile = fopen("/tmp/selfmondir/selfmon_debug.log", "a") or die("Unable to open Debug-file!");
$txt =  $_GET['payload'];
$txt = str_replace(array("\n", "\t", "\r"), ';', $txt);
$txt .= "\n";

// Catch payload and set actions
if (preg_match('/Partially armed system disarmed./',$txt))
$sActionTxt = 'Night;Off';

if (preg_match('/Close Area. The system partially armed./',$txt))
$sActionTxt = 'Night;On';

if (preg_match('/System armed normally./',$txt))
$sActionTxt = 'Normal;On';

if (preg_match('/Opening report. System disarmed./',$txt))
$sActionTxt = 'Normal;Off';


// Echo ActionTxt result
echo $txt; 
echo 'status:';
echo $sActionTxt;

// Write debug information 
fwrite($aDebugFile, $txt);
fclose($aDebugFile);

// Write detected actions
fwrite($aActionFile, $sActionTxt);
fclose($aActionFile);
chmod("/tmp/selfmondir/selfmon_action.log", 0666);

?>
