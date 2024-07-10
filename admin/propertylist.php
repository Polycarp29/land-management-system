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
$property_list = new property_list();

// Run the page
$property_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_list->isExport()) { ?>
<script>
var fpropertylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpropertylist = currentForm = new ew.Form("fpropertylist", "list");
	fpropertylist.formKeyCountName = '<?php echo $property_list->FormKeyCountName ?>';
	loadjs.done("fpropertylist");
});
var fpropertylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpropertylistsrch = currentSearchForm = new ew.Form("fpropertylistsrch");

	// Dynamic selection lists
	// Filters

	fpropertylistsrch.filterList = <?php echo $property_list->getFilterList() ?>;
	loadjs.done("fpropertylistsrch");
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
<?php if (!$property_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_list->TotalRecords > 0 && $property_list->ExportOptions->visible()) { ?>
<?php $property_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_list->ImportOptions->visible()) { ?>
<?php $property_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_list->SearchOptions->visible()) { ?>
<?php $property_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_list->FilterOptions->visible()) { ?>
<?php $property_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$property_list->isExport() || Config("EXPORT_MASTER_RECORD") && $property_list->isExport("print")) { ?>
<?php
if ($property_list->DbMasterFilter != "" && $property->getCurrentMasterTable() == "client") {
	if ($property_list->MasterRecordExists) {
		include_once "clientmaster.php";
	}
}
?>
<?php } ?>
<?php
$property_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_list->isExport() && !$property->CurrentAction) { ?>
<form name="fpropertylistsrch" id="fpropertylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpropertylistsrch-search-panel" class="<?php echo $property_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_list->showPageHeader(); ?>
<?php
$property_list->showMessage();
?>
<?php if ($property_list->TotalRecords > 0 || $property->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property">
<?php if (!$property_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpropertylist" id="fpropertylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<?php if ($property->getCurrentMasterTable() == "client" && $property->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($property_list->ClientId->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_property" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_list->TotalRecords > 0 || $property_list->isGridEdit()) { ?>
<table id="tbl_propertylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property->RowType = ROWTYPE_HEADER;

// Render list options
$property_list->renderListOptions();

// Render list options (header, left)
$property_list->ListOptions->render("header", "left");
?>
<?php if ($property_list->id->Visible) { // id ?>
	<?php if ($property_list->SortUrl($property_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $property_list->id->headerCellClass() ?>"><div id="elh_property_id" class="property_id"><div class="ew-table-header-caption"><?php echo $property_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $property_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->id) ?>', 1);"><div id="elh_property_id" class="property_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ClientId->Visible) { // ClientId ?>
	<?php if ($property_list->SortUrl($property_list->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $property_list->ClientId->headerCellClass() ?>"><div id="elh_property_ClientId" class="property_ClientId"><div class="ew-table-header-caption"><?php echo $property_list->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $property_list->ClientId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ClientId) ?>', 1);"><div id="elh_property_ClientId" class="property_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property_list->SortUrl($property_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_list->ChargeGroup->headerCellClass() ?>"><div id="elh_property_ChargeGroup" class="property_ChargeGroup"><div class="ew-table-header-caption"><?php echo $property_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ChargeGroup) ?>', 1);"><div id="elh_property_ChargeGroup" class="property_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<?php if ($property_list->SortUrl($property_list->ChargeGropuDes) == "") { ?>
		<th data-name="ChargeGropuDes" class="<?php echo $property_list->ChargeGropuDes->headerCellClass() ?>"><div id="elh_property_ChargeGropuDes" class="property_ChargeGropuDes"><div class="ew-table-header-caption"><?php echo $property_list->ChargeGropuDes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGropuDes" class="<?php echo $property_list->ChargeGropuDes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ChargeGropuDes) ?>', 1);"><div id="elh_property_ChargeGropuDes" class="property_ChargeGropuDes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ChargeGropuDes->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ChargeGropuDes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ChargeGropuDes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->ChargeableFee->Visible) { // ChargeableFee ?>
	<?php if ($property_list->SortUrl($property_list->ChargeableFee) == "") { ?>
		<th data-name="ChargeableFee" class="<?php echo $property_list->ChargeableFee->headerCellClass() ?>"><div id="elh_property_ChargeableFee" class="property_ChargeableFee"><div class="ew-table-header-caption"><?php echo $property_list->ChargeableFee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeableFee" class="<?php echo $property_list->ChargeableFee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->ChargeableFee) ?>', 1);"><div id="elh_property_ChargeableFee" class="property_ChargeableFee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->ChargeableFee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->ChargeableFee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->ChargeableFee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_list->SortUrl($property_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $property_list->BalanceBF->headerCellClass() ?>"><div id="elh_property_BalanceBF" class="property_BalanceBF"><div class="ew-table-header-caption"><?php echo $property_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $property_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->BalanceBF) ?>', 1);"><div id="elh_property_BalanceBF" class="property_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->AmountPayable->Visible) { // AmountPayable ?>
	<?php if ($property_list->SortUrl($property_list->AmountPayable) == "") { ?>
		<th data-name="AmountPayable" class="<?php echo $property_list->AmountPayable->headerCellClass() ?>"><div id="elh_property_AmountPayable" class="property_AmountPayable"><div class="ew-table-header-caption"><?php echo $property_list->AmountPayable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPayable" class="<?php echo $property_list->AmountPayable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->AmountPayable) ?>', 1);"><div id="elh_property_AmountPayable" class="property_AmountPayable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->AmountPayable->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->AmountPayable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->AmountPayable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Property->Visible) { // Property ?>
	<?php if ($property_list->SortUrl($property_list->Property) == "") { ?>
		<th data-name="Property" class="<?php echo $property_list->Property->headerCellClass() ?>"><div id="elh_property_Property" class="property_Property"><div class="ew-table-header-caption"><?php echo $property_list->Property->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Property" class="<?php echo $property_list->Property->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Property) ?>', 1);"><div id="elh_property_Property" class="property_Property">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Property->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->Property->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Property->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyId->Visible) { // PropertyId ?>
	<?php if ($property_list->SortUrl($property_list->PropertyId) == "") { ?>
		<th data-name="PropertyId" class="<?php echo $property_list->PropertyId->headerCellClass() ?>"><div id="elh_property_PropertyId" class="property_PropertyId"><div class="ew-table-header-caption"><?php echo $property_list->PropertyId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyId" class="<?php echo $property_list->PropertyId->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyId) ?>', 1);"><div id="elh_property_PropertyId" class="property_PropertyId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyId->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_list->SortUrl($property_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_PropertyUse" class="property_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->PropertyUse) ?>', 1);"><div id="elh_property_PropertyUse" class="property_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Location->Visible) { // Location ?>
	<?php if ($property_list->SortUrl($property_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_list->Location->headerCellClass() ?>"><div id="elh_property_Location" class="property_Location"><div class="ew-table-header-caption"><?php echo $property_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Location) ?>', 1);"><div id="elh_property_Location" class="property_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_list->SortUrl($property_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_list->AmountPaid->headerCellClass() ?>"><div id="elh_property_AmountPaid" class="property_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->AmountPaid) ?>', 1);"><div id="elh_property_AmountPaid" class="property_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->CurrentBalance->Visible) { // CurrentBalance ?>
	<?php if ($property_list->SortUrl($property_list->CurrentBalance) == "") { ?>
		<th data-name="CurrentBalance" class="<?php echo $property_list->CurrentBalance->headerCellClass() ?>"><div id="elh_property_CurrentBalance" class="property_CurrentBalance"><div class="ew-table-header-caption"><?php echo $property_list->CurrentBalance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentBalance" class="<?php echo $property_list->CurrentBalance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->CurrentBalance) ?>', 1);"><div id="elh_property_CurrentBalance" class="property_CurrentBalance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->CurrentBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->CurrentBalance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->CurrentBalance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->DataRegistered->Visible) { // DataRegistered ?>
	<?php if ($property_list->SortUrl($property_list->DataRegistered) == "") { ?>
		<th data-name="DataRegistered" class="<?php echo $property_list->DataRegistered->headerCellClass() ?>"><div id="elh_property_DataRegistered" class="property_DataRegistered"><div class="ew-table-header-caption"><?php echo $property_list->DataRegistered->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DataRegistered" class="<?php echo $property_list->DataRegistered->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->DataRegistered) ?>', 1);"><div id="elh_property_DataRegistered" class="property_DataRegistered">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->DataRegistered->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->DataRegistered->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->DataRegistered->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_list->Status->Visible) { // Status ?>
	<?php if ($property_list->SortUrl($property_list->Status) == "") { ?>
		<th data-name="Status" class="<?php echo $property_list->Status->headerCellClass() ?>"><div id="elh_property_Status" class="property_Status"><div class="ew-table-header-caption"><?php echo $property_list->Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status" class="<?php echo $property_list->Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_list->SortUrl($property_list->Status) ?>', 1);"><div id="elh_property_Status" class="property_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_list->Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_list->Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_list->Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_list->ExportAll && $property_list->isExport()) {
	$property_list->StopRecord = $property_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_list->TotalRecords > $property_list->StartRecord + $property_list->DisplayRecords - 1)
		$property_list->StopRecord = $property_list->StartRecord + $property_list->DisplayRecords - 1;
	else
		$property_list->StopRecord = $property_list->TotalRecords;
}
$property_list->RecordCount = $property_list->StartRecord - 1;
if ($property_list->Recordset && !$property_list->Recordset->EOF) {
	$property_list->Recordset->moveFirst();
	$selectLimit = $property_list->UseSelectLimit;
	if (!$selectLimit && $property_list->StartRecord > 1)
		$property_list->Recordset->move($property_list->StartRecord - 1);
} elseif (!$property->AllowAddDeleteRow && $property_list->StopRecord == 0) {
	$property_list->StopRecord = $property->GridAddRowCount;
}

// Initialize aggregate
$property->RowType = ROWTYPE_AGGREGATEINIT;
$property->resetAttributes();
$property_list->renderRow();
while ($property_list->RecordCount < $property_list->StopRecord) {
	$property_list->RecordCount++;
	if ($property_list->RecordCount >= $property_list->StartRecord) {
		$property_list->RowCount++;

		// Set up key count
		$property_list->KeyCount = $property_list->RowIndex;

		// Init row class and style
		$property->resetAttributes();
		$property->CssClass = "";
		if ($property_list->isGridAdd()) {
		} else {
			$property_list->loadRowValues($property_list->Recordset); // Load row values
		}
		$property->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property->RowAttrs->merge(["data-rowindex" => $property_list->RowCount, "id" => "r" . $property_list->RowCount . "_property", "data-rowtype" => $property->RowType]);

		// Render row
		$property_list->renderRow();

		// Render list options
		$property_list->renderListOptions();
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_list->ListOptions->render("body", "left", $property_list->RowCount);
?>
	<?php if ($property_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $property_list->id->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_id">
<span<?php echo $property_list->id->viewAttributes() ?>><?php echo $property_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $property_list->ClientId->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ClientId">
<span<?php echo $property_list->ClientId->viewAttributes() ?>><?php echo $property_list->ClientId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $property_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ChargeGroup">
<span<?php echo $property_list->ChargeGroup->viewAttributes() ?>><?php echo $property_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<td data-name="ChargeGropuDes" <?php echo $property_list->ChargeGropuDes->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ChargeGropuDes">
<span<?php echo $property_list->ChargeGropuDes->viewAttributes() ?>><?php echo $property_list->ChargeGropuDes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->ChargeableFee->Visible) { // ChargeableFee ?>
		<td data-name="ChargeableFee" <?php echo $property_list->ChargeableFee->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_ChargeableFee">
<span<?php echo $property_list->ChargeableFee->viewAttributes() ?>><?php echo $property_list->ChargeableFee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $property_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_BalanceBF">
<span<?php echo $property_list->BalanceBF->viewAttributes() ?>><?php echo $property_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->AmountPayable->Visible) { // AmountPayable ?>
		<td data-name="AmountPayable" <?php echo $property_list->AmountPayable->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_AmountPayable">
<span<?php echo $property_list->AmountPayable->viewAttributes() ?>><?php echo $property_list->AmountPayable->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Property->Visible) { // Property ?>
		<td data-name="Property" <?php echo $property_list->Property->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Property">
<span<?php echo $property_list->Property->viewAttributes() ?>><?php echo $property_list->Property->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" <?php echo $property_list->PropertyId->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyId">
<span<?php echo $property_list->PropertyId->viewAttributes() ?>><?php echo $property_list->PropertyId->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_PropertyUse">
<span<?php echo $property_list->PropertyUse->viewAttributes() ?>><?php echo $property_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_list->Location->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Location">
<span<?php echo $property_list->Location->viewAttributes() ?>><?php echo $property_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_AmountPaid">
<span<?php echo $property_list->AmountPaid->viewAttributes() ?>><?php echo $property_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->CurrentBalance->Visible) { // CurrentBalance ?>
		<td data-name="CurrentBalance" <?php echo $property_list->CurrentBalance->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_CurrentBalance">
<span<?php echo $property_list->CurrentBalance->viewAttributes() ?>><?php echo $property_list->CurrentBalance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->DataRegistered->Visible) { // DataRegistered ?>
		<td data-name="DataRegistered" <?php echo $property_list->DataRegistered->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_DataRegistered">
<span<?php echo $property_list->DataRegistered->viewAttributes() ?>><?php echo $property_list->DataRegistered->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_list->Status->Visible) { // Status ?>
		<td data-name="Status" <?php echo $property_list->Status->cellAttributes() ?>>
<span id="el<?php echo $property_list->RowCount ?>_property_Status">
<span<?php echo $property_list->Status->viewAttributes() ?>><?php echo $property_list->Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_list->ListOptions->render("body", "right", $property_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_list->isGridAdd())
		$property_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_list->Recordset)
	$property_list->Recordset->Close();
?>
<?php if (!$property_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_list->TotalRecords == 0 && !$property->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_list->isExport()) { ?>
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
$property_list->terminate();
?>