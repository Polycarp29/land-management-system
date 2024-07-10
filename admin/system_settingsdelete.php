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
$system_settings_delete = new system_settings_delete();

// Run the page
$system_settings_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$system_settings_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsystem_settingsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsystem_settingsdelete = currentForm = new ew.Form("fsystem_settingsdelete", "delete");
	loadjs.done("fsystem_settingsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $system_settings_delete->showPageHeader(); ?>
<?php
$system_settings_delete->showMessage();
?>
<form name="fsystem_settingsdelete" id="fsystem_settingsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="system_settings">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($system_settings_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($system_settings_delete->name->Visible) { // name ?>
		<th class="<?php echo $system_settings_delete->name->headerCellClass() ?>"><span id="elh_system_settings_name" class="system_settings_name"><?php echo $system_settings_delete->name->caption() ?></span></th>
<?php } ?>
<?php if ($system_settings_delete->_email->Visible) { // email ?>
		<th class="<?php echo $system_settings_delete->_email->headerCellClass() ?>"><span id="elh_system_settings__email" class="system_settings__email"><?php echo $system_settings_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($system_settings_delete->contact->Visible) { // contact ?>
		<th class="<?php echo $system_settings_delete->contact->headerCellClass() ?>"><span id="elh_system_settings_contact" class="system_settings_contact"><?php echo $system_settings_delete->contact->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$system_settings_delete->RecordCount = 0;
$i = 0;
while (!$system_settings_delete->Recordset->EOF) {
	$system_settings_delete->RecordCount++;
	$system_settings_delete->RowCount++;

	// Set row properties
	$system_settings->resetAttributes();
	$system_settings->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$system_settings_delete->loadRowValues($system_settings_delete->Recordset);

	// Render row
	$system_settings_delete->renderRow();
?>
	<tr <?php echo $system_settings->rowAttributes() ?>>
<?php if ($system_settings_delete->name->Visible) { // name ?>
		<td <?php echo $system_settings_delete->name->cellAttributes() ?>>
<span id="el<?php echo $system_settings_delete->RowCount ?>_system_settings_name" class="system_settings_name">
<span<?php echo $system_settings_delete->name->viewAttributes() ?>><?php echo $system_settings_delete->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($system_settings_delete->_email->Visible) { // email ?>
		<td <?php echo $system_settings_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $system_settings_delete->RowCount ?>_system_settings__email" class="system_settings__email">
<span<?php echo $system_settings_delete->_email->viewAttributes() ?>><?php echo $system_settings_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($system_settings_delete->contact->Visible) { // contact ?>
		<td <?php echo $system_settings_delete->contact->cellAttributes() ?>>
<span id="el<?php echo $system_settings_delete->RowCount ?>_system_settings_contact" class="system_settings_contact">
<span<?php echo $system_settings_delete->contact->viewAttributes() ?>><?php echo $system_settings_delete->contact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$system_settings_delete->Recordset->moveNext();
}
$system_settings_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $system_settings_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$system_settings_delete->showPageFooter();
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
$system_settings_delete->terminate();
?>