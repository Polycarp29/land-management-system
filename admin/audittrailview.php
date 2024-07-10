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
$audittrail_view = new audittrail_view();

// Run the page
$audittrail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$audittrail_view->isExport()) { ?>
<script>
var faudittrailview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	faudittrailview = currentForm = new ew.Form("faudittrailview", "view");
	loadjs.done("faudittrailview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$audittrail_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $audittrail_view->ExportOptions->render("body") ?>
<?php $audittrail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $audittrail_view->showPageHeader(); ?>
<?php
$audittrail_view->showMessage();
?>
<?php if (!$audittrail_view->IsModal) { ?>
<?php if (!$audittrail_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $audittrail_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="faudittrailview" id="faudittrailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="modal" value="<?php echo (int)$audittrail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($audittrail_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_id"><?php echo $audittrail_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $audittrail_view->id->cellAttributes() ?>>
<span id="el_audittrail_id">
<span<?php echo $audittrail_view->id->viewAttributes() ?>><?php echo $audittrail_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_datetime"><?php echo $audittrail_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $audittrail_view->datetime->cellAttributes() ?>>
<span id="el_audittrail_datetime">
<span<?php echo $audittrail_view->datetime->viewAttributes() ?>><?php echo $audittrail_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->script->Visible) { // script ?>
	<tr id="r_script">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_script"><?php echo $audittrail_view->script->caption() ?></span></td>
		<td data-name="script" <?php echo $audittrail_view->script->cellAttributes() ?>>
<span id="el_audittrail_script">
<span<?php echo $audittrail_view->script->viewAttributes() ?>><?php echo $audittrail_view->script->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->user->Visible) { // user ?>
	<tr id="r_user">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_user"><?php echo $audittrail_view->user->caption() ?></span></td>
		<td data-name="user" <?php echo $audittrail_view->user->cellAttributes() ?>>
<span id="el_audittrail_user">
<span<?php echo $audittrail_view->user->viewAttributes() ?>><?php echo $audittrail_view->user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->_action->Visible) { // action ?>
	<tr id="r__action">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail__action"><?php echo $audittrail_view->_action->caption() ?></span></td>
		<td data-name="_action" <?php echo $audittrail_view->_action->cellAttributes() ?>>
<span id="el_audittrail__action">
<span<?php echo $audittrail_view->_action->viewAttributes() ?>><?php echo $audittrail_view->_action->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->_table->Visible) { // table ?>
	<tr id="r__table">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail__table"><?php echo $audittrail_view->_table->caption() ?></span></td>
		<td data-name="_table" <?php echo $audittrail_view->_table->cellAttributes() ?>>
<span id="el_audittrail__table">
<span<?php echo $audittrail_view->_table->viewAttributes() ?>><?php echo $audittrail_view->_table->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->field->Visible) { // field ?>
	<tr id="r_field">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_field"><?php echo $audittrail_view->field->caption() ?></span></td>
		<td data-name="field" <?php echo $audittrail_view->field->cellAttributes() ?>>
<span id="el_audittrail_field">
<span<?php echo $audittrail_view->field->viewAttributes() ?>><?php echo $audittrail_view->field->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->keyvalue->Visible) { // keyvalue ?>
	<tr id="r_keyvalue">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_keyvalue"><?php echo $audittrail_view->keyvalue->caption() ?></span></td>
		<td data-name="keyvalue" <?php echo $audittrail_view->keyvalue->cellAttributes() ?>>
<span id="el_audittrail_keyvalue">
<span<?php echo $audittrail_view->keyvalue->viewAttributes() ?>><?php echo $audittrail_view->keyvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->oldvalue->Visible) { // oldvalue ?>
	<tr id="r_oldvalue">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_oldvalue"><?php echo $audittrail_view->oldvalue->caption() ?></span></td>
		<td data-name="oldvalue" <?php echo $audittrail_view->oldvalue->cellAttributes() ?>>
<span id="el_audittrail_oldvalue">
<span<?php echo $audittrail_view->oldvalue->viewAttributes() ?>><?php echo $audittrail_view->oldvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail_view->newvalue->Visible) { // newvalue ?>
	<tr id="r_newvalue">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_newvalue"><?php echo $audittrail_view->newvalue->caption() ?></span></td>
		<td data-name="newvalue" <?php echo $audittrail_view->newvalue->cellAttributes() ?>>
<span id="el_audittrail_newvalue">
<span<?php echo $audittrail_view->newvalue->viewAttributes() ?>><?php echo $audittrail_view->newvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$audittrail_view->IsModal) { ?>
<?php if (!$audittrail_view->isExport()) { ?>
<?php echo $audittrail_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$audittrail_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$audittrail_view->isExport()) { ?>
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
$audittrail_view->terminate();
?>