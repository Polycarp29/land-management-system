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
$client_type_view = new client_type_view();

// Run the page
$client_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$client_type_view->isExport()) { ?>
<script>
var fclient_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fclient_typeview = currentForm = new ew.Form("fclient_typeview", "view");
	loadjs.done("fclient_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$client_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $client_type_view->ExportOptions->render("body") ?>
<?php $client_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $client_type_view->showPageHeader(); ?>
<?php
$client_type_view->showMessage();
?>
<?php if (!$client_type_view->IsModal) { ?>
<?php if (!$client_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fclient_typeview" id="fclient_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_type">
<input type="hidden" name="modal" value="<?php echo (int)$client_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($client_type_view->ClientType->Visible) { // ClientType ?>
	<tr id="r_ClientType">
		<td class="<?php echo $client_type_view->TableLeftColumnClass ?>"><span id="elh_client_type_ClientType"><?php echo $client_type_view->ClientType->caption() ?></span></td>
		<td data-name="ClientType" <?php echo $client_type_view->ClientType->cellAttributes() ?>>
<span id="el_client_type_ClientType">
<span<?php echo $client_type_view->ClientType->viewAttributes() ?>><?php echo $client_type_view->ClientType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$client_type_view->IsModal) { ?>
<?php if (!$client_type_view->isExport()) { ?>
<?php echo $client_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$client_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$client_type_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$client_type_view->terminate();
?>