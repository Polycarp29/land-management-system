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
$property_use_delete = new property_use_delete();

// Run the page
$property_use_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_use_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_usedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fproperty_usedelete = currentForm = new ew.Form("fproperty_usedelete", "delete");
	loadjs.done("fproperty_usedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_use_delete->showPageHeader(); ?>
<?php
$property_use_delete->showMessage();
?>
<form name="fproperty_usedelete" id="fproperty_usedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_use">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($property_use_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($property_use_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $property_use_delete->PropertyUse->headerCellClass() ?>"><span id="elh_property_use_PropertyUse" class="property_use_PropertyUse"><?php echo $property_use_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$property_use_delete->RecordCount = 0;
$i = 0;
while (!$property_use_delete->Recordset->EOF) {
	$property_use_delete->RecordCount++;
	$property_use_delete->RowCount++;

	// Set row properties
	$property_use->resetAttributes();
	$property_use->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$property_use_delete->loadRowValues($property_use_delete->Recordset);

	// Render row
	$property_use_delete->renderRow();
?>
	<tr <?php echo $property_use->rowAttributes() ?>>
<?php if ($property_use_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $property_use_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_use_delete->RowCount ?>_property_use_PropertyUse" class="property_use_PropertyUse">
<span<?php echo $property_use_delete->PropertyUse->viewAttributes() ?>><?php echo $property_use_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$property_use_delete->Recordset->moveNext();
}
$property_use_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_use_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$property_use_delete->showPageFooter();
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
$property_use_delete->terminate();
?>