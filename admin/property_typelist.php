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
$property_type_list = new property_type_list();

// Run the page
$property_type_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_type_list->isExport()) { ?>
<script>
var fproperty_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_typelist = currentForm = new ew.Form("fproperty_typelist", "list");
	fproperty_typelist.formKeyCountName = '<?php echo $property_type_list->FormKeyCountName ?>';

	// Validate form
	fproperty_typelist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($property_type_list->PropertyTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_list->PropertyTypeCode->caption(), $property_type_list->PropertyTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_type_list->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_list->PropertyType->caption(), $property_type_list->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_type_list->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_list->PropertyUse->caption(), $property_type_list->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fproperty_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PropertyType", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fproperty_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_typelist");
});
var fproperty_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_typelistsrch = currentSearchForm = new ew.Form("fproperty_typelistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_typelistsrch.filterList = <?php echo $property_type_list->getFilterList() ?>;
	loadjs.done("fproperty_typelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$property_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_type_list->TotalRecords > 0 && $property_type_list->ExportOptions->visible()) { ?>
<?php $property_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_type_list->ImportOptions->visible()) { ?>
<?php $property_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_type_list->SearchOptions->visible()) { ?>
<?php $property_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_type_list->FilterOptions->visible()) { ?>
<?php $property_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_type_list->renderOtherOptions();
?>
<?php if (!$property_type_list->isExport() && !$property_type->CurrentAction) { ?>
<form name="fproperty_typelistsrch" id="fproperty_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_typelistsrch-search-panel" class="<?php echo $property_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $property_type_list->showPageHeader(); ?>
<?php
$property_type_list->showMessage();
?>
<?php if ($property_type_list->TotalRecords > 0 || $property_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_type">
<?php if (!$property_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_typelist" id="fproperty_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_type">
<div id="gmp_property_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_type_list->TotalRecords > 0 || $property_type_list->isGridEdit()) { ?>
<table id="tbl_property_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_type->RowType = ROWTYPE_HEADER;

// Render list options
$property_type_list->renderListOptions();

// Render list options (header, left)
$property_type_list->ListOptions->render("header", "left");
?>
<?php if ($property_type_list->PropertyTypeCode->Visible) { // PropertyTypeCode ?>
	<?php if ($property_type_list->SortUrl($property_type_list->PropertyTypeCode) == "") { ?>
		<th data-name="PropertyTypeCode" class="<?php echo $property_type_list->PropertyTypeCode->headerCellClass() ?>"><div id="elh_property_type_PropertyTypeCode" class="property_type_PropertyTypeCode"><div class="ew-table-header-caption"><?php echo $property_type_list->PropertyTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyTypeCode" class="<?php echo $property_type_list->PropertyTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_type_list->SortUrl($property_type_list->PropertyTypeCode) ?>', 1);"><div id="elh_property_type_PropertyTypeCode" class="property_type_PropertyTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_type_list->PropertyTypeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_type_list->PropertyTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_type_list->PropertyTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_type_list->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property_type_list->SortUrl($property_type_list->PropertyType) == "") { ?>
		<th data-name="PropertyType" class="<?php echo $property_type_list->PropertyType->headerCellClass() ?>"><div id="elh_property_type_PropertyType" class="property_type_PropertyType"><div class="ew-table-header-caption"><?php echo $property_type_list->PropertyType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyType" class="<?php echo $property_type_list->PropertyType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_type_list->SortUrl($property_type_list->PropertyType) ?>', 1);"><div id="elh_property_type_PropertyType" class="property_type_PropertyType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_type_list->PropertyType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_type_list->PropertyType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_type_list->PropertyType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_type_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_type_list->SortUrl($property_type_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_type_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_type_PropertyUse" class="property_type_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_type_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_type_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_type_list->SortUrl($property_type_list->PropertyUse) ?>', 1);"><div id="elh_property_type_PropertyUse" class="property_type_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_type_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_type_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_type_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_type_list->ExportAll && $property_type_list->isExport()) {
	$property_type_list->StopRecord = $property_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_type_list->TotalRecords > $property_type_list->StartRecord + $property_type_list->DisplayRecords - 1)
		$property_type_list->StopRecord = $property_type_list->StartRecord + $property_type_list->DisplayRecords - 1;
	else
		$property_type_list->StopRecord = $property_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($property_type->isConfirm() || $property_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($property_type_list->FormKeyCountName) && ($property_type_list->isGridAdd() || $property_type_list->isGridEdit() || $property_type->isConfirm())) {
		$property_type_list->KeyCount = $CurrentForm->getValue($property_type_list->FormKeyCountName);
		$property_type_list->StopRecord = $property_type_list->StartRecord + $property_type_list->KeyCount - 1;
	}
}
$property_type_list->RecordCount = $property_type_list->StartRecord - 1;
if ($property_type_list->Recordset && !$property_type_list->Recordset->EOF) {
	$property_type_list->Recordset->moveFirst();
	$selectLimit = $property_type_list->UseSelectLimit;
	if (!$selectLimit && $property_type_list->StartRecord > 1)
		$property_type_list->Recordset->move($property_type_list->StartRecord - 1);
} elseif (!$property_type->AllowAddDeleteRow && $property_type_list->StopRecord == 0) {
	$property_type_list->StopRecord = $property_type->GridAddRowCount;
}

// Initialize aggregate
$property_type->RowType = ROWTYPE_AGGREGATEINIT;
$property_type->resetAttributes();
$property_type_list->renderRow();
if ($property_type_list->isGridAdd())
	$property_type_list->RowIndex = 0;
while ($property_type_list->RecordCount < $property_type_list->StopRecord) {
	$property_type_list->RecordCount++;
	if ($property_type_list->RecordCount >= $property_type_list->StartRecord) {
		$property_type_list->RowCount++;
		if ($property_type_list->isGridAdd() || $property_type_list->isGridEdit() || $property_type->isConfirm()) {
			$property_type_list->RowIndex++;
			$CurrentForm->Index = $property_type_list->RowIndex;
			if ($CurrentForm->hasValue($property_type_list->FormActionName) && ($property_type->isConfirm() || $property_type_list->EventCancelled))
				$property_type_list->RowAction = strval($CurrentForm->getValue($property_type_list->FormActionName));
			elseif ($property_type_list->isGridAdd())
				$property_type_list->RowAction = "insert";
			else
				$property_type_list->RowAction = "";
		}

		// Set up key count
		$property_type_list->KeyCount = $property_type_list->RowIndex;

		// Init row class and style
		$property_type->resetAttributes();
		$property_type->CssClass = "";
		if ($property_type_list->isGridAdd()) {
			$property_type_list->loadRowValues(); // Load default values
		} else {
			$property_type_list->loadRowValues($property_type_list->Recordset); // Load row values
		}
		$property_type->RowType = ROWTYPE_VIEW; // Render view
		if ($property_type_list->isGridAdd()) // Grid add
			$property_type->RowType = ROWTYPE_ADD; // Render add
		if ($property_type_list->isGridAdd() && $property_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$property_type_list->restoreCurrentRowFormValues($property_type_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$property_type->RowAttrs->merge(["data-rowindex" => $property_type_list->RowCount, "id" => "r" . $property_type_list->RowCount . "_property_type", "data-rowtype" => $property_type->RowType]);

		// Render row
		$property_type_list->renderRow();

		// Render list options
		$property_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($property_type_list->RowAction != "delete" && $property_type_list->RowAction != "insertdelete" && !($property_type_list->RowAction == "insert" && $property_type->isConfirm() && $property_type_list->emptyRow())) {
?>
	<tr <?php echo $property_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_type_list->ListOptions->render("body", "left", $property_type_list->RowCount);
?>
	<?php if ($property_type_list->PropertyTypeCode->Visible) { // PropertyTypeCode ?>
		<td data-name="PropertyTypeCode" <?php echo $property_type_list->PropertyTypeCode->cellAttributes() ?>>
<?php if ($property_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyTypeCode" class="form-group"></span>
<input type="hidden" data-table="property_type" data-field="x_PropertyTypeCode" name="o<?php echo $property_type_list->RowIndex ?>_PropertyTypeCode" id="o<?php echo $property_type_list->RowIndex ?>_PropertyTypeCode" value="<?php echo HtmlEncode($property_type_list->PropertyTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($property_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyTypeCode">
<span<?php echo $property_type_list->PropertyTypeCode->viewAttributes() ?>><?php echo $property_type_list->PropertyTypeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_type_list->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType" <?php echo $property_type_list->PropertyType->cellAttributes() ?>>
<?php if ($property_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyType" class="form-group">
<input type="text" data-table="property_type" data-field="x_PropertyType" name="x<?php echo $property_type_list->RowIndex ?>_PropertyType" id="x<?php echo $property_type_list->RowIndex ?>_PropertyType" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_type_list->PropertyType->getPlaceHolder()) ?>" value="<?php echo $property_type_list->PropertyType->EditValue ?>"<?php echo $property_type_list->PropertyType->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_type" data-field="x_PropertyType" name="o<?php echo $property_type_list->RowIndex ?>_PropertyType" id="o<?php echo $property_type_list->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_type_list->PropertyType->OldValue) ?>">
<?php } ?>
<?php if ($property_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyType">
<span<?php echo $property_type_list->PropertyType->viewAttributes() ?>><?php echo $property_type_list->PropertyType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_type_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_type_list->PropertyUse->cellAttributes() ?>>
<?php if ($property_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyUse" class="form-group">
<input type="text" data-table="property_type" data-field="x_PropertyUse" name="x<?php echo $property_type_list->RowIndex ?>_PropertyUse" id="x<?php echo $property_type_list->RowIndex ?>_PropertyUse" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_type_list->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_type_list->PropertyUse->EditValue ?>"<?php echo $property_type_list->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_type" data-field="x_PropertyUse" name="o<?php echo $property_type_list->RowIndex ?>_PropertyUse" id="o<?php echo $property_type_list->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_type_list->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($property_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyUse">
<span<?php echo $property_type_list->PropertyUse->viewAttributes() ?>><?php echo $property_type_list->PropertyUse->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_type_list->ListOptions->render("body", "right", $property_type_list->RowCount);
?>
	</tr>
<?php if ($property_type->RowType == ROWTYPE_ADD || $property_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fproperty_typelist", "load"], function() {
	fproperty_typelist.updateLists(<?php echo $property_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$property_type_list->isGridAdd())
		if (!$property_type_list->Recordset->EOF)
			$property_type_list->Recordset->moveNext();
}
?>
<?php
	if ($property_type_list->isGridAdd() || $property_type_list->isGridEdit()) {
		$property_type_list->RowIndex = '$rowindex$';
		$property_type_list->loadRowValues();

		// Set row properties
		$property_type->resetAttributes();
		$property_type->RowAttrs->merge(["data-rowindex" => $property_type_list->RowIndex, "id" => "r0_property_type", "data-rowtype" => ROWTYPE_ADD]);
		$property_type->RowAttrs->appendClass("ew-template");
		$property_type->RowType = ROWTYPE_ADD;

		// Render row
		$property_type_list->renderRow();

		// Render list options
		$property_type_list->renderListOptions();
		$property_type_list->StartRowCount = 0;
?>
	<tr <?php echo $property_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_type_list->ListOptions->render("body", "left", $property_type_list->RowIndex);
?>
	<?php if ($property_type_list->PropertyTypeCode->Visible) { // PropertyTypeCode ?>
		<td data-name="PropertyTypeCode">
<span id="el$rowindex$_property_type_PropertyTypeCode" class="form-group property_type_PropertyTypeCode"></span>
<input type="hidden" data-table="property_type" data-field="x_PropertyTypeCode" name="o<?php echo $property_type_list->RowIndex ?>_PropertyTypeCode" id="o<?php echo $property_type_list->RowIndex ?>_PropertyTypeCode" value="<?php echo HtmlEncode($property_type_list->PropertyTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_type_list->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType">
<span id="el$rowindex$_property_type_PropertyType" class="form-group property_type_PropertyType">
<input type="text" data-table="property_type" data-field="x_PropertyType" name="x<?php echo $property_type_list->RowIndex ?>_PropertyType" id="x<?php echo $property_type_list->RowIndex ?>_PropertyType" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_type_list->PropertyType->getPlaceHolder()) ?>" value="<?php echo $property_type_list->PropertyType->EditValue ?>"<?php echo $property_type_list->PropertyType->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_type" data-field="x_PropertyType" name="o<?php echo $property_type_list->RowIndex ?>_PropertyType" id="o<?php echo $property_type_list->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_type_list->PropertyType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_type_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<span id="el$rowindex$_property_type_PropertyUse" class="form-group property_type_PropertyUse">
<input type="text" data-table="property_type" data-field="x_PropertyUse" name="x<?php echo $property_type_list->RowIndex ?>_PropertyUse" id="x<?php echo $property_type_list->RowIndex ?>_PropertyUse" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_type_list->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_type_list->PropertyUse->EditValue ?>"<?php echo $property_type_list->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_type" data-field="x_PropertyUse" name="o<?php echo $property_type_list->RowIndex ?>_PropertyUse" id="o<?php echo $property_type_list->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_type_list->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_type_list->ListOptions->render("body", "right", $property_type_list->RowIndex);
?>
<script>
loadjs.ready(["fproperty_typelist", "load"], function() {
	fproperty_typelist.updateLists(<?php echo $property_type_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($property_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $property_type_list->FormKeyCountName ?>" id="<?php echo $property_type_list->FormKeyCountName ?>" value="<?php echo $property_type_list->KeyCount ?>">
<?php echo $property_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$property_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_type_list->Recordset)
	$property_type_list->Recordset->Close();
?>
<?php if (!$property_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_type_list->TotalRecords == 0 && !$property_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_type_list->isExport()) { ?>
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
$property_type_list->terminate();
?>