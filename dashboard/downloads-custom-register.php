<?php
include("../../../../wp-load.php");

if ( !current_user_can( 'publish_posts' ) ) { header('Location: '.get_site_url().'/wp-login.php?redirect_to='.urlencode(get_site_url()).'%2Fwp-content%2Fthemes%2Fpfadfinder-rott%2Fdashboard%2Fdownloads-custom-register.php'); }

require_once(get_template_directory() . '/fpdf17/fpdf.php');
require_once(get_template_directory() . '/fpdi-1.5.4/fpdi.php');

global $current_user;

$pdf = new FPDI();

$pdf->AddPage();
$pdf->setSourceFile(get_template_directory() . '/downloads-custom/anmeldebogen.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);

$role = "Leiter";

if(in_array("rover", $current_user->roles)) {
	$role = "Rover";
}

if(in_array("leiter", $current_user->roles)) {
	$role = "Leiter";
}

if(in_array("stavo", $current_user->roles)) {
	$role = "Stammesvorsitzender";
}

$text = sprintf("%s %s
%s", $current_user->user_firstname, $current_user->user_lastname, $role);

$pdf->SetFont('Helvetica');
$pdf->SetFontSize(11);
$pdf->SetXY(140, 49);
$pdf->MultiCell( 58, 6, $text , 0, 'L', 0);

$pdf->SetFontSize(10);
$pdf->SetXY(140, 65);
$pdf->Cell(0, 6, $current_user->user_login . "@dpsg-rott.de", 0);

$pdf->AddPage();

$tplIdx = $pdf->importPage(2);
$pdf->useTemplate($tplIdx, 0, 0, 0, 0, true);

$pdf->Output("Anmeldebogen.pdf", "D");
?>