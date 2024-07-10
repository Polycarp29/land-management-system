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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$users_view->isExport()) { ?>
<script>
var fusersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusersview = currentForm = new ew.Form("fusersview", "view");
	loadjs.done("fusersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$users_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php $users_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<?php if (!$users_view->IsModal) { ?>
<?php if (!$users_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $users_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($users_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_id"><?php echo $users_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $users_view->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users_view->id->viewAttributes() ?>><?php echo $users_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->Fullname->Visible) { // Fullname ?>
	<tr id="r_Fullname">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_Fullname"><?php echo $users_view->Fullname->caption() ?></span></td>
		<td data-name="Fullname" <?php echo $users_view->Fullname->cellAttributes() ?>>
<span id="el_users_Fullname">
<span<?php echo $users_view->Fullname->viewAttributes() ?>><?php echo $users_view->Fullname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->Username->Visible) { // Username ?>
	<tr id="r_Username">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_Username"><?php echo $users_view->Username->caption() ?></span></td>
		<td data-name="Username" <?php echo $users_view->Username->cellAttributes() ?>>
<span id="el_users_Username">
<span<?php echo $users_view->Username->viewAttributes() ?>><?php echo $users_view->Username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users__Email"><?php echo $users_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $users_view->_Email->cellAttributes() ?>>
<span id="el_users__Email">
<span<?php echo $users_view->_Email->viewAttributes() ?>><?php echo $users_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->Passsword->Visible) { // Passsword ?>
	<tr id="r_Passsword">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_Passsword"><?php echo $users_view->Passsword->caption() ?></span></td>
		<td data-name="Passsword" <?php echo $users_view->Passsword->cellAttributes() ?>>
<span id="el_users_Passsword">
<span<?php echo $users_view->Passsword->viewAttributes() ?>><?php echo $users_view->Passsword->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->userLevelId->Visible) { // userLevelId ?>
	<tr id="r_userLevelId">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_userLevelId"><?php echo $users_view->userLevelId->caption() ?></span></td>
		<td data-name="userLevelId" <?php echo $users_view->userLevelId->cellAttributes() ?>>
<span id="el_users_userLevelId">
<span<?php echo $users_view->userLevelId->viewAttributes() ?>><?php echo $users_view->userLevelId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$users_view->IsModal) { ?>
<?php if (!$users_view->isExport()) { ?>
<?php echo $users_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$users_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$users_view->isExport()) { ?>
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
$users_view->terminate();
?>