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
$property_revenu_view = new property_revenu_view();

// Run the page
$property_revenu_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_revenu_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_revenu_view->isExport()) { ?>
<script>
var fproperty_revenuview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_revenuview = currentForm = new ew.Form("fproperty_revenuview", "view");
	loadjs.done("fproperty_revenuview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_revenu_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_revenu_view->ExportOptions->render("body") ?>
<?php $property_revenu_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_revenu_view->showPageHeader(); ?>
<?php
$property_revenu_view->showMessage();
?>
<?php if (!$property_revenu_view->IsModal) { ?>
<?php if (!$property_revenu_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_revenu_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_revenuview" id="fproperty_revenuview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_revenu">
<input type="hidden" name="modal" value="<?php echo (int)$property_revenu_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_revenu_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_id"><?php echo $property_revenu_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $property_revenu_view->id->cellAttributes() ?>>
<span id="el_property_revenu_id">
<span<?php echo $property_revenu_view->id->viewAttributes() ?>><?php echo $property_revenu_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->ClientId->Visible) { // ClientId ?>
	<tr id="r_ClientId">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_ClientId"><?php echo $property_revenu_view->ClientId->caption() ?></span></td>
		<td data-name="ClientId" <?php echo $property_revenu_view->ClientId->cellAttributes() ?>>
<span id="el_property_revenu_ClientId">
<span<?php echo $property_revenu_view->ClientId->viewAttributes() ?>><?php echo $property_revenu_view->ClientId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->ClientProperty->Visible) { // ClientProperty ?>
	<tr id="r_ClientProperty">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_ClientProperty"><?php echo $property_revenu_view->ClientProperty->caption() ?></span></td>
		<td data-name="ClientProperty" <?php echo $property_revenu_view->ClientProperty->cellAttributes() ?>>
<span id="el_property_revenu_ClientProperty">
<span<?php echo $property_revenu_view->ClientProperty->viewAttributes() ?>><?php echo $property_revenu_view->ClientProperty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->PropertyId->Visible) { // PropertyId ?>
	<tr id="r_PropertyId">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_PropertyId"><?php echo $property_revenu_view->PropertyId->caption() ?></span></td>
		<td data-name="PropertyId" <?php echo $property_revenu_view->PropertyId->cellAttributes() ?>>
<span id="el_property_revenu_PropertyId">
<span<?php echo $property_revenu_view->PropertyId->viewAttributes() ?>><?php echo $property_revenu_view->PropertyId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_PropertyUse"><?php echo $property_revenu_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $property_revenu_view->PropertyUse->cellAttributes() ?>>
<span id="el_property_revenu_PropertyUse">
<span<?php echo $property_revenu_view->PropertyUse->viewAttributes() ?>><?php echo $property_revenu_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->AmountPaid->Visible) { // AmountPaid ?>
	<tr id="r_AmountPaid">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_AmountPaid"><?php echo $property_revenu_view->AmountPaid->caption() ?></span></td>
		<td data-name="AmountPaid" <?php echo $property_revenu_view->AmountPaid->cellAttributes() ?>>
<span id="el_property_revenu_AmountPaid">
<span<?php echo $property_revenu_view->AmountPaid->viewAttributes() ?>><?php echo $property_revenu_view->AmountPaid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->Balance->Visible) { // Balance ?>
	<tr id="r_Balance">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_Balance"><?php echo $property_revenu_view->Balance->caption() ?></span></td>
		<td data-name="Balance" <?php echo $property_revenu_view->Balance->cellAttributes() ?>>
<span id="el_property_revenu_Balance">
<span<?php echo $property_revenu_view->Balance->viewAttributes() ?>><?php echo $property_revenu_view->Balance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_revenu_view->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="<?php echo $property_revenu_view->TableLeftColumnClass ?>"><span id="elh_property_revenu_date"><?php echo $property_revenu_view->date->caption() ?></span></td>
		<td data-name="date" <?php echo $property_revenu_view->date->cellAttributes() ?>>
<span id="el_property_revenu_date">
<span<?php echo $property_revenu_view->date->viewAttributes() ?>><?php echo $property_revenu_view->date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_revenu_view->IsModal) { ?>
<?php if (!$property_revenu_view->isExport()) { ?>
<?php echo $property_revenu_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_revenu_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_revenu_view->isExport()) { ?>
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
$property_revenu_view->terminate();
?>