<?php
require ("comicsLib.php");

/* ******************************************************************* *\
|  phpGarfield.php -- A php script to strip all Garfield Comics from    |
|                     the garfield site. (www.garfield.com)             |
| 	                                                                    |
|  Version 0.4                                                          |
| 					                                   			        |
|  Copyright (c) 2000 - 2001 Jan De Luyck	<jandeluyck@gmx.net>	    |
| 								                                        |
|  Use: set the dates between which you want to strip below, and        |
|       don't forget to set the work_dir!                               |
|								                                        |
\* ******************************************************************* */					  

/* DO NOT CHANGE THE BASEURL! */
$base_url = "http://images.ucomics.com/comics/ga/";

/*--------------- User changable options start here ------------------ */
/* Default extention to use */
$std_extention = ".gif";

/* Day when the script should start leeching the site */
$start_year = 1978;
$start_month = 6;
$start_day = 19;

/* Day when the script should end leeching the site */
/* Standard setting is 'today' -> change to your likings */
$end_year = date("Y");
$end_month = date("m");
$end_day = date("d");

/* use a trailing '/', this directory MUST EXIST! */
$work_dir = "garfield/";

/* method to get cartoons... choose between wget, fake or fopen */
$method = "wget";

/* File name format... */
$fileNameFormat = "return \"\$year/ga\" . substr(\$year,2) . \"\$long_month\$long_day\";";


/*--------------- User changable options end here ------------------ */

getBetweenDates($start_year, $start_month, $start_day, $end_year, $end_month, $end_day, 
                $base_url, $work_dir, $fileNameFormat, $method, $std_extention);
?>
