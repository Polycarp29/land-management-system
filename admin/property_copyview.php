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
$property_copy_view = new property_copy_view();

// Run the page
$property_copy_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_copy_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_copy_view->isExport()) { ?>
<script>
var fproperty_copyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_copyview = currentForm = new ew.Form("fproperty_copyview", "view");
	loadjs.done("fproperty_copyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_copy_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_copy_view->ExportOptions->render("body") ?>
<?php $property_copy_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_copy_view->showPageHeader(); ?>
<?php
$property_copy_view->showMessage();
?>
<?php if (!$property_copy_view->IsModal) { ?>
<?php if (!$property_copy_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_copy_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_copyview" id="fproperty_copyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_copy">
<input type="hidden" name="modal" value="<?php echo (int)$property_copy_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_copy_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_id"><?php echo $property_copy_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $property_copy_view->id->cellAttributes() ?>>
<span id="el_property_copy_id">
<span<?php echo $property_copy_view->id->viewAttributes() ?>><?php echo $property_copy_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->ClientId->Visible) { // ClientId ?>
	<tr id="r_ClientId">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_ClientId"><?php echo $property_copy_view->ClientId->caption() ?></span></td>
		<td data-name="ClientId" <?php echo $property_copy_view->ClientId->cellAttributes() ?>>
<span id="el_property_copy_ClientId">
<span<?php echo $property_copy_view->ClientId->viewAttributes() ?>><?php echo $property_copy_view->ClientId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_ChargeGroup"><?php echo $property_copy_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $property_copy_view->ChargeGroup->cellAttributes() ?>>
<span id="el_property_copy_ChargeGroup">
<span<?php echo $property_copy_view->ChargeGroup->viewAttributes() ?>><?php echo $property_copy_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<tr id="r_ChargeGropuDes">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_ChargeGropuDes"><?php echo $property_copy_view->ChargeGropuDes->caption() ?></span></td>
		<td data-name="ChargeGropuDes" <?php echo $property_copy_view->ChargeGropuDes->cellAttributes() ?>>
<span id="el_property_copy_ChargeGropuDes">
<span<?php echo $property_copy_view->ChargeGropuDes->viewAttributes() ?>><?php echo $property_copy_view->ChargeGropuDes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->Property->Visible) { // Property ?>
	<tr id="r_Property">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_Property"><?php echo $property_copy_view->Property->caption() ?></span></td>
		<td data-name="Property" <?php echo $property_copy_view->Property->cellAttributes() ?>>
<span id="el_property_copy_Property">
<span<?php echo $property_copy_view->Property->viewAttributes() ?>><?php echo $property_copy_view->Property->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_PropertyUse"><?php echo $property_copy_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $property_copy_view->PropertyUse->cellAttributes() ?>>
<span id="el_property_copy_PropertyUse">
<span<?php echo $property_copy_view->PropertyUse->viewAttributes() ?>><?php echo $property_copy_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->ChargeableFee->Visible) { // ChargeableFee ?>
	<tr id="r_ChargeableFee">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_ChargeableFee"><?php echo $property_copy_view->ChargeableFee->caption() ?></span></td>
		<td data-name="ChargeableFee" <?php echo $property_copy_view->ChargeableFee->cellAttributes() ?>>
<span id="el_property_copy_ChargeableFee">
<span<?php echo $property_copy_view->ChargeableFee->viewAttributes() ?>><?php echo $property_copy_view->ChargeableFee->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_BalanceBF"><?php echo $property_copy_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $property_copy_view->BalanceBF->cellAttributes() ?>>
<span id="el_property_copy_BalanceBF">
<span<?php echo $property_copy_view->BalanceBF->viewAttributes() ?>><?php echo $property_copy_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->AmountPayable->Visible) { // AmountPayable ?>
	<tr id="r_AmountPayable">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_AmountPayable"><?php echo $property_copy_view->AmountPayable->caption() ?></span></td>
		<td data-name="AmountPayable" <?php echo $property_copy_view->AmountPayable->cellAttributes() ?>>
<span id="el_property_copy_AmountPayable">
<span<?php echo $property_copy_view->AmountPayable->viewAttributes() ?>><?php echo $property_copy_view->AmountPayable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_AmountPaid"><?php echo $property_copy_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $property_copy_view->AmountPaid->cellAttributes() ?>>
<span id="el_property_copy_AmountPaid">
<span<?php echo $property_copy_view->AmountPaid->viewAttributes() ?>><?php echo $property_copy_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->CurrentBalance->Visible) { // CurrentBalance ?>
	<tr id="r_CurrentBalance">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_CurrentBalance"><?php echo $property_copy_view->CurrentBalance->caption() ?></span></td>
		<td data-name="CurrentBalance" <?php echo $property_copy_view->CurrentBalance->cellAttributes() ?>>
<span id="el_property_copy_CurrentBalance">
<span<?php echo $property_copy_view->CurrentBalance->viewAttributes() ?>><?php echo $property_copy_view->CurrentBalance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->DataRegistered->Visible) { // DataRegistered ?>
	<tr id="r_DataRegistered">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_DataRegistered"><?php echo $property_copy_view->DataRegistered->caption() ?></span></td>
		<td data-name="DataRegistered" <?php echo $property_copy_view->DataRegistered->cellAttributes() ?>>
<span id="el_property_copy_DataRegistered">
<span<?php echo $property_copy_view->DataRegistered->viewAttributes() ?>><?php echo $property_copy_view->DataRegistered->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_copy_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $property_copy_view->TableLeftColumnClass ?>"><span id="elh_property_copy_Description"><?php echo $property_copy_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $property_copy_view->Description->cellAttributes() ?>>
<span id="el_property_copy_Description">
<span<?php echo $property_copy_view->Description->viewAttributes() ?>><?php echo $property_copy_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_copy_view->IsModal) { ?>
<?php if (!$property_copy_view->isExport()) { ?>
<?php echo $property_copy_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_copy_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_copy_view->isExport()) { ?>
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
$property_copy_view->terminate();
?>