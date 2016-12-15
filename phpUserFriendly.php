<?php
require ("comicsLib.php");

/* ************************************************************************* *\
|  phpUserFriendly.php -- A php script to strip all Userfriendly Comics from            |
|                    the UserFriendly site. (www.userfriendly.net)                      |
|                                                                                 |
|  Version 0.1                                                                |
|                                                                                                 |
|  Copyright (c) 2003 Jan De Luyck      <jan@kcore.org>                      |
|                                                                                                             |
|  Use: set the dates between which you want to strip below, and              |
|       don't forget to set the work_dir!                                     |
|                                                                             |
\* ************************************************************************* */

/* DO NOT CHANGE THE BASEURL! */
$base_url = "http://ars.userfriendly.org/cartoons/?id=";


/*--------------- User changable options start here ------------------ */
/* Default extention to use */
$std_extention = ".gif";

/* Day when the script should start leeching the site */
$start_year = 1997;
$start_month = 11;
$start_day = 17;


/* Day when the script should end leeching the site */
/* Standard setting is 'today' -> change to your likings */
$end_year = date("Y");
$end_month = date("m");
$end_day = date("d");

/* use a trailing '/', this directory MUST EXIST! */
$work_dir = "uf/";

/* method to get cartoons... choose between wget, fake or fopen */
$method = "wget";

/* File name format... */
$fileNameFormat = "return \"\$year\$long_month\$long_day\";";

/*--------------- User changable options end here ------------------ */


getUFBetweenDates($start_year, $start_month, $start_day, $end_year, $end_month, $end_day,
                $base_url, $work_dir, $fileNameFormat, $method, $std_extention);
?>
