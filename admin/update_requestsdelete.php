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
$update_requests_delete = new update_requests_delete();

// Run the page
$update_requests_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$update_requests_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fupdate_requestsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fupdate_requestsdelete = currentForm = new ew.Form("fupdate_requestsdelete", "delete");
	loadjs.done("fupdate_requestsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $update_requests_delete->showPageHeader(); ?>
<?php
$update_requests_delete->showMessage();
?>
<form name="fupdate_requestsdelete" id="fupdate_requestsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="update_requests">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($update_requests_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($update_requests_delete->ClientId->Visible) { // ClientId ?>
		<th class="<?php echo $update_requests_delete->ClientId->headerCellClass() ?>"><span id="elh_update_requests_ClientId" class="update_requests_ClientId"><?php echo $update_requests_delete->ClientId->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->NewClientIdentity->Visible) { // NewClientIdentity ?>
		<th class="<?php echo $update_requests_delete->NewClientIdentity->headerCellClass() ?>"><span id="elh_update_requests_NewClientIdentity" class="update_requests_NewClientIdentity"><?php echo $update_requests_delete->NewClientIdentity->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->NewClientName->Visible) { // NewClientName ?>
		<th class="<?php echo $update_requests_delete->NewClientName->headerCellClass() ?>"><span id="elh_update_requests_NewClientName" class="update_requests_NewClientName"><?php echo $update_requests_delete->NewClientName->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->NewAccountType->Visible) { // NewAccountType ?>
		<th class="<?php echo $update_requests_delete->NewAccountType->headerCellClass() ?>"><span id="elh_update_requests_NewAccountType" class="update_requests_NewAccountType"><?php echo $update_requests_delete->NewAccountType->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->NewMobileNumber->Visible) { // NewMobileNumber ?>
		<th class="<?php echo $update_requests_delete->NewMobileNumber->headerCellClass() ?>"><span id="elh_update_requests_NewMobileNumber" class="update_requests_NewMobileNumber"><?php echo $update_requests_delete->NewMobileNumber->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->NewEmail->Visible) { // NewEmail ?>
		<th class="<?php echo $update_requests_delete->NewEmail->headerCellClass() ?>"><span id="elh_update_requests_NewEmail" class="update_requests_NewEmail"><?php echo $update_requests_delete->NewEmail->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->date->Visible) { // date ?>
		<th class="<?php echo $update_requests_delete->date->headerCellClass() ?>"><span id="elh_update_requests_date" class="update_requests_date"><?php echo $update_requests_delete->date->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->status->Visible) { // status ?>
		<th class="<?php echo $update_requests_delete->status->headerCellClass() ?>"><span id="elh_update_requests_status" class="update_requests_status"><?php echo $update_requests_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->Property->Visible) { // Property ?>
		<th class="<?php echo $update_requests_delete->Property->headerCellClass() ?>"><span id="elh_update_requests_Property" class="update_requests_Property"><?php echo $update_requests_delete->Property->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->PropertyId->Visible) { // PropertyId ?>
		<th class="<?php echo $update_requests_delete->PropertyId->headerCellClass() ?>"><span id="elh_update_requests_PropertyId" class="update_requests_PropertyId"><?php echo $update_requests_delete->PropertyId->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->PropertyUse->Visible) { // PropertyUse ?>
		<th class="<?php echo $update_requests_delete->PropertyUse->headerCellClass() ?>"><span id="elh_update_requests_PropertyUse" class="update_requests_PropertyUse"><?php echo $update_requests_delete->PropertyUse->caption() ?></span></th>
<?php } ?>
<?php if ($update_requests_delete->Comment->Visible) { // Comment ?>
		<th class="<?php echo $update_requests_delete->Comment->headerCellClass() ?>"><span id="elh_update_requests_Comment" class="update_requests_Comment"><?php echo $update_requests_delete->Comment->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$update_requests_delete->RecordCount = 0;
$i = 0;
while (!$update_requests_delete->Recordset->EOF) {
	$update_requests_delete->RecordCount++;
	$update_requests_delete->RowCount++;

	// Set row properties
	$update_requests->resetAttributes();
	$update_requests->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$update_requests_delete->loadRowValues($update_requests_delete->Recordset);

	// Render row
	$update_requests_delete->renderRow();
?>
	<tr <?php echo $update_requests->rowAttributes() ?>>
<?php if ($update_requests_delete->ClientId->Visible) { // ClientId ?>
		<td <?php echo $update_requests_delete->ClientId->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_ClientId" class="update_requests_ClientId">
<span<?php echo $update_requests_delete->ClientId->viewAttributes() ?>><?php echo $update_requests_delete->ClientId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->NewClientIdentity->Visible) { // NewClientIdentity ?>
		<td <?php echo $update_requests_delete->NewClientIdentity->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_NewClientIdentity" class="update_requests_NewClientIdentity">
<span<?php echo $update_requests_delete->NewClientIdentity->viewAttributes() ?>><?php echo $update_requests_delete->NewClientIdentity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->NewClientName->Visible) { // NewClientName ?>
		<td <?php echo $update_requests_delete->NewClientName->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_NewClientName" class="update_requests_NewClientName">
<span<?php echo $update_requests_delete->NewClientName->viewAttributes() ?>><?php echo $update_requests_delete->NewClientName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->NewAccountType->Visible) { // NewAccountType ?>
		<td <?php echo $update_requests_delete->NewAccountType->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_NewAccountType" class="update_requests_NewAccountType">
<span<?php echo $update_requests_delete->NewAccountType->viewAttributes() ?>><?php echo $update_requests_delete->NewAccountType->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->NewMobileNumber->Visible) { // NewMobileNumber ?>
		<td <?php echo $update_requests_delete->NewMobileNumber->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_NewMobileNumber" class="update_requests_NewMobileNumber">
<span<?php echo $update_requests_delete->NewMobileNumber->viewAttributes() ?>><?php echo $update_requests_delete->NewMobileNumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->NewEmail->Visible) { // NewEmail ?>
		<td <?php echo $update_requests_delete->NewEmail->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_NewEmail" class="update_requests_NewEmail">
<span<?php echo $update_requests_delete->NewEmail->viewAttributes() ?>><?php echo $update_requests_delete->NewEmail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->date->Visible) { // date ?>
		<td <?php echo $update_requests_delete->date->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_date" class="update_requests_date">
<span<?php echo $update_requests_delete->date->viewAttributes() ?>><?php echo $update_requests_delete->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->status->Visible) { // status ?>
		<td <?php echo $update_requests_delete->status->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_status" class="update_requests_status">
<span<?php echo $update_requests_delete->status->viewAttributes() ?>><?php echo $update_requests_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->Property->Visible) { // Property ?>
		<td <?php echo $update_requests_delete->Property->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_Property" class="update_requests_Property">
<span<?php echo $update_requests_delete->Property->viewAttributes() ?>><?php echo $update_requests_delete->Property->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->PropertyId->Visible) { // PropertyId ?>
		<td <?php echo $update_requests_delete->PropertyId->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_PropertyId" class="update_requests_PropertyId">
<span<?php echo $update_requests_delete->PropertyId->viewAttributes() ?>><?php echo $update_requests_delete->PropertyId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->PropertyUse->Visible) { // PropertyUse ?>
		<td <?php echo $update_requests_delete->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_PropertyUse" class="update_requests_PropertyUse">
<span<?php echo $update_requests_delete->PropertyUse->viewAttributes() ?>><?php echo $update_requests_delete->PropertyUse->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($update_requests_delete->Comment->Visible) { // Comment ?>
		<td <?php echo $update_requests_delete->Comment->cellAttributes() ?>>
<span id="el<?php echo $update_requests_delete->RowCount ?>_update_requests_Comment" class="update_requests_Comment">
<span<?php echo $update_requests_delete->Comment->viewAttributes() ?>><?php echo $update_requests_delete->Comment->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$update_requests_delete->Recordset->moveNext();
}
$update_requests_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $update_requests_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$update_requests_delete->showPageFooter();
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
$update_requests_delete->terminate();
?>