<?php
require ("comicsLib.php");

/* ************************************************************************* *\
|  phpSinFest.php -- A php script to strip all Sinfest Comics from            |
|                    the SinFest site. (www.sinfest.net)                      |
| 	                                                                          |
|  Version 0.3                                                                |
| 		                                   			                          |
|  Copyright (c) 2001 Jan De Luyck	<jan@kcore.org>                 	  |
| 								                                              |
|  Use: set the dates between which you want to strip below, and              |
|       don't forget to set the work_dir!                                     |
|                                                                             |
\* ************************************************************************* */					  

/* DO NOT CHANGE THE BASEURL! */
$base_url = "http://sinfest.net/comics/";


/*--------------- User changable options start here ------------------ */
/* Default extention to use */
$std_extention = ".gif";

/* Day when the script should start leeching the site */
$start_year = 2000;
$start_month = 01;
$start_day = 17;


/* Day when the script should end leeching the site */
/* Standard setting is 'today' -> change to your likings */
$end_year = date("Y");
$end_month = date("m");
$end_day = date("d");

/* use a trailing '/', this directory MUST EXIST! */
$work_dir = "sinfest/";

/* method to get cartoons... choose between wget, fake or fopen */
$method = "wget";

/* File name format... */
$fileNameFormat = "return \"sf\$year\$long_month\$long_day\";";

/*--------------- User changable options end here ------------------ */


getBetweenDates($start_year, $start_month, $start_day, $end_year, $end_month, $end_day, 
                $base_url, $work_dir, $fileNameFormat, $method, $std_extention);

?>
