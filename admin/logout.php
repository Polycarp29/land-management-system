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
$logout = new logout();

// Run the page
$logout->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());
?>
<?php
$logout->terminate();
?>