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
$reportview_list = new reportview_list();

// Run the page
$reportview_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reportview_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$reportview_list->isExport()) { ?>
<script>
var freportviewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freportviewlist = currentForm = new ew.Form("freportviewlist", "list");
	freportviewlist.formKeyCountName = '<?php echo $reportview_list->FormKeyCountName ?>';
	loadjs.done("freportviewlist");
});
var freportviewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freportviewlistsrch = currentSearchForm = new ew.Form("freportviewlistsrch");

	// Dynamic selection lists
	// Filters

	freportviewlistsrch.filterList = <?php echo $reportview_list->getFilterList() ?>;
	loadjs.done("freportviewlistsrch");
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
<?php if (!$reportview_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($reportview_list->TotalRecords > 0 && $reportview_list->ExportOptions->visible()) { ?>
<?php $reportview_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($reportview_list->ImportOptions->visible()) { ?>
<?php $reportview_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($reportview_list->SearchOptions->visible()) { ?>
<?php $reportview_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($reportview_list->FilterOptions->visible()) { ?>
<?php $reportview_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$reportview_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$reportview_list->isExport() && !$reportview->CurrentAction) { ?>
<form name="freportviewlistsrch" id="freportviewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freportviewlistsrch-search-panel" class="<?php echo $reportview_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="reportview">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $reportview_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($reportview_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($reportview_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $reportview_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($reportview_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($reportview_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($reportview_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($reportview_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $reportview_list->showPageHeader(); ?>
<?php
$reportview_list->showMessage();
?>
<?php if ($reportview_list->TotalRecords > 0 || $reportview->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($reportview_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> reportview">
<?php if (!$reportview_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$reportview_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $reportview_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $reportview_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freportviewlist" id="freportviewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reportview">
<div id="gmp_reportview" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($reportview_list->TotalRecords > 0 || $reportview_list->isGridEdit()) { ?>
<table id="tbl_reportviewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$reportview->RowType = ROWTYPE_HEADER;

// Render list options
$reportview_list->renderListOptions();

// Render list options (header, left)
$reportview_list->ListOptions->render("header", "left");
?>
<?php if ($reportview_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
	<?php if ($reportview_list->SortUrl($reportview_list->ChargeGroupName) == "") { ?>
		<th data-name="ChargeGroupName" class="<?php echo $reportview_list->ChargeGroupName->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_reportview_ChargeGroupName" class="reportview_ChargeGroupName"><div class="ew-table-header-caption"><?php echo $reportview_list->ChargeGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroupName" class="<?php echo $reportview_list->ChargeGroupName->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reportview_list->SortUrl($reportview_list->ChargeGroupName) ?>', 1);"><div id="elh_reportview_ChargeGroupName" class="reportview_ChargeGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reportview_list->ChargeGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reportview_list->ChargeGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reportview_list->ChargeGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reportview_list->AmountPayable->Visible) { // AmountPayable ?>
	<?php if ($reportview_list->SortUrl($reportview_list->AmountPayable) == "") { ?>
		<th data-name="AmountPayable" class="<?php echo $reportview_list->AmountPayable->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_reportview_AmountPayable" class="reportview_AmountPayable"><div class="ew-table-header-caption"><?php echo $reportview_list->AmountPayable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPayable" class="<?php echo $reportview_list->AmountPayable->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reportview_list->SortUrl($reportview_list->AmountPayable) ?>', 1);"><div id="elh_reportview_AmountPayable" class="reportview_AmountPayable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reportview_list->AmountPayable->caption() ?></span><span class="ew-table-header-sort"><?php if ($reportview_list->AmountPayable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reportview_list->AmountPayable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reportview_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($reportview_list->SortUrl($reportview_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $reportview_list->AmountPaid->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_reportview_AmountPaid" class="reportview_AmountPaid"><div class="ew-table-header-caption"><?php echo $reportview_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $reportview_list->AmountPaid->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reportview_list->SortUrl($reportview_list->AmountPaid) ?>', 1);"><div id="elh_reportview_AmountPaid" class="reportview_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reportview_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($reportview_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reportview_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reportview_list->Balance->Visible) { // Balance ?>
	<?php if ($reportview_list->SortUrl($reportview_list->Balance) == "") { ?>
		<th data-name="Balance" class="<?php echo $reportview_list->Balance->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_reportview_Balance" class="reportview_Balance"><div class="ew-table-header-caption"><?php echo $reportview_list->Balance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Balance" class="<?php echo $reportview_list->Balance->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reportview_list->SortUrl($reportview_list->Balance) ?>', 1);"><div id="elh_reportview_Balance" class="reportview_Balance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reportview_list->Balance->caption() ?></span><span class="ew-table-header-sort"><?php if ($reportview_list->Balance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reportview_list->Balance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reportview_list->date->Visible) { // date ?>
	<?php if ($reportview_list->SortUrl($reportview_list->date) == "") { ?>
		<th data-name="date" class="<?php echo $reportview_list->date->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_reportview_date" class="reportview_date"><div class="ew-table-header-caption"><?php echo $reportview_list->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $reportview_list->date->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reportview_list->SortUrl($reportview_list->date) ?>', 1);"><div id="elh_reportview_date" class="reportview_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reportview_list->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($reportview_list->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reportview_list->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$reportview_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($reportview_list->ExportAll && $reportview_list->isExport()) {
	$reportview_list->StopRecord = $reportview_list->TotalRecords;
} else {

	// Set the last record to display
	if ($reportview_list->TotalRecords > $reportview_list->StartRecord + $reportview_list->DisplayRecords - 1)
		$reportview_list->StopRecord = $reportview_list->StartRecord + $reportview_list->DisplayRecords - 1;
	else
		$reportview_list->StopRecord = $reportview_list->TotalRecords;
}
$reportview_list->RecordCount = $reportview_list->StartRecord - 1;
if ($reportview_list->Recordset && !$reportview_list->Recordset->EOF) {
	$reportview_list->Recordset->moveFirst();
	$selectLimit = $reportview_list->UseSelectLimit;
	if (!$selectLimit && $reportview_list->StartRecord > 1)
		$reportview_list->Recordset->move($reportview_list->StartRecord - 1);
} elseif (!$reportview->AllowAddDeleteRow && $reportview_list->StopRecord == 0) {
	$reportview_list->StopRecord = $reportview->GridAddRowCount;
}

// Initialize aggregate
$reportview->RowType = ROWTYPE_AGGREGATEINIT;
$reportview->resetAttributes();
$reportview_list->renderRow();
while ($reportview_list->RecordCount < $reportview_list->StopRecord) {
	$reportview_list->RecordCount++;
	if ($reportview_list->RecordCount >= $reportview_list->StartRecord) {
		$reportview_list->RowCount++;

		// Set up key count
		$reportview_list->KeyCount = $reportview_list->RowIndex;

		// Init row class and style
		$reportview->resetAttributes();
		$reportview->CssClass = "";
		if ($reportview_list->isGridAdd()) {
		} else {
			$reportview_list->loadRowValues($reportview_list->Recordset); // Load row values
		}
		$reportview->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$reportview->RowAttrs->merge(["data-rowindex" => $reportview_list->RowCount, "id" => "r" . $reportview_list->RowCount . "_reportview", "data-rowtype" => $reportview->RowType]);

		// Render row
		$reportview_list->renderRow();

		// Render list options
		$reportview_list->renderListOptions();
?>
	<tr <?php echo $reportview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$reportview_list->ListOptions->render("body", "left", $reportview_list->RowCount);
?>
	<?php if ($reportview_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<td data-name="ChargeGroupName" <?php echo $reportview_list->ChargeGroupName->cellAttributes() ?>>
<span id="el<?php echo $reportview_list->RowCount ?>_reportview_ChargeGroupName">
<span<?php echo $reportview_list->ChargeGroupName->viewAttributes() ?>><?php echo $reportview_list->ChargeGroupName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reportview_list->AmountPayable->Visible) { // AmountPayable ?>
		<td data-name="AmountPayable" <?php echo $reportview_list->AmountPayable->cellAttributes() ?>>
<span id="el<?php echo $reportview_list->RowCount ?>_reportview_AmountPayable">
<span<?php echo $reportview_list->AmountPayable->viewAttributes() ?>><?php echo $reportview_list->AmountPayable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reportview_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $reportview_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $reportview_list->RowCount ?>_reportview_AmountPaid">
<span<?php echo $reportview_list->AmountPaid->viewAttributes() ?>><?php echo $reportview_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reportview_list->Balance->Visible) { // Balance ?>
		<td data-name="Balance" <?php echo $reportview_list->Balance->cellAttributes() ?>>
<span id="el<?php echo $reportview_list->RowCount ?>_reportview_Balance">
<span<?php echo $reportview_list->Balance->viewAttributes() ?>><?php echo $reportview_list->Balance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reportview_list->date->Visible) { // date ?>
		<td data-name="date" <?php echo $reportview_list->date->cellAttributes() ?>>
<span id="el<?php echo $reportview_list->RowCount ?>_reportview_date">
<span<?php echo $reportview_list->date->viewAttributes() ?>><?php echo $reportview_list->date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$reportview_list->ListOptions->render("body", "right", $reportview_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$reportview_list->isGridAdd())
		$reportview_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$reportview->RowType = ROWTYPE_AGGREGATE;
$reportview->resetAttributes();
$reportview_list->renderRow();
?>
<?php if ($reportview_list->TotalRecords > 0 && !$reportview_list->isGridAdd() && !$reportview_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$reportview_list->renderListOptions();

// Render list options (footer, left)
$reportview_list->ListOptions->render("footer", "left");
?>
	<?php if ($reportview_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<td data-name="ChargeGroupName" class="<?php echo $reportview_list->ChargeGroupName->footerCellClass() ?>"><span id="elf_reportview_ChargeGroupName" class="reportview_ChargeGroupName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($reportview_list->AmountPayable->Visible) { // AmountPayable ?>
		<td data-name="AmountPayable" class="<?php echo $reportview_list->AmountPayable->footerCellClass() ?>"><span id="elf_reportview_AmountPayable" class="reportview_AmountPayable">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $reportview_list->AmountPayable->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($reportview_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $reportview_list->AmountPaid->footerCellClass() ?>"><span id="elf_reportview_AmountPaid" class="reportview_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $reportview_list->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($reportview_list->Balance->Visible) { // Balance ?>
		<td data-name="Balance" class="<?php echo $reportview_list->Balance->footerCellClass() ?>"><span id="elf_reportview_Balance" class="reportview_Balance">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($reportview_list->date->Visible) { // date ?>
		<td data-name="date" class="<?php echo $reportview_list->date->footerCellClass() ?>"><span id="elf_reportview_date" class="reportview_date">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$reportview_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$reportview->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($reportview_list->Recordset)
	$reportview_list->Recordset->Close();
?>
<?php if (!$reportview_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$reportview_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $reportview_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $reportview_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($reportview_list->TotalRecords == 0 && !$reportview->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $reportview_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$reportview_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$reportview_list->isExport()) { ?>
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
$reportview_list->terminate();
?>