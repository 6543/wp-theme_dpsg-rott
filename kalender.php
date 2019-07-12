<?php
/*
Template Name: Kalender
*/

get_header();

$year = 0;

function sortIt($a, $b) {
	return ($a->start_date < $b->start_date) ? -1 : 1;
}

require_once get_stylesheet_directory()."/scoutnet-api/src/scoutnet.php";
$events_stamm = scoutnet()->group(72)->events('start_date >= "'.date("Y-m-d").'" OR end_date >= "'.date("Y-m-d").'"');
$events_bezirk = scoutnet()->group(71)->events('start_date >= "'.date("Y-m-d").'" OR end_date >= "'.date("Y-m-d").'"');
$events = array();

foreach($events_stamm as $stamm) {
	$events[] = $stamm;
}

foreach($events_bezirk as $bezirk) {
	$events[] = $bezirk;
}

uasort($events, 'sortIt');

function makeDate($input_date){
	$new_date = date_create($input_date);
	$wochentage = array('So','Mo','Di','Mi','Do','Fr','Sa');
	$return_date = $wochentage[date_format($new_date, 'w')].", ".date_format($new_date, 'd.m.');
	return $return_date;
}

function getYear($input) {
	$new_date = date_create($input);
	return date_format($new_date, 'Y');
}

function group_logos($input_array) {
	$return_string = "";
	if(isset($input_array[886])) { $return_string .= '<img src="https://kalender.scoutnet.de/2.0/images/21.gif" alt="Biber">'; }
	if(isset($input_array[16])) { $return_string .= '<img src="https://kalender.scoutnet.de/2.0/images/1.gif" alt="Woelflinge">'; }
	if(isset($input_array[17])) { $return_string .= '<img src="https://kalender.scoutnet.de/2.0/images/2.gif" alt="Jungpfadfinder">'; }
	if(isset($input_array[18])) { $return_string .= '<img src="https://kalender.scoutnet.de/2.0/images/3.gif" alt="Pfadfinder">'; }
	if(isset($input_array[19])) { $return_string .= '<img src="https://kalender.scoutnet.de/2.0/images/4.gif" alt="Rover">'; }
	if(isset($input_array[20])) { $return_string .= '<img src="https://kalender.scoutnet.de/2.0/images/5.gif" alt="Leiter">'; }
	return $return_string;
}
?>
<article class="white"><header><h2>Termine</h2></header>
<div class="termin tlevel top" style="margin-top: 0px;">Stufen</div><br style="clear:both;" />
<div class="legend"><img src="https://kalender.scoutnet.de/2.0/images/21.gif" alt="Biber" /> Biber</div><div class="legend"><img src="https://kalender.scoutnet.de/2.0/images/1.gif" alt="Wölflinge" /> Wölflinge</div><div class="legend"><img src="https://kalender.scoutnet.de/2.0/images/2.gif" alt="Jungpfadfinder" /> Jungpfadfinder</div><div class="legend"><img src="https://kalender.scoutnet.de/2.0/images/3.gif" alt="Pfadfinder" /> Pfadfinder</div><div class="legend"><img src="https://kalender.scoutnet.de/2.0/images/4.gif" alt="Rover" /> Rover</div><div class="legend"><img src="https://kalender.scoutnet.de/2.0/images/5.gif" alt="Leiter" /> Leiter</div>
<br style="clear:both;" />
<div class="termin tlevel top">Ebene</div>
<div class="termin tdate top">Datum</div>
<div class="termin ttime top">Zeit</div>
<div class="termin ttitle top">Titel</div>
<div class="termin tsection top">Stufen</div>
<br style="clear:both;" />
<ul style="margin-bottom:25px;">
<?php foreach($events as $event) : ?>
	<?php if($year != getYear($event->start_date)) : ?>
		<li id="<?php echo getYear($event->start_date); ?>" class="year"><div class="termin ttitle" style="width: 100%; text-align: center;"><?php echo getYear($event->start_date); ?></div><br style="clear:both"/></li>
	<?php endif; ?>
		<li><div class="termin tlevel"><?php echo ($event->group_id == 72) ? "Stamm" : "Bezirk"; ?></div><div class="termin tdate"><?php echo ($event->start_date != $event->end_date) ? makeDate($event->start_date)." - ".makeDate($event->end_date) : makeDate($event->start_date); ?></div><div class="termin ttime"><?php echo ($event->start_time != "") ? substr($event->start_time, 0, 5)." - ".substr($event->end_time, 0, 5) : ""; ?></div><div class="termin ttitle"><?php echo ($event->url != "") ? '<a href="'.$event->url.'" target="_blank">'.$event->title.'</a>' : $event->title; ?></a></div><div class="termin tsection"><?php echo group_logos($event->keywords); ?></div><br style="clear:both"/></li>
	<?php
	$year = getYear($event->start_date);
	?>
<?php endforeach; ?>
</ul>
<p style="padding-top:15px;">Einen detaillierteren Kalender findet ihr <a href="http://kalender.scoutnet.de/2.0/show.php?id=72&ebenenup=1" target="_blank">hier</a>.</p>
<!--<p style="padding-top:15px;">Leider funktioniert die Scoutnet-API zurzeit nicht auf unserem Hoster. Den Kalender findet ihr <a href="http://kalender.scoutnet.de/2.0/show.php?id=72&ebenenup=1" target="_blank">hier</a>.</p>-->
<footer></footer></article>
<div class="back-to-top">
    <div class="elevator">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" height="100px" width="100px">
            <path d="M70,47.5H30c-1.4,0-2.5,1.1-2.5,2.5v40c0,1.4,1.1,2.5,2.5,2.5h40c1.4,0,2.5-1.1,2.5-2.5V50C72.5,48.6,71.4,47.5,70,47.5z   M47.5,87.5h-5v-25h5V87.5z M57.5,87.5h-5v-25h5V87.5z M67.5,87.5h-5V60c0-1.4-1.1-2.5-2.5-2.5H40c-1.4,0-2.5,1.1-2.5,2.5v27.5h-5  v-35h35V87.5z"/>
            <path d="M50,42.5c1.4,0,2.5-1.1,2.5-2.5V16l5.7,5.7c0.5,0.5,1.1,0.7,1.8,0.7s1.3-0.2,1.8-0.7c1-1,1-2.6,0-3.5l-10-10  c-1-1-2.6-1-3.5,0l-10,10c-1,1-1,2.6,0,3.5c1,1,2.6,1,3.5,0l5.7-5.7v24C47.5,41.4,48.6,42.5,50,42.5z"/>
        </svg>
        Nach oben
    </div>
</div>
<?php get_footer(); ?>
