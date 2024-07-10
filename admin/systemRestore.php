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
$systemRestore = new systemRestore();

// Run the page
$systemRestore->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php //CUSTOME CODE STARTED ?>
<form method="post" action="" enctype="multipart/form-data"
	id="frm-restore">
	<input type="hidden" name="token" value="<?= CurrentPage()->Token ?>" >
		<div>Choose Backup File</div>
		<div>
			<input type="file" name="backup_file" class="input-file" />
		</div>
	<div>
		<input type="submit" name="restore" value="Restore"
			class="btn btn-primary"/>
	</div>
</form>
<?php

if (! empty($_FILES)) {
	// Validating SQL file type by extensions
	if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
		"sql"
	))) {
		$response = array(
			"type" => "error",
			"message" => "Invalid File Type"
		);
	} else {
		if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
			move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
			$response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
		}
	}
}

function restoreMysqlDB($filePath, $conn)
{
	$sql = '';
	$error = '';
	
	if (file_exists($filePath)) {
		$lines = file($filePath);
		
		foreach ($lines as $line) {
			
			// Ignoring comments from the SQL script
			if (substr($line, 0, 2) == '--' || $line == '') {
				continue;
			}
			
			$sql .= $line;
			
			if (substr(trim($line), - 1, 1) == ';') {
				$result = mysqli_query($conn, $sql);
				if (! $result) {
					$error .= mysqli_error($conn) . "\n";
				}
				$sql = '';
			}
		} // end foreach
		
		if ($error) {
			$response = array(
				"type" => "error",
				"message" => $error
			);
		} else {
			$response = array(
				"type" => "success",
				"message" => "Database Restore Completed Successfully."
			);
		}
		exec('rm ' . $filePath);
	} // end if file exists
	
	return $response;
}

?>

<style>
#frm-restore {
	background: #aee5ef;
	padding: 20px;
}

.form-row {
	margin-bottom: 20px;
}

.input-file {
	background: #FFF;
	padding: 10px;
	margin-top: 5px;
}

.btn-action {
	background: #333;
	border: 0;
	padding: 10px 40px;
	color: #FFF;
	border-radius: 2px;
}

.response {
	padding: 10px;
	margin-bottom: 20px;
	border-radius: 2px;
}

.error {
	background: #fbd3d3;
	border: #efc7c7 1px solid;
}

.success {
	background: #cdf3e6;
	border: #bee2d6 1px solid;
}
</style>

<?php
if (! empty($response)) {
	?>
<div class="response <?php echo $response["type"]; ?>">
<?php echo nl2br($response["message"]); ?>
</div>
<?php
}
//CUSTOME CODE ENDED 
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$systemRestore->terminate();
?>