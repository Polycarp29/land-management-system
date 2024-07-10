<?php
namespace PHPMaker2020\revenue;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$propertyReceipt = new propertyReceipt();

// Run the page
$propertyReceipt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
//=========Custom Code Start===============
$content = '';
$pageNumber = 1;

$q = ("SELECT * FROM property WHERE ClientId = '$ClientId' AND id = '$ClientProperty' ");

$rows = ExecuteRows($q);
$content .= '
		<style>
			table{
				margin: auto
			}
			tfoot .total{
				text-align left
			}
	   </style>
	<table cellspacing="0" cellpadding="1" width="100%" border="1" style="border-bottom: 0; margin-top:20px;">
		<tr><th colspan="4" style="background-color:lightgrey">LedgerAccount: '.$row['ClientId'].'</th></tr>
			<tr style="background-color:lightgrey"><th colspan="2">OpeningBalance:</th> <th colspan="2">ClosingBalance:</th></tr>
			<tr><th>AccountName</th><th>ReferenceNumber</th><th>Debit</th><th>Credit</th></tr>';
			
 foreach($rows as $row){
	 
$content .= '
		<tr><td>'.$row['ClientId'].'</td><td>'.$row['ClientId'].'</td><td>'.$row['ClientId'].'</td><td>'.$row['ClientId'].'</td></tr>
		';
	}

set_time_limit(300000);
ini_set('memory_limit','2048M');
// Load Dompdf
use Dompdf\Dompdf;

// Clear Buffer - this is very important!!!
ob_get_clean();

// File to be downloaded
$file = "RCS Receipt.pdf";

// HTML to convert to PDF
$html = "";
$html .= '<div style="font-size:8px; font-family:helvetica; margin-bottom: 50px">
	<div style="width: 300px; margin: auto; margin-bottom: 15px; margin-top: -20px;">
		<p> <center><img src="logo.png" style="width: 80px; height: 80px;"></center> </p>
		<p style="font-size:10px;">
			<br><span style="font-weight:bold"><center>HEAVY DUTY OPERATORS COLLEGE <br/>OF ZAMBIA</center></span> <br>
			<span style="margin-left: 35px;"><center>Payment Reciept</center></span>
		</p>
	</div>';

$content .= '</table>';
$html .= $content;

// Create the PDF
$dompdf = new DOMPDF();
$dompdf->set_paper("A4", "portrait");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream($file);
$output = $dompdf->output();
//Save pdf TrialBalance to file
file_put_contents("files/".$file, $output);
$document->stream("RCS Receipt", array("Attachment"=>0));

//========Custome Code End======================
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$propertyReceipt->terminate();
?>