<?php
if(isset($_GET['file'])) {
	$attachment_location = "./downloads/".$_GET['file'];
	if (file_exists($attachment_location)) {
		header("Cache-Control: public"); // needed for i.e.
		header("Content-Type: application/force-download");
		header("Content-Length:".filesize($attachment_location));
		header("Content-Disposition: attachment; filename=".$_GET['file']);
		readfile($attachment_location);
		die();        
	} else {
		die("Fehler: Datei nicht gefunden.");
	}
} else if(isset($_GET['files']) && isset($_GET['name'])) {
	$files = unserialize(stripslashes($_GET['files']));
	$zipname = urldecode($_GET['name']).".zip";
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	foreach ($files as $file) {
	  $zip->addFile("./downloads/".$file);
	}
	$zip->close();
	header("Cache-Control: public"); // needed for i.e.
	header("Content-Type: application/zip");
	header("Content-Length:".filesize($zipname));
	header("Content-Disposition: attachment; filename=".$zipname);
	readfile($zipname);
	unlink($zipname);
	die();
} else {
	die("Fehler.");
}
?>