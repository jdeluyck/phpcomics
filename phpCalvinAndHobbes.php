<?php

require ("comicsLib.php");

/* ************************************************************************* *\
|  phpCalvinAndHobbes.php -- A php script to strip all Calvin & Hobbes        |
|                           comics from the Calvin & Hobbes Site              |
|                           (http://www.ucomics.com/calvinandhobbes/)         |
| 	                                                                      |
|  Version 0.2                                                                |
|                                                                             |
|  Copyright (c) 2001 Jan De Luyck	<jan@kcore.org>                       |
| 								              |
|  Use: set the dates between which you want to strip below, and              |
|       don't forget to set the work_dir!                                     |
|                                                                             |
\* ************************************************************************* */ 

/* DO NOT CHANGE THE BASEURL! */
$base_url = "http://images.ucomics.com/comics/ch/";

/*--------------- User changable options start here ------------------ */
/* Default extention to use */
$std_extention = ".gif";

/* Day when the script should start leeching the site */
$start_year = 1985;
$start_month = 11;
$start_day = 18;

/* Day when the script should end leeching the site */
$end_year = 1990;
$end_month = 04;
$end_day = 18;

/* use a trailing '/', this directory MUST EXIST! */
$work_dir = "calvinAndHobbes/";

/* method to get cartoons... choose between wget, fake or fopen */
$method = "wget";

/* File name format... */
$fileNameFormat = "return \"\$year/ch\" . substr(\$year,2) . \"\$long_month\$long_day\";";

/*--------------- User changable options end here ------------------ */

getBetweenDates($start_year, $start_month, $start_day, $end_year, $end_month, $end_day, 
                $base_url, $work_dir, $fileNameFormat, $method, $std_extention);

?>
