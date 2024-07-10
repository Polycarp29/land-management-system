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
$billing_period_view = new billing_period_view();

// Run the page
$billing_period_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$billing_period_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$billing_period_view->isExport()) { ?>
<script>
var fbilling_periodview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbilling_periodview = currentForm = new ew.Form("fbilling_periodview", "view");
	loadjs.done("fbilling_periodview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$billing_period_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $billing_period_view->ExportOptions->render("body") ?>
<?php $billing_period_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $billing_period_view->showPageHeader(); ?>
<?php
$billing_period_view->showMessage();
?>
<?php if (!$billing_period_view->IsModal) { ?>
<?php if (!$billing_period_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $billing_period_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbilling_periodview" id="fbilling_periodview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="billing_period">
<input type="hidden" name="modal" value="<?php echo (int)$billing_period_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($billing_period_view->BillingYear->Visible) { // BillingYear ?>
	<tr id="r_BillingYear">
		<td class="<?php echo $billing_period_view->TableLeftColumnClass ?>"><span id="elh_billing_period_BillingYear"><?php echo $billing_period_view->BillingYear->caption() ?></span></td>
		<td data-name="BillingYear" <?php echo $billing_period_view->BillingYear->cellAttributes() ?>>
<span id="el_billing_period_BillingYear">
<span<?php echo $billing_period_view->BillingYear->viewAttributes() ?>><?php echo $billing_period_view->BillingYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($billing_period_view->BillingCycle->Visible) { // BillingCycle ?>
	<tr id="r_BillingCycle">
		<td class="<?php echo $billing_period_view->TableLeftColumnClass ?>"><span id="elh_billing_period_BillingCycle"><?php echo $billing_period_view->BillingCycle->caption() ?></span></td>
		<td data-name="BillingCycle" <?php echo $billing_period_view->BillingCycle->cellAttributes() ?>>
<span id="el_billing_period_BillingCycle">
<span<?php echo $billing_period_view->BillingCycle->viewAttributes() ?>><?php echo $billing_period_view->BillingCycle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($billing_period_view->From->Visible) { // From ?>
	<tr id="r_From">
		<td class="<?php echo $billing_period_view->TableLeftColumnClass ?>"><span id="elh_billing_period_From"><?php echo $billing_period_view->From->caption() ?></span></td>
		<td data-name="From" <?php echo $billing_period_view->From->cellAttributes() ?>>
<span id="el_billing_period_From">
<span<?php echo $billing_period_view->From->viewAttributes() ?>><?php echo $billing_period_view->From->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($billing_period_view->To->Visible) { // To ?>
	<tr id="r_To">
		<td class="<?php echo $billing_period_view->TableLeftColumnClass ?>"><span id="elh_billing_period_To"><?php echo $billing_period_view->To->caption() ?></span></td>
		<td data-name="To" <?php echo $billing_period_view->To->cellAttributes() ?>>
<span id="el_billing_period_To">
<span<?php echo $billing_period_view->To->viewAttributes() ?>><?php echo $billing_period_view->To->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($billing_period_view->Status->Visible) { // Status ?>
	<tr id="r_Status">
		<td class="<?php echo $billing_period_view->TableLeftColumnClass ?>"><span id="elh_billing_period_Status"><?php echo $billing_period_view->Status->caption() ?></span></td>
		<td data-name="Status" <?php echo $billing_period_view->Status->cellAttributes() ?>>
<span id="el_billing_period_Status">
<span<?php echo $billing_period_view->Status->viewAttributes() ?>><?php echo $billing_period_view->Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$billing_period_view->IsModal) { ?>
<?php if (!$billing_period_view->isExport()) { ?>
<?php echo $billing_period_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$billing_period_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$billing_period_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$billing_period_view->terminate();
?>