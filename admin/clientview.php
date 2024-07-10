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
$client_view = new client_view();

// Run the page
$client_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$client_view->isExport()) { ?>
<script>
var fclientview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fclientview = currentForm = new ew.Form("fclientview", "view");
	loadjs.done("fclientview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$client_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $client_view->ExportOptions->render("body") ?>
<?php $client_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $client_view->showPageHeader(); ?>
<?php
$client_view->showMessage();
?>
<?php if (!$client_view->IsModal) { ?>
<?php if (!$client_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fclientview" id="fclientview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<input type="hidden" name="modal" value="<?php echo (int)$client_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($client_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_id"><?php echo $client_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $client_view->id->cellAttributes() ?>>
<span id="el_client_id">
<span<?php echo $client_view->id->viewAttributes() ?>><?php echo $client_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->ClientName->Visible) { // ClientName ?>
	<tr id="r_ClientName">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_ClientName"><?php echo $client_view->ClientName->caption() ?></span></td>
		<td data-name="ClientName" <?php echo $client_view->ClientName->cellAttributes() ?>>
<span id="el_client_ClientName">
<span<?php echo $client_view->ClientName->viewAttributes() ?>><?php echo $client_view->ClientName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->ClientType->Visible) { // ClientType ?>
	<tr id="r_ClientType">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_ClientType"><?php echo $client_view->ClientType->caption() ?></span></td>
		<td data-name="ClientType" <?php echo $client_view->ClientType->cellAttributes() ?>>
<span id="el_client_ClientType">
<span<?php echo $client_view->ClientType->viewAttributes() ?>><?php echo $client_view->ClientType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->IdentityType->Visible) { // IdentityType ?>
	<tr id="r_IdentityType">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_IdentityType"><?php echo $client_view->IdentityType->caption() ?></span></td>
		<td data-name="IdentityType" <?php echo $client_view->IdentityType->cellAttributes() ?>>
<span id="el_client_IdentityType">
<span<?php echo $client_view->IdentityType->viewAttributes() ?>><?php echo $client_view->IdentityType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->ClientID->Visible) { // ClientID ?>
	<tr id="r_ClientID">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_ClientID"><?php echo $client_view->ClientID->caption() ?></span></td>
		<td data-name="ClientID" <?php echo $client_view->ClientID->cellAttributes() ?>>
<span id="el_client_ClientID">
<span<?php echo $client_view->ClientID->viewAttributes() ?>><?php echo $client_view->ClientID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->Surname->Visible) { // Surname ?>
	<tr id="r_Surname">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_Surname"><?php echo $client_view->Surname->caption() ?></span></td>
		<td data-name="Surname" <?php echo $client_view->Surname->cellAttributes() ?>>
<span id="el_client_Surname">
<span<?php echo $client_view->Surname->viewAttributes() ?>><?php echo $client_view->Surname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_FirstName"><?php echo $client_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $client_view->FirstName->cellAttributes() ?>>
<span id="el_client_FirstName">
<span<?php echo $client_view->FirstName->viewAttributes() ?>><?php echo $client_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->MiddleName->Visible) { // MiddleName ?>
	<tr id="r_MiddleName">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_MiddleName"><?php echo $client_view->MiddleName->caption() ?></span></td>
		<td data-name="MiddleName" <?php echo $client_view->MiddleName->cellAttributes() ?>>
<span id="el_client_MiddleName">
<span<?php echo $client_view->MiddleName->viewAttributes() ?>><?php echo $client_view->MiddleName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->Gender->Visible) { // Gender ?>
	<tr id="r_Gender">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_Gender"><?php echo $client_view->Gender->caption() ?></span></td>
		<td data-name="Gender" <?php echo $client_view->Gender->cellAttributes() ?>>
<span id="el_client_Gender">
<span<?php echo $client_view->Gender->viewAttributes() ?>><?php echo $client_view->Gender->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->MaritalStatus->Visible) { // MaritalStatus ?>
	<tr id="r_MaritalStatus">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_MaritalStatus"><?php echo $client_view->MaritalStatus->caption() ?></span></td>
		<td data-name="MaritalStatus" <?php echo $client_view->MaritalStatus->cellAttributes() ?>>
<span id="el_client_MaritalStatus">
<span<?php echo $client_view->MaritalStatus->viewAttributes() ?>><?php echo $client_view->MaritalStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->DateOfBirth->Visible) { // DateOfBirth ?>
	<tr id="r_DateOfBirth">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_DateOfBirth"><?php echo $client_view->DateOfBirth->caption() ?></span></td>
		<td data-name="DateOfBirth" <?php echo $client_view->DateOfBirth->cellAttributes() ?>>
<span id="el_client_DateOfBirth">
<span<?php echo $client_view->DateOfBirth->viewAttributes() ?>><?php echo $client_view->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->PostalAddress->Visible) { // PostalAddress ?>
	<tr id="r_PostalAddress">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_PostalAddress"><?php echo $client_view->PostalAddress->caption() ?></span></td>
		<td data-name="PostalAddress" <?php echo $client_view->PostalAddress->cellAttributes() ?>>
<span id="el_client_PostalAddress">
<span<?php echo $client_view->PostalAddress->viewAttributes() ?>><?php echo $client_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<tr id="r_PhysicalAddress">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_PhysicalAddress"><?php echo $client_view->PhysicalAddress->caption() ?></span></td>
		<td data-name="PhysicalAddress" <?php echo $client_view->PhysicalAddress->cellAttributes() ?>>
<span id="el_client_PhysicalAddress">
<span<?php echo $client_view->PhysicalAddress->viewAttributes() ?>><?php echo $client_view->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->TownOrVillage->Visible) { // TownOrVillage ?>
	<tr id="r_TownOrVillage">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_TownOrVillage"><?php echo $client_view->TownOrVillage->caption() ?></span></td>
		<td data-name="TownOrVillage" <?php echo $client_view->TownOrVillage->cellAttributes() ?>>
<span id="el_client_TownOrVillage">
<span<?php echo $client_view->TownOrVillage->viewAttributes() ?>><?php echo $client_view->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_Mobile"><?php echo $client_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $client_view->Mobile->cellAttributes() ?>>
<span id="el_client_Mobile">
<span<?php echo $client_view->Mobile->viewAttributes() ?>><?php echo $client_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client__Email"><?php echo $client_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $client_view->_Email->cellAttributes() ?>>
<span id="el_client__Email">
<span<?php echo $client_view->_Email->viewAttributes() ?>><?php echo $client_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->NextOfKin->Visible) { // NextOfKin ?>
	<tr id="r_NextOfKin">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_NextOfKin"><?php echo $client_view->NextOfKin->caption() ?></span></td>
		<td data-name="NextOfKin" <?php echo $client_view->NextOfKin->cellAttributes() ?>>
<span id="el_client_NextOfKin">
<span<?php echo $client_view->NextOfKin->viewAttributes() ?>><?php echo $client_view->NextOfKin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<tr id="r_NextOfKinMobile">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_NextOfKinMobile"><?php echo $client_view->NextOfKinMobile->caption() ?></span></td>
		<td data-name="NextOfKinMobile" <?php echo $client_view->NextOfKinMobile->cellAttributes() ?>>
<span id="el_client_NextOfKinMobile">
<span<?php echo $client_view->NextOfKinMobile->viewAttributes() ?>><?php echo $client_view->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<tr id="r_NextOfKinEmail">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_NextOfKinEmail"><?php echo $client_view->NextOfKinEmail->caption() ?></span></td>
		<td data-name="NextOfKinEmail" <?php echo $client_view->NextOfKinEmail->cellAttributes() ?>>
<span id="el_client_NextOfKinEmail">
<span<?php echo $client_view->NextOfKinEmail->viewAttributes() ?>><?php echo $client_view->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($client_view->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<tr id="r_AdditionalInformation">
		<td class="<?php echo $client_view->TableLeftColumnClass ?>"><span id="elh_client_AdditionalInformation"><?php echo $client_view->AdditionalInformation->caption() ?></span></td>
		<td data-name="AdditionalInformation" <?php echo $client_view->AdditionalInformation->cellAttributes() ?>>
<span id="el_client_AdditionalInformation">
<span<?php echo $client_view->AdditionalInformation->viewAttributes() ?>><?php echo $client_view->AdditionalInformation->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$client_view->IsModal) { ?>
<?php if (!$client_view->isExport()) { ?>
<?php echo $client_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php if ($client->getCurrentDetailTable() != "") { ?>
<?php
	$client_view->DetailPages->ValidKeys = explode(",", $client->getCurrentDetailTable());
	$firstActiveDetailTable = $client_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="client_view_details"><!-- tabs -->
	<ul class="<?php echo $client_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property") {
			$firstActiveDetailTable = "property";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_view->DetailPages->pageStyle("property") ?>" href="#tab_property" data-toggle="tab"><?php echo $Language->tablePhrase("property", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $client_view->property_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
<?php
	if (in_array("property_revenu", explode(",", $client->getCurrentDetailTable())) && $property_revenu->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_revenu") {
			$firstActiveDetailTable = "property_revenu";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_view->DetailPages->pageStyle("property_revenu") ?>" href="#tab_property_revenu" data-toggle="tab"><?php echo $Language->tablePhrase("property_revenu", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $client_view->property_revenu_Count, $Language->phrase("DetailCount")) ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property")
			$firstActiveDetailTable = "property";
?>
		<div class="tab-pane <?php echo $client_view->DetailPages->pageStyle("property") ?>" id="tab_property"><!-- page* -->
<?php include_once "propertygrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("property_revenu", explode(",", $client->getCurrentDetailTable())) && $property_revenu->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_revenu")
			$firstActiveDetailTable = "property_revenu";
?>
		<div class="tab-pane <?php echo $client_view->DetailPages->pageStyle("property_revenu") ?>" id="tab_property_revenu"><!-- page* -->
<?php include_once "property_revenugrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$client_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$client_view->isExport()) { ?>
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
$client_view->terminate();
?>