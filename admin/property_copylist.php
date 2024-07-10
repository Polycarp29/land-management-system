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
$property_copy_list = new property_copy_list();

// Run the page
$property_copy_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_copy_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_copy_list->isExport()) { ?>
<script>
var fproperty_copylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_copylist = currentForm = new ew.Form("fproperty_copylist", "list");
	fproperty_copylist.formKeyCountName = '<?php echo $property_copy_list->FormKeyCountName ?>';
	loadjs.done("fproperty_copylist");
});
var fproperty_copylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_copylistsrch = currentSearchForm = new ew.Form("fproperty_copylistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_copylistsrch.filterList = <?php echo $property_copy_list->getFilterList() ?>;
	loadjs.done("fproperty_copylistsrch");
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
<?php if (!$property_copy_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_copy_list->TotalRecords > 0 && $property_copy_list->ExportOptions->visible()) { ?>
<?php $property_copy_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_copy_list->ImportOptions->visible()) { ?>
<?php $property_copy_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_copy_list->SearchOptions->visible()) { ?>
<?php $property_copy_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_copy_list->FilterOptions->visible()) { ?>
<?php $property_copy_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_copy_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_copy_list->isExport() && !$property_copy->CurrentAction) { ?>
<form name="fproperty_copylistsrch" id="fproperty_copylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_copylistsrch-search-panel" class="<?php echo $property_copy_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_copy">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_copy_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_copy_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_copy_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_copy_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_copy_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_copy_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_copy_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_copy_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_copy_list->showPageHeader(); ?>
<?php
$property_copy_list->showMessage();
?>
<?php if ($property_copy_list->TotalRecords > 0 || $property_copy->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_copy_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_copy">
<?php if (!$property_copy_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_copy_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_copy_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_copy_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_copylist" id="fproperty_copylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_copy">
<div id="gmp_property_copy" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_copy_list->TotalRecords > 0 || $property_copy_list->isGridEdit()) { ?>
<table id="tbl_property_copylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_copy->RowType = ROWTYPE_HEADER;

// Render list options
$property_copy_list->renderListOptions();

// Render list options (header, left)
$property_copy_list->ListOptions->render("header", "left");
?>
<?php if ($property_copy_list->id->Visible) { // id ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $property_copy_list->id->headerCellClass() ?>"><div id="elh_property_copy_id" class="property_copy_id"><div class="ew-table-header-caption"><?php echo $property_copy_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $property_copy_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->id) ?>', 1);"><div id="elh_property_copy_id" class="property_copy_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->ClientId->Visible) { // ClientId ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $property_copy_list->ClientId->headerCellClass() ?>"><div id="elh_property_copy_ClientId" class="property_copy_ClientId"><div class="ew-table-header-caption"><?php echo $property_copy_list->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $property_copy_list->ClientId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->ClientId) ?>', 1);"><div id="elh_property_copy_ClientId" class="property_copy_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_copy_list->ChargeGroup->headerCellClass() ?>"><div id="elh_property_copy_ChargeGroup" class="property_copy_ChargeGroup"><div class="ew-table-header-caption"><?php echo $property_copy_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_copy_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->ChargeGroup) ?>', 1);"><div id="elh_property_copy_ChargeGroup" class="property_copy_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->ChargeGropuDes) == "") { ?>
		<th data-name="ChargeGropuDes" class="<?php echo $property_copy_list->ChargeGropuDes->headerCellClass() ?>"><div id="elh_property_copy_ChargeGropuDes" class="property_copy_ChargeGropuDes"><div class="ew-table-header-caption"><?php echo $property_copy_list->ChargeGropuDes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGropuDes" class="<?php echo $property_copy_list->ChargeGropuDes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->ChargeGropuDes) ?>', 1);"><div id="elh_property_copy_ChargeGropuDes" class="property_copy_ChargeGropuDes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->ChargeGropuDes->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->ChargeGropuDes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->ChargeGropuDes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->Property->Visible) { // Property ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->Property) == "") { ?>
		<th data-name="Property" class="<?php echo $property_copy_list->Property->headerCellClass() ?>"><div id="elh_property_copy_Property" class="property_copy_Property"><div class="ew-table-header-caption"><?php echo $property_copy_list->Property->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Property" class="<?php echo $property_copy_list->Property->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->Property) ?>', 1);"><div id="elh_property_copy_Property" class="property_copy_Property">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->Property->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->Property->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->Property->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_copy_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_copy_PropertyUse" class="property_copy_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_copy_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_copy_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->PropertyUse) ?>', 1);"><div id="elh_property_copy_PropertyUse" class="property_copy_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->ChargeableFee->Visible) { // ChargeableFee ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->ChargeableFee) == "") { ?>
		<th data-name="ChargeableFee" class="<?php echo $property_copy_list->ChargeableFee->headerCellClass() ?>"><div id="elh_property_copy_ChargeableFee" class="property_copy_ChargeableFee"><div class="ew-table-header-caption"><?php echo $property_copy_list->ChargeableFee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeableFee" class="<?php echo $property_copy_list->ChargeableFee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->ChargeableFee) ?>', 1);"><div id="elh_property_copy_ChargeableFee" class="property_copy_ChargeableFee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->ChargeableFee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->ChargeableFee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->ChargeableFee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $property_copy_list->BalanceBF->headerCellClass() ?>"><div id="elh_property_copy_BalanceBF" class="property_copy_BalanceBF"><div class="ew-table-header-caption"><?php echo $property_copy_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $property_copy_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->BalanceBF) ?>', 1);"><div id="elh_property_copy_BalanceBF" class="property_copy_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->AmountPayable->Visible) { // AmountPayable ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->AmountPayable) == "") { ?>
		<th data-name="AmountPayable" class="<?php echo $property_copy_list->AmountPayable->headerCellClass() ?>"><div id="elh_property_copy_AmountPayable" class="property_copy_AmountPayable"><div class="ew-table-header-caption"><?php echo $property_copy_list->AmountPayable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPayable" class="<?php echo $property_copy_list->AmountPayable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->AmountPayable) ?>', 1);"><div id="elh_property_copy_AmountPayable" class="property_copy_AmountPayable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->AmountPayable->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->AmountPayable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->AmountPayable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_copy_list->AmountPaid->headerCellClass() ?>"><div id="elh_property_copy_AmountPaid" class="property_copy_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_copy_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_copy_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->AmountPaid) ?>', 1);"><div id="elh_property_copy_AmountPaid" class="property_copy_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->CurrentBalance->Visible) { // CurrentBalance ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->CurrentBalance) == "") { ?>
		<th data-name="CurrentBalance" class="<?php echo $property_copy_list->CurrentBalance->headerCellClass() ?>"><div id="elh_property_copy_CurrentBalance" class="property_copy_CurrentBalance"><div class="ew-table-header-caption"><?php echo $property_copy_list->CurrentBalance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentBalance" class="<?php echo $property_copy_list->CurrentBalance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->CurrentBalance) ?>', 1);"><div id="elh_property_copy_CurrentBalance" class="property_copy_CurrentBalance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->CurrentBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->CurrentBalance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->CurrentBalance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_copy_list->DataRegistered->Visible) { // DataRegistered ?>
	<?php if ($property_copy_list->SortUrl($property_copy_list->DataRegistered) == "") { ?>
		<th data-name="DataRegistered" class="<?php echo $property_copy_list->DataRegistered->headerCellClass() ?>"><div id="elh_property_copy_DataRegistered" class="property_copy_DataRegistered"><div class="ew-table-header-caption"><?php echo $property_copy_list->DataRegistered->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DataRegistered" class="<?php echo $property_copy_list->DataRegistered->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_copy_list->SortUrl($property_copy_list->DataRegistered) ?>', 1);"><div id="elh_property_copy_DataRegistered" class="property_copy_DataRegistered">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_copy_list->DataRegistered->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_copy_list->DataRegistered->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_copy_list->DataRegistered->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_copy_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_copy_list->ExportAll && $property_copy_list->isExport()) {
	$property_copy_list->StopRecord = $property_copy_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_copy_list->TotalRecords > $property_copy_list->StartRecord + $property_copy_list->DisplayRecords - 1)
		$property_copy_list->StopRecord = $property_copy_list->StartRecord + $property_copy_list->DisplayRecords - 1;
	else
		$property_copy_list->StopRecord = $property_copy_list->TotalRecords;
}
$property_copy_list->RecordCount = $property_copy_list->StartRecord - 1;
if ($property_copy_list->Recordset && !$property_copy_list->Recordset->EOF) {
	$property_copy_list->Recordset->moveFirst();
	$selectLimit = $property_copy_list->UseSelectLimit;
	if (!$selectLimit && $property_copy_list->StartRecord > 1)
		$property_copy_list->Recordset->move($property_copy_list->StartRecord - 1);
} elseif (!$property_copy->AllowAddDeleteRow && $property_copy_list->StopRecord == 0) {
	$property_copy_list->StopRecord = $property_copy->GridAddRowCount;
}

// Initialize aggregate
$property_copy->RowType = ROWTYPE_AGGREGATEINIT;
$property_copy->resetAttributes();
$property_copy_list->renderRow();
while ($property_copy_list->RecordCount < $property_copy_list->StopRecord) {
	$property_copy_list->RecordCount++;
	if ($property_copy_list->RecordCount >= $property_copy_list->StartRecord) {
		$property_copy_list->RowCount++;

		// Set up key count
		$property_copy_list->KeyCount = $property_copy_list->RowIndex;

		// Init row class and style
		$property_copy->resetAttributes();
		$property_copy->CssClass = "";
		if ($property_copy_list->isGridAdd()) {
		} else {
			$property_copy_list->loadRowValues($property_copy_list->Recordset); // Load row values
		}
		$property_copy->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_copy->RowAttrs->merge(["data-rowindex" => $property_copy_list->RowCount, "id" => "r" . $property_copy_list->RowCount . "_property_copy", "data-rowtype" => $property_copy->RowType]);

		// Render row
		$property_copy_list->renderRow();

		// Render list options
		$property_copy_list->renderListOptions();
?>
	<tr <?php echo $property_copy->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_copy_list->ListOptions->render("body", "left", $property_copy_list->RowCount);
?>
	<?php if ($property_copy_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $property_copy_list->id->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_id">
<span<?php echo $property_copy_list->id->viewAttributes() ?>><?php echo $property_copy_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $property_copy_list->ClientId->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_ClientId">
<span<?php echo $property_copy_list->ClientId->viewAttributes() ?>><?php echo $property_copy_list->ClientId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $property_copy_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_ChargeGroup">
<span<?php echo $property_copy_list->ChargeGroup->viewAttributes() ?>><?php echo $property_copy_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<td data-name="ChargeGropuDes" <?php echo $property_copy_list->ChargeGropuDes->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_ChargeGropuDes">
<span<?php echo $property_copy_list->ChargeGropuDes->viewAttributes() ?>><?php echo $property_copy_list->ChargeGropuDes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->Property->Visible) { // Property ?>
		<td data-name="Property" <?php echo $property_copy_list->Property->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_Property">
<span<?php echo $property_copy_list->Property->viewAttributes() ?>><?php echo $property_copy_list->Property->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_copy_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_PropertyUse">
<span<?php echo $property_copy_list->PropertyUse->viewAttributes() ?>><?php echo $property_copy_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->ChargeableFee->Visible) { // ChargeableFee ?>
		<td data-name="ChargeableFee" <?php echo $property_copy_list->ChargeableFee->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_ChargeableFee">
<span<?php echo $property_copy_list->ChargeableFee->viewAttributes() ?>><?php echo $property_copy_list->ChargeableFee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $property_copy_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_BalanceBF">
<span<?php echo $property_copy_list->BalanceBF->viewAttributes() ?>><?php echo $property_copy_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->AmountPayable->Visible) { // AmountPayable ?>
		<td data-name="AmountPayable" <?php echo $property_copy_list->AmountPayable->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_AmountPayable">
<span<?php echo $property_copy_list->AmountPayable->viewAttributes() ?>><?php echo $property_copy_list->AmountPayable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_copy_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_AmountPaid">
<span<?php echo $property_copy_list->AmountPaid->viewAttributes() ?>><?php echo $property_copy_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->CurrentBalance->Visible) { // CurrentBalance ?>
		<td data-name="CurrentBalance" <?php echo $property_copy_list->CurrentBalance->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_CurrentBalance">
<span<?php echo $property_copy_list->CurrentBalance->viewAttributes() ?>><?php echo $property_copy_list->CurrentBalance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_copy_list->DataRegistered->Visible) { // DataRegistered ?>
		<td data-name="DataRegistered" <?php echo $property_copy_list->DataRegistered->cellAttributes() ?>>
<span id="el<?php echo $property_copy_list->RowCount ?>_property_copy_DataRegistered">
<span<?php echo $property_copy_list->DataRegistered->viewAttributes() ?>><?php echo $property_copy_list->DataRegistered->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_copy_list->ListOptions->render("body", "right", $property_copy_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_copy_list->isGridAdd())
		$property_copy_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_copy->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_copy_list->Recordset)
	$property_copy_list->Recordset->Close();
?>
<?php if (!$property_copy_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_copy_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_copy_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_copy_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_copy_list->TotalRecords == 0 && !$property_copy->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_copy_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_copy_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_copy_list->isExport()) { ?>
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
$property_copy_list->terminate();
?>