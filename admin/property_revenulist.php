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
$property_revenu_list = new property_revenu_list();

// Run the page
$property_revenu_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_revenu_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_revenu_list->isExport()) { ?>
<script>
var fproperty_revenulist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_revenulist = currentForm = new ew.Form("fproperty_revenulist", "list");
	fproperty_revenulist.formKeyCountName = '<?php echo $property_revenu_list->FormKeyCountName ?>';
	loadjs.done("fproperty_revenulist");
});
var fproperty_revenulistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_revenulistsrch = currentSearchForm = new ew.Form("fproperty_revenulistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_revenulistsrch.filterList = <?php echo $property_revenu_list->getFilterList() ?>;
	loadjs.done("fproperty_revenulistsrch");
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
<?php if (!$property_revenu_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_revenu_list->TotalRecords > 0 && $property_revenu_list->ExportOptions->visible()) { ?>
<?php $property_revenu_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_revenu_list->ImportOptions->visible()) { ?>
<?php $property_revenu_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_revenu_list->SearchOptions->visible()) { ?>
<?php $property_revenu_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_revenu_list->FilterOptions->visible()) { ?>
<?php $property_revenu_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$property_revenu_list->isExport() || Config("EXPORT_MASTER_RECORD") && $property_revenu_list->isExport("print")) { ?>
<?php
if ($property_revenu_list->DbMasterFilter != "" && $property_revenu->getCurrentMasterTable() == "client") {
	if ($property_revenu_list->MasterRecordExists) {
		include_once "clientmaster.php";
	}
}
?>
<?php } ?>
<?php
$property_revenu_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_revenu_list->isExport() && !$property_revenu->CurrentAction) { ?>
<form name="fproperty_revenulistsrch" id="fproperty_revenulistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_revenulistsrch-search-panel" class="<?php echo $property_revenu_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_revenu">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_revenu_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_revenu_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_revenu_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_revenu_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_revenu_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_revenu_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_revenu_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_revenu_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_revenu_list->showPageHeader(); ?>
<?php
$property_revenu_list->showMessage();
?>
<?php if ($property_revenu_list->TotalRecords > 0 || $property_revenu->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_revenu_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_revenu">
<?php if (!$property_revenu_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_revenu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_revenu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_revenu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_revenulist" id="fproperty_revenulist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_revenu">
<?php if ($property_revenu->getCurrentMasterTable() == "client" && $property_revenu->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($property_revenu_list->ClientId->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_property_revenu" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_revenu_list->TotalRecords > 0 || $property_revenu_list->isGridEdit()) { ?>
<table id="tbl_property_revenulist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_revenu->RowType = ROWTYPE_HEADER;

// Render list options
$property_revenu_list->renderListOptions();

// Render list options (header, left)
$property_revenu_list->ListOptions->render("header", "left");
?>
<?php if ($property_revenu_list->id->Visible) { // id ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $property_revenu_list->id->headerCellClass() ?>"><div id="elh_property_revenu_id" class="property_revenu_id"><div class="ew-table-header-caption"><?php echo $property_revenu_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $property_revenu_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->id) ?>', 1);"><div id="elh_property_revenu_id" class="property_revenu_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->ClientId->Visible) { // ClientId ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $property_revenu_list->ClientId->headerCellClass() ?>"><div id="elh_property_revenu_ClientId" class="property_revenu_ClientId"><div class="ew-table-header-caption"><?php echo $property_revenu_list->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $property_revenu_list->ClientId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->ClientId) ?>', 1);"><div id="elh_property_revenu_ClientId" class="property_revenu_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->ClientProperty->Visible) { // ClientProperty ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->ClientProperty) == "") { ?>
		<th data-name="ClientProperty" class="<?php echo $property_revenu_list->ClientProperty->headerCellClass() ?>"><div id="elh_property_revenu_ClientProperty" class="property_revenu_ClientProperty"><div class="ew-table-header-caption"><?php echo $property_revenu_list->ClientProperty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientProperty" class="<?php echo $property_revenu_list->ClientProperty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->ClientProperty) ?>', 1);"><div id="elh_property_revenu_ClientProperty" class="property_revenu_ClientProperty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->ClientProperty->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->ClientProperty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->ClientProperty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->PropertyId->Visible) { // PropertyId ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->PropertyId) == "") { ?>
		<th data-name="PropertyId" class="<?php echo $property_revenu_list->PropertyId->headerCellClass() ?>"><div id="elh_property_revenu_PropertyId" class="property_revenu_PropertyId"><div class="ew-table-header-caption"><?php echo $property_revenu_list->PropertyId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyId" class="<?php echo $property_revenu_list->PropertyId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->PropertyId) ?>', 1);"><div id="elh_property_revenu_PropertyId" class="property_revenu_PropertyId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->PropertyId->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->PropertyId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->PropertyId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_revenu_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_revenu_PropertyUse" class="property_revenu_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_revenu_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_revenu_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->PropertyUse) ?>', 1);"><div id="elh_property_revenu_PropertyUse" class="property_revenu_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_revenu_list->AmountPaid->headerCellClass() ?>"><div id="elh_property_revenu_AmountPaid" class="property_revenu_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_revenu_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_revenu_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->AmountPaid) ?>', 1);"><div id="elh_property_revenu_AmountPaid" class="property_revenu_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->Balance->Visible) { // Balance ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->Balance) == "") { ?>
		<th data-name="Balance" class="<?php echo $property_revenu_list->Balance->headerCellClass() ?>"><div id="elh_property_revenu_Balance" class="property_revenu_Balance"><div class="ew-table-header-caption"><?php echo $property_revenu_list->Balance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Balance" class="<?php echo $property_revenu_list->Balance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->Balance) ?>', 1);"><div id="elh_property_revenu_Balance" class="property_revenu_Balance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->Balance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->Balance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->Balance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_list->date->Visible) { // date ?>
	<?php if ($property_revenu_list->SortUrl($property_revenu_list->date) == "") { ?>
		<th data-name="date" class="<?php echo $property_revenu_list->date->headerCellClass() ?>"><div id="elh_property_revenu_date" class="property_revenu_date"><div class="ew-table-header-caption"><?php echo $property_revenu_list->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $property_revenu_list->date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_revenu_list->SortUrl($property_revenu_list->date) ?>', 1);"><div id="elh_property_revenu_date" class="property_revenu_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_list->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_list->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_list->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_revenu_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_revenu_list->ExportAll && $property_revenu_list->isExport()) {
	$property_revenu_list->StopRecord = $property_revenu_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_revenu_list->TotalRecords > $property_revenu_list->StartRecord + $property_revenu_list->DisplayRecords - 1)
		$property_revenu_list->StopRecord = $property_revenu_list->StartRecord + $property_revenu_list->DisplayRecords - 1;
	else
		$property_revenu_list->StopRecord = $property_revenu_list->TotalRecords;
}
$property_revenu_list->RecordCount = $property_revenu_list->StartRecord - 1;
if ($property_revenu_list->Recordset && !$property_revenu_list->Recordset->EOF) {
	$property_revenu_list->Recordset->moveFirst();
	$selectLimit = $property_revenu_list->UseSelectLimit;
	if (!$selectLimit && $property_revenu_list->StartRecord > 1)
		$property_revenu_list->Recordset->move($property_revenu_list->StartRecord - 1);
} elseif (!$property_revenu->AllowAddDeleteRow && $property_revenu_list->StopRecord == 0) {
	$property_revenu_list->StopRecord = $property_revenu->GridAddRowCount;
}

// Initialize aggregate
$property_revenu->RowType = ROWTYPE_AGGREGATEINIT;
$property_revenu->resetAttributes();
$property_revenu_list->renderRow();
while ($property_revenu_list->RecordCount < $property_revenu_list->StopRecord) {
	$property_revenu_list->RecordCount++;
	if ($property_revenu_list->RecordCount >= $property_revenu_list->StartRecord) {
		$property_revenu_list->RowCount++;

		// Set up key count
		$property_revenu_list->KeyCount = $property_revenu_list->RowIndex;

		// Init row class and style
		$property_revenu->resetAttributes();
		$property_revenu->CssClass = "";
		if ($property_revenu_list->isGridAdd()) {
		} else {
			$property_revenu_list->loadRowValues($property_revenu_list->Recordset); // Load row values
		}
		$property_revenu->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_revenu->RowAttrs->merge(["data-rowindex" => $property_revenu_list->RowCount, "id" => "r" . $property_revenu_list->RowCount . "_property_revenu", "data-rowtype" => $property_revenu->RowType]);

		// Render row
		$property_revenu_list->renderRow();

		// Render list options
		$property_revenu_list->renderListOptions();
?>
	<tr <?php echo $property_revenu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_revenu_list->ListOptions->render("body", "left", $property_revenu_list->RowCount);
?>
	<?php if ($property_revenu_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $property_revenu_list->id->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_id">
<span<?php echo $property_revenu_list->id->viewAttributes() ?>><?php echo $property_revenu_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $property_revenu_list->ClientId->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_ClientId">
<span<?php echo $property_revenu_list->ClientId->viewAttributes() ?>><?php echo $property_revenu_list->ClientId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->ClientProperty->Visible) { // ClientProperty ?>
		<td data-name="ClientProperty" <?php echo $property_revenu_list->ClientProperty->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_ClientProperty">
<span<?php echo $property_revenu_list->ClientProperty->viewAttributes() ?>><?php echo $property_revenu_list->ClientProperty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" <?php echo $property_revenu_list->PropertyId->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_PropertyId">
<span<?php echo $property_revenu_list->PropertyId->viewAttributes() ?>><?php echo $property_revenu_list->PropertyId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_revenu_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_PropertyUse">
<span<?php echo $property_revenu_list->PropertyUse->viewAttributes() ?>><?php echo $property_revenu_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_revenu_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_AmountPaid">
<span<?php echo $property_revenu_list->AmountPaid->viewAttributes() ?>><?php echo $property_revenu_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->Balance->Visible) { // Balance ?>
		<td data-name="Balance" <?php echo $property_revenu_list->Balance->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_Balance">
<span<?php echo $property_revenu_list->Balance->viewAttributes() ?>><?php echo $property_revenu_list->Balance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_revenu_list->date->Visible) { // date ?>
		<td data-name="date" <?php echo $property_revenu_list->date->cellAttributes() ?>>
<span id="el<?php echo $property_revenu_list->RowCount ?>_property_revenu_date">
<span<?php echo $property_revenu_list->date->viewAttributes() ?>><?php echo $property_revenu_list->date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_revenu_list->ListOptions->render("body", "right", $property_revenu_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_revenu_list->isGridAdd())
		$property_revenu_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$property_revenu->RowType = ROWTYPE_AGGREGATE;
$property_revenu->resetAttributes();
$property_revenu_list->renderRow();
?>
<?php if ($property_revenu_list->TotalRecords > 0 && !$property_revenu_list->isGridAdd() && !$property_revenu_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$property_revenu_list->renderListOptions();

// Render list options (footer, left)
$property_revenu_list->ListOptions->render("footer", "left");
?>
	<?php if ($property_revenu_list->id->Visible) { // id ?>
		<td data-name="id" class="<?php echo $property_revenu_list->id->footerCellClass() ?>"><span id="elf_property_revenu_id" class="property_revenu_id">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" class="<?php echo $property_revenu_list->ClientId->footerCellClass() ?>"><span id="elf_property_revenu_ClientId" class="property_revenu_ClientId">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->ClientProperty->Visible) { // ClientProperty ?>
		<td data-name="ClientProperty" class="<?php echo $property_revenu_list->ClientProperty->footerCellClass() ?>"><span id="elf_property_revenu_ClientProperty" class="property_revenu_ClientProperty">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" class="<?php echo $property_revenu_list->PropertyId->footerCellClass() ?>"><span id="elf_property_revenu_PropertyId" class="property_revenu_PropertyId">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" class="<?php echo $property_revenu_list->PropertyUse->footerCellClass() ?>"><span id="elf_property_revenu_PropertyUse" class="property_revenu_PropertyUse">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $property_revenu_list->AmountPaid->footerCellClass() ?>"><span id="elf_property_revenu_AmountPaid" class="property_revenu_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $property_revenu_list->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->Balance->Visible) { // Balance ?>
		<td data-name="Balance" class="<?php echo $property_revenu_list->Balance->footerCellClass() ?>"><span id="elf_property_revenu_Balance" class="property_revenu_Balance">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_list->date->Visible) { // date ?>
		<td data-name="date" class="<?php echo $property_revenu_list->date->footerCellClass() ?>"><span id="elf_property_revenu_date" class="property_revenu_date">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$property_revenu_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_revenu->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_revenu_list->Recordset)
	$property_revenu_list->Recordset->Close();
?>
<?php if (!$property_revenu_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_revenu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_revenu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_revenu_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_revenu_list->TotalRecords == 0 && !$property_revenu->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_revenu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_revenu_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_revenu_list->isExport()) { ?>
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
$property_revenu_list->terminate();
?>