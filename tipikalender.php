<?php
header("Content-Type: text/calendar; charset=utf-8");
header('Content-Disposition: attachment; filename="tipikalender.ics"');
/**
 * DPSG Rott am Inn custom tables
 *
 * @package DPSG Rott am Inn
 */
 
require_once( $_SERVER['DOCUMENT_ROOT'] . '/dpsg-rott/wp-load.php' );

global $wpdb;
 
$rows = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."tipi ORDER BY startdate" );
?>
BEGIN:VCALENDAR


VERSION:2.0


METHOD:PUBLISH


X-WR-CALNAME:Tipikalender


PRODID:-//Apple Computer\, Inc//iCal 2.0//EN


X-WR-TIMEZONE:Europe/Berlin


CALSCALE:GREGORIAN


BEGIN:VTIMEZONE


TZID:Europe/Berlin


LAST-MODIFIED:<?php echo date("Ymd"); ?>T<?php echo date("His"); ?>Z


BEGIN:STANDARD


DTSTART:20010101T010000


TZOFFSETTO:+0100


TZOFFSETFROM:+0000


TZNAME:CET


END:STANDARD


BEGIN:DAYLIGHT


DTSTART:20060326T030000


TZOFFSETTO:+0200


TZOFFSETFROM:+0100


TZNAME:CEST


END:DAYLIGHT


END:VTIMEZONE<?php
foreach($rows as $row) {
	if($row->starttime != "" && $row->endtime != "") {
		$startdate = "TZID=Europe/Berlin:".date_format(date_create($row->startdate), 'Ymd')."T".substr($row->starttime, 0, 2).substr($row->starttime, 3, 2).substr($row->starttime, 6, 2);
		if($row->enddate != "") {
			$enddate = "TZID=Europe/Berlin:".date_format(date_create($row->enddate), 'Ymd')."T".substr($row->endtime, 0, 2).substr($row->endtime, 3, 2).substr($row->endtime, 6, 2);
		} else {
			$enddate = "TZID=Europe/Berlin:".date_format(date_create($row->startdate), 'Ymd')."T".substr($row->endtime, 0, 2).substr($row->endtime, 3, 2).substr($row->endtime, 6, 2);
		}
	} else {
		$startdate = "VALUE=DATE:".date_format(date_create($row->startdate), 'Ymd');
		if($row->enddate != "") {
			$enddate = "VALUE=DATE:".date_format(date_create($row->enddate), 'Ymd');
		} else {
			$enddate = "VALUE=DATE:".(date_format(date_create($row->startdate), 'Ymd')+1);
		}
	}
	echo sprintf( "

BEGIN:VEVENT

DTSTART;%s

DTEND;%s

LOCATION:Tipi

SUMMARY:%s

UID:%s

SEQUENCE:1

DESCRIPTION:Eingetragen von %s

DTSTAMP:20140601T142333Z

END:VEVENT", $startdate, $enddate, $row->title, "1000".$row->id, $row->author);
}
?>


END:VCALENDAR