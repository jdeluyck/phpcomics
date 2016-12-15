<?php
/*****************************************************************************\
|  comicsLib.php -- Library with functions used to strip sites with comics    |
| 	                                                                      |
|  Version 0.4                                                               |
|                                                                             |
|  Copyright (c) 2001 - 2003 Jan De Luyck	<jan@kcore.org>               |
\*****************************************************************************/

/********** GENERAL FUNCTIONS **************/

/*
   Downloads the comic, returns the local file name
*/
function getComic($remoteURL, $method)
{
	switch($method)
	{
		case "fopen":
		{
			$remoteFile = fopen($remoteURL, "r");
			$localFile = fopen(basename($remoteURL) ,"w");
			
			while (! feof($remoteFile))
			{
				fwrite($localFile, fread($remoteFile, 4096));
			}
			fclose($remoteFile);
			fclose($localFile);
			break;
		}

		case "fake":
		{
			$output = "wget -q " . $remoteURL;
			echo $output, "\n";
			break;
		}

		case "wget":
		default:
		{
			$output = "wget -q " . $remoteURL;
			$output = `$output`;
			break;
		}

	}
	
	return basename($remoteURL);
}

function moveFile($fileName, $localFilePath)
{
	/* move the file to the appropriate directory and rename it */
	if (file_exists($fileName))
		rename ($fileName, $localFilePath);
}

function getBetweenDates($start_year, $start_month, $start_day, $end_year, $end_month, $end_day, $base_url, $work_dir, $fileNameFormat, $method, $std_extention)
{
	$dir_mode = 0777;

	for ($year = $start_year; $year <= $end_year; $year++)
	{
		@mkdir($work_dir . $year, $dir_mode);

		/* set the start month for the year */
		if ($year != $start_year)
			$st_month = 1;
		else
			$st_month = $start_month;
	
		/* set the end month for the year */
		if ($year == $end_year)
			$am_month = $end_month;
		else
			$am_month = 12;
	
		for ($month = $st_month; $month <= $am_month; $month++)
		{
			/* create a dir for this month */
			if (strlen($month) == 1)
				$long_month = "0" . $month;
			else
				$long_month = $month;
			
			@mkdir($work_dir . $year . "/" . $long_month, $dir_mode);

			/* get amount of days in the month */
			switch($month)
			{
				case 1: case 3: case 5: case 7: case 8: 
    	                    case 10: case 12:
				{
					$am_days = 31;
					break;
				}
				case 4: case 6: case 9: case 11:
				{
					$am_days = 30;
					break;
				}
				case 2:
				{
					if (($year % 4) == 0)
						$am_days = 29;
					else
						$am_days = 28;
					break;
				}
			}
		
			/* set the start day for that month */
			if ($year == $start_year && $month == $start_month)
				$st_day = $start_day;
			else
				$st_day = 1;
			
			/* set the end day for that month */
			if ($year == $end_year && $month == $end_month)
				$am_days = $end_day;
				
			for ($day = $st_day; $day <= $am_days; $day++)
			{
				if (strlen($day) == 1)
					$long_day = "0" . $day;
				else
					$long_day = $day;
				
				/* Define the url for this comic */
			
				$remoteURL = $base_url . eval($fileNameFormat) . $std_extention;
				$localFilePath = $work_dir . $year . "/" . $long_month . "/" . $long_day . $std_extention;

				$fileName = getComic($remoteURL, $method);

				moveFile($fileName, $localFilePath);

				echo "File " . $localFilePath . " has been written.\n";
			}
		}
	}
}

/************** USERFRIENDLY FUNCTIONS ************/

/*
   Downloads the comic, returns the local file name
*/

function getUFBetweenDates($start_year, $start_month, $start_day, $end_year, $end_month, $end_day, $base_url, $work_dir, $fileNameFormat, $method, $std_extention)
{
	$dir_mode = 0777;

	for ($year = $start_year; $year <= $end_year; $year++)
	{
		@mkdir($work_dir . $year, $dir_mode);

		/* set the start month for the year */
		if ($year != $start_year)
			$st_month = 1;
		else
			$st_month = $start_month;

		/* set the end month for the year */
		if ($year == $end_year)
			$am_month = $end_month;
		else
			$am_month = 12;

		for ($month = $st_month; $month <= $am_month; $month++)
		{
			/* create a dir for this month */
			if (strlen($month) == 1)
				$long_month = "0" . $month;
			else
				$long_month = $month;

			@mkdir($work_dir . $year . "/" . $long_month, $dir_mode);

			/* get amount of days in the month */
			switch($month)
			{
				case 1: case 3: case 5: case 7: case 8:
    	                    case 10: case 12:
				{
					$am_days = 31;
					break;
				}
				case 4: case 6: case 9: case 11:
				{
					$am_days = 30;
					break;
				}
				case 2:
				{
					if (($year % 4) == 0)
						$am_days = 29;
					else
						$am_days = 28;
					break;
				}
			}

			/* set the start day for that month */
			if ($year == $start_year && $month == $start_month)
				$st_day = $start_day;
			else
				$st_day = 1;

			/* set the end day for that month */
			if ($year == $end_year && $month == $end_month)
				$am_days = $end_day;

			for ($day = $st_day; $day <= $am_days; $day++)
			{
				if (strlen($day) == 1)
					$long_day = "0" . $day;
				else
					$long_day = $day;

				/* Define the url for this comic */

    				//this defines the html page we need to examine
				$remoteURL = $base_url . eval($fileNameFormat);
    				$remotePage = file($remoteURL);
    				for ($line = 0; $line < count($remotePage); $line++)
    				{
    					if (strstr($remotePage[$line],".gif") && (strstr($remotePage[$line], "archive")))
    					{
          						// we now have the <img> line. Cut out the url
          						$remoteURL = substr($remotePage[$line], strpos($remotePage[$line], "http://"));
          						$remoteURL = substr($remoteURL, 0, strpos($remoteURL, $std_extention . "\"") + strlen($std_extention));
    					}
    				}

				$localFilePath = $work_dir . $year . "/" . $long_month . "/" . $long_day . $std_extention;

				$fileName = getComic($remoteURL, $method);

				moveFile($fileName, $localFilePath);

				echo "File " . $localFilePath . " has been written.\n";
			}
		}
	}
}

/******************** MEGATOKYO FUNCTIONS ********************/

function getMTBetweenNumbers($start_comic_nr, $end_comic_nr, $base_url, $work_dir, $method, $std_extention)
{
	for ($comic_nr = $start_comic_nr; $comic_nr <= $end_comic_nr; $comic_nr++)
	{
		$padding = str_repeat("0", 4 - strlen($comic_nr));

 		$remoteURL = $base_url . "strips/" . $padding . $comic_nr . $std_extention;
		$localFilePath = $work_dir . $padding . $comic_nr . $std_extention;

		$fileName = getComic($remoteURL, $method);

		moveFile($fileName, $localFilePath);

		echo "File " . $localFilePath . " has been written.\n";
	}
}

function getMTLastComicNr($base_url, $detect_string)
{
	$remotePage = file_get_contents($base_url);
	$startPos = strpos($remotePage, $detect_string) + strlen($detect_string);
	$remotePage = substr($remotePage, $startPos);

	$stopPos = strpos($remotePage, ">");
	$remotePage = substr($remotePage,0,$stopPos);

	$startPos = strpos($remotePage, "'") + 1;
	$stopPos = strrpos($remotePage, "'");

	$number = substr($remotePage, $startPos, $stopPos - $startPos);

	return ($number);
}
?>
