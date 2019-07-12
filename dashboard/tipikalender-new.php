<?php
/**
 * DPSG Rott am Inn custom tables
 *
 * @package DPSG Rott am Inn
 */

global $wpdb;
 
if(isset($_POST['title'])) :
	$startdate = substr($_POST['startdate'], -4)."-".substr($_POST['startdate'], 3, 2)."-".substr($_POST['startdate'], 0, 2);
	$enddate = ($_POST['enddate'] != "") ? substr($_POST['enddate'], -4)."-".substr($_POST['enddate'], 3, 2)."-".substr($_POST['enddate'], 0, 2) : "NULL";
	$starttime = ($_POST['starttime'] != "") ? "'".$_POST['starttime'].":00'" : "NULL";
	$endtime = ($_POST['endtime'] != "") ? "'".$_POST['endtime'].":00'" : "NULL";
	$table = $wpdb->prefix."tipi";
	$result = $wpdb->query( $wpdb->prepare( "INSERT INTO $table (startdate, enddate, starttime, endtime, title, author) VALUES ('%s', $enddate, $starttime, $endtime, '%s', '%s')", $startdate, $_POST['title'], wp_get_current_user()->user_login ) );
?>
<div class="wrap">
<?php echo ($result) ? 'Eintrag wird erstellt ...</div><script type="text/javascript">window.location.href = "index.php?page=tipikalender";</script>' : mysql_error(); ?>
</div>
<?php else : ?>
<div class="wrap">
	<h2>Neuen Eintrag erstellen</h2>
    <div id="icon-users" class="icon32"><br/></div>
        
    <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
    <form id="termine-filter" method="post">

		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap" style="padding-bottom: 10px;">
							<label class="" id="title-prompt-text" for="title">Was</label>
							<input type="text" name="title" size="30" value="" id="title" autocomplete="off">
						</div>
						<div id="datewrap" style="padding-bottom: 10px;">
							<label class="" id="date-prompt-text" for="date" style="color: #777; position: absolute; font-size: 1.7em; padding: 11px 10px;">24.10.2014</label>
							<input type="text" name="startdate" size="30" value="" id="date" autocomplete="off" style="padding: 3px 8px; font-size: 1.7em; line-height: 100%; height: 1.7em; width: 44%; outline: 0; margin: 0; background-color: #fff;">
							<div style="display: inline-block; width: 10.5%; text-align: center; line-height: 100%; font-size: 1.4em;">bis</div>
							<label class="" id="date_2-prompt-text" for="date_2" style="color: #777; position: absolute; font-size: 1.7em; padding: 11px 10px;">25.10.2014</label>
							<input type="text" name="enddate" size="30" value="" id="date_2" autocomplete="off" style="padding: 3px 8px; font-size: 1.7em; line-height: 100%; height: 1.7em; width: 44%; outline: 0; margin: 0; background-color: #fff;">
						</div>
						<div id="timewrap">
							<label class="" id="time-prompt-text" for="time" style="color: #777; position: absolute; font-size: 1.7em; padding: 11px 10px;">09:00</label>
							<input type="text" name="starttime" size="30" value="" id="time" autocomplete="off" style="padding: 3px 8px; font-size: 1.7em; line-height: 100%; height: 1.7em; width: 44%; outline: 0; margin: 0; background-color: #fff;">
							<div style="display: inline-block; width: 10.5%; text-align: center; line-height: 100%; font-size: 1.4em;">bis</div>
							<label class="" id="time_2-prompt-text" for="time_2" style="color: #777; position: absolute; font-size: 1.7em; padding: 11px 10px;">16:00</label>
							<input type="text" name="endtime" size="30" value="" id="time_2" autocomplete="off" style="padding: 3px 8px; font-size: 1.7em; line-height: 100%; height: 1.7em; width: 44%; outline: 0; margin: 0; background-color: #fff;">
						</div>
						<div class="inside">
							<div id="edit-slug-box" class="hide-if-no-js"></div>
						</div>
						<input type="hidden" id="samplepermalinknonce" name="samplepermalinknonce" value="d1fa204bee">
					</div>
				</div><!-- /post-body-content -->
				
				<div id="postbox-container-1" class="postbox-container">
					<div id="side-sortables" class="meta-box-sortables ui-sortable">
						<div id="submitdiv" class="postbox ">
							<h3 class="hndle" style="cursor: auto;"><span>Veröffentlichen</span></h3>
							<div class="inside">
								<div class="submitbox" id="submitpost" style="padding-left: 10px; padding-right: 10px;">
									<p>Hier kannst du einen neuen Termin in den Tipikalender eintragen. Für einen Eintrag reichen der Titel der Aktion und das erste Daten-Feld aus.</p>
								</div>
								<div class="clear"></div>
							</div>
							<div id="major-publishing-actions">
								<div id="delete-action">
									<a class="submitdelete deletion" href="index.php?page=tipikalender">Abbrechen</a>
								</div>
								<div id="publishing-action">
									<span class="spinner"></span>
									<input name="original_publish" type="hidden" id="original_publish" value="Veröffentlichen">
									<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Veröffentlichen" accesskey="p">
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			
			</div><!-- /post-body -->
			<br class="clear">
			</div>

        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <!-- Now we can render the completed list table -->
    </form>
</div>
<script type="text/javascript">
jQuery( "#title" ).focus(function() {
  jQuery("#title-prompt-text").addClass("screen-reader-text");
});
jQuery( "#title" ).focusout(function() {
  if(this.value=="") {
  	jQuery("#title-prompt-text").removeClass("screen-reader-text");
  }
});
jQuery( "#date" ).focus(function() {
  jQuery("#date-prompt-text").addClass("screen-reader-text");
});
jQuery( "#date" ).focusout(function() {
  if(this.value=="") {
  	jQuery("#date-prompt-text").removeClass("screen-reader-text");
  }
});
jQuery( "#date_2" ).focus(function() {
  jQuery("#date_2-prompt-text").addClass("screen-reader-text");
});
jQuery( "#date_2" ).focusout(function() {
  if(this.value=="") {
  	jQuery("#date_2-prompt-text").removeClass("screen-reader-text");
  }
});
jQuery( "#time" ).focus(function() {
  jQuery("#time-prompt-text").addClass("screen-reader-text");
});
jQuery( "#time" ).focusout(function() {
  if(this.value=="") {
  	jQuery("#time-prompt-text").removeClass("screen-reader-text");
  }
});
jQuery( "#time_2" ).focus(function() {
  jQuery("#time_2-prompt-text").addClass("screen-reader-text");
});
jQuery( "#time_2" ).focusout(function() {
  if(this.value=="") {
  	jQuery("#time_2-prompt-text").removeClass("screen-reader-text");
  }
});
</script>
<?php
endif;
?>