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
$system_settings_view = new system_settings_view();

// Run the page
$system_settings_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$system_settings_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$system_settings_view->isExport()) { ?>
<script>
var fsystem_settingsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsystem_settingsview = currentForm = new ew.Form("fsystem_settingsview", "view");
	loadjs.done("fsystem_settingsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$system_settings_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $system_settings_view->ExportOptions->render("body") ?>
<?php $system_settings_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $system_settings_view->showPageHeader(); ?>
<?php
$system_settings_view->showMessage();
?>
<?php if (!$system_settings_view->IsModal) { ?>
<?php if (!$system_settings_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $system_settings_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsystem_settingsview" id="fsystem_settingsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="system_settings">
<input type="hidden" name="modal" value="<?php echo (int)$system_settings_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($system_settings_view->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $system_settings_view->TableLeftColumnClass ?>"><span id="elh_system_settings_name"><?php echo $system_settings_view->name->caption() ?></span></td>
		<td data-name="name" <?php echo $system_settings_view->name->cellAttributes() ?>>
<span id="el_system_settings_name">
<span<?php echo $system_settings_view->name->viewAttributes() ?>><?php echo $system_settings_view->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($system_settings_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $system_settings_view->TableLeftColumnClass ?>"><span id="elh_system_settings__email"><?php echo $system_settings_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $system_settings_view->_email->cellAttributes() ?>>
<span id="el_system_settings__email">
<span<?php echo $system_settings_view->_email->viewAttributes() ?>><?php echo $system_settings_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($system_settings_view->contact->Visible) { // contact ?>
	<tr id="r_contact">
		<td class="<?php echo $system_settings_view->TableLeftColumnClass ?>"><span id="elh_system_settings_contact"><?php echo $system_settings_view->contact->caption() ?></span></td>
		<td data-name="contact" <?php echo $system_settings_view->contact->cellAttributes() ?>>
<span id="el_system_settings_contact">
<span<?php echo $system_settings_view->contact->viewAttributes() ?>><?php echo $system_settings_view->contact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$system_settings_view->IsModal) { ?>
<?php if (!$system_settings_view->isExport()) { ?>
<?php echo $system_settings_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$system_settings_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$system_settings_view->isExport()) { ?>
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
$system_settings_view->terminate();
?>