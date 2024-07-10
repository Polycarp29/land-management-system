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
$billing_period_delete = new billing_period_delete();

// Run the page
$billing_period_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$billing_period_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbilling_perioddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbilling_perioddelete = currentForm = new ew.Form("fbilling_perioddelete", "delete");
	loadjs.done("fbilling_perioddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $billing_period_delete->showPageHeader(); ?>
<?php
$billing_period_delete->showMessage();
?>
<form name="fbilling_perioddelete" id="fbilling_perioddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="billing_period">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($billing_period_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($billing_period_delete->BillingYear->Visible) { // BillingYear ?>
		<th class="<?php echo $billing_period_delete->BillingYear->headerCellClass() ?>"><span id="elh_billing_period_BillingYear" class="billing_period_BillingYear"><?php echo $billing_period_delete->BillingYear->caption() ?></span></th>
<?php } ?>
<?php if ($billing_period_delete->BillingCycle->Visible) { // BillingCycle ?>
		<th class="<?php echo $billing_period_delete->BillingCycle->headerCellClass() ?>"><span id="elh_billing_period_BillingCycle" class="billing_period_BillingCycle"><?php echo $billing_period_delete->BillingCycle->caption() ?></span></th>
<?php } ?>
<?php if ($billing_period_delete->From->Visible) { // From ?>
		<th class="<?php echo $billing_period_delete->From->headerCellClass() ?>"><span id="elh_billing_period_From" class="billing_period_From"><?php echo $billing_period_delete->From->caption() ?></span></th>
<?php } ?>
<?php if ($billing_period_delete->To->Visible) { // To ?>
		<th class="<?php echo $billing_period_delete->To->headerCellClass() ?>"><span id="elh_billing_period_To" class="billing_period_To"><?php echo $billing_period_delete->To->caption() ?></span></th>
<?php } ?>
<?php if ($billing_period_delete->Status->Visible) { // Status ?>
		<th class="<?php echo $billing_period_delete->Status->headerCellClass() ?>"><span id="elh_billing_period_Status" class="billing_period_Status"><?php echo $billing_period_delete->Status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$billing_period_delete->RecordCount = 0;
$i = 0;
while (!$billing_period_delete->Recordset->EOF) {
	$billing_period_delete->RecordCount++;
	$billing_period_delete->RowCount++;

	// Set row properties
	$billing_period->resetAttributes();
	$billing_period->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$billing_period_delete->loadRowValues($billing_period_delete->Recordset);

	// Render row
	$billing_period_delete->renderRow();
?>
	<tr <?php echo $billing_period->rowAttributes() ?>>
<?php if ($billing_period_delete->BillingYear->Visible) { // BillingYear ?>
		<td <?php echo $billing_period_delete->BillingYear->cellAttributes() ?>>
<span id="el<?php echo $billing_period_delete->RowCount ?>_billing_period_BillingYear" class="billing_period_BillingYear">
<span<?php echo $billing_period_delete->BillingYear->viewAttributes() ?>><?php echo $billing_period_delete->BillingYear->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($billing_period_delete->BillingCycle->Visible) { // BillingCycle ?>
		<td <?php echo $billing_period_delete->BillingCycle->cellAttributes() ?>>
<span id="el<?php echo $billing_period_delete->RowCount ?>_billing_period_BillingCycle" class="billing_period_BillingCycle">
<span<?php echo $billing_period_delete->BillingCycle->viewAttributes() ?>><?php echo $billing_period_delete->BillingCycle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($billing_period_delete->From->Visible) { // From ?>
		<td <?php echo $billing_period_delete->From->cellAttributes() ?>>
<span id="el<?php echo $billing_period_delete->RowCount ?>_billing_period_From" class="billing_period_From">
<span<?php echo $billing_period_delete->From->viewAttributes() ?>><?php echo $billing_period_delete->From->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($billing_period_delete->To->Visible) { // To ?>
		<td <?php echo $billing_period_delete->To->cellAttributes() ?>>
<span id="el<?php echo $billing_period_delete->RowCount ?>_billing_period_To" class="billing_period_To">
<span<?php echo $billing_period_delete->To->viewAttributes() ?>><?php echo $billing_period_delete->To->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($billing_period_delete->Status->Visible) { // Status ?>
		<td <?php echo $billing_period_delete->Status->cellAttributes() ?>>
<span id="el<?php echo $billing_period_delete->RowCount ?>_billing_period_Status" class="billing_period_Status">
<span<?php echo $billing_period_delete->Status->viewAttributes() ?>><?php echo $billing_period_delete->Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$billing_period_delete->Recordset->moveNext();
}
$billing_period_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $billing_period_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$billing_period_delete->showPageFooter();
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
$billing_period_delete->terminate();
?>