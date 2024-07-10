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
$property_type_delete = new property_type_delete();

// Run the page
$property_type_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_typedelete = currentForm = new ew.Form("fproperty_typedelete", "delete");
	loadjs.done("fproperty_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_type_delete->showPageHeader(); ?>
<?php
$property_type_delete->showMessage();
?>
<form name="fproperty_typedelete" id="fproperty_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_type_delete->PropertyTypeCode->Visible) { // PropertyTypeCode ?>
		<th class="<?php echo $property_type_delete->PropertyTypeCode->headerCellClass() ?>"><span id="elh_property_type_PropertyTypeCode" class="property_type_PropertyTypeCode"><?php echo $property_type_delete->PropertyTypeCode->caption() ?></span></th>
<?php } ?>
<?php if ($property_type_delete->PropertyType->Visible) { // PropertyType ?>
		<th class="<?php echo $property_type_delete->PropertyType->headerCellClass() ?>"><span id="elh_property_type_PropertyType" class="property_type_PropertyType"><?php echo $property_type_delete->PropertyType->caption() ?></span></th>
<?php } ?>
<?php if ($property_type_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $property_type_delete->PropertyUse->headerCellClass() ?>"><span id="elh_property_type_PropertyUse" class="property_type_PropertyUse"><?php echo $property_type_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_type_delete->RecordCount = 0;
$i = 0;
while (!$property_type_delete->Recordset->EOF) {
	$property_type_delete->RecordCount++;
	$property_type_delete->RowCount++;

	// Set row properties
	$property_type->resetAttributes();
	$property_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_type_delete->loadRowValues($property_type_delete->Recordset);

	// Render row
	$property_type_delete->renderRow();
?>
	<tr <?php echo $property_type->rowAttributes() ?>>
<?php if ($property_type_delete->PropertyTypeCode->Visible) { // PropertyTypeCode ?>
		<td <?php echo $property_type_delete->PropertyTypeCode->cellAttributes() ?>>
<span id="el<?php echo $property_type_delete->RowCount ?>_property_type_PropertyTypeCode" class="property_type_PropertyTypeCode">
<span<?php echo $property_type_delete->PropertyTypeCode->viewAttributes() ?>><?php echo $property_type_delete->PropertyTypeCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_type_delete->PropertyType->Visible) { // PropertyType ?>
		<td <?php echo $property_type_delete->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_type_delete->RowCount ?>_property_type_PropertyType" class="property_type_PropertyType">
<span<?php echo $property_type_delete->PropertyType->viewAttributes() ?>><?php echo $property_type_delete->PropertyType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($property_type_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $property_type_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_type_delete->RowCount ?>_property_type_PropertyUse" class="property_type_PropertyUse">
<span<?php echo $property_type_delete->PropertyUse->viewAttributes() ?>><?php echo $property_type_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_type_delete->Recordset->moveNext();
}
$property_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_type_delete->showPageFooter();
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
$property_type_delete->terminate();
?>