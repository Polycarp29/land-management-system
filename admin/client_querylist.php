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
$client_query_list = new client_query_list();

// Run the page
$client_query_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_query_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$client_query_list->isExport()) { ?>
<script>
var fclient_querylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fclient_querylist = currentForm = new ew.Form("fclient_querylist", "list");
	fclient_querylist.formKeyCountName = '<?php echo $client_query_list->FormKeyCountName ?>';
	loadjs.done("fclient_querylist");
});
var fclient_querylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fclient_querylistsrch = currentSearchForm = new ew.Form("fclient_querylistsrch");

	// Dynamic selection lists
	// Filters

	fclient_querylistsrch.filterList = <?php echo $client_query_list->getFilterList() ?>;
	loadjs.done("fclient_querylistsrch");
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
<?php if (!$client_query_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($client_query_list->TotalRecords > 0 && $client_query_list->ExportOptions->visible()) { ?>
<?php $client_query_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($client_query_list->ImportOptions->visible()) { ?>
<?php $client_query_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($client_query_list->SearchOptions->visible()) { ?>
<?php $client_query_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($client_query_list->FilterOptions->visible()) { ?>
<?php $client_query_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$client_query_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$client_query_list->isExport() && !$client_query->CurrentAction) { ?>
<form name="fclient_querylistsrch" id="fclient_querylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fclient_querylistsrch-search-panel" class="<?php echo $client_query_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="client_query">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $client_query_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($client_query_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($client_query_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $client_query_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($client_query_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($client_query_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($client_query_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($client_query_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $client_query_list->showPageHeader(); ?>
<?php
$client_query_list->showMessage();
?>
<?php if ($client_query_list->TotalRecords > 0 || $client_query->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($client_query_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> client_query">
<?php if (!$client_query_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$client_query_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_query_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $client_query_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fclient_querylist" id="fclient_querylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_query">
<div id="gmp_client_query" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($client_query_list->TotalRecords > 0 || $client_query_list->isGridEdit()) { ?>
<table id="tbl_client_querylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$client_query->RowType = ROWTYPE_HEADER;

// Render list options
$client_query_list->renderListOptions();

// Render list options (header, left)
$client_query_list->ListOptions->render("header", "left");
?>
<?php if ($client_query_list->ClientId->Visible) { // ClientId ?>
	<?php if ($client_query_list->SortUrl($client_query_list->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $client_query_list->ClientId->headerCellClass() ?>"><div id="elh_client_query_ClientId" class="client_query_ClientId"><div class="ew-table-header-caption"><?php echo $client_query_list->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $client_query_list->ClientId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_query_list->SortUrl($client_query_list->ClientId) ?>', 1);"><div id="elh_client_query_ClientId" class="client_query_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_query_list->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_query_list->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_query_list->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_query_list->Date->Visible) { // Date ?>
	<?php if ($client_query_list->SortUrl($client_query_list->Date) == "") { ?>
		<th data-name="Date" class="<?php echo $client_query_list->Date->headerCellClass() ?>"><div id="elh_client_query_Date" class="client_query_Date"><div class="ew-table-header-caption"><?php echo $client_query_list->Date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Date" class="<?php echo $client_query_list->Date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_query_list->SortUrl($client_query_list->Date) ?>', 1);"><div id="elh_client_query_Date" class="client_query_Date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_query_list->Date->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_query_list->Date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_query_list->Date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_query_list->Status->Visible) { // Status ?>
	<?php if ($client_query_list->SortUrl($client_query_list->Status) == "") { ?>
		<th data-name="Status" class="<?php echo $client_query_list->Status->headerCellClass() ?>"><div id="elh_client_query_Status" class="client_query_Status"><div class="ew-table-header-caption"><?php echo $client_query_list->Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status" class="<?php echo $client_query_list->Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_query_list->SortUrl($client_query_list->Status) ?>', 1);"><div id="elh_client_query_Status" class="client_query_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_query_list->Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_query_list->Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_query_list->Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$client_query_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($client_query_list->ExportAll && $client_query_list->isExport()) {
	$client_query_list->StopRecord = $client_query_list->TotalRecords;
} else {

	// Set the last record to display
	if ($client_query_list->TotalRecords > $client_query_list->StartRecord + $client_query_list->DisplayRecords - 1)
		$client_query_list->StopRecord = $client_query_list->StartRecord + $client_query_list->DisplayRecords - 1;
	else
		$client_query_list->StopRecord = $client_query_list->TotalRecords;
}
$client_query_list->RecordCount = $client_query_list->StartRecord - 1;
if ($client_query_list->Recordset && !$client_query_list->Recordset->EOF) {
	$client_query_list->Recordset->moveFirst();
	$selectLimit = $client_query_list->UseSelectLimit;
	if (!$selectLimit && $client_query_list->StartRecord > 1)
		$client_query_list->Recordset->move($client_query_list->StartRecord - 1);
} elseif (!$client_query->AllowAddDeleteRow && $client_query_list->StopRecord == 0) {
	$client_query_list->StopRecord = $client_query->GridAddRowCount;
}

// Initialize aggregate
$client_query->RowType = ROWTYPE_AGGREGATEINIT;
$client_query->resetAttributes();
$client_query_list->renderRow();
while ($client_query_list->RecordCount < $client_query_list->StopRecord) {
	$client_query_list->RecordCount++;
	if ($client_query_list->RecordCount >= $client_query_list->StartRecord) {
		$client_query_list->RowCount++;

		// Set up key count
		$client_query_list->KeyCount = $client_query_list->RowIndex;

		// Init row class and style
		$client_query->resetAttributes();
		$client_query->CssClass = "";
		if ($client_query_list->isGridAdd()) {
		} else {
			$client_query_list->loadRowValues($client_query_list->Recordset); // Load row values
		}
		$client_query->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$client_query->RowAttrs->merge(["data-rowindex" => $client_query_list->RowCount, "id" => "r" . $client_query_list->RowCount . "_client_query", "data-rowtype" => $client_query->RowType]);

		// Render row
		$client_query_list->renderRow();

		// Render list options
		$client_query_list->renderListOptions();
?>
	<tr <?php echo $client_query->rowAttributes() ?>>
<?php

// Render list options (body, left)
$client_query_list->ListOptions->render("body", "left", $client_query_list->RowCount);
?>
	<?php if ($client_query_list->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $client_query_list->ClientId->cellAttributes() ?>>
<span id="el<?php echo $client_query_list->RowCount ?>_client_query_ClientId">
<span<?php echo $client_query_list->ClientId->viewAttributes() ?>><?php echo $client_query_list->ClientId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_query_list->Date->Visible) { // Date ?>
		<td data-name="Date" <?php echo $client_query_list->Date->cellAttributes() ?>>
<span id="el<?php echo $client_query_list->RowCount ?>_client_query_Date">
<span<?php echo $client_query_list->Date->viewAttributes() ?>><?php echo $client_query_list->Date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_query_list->Status->Visible) { // Status ?>
		<td data-name="Status" <?php echo $client_query_list->Status->cellAttributes() ?>>
<span id="el<?php echo $client_query_list->RowCount ?>_client_query_Status">
<span<?php echo $client_query_list->Status->viewAttributes() ?>><?php echo $client_query_list->Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$client_query_list->ListOptions->render("body", "right", $client_query_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$client_query_list->isGridAdd())
		$client_query_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$client_query->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($client_query_list->Recordset)
	$client_query_list->Recordset->Close();
?>
<?php if (!$client_query_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$client_query_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_query_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $client_query_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($client_query_list->TotalRecords == 0 && !$client_query->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $client_query_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$client_query_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$client_query_list->isExport()) { ?>
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
$client_query_list->terminate();
?>