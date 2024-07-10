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
$charge_group_delete = new charge_group_delete();

// Run the page
$charge_group_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_groupdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcharge_groupdelete = currentForm = new ew.Form("fcharge_groupdelete", "delete");
	loadjs.done("fcharge_groupdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_group_delete->showPageHeader(); ?>
<?php
$charge_group_delete->showMessage();
?>
<form name="fcharge_groupdelete" id="fcharge_groupdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($charge_group_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($charge_group_delete->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
		<th class="<?php echo $charge_group_delete->ChargeGroupCode->headerCellClass() ?>"><span id="elh_charge_group_ChargeGroupCode" class="charge_group_ChargeGroupCode"><?php echo $charge_group_delete->ChargeGroupCode->caption() ?></span></th>
<?php } ?>
<?php if ($charge_group_delete->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<th class="<?php echo $charge_group_delete->ChargeGroupName->headerCellClass() ?>"><span id="elh_charge_group_ChargeGroupName" class="charge_group_ChargeGroupName"><?php echo $charge_group_delete->ChargeGroupName->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$charge_group_delete->RecordCount = 0;
$i = 0;
while (!$charge_group_delete->Recordset->EOF) {
	$charge_group_delete->RecordCount++;
	$charge_group_delete->RowCount++;

	// Set row properties
	$charge_group->resetAttributes();
	$charge_group->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$charge_group_delete->loadRowValues($charge_group_delete->Recordset);

	// Render row
	$charge_group_delete->renderRow();
?>
	<tr <?php echo $charge_group->rowAttributes() ?>>
<?php if ($charge_group_delete->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
		<td <?php echo $charge_group_delete->ChargeGroupCode->cellAttributes() ?>>
<span id="el<?php echo $charge_group_delete->RowCount ?>_charge_group_ChargeGroupCode" class="charge_group_ChargeGroupCode">
<span<?php echo $charge_group_delete->ChargeGroupCode->viewAttributes() ?>><?php echo $charge_group_delete->ChargeGroupCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($charge_group_delete->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<td <?php echo $charge_group_delete->ChargeGroupName->cellAttributes() ?>>
<span id="el<?php echo $charge_group_delete->RowCount ?>_charge_group_ChargeGroupName" class="charge_group_ChargeGroupName">
<span<?php echo $charge_group_delete->ChargeGroupName->viewAttributes() ?>><?php echo $charge_group_delete->ChargeGroupName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$charge_group_delete->Recordset->moveNext();
}
$charge_group_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_group_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$charge_group_delete->showPageFooter();
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
$charge_group_delete->terminate();
?>