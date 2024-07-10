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
$charges_delete = new charges_delete();

// Run the page
$charges_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fchargesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fchargesdelete = currentForm = new ew.Form("fchargesdelete", "delete");
	loadjs.done("fchargesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charges_delete->showPageHeader(); ?>
<?php
$charges_delete->showMessage();
?>
<form name="fchargesdelete" id="fchargesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($charges_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($charges_delete->ChargeCode->Visible) { // ChargeCode ?>
		<th class="<?php echo $charges_delete->ChargeCode->headerCellClass() ?>"><span id="elh_charges_ChargeCode" class="charges_ChargeCode"><?php echo $charges_delete->ChargeCode->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<th class="<?php echo $charges_delete->ChargeGroup->headerCellClass() ?>"><span id="elh_charges_ChargeGroup" class="charges_ChargeGroup"><?php echo $charges_delete->ChargeGroup->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->ChargeDesc->Visible) { // ChargeDesc ?>
		<th class="<?php echo $charges_delete->ChargeDesc->headerCellClass() ?>"><span id="elh_charges_ChargeDesc" class="charges_ChargeDesc"><?php echo $charges_delete->ChargeDesc->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $charges_delete->PropertyUse->headerCellClass() ?>"><span id="elh_charges_PropertyUse" class="charges_PropertyUse"><?php echo $charges_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->Fee->Visible) { // Fee ?>
		<th class="<?php echo $charges_delete->Fee->headerCellClass() ?>"><span id="elh_charges_Fee" class="charges_Fee"><?php echo $charges_delete->Fee->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->Factor->Visible) { // Factor ?>
		<th class="<?php echo $charges_delete->Factor->headerCellClass() ?>"><span id="elh_charges_Factor" class="charges_Factor"><?php echo $charges_delete->Factor->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<th class="<?php echo $charges_delete->UnitOfMeasure->headerCellClass() ?>"><span id="elh_charges_UnitOfMeasure" class="charges_UnitOfMeasure"><?php echo $charges_delete->UnitOfMeasure->caption() ?></span></th>
<?php } ?>
<?php if ($charges_delete->PeriodType->Visible) { // PeriodType ?>
		<th class="<?php echo $charges_delete->PeriodType->headerCellClass() ?>"><span id="elh_charges_PeriodType" class="charges_PeriodType"><?php echo $charges_delete->PeriodType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$charges_delete->RecordCount = 0;
$i = 0;
while (!$charges_delete->Recordset->EOF) {
	$charges_delete->RecordCount++;
	$charges_delete->RowCount++;

	// Set row properties
	$charges->resetAttributes();
	$charges->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$charges_delete->loadRowValues($charges_delete->Recordset);

	// Render row
	$charges_delete->renderRow();
?>
	<tr <?php echo $charges->rowAttributes() ?>>
<?php if ($charges_delete->ChargeCode->Visible) { // ChargeCode ?>
		<td <?php echo $charges_delete->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_ChargeCode" class="charges_ChargeCode">
<span<?php echo $charges_delete->ChargeCode->viewAttributes() ?>><?php echo $charges_delete->ChargeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->ChargeGroup->Visible) { // ChargeGroup ?>
		<td <?php echo $charges_delete->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_ChargeGroup" class="charges_ChargeGroup">
<span<?php echo $charges_delete->ChargeGroup->viewAttributes() ?>><?php echo $charges_delete->ChargeGroup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->ChargeDesc->Visible) { // ChargeDesc ?>
		<td <?php echo $charges_delete->ChargeDesc->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_ChargeDesc" class="charges_ChargeDesc">
<span<?php echo $charges_delete->ChargeDesc->viewAttributes() ?>><?php echo $charges_delete->ChargeDesc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $charges_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_PropertyUse" class="charges_PropertyUse">
<span<?php echo $charges_delete->PropertyUse->viewAttributes() ?>><?php echo $charges_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->Fee->Visible) { // Fee ?>
		<td <?php echo $charges_delete->Fee->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_Fee" class="charges_Fee">
<span<?php echo $charges_delete->Fee->viewAttributes() ?>><?php echo $charges_delete->Fee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->Factor->Visible) { // Factor ?>
		<td <?php echo $charges_delete->Factor->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_Factor" class="charges_Factor">
<span<?php echo $charges_delete->Factor->viewAttributes() ?>><?php echo $charges_delete->Factor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td <?php echo $charges_delete->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_UnitOfMeasure" class="charges_UnitOfMeasure">
<span<?php echo $charges_delete->UnitOfMeasure->viewAttributes() ?>><?php echo $charges_delete->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charges_delete->PeriodType->Visible) { // PeriodType ?>
		<td <?php echo $charges_delete->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $charges_delete->RowCount ?>_charges_PeriodType" class="charges_PeriodType">
<span<?php echo $charges_delete->PeriodType->viewAttributes() ?>><?php echo $charges_delete->PeriodType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$charges_delete->Recordset->moveNext();
}
$charges_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charges_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$charges_delete->showPageFooter();
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
$charges_delete->terminate();
?>