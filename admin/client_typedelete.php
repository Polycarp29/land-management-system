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
$client_type_delete = new client_type_delete();

// Run the page
$client_type_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_type_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclient_typedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fclient_typedelete = currentForm = new ew.Form("fclient_typedelete", "delete");
	loadjs.done("fclient_typedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_type_delete->showPageHeader(); ?>
<?php
$client_type_delete->showMessage();
?>
<form name="fclient_typedelete" id="fclient_typedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_type">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($client_type_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($client_type_delete->ClientType->Visible) { // ClientType ?>
		<th class="<?php echo $client_type_delete->ClientType->headerCellClass() ?>"><span id="elh_client_type_ClientType" class="client_type_ClientType"><?php echo $client_type_delete->ClientType->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$client_type_delete->RecordCount = 0;
$i = 0;
while (!$client_type_delete->Recordset->EOF) {
	$client_type_delete->RecordCount++;
	$client_type_delete->RowCount++;

	// Set row properties
	$client_type->resetAttributes();
	$client_type->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$client_type_delete->loadRowValues($client_type_delete->Recordset);

	// Render row
	$client_type_delete->renderRow();
?>
	<tr <?php echo $client_type->rowAttributes() ?>>
<?php if ($client_type_delete->ClientType->Visible) { // ClientType ?>
		<td <?php echo $client_type_delete->ClientType->cellAttributes() ?>>
<span id="el<?php echo $client_type_delete->RowCount ?>_client_type_ClientType" class="client_type_ClientType">
<span<?php echo $client_type_delete->ClientType->viewAttributes() ?>><?php echo $client_type_delete->ClientType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$client_type_delete->Recordset->moveNext();
}
$client_type_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_type_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$client_type_delete->showPageFooter();
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
$client_type_delete->terminate();
?>