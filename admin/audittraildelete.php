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
$audittrail_delete = new audittrail_delete();

// Run the page
$audittrail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faudittraildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	faudittraildelete = currentForm = new ew.Form("faudittraildelete", "delete");
	loadjs.done("faudittraildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $audittrail_delete->showPageHeader(); ?>
<?php
$audittrail_delete->showMessage();
?>
<form name="faudittraildelete" id="faudittraildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($audittrail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($audittrail_delete->id->Visible) { // id ?>
		<th class="<?php echo $audittrail_delete->id->headerCellClass() ?>"><span id="elh_audittrail_id" class="audittrail_id"><?php echo $audittrail_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail_delete->datetime->Visible) { // datetime ?>
		<th class="<?php echo $audittrail_delete->datetime->headerCellClass() ?>"><span id="elh_audittrail_datetime" class="audittrail_datetime"><?php echo $audittrail_delete->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail_delete->script->Visible) { // script ?>
		<th class="<?php echo $audittrail_delete->script->headerCellClass() ?>"><span id="elh_audittrail_script" class="audittrail_script"><?php echo $audittrail_delete->script->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail_delete->user->Visible) { // user ?>
		<th class="<?php echo $audittrail_delete->user->headerCellClass() ?>"><span id="elh_audittrail_user" class="audittrail_user"><?php echo $audittrail_delete->user->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail_delete->_action->Visible) { // action ?>
		<th class="<?php echo $audittrail_delete->_action->headerCellClass() ?>"><span id="elh_audittrail__action" class="audittrail__action"><?php echo $audittrail_delete->_action->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail_delete->_table->Visible) { // table ?>
		<th class="<?php echo $audittrail_delete->_table->headerCellClass() ?>"><span id="elh_audittrail__table" class="audittrail__table"><?php echo $audittrail_delete->_table->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail_delete->field->Visible) { // field ?>
		<th class="<?php echo $audittrail_delete->field->headerCellClass() ?>"><span id="elh_audittrail_field" class="audittrail_field"><?php echo $audittrail_delete->field->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$audittrail_delete->RecordCount = 0;
$i = 0;
while (!$audittrail_delete->Recordset->EOF) {
	$audittrail_delete->RecordCount++;
	$audittrail_delete->RowCount++;

	// Set row properties
	$audittrail->resetAttributes();
	$audittrail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$audittrail_delete->loadRowValues($audittrail_delete->Recordset);

	// Render row
	$audittrail_delete->renderRow();
?>
	<tr <?php echo $audittrail->rowAttributes() ?>>
<?php if ($audittrail_delete->id->Visible) { // id ?>
		<td <?php echo $audittrail_delete->id->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail_id" class="audittrail_id">
<span<?php echo $audittrail_delete->id->viewAttributes() ?>><?php echo $audittrail_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail_delete->datetime->Visible) { // datetime ?>
		<td <?php echo $audittrail_delete->datetime->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail_datetime" class="audittrail_datetime">
<span<?php echo $audittrail_delete->datetime->viewAttributes() ?>><?php echo $audittrail_delete->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail_delete->script->Visible) { // script ?>
		<td <?php echo $audittrail_delete->script->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail_script" class="audittrail_script">
<span<?php echo $audittrail_delete->script->viewAttributes() ?>><?php echo $audittrail_delete->script->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail_delete->user->Visible) { // user ?>
		<td <?php echo $audittrail_delete->user->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail_user" class="audittrail_user">
<span<?php echo $audittrail_delete->user->viewAttributes() ?>><?php echo $audittrail_delete->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail_delete->_action->Visible) { // action ?>
		<td <?php echo $audittrail_delete->_action->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail__action" class="audittrail__action">
<span<?php echo $audittrail_delete->_action->viewAttributes() ?>><?php echo $audittrail_delete->_action->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail_delete->_table->Visible) { // table ?>
		<td <?php echo $audittrail_delete->_table->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail__table" class="audittrail__table">
<span<?php echo $audittrail_delete->_table->viewAttributes() ?>><?php echo $audittrail_delete->_table->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail_delete->field->Visible) { // field ?>
		<td <?php echo $audittrail_delete->field->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCount ?>_audittrail_field" class="audittrail_field">
<span<?php echo $audittrail_delete->field->viewAttributes() ?>><?php echo $audittrail_delete->field->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$audittrail_delete->Recordset->moveNext();
}
$audittrail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $audittrail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$audittrail_delete->showPageFooter();
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
$audittrail_delete->terminate();
?>