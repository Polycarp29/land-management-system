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
$billing_period_list = new billing_period_list();

// Run the page
$billing_period_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$billing_period_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$billing_period_list->isExport()) { ?>
<script>
var fbilling_periodlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbilling_periodlist = currentForm = new ew.Form("fbilling_periodlist", "list");
	fbilling_periodlist.formKeyCountName = '<?php echo $billing_period_list->FormKeyCountName ?>';
	loadjs.done("fbilling_periodlist");
});
var fbilling_periodlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbilling_periodlistsrch = currentSearchForm = new ew.Form("fbilling_periodlistsrch");

	// Dynamic selection lists
	// Filters

	fbilling_periodlistsrch.filterList = <?php echo $billing_period_list->getFilterList() ?>;
	loadjs.done("fbilling_periodlistsrch");
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
<?php if (!$billing_period_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($billing_period_list->TotalRecords > 0 && $billing_period_list->ExportOptions->visible()) { ?>
<?php $billing_period_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($billing_period_list->ImportOptions->visible()) { ?>
<?php $billing_period_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($billing_period_list->SearchOptions->visible()) { ?>
<?php $billing_period_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($billing_period_list->FilterOptions->visible()) { ?>
<?php $billing_period_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$billing_period_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$billing_period_list->isExport() && !$billing_period->CurrentAction) { ?>
<form name="fbilling_periodlistsrch" id="fbilling_periodlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbilling_periodlistsrch-search-panel" class="<?php echo $billing_period_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="billing_period">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $billing_period_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($billing_period_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($billing_period_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $billing_period_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($billing_period_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($billing_period_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($billing_period_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($billing_period_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $billing_period_list->showPageHeader(); ?>
<?php
$billing_period_list->showMessage();
?>
<?php if ($billing_period_list->TotalRecords > 0 || $billing_period->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($billing_period_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> billing_period">
<?php if (!$billing_period_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$billing_period_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $billing_period_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $billing_period_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbilling_periodlist" id="fbilling_periodlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="billing_period">
<div id="gmp_billing_period" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($billing_period_list->TotalRecords > 0 || $billing_period_list->isGridEdit()) { ?>
<table id="tbl_billing_periodlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$billing_period->RowType = ROWTYPE_HEADER;

// Render list options
$billing_period_list->renderListOptions();

// Render list options (header, left)
$billing_period_list->ListOptions->render("header", "left");
?>
<?php if ($billing_period_list->BillingYear->Visible) { // BillingYear ?>
	<?php if ($billing_period_list->SortUrl($billing_period_list->BillingYear) == "") { ?>
		<th data-name="BillingYear" class="<?php echo $billing_period_list->BillingYear->headerCellClass() ?>"><div id="elh_billing_period_BillingYear" class="billing_period_BillingYear"><div class="ew-table-header-caption"><?php echo $billing_period_list->BillingYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillingYear" class="<?php echo $billing_period_list->BillingYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $billing_period_list->SortUrl($billing_period_list->BillingYear) ?>', 1);"><div id="elh_billing_period_BillingYear" class="billing_period_BillingYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $billing_period_list->BillingYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($billing_period_list->BillingYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($billing_period_list->BillingYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($billing_period_list->BillingCycle->Visible) { // BillingCycle ?>
	<?php if ($billing_period_list->SortUrl($billing_period_list->BillingCycle) == "") { ?>
		<th data-name="BillingCycle" class="<?php echo $billing_period_list->BillingCycle->headerCellClass() ?>"><div id="elh_billing_period_BillingCycle" class="billing_period_BillingCycle"><div class="ew-table-header-caption"><?php echo $billing_period_list->BillingCycle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillingCycle" class="<?php echo $billing_period_list->BillingCycle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $billing_period_list->SortUrl($billing_period_list->BillingCycle) ?>', 1);"><div id="elh_billing_period_BillingCycle" class="billing_period_BillingCycle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $billing_period_list->BillingCycle->caption() ?></span><span class="ew-table-header-sort"><?php if ($billing_period_list->BillingCycle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($billing_period_list->BillingCycle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($billing_period_list->From->Visible) { // From ?>
	<?php if ($billing_period_list->SortUrl($billing_period_list->From) == "") { ?>
		<th data-name="From" class="<?php echo $billing_period_list->From->headerCellClass() ?>"><div id="elh_billing_period_From" class="billing_period_From"><div class="ew-table-header-caption"><?php echo $billing_period_list->From->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="From" class="<?php echo $billing_period_list->From->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $billing_period_list->SortUrl($billing_period_list->From) ?>', 1);"><div id="elh_billing_period_From" class="billing_period_From">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $billing_period_list->From->caption() ?></span><span class="ew-table-header-sort"><?php if ($billing_period_list->From->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($billing_period_list->From->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($billing_period_list->To->Visible) { // To ?>
	<?php if ($billing_period_list->SortUrl($billing_period_list->To) == "") { ?>
		<th data-name="To" class="<?php echo $billing_period_list->To->headerCellClass() ?>"><div id="elh_billing_period_To" class="billing_period_To"><div class="ew-table-header-caption"><?php echo $billing_period_list->To->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="To" class="<?php echo $billing_period_list->To->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $billing_period_list->SortUrl($billing_period_list->To) ?>', 1);"><div id="elh_billing_period_To" class="billing_period_To">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $billing_period_list->To->caption() ?></span><span class="ew-table-header-sort"><?php if ($billing_period_list->To->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($billing_period_list->To->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($billing_period_list->Status->Visible) { // Status ?>
	<?php if ($billing_period_list->SortUrl($billing_period_list->Status) == "") { ?>
		<th data-name="Status" class="<?php echo $billing_period_list->Status->headerCellClass() ?>"><div id="elh_billing_period_Status" class="billing_period_Status"><div class="ew-table-header-caption"><?php echo $billing_period_list->Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status" class="<?php echo $billing_period_list->Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $billing_period_list->SortUrl($billing_period_list->Status) ?>', 1);"><div id="elh_billing_period_Status" class="billing_period_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $billing_period_list->Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($billing_period_list->Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($billing_period_list->Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$billing_period_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($billing_period_list->ExportAll && $billing_period_list->isExport()) {
	$billing_period_list->StopRecord = $billing_period_list->TotalRecords;
} else {

	// Set the last record to display
	if ($billing_period_list->TotalRecords > $billing_period_list->StartRecord + $billing_period_list->DisplayRecords - 1)
		$billing_period_list->StopRecord = $billing_period_list->StartRecord + $billing_period_list->DisplayRecords - 1;
	else
		$billing_period_list->StopRecord = $billing_period_list->TotalRecords;
}
$billing_period_list->RecordCount = $billing_period_list->StartRecord - 1;
if ($billing_period_list->Recordset && !$billing_period_list->Recordset->EOF) {
	$billing_period_list->Recordset->moveFirst();
	$selectLimit = $billing_period_list->UseSelectLimit;
	if (!$selectLimit && $billing_period_list->StartRecord > 1)
		$billing_period_list->Recordset->move($billing_period_list->StartRecord - 1);
} elseif (!$billing_period->AllowAddDeleteRow && $billing_period_list->StopRecord == 0) {
	$billing_period_list->StopRecord = $billing_period->GridAddRowCount;
}

// Initialize aggregate
$billing_period->RowType = ROWTYPE_AGGREGATEINIT;
$billing_period->resetAttributes();
$billing_period_list->renderRow();
while ($billing_period_list->RecordCount < $billing_period_list->StopRecord) {
	$billing_period_list->RecordCount++;
	if ($billing_period_list->RecordCount >= $billing_period_list->StartRecord) {
		$billing_period_list->RowCount++;

		// Set up key count
		$billing_period_list->KeyCount = $billing_period_list->RowIndex;

		// Init row class and style
		$billing_period->resetAttributes();
		$billing_period->CssClass = "";
		if ($billing_period_list->isGridAdd()) {
		} else {
			$billing_period_list->loadRowValues($billing_period_list->Recordset); // Load row values
		}
		$billing_period->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$billing_period->RowAttrs->merge(["data-rowindex" => $billing_period_list->RowCount, "id" => "r" . $billing_period_list->RowCount . "_billing_period", "data-rowtype" => $billing_period->RowType]);

		// Render row
		$billing_period_list->renderRow();

		// Render list options
		$billing_period_list->renderListOptions();
?>
	<tr <?php echo $billing_period->rowAttributes() ?>>
<?php

// Render list options (body, left)
$billing_period_list->ListOptions->render("body", "left", $billing_period_list->RowCount);
?>
	<?php if ($billing_period_list->BillingYear->Visible) { // BillingYear ?>
		<td data-name="BillingYear" <?php echo $billing_period_list->BillingYear->cellAttributes() ?>>
<span id="el<?php echo $billing_period_list->RowCount ?>_billing_period_BillingYear">
<span<?php echo $billing_period_list->BillingYear->viewAttributes() ?>><?php echo $billing_period_list->BillingYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($billing_period_list->BillingCycle->Visible) { // BillingCycle ?>
		<td data-name="BillingCycle" <?php echo $billing_period_list->BillingCycle->cellAttributes() ?>>
<span id="el<?php echo $billing_period_list->RowCount ?>_billing_period_BillingCycle">
<span<?php echo $billing_period_list->BillingCycle->viewAttributes() ?>><?php echo $billing_period_list->BillingCycle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($billing_period_list->From->Visible) { // From ?>
		<td data-name="From" <?php echo $billing_period_list->From->cellAttributes() ?>>
<span id="el<?php echo $billing_period_list->RowCount ?>_billing_period_From">
<span<?php echo $billing_period_list->From->viewAttributes() ?>><?php echo $billing_period_list->From->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($billing_period_list->To->Visible) { // To ?>
		<td data-name="To" <?php echo $billing_period_list->To->cellAttributes() ?>>
<span id="el<?php echo $billing_period_list->RowCount ?>_billing_period_To">
<span<?php echo $billing_period_list->To->viewAttributes() ?>><?php echo $billing_period_list->To->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($billing_period_list->Status->Visible) { // Status ?>
		<td data-name="Status" <?php echo $billing_period_list->Status->cellAttributes() ?>>
<span id="el<?php echo $billing_period_list->RowCount ?>_billing_period_Status">
<span<?php echo $billing_period_list->Status->viewAttributes() ?>><?php echo $billing_period_list->Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$billing_period_list->ListOptions->render("body", "right", $billing_period_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$billing_period_list->isGridAdd())
		$billing_period_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$billing_period->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($billing_period_list->Recordset)
	$billing_period_list->Recordset->Close();
?>
<?php if (!$billing_period_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$billing_period_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $billing_period_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $billing_period_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($billing_period_list->TotalRecords == 0 && !$billing_period->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $billing_period_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$billing_period_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$billing_period_list->isExport()) { ?>
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
$billing_period_list->terminate();
?>