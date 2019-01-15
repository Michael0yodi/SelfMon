<?php
mkdir("/tmp/selfmonlog/");
$aActionFile = fopen("/tmp/selfmon_action.log", "w") or die("Unable to open A-file!");
$aStatusFile = fopen("status/monstatus.txt", "w") or die("Unable to open S-file!");
$aDebugFile = fopen("/tmp/selfmonlog/selfmon_debug.log", "a") or die("Unable to open D-file!");
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
echo $txt; //debug print
echo 'status:';
echo $sActionTxt;

// Write detected actions
fwrite($aDebugFile, $txt);
fclose($aDebugFile);
fwrite($aActionFile, $sActionTxt);
fclose($aActionFile);
fwrite($aStatusFile, $sActionTxt);
fclose($aStatusFile);

chmod("/tmp/selfmon_action.log", 0666);

?>

