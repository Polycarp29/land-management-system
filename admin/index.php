<?php
namespace PHPMaker2020\revenue;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data
$index = new index();
$index->run();
?>
<?php include_once "header.php"; ?>
<?php
$index->showMessage();
?>
<?php include_once "footer.php"; ?>