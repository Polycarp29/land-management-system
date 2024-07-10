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
$billsPrint = new billsPrint();

// Run the page
$billsPrint->run();

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

$Id = $_GET['Id'];
$sql="SELECT
`client`.`ClientName`
, `client`.`ClientID`
, `client`.`id`
, `client`.`Mobile`
, `client`.`Email`
, `property`.`Property`
, `property`.`PropertyId`
, `property`.`Location`
, `property`.`PropertyUse`
, FORMAT(`property`.`ChargeableFee`,2) AS ChargeableFee
, FORMAT(`property`.`BalanceBF`,2) AS BalanceBF
, FORMAT(`property`.`AmountPayable`,2) AS AmountPayable
,FORMAT(`property`.`AmountPaid`,2) AS AmountPaid
,FORMAT(`property`. `CurrentBalance`,2) AS CurrentBalance
FROM
`client`
LEFT JOIN `property` 
	ON (`client`.`id` = `property`.`ClientId`) WHERE `client`.`id` = '$Id' GROUP BY `property`.`PropertyId` ";
	$rows = ExecuteRows($sql);
	$rrs = ExecuteRow($sql);
	$i = 1;
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
		<tr><th colspan="7" style="background-color:lightgrey">Client Name: '.$rrs['ClientName'].'</th></tr>
		<tr><th colspan="7" style="background-color:lightgrey">Client Number: '.$rrs['ClientID'].'</th></tr>
		<tr><th>Property Num</th><th>Property</th><th>Property Value</th><th>Balance BF</th><th>Amount Due</th><th>Amount Paid</th><th>Balance Due</th></tr>';
	if($rows > 0 ){
			
foreach ($rows as $row){
	 
$content .= '
		<tr><td>'.$row['PropertyId'].'</td><td>'.$row['Property'].'</td><td>ZMK '.$row['ChargeableFee'].'</td><td>ZMK '.$row['BalanceBF'].'</td><td>ZMK '.$row['AmountPayable'].'</td><td>ZMK '.$row['AmountPaid'].'</td><td>ZMK '.$row['CurrentBalance'].'</td></tr>
		';
	}
}else{
$content .= '
		<tr><td colspan="7"><center>No Data Found For Thsis Client</td></tr>
		';
}	

set_time_limit(300000);
ini_set('memory_limit','2048M');
// Load Dompdf
use Dompdf\Dompdf;

// Clear Buffer - this is very important!!!
ob_get_clean();

// File to be downloaded
$file = $row['ClientID'].'-'.$row['ClientName'].' Property-Bill-'.date('d-m-Y').'.pdf';

// HTML to convert to PDF
$html = "";
$html .= '<div style="font-size:8px; font-family:helvetica; margin-bottom: 50px">
	<div style="width: 300px; margin: auto; margin-bottom: 15px; margin-top: -20px;">
		<p> <center><img src="images\revenue-collection-system.jpg" style="width: 80px; height: 80px;"></center> </p>
		<br><br><br><br><br><br>
		<p style="font-size:10px;">
			<br><span style="font-weight:bold"><center>&copy;2021, LAND/PROPERTY RATES DEPARTMENT</center></span> <br>
			<span style="margin-left: 35px;"><center>CLIENT BILL STATEMENT</center></span>
		</p>
	</div><br><br><br><br><br><br><br><br><br><br>';

$content .= '</table>';
$html .= $content;

// echo $html;exit;

// Create the PDF
$dompdf = new DOMPDF();
$dompdf->set_paper("A4", "portrait");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream($file);
$output = $dompdf->output();
//Save pdf TrialBalance to file
file_put_contents("files/".$file, $output);
$document->stream("Property-Bill-Statement", array("Attachment"=>0));

//========Custome Code End======================
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$billsPrint->terminate();
?>