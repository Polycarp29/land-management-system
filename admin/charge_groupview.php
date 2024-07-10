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
$charge_group_view = new charge_group_view();

// Run the page
$charge_group_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charge_group_view->isExport()) { ?>
<script>
var fcharge_groupview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcharge_groupview = currentForm = new ew.Form("fcharge_groupview", "view");
	loadjs.done("fcharge_groupview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$charge_group_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $charge_group_view->ExportOptions->render("body") ?>
<?php $charge_group_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $charge_group_view->showPageHeader(); ?>
<?php
$charge_group_view->showMessage();
?>
<?php if (!$charge_group_view->IsModal) { ?>
<?php if (!$charge_group_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_group_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcharge_groupview" id="fcharge_groupview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<input type="hidden" name="modal" value="<?php echo (int)$charge_group_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($charge_group_view->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
	<tr id="r_ChargeGroupCode">
		<td class="<?php echo $charge_group_view->TableLeftColumnClass ?>"><span id="elh_charge_group_ChargeGroupCode"><?php echo $charge_group_view->ChargeGroupCode->caption() ?></span></td>
		<td data-name="ChargeGroupCode" <?php echo $charge_group_view->ChargeGroupCode->cellAttributes() ?>>
<span id="el_charge_group_ChargeGroupCode">
<span<?php echo $charge_group_view->ChargeGroupCode->viewAttributes() ?>><?php echo $charge_group_view->ChargeGroupCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charge_group_view->ChargeGroupName->Visible) { // ChargeGroupName ?>
	<tr id="r_ChargeGroupName">
		<td class="<?php echo $charge_group_view->TableLeftColumnClass ?>"><span id="elh_charge_group_ChargeGroupName"><?php echo $charge_group_view->ChargeGroupName->caption() ?></span></td>
		<td data-name="ChargeGroupName" <?php echo $charge_group_view->ChargeGroupName->cellAttributes() ?>>
<span id="el_charge_group_ChargeGroupName">
<span<?php echo $charge_group_view->ChargeGroupName->viewAttributes() ?>><?php echo $charge_group_view->ChargeGroupName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$charge_group_view->IsModal) { ?>
<?php if (!$charge_group_view->isExport()) { ?>
<?php echo $charge_group_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$charge_group_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charge_group_view->isExport()) { ?>
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
$charge_group_view->terminate();
?>