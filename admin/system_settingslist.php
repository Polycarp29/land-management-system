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
$system_settings_list = new system_settings_list();

// Run the page
$system_settings_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$system_settings_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$system_settings_list->isExport()) { ?>
<script>
var fsystem_settingslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsystem_settingslist = currentForm = new ew.Form("fsystem_settingslist", "list");
	fsystem_settingslist.formKeyCountName = '<?php echo $system_settings_list->FormKeyCountName ?>';
	loadjs.done("fsystem_settingslist");
});
var fsystem_settingslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsystem_settingslistsrch = currentSearchForm = new ew.Form("fsystem_settingslistsrch");

	// Dynamic selection lists
	// Filters

	fsystem_settingslistsrch.filterList = <?php echo $system_settings_list->getFilterList() ?>;
	loadjs.done("fsystem_settingslistsrch");
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
<?php if (!$system_settings_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($system_settings_list->TotalRecords > 0 && $system_settings_list->ExportOptions->visible()) { ?>
<?php $system_settings_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($system_settings_list->ImportOptions->visible()) { ?>
<?php $system_settings_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($system_settings_list->SearchOptions->visible()) { ?>
<?php $system_settings_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($system_settings_list->FilterOptions->visible()) { ?>
<?php $system_settings_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$system_settings_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$system_settings_list->isExport() && !$system_settings->CurrentAction) { ?>
<form name="fsystem_settingslistsrch" id="fsystem_settingslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsystem_settingslistsrch-search-panel" class="<?php echo $system_settings_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="system_settings">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $system_settings_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($system_settings_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($system_settings_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $system_settings_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($system_settings_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($system_settings_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($system_settings_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($system_settings_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $system_settings_list->showPageHeader(); ?>
<?php
$system_settings_list->showMessage();
?>
<?php if ($system_settings_list->TotalRecords > 0 || $system_settings->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($system_settings_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> system_settings">
<?php if (!$system_settings_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$system_settings_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $system_settings_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $system_settings_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsystem_settingslist" id="fsystem_settingslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="system_settings">
<div id="gmp_system_settings" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($system_settings_list->TotalRecords > 0 || $system_settings_list->isGridEdit()) { ?>
<table id="tbl_system_settingslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$system_settings->RowType = ROWTYPE_HEADER;

// Render list options
$system_settings_list->renderListOptions();

// Render list options (header, left)
$system_settings_list->ListOptions->render("header", "left");
?>
<?php if ($system_settings_list->name->Visible) { // name ?>
	<?php if ($system_settings_list->SortUrl($system_settings_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $system_settings_list->name->headerCellClass() ?>"><div id="elh_system_settings_name" class="system_settings_name"><div class="ew-table-header-caption"><?php echo $system_settings_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $system_settings_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $system_settings_list->SortUrl($system_settings_list->name) ?>', 1);"><div id="elh_system_settings_name" class="system_settings_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $system_settings_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($system_settings_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($system_settings_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($system_settings_list->_email->Visible) { // email ?>
	<?php if ($system_settings_list->SortUrl($system_settings_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $system_settings_list->_email->headerCellClass() ?>"><div id="elh_system_settings__email" class="system_settings__email"><div class="ew-table-header-caption"><?php echo $system_settings_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $system_settings_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $system_settings_list->SortUrl($system_settings_list->_email) ?>', 1);"><div id="elh_system_settings__email" class="system_settings__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $system_settings_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($system_settings_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($system_settings_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($system_settings_list->contact->Visible) { // contact ?>
	<?php if ($system_settings_list->SortUrl($system_settings_list->contact) == "") { ?>
		<th data-name="contact" class="<?php echo $system_settings_list->contact->headerCellClass() ?>"><div id="elh_system_settings_contact" class="system_settings_contact"><div class="ew-table-header-caption"><?php echo $system_settings_list->contact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="contact" class="<?php echo $system_settings_list->contact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $system_settings_list->SortUrl($system_settings_list->contact) ?>', 1);"><div id="elh_system_settings_contact" class="system_settings_contact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $system_settings_list->contact->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($system_settings_list->contact->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($system_settings_list->contact->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$system_settings_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($system_settings_list->ExportAll && $system_settings_list->isExport()) {
	$system_settings_list->StopRecord = $system_settings_list->TotalRecords;
} else {

	// Set the last record to display
	if ($system_settings_list->TotalRecords > $system_settings_list->StartRecord + $system_settings_list->DisplayRecords - 1)
		$system_settings_list->StopRecord = $system_settings_list->StartRecord + $system_settings_list->DisplayRecords - 1;
	else
		$system_settings_list->StopRecord = $system_settings_list->TotalRecords;
}
$system_settings_list->RecordCount = $system_settings_list->StartRecord - 1;
if ($system_settings_list->Recordset && !$system_settings_list->Recordset->EOF) {
	$system_settings_list->Recordset->moveFirst();
	$selectLimit = $system_settings_list->UseSelectLimit;
	if (!$selectLimit && $system_settings_list->StartRecord > 1)
		$system_settings_list->Recordset->move($system_settings_list->StartRecord - 1);
} elseif (!$system_settings->AllowAddDeleteRow && $system_settings_list->StopRecord == 0) {
	$system_settings_list->StopRecord = $system_settings->GridAddRowCount;
}

// Initialize aggregate
$system_settings->RowType = ROWTYPE_AGGREGATEINIT;
$system_settings->resetAttributes();
$system_settings_list->renderRow();
while ($system_settings_list->RecordCount < $system_settings_list->StopRecord) {
	$system_settings_list->RecordCount++;
	if ($system_settings_list->RecordCount >= $system_settings_list->StartRecord) {
		$system_settings_list->RowCount++;

		// Set up key count
		$system_settings_list->KeyCount = $system_settings_list->RowIndex;

		// Init row class and style
		$system_settings->resetAttributes();
		$system_settings->CssClass = "";
		if ($system_settings_list->isGridAdd()) {
		} else {
			$system_settings_list->loadRowValues($system_settings_list->Recordset); // Load row values
		}
		$system_settings->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$system_settings->RowAttrs->merge(["data-rowindex" => $system_settings_list->RowCount, "id" => "r" . $system_settings_list->RowCount . "_system_settings", "data-rowtype" => $system_settings->RowType]);

		// Render row
		$system_settings_list->renderRow();

		// Render list options
		$system_settings_list->renderListOptions();
?>
	<tr <?php echo $system_settings->rowAttributes() ?>>
<?php

// Render list options (body, left)
$system_settings_list->ListOptions->render("body", "left", $system_settings_list->RowCount);
?>
	<?php if ($system_settings_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $system_settings_list->name->cellAttributes() ?>>
<span id="el<?php echo $system_settings_list->RowCount ?>_system_settings_name">
<span<?php echo $system_settings_list->name->viewAttributes() ?>><?php echo $system_settings_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($system_settings_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $system_settings_list->_email->cellAttributes() ?>>
<span id="el<?php echo $system_settings_list->RowCount ?>_system_settings__email">
<span<?php echo $system_settings_list->_email->viewAttributes() ?>><?php echo $system_settings_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($system_settings_list->contact->Visible) { // contact ?>
		<td data-name="contact" <?php echo $system_settings_list->contact->cellAttributes() ?>>
<span id="el<?php echo $system_settings_list->RowCount ?>_system_settings_contact">
<span<?php echo $system_settings_list->contact->viewAttributes() ?>><?php echo $system_settings_list->contact->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$system_settings_list->ListOptions->render("body", "right", $system_settings_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$system_settings_list->isGridAdd())
		$system_settings_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$system_settings->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($system_settings_list->Recordset)
	$system_settings_list->Recordset->Close();
?>
<?php if (!$system_settings_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$system_settings_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $system_settings_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $system_settings_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($system_settings_list->TotalRecords == 0 && !$system_settings->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $system_settings_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$system_settings_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$system_settings_list->isExport()) { ?>
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
$system_settings_list->terminate();
?>