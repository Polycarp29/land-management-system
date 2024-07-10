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
$property_use_view = new property_use_view();

// Run the page
$property_use_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_use_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_use_view->isExport()) { ?>
<script>
var fproperty_useview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fproperty_useview = currentForm = new ew.Form("fproperty_useview", "view");
	loadjs.done("fproperty_useview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_use_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $property_use_view->ExportOptions->render("body") ?>
<?php $property_use_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $property_use_view->showPageHeader(); ?>
<?php
$property_use_view->showMessage();
?>
<?php if (!$property_use_view->IsModal) { ?>
<?php if (!$property_use_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_use_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_useview" id="fproperty_useview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_use">
<input type="hidden" name="modal" value="<?php echo (int)$property_use_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($property_use_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $property_use_view->TableLeftColumnClass ?>"><span id="elh_property_use_PropertyUse"><?php echo $property_use_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $property_use_view->PropertyUse->cellAttributes() ?>>
<span id="el_property_use_PropertyUse">
<span<?php echo $property_use_view->PropertyUse->viewAttributes() ?>><?php echo $property_use_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$property_use_view->IsModal) { ?>
<?php if (!$property_use_view->isExport()) { ?>
<?php echo $property_use_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_use_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_use_view->isExport()) { ?>
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
$property_use_view->terminate();
?>