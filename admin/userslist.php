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
$users_list = new users_list();

// Run the page
$users_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$users_list->isExport()) { ?>
<script>
var fuserslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fuserslist = currentForm = new ew.Form("fuserslist", "list");
	fuserslist.formKeyCountName = '<?php echo $users_list->FormKeyCountName ?>';
	loadjs.done("fuserslist");
});
var fuserslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fuserslistsrch = currentSearchForm = new ew.Form("fuserslistsrch");

	// Dynamic selection lists
	// Filters

	fuserslistsrch.filterList = <?php echo $users_list->getFilterList() ?>;
	loadjs.done("fuserslistsrch");
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
<?php if (!$users_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($users_list->TotalRecords > 0 && $users_list->ExportOptions->visible()) { ?>
<?php $users_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->ImportOptions->visible()) { ?>
<?php $users_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->SearchOptions->visible()) { ?>
<?php $users_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($users_list->FilterOptions->visible()) { ?>
<?php $users_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$users_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$users_list->isExport() && !$users->CurrentAction) { ?>
<form name="fuserslistsrch" id="fuserslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fuserslistsrch-search-panel" class="<?php echo $users_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="users">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $users_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($users_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($users_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $users_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($users_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $users_list->showPageHeader(); ?>
<?php
$users_list->showMessage();
?>
<?php if ($users_list->TotalRecords > 0 || $users->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($users_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> users">
<?php if (!$users_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$users_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $users_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuserslist" id="fuserslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<div id="gmp_users" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($users_list->TotalRecords > 0 || $users_list->isGridEdit()) { ?>
<table id="tbl_userslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$users->RowType = ROWTYPE_HEADER;

// Render list options
$users_list->renderListOptions();

// Render list options (header, left)
$users_list->ListOptions->render("header", "left");
?>
<?php if ($users_list->id->Visible) { // id ?>
	<?php if ($users_list->SortUrl($users_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $users_list->id->headerCellClass() ?>"><div id="elh_users_id" class="users_id"><div class="ew-table-header-caption"><?php echo $users_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $users_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $users_list->SortUrl($users_list->id) ?>', 1);"><div id="elh_users_id" class="users_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($users_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($users_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users_list->Fullname->Visible) { // Fullname ?>
	<?php if ($users_list->SortUrl($users_list->Fullname) == "") { ?>
		<th data-name="Fullname" class="<?php echo $users_list->Fullname->headerCellClass() ?>"><div id="elh_users_Fullname" class="users_Fullname"><div class="ew-table-header-caption"><?php echo $users_list->Fullname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fullname" class="<?php echo $users_list->Fullname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $users_list->SortUrl($users_list->Fullname) ?>', 1);"><div id="elh_users_Fullname" class="users_Fullname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users_list->Fullname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users_list->Fullname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($users_list->Fullname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users_list->Username->Visible) { // Username ?>
	<?php if ($users_list->SortUrl($users_list->Username) == "") { ?>
		<th data-name="Username" class="<?php echo $users_list->Username->headerCellClass() ?>"><div id="elh_users_Username" class="users_Username"><div class="ew-table-header-caption"><?php echo $users_list->Username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Username" class="<?php echo $users_list->Username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $users_list->SortUrl($users_list->Username) ?>', 1);"><div id="elh_users_Username" class="users_Username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users_list->Username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users_list->Username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($users_list->Username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users_list->_Email->Visible) { // Email ?>
	<?php if ($users_list->SortUrl($users_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $users_list->_Email->headerCellClass() ?>"><div id="elh_users__Email" class="users__Email"><div class="ew-table-header-caption"><?php echo $users_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $users_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $users_list->SortUrl($users_list->_Email) ?>', 1);"><div id="elh_users__Email" class="users__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($users_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($users_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users_list->Passsword->Visible) { // Passsword ?>
	<?php if ($users_list->SortUrl($users_list->Passsword) == "") { ?>
		<th data-name="Passsword" class="<?php echo $users_list->Passsword->headerCellClass() ?>"><div id="elh_users_Passsword" class="users_Passsword"><div class="ew-table-header-caption"><?php echo $users_list->Passsword->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Passsword" class="<?php echo $users_list->Passsword->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $users_list->SortUrl($users_list->Passsword) ?>', 1);"><div id="elh_users_Passsword" class="users_Passsword">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users_list->Passsword->caption() ?></span><span class="ew-table-header-sort"><?php if ($users_list->Passsword->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($users_list->Passsword->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($users_list->userLevelId->Visible) { // userLevelId ?>
	<?php if ($users_list->SortUrl($users_list->userLevelId) == "") { ?>
		<th data-name="userLevelId" class="<?php echo $users_list->userLevelId->headerCellClass() ?>"><div id="elh_users_userLevelId" class="users_userLevelId"><div class="ew-table-header-caption"><?php echo $users_list->userLevelId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userLevelId" class="<?php echo $users_list->userLevelId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $users_list->SortUrl($users_list->userLevelId) ?>', 1);"><div id="elh_users_userLevelId" class="users_userLevelId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $users_list->userLevelId->caption() ?></span><span class="ew-table-header-sort"><?php if ($users_list->userLevelId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($users_list->userLevelId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$users_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($users_list->ExportAll && $users_list->isExport()) {
	$users_list->StopRecord = $users_list->TotalRecords;
} else {

	// Set the last record to display
	if ($users_list->TotalRecords > $users_list->StartRecord + $users_list->DisplayRecords - 1)
		$users_list->StopRecord = $users_list->StartRecord + $users_list->DisplayRecords - 1;
	else
		$users_list->StopRecord = $users_list->TotalRecords;
}
$users_list->RecordCount = $users_list->StartRecord - 1;
if ($users_list->Recordset && !$users_list->Recordset->EOF) {
	$users_list->Recordset->moveFirst();
	$selectLimit = $users_list->UseSelectLimit;
	if (!$selectLimit && $users_list->StartRecord > 1)
		$users_list->Recordset->move($users_list->StartRecord - 1);
} elseif (!$users->AllowAddDeleteRow && $users_list->StopRecord == 0) {
	$users_list->StopRecord = $users->GridAddRowCount;
}

// Initialize aggregate
$users->RowType = ROWTYPE_AGGREGATEINIT;
$users->resetAttributes();
$users_list->renderRow();
while ($users_list->RecordCount < $users_list->StopRecord) {
	$users_list->RecordCount++;
	if ($users_list->RecordCount >= $users_list->StartRecord) {
		$users_list->RowCount++;

		// Set up key count
		$users_list->KeyCount = $users_list->RowIndex;

		// Init row class and style
		$users->resetAttributes();
		$users->CssClass = "";
		if ($users_list->isGridAdd()) {
		} else {
			$users_list->loadRowValues($users_list->Recordset); // Load row values
		}
		$users->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$users->RowAttrs->merge(["data-rowindex" => $users_list->RowCount, "id" => "r" . $users_list->RowCount . "_users", "data-rowtype" => $users->RowType]);

		// Render row
		$users_list->renderRow();

		// Render list options
		$users_list->renderListOptions();
?>
	<tr <?php echo $users->rowAttributes() ?>>
<?php

// Render list options (body, left)
$users_list->ListOptions->render("body", "left", $users_list->RowCount);
?>
	<?php if ($users_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $users_list->id->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCount ?>_users_id">
<span<?php echo $users_list->id->viewAttributes() ?>><?php echo $users_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users_list->Fullname->Visible) { // Fullname ?>
		<td data-name="Fullname" <?php echo $users_list->Fullname->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCount ?>_users_Fullname">
<span<?php echo $users_list->Fullname->viewAttributes() ?>><?php echo $users_list->Fullname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users_list->Username->Visible) { // Username ?>
		<td data-name="Username" <?php echo $users_list->Username->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCount ?>_users_Username">
<span<?php echo $users_list->Username->viewAttributes() ?>><?php echo $users_list->Username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $users_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCount ?>_users__Email">
<span<?php echo $users_list->_Email->viewAttributes() ?>><?php echo $users_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users_list->Passsword->Visible) { // Passsword ?>
		<td data-name="Passsword" <?php echo $users_list->Passsword->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCount ?>_users_Passsword">
<span<?php echo $users_list->Passsword->viewAttributes() ?>><?php echo $users_list->Passsword->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($users_list->userLevelId->Visible) { // userLevelId ?>
		<td data-name="userLevelId" <?php echo $users_list->userLevelId->cellAttributes() ?>>
<span id="el<?php echo $users_list->RowCount ?>_users_userLevelId">
<span<?php echo $users_list->userLevelId->viewAttributes() ?>><?php echo $users_list->userLevelId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$users_list->ListOptions->render("body", "right", $users_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$users_list->isGridAdd())
		$users_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$users->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($users_list->Recordset)
	$users_list->Recordset->Close();
?>
<?php if (!$users_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$users_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $users_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($users_list->TotalRecords == 0 && !$users->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $users_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$users_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$users_list->isExport()) { ?>
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
$users_list->terminate();
?>