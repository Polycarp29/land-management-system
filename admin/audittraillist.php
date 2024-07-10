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
$audittrail_list = new audittrail_list();

// Run the page
$audittrail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$audittrail_list->isExport()) { ?>
<script>
var faudittraillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faudittraillist = currentForm = new ew.Form("faudittraillist", "list");
	faudittraillist.formKeyCountName = '<?php echo $audittrail_list->FormKeyCountName ?>';
	loadjs.done("faudittraillist");
});
var faudittraillistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faudittraillistsrch = currentSearchForm = new ew.Form("faudittraillistsrch");

	// Dynamic selection lists
	// Filters

	faudittraillistsrch.filterList = <?php echo $audittrail_list->getFilterList() ?>;
	loadjs.done("faudittraillistsrch");
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
<?php if (!$audittrail_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($audittrail_list->TotalRecords > 0 && $audittrail_list->ExportOptions->visible()) { ?>
<?php $audittrail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($audittrail_list->ImportOptions->visible()) { ?>
<?php $audittrail_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($audittrail_list->SearchOptions->visible()) { ?>
<?php $audittrail_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($audittrail_list->FilterOptions->visible()) { ?>
<?php $audittrail_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$audittrail_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$audittrail_list->isExport() && !$audittrail->CurrentAction) { ?>
<form name="faudittraillistsrch" id="faudittraillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faudittraillistsrch-search-panel" class="<?php echo $audittrail_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="audittrail">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $audittrail_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($audittrail_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($audittrail_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $audittrail_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $audittrail_list->showPageHeader(); ?>
<?php
$audittrail_list->showMessage();
?>
<?php if ($audittrail_list->TotalRecords > 0 || $audittrail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($audittrail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> audittrail">
<?php if (!$audittrail_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$audittrail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $audittrail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $audittrail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="faudittraillist" id="faudittraillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<div id="gmp_audittrail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($audittrail_list->TotalRecords > 0 || $audittrail_list->isGridEdit()) { ?>
<table id="tbl_audittraillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$audittrail->RowType = ROWTYPE_HEADER;

// Render list options
$audittrail_list->renderListOptions();

// Render list options (header, left)
$audittrail_list->ListOptions->render("header", "left");
?>
<?php if ($audittrail_list->id->Visible) { // id ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $audittrail_list->id->headerCellClass() ?>"><div id="elh_audittrail_id" class="audittrail_id"><div class="ew-table-header-caption"><?php echo $audittrail_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $audittrail_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->id) ?>', 1);"><div id="elh_audittrail_id" class="audittrail_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail_list->datetime->Visible) { // datetime ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $audittrail_list->datetime->headerCellClass() ?>"><div id="elh_audittrail_datetime" class="audittrail_datetime"><div class="ew-table-header-caption"><?php echo $audittrail_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $audittrail_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->datetime) ?>', 1);"><div id="elh_audittrail_datetime" class="audittrail_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail_list->script->Visible) { // script ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->script) == "") { ?>
		<th data-name="script" class="<?php echo $audittrail_list->script->headerCellClass() ?>"><div id="elh_audittrail_script" class="audittrail_script"><div class="ew-table-header-caption"><?php echo $audittrail_list->script->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="script" class="<?php echo $audittrail_list->script->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->script) ?>', 1);"><div id="elh_audittrail_script" class="audittrail_script">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->script->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->script->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->script->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail_list->user->Visible) { // user ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->user) == "") { ?>
		<th data-name="user" class="<?php echo $audittrail_list->user->headerCellClass() ?>"><div id="elh_audittrail_user" class="audittrail_user"><div class="ew-table-header-caption"><?php echo $audittrail_list->user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user" class="<?php echo $audittrail_list->user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->user) ?>', 1);"><div id="elh_audittrail_user" class="audittrail_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->user->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->user->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail_list->_action->Visible) { // action ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->_action) == "") { ?>
		<th data-name="_action" class="<?php echo $audittrail_list->_action->headerCellClass() ?>"><div id="elh_audittrail__action" class="audittrail__action"><div class="ew-table-header-caption"><?php echo $audittrail_list->_action->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_action" class="<?php echo $audittrail_list->_action->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->_action) ?>', 1);"><div id="elh_audittrail__action" class="audittrail__action">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->_action->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->_action->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->_action->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail_list->_table->Visible) { // table ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->_table) == "") { ?>
		<th data-name="_table" class="<?php echo $audittrail_list->_table->headerCellClass() ?>"><div id="elh_audittrail__table" class="audittrail__table"><div class="ew-table-header-caption"><?php echo $audittrail_list->_table->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_table" class="<?php echo $audittrail_list->_table->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->_table) ?>', 1);"><div id="elh_audittrail__table" class="audittrail__table">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->_table->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->_table->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->_table->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail_list->field->Visible) { // field ?>
	<?php if ($audittrail_list->SortUrl($audittrail_list->field) == "") { ?>
		<th data-name="field" class="<?php echo $audittrail_list->field->headerCellClass() ?>"><div id="elh_audittrail_field" class="audittrail_field"><div class="ew-table-header-caption"><?php echo $audittrail_list->field->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field" class="<?php echo $audittrail_list->field->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $audittrail_list->SortUrl($audittrail_list->field) ?>', 1);"><div id="elh_audittrail_field" class="audittrail_field">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail_list->field->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail_list->field->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($audittrail_list->field->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$audittrail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($audittrail_list->ExportAll && $audittrail_list->isExport()) {
	$audittrail_list->StopRecord = $audittrail_list->TotalRecords;
} else {

	// Set the last record to display
	if ($audittrail_list->TotalRecords > $audittrail_list->StartRecord + $audittrail_list->DisplayRecords - 1)
		$audittrail_list->StopRecord = $audittrail_list->StartRecord + $audittrail_list->DisplayRecords - 1;
	else
		$audittrail_list->StopRecord = $audittrail_list->TotalRecords;
}
$audittrail_list->RecordCount = $audittrail_list->StartRecord - 1;
if ($audittrail_list->Recordset && !$audittrail_list->Recordset->EOF) {
	$audittrail_list->Recordset->moveFirst();
	$selectLimit = $audittrail_list->UseSelectLimit;
	if (!$selectLimit && $audittrail_list->StartRecord > 1)
		$audittrail_list->Recordset->move($audittrail_list->StartRecord - 1);
} elseif (!$audittrail->AllowAddDeleteRow && $audittrail_list->StopRecord == 0) {
	$audittrail_list->StopRecord = $audittrail->GridAddRowCount;
}

// Initialize aggregate
$audittrail->RowType = ROWTYPE_AGGREGATEINIT;
$audittrail->resetAttributes();
$audittrail_list->renderRow();
while ($audittrail_list->RecordCount < $audittrail_list->StopRecord) {
	$audittrail_list->RecordCount++;
	if ($audittrail_list->RecordCount >= $audittrail_list->StartRecord) {
		$audittrail_list->RowCount++;

		// Set up key count
		$audittrail_list->KeyCount = $audittrail_list->RowIndex;

		// Init row class and style
		$audittrail->resetAttributes();
		$audittrail->CssClass = "";
		if ($audittrail_list->isGridAdd()) {
		} else {
			$audittrail_list->loadRowValues($audittrail_list->Recordset); // Load row values
		}
		$audittrail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$audittrail->RowAttrs->merge(["data-rowindex" => $audittrail_list->RowCount, "id" => "r" . $audittrail_list->RowCount . "_audittrail", "data-rowtype" => $audittrail->RowType]);

		// Render row
		$audittrail_list->renderRow();

		// Render list options
		$audittrail_list->renderListOptions();
?>
	<tr <?php echo $audittrail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$audittrail_list->ListOptions->render("body", "left", $audittrail_list->RowCount);
?>
	<?php if ($audittrail_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $audittrail_list->id->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail_id">
<span<?php echo $audittrail_list->id->viewAttributes() ?>><?php echo $audittrail_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $audittrail_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail_datetime">
<span<?php echo $audittrail_list->datetime->viewAttributes() ?>><?php echo $audittrail_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail_list->script->Visible) { // script ?>
		<td data-name="script" <?php echo $audittrail_list->script->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail_script">
<span<?php echo $audittrail_list->script->viewAttributes() ?>><?php echo $audittrail_list->script->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail_list->user->Visible) { // user ?>
		<td data-name="user" <?php echo $audittrail_list->user->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail_user">
<span<?php echo $audittrail_list->user->viewAttributes() ?>><?php echo $audittrail_list->user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail_list->_action->Visible) { // action ?>
		<td data-name="_action" <?php echo $audittrail_list->_action->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail__action">
<span<?php echo $audittrail_list->_action->viewAttributes() ?>><?php echo $audittrail_list->_action->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail_list->_table->Visible) { // table ?>
		<td data-name="_table" <?php echo $audittrail_list->_table->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail__table">
<span<?php echo $audittrail_list->_table->viewAttributes() ?>><?php echo $audittrail_list->_table->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail_list->field->Visible) { // field ?>
		<td data-name="field" <?php echo $audittrail_list->field->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCount ?>_audittrail_field">
<span<?php echo $audittrail_list->field->viewAttributes() ?>><?php echo $audittrail_list->field->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$audittrail_list->ListOptions->render("body", "right", $audittrail_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$audittrail_list->isGridAdd())
		$audittrail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$audittrail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($audittrail_list->Recordset)
	$audittrail_list->Recordset->Close();
?>
<?php if (!$audittrail_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$audittrail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $audittrail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $audittrail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($audittrail_list->TotalRecords == 0 && !$audittrail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $audittrail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$audittrail_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$audittrail_list->isExport()) { ?>
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
$audittrail_list->terminate();
?>