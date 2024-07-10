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
$property_delete = new property_delete();

// Run the page
$property_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpropertydelete = currentForm = new ew.Form("fpropertydelete", "delete");
	loadjs.done("fpropertydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_delete->showPageHeader(); ?>
<?php
$property_delete->showMessage();
?>
<form name="fpropertydelete" id="fpropertydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_delete->id->Visible) { // id ?>
		<th class="<?php echo $property_delete->id->headerCellClass() ?>"><span id="elh_property_id" class="property_id"><?php echo $property_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ClientId->Visible) { // ClientId ?>
		<th class="<?php echo $property_delete->ClientId->headerCellClass() ?>"><span id="elh_property_ClientId" class="property_ClientId"><?php echo $property_delete->ClientId->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<th class="<?php echo $property_delete->ChargeGroup->headerCellClass() ?>"><span id="elh_property_ChargeGroup" class="property_ChargeGroup"><?php echo $property_delete->ChargeGroup->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<th class="<?php echo $property_delete->ChargeGropuDes->headerCellClass() ?>"><span id="elh_property_ChargeGropuDes" class="property_ChargeGropuDes"><?php echo $property_delete->ChargeGropuDes->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->ChargeableFee->Visible) { // ChargeableFee ?>
		<th class="<?php echo $property_delete->ChargeableFee->headerCellClass() ?>"><span id="elh_property_ChargeableFee" class="property_ChargeableFee"><?php echo $property_delete->ChargeableFee->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->BalanceBF->Visible) { // BalanceBF ?>
		<th class="<?php echo $property_delete->BalanceBF->headerCellClass() ?>"><span id="elh_property_BalanceBF" class="property_BalanceBF"><?php echo $property_delete->BalanceBF->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->AmountPayable->Visible) { // AmountPayable ?>
		<th class="<?php echo $property_delete->AmountPayable->headerCellClass() ?>"><span id="elh_property_AmountPayable" class="property_AmountPayable"><?php echo $property_delete->AmountPayable->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Property->Visible) { // Property ?>
		<th class="<?php echo $property_delete->Property->headerCellClass() ?>"><span id="elh_property_Property" class="property_Property"><?php echo $property_delete->Property->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->PropertyId->Visible) { // PropertyId ?>
		<th class="<?php echo $property_delete->PropertyId->headerCellClass() ?>"><span id="elh_property_PropertyId" class="property_PropertyId"><?php echo $property_delete->PropertyId->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $property_delete->PropertyUse->headerCellClass() ?>"><span id="elh_property_PropertyUse" class="property_PropertyUse"><?php echo $property_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Location->Visible) { // Location ?>
		<th class="<?php echo $property_delete->Location->headerCellClass() ?>"><span id="elh_property_Location" class="property_Location"><?php echo $property_delete->Location->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $property_delete->AmountPaid->headerCellClass() ?>"><span id="elh_property_AmountPaid" class="property_AmountPaid"><?php echo $property_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->CurrentBalance->Visible) { // CurrentBalance ?>
		<th class="<?php echo $property_delete->CurrentBalance->headerCellClass() ?>"><span id="elh_property_CurrentBalance" class="property_CurrentBalance"><?php echo $property_delete->CurrentBalance->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->DataRegistered->Visible) { // DataRegistered ?>
		<th class="<?php echo $property_delete->DataRegistered->headerCellClass() ?>"><span id="elh_property_DataRegistered" class="property_DataRegistered"><?php echo $property_delete->DataRegistered->caption() ?></span></th>
<?php } ?>
<?php if ($property_delete->Status->Visible) { // Status ?>
		<th class="<?php echo $property_delete->Status->headerCellClass() ?>"><span id="elh_property_Status" class="property_Status"><?php echo $property_delete->Status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_delete->RecordCount = 0;
$i = 0;
while (!$property_delete->Recordset->EOF) {
	$property_delete->RecordCount++;
	$property_delete->RowCount++;

	// Set row properties
	$property->resetAttributes();
	$property->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_delete->loadRowValues($property_delete->Recordset);

	// Render row
	$property_delete->renderRow();
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php if ($property_delete->id->Visible) { // id ?>
		<td <?php echo $property_delete->id->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_id" class="property_id">
<span<?php echo $property_delete->id->viewAttributes() ?>><?php echo $property_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ClientId->Visible) { // ClientId ?>
		<td <?php echo $property_delete->ClientId->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ClientId" class="property_ClientId">
<span<?php echo $property_delete->ClientId->viewAttributes() ?>><?php echo $property_delete->ClientId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<td <?php echo $property_delete->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ChargeGroup" class="property_ChargeGroup">
<span<?php echo $property_delete->ChargeGroup->viewAttributes() ?>><?php echo $property_delete->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<td <?php echo $property_delete->ChargeGropuDes->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ChargeGropuDes" class="property_ChargeGropuDes">
<span<?php echo $property_delete->ChargeGropuDes->viewAttributes() ?>><?php echo $property_delete->ChargeGropuDes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->ChargeableFee->Visible) { // ChargeableFee ?>
		<td <?php echo $property_delete->ChargeableFee->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_ChargeableFee" class="property_ChargeableFee">
<span<?php echo $property_delete->ChargeableFee->viewAttributes() ?>><?php echo $property_delete->ChargeableFee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->BalanceBF->Visible) { // BalanceBF ?>
		<td <?php echo $property_delete->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_BalanceBF" class="property_BalanceBF">
<span<?php echo $property_delete->BalanceBF->viewAttributes() ?>><?php echo $property_delete->BalanceBF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->AmountPayable->Visible) { // AmountPayable ?>
		<td <?php echo $property_delete->AmountPayable->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_AmountPayable" class="property_AmountPayable">
<span<?php echo $property_delete->AmountPayable->viewAttributes() ?>><?php echo $property_delete->AmountPayable->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Property->Visible) { // Property ?>
		<td <?php echo $property_delete->Property->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Property" class="property_Property">
<span<?php echo $property_delete->Property->viewAttributes() ?>><?php echo $property_delete->Property->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->PropertyId->Visible) { // PropertyId ?>
		<td <?php echo $property_delete->PropertyId->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyId" class="property_PropertyId">
<span<?php echo $property_delete->PropertyId->viewAttributes() ?>><?php echo $property_delete->PropertyId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $property_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_PropertyUse" class="property_PropertyUse">
<span<?php echo $property_delete->PropertyUse->viewAttributes() ?>><?php echo $property_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Location->Visible) { // Location ?>
		<td <?php echo $property_delete->Location->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Location" class="property_Location">
<span<?php echo $property_delete->Location->viewAttributes() ?>><?php echo $property_delete->Location->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $property_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_AmountPaid" class="property_AmountPaid">
<span<?php echo $property_delete->AmountPaid->viewAttributes() ?>><?php echo $property_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->CurrentBalance->Visible) { // CurrentBalance ?>
		<td <?php echo $property_delete->CurrentBalance->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_CurrentBalance" class="property_CurrentBalance">
<span<?php echo $property_delete->CurrentBalance->viewAttributes() ?>><?php echo $property_delete->CurrentBalance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->DataRegistered->Visible) { // DataRegistered ?>
		<td <?php echo $property_delete->DataRegistered->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_DataRegistered" class="property_DataRegistered">
<span<?php echo $property_delete->DataRegistered->viewAttributes() ?>><?php echo $property_delete->DataRegistered->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_delete->Status->Visible) { // Status ?>
		<td <?php echo $property_delete->Status->cellAttributes() ?>>
<span id="el<?php echo $property_delete->RowCount ?>_property_Status" class="property_Status">
<span<?php echo $property_delete->Status->viewAttributes() ?>><?php echo $property_delete->Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_delete->Recordset->moveNext();
}
$property_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_delete->showPageFooter();
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
$property_delete->terminate();
?>