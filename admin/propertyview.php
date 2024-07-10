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
$property_view = new property_view();

// Run the page
$property_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_view->isExport()) { ?>
<script>
var fpropertyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpropertyview = currentForm = new ew.Form("fpropertyview", "view");
	loadjs.done("fpropertyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_view->ExportOptions->render("body") ?>
<?php $property_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_view->showPageHeader(); ?>
<?php
$property_view->showMessage();
?>
<?php if (!$property_view->IsModal) { ?>
<?php if (!$property_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpropertyview" id="fpropertyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="modal" value="<?php echo (int)$property_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_id"><?php echo $property_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $property_view->id->cellAttributes() ?>>
<span id="el_property_id">
<span<?php echo $property_view->id->viewAttributes() ?>><?php echo $property_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ClientId->Visible) { // ClientId ?>
	<tr id="r_ClientId">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ClientId"><?php echo $property_view->ClientId->caption() ?></span></td>
		<td data-name="ClientId" <?php echo $property_view->ClientId->cellAttributes() ?>>
<span id="el_property_ClientId">
<span<?php echo $property_view->ClientId->viewAttributes() ?>><?php echo $property_view->ClientId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ChargeGroup->Visible) { // ChargeGroup ?>
	<tr id="r_ChargeGroup">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ChargeGroup"><?php echo $property_view->ChargeGroup->caption() ?></span></td>
		<td data-name="ChargeGroup" <?php echo $property_view->ChargeGroup->cellAttributes() ?>>
<span id="el_property_ChargeGroup">
<span<?php echo $property_view->ChargeGroup->viewAttributes() ?>><?php echo $property_view->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<tr id="r_ChargeGropuDes">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ChargeGropuDes"><?php echo $property_view->ChargeGropuDes->caption() ?></span></td>
		<td data-name="ChargeGropuDes" <?php echo $property_view->ChargeGropuDes->cellAttributes() ?>>
<span id="el_property_ChargeGropuDes">
<span<?php echo $property_view->ChargeGropuDes->viewAttributes() ?>><?php echo $property_view->ChargeGropuDes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->ChargeableFee->Visible) { // ChargeableFee ?>
	<tr id="r_ChargeableFee">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_ChargeableFee"><?php echo $property_view->ChargeableFee->caption() ?></span></td>
		<td data-name="ChargeableFee" <?php echo $property_view->ChargeableFee->cellAttributes() ?>>
<span id="el_property_ChargeableFee">
<span<?php echo $property_view->ChargeableFee->viewAttributes() ?>><?php echo $property_view->ChargeableFee->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->BalanceBF->Visible) { // BalanceBF ?>
	<tr id="r_BalanceBF">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_BalanceBF"><?php echo $property_view->BalanceBF->caption() ?></span></td>
		<td data-name="BalanceBF" <?php echo $property_view->BalanceBF->cellAttributes() ?>>
<span id="el_property_BalanceBF">
<span<?php echo $property_view->BalanceBF->viewAttributes() ?>><?php echo $property_view->BalanceBF->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->AmountPayable->Visible) { // AmountPayable ?>
	<tr id="r_AmountPayable">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_AmountPayable"><?php echo $property_view->AmountPayable->caption() ?></span></td>
		<td data-name="AmountPayable" <?php echo $property_view->AmountPayable->cellAttributes() ?>>
<span id="el_property_AmountPayable">
<span<?php echo $property_view->AmountPayable->viewAttributes() ?>><?php echo $property_view->AmountPayable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Property->Visible) { // Property ?>
	<tr id="r_Property">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Property"><?php echo $property_view->Property->caption() ?></span></td>
		<td data-name="Property" <?php echo $property_view->Property->cellAttributes() ?>>
<span id="el_property_Property">
<span<?php echo $property_view->Property->viewAttributes() ?>><?php echo $property_view->Property->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PropertyId->Visible) { // PropertyId ?>
	<tr id="r_PropertyId">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyId"><?php echo $property_view->PropertyId->caption() ?></span></td>
		<td data-name="PropertyId" <?php echo $property_view->PropertyId->cellAttributes() ?>>
<span id="el_property_PropertyId">
<span<?php echo $property_view->PropertyId->viewAttributes() ?>><?php echo $property_view->PropertyId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PropertyUse"><?php echo $property_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $property_view->PropertyUse->cellAttributes() ?>>
<span id="el_property_PropertyUse">
<span<?php echo $property_view->PropertyUse->viewAttributes() ?>><?php echo $property_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Location->Visible) { // Location ?>
	<tr id="r_Location">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Location"><?php echo $property_view->Location->caption() ?></span></td>
		<td data-name="Location" <?php echo $property_view->Location->cellAttributes() ?>>
<span id="el_property_Location">
<span<?php echo $property_view->Location->viewAttributes() ?>><?php echo $property_view->Location->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_AmountPaid"><?php echo $property_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $property_view->AmountPaid->cellAttributes() ?>>
<span id="el_property_AmountPaid">
<span<?php echo $property_view->AmountPaid->viewAttributes() ?>><?php echo $property_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->CurrentBalance->Visible) { // CurrentBalance ?>
	<tr id="r_CurrentBalance">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_CurrentBalance"><?php echo $property_view->CurrentBalance->caption() ?></span></td>
		<td data-name="CurrentBalance" <?php echo $property_view->CurrentBalance->cellAttributes() ?>>
<span id="el_property_CurrentBalance">
<span<?php echo $property_view->CurrentBalance->viewAttributes() ?>><?php echo $property_view->CurrentBalance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Description->Visible) { // Description ?>
	<tr id="r_Description">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Description"><?php echo $property_view->Description->caption() ?></span></td>
		<td data-name="Description" <?php echo $property_view->Description->cellAttributes() ?>>
<span id="el_property_Description">
<span<?php echo $property_view->Description->viewAttributes() ?>><?php echo $property_view->Description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->DataRegistered->Visible) { // DataRegistered ?>
	<tr id="r_DataRegistered">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_DataRegistered"><?php echo $property_view->DataRegistered->caption() ?></span></td>
		<td data-name="DataRegistered" <?php echo $property_view->DataRegistered->cellAttributes() ?>>
<span id="el_property_DataRegistered">
<span<?php echo $property_view->DataRegistered->viewAttributes() ?>><?php echo $property_view->DataRegistered->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<tr id="r_PhysicalAddress">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_PhysicalAddress"><?php echo $property_view->PhysicalAddress->caption() ?></span></td>
		<td data-name="PhysicalAddress" <?php echo $property_view->PhysicalAddress->cellAttributes() ?>>
<span id="el_property_PhysicalAddress">
<span<?php echo $property_view->PhysicalAddress->viewAttributes() ?>><?php echo $property_view->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_view->Status->Visible) { // Status ?>
	<tr id="r_Status">
		<td class="<?php echo $property_view->TableLeftColumnClass ?>"><span id="elh_property_Status"><?php echo $property_view->Status->caption() ?></span></td>
		<td data-name="Status" <?php echo $property_view->Status->cellAttributes() ?>>
<span id="el_property_Status">
<span<?php echo $property_view->Status->viewAttributes() ?>><?php echo $property_view->Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_view->IsModal) { ?>
<?php if (!$property_view->isExport()) { ?>
<?php echo $property_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_view->isExport()) { ?>
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
$property_view->terminate();
?>