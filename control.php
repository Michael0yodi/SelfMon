	<?php

	// Setup locations
	mkdir("/tmp/selfmonlog/");
	$ajsonFile = fopen("status/selfmon.json", "w") or die("Unable to open json file!");
	$aDebugFile = fopen("/tmp/selfmonlog/selfmon_debug.log", "a") or die("Unable to open debug file!");
	$aDebugFileRaw = fopen("/tmp/selfmonlog/selfmon_debug_raw.log", "a") or die("Unable to open debug raw file!");

		// Catch payload
		$txt =  $_GET['payload'];
		
		// Store payload as raw
		fwrite($aDebugFileRaw, $txt);
		fclose($aDebugFileRaw);

		// Modify input data
		$txt = str_replace(array("\n", "\t", "\r"), ';', $txt);
		$txt = str_replace("▒", 'a', $txt);
		$txt .= "\n";
		
		// Store payload after modification
		fwrite($aDebugFile, $txt);
		fclose($aDebugFile);

		// Catch Xtra and Usr attributes
                preg_match('/Xtra=.+.+?(?=;Dev)/',$txt,$sActionTxtXtra);
		preg_match('/Usr=.[0-9]{1,3}/',$txt,$sActionTxtUsr);

			// Set status based on payload information
			if (preg_match('/[S-s]ystem disarmed./',$txt))
			$sActionTxtStat = 'Off';

			if (preg_match('/system partially armed./',$txt))
			$sActionTxtStat = 'NightOn';

			if (preg_match('/System armed normally./',$txt))
			$sActionTxtStat = 'NormalOn';

			if (preg_match('/System armed automatically./',$txt))
			$sActionTxtStat = 'AutoOn';

			if (preg_match('/violated/',$txt))
			$sActionTxtStat = 'Alarm';

			if (preg_match('/Fire alarm/',$txt))
			$sActionTxtStat = 'Fire';

			if (preg_match('/Local programming has begun./',$txt))
			$sActionTxtStat = 'Program';

			if (preg_match('/Local programming ended./',$txt))
			$sActionTxtStat = 'Off';

			if (preg_match('/\A\z/', $sActionTxtStat))
			$sActionTxtStat = 'Unknown';

	// Create json 
	$jsonarray = array(
		'status' => $sActionTxtStat,
		'xtra' => substr($sActionTxtXtra[0],6),
		'usr' => substr($sActionTxtUsr[0],5)
	);

	$jsonout = json_encode($jsonarray);

	// Show json as web-echo
	echo $jsonout;

	// Store json to file
	fwrite($ajsonFile, $jsonout );
	fclose($ajsonFile);

	?>
