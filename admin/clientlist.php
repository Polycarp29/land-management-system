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
$client_list = new client_list();

// Run the page
$client_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$client_list->isExport()) { ?>
<script>
var fclientlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fclientlist = currentForm = new ew.Form("fclientlist", "list");
	fclientlist.formKeyCountName = '<?php echo $client_list->FormKeyCountName ?>';
	loadjs.done("fclientlist");
});
var fclientlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fclientlistsrch = currentSearchForm = new ew.Form("fclientlistsrch");

	// Dynamic selection lists
	// Filters

	fclientlistsrch.filterList = <?php echo $client_list->getFilterList() ?>;
	loadjs.done("fclientlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$client_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($client_list->TotalRecords > 0 && $client_list->ExportOptions->visible()) { ?>
<?php $client_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($client_list->ImportOptions->visible()) { ?>
<?php $client_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($client_list->SearchOptions->visible()) { ?>
<?php $client_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($client_list->FilterOptions->visible()) { ?>
<?php $client_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$client_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$client_list->isExport() && !$client->CurrentAction) { ?>
<form name="fclientlistsrch" id="fclientlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fclientlistsrch-search-panel" class="<?php echo $client_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="client">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $client_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($client_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($client_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $client_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($client_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($client_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($client_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($client_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $client_list->showPageHeader(); ?>
<?php
$client_list->showMessage();
?>
<?php if ($client_list->TotalRecords > 0 || $client->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($client_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> client">
<?php if (!$client_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$client_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $client_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fclientlist" id="fclientlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<div id="gmp_client" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($client_list->TotalRecords > 0 || $client_list->isGridEdit()) { ?>
<table id="tbl_clientlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$client->RowType = ROWTYPE_HEADER;

// Render list options
$client_list->renderListOptions();

// Render list options (header, left)
$client_list->ListOptions->render("header", "left");
?>
<?php if ($client_list->id->Visible) { // id ?>
	<?php if ($client_list->SortUrl($client_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $client_list->id->headerCellClass() ?>"><div id="elh_client_id" class="client_id"><div class="ew-table-header-caption"><?php echo $client_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $client_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->id) ?>', 1);"><div id="elh_client_id" class="client_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->ClientName->Visible) { // ClientName ?>
	<?php if ($client_list->SortUrl($client_list->ClientName) == "") { ?>
		<th data-name="ClientName" class="<?php echo $client_list->ClientName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_client_ClientName" class="client_ClientName"><div class="ew-table-header-caption"><?php echo $client_list->ClientName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientName" class="<?php echo $client_list->ClientName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->ClientName) ?>', 1);"><div id="elh_client_ClientName" class="client_ClientName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->ClientName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->ClientName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->ClientName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->ClientType->Visible) { // ClientType ?>
	<?php if ($client_list->SortUrl($client_list->ClientType) == "") { ?>
		<th data-name="ClientType" class="<?php echo $client_list->ClientType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_client_ClientType" class="client_ClientType"><div class="ew-table-header-caption"><?php echo $client_list->ClientType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientType" class="<?php echo $client_list->ClientType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->ClientType) ?>', 1);"><div id="elh_client_ClientType" class="client_ClientType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->ClientType->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_list->ClientType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->ClientType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->IdentityType->Visible) { // IdentityType ?>
	<?php if ($client_list->SortUrl($client_list->IdentityType) == "") { ?>
		<th data-name="IdentityType" class="<?php echo $client_list->IdentityType->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_client_IdentityType" class="client_IdentityType"><div class="ew-table-header-caption"><?php echo $client_list->IdentityType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IdentityType" class="<?php echo $client_list->IdentityType->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->IdentityType) ?>', 1);"><div id="elh_client_IdentityType" class="client_IdentityType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->IdentityType->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_list->IdentityType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->IdentityType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->ClientID->Visible) { // ClientID ?>
	<?php if ($client_list->SortUrl($client_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $client_list->ClientID->headerCellClass() ?>"><div id="elh_client_ClientID" class="client_ClientID"><div class="ew-table-header-caption"><?php echo $client_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $client_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->ClientID) ?>', 1);"><div id="elh_client_ClientID" class="client_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->Surname->Visible) { // Surname ?>
	<?php if ($client_list->SortUrl($client_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $client_list->Surname->headerCellClass() ?>"><div id="elh_client_Surname" class="client_Surname"><div class="ew-table-header-caption"><?php echo $client_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $client_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->Surname) ?>', 1);"><div id="elh_client_Surname" class="client_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->FirstName->Visible) { // FirstName ?>
	<?php if ($client_list->SortUrl($client_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $client_list->FirstName->headerCellClass() ?>"><div id="elh_client_FirstName" class="client_FirstName"><div class="ew-table-header-caption"><?php echo $client_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $client_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->FirstName) ?>', 1);"><div id="elh_client_FirstName" class="client_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($client_list->SortUrl($client_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $client_list->MiddleName->headerCellClass() ?>"><div id="elh_client_MiddleName" class="client_MiddleName"><div class="ew-table-header-caption"><?php echo $client_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $client_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->MiddleName) ?>', 1);"><div id="elh_client_MiddleName" class="client_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->Gender->Visible) { // Gender ?>
	<?php if ($client_list->SortUrl($client_list->Gender) == "") { ?>
		<th data-name="Gender" class="<?php echo $client_list->Gender->headerCellClass() ?>"><div id="elh_client_Gender" class="client_Gender"><div class="ew-table-header-caption"><?php echo $client_list->Gender->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Gender" class="<?php echo $client_list->Gender->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->Gender) ?>', 1);"><div id="elh_client_Gender" class="client_Gender">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->Gender->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_list->Gender->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->Gender->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->MaritalStatus->Visible) { // MaritalStatus ?>
	<?php if ($client_list->SortUrl($client_list->MaritalStatus) == "") { ?>
		<th data-name="MaritalStatus" class="<?php echo $client_list->MaritalStatus->headerCellClass() ?>"><div id="elh_client_MaritalStatus" class="client_MaritalStatus"><div class="ew-table-header-caption"><?php echo $client_list->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatus" class="<?php echo $client_list->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->MaritalStatus) ?>', 1);"><div id="elh_client_MaritalStatus" class="client_MaritalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_list->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($client_list->SortUrl($client_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $client_list->DateOfBirth->headerCellClass() ?>"><div id="elh_client_DateOfBirth" class="client_DateOfBirth"><div class="ew-table-header-caption"><?php echo $client_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $client_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->DateOfBirth) ?>', 1);"><div id="elh_client_DateOfBirth" class="client_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->TownOrVillage->Visible) { // TownOrVillage ?>
	<?php if ($client_list->SortUrl($client_list->TownOrVillage) == "") { ?>
		<th data-name="TownOrVillage" class="<?php echo $client_list->TownOrVillage->headerCellClass() ?>"><div id="elh_client_TownOrVillage" class="client_TownOrVillage"><div class="ew-table-header-caption"><?php echo $client_list->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TownOrVillage" class="<?php echo $client_list->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->TownOrVillage) ?>', 1);"><div id="elh_client_TownOrVillage" class="client_TownOrVillage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->TownOrVillage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->Mobile->Visible) { // Mobile ?>
	<?php if ($client_list->SortUrl($client_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $client_list->Mobile->headerCellClass() ?>"><div id="elh_client_Mobile" class="client_Mobile"><div class="ew-table-header-caption"><?php echo $client_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $client_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->Mobile) ?>', 1);"><div id="elh_client_Mobile" class="client_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->_Email->Visible) { // Email ?>
	<?php if ($client_list->SortUrl($client_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $client_list->_Email->headerCellClass() ?>"><div id="elh_client__Email" class="client__Email"><div class="ew-table-header-caption"><?php echo $client_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $client_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->_Email) ?>', 1);"><div id="elh_client__Email" class="client__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->NextOfKin->Visible) { // NextOfKin ?>
	<?php if ($client_list->SortUrl($client_list->NextOfKin) == "") { ?>
		<th data-name="NextOfKin" class="<?php echo $client_list->NextOfKin->headerCellClass() ?>"><div id="elh_client_NextOfKin" class="client_NextOfKin"><div class="ew-table-header-caption"><?php echo $client_list->NextOfKin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKin" class="<?php echo $client_list->NextOfKin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->NextOfKin) ?>', 1);"><div id="elh_client_NextOfKin" class="client_NextOfKin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->NextOfKin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->NextOfKin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->NextOfKin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<?php if ($client_list->SortUrl($client_list->NextOfKinMobile) == "") { ?>
		<th data-name="NextOfKinMobile" class="<?php echo $client_list->NextOfKinMobile->headerCellClass() ?>"><div id="elh_client_NextOfKinMobile" class="client_NextOfKinMobile"><div class="ew-table-header-caption"><?php echo $client_list->NextOfKinMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKinMobile" class="<?php echo $client_list->NextOfKinMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->NextOfKinMobile) ?>', 1);"><div id="elh_client_NextOfKinMobile" class="client_NextOfKinMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->NextOfKinMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->NextOfKinMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->NextOfKinMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<?php if ($client_list->SortUrl($client_list->NextOfKinEmail) == "") { ?>
		<th data-name="NextOfKinEmail" class="<?php echo $client_list->NextOfKinEmail->headerCellClass() ?>"><div id="elh_client_NextOfKinEmail" class="client_NextOfKinEmail"><div class="ew-table-header-caption"><?php echo $client_list->NextOfKinEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NextOfKinEmail" class="<?php echo $client_list->NextOfKinEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_list->SortUrl($client_list->NextOfKinEmail) ?>', 1);"><div id="elh_client_NextOfKinEmail" class="client_NextOfKinEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_list->NextOfKinEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_list->NextOfKinEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_list->NextOfKinEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$client_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($client_list->ExportAll && $client_list->isExport()) {
	$client_list->StopRecord = $client_list->TotalRecords;
} else {

	// Set the last record to display
	if ($client_list->TotalRecords > $client_list->StartRecord + $client_list->DisplayRecords - 1)
		$client_list->StopRecord = $client_list->StartRecord + $client_list->DisplayRecords - 1;
	else
		$client_list->StopRecord = $client_list->TotalRecords;
}
$client_list->RecordCount = $client_list->StartRecord - 1;
if ($client_list->Recordset && !$client_list->Recordset->EOF) {
	$client_list->Recordset->moveFirst();
	$selectLimit = $client_list->UseSelectLimit;
	if (!$selectLimit && $client_list->StartRecord > 1)
		$client_list->Recordset->move($client_list->StartRecord - 1);
} elseif (!$client->AllowAddDeleteRow && $client_list->StopRecord == 0) {
	$client_list->StopRecord = $client->GridAddRowCount;
}

// Initialize aggregate
$client->RowType = ROWTYPE_AGGREGATEINIT;
$client->resetAttributes();
$client_list->renderRow();
while ($client_list->RecordCount < $client_list->StopRecord) {
	$client_list->RecordCount++;
	if ($client_list->RecordCount >= $client_list->StartRecord) {
		$client_list->RowCount++;

		// Set up key count
		$client_list->KeyCount = $client_list->RowIndex;

		// Init row class and style
		$client->resetAttributes();
		$client->CssClass = "";
		if ($client_list->isGridAdd()) {
		} else {
			$client_list->loadRowValues($client_list->Recordset); // Load row values
		}
		$client->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$client->RowAttrs->merge(["data-rowindex" => $client_list->RowCount, "id" => "r" . $client_list->RowCount . "_client", "data-rowtype" => $client->RowType]);

		// Render row
		$client_list->renderRow();

		// Render list options
		$client_list->renderListOptions();
?>
	<tr <?php echo $client->rowAttributes() ?>>
<?php

// Render list options (body, left)
$client_list->ListOptions->render("body", "left", $client_list->RowCount);
?>
	<?php if ($client_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $client_list->id->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_id">
<span<?php echo $client_list->id->viewAttributes() ?>><?php echo $client_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->ClientName->Visible) { // ClientName ?>
		<td data-name="ClientName" <?php echo $client_list->ClientName->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_ClientName">
<span<?php echo $client_list->ClientName->viewAttributes() ?>><?php echo $client_list->ClientName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->ClientType->Visible) { // ClientType ?>
		<td data-name="ClientType" <?php echo $client_list->ClientType->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_ClientType">
<span<?php echo $client_list->ClientType->viewAttributes() ?>><?php echo $client_list->ClientType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->IdentityType->Visible) { // IdentityType ?>
		<td data-name="IdentityType" <?php echo $client_list->IdentityType->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_IdentityType">
<span<?php echo $client_list->IdentityType->viewAttributes() ?>><?php echo $client_list->IdentityType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $client_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_ClientID">
<span<?php echo $client_list->ClientID->viewAttributes() ?>><?php echo $client_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $client_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_Surname">
<span<?php echo $client_list->Surname->viewAttributes() ?>><?php echo $client_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $client_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_FirstName">
<span<?php echo $client_list->FirstName->viewAttributes() ?>><?php echo $client_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $client_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_MiddleName">
<span<?php echo $client_list->MiddleName->viewAttributes() ?>><?php echo $client_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->Gender->Visible) { // Gender ?>
		<td data-name="Gender" <?php echo $client_list->Gender->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_Gender">
<span<?php echo $client_list->Gender->viewAttributes() ?>><?php echo $client_list->Gender->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus" <?php echo $client_list->MaritalStatus->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_MaritalStatus">
<span<?php echo $client_list->MaritalStatus->viewAttributes() ?>><?php echo $client_list->MaritalStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $client_list->DateOfBirth->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_DateOfBirth">
<span<?php echo $client_list->DateOfBirth->viewAttributes() ?>><?php echo $client_list->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage" <?php echo $client_list->TownOrVillage->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_TownOrVillage">
<span<?php echo $client_list->TownOrVillage->viewAttributes() ?>><?php echo $client_list->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $client_list->Mobile->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_Mobile">
<span<?php echo $client_list->Mobile->viewAttributes() ?>><?php echo $client_list->Mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $client_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client__Email">
<span<?php echo $client_list->_Email->viewAttributes() ?>><?php echo $client_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->NextOfKin->Visible) { // NextOfKin ?>
		<td data-name="NextOfKin" <?php echo $client_list->NextOfKin->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_NextOfKin">
<span<?php echo $client_list->NextOfKin->viewAttributes() ?>><?php echo $client_list->NextOfKin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
		<td data-name="NextOfKinMobile" <?php echo $client_list->NextOfKinMobile->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_NextOfKinMobile">
<span<?php echo $client_list->NextOfKinMobile->viewAttributes() ?>><?php echo $client_list->NextOfKinMobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_list->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
		<td data-name="NextOfKinEmail" <?php echo $client_list->NextOfKinEmail->cellAttributes() ?>>
<span id="el<?php echo $client_list->RowCount ?>_client_NextOfKinEmail">
<span<?php echo $client_list->NextOfKinEmail->viewAttributes() ?>><?php echo $client_list->NextOfKinEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$client_list->ListOptions->render("body", "right", $client_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$client_list->isGridAdd())
		$client_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$client->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($client_list->Recordset)
	$client_list->Recordset->Close();
?>
<?php if (!$client_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$client_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $client_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($client_list->TotalRecords == 0 && !$client->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $client_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$client_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$client_list->isExport()) { ?>
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
$client_list->terminate();
?>