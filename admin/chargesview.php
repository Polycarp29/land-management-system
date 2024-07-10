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
$charges_view = new charges_view();

// Run the page
$charges_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charges_view->isExport()) { ?>
<script>
var fchargesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fchargesview = currentForm = new ew.Form("fchargesview", "view");
	loadjs.done("fchargesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$charges_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $charges_view->ExportOptions->render("body") ?>
<?php $charges_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $charges_view->showPageHeader(); ?>
<?php
$charges_view->showMessage();
?>
<?php if (!$charges_view->IsModal) { ?>
<?php if (!$charges_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fchargesview" id="fchargesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<input type="hidden" name="modal" value="<?php echo (int)$charges_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($charges_view->ChargeCode->Visible) { // ChargeCode ?>
	<tr id="r_ChargeCode">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_ChargeCode"><?php echo $charges_view->ChargeCode->caption() ?></span></td>
		<td data-name="ChargeCode" <?php echo $charges_view->ChargeCode->cellAttributes() ?>>
<span id="el_charges_ChargeCode">
<span<?php echo $charges_view->ChargeCode->viewAttributes() ?>><?php echo $charges_view->ChargeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_ChargeGroup"><?php echo $charges_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $charges_view->ChargeGroup->cellAttributes() ?>>
<span id="el_charges_ChargeGroup">
<span<?php echo $charges_view->ChargeGroup->viewAttributes() ?>><?php echo $charges_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->ChargeDesc->Visible) { // ChargeDesc ?>
	<tr id="r_ChargeDesc">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_ChargeDesc"><?php echo $charges_view->ChargeDesc->caption() ?></span></td>
		<td data-name="ChargeDesc" <?php echo $charges_view->ChargeDesc->cellAttributes() ?>>
<span id="el_charges_ChargeDesc">
<span<?php echo $charges_view->ChargeDesc->viewAttributes() ?>><?php echo $charges_view->ChargeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_PropertyUse"><?php echo $charges_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $charges_view->PropertyUse->cellAttributes() ?>>
<span id="el_charges_PropertyUse">
<span<?php echo $charges_view->PropertyUse->viewAttributes() ?>><?php echo $charges_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->Fee->Visible) { // Fee ?>
	<tr id="r_Fee">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_Fee"><?php echo $charges_view->Fee->caption() ?></span></td>
		<td data-name="Fee" <?php echo $charges_view->Fee->cellAttributes() ?>>
<span id="el_charges_Fee">
<span<?php echo $charges_view->Fee->viewAttributes() ?>><?php echo $charges_view->Fee->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->Factor->Visible) { // Factor ?>
	<tr id="r_Factor">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_Factor"><?php echo $charges_view->Factor->caption() ?></span></td>
		<td data-name="Factor" <?php echo $charges_view->Factor->cellAttributes() ?>>
<span id="el_charges_Factor">
<span<?php echo $charges_view->Factor->viewAttributes() ?>><?php echo $charges_view->Factor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<tr id="r_UnitOfMeasure">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_UnitOfMeasure"><?php echo $charges_view->UnitOfMeasure->caption() ?></span></td>
		<td data-name="UnitOfMeasure" <?php echo $charges_view->UnitOfMeasure->cellAttributes() ?>>
<span id="el_charges_UnitOfMeasure">
<span<?php echo $charges_view->UnitOfMeasure->viewAttributes() ?>><?php echo $charges_view->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($charges_view->PeriodType->Visible) { // PeriodType ?>
	<tr id="r_PeriodType">
		<td class="<?php echo $charges_view->TableLeftColumnClass ?>"><span id="elh_charges_PeriodType"><?php echo $charges_view->PeriodType->caption() ?></span></td>
		<td data-name="PeriodType" <?php echo $charges_view->PeriodType->cellAttributes() ?>>
<span id="el_charges_PeriodType">
<span<?php echo $charges_view->PeriodType->viewAttributes() ?>><?php echo $charges_view->PeriodType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$charges_view->IsModal) { ?>
<?php if (!$charges_view->isExport()) { ?>
<?php echo $charges_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$charges_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charges_view->isExport()) { ?>
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
$charges_view->terminate();
?>