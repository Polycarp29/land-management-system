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
$property_copy_delete = new property_copy_delete();

// Run the page
$property_copy_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_copy_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_copydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_copydelete = currentForm = new ew.Form("fproperty_copydelete", "delete");
	loadjs.done("fproperty_copydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_copy_delete->showPageHeader(); ?>
<?php
$property_copy_delete->showMessage();
?>
<form name="fproperty_copydelete" id="fproperty_copydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_copy">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_copy_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_copy_delete->id->Visible) { // id ?>
		<th class="<?php echo $property_copy_delete->id->headerCellClass() ?>"><span id="elh_property_copy_id" class="property_copy_id"><?php echo $property_copy_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->ClientId->Visible) { // ClientId ?>
		<th class="<?php echo $property_copy_delete->ClientId->headerCellClass() ?>"><span id="elh_property_copy_ClientId" class="property_copy_ClientId"><?php echo $property_copy_delete->ClientId->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<th class="<?php echo $property_copy_delete->ChargeGroup->headerCellClass() ?>"><span id="elh_property_copy_ChargeGroup" class="property_copy_ChargeGroup"><?php echo $property_copy_delete->ChargeGroup->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<th class="<?php echo $property_copy_delete->ChargeGropuDes->headerCellClass() ?>"><span id="elh_property_copy_ChargeGropuDes" class="property_copy_ChargeGropuDes"><?php echo $property_copy_delete->ChargeGropuDes->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->Property->Visible) { // Property ?>
		<th class="<?php echo $property_copy_delete->Property->headerCellClass() ?>"><span id="elh_property_copy_Property" class="property_copy_Property"><?php echo $property_copy_delete->Property->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $property_copy_delete->PropertyUse->headerCellClass() ?>"><span id="elh_property_copy_PropertyUse" class="property_copy_PropertyUse"><?php echo $property_copy_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->ChargeableFee->Visible) { // ChargeableFee ?>
		<th class="<?php echo $property_copy_delete->ChargeableFee->headerCellClass() ?>"><span id="elh_property_copy_ChargeableFee" class="property_copy_ChargeableFee"><?php echo $property_copy_delete->ChargeableFee->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->BalanceBF->Visible) { // BalanceBF ?>
		<th class="<?php echo $property_copy_delete->BalanceBF->headerCellClass() ?>"><span id="elh_property_copy_BalanceBF" class="property_copy_BalanceBF"><?php echo $property_copy_delete->BalanceBF->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->AmountPayable->Visible) { // AmountPayable ?>
		<th class="<?php echo $property_copy_delete->AmountPayable->headerCellClass() ?>"><span id="elh_property_copy_AmountPayable" class="property_copy_AmountPayable"><?php echo $property_copy_delete->AmountPayable->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $property_copy_delete->AmountPaid->headerCellClass() ?>"><span id="elh_property_copy_AmountPaid" class="property_copy_AmountPaid"><?php echo $property_copy_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->CurrentBalance->Visible) { // CurrentBalance ?>
		<th class="<?php echo $property_copy_delete->CurrentBalance->headerCellClass() ?>"><span id="elh_property_copy_CurrentBalance" class="property_copy_CurrentBalance"><?php echo $property_copy_delete->CurrentBalance->caption() ?></span></th>
<?php } ?>
<?php if ($property_copy_delete->DataRegistered->Visible) { // DataRegistered ?>
		<th class="<?php echo $property_copy_delete->DataRegistered->headerCellClass() ?>"><span id="elh_property_copy_DataRegistered" class="property_copy_DataRegistered"><?php echo $property_copy_delete->DataRegistered->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_copy_delete->RecordCount = 0;
$i = 0;
while (!$property_copy_delete->Recordset->EOF) {
	$property_copy_delete->RecordCount++;
	$property_copy_delete->RowCount++;

	// Set row properties
	$property_copy->resetAttributes();
	$property_copy->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_copy_delete->loadRowValues($property_copy_delete->Recordset);

	// Render row
	$property_copy_delete->renderRow();
?>
	<tr <?php echo $property_copy->rowAttributes() ?>>
<?php if ($property_copy_delete->id->Visible) { // id ?>
		<td <?php echo $property_copy_delete->id->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_id" class="property_copy_id">
<span<?php echo $property_copy_delete->id->viewAttributes() ?>><?php echo $property_copy_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->ClientId->Visible) { // ClientId ?>
		<td <?php echo $property_copy_delete->ClientId->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_ClientId" class="property_copy_ClientId">
<span<?php echo $property_copy_delete->ClientId->viewAttributes() ?>><?php echo $property_copy_delete->ClientId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<td <?php echo $property_copy_delete->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_ChargeGroup" class="property_copy_ChargeGroup">
<span<?php echo $property_copy_delete->ChargeGroup->viewAttributes() ?>><?php echo $property_copy_delete->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<td <?php echo $property_copy_delete->ChargeGropuDes->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_ChargeGropuDes" class="property_copy_ChargeGropuDes">
<span<?php echo $property_copy_delete->ChargeGropuDes->viewAttributes() ?>><?php echo $property_copy_delete->ChargeGropuDes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->Property->Visible) { // Property ?>
		<td <?php echo $property_copy_delete->Property->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_Property" class="property_copy_Property">
<span<?php echo $property_copy_delete->Property->viewAttributes() ?>><?php echo $property_copy_delete->Property->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $property_copy_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_PropertyUse" class="property_copy_PropertyUse">
<span<?php echo $property_copy_delete->PropertyUse->viewAttributes() ?>><?php echo $property_copy_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->ChargeableFee->Visible) { // ChargeableFee ?>
		<td <?php echo $property_copy_delete->ChargeableFee->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_ChargeableFee" class="property_copy_ChargeableFee">
<span<?php echo $property_copy_delete->ChargeableFee->viewAttributes() ?>><?php echo $property_copy_delete->ChargeableFee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->BalanceBF->Visible) { // BalanceBF ?>
		<td <?php echo $property_copy_delete->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_BalanceBF" class="property_copy_BalanceBF">
<span<?php echo $property_copy_delete->BalanceBF->viewAttributes() ?>><?php echo $property_copy_delete->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->AmountPayable->Visible) { // AmountPayable ?>
		<td <?php echo $property_copy_delete->AmountPayable->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_AmountPayable" class="property_copy_AmountPayable">
<span<?php echo $property_copy_delete->AmountPayable->viewAttributes() ?>><?php echo $property_copy_delete->AmountPayable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $property_copy_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_AmountPaid" class="property_copy_AmountPaid">
<span<?php echo $property_copy_delete->AmountPaid->viewAttributes() ?>><?php echo $property_copy_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->CurrentBalance->Visible) { // CurrentBalance ?>
		<td <?php echo $property_copy_delete->CurrentBalance->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_CurrentBalance" class="property_copy_CurrentBalance">
<span<?php echo $property_copy_delete->CurrentBalance->viewAttributes() ?>><?php echo $property_copy_delete->CurrentBalance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_copy_delete->DataRegistered->Visible) { // DataRegistered ?>
		<td <?php echo $property_copy_delete->DataRegistered->cellAttributes() ?>>
<span id="el<?php echo $property_copy_delete->RowCount ?>_property_copy_DataRegistered" class="property_copy_DataRegistered">
<span<?php echo $property_copy_delete->DataRegistered->viewAttributes() ?>><?php echo $property_copy_delete->DataRegistered->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_copy_delete->Recordset->moveNext();
}
$property_copy_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_copy_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_copy_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$property_copy_delete->terminate();
?>