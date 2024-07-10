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
$property_type_view = new property_type_view();

// Run the page
$property_type_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_type_view->isExport()) { ?>
<script>
var fproperty_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_typeview = currentForm = new ew.Form("fproperty_typeview", "view");
	loadjs.done("fproperty_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_type_view->ExportOptions->render("body") ?>
<?php $property_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_type_view->showPageHeader(); ?>
<?php
$property_type_view->showMessage();
?>
<?php if (!$property_type_view->IsModal) { ?>
<?php if (!$property_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_typeview" id="fproperty_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_type">
<input type="hidden" name="modal" value="<?php echo (int)$property_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_type_view->PropertyTypeCode->Visible) { // PropertyTypeCode ?>
	<tr id="r_PropertyTypeCode">
		<td class="<?php echo $property_type_view->TableLeftColumnClass ?>"><span id="elh_property_type_PropertyTypeCode"><?php echo $property_type_view->PropertyTypeCode->caption() ?></span></td>
		<td data-name="PropertyTypeCode" <?php echo $property_type_view->PropertyTypeCode->cellAttributes() ?>>
<span id="el_property_type_PropertyTypeCode">
<span<?php echo $property_type_view->PropertyTypeCode->viewAttributes() ?>><?php echo $property_type_view->PropertyTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_type_view->PropertyType->Visible) { // PropertyType ?>
	<tr id="r_PropertyType">
		<td class="<?php echo $property_type_view->TableLeftColumnClass ?>"><span id="elh_property_type_PropertyType"><?php echo $property_type_view->PropertyType->caption() ?></span></td>
		<td data-name="PropertyType" <?php echo $property_type_view->PropertyType->cellAttributes() ?>>
<span id="el_property_type_PropertyType">
<span<?php echo $property_type_view->PropertyType->viewAttributes() ?>><?php echo $property_type_view->PropertyType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($property_type_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $property_type_view->TableLeftColumnClass ?>"><span id="elh_property_type_PropertyUse"><?php echo $property_type_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $property_type_view->PropertyUse->cellAttributes() ?>>
<span id="el_property_type_PropertyUse">
<span<?php echo $property_type_view->PropertyUse->viewAttributes() ?>><?php echo $property_type_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_type_view->IsModal) { ?>
<?php if (!$property_type_view->isExport()) { ?>
<?php echo $property_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_type_view->isExport()) { ?>
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
$property_type_view->terminate();
?>