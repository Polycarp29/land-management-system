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
$charges_list = new charges_list();

// Run the page
$charges_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charges_list->isExport()) { ?>
<script>
var fchargeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fchargeslist = currentForm = new ew.Form("fchargeslist", "list");
	fchargeslist.formKeyCountName = '<?php echo $charges_list->FormKeyCountName ?>';
	loadjs.done("fchargeslist");
});
var fchargeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fchargeslistsrch = currentSearchForm = new ew.Form("fchargeslistsrch");

	// Dynamic selection lists
	// Filters

	fchargeslistsrch.filterList = <?php echo $charges_list->getFilterList() ?>;
	loadjs.done("fchargeslistsrch");
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
<?php if (!$charges_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($charges_list->TotalRecords > 0 && $charges_list->ExportOptions->visible()) { ?>
<?php $charges_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($charges_list->ImportOptions->visible()) { ?>
<?php $charges_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($charges_list->SearchOptions->visible()) { ?>
<?php $charges_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($charges_list->FilterOptions->visible()) { ?>
<?php $charges_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$charges_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$charges_list->isExport() && !$charges->CurrentAction) { ?>
<form name="fchargeslistsrch" id="fchargeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fchargeslistsrch-search-panel" class="<?php echo $charges_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="charges">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $charges_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($charges_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($charges_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $charges_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $charges_list->showPageHeader(); ?>
<?php
$charges_list->showMessage();
?>
<?php if ($charges_list->TotalRecords > 0 || $charges->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($charges_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> charges">
<?php if (!$charges_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$charges_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charges_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fchargeslist" id="fchargeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<div id="gmp_charges" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($charges_list->TotalRecords > 0 || $charges_list->isGridEdit()) { ?>
<table id="tbl_chargeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$charges->RowType = ROWTYPE_HEADER;

// Render list options
$charges_list->renderListOptions();

// Render list options (header, left)
$charges_list->ListOptions->render("header", "left");
?>
<?php if ($charges_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $charges_list->ChargeCode->headerCellClass() ?>"><div id="elh_charges_ChargeCode" class="charges_ChargeCode"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $charges_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeCode) ?>', 1);"><div id="elh_charges_ChargeCode" class="charges_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $charges_list->ChargeGroup->headerCellClass() ?>"><div id="elh_charges_ChargeGroup" class="charges_ChargeGroup"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $charges_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeGroup) ?>', 1);"><div id="elh_charges_ChargeGroup" class="charges_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeDesc) == "") { ?>
		<th data-name="ChargeDesc" class="<?php echo $charges_list->ChargeDesc->headerCellClass() ?>"><div id="elh_charges_ChargeDesc" class="charges_ChargeDesc"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeDesc" class="<?php echo $charges_list->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeDesc) ?>', 1);"><div id="elh_charges_ChargeDesc" class="charges_ChargeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($charges_list->SortUrl($charges_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $charges_list->PropertyUse->headerCellClass() ?>"><div id="elh_charges_PropertyUse" class="charges_PropertyUse"><div class="ew-table-header-caption"><?php echo $charges_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $charges_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->PropertyUse) ?>', 1);"><div id="elh_charges_PropertyUse" class="charges_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->Fee->Visible) { // Fee ?>
	<?php if ($charges_list->SortUrl($charges_list->Fee) == "") { ?>
		<th data-name="Fee" class="<?php echo $charges_list->Fee->headerCellClass() ?>"><div id="elh_charges_Fee" class="charges_Fee"><div class="ew-table-header-caption"><?php echo $charges_list->Fee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fee" class="<?php echo $charges_list->Fee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->Fee) ?>', 1);"><div id="elh_charges_Fee" class="charges_Fee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->Fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->Fee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->Fee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->Factor->Visible) { // Factor ?>
	<?php if ($charges_list->SortUrl($charges_list->Factor) == "") { ?>
		<th data-name="Factor" class="<?php echo $charges_list->Factor->headerCellClass() ?>"><div id="elh_charges_Factor" class="charges_Factor"><div class="ew-table-header-caption"><?php echo $charges_list->Factor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Factor" class="<?php echo $charges_list->Factor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->Factor) ?>', 1);"><div id="elh_charges_Factor" class="charges_Factor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->Factor->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->Factor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->Factor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($charges_list->SortUrl($charges_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $charges_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_charges_UnitOfMeasure" class="charges_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $charges_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $charges_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->UnitOfMeasure) ?>', 1);"><div id="elh_charges_UnitOfMeasure" class="charges_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charges_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($charges_list->SortUrl($charges_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $charges_list->PeriodType->headerCellClass() ?>"><div id="elh_charges_PeriodType" class="charges_PeriodType"><div class="ew-table-header-caption"><?php echo $charges_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $charges_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->PeriodType) ?>', 1);"><div id="elh_charges_PeriodType" class="charges_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$charges_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($charges_list->ExportAll && $charges_list->isExport()) {
	$charges_list->StopRecord = $charges_list->TotalRecords;
} else {

	// Set the last record to display
	if ($charges_list->TotalRecords > $charges_list->StartRecord + $charges_list->DisplayRecords - 1)
		$charges_list->StopRecord = $charges_list->StartRecord + $charges_list->DisplayRecords - 1;
	else
		$charges_list->StopRecord = $charges_list->TotalRecords;
}
$charges_list->RecordCount = $charges_list->StartRecord - 1;
if ($charges_list->Recordset && !$charges_list->Recordset->EOF) {
	$charges_list->Recordset->moveFirst();
	$selectLimit = $charges_list->UseSelectLimit;
	if (!$selectLimit && $charges_list->StartRecord > 1)
		$charges_list->Recordset->move($charges_list->StartRecord - 1);
} elseif (!$charges->AllowAddDeleteRow && $charges_list->StopRecord == 0) {
	$charges_list->StopRecord = $charges->GridAddRowCount;
}

// Initialize aggregate
$charges->RowType = ROWTYPE_AGGREGATEINIT;
$charges->resetAttributes();
$charges_list->renderRow();
while ($charges_list->RecordCount < $charges_list->StopRecord) {
	$charges_list->RecordCount++;
	if ($charges_list->RecordCount >= $charges_list->StartRecord) {
		$charges_list->RowCount++;

		// Set up key count
		$charges_list->KeyCount = $charges_list->RowIndex;

		// Init row class and style
		$charges->resetAttributes();
		$charges->CssClass = "";
		if ($charges_list->isGridAdd()) {
		} else {
			$charges_list->loadRowValues($charges_list->Recordset); // Load row values
		}
		$charges->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$charges->RowAttrs->merge(["data-rowindex" => $charges_list->RowCount, "id" => "r" . $charges_list->RowCount . "_charges", "data-rowtype" => $charges->RowType]);

		// Render row
		$charges_list->renderRow();

		// Render list options
		$charges_list->renderListOptions();
?>
	<tr <?php echo $charges->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charges_list->ListOptions->render("body", "left", $charges_list->RowCount);
?>
	<?php if ($charges_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $charges_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeCode">
<span<?php echo $charges_list->ChargeCode->viewAttributes() ?>><?php echo $charges_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $charges_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeGroup">
<span<?php echo $charges_list->ChargeGroup->viewAttributes() ?>><?php echo $charges_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" <?php echo $charges_list->ChargeDesc->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeDesc">
<span<?php echo $charges_list->ChargeDesc->viewAttributes() ?>><?php echo $charges_list->ChargeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $charges_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PropertyUse">
<span<?php echo $charges_list->PropertyUse->viewAttributes() ?>><?php echo $charges_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->Fee->Visible) { // Fee ?>
		<td data-name="Fee" <?php echo $charges_list->Fee->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Fee">
<span<?php echo $charges_list->Fee->viewAttributes() ?>><?php echo $charges_list->Fee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->Factor->Visible) { // Factor ?>
		<td data-name="Factor" <?php echo $charges_list->Factor->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Factor">
<span<?php echo $charges_list->Factor->viewAttributes() ?>><?php echo $charges_list->Factor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $charges_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_UnitOfMeasure">
<span<?php echo $charges_list->UnitOfMeasure->viewAttributes() ?>><?php echo $charges_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charges_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $charges_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PeriodType">
<span<?php echo $charges_list->PeriodType->viewAttributes() ?>><?php echo $charges_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charges_list->ListOptions->render("body", "right", $charges_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$charges_list->isGridAdd())
		$charges_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$charges->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($charges_list->Recordset)
	$charges_list->Recordset->Close();
?>
<?php if (!$charges_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$charges_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charges_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($charges_list->TotalRecords == 0 && !$charges->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $charges_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$charges_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charges_list->isExport()) { ?>
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
$charges_list->terminate();
?>