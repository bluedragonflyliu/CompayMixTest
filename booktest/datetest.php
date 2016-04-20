<?php 
date_default_timezone_set('PRC');
print strftime('%c');

$now = localtime(time(),true);
echo '<pre>';
//var_dump($now);

var_dump(date(DATE_ATOM));
var_dump(date(DATE_ISO8601));
var_dump(date(DATE_RFC822));
var_dump(date(DATE_COOKIE));
echo '<hr />';
list($date_1_yr, $date_1_mo, $date_1_dy, $date_1_hr, $date_1_mn, $date_1_sc) = array(1965, 5, 10, 19, 32, 56);
list($date_2_yr, $date_2_mo, $date_2_dy, $date_2_hr, $date_2_mn, $date_2_sc) = array(1962, 11, 20, 4, 29, 11);
$diff_date = GregorianToJD($date_1_mo, $date_1_dy, $date_1_yr)-GregorianToJD($date_2_mo, $date_2_dy, $date_2_yr);
$diff_time = ($date_1_hr*3600+ $date_1_mn*60+$date_1_sc)-($date_2_hr*3600+$date_2_mn*60+$date_2_sc);
if($diff_time<0){
	$diff_date--;
	$diff_time = 86400 - $diff_time;
}
$diff_weeks = floor($diff_date/7);
$diff_date -= $diff_weeks * 7;
$diff_hours = floor($diff_time/3600);
$diff_time -= $diff_hours * 3600;
$diff_mimutes = floor($diff_time/60);
$diff_time -= $diff_mimutes *60;
print "The two dates have $diff_weeks weeks, $diff_date days, ";
print "$diff_hours hours, $diff_mimutes minutes, and $diff_time ";
print "seconds bettween them.";
?>