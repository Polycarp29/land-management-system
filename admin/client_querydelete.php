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
$client_query_delete = new client_query_delete();

// Run the page
$client_query_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_query_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclient_querydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fclient_querydelete = currentForm = new ew.Form("fclient_querydelete", "delete");
	loadjs.done("fclient_querydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_query_delete->showPageHeader(); ?>
<?php
$client_query_delete->showMessage();
?>
<form name="fclient_querydelete" id="fclient_querydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_query">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($client_query_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($client_query_delete->ClientId->Visible) { // ClientId ?>
		<th class="<?php echo $client_query_delete->ClientId->headerCellClass() ?>"><span id="elh_client_query_ClientId" class="client_query_ClientId"><?php echo $client_query_delete->ClientId->caption() ?></span></th>
<?php } ?>
<?php if ($client_query_delete->Date->Visible) { // Date ?>
		<th class="<?php echo $client_query_delete->Date->headerCellClass() ?>"><span id="elh_client_query_Date" class="client_query_Date"><?php echo $client_query_delete->Date->caption() ?></span></th>
<?php } ?>
<?php if ($client_query_delete->Status->Visible) { // Status ?>
		<th class="<?php echo $client_query_delete->Status->headerCellClass() ?>"><span id="elh_client_query_Status" class="client_query_Status"><?php echo $client_query_delete->Status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$client_query_delete->RecordCount = 0;
$i = 0;
while (!$client_query_delete->Recordset->EOF) {
	$client_query_delete->RecordCount++;
	$client_query_delete->RowCount++;

	// Set row properties
	$client_query->resetAttributes();
	$client_query->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$client_query_delete->loadRowValues($client_query_delete->Recordset);

	// Render row
	$client_query_delete->renderRow();
?>
	<tr <?php echo $client_query->rowAttributes() ?>>
<?php if ($client_query_delete->ClientId->Visible) { // ClientId ?>
		<td <?php echo $client_query_delete->ClientId->cellAttributes() ?>>
<span id="el<?php echo $client_query_delete->RowCount ?>_client_query_ClientId" class="client_query_ClientId">
<span<?php echo $client_query_delete->ClientId->viewAttributes() ?>><?php echo $client_query_delete->ClientId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_query_delete->Date->Visible) { // Date ?>
		<td <?php echo $client_query_delete->Date->cellAttributes() ?>>
<span id="el<?php echo $client_query_delete->RowCount ?>_client_query_Date" class="client_query_Date">
<span<?php echo $client_query_delete->Date->viewAttributes() ?>><?php echo $client_query_delete->Date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($client_query_delete->Status->Visible) { // Status ?>
		<td <?php echo $client_query_delete->Status->cellAttributes() ?>>
<span id="el<?php echo $client_query_delete->RowCount ?>_client_query_Status" class="client_query_Status">
<span<?php echo $client_query_delete->Status->viewAttributes() ?>><?php echo $client_query_delete->Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$client_query_delete->Recordset->moveNext();
}
$client_query_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_query_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$client_query_delete->showPageFooter();
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
$client_query_delete->terminate();
?>