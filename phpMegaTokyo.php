<?php
require ("comicsLib.php");

/* ******************************************************************* *\
|  phpMegaTokyo.php -- A php script to strip all MegaTokyo Comics from  |
|                     the site. (http://www.megatokyo.com)              |
|                                                                       |
|  Version 0.1                                                          |
|                                                                       |
|  Copyright (c) 2003 Jan De Luyck	<jan@kcore.org>                     |
|                                                                       |
|  Use: set the dates between which you want to strip below, and        |
|       don't forget to set the work_dir!                               |
\* ******************************************************************* */

/* DO NOT CHANGE THE BASEURL! */
$base_url = "http://www.megatokyo.com/";
$detect_string = "<option value=''>MegaTokyo Archives</option>";

/*--------------- User changable options start here ------------------ */
/* Default extention to use */
$std_extention = ".gif";
$std_extention2 = ".jpg";

/* start comic number */
$start_comic_nr = 1;

/* Stop comic number. You can set this to a value, or let the
script determine the last comic automatically. */
$end_comic_nr = getMTLastComicNr($base_url, $detect_string);

/* use a trailing '/', this directory MUST EXIST! */
$work_dir = "megatokyo/";

/* method to get cartoons... choose between wget, fake or fopen */
$method = "wget";

/*--------------- User changable options end here ------------------ */

getMTBetweenNumbers($start_comic_nr, $end_comic_nr, $base_url, $work_dir, $method, $std_extention);
getMTBetweenNumbers($start_comic_nr, $end_comic_nr, $base_url, $work_dir, $method, $std_extention2);
?>
