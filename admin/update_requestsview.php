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
$update_requests_view = new update_requests_view();

// Run the page
$update_requests_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$update_requests_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$update_requests_view->isExport()) { ?>
<script>
var fupdate_requestsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fupdate_requestsview = currentForm = new ew.Form("fupdate_requestsview", "view");
	loadjs.done("fupdate_requestsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$update_requests_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $update_requests_view->ExportOptions->render("body") ?>
<?php $update_requests_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $update_requests_view->showPageHeader(); ?>
<?php
$update_requests_view->showMessage();
?>
<?php if (!$update_requests_view->IsModal) { ?>
<?php if (!$update_requests_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $update_requests_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fupdate_requestsview" id="fupdate_requestsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="update_requests">
<input type="hidden" name="modal" value="<?php echo (int)$update_requests_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($update_requests_view->ClientId->Visible) { // ClientId ?>
	<tr id="r_ClientId">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_ClientId"><?php echo $update_requests_view->ClientId->caption() ?></span></td>
		<td data-name="ClientId" <?php echo $update_requests_view->ClientId->cellAttributes() ?>>
<span id="el_update_requests_ClientId">
<span<?php echo $update_requests_view->ClientId->viewAttributes() ?>><?php echo $update_requests_view->ClientId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->NewClientIdentity->Visible) { // NewClientIdentity ?>
	<tr id="r_NewClientIdentity">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_NewClientIdentity"><?php echo $update_requests_view->NewClientIdentity->caption() ?></span></td>
		<td data-name="NewClientIdentity" <?php echo $update_requests_view->NewClientIdentity->cellAttributes() ?>>
<span id="el_update_requests_NewClientIdentity">
<span<?php echo $update_requests_view->NewClientIdentity->viewAttributes() ?>><?php echo $update_requests_view->NewClientIdentity->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->NewClientName->Visible) { // NewClientName ?>
	<tr id="r_NewClientName">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_NewClientName"><?php echo $update_requests_view->NewClientName->caption() ?></span></td>
		<td data-name="NewClientName" <?php echo $update_requests_view->NewClientName->cellAttributes() ?>>
<span id="el_update_requests_NewClientName">
<span<?php echo $update_requests_view->NewClientName->viewAttributes() ?>><?php echo $update_requests_view->NewClientName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->NewAccountType->Visible) { // NewAccountType ?>
	<tr id="r_NewAccountType">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_NewAccountType"><?php echo $update_requests_view->NewAccountType->caption() ?></span></td>
		<td data-name="NewAccountType" <?php echo $update_requests_view->NewAccountType->cellAttributes() ?>>
<span id="el_update_requests_NewAccountType">
<span<?php echo $update_requests_view->NewAccountType->viewAttributes() ?>><?php echo $update_requests_view->NewAccountType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->NewMobileNumber->Visible) { // NewMobileNumber ?>
	<tr id="r_NewMobileNumber">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_NewMobileNumber"><?php echo $update_requests_view->NewMobileNumber->caption() ?></span></td>
		<td data-name="NewMobileNumber" <?php echo $update_requests_view->NewMobileNumber->cellAttributes() ?>>
<span id="el_update_requests_NewMobileNumber">
<span<?php echo $update_requests_view->NewMobileNumber->viewAttributes() ?>><?php echo $update_requests_view->NewMobileNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->NewEmail->Visible) { // NewEmail ?>
	<tr id="r_NewEmail">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_NewEmail"><?php echo $update_requests_view->NewEmail->caption() ?></span></td>
		<td data-name="NewEmail" <?php echo $update_requests_view->NewEmail->cellAttributes() ?>>
<span id="el_update_requests_NewEmail">
<span<?php echo $update_requests_view->NewEmail->viewAttributes() ?>><?php echo $update_requests_view->NewEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->NewAdditionalInformation->Visible) { // NewAdditionalInformation ?>
	<tr id="r_NewAdditionalInformation">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_NewAdditionalInformation"><?php echo $update_requests_view->NewAdditionalInformation->caption() ?></span></td>
		<td data-name="NewAdditionalInformation" <?php echo $update_requests_view->NewAdditionalInformation->cellAttributes() ?>>
<span id="el_update_requests_NewAdditionalInformation">
<span<?php echo $update_requests_view->NewAdditionalInformation->viewAttributes() ?>><?php echo $update_requests_view->NewAdditionalInformation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->date->Visible) { // date ?>
	<tr id="r_date">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_date"><?php echo $update_requests_view->date->caption() ?></span></td>
		<td data-name="date" <?php echo $update_requests_view->date->cellAttributes() ?>>
<span id="el_update_requests_date">
<span<?php echo $update_requests_view->date->viewAttributes() ?>><?php echo $update_requests_view->date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_status"><?php echo $update_requests_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $update_requests_view->status->cellAttributes() ?>>
<span id="el_update_requests_status">
<span<?php echo $update_requests_view->status->viewAttributes() ?>><?php echo $update_requests_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->Property->Visible) { // Property ?>
	<tr id="r_Property">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_Property"><?php echo $update_requests_view->Property->caption() ?></span></td>
		<td data-name="Property" <?php echo $update_requests_view->Property->cellAttributes() ?>>
<span id="el_update_requests_Property">
<span<?php echo $update_requests_view->Property->viewAttributes() ?>><?php echo $update_requests_view->Property->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->PropertyId->Visible) { // PropertyId ?>
	<tr id="r_PropertyId">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_PropertyId"><?php echo $update_requests_view->PropertyId->caption() ?></span></td>
		<td data-name="PropertyId" <?php echo $update_requests_view->PropertyId->cellAttributes() ?>>
<span id="el_update_requests_PropertyId">
<span<?php echo $update_requests_view->PropertyId->viewAttributes() ?>><?php echo $update_requests_view->PropertyId->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->PropertyUse->Visible) { // PropertyUse ?>
	<tr id="r_PropertyUse">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_PropertyUse"><?php echo $update_requests_view->PropertyUse->caption() ?></span></td>
		<td data-name="PropertyUse" <?php echo $update_requests_view->PropertyUse->cellAttributes() ?>>
<span id="el_update_requests_PropertyUse">
<span<?php echo $update_requests_view->PropertyUse->viewAttributes() ?>><?php echo $update_requests_view->PropertyUse->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($update_requests_view->Comment->Visible) { // Comment ?>
	<tr id="r_Comment">
		<td class="<?php echo $update_requests_view->TableLeftColumnClass ?>"><span id="elh_update_requests_Comment"><?php echo $update_requests_view->Comment->caption() ?></span></td>
		<td data-name="Comment" <?php echo $update_requests_view->Comment->cellAttributes() ?>>
<span id="el_update_requests_Comment">
<span<?php echo $update_requests_view->Comment->viewAttributes() ?>><?php echo $update_requests_view->Comment->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$update_requests_view->IsModal) { ?>
<?php if (!$update_requests_view->isExport()) { ?>
<?php echo $update_requests_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$update_requests_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$update_requests_view->isExport()) { ?>
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
$update_requests_view->terminate();
?>