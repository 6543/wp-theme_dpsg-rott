<?php
/*
Template Name: Bilder
*/

get_header(); ?>

<?php
global $wpdb;
$table_aktionen = $wpdb->prefix . "aktionen";
$wpdb->get_results("CREATE TABLE IF NOT EXISTS $table_aktionen (
id int(11) NOT NULL auto_increment,
aktion varchar(50) COLLATE utf8_general_ci NOT NULL,
von int(7) NULL,
bis int(7) NULL,
ersteller int(11) NOT NULL,
aenderung int(7) NULL,
PRIMARY KEY (id) )
CHARACTER SET utf8;");

$table_bilder = $wpdb->prefix . "bilder";
$wpdb->get_results("CREATE TABLE IF NOT EXISTS $table_bilder (
id int(11) NOT NULL auto_increment,
aktion int(11) NOT NULL,
datei varchar(50) COLLATE utf8_general_ci NOT NULL,
titel varchar(50) COLLATE utf8_general_ci NULL,
ersteller int(11) NOT NULL,
aenderung int(7) NULL,
PRIMARY KEY (id) )
CHARACTER SET utf8;");

$ergebnisse = $wpdb->get_results("SELECT * FROM $table_aktionen ORDER BY von DESC");
foreach ( $ergebnisse as $row ) {
	if(strcmp($row->aktion, "Gruppenbilder")==true) {
		echo '<article><header><span class="article-meta">';
		if(($row->von)!=0 || ($row->bis)!=0) {
			$von = $row->von;
			$bis = $row->bis;
			
			$von = date("d.m.", $von);
			$bis = date("d.m.", $bis);
			
			$t = date('w', $row->von);
			$wochentage = array('So','Mo','Di','Mi','Do','Fr','Sa');
			echo $wochentage[$t].", ".$von;
			$t = date('w', $row->bis);
			if(strcmp($von, $bis)!=0) echo " - ".$wochentage[$t].", ".$bis;
		}
		echo "</span><h2>".$row->aktion.'</h2></header><div class="container">';
		$id = $row->id;
		$ergebnisseneu = $wpdb->get_results("SELECT * FROM $table_bilder WHERE aktion='$id' ORDER BY datei");
		foreach ( $ergebnisseneu as $rowfl ) {
			$url = get_site_url().'/wp-content/themes/pfadfinder-rott/bilder/uploader/server/php/files/notbig/'.$rowfl->datei;
			$url2 = get_site_url().'/wp-content/themes/pfadfinder-rott/bilder/uploader/server/php/files/'.$rowfl->datei;
			/* $size = getimagesize($url);
			$left = round(($size[0]-140)/2);
			$top = round(($size[1]-140)/2);
			echo '<div class="picture"><a class="grouped_elements" rel="group'.$row->id.'" href="'.$url2.'"><img title="'.$rowfl->titel.'" src="'.$url.'" width="'.$size[0].'" height="'.$size[1].'" alt style="margin-left:-'.$left.'px; margin-top:-'.$top.'px;" /></a></div>'; */
			echo '<div class="picture"><a class="grouped_elements" rel="group'.$row->id.'" href="'.$url2.'"><img title="'.$rowfl->titel.'" src="'.$url.'" alt /></a></div>';
		}
		echo '</div><br style="clear:both;" /><footer style="padding-top:0px;"></footer></article>';
	}
}
?>


<?php get_sidebar(); ?>
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
