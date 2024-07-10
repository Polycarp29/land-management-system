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
$update_requests_list = new update_requests_list();

// Run the page
$update_requests_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$update_requests_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$update_requests_list->isExport()) { ?>
<script>
var fupdate_requestslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fupdate_requestslist = currentForm = new ew.Form("fupdate_requestslist", "list");
	fupdate_requestslist.formKeyCountName = '<?php echo $update_requests_list->FormKeyCountName ?>';
	loadjs.done("fupdate_requestslist");
});
var fupdate_requestslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fupdate_requestslistsrch = currentSearchForm = new ew.Form("fupdate_requestslistsrch");

	// Dynamic selection lists
	// Filters

	fupdate_requestslistsrch.filterList = <?php echo $update_requests_list->getFilterList() ?>;
	loadjs.done("fupdate_requestslistsrch");
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
<?php if (!$update_requests_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($update_requests_list->TotalRecords > 0 && $update_requests_list->ExportOptions->visible()) { ?>
<?php $update_requests_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($update_requests_list->ImportOptions->visible()) { ?>
<?php $update_requests_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($update_requests_list->SearchOptions->visible()) { ?>
<?php $update_requests_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($update_requests_list->FilterOptions->visible()) { ?>
<?php $update_requests_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$update_requests_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$update_requests_list->isExport() && !$update_requests->CurrentAction) { ?>
<form name="fupdate_requestslistsrch" id="fupdate_requestslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fupdate_requestslistsrch-search-panel" class="<?php echo $update_requests_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="update_requests">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $update_requests_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($update_requests_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($update_requests_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $update_requests_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($update_requests_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($update_requests_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($update_requests_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($update_requests_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $update_requests_list->showPageHeader(); ?>
<?php
$update_requests_list->showMessage();
?>
<?php if ($update_requests_list->TotalRecords > 0 || $update_requests->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($update_requests_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> update_requests">
<?php if (!$update_requests_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$update_requests_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $update_requests_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $update_requests_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fupdate_requestslist" id="fupdate_requestslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="update_requests">
<div id="gmp_update_requests" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($update_requests_list->TotalRecords > 0 || $update_requests_list->isGridEdit()) { ?>
<table id="tbl_update_requestslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$update_requests->RowType = ROWTYPE_HEADER;

// Render list options
$update_requests_list->renderListOptions();

// Render list options (header, left)
$update_requests_list->ListOptions->render("header", "left");
?>
<?php if ($update_requests_list->ClientId->Visible) { // ClientId ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $update_requests_list->ClientId->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_update_requests_ClientId" class="update_requests_ClientId"><div class="ew-table-header-caption"><?php echo $update_requests_list->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $update_requests_list->ClientId->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->ClientId) ?>', 1);"><div id="elh_update_requests_ClientId" class="update_requests_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->NewClientIdentity->Visible) { // NewClientIdentity ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->NewClientIdentity) == "") { ?>
		<th data-name="NewClientIdentity" class="<?php echo $update_requests_list->NewClientIdentity->headerCellClass() ?>"><div id="elh_update_requests_NewClientIdentity" class="update_requests_NewClientIdentity"><div class="ew-table-header-caption"><?php echo $update_requests_list->NewClientIdentity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewClientIdentity" class="<?php echo $update_requests_list->NewClientIdentity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->NewClientIdentity) ?>', 1);"><div id="elh_update_requests_NewClientIdentity" class="update_requests_NewClientIdentity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->NewClientIdentity->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->NewClientIdentity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->NewClientIdentity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->NewClientName->Visible) { // NewClientName ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->NewClientName) == "") { ?>
		<th data-name="NewClientName" class="<?php echo $update_requests_list->NewClientName->headerCellClass() ?>"><div id="elh_update_requests_NewClientName" class="update_requests_NewClientName"><div class="ew-table-header-caption"><?php echo $update_requests_list->NewClientName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewClientName" class="<?php echo $update_requests_list->NewClientName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->NewClientName) ?>', 1);"><div id="elh_update_requests_NewClientName" class="update_requests_NewClientName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->NewClientName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->NewClientName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->NewClientName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->NewAccountType->Visible) { // NewAccountType ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->NewAccountType) == "") { ?>
		<th data-name="NewAccountType" class="<?php echo $update_requests_list->NewAccountType->headerCellClass() ?>"><div id="elh_update_requests_NewAccountType" class="update_requests_NewAccountType"><div class="ew-table-header-caption"><?php echo $update_requests_list->NewAccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewAccountType" class="<?php echo $update_requests_list->NewAccountType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->NewAccountType) ?>', 1);"><div id="elh_update_requests_NewAccountType" class="update_requests_NewAccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->NewAccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->NewAccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->NewAccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->NewMobileNumber->Visible) { // NewMobileNumber ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->NewMobileNumber) == "") { ?>
		<th data-name="NewMobileNumber" class="<?php echo $update_requests_list->NewMobileNumber->headerCellClass() ?>"><div id="elh_update_requests_NewMobileNumber" class="update_requests_NewMobileNumber"><div class="ew-table-header-caption"><?php echo $update_requests_list->NewMobileNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewMobileNumber" class="<?php echo $update_requests_list->NewMobileNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->NewMobileNumber) ?>', 1);"><div id="elh_update_requests_NewMobileNumber" class="update_requests_NewMobileNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->NewMobileNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->NewMobileNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->NewMobileNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->NewEmail->Visible) { // NewEmail ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->NewEmail) == "") { ?>
		<th data-name="NewEmail" class="<?php echo $update_requests_list->NewEmail->headerCellClass() ?>"><div id="elh_update_requests_NewEmail" class="update_requests_NewEmail"><div class="ew-table-header-caption"><?php echo $update_requests_list->NewEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewEmail" class="<?php echo $update_requests_list->NewEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->NewEmail) ?>', 1);"><div id="elh_update_requests_NewEmail" class="update_requests_NewEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->NewEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->NewEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->NewEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->date->Visible) { // date ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->date) == "") { ?>
		<th data-name="date" class="<?php echo $update_requests_list->date->headerCellClass() ?>"><div id="elh_update_requests_date" class="update_requests_date"><div class="ew-table-header-caption"><?php echo $update_requests_list->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $update_requests_list->date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->date) ?>', 1);"><div id="elh_update_requests_date" class="update_requests_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->status->Visible) { // status ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $update_requests_list->status->headerCellClass() ?>"><div id="elh_update_requests_status" class="update_requests_status"><div class="ew-table-header-caption"><?php echo $update_requests_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $update_requests_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->status) ?>', 1);"><div id="elh_update_requests_status" class="update_requests_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->Property->Visible) { // Property ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->Property) == "") { ?>
		<th data-name="Property" class="<?php echo $update_requests_list->Property->headerCellClass() ?>"><div id="elh_update_requests_Property" class="update_requests_Property"><div class="ew-table-header-caption"><?php echo $update_requests_list->Property->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Property" class="<?php echo $update_requests_list->Property->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->Property) ?>', 1);"><div id="elh_update_requests_Property" class="update_requests_Property">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->Property->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->Property->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->Property->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->PropertyId->Visible) { // PropertyId ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->PropertyId) == "") { ?>
		<th data-name="PropertyId" class="<?php echo $update_requests_list->PropertyId->headerCellClass() ?>"><div id="elh_update_requests_PropertyId" class="update_requests_PropertyId"><div class="ew-table-header-caption"><?php echo $update_requests_list->PropertyId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyId" class="<?php echo $update_requests_list->PropertyId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->PropertyId) ?>', 1);"><div id="elh_update_requests_PropertyId" class="update_requests_PropertyId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->PropertyId->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->PropertyId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->PropertyId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $update_requests_list->PropertyUse->headerCellClass() ?>"><div id="elh_update_requests_PropertyUse" class="update_requests_PropertyUse"><div class="ew-table-header-caption"><?php echo $update_requests_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $update_requests_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->PropertyUse) ?>', 1);"><div id="elh_update_requests_PropertyUse" class="update_requests_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($update_requests_list->Comment->Visible) { // Comment ?>
	<?php if ($update_requests_list->SortUrl($update_requests_list->Comment) == "") { ?>
		<th data-name="Comment" class="<?php echo $update_requests_list->Comment->headerCellClass() ?>"><div id="elh_update_requests_Comment" class="update_requests_Comment"><div class="ew-table-header-caption"><?php echo $update_requests_list->Comment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comment" class="<?php echo $update_requests_list->Comment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $update_requests_list->SortUrl($update_requests_list->Comment) ?>', 1);"><div id="elh_update_requests_Comment" class="update_requests_Comment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $update_requests_list->Comment->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($update_requests_list->Comment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($update_requests_list->Comment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$update_requests_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($update_requests_list->ExportAll && $update_requests_list->isExport()) {
	$update_requests_list->StopRecord = $update_requests_list->TotalRecords;
} else {

	// Set the last record to display
	if ($update_requests_list->TotalRecords > $update_requests_list->StartRecord + $update_requests_list->DisplayRecords - 1)
		$update_requests_list->StopRecord = $update_requests_list->StartRecord + $update_requests_list->DisplayRecords - 1;
	else
		$update_requests_list->StopRecord = $update_requests_list->TotalRecords;
}
$update_requests_list->RecordCount = $update_requests_list->StartRecord - 1;
if ($update_requests_list->Recordset && !$update_requests_list->Recordset->EOF) {
	$update_requests_list->Recordset->moveFirst();
	$selectLimit = $update_requests_list->UseSelectLimit;
	if (!$selectLimit && $update_requests_list->StartRecord > 1)
		$update_requests_list->Recordset->move($update_requests_list->StartRecord - 1);
} elseif (!$update_requests->AllowAddDeleteRow && $update_requests_list->StopRecord == 0) {
	$update_requests_list->StopRecord = $update_requests->GridAddRowCount;
}

// Initialize aggregate
$update_requests->RowType = ROWTYPE_AGGREGATEINIT;
$update_requests->resetAttributes();
$update_requests_list->renderRow();
while ($update_requests_list->RecordCount < $update_requests_list->StopRecord) {
	$update_requests_list->RecordCount++;
	if ($update_requests_list->RecordCount >= $update_requests_list->StartRecord) {
		$update_requests_list->RowCount++;

		// Set up key count
		$update_requests_list->KeyCount = $update_requests_list->RowIndex;

		// Init row class and style
		$update_requests->resetAttributes();
		$update_requests->CssClass = "";
		if ($update_requests_list->isGridAdd()) {
		} else {
			$update_requests_list->loadRowValues($update_requests_list->Recordset); // Load row values
		}
		$update_requests->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$update_requests->RowAttrs->merge(["data-rowindex" => $update_requests_list->RowCount, "id" => "r" . $update_requests_list->RowCount . "_update_requests", "data-rowtype" => $update_requests->RowType]);

		// Render row
		$update_requests_list->renderRow();

		// Render list options
		$update_requests_list->renderListOptions();
?>
	<tr <?php echo $update_requests->rowAttributes() ?>>
<?php

// Render list options (body, left)
$update_requests_list->ListOptions->render("body", "left", $update_requests_list->RowCount);
?>
	<?php if ($update_requests_list->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $update_requests_list->ClientId->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_ClientId">
<span<?php echo $update_requests_list->ClientId->viewAttributes() ?>><?php echo $update_requests_list->ClientId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->NewClientIdentity->Visible) { // NewClientIdentity ?>
		<td data-name="NewClientIdentity" <?php echo $update_requests_list->NewClientIdentity->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_NewClientIdentity">
<span<?php echo $update_requests_list->NewClientIdentity->viewAttributes() ?>><?php echo $update_requests_list->NewClientIdentity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->NewClientName->Visible) { // NewClientName ?>
		<td data-name="NewClientName" <?php echo $update_requests_list->NewClientName->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_NewClientName">
<span<?php echo $update_requests_list->NewClientName->viewAttributes() ?>><?php echo $update_requests_list->NewClientName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->NewAccountType->Visible) { // NewAccountType ?>
		<td data-name="NewAccountType" <?php echo $update_requests_list->NewAccountType->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_NewAccountType">
<span<?php echo $update_requests_list->NewAccountType->viewAttributes() ?>><?php echo $update_requests_list->NewAccountType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->NewMobileNumber->Visible) { // NewMobileNumber ?>
		<td data-name="NewMobileNumber" <?php echo $update_requests_list->NewMobileNumber->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_NewMobileNumber">
<span<?php echo $update_requests_list->NewMobileNumber->viewAttributes() ?>><?php echo $update_requests_list->NewMobileNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->NewEmail->Visible) { // NewEmail ?>
		<td data-name="NewEmail" <?php echo $update_requests_list->NewEmail->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_NewEmail">
<span<?php echo $update_requests_list->NewEmail->viewAttributes() ?>><?php echo $update_requests_list->NewEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->date->Visible) { // date ?>
		<td data-name="date" <?php echo $update_requests_list->date->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_date">
<span<?php echo $update_requests_list->date->viewAttributes() ?>><?php echo $update_requests_list->date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $update_requests_list->status->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_status">
<span<?php echo $update_requests_list->status->viewAttributes() ?>><?php echo $update_requests_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->Property->Visible) { // Property ?>
		<td data-name="Property" <?php echo $update_requests_list->Property->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_Property">
<span<?php echo $update_requests_list->Property->viewAttributes() ?>><?php echo $update_requests_list->Property->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" <?php echo $update_requests_list->PropertyId->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_PropertyId">
<span<?php echo $update_requests_list->PropertyId->viewAttributes() ?>><?php echo $update_requests_list->PropertyId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $update_requests_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_PropertyUse">
<span<?php echo $update_requests_list->PropertyUse->viewAttributes() ?>><?php echo $update_requests_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($update_requests_list->Comment->Visible) { // Comment ?>
		<td data-name="Comment" <?php echo $update_requests_list->Comment->cellAttributes() ?>>
<span id="el<?php echo $update_requests_list->RowCount ?>_update_requests_Comment">
<span<?php echo $update_requests_list->Comment->viewAttributes() ?>><?php echo $update_requests_list->Comment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$update_requests_list->ListOptions->render("body", "right", $update_requests_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$update_requests_list->isGridAdd())
		$update_requests_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$update_requests->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($update_requests_list->Recordset)
	$update_requests_list->Recordset->Close();
?>
<?php if (!$update_requests_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$update_requests_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $update_requests_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $update_requests_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($update_requests_list->TotalRecords == 0 && !$update_requests->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $update_requests_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$update_requests_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$update_requests_list->isExport()) { ?>
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
$update_requests_list->terminate();
?>