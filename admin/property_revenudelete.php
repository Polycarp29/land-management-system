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
$property_revenu_delete = new property_revenu_delete();

// Run the page
$property_revenu_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_revenu_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_revenudelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_revenudelete = currentForm = new ew.Form("fproperty_revenudelete", "delete");
	loadjs.done("fproperty_revenudelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_revenu_delete->showPageHeader(); ?>
<?php
$property_revenu_delete->showMessage();
?>
<form name="fproperty_revenudelete" id="fproperty_revenudelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_revenu">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_revenu_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_revenu_delete->id->Visible) { // id ?>
		<th class="<?php echo $property_revenu_delete->id->headerCellClass() ?>"><span id="elh_property_revenu_id" class="property_revenu_id"><?php echo $property_revenu_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->ClientId->Visible) { // ClientId ?>
		<th class="<?php echo $property_revenu_delete->ClientId->headerCellClass() ?>"><span id="elh_property_revenu_ClientId" class="property_revenu_ClientId"><?php echo $property_revenu_delete->ClientId->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->ClientProperty->Visible) { // ClientProperty ?>
		<th class="<?php echo $property_revenu_delete->ClientProperty->headerCellClass() ?>"><span id="elh_property_revenu_ClientProperty" class="property_revenu_ClientProperty"><?php echo $property_revenu_delete->ClientProperty->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->PropertyId->Visible) { // PropertyId ?>
		<th class="<?php echo $property_revenu_delete->PropertyId->headerCellClass() ?>"><span id="elh_property_revenu_PropertyId" class="property_revenu_PropertyId"><?php echo $property_revenu_delete->PropertyId->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $property_revenu_delete->PropertyUse->headerCellClass() ?>"><span id="elh_property_revenu_PropertyUse" class="property_revenu_PropertyUse"><?php echo $property_revenu_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->AmountPaid->Visible) { // AmountPaid ?>
		<th class="<?php echo $property_revenu_delete->AmountPaid->headerCellClass() ?>"><span id="elh_property_revenu_AmountPaid" class="property_revenu_AmountPaid"><?php echo $property_revenu_delete->AmountPaid->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->Balance->Visible) { // Balance ?>
		<th class="<?php echo $property_revenu_delete->Balance->headerCellClass() ?>"><span id="elh_property_revenu_Balance" class="property_revenu_Balance"><?php echo $property_revenu_delete->Balance->caption() ?></span></th>
<?php } ?>
<?php if ($property_revenu_delete->date->Visible) { // date ?>
		<th class="<?php echo $property_revenu_delete->date->headerCellClass() ?>"><span id="elh_property_revenu_date" class="property_revenu_date"><?php echo $property_revenu_delete->date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_revenu_delete->RecordCount = 0;
$i = 0;
while (!$property_revenu_delete->Recordset->EOF) {
	$property_revenu_delete->RecordCount++;
	$property_revenu_delete->RowCount++;

	// Set row properties
	$property_revenu->resetAttributes();
	$property_revenu->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_revenu_delete->loadRowValues($property_revenu_delete->Recordset);

	// Render row
	$property_revenu_delete->renderRow();
?>
	<tr <?php echo $property_revenu->rowAttributes() ?>>
<?php if ($property_revenu_delete->id->Visible) { // id ?>
		<td <?php echo $property_revenu_delete->id->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_id" class="property_revenu_id">
<span<?php echo $property_revenu_delete->id->viewAttributes() ?>><?php echo $property_revenu_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->ClientId->Visible) { // ClientId ?>
		<td <?php echo $property_revenu_delete->ClientId->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_ClientId" class="property_revenu_ClientId">
<span<?php echo $property_revenu_delete->ClientId->viewAttributes() ?>><?php echo $property_revenu_delete->ClientId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->ClientProperty->Visible) { // ClientProperty ?>
		<td <?php echo $property_revenu_delete->ClientProperty->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_ClientProperty" class="property_revenu_ClientProperty">
<span<?php echo $property_revenu_delete->ClientProperty->viewAttributes() ?>><?php echo $property_revenu_delete->ClientProperty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->PropertyId->Visible) { // PropertyId ?>
		<td <?php echo $property_revenu_delete->PropertyId->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_PropertyId" class="property_revenu_PropertyId">
<span<?php echo $property_revenu_delete->PropertyId->viewAttributes() ?>><?php echo $property_revenu_delete->PropertyId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $property_revenu_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_PropertyUse" class="property_revenu_PropertyUse">
<span<?php echo $property_revenu_delete->PropertyUse->viewAttributes() ?>><?php echo $property_revenu_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->AmountPaid->Visible) { // AmountPaid ?>
		<td <?php echo $property_revenu_delete->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_AmountPaid" class="property_revenu_AmountPaid">
<span<?php echo $property_revenu_delete->AmountPaid->viewAttributes() ?>><?php echo $property_revenu_delete->AmountPaid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->Balance->Visible) { // Balance ?>
		<td <?php echo $property_revenu_delete->Balance->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_Balance" class="property_revenu_Balance">
<span<?php echo $property_revenu_delete->Balance->viewAttributes() ?>><?php echo $property_revenu_delete->Balance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_revenu_delete->date->Visible) { // date ?>
		<td <?php echo $property_revenu_delete->date->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_delete->RowCount ?>_property_revenu_date" class="property_revenu_date">
<span<?php echo $property_revenu_delete->date->viewAttributes() ?>><?php echo $property_revenu_delete->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_revenu_delete->Recordset->moveNext();
}
$property_revenu_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_revenu_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_revenu_delete->showPageFooter();
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
$property_revenu_delete->terminate();
?>