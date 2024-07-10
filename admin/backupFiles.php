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
$backupFiles = new backupFiles();

// Run the page
$backupFiles->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
//START CUSTOME CODE
  $dir = 'DBbackup';

  // Check if the directory exists
  if (file_exists($dir) && is_dir($dir) ) {
	
	  // Get the files of the directory as an array
	  $scan_arr = scandir($dir);
	  $files_arr = array_diff($scan_arr, array('.','..') );

	  // echo "<pre>"; print_r( $files_arr ); echo "</pre>";

	  // Get each files of our directory with line break
	  echo'
		  <table  class="table table-striped table-bordered" cellspacing="0" width="100%" id="myDataTable">
	<thead>
		<tr  style="background-color: #28a745;">
			<th class="text-center">#</th>
			<th>DB BACKUP DETAILS</th>
			<th>DOWNLOAD</th>
			<th>DELETE</th>
		</tr>
	</thead>';
	  $i = 1;
	  foreach ($files_arr as $file) {
		//Get the file path
		$file_path = "DBbackup/".$file;
		// Get the file extension
		$file_ext = pathinfo($file_path, PATHINFO_EXTENSION);
		if ($file_ext=="gz") {
			
		  echo'
	<tbody>
		<tr>
			<td>'.$i++.'</td>
			<td>'.$file.'</td>
			<td><a href="'.$file_path.'" class="btn btn-primary btn-flat make_payment">DOWNLOAD</a></td>
			<td><a href="?file='.$file_path.'" class="btn btn-warning btn-flat make_payment">DELETE</a></td>
		</tr>
	</tbody>';
		}
		
	  }
	  echo'</table>';
  }
  else {
	echo "Dorectory does not exists";
  }
  
  if(ISSET($_GET['file'])){
	$file = $_GET['file']; //get the filename
	unlink($file_path); //delete it
	header('location: backupFiles.php'); //redirect back to the other page
  }
//END CUSTOME CODE
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$backupFiles->terminate();
?>