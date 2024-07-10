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
$client_query_view = new client_query_view();

// Run the page
$client_query_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_query_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$client_query_view->isExport()) { ?>
<script>
var fclient_queryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fclient_queryview = currentForm = new ew.Form("fclient_queryview", "view");
	loadjs.done("fclient_queryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$client_query_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $client_query_view->ExportOptions->render("body") ?>
<?php $client_query_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $client_query_view->showPageHeader(); ?>
<?php
$client_query_view->showMessage();
?>
<?php if (!$client_query_view->IsModal) { ?>
<?php if (!$client_query_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_query_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fclient_queryview" id="fclient_queryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_query">
<input type="hidden" name="modal" value="<?php echo (int)$client_query_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($client_query_view->ClientId->Visible) { // ClientId ?>
	<tr id="r_ClientId">
		<td class="<?php echo $client_query_view->TableLeftColumnClass ?>"><span id="elh_client_query_ClientId"><?php echo $client_query_view->ClientId->caption() ?></span></td>
		<td data-name="ClientId" <?php echo $client_query_view->ClientId->cellAttributes() ?>>
<span id="el_client_query_ClientId">
<span<?php echo $client_query_view->ClientId->viewAttributes() ?>><?php echo $client_query_view->ClientId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_query_view->Query->Visible) { // Query ?>
	<tr id="r_Query">
		<td class="<?php echo $client_query_view->TableLeftColumnClass ?>"><span id="elh_client_query_Query"><?php echo $client_query_view->Query->caption() ?></span></td>
		<td data-name="Query" <?php echo $client_query_view->Query->cellAttributes() ?>>
<span id="el_client_query_Query">
<span<?php echo $client_query_view->Query->viewAttributes() ?>><?php echo $client_query_view->Query->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_query_view->Reply->Visible) { // Reply ?>
	<tr id="r_Reply">
		<td class="<?php echo $client_query_view->TableLeftColumnClass ?>"><span id="elh_client_query_Reply"><?php echo $client_query_view->Reply->caption() ?></span></td>
		<td data-name="Reply" <?php echo $client_query_view->Reply->cellAttributes() ?>>
<span id="el_client_query_Reply">
<span<?php echo $client_query_view->Reply->viewAttributes() ?>><?php echo $client_query_view->Reply->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_query_view->Date->Visible) { // Date ?>
	<tr id="r_Date">
		<td class="<?php echo $client_query_view->TableLeftColumnClass ?>"><span id="elh_client_query_Date"><?php echo $client_query_view->Date->caption() ?></span></td>
		<td data-name="Date" <?php echo $client_query_view->Date->cellAttributes() ?>>
<span id="el_client_query_Date">
<span<?php echo $client_query_view->Date->viewAttributes() ?>><?php echo $client_query_view->Date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_query_view->Status->Visible) { // Status ?>
	<tr id="r_Status">
		<td class="<?php echo $client_query_view->TableLeftColumnClass ?>"><span id="elh_client_query_Status"><?php echo $client_query_view->Status->caption() ?></span></td>
		<td data-name="Status" <?php echo $client_query_view->Status->cellAttributes() ?>>
<span id="el_client_query_Status">
<span<?php echo $client_query_view->Status->viewAttributes() ?>><?php echo $client_query_view->Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$client_query_view->IsModal) { ?>
<?php if (!$client_query_view->isExport()) { ?>
<?php echo $client_query_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$client_query_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$client_query_view->isExport()) { ?>
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
$client_query_view->terminate();
?>