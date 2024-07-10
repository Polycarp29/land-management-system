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
$charge_group_list = new charge_group_list();

// Run the page
$charge_group_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charge_group_list->isExport()) { ?>
<script>
var fcharge_grouplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcharge_grouplist = currentForm = new ew.Form("fcharge_grouplist", "list");
	fcharge_grouplist.formKeyCountName = '<?php echo $charge_group_list->FormKeyCountName ?>';

	// Validate form
	fcharge_grouplist.validate = function() {
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
			<?php if ($charge_group_list->ChargeGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_list->ChargeGroupCode->caption(), $charge_group_list->ChargeGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_group_list->ChargeGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_list->ChargeGroupName->caption(), $charge_group_list->ChargeGroupName->RequiredErrorMessage)) ?>");
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
	fcharge_grouplist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ChargeGroupName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcharge_grouplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcharge_grouplist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcharge_grouplist");
});
var fcharge_grouplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcharge_grouplistsrch = currentSearchForm = new ew.Form("fcharge_grouplistsrch");

	// Dynamic selection lists
	// Filters

	fcharge_grouplistsrch.filterList = <?php echo $charge_group_list->getFilterList() ?>;
	loadjs.done("fcharge_grouplistsrch");
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
<?php if (!$charge_group_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($charge_group_list->TotalRecords > 0 && $charge_group_list->ExportOptions->visible()) { ?>
<?php $charge_group_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($charge_group_list->ImportOptions->visible()) { ?>
<?php $charge_group_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($charge_group_list->SearchOptions->visible()) { ?>
<?php $charge_group_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($charge_group_list->FilterOptions->visible()) { ?>
<?php $charge_group_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$charge_group_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$charge_group_list->isExport() && !$charge_group->CurrentAction) { ?>
<form name="fcharge_grouplistsrch" id="fcharge_grouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcharge_grouplistsrch-search-panel" class="<?php echo $charge_group_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="charge_group">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $charge_group_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($charge_group_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($charge_group_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $charge_group_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $charge_group_list->showPageHeader(); ?>
<?php
$charge_group_list->showMessage();
?>
<?php if ($charge_group_list->TotalRecords > 0 || $charge_group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($charge_group_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> charge_group">
<?php if (!$charge_group_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$charge_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charge_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcharge_grouplist" id="fcharge_grouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<div id="gmp_charge_group" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($charge_group_list->TotalRecords > 0 || $charge_group_list->isAdd() || $charge_group_list->isCopy() || $charge_group_list->isGridEdit()) { ?>
<table id="tbl_charge_grouplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$charge_group->RowType = ROWTYPE_HEADER;

// Render list options
$charge_group_list->renderListOptions();

// Render list options (header, left)
$charge_group_list->ListOptions->render("header", "left");
?>
<?php if ($charge_group_list->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
	<?php if ($charge_group_list->SortUrl($charge_group_list->ChargeGroupCode) == "") { ?>
		<th data-name="ChargeGroupCode" class="<?php echo $charge_group_list->ChargeGroupCode->headerCellClass() ?>"><div id="elh_charge_group_ChargeGroupCode" class="charge_group_ChargeGroupCode"><div class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroupCode" class="<?php echo $charge_group_list->ChargeGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_group_list->SortUrl($charge_group_list->ChargeGroupCode) ?>', 1);"><div id="elh_charge_group_ChargeGroupCode" class="charge_group_ChargeGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroupCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_group_list->ChargeGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_group_list->ChargeGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_group_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
	<?php if ($charge_group_list->SortUrl($charge_group_list->ChargeGroupName) == "") { ?>
		<th data-name="ChargeGroupName" class="<?php echo $charge_group_list->ChargeGroupName->headerCellClass() ?>"><div id="elh_charge_group_ChargeGroupName" class="charge_group_ChargeGroupName"><div class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroupName" class="<?php echo $charge_group_list->ChargeGroupName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_group_list->SortUrl($charge_group_list->ChargeGroupName) ?>', 1);"><div id="elh_charge_group_ChargeGroupName" class="charge_group_ChargeGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_group_list->ChargeGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_group_list->ChargeGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$charge_group_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($charge_group_list->isAdd() || $charge_group_list->isCopy()) {
		$charge_group_list->RowIndex = 0;
		$charge_group_list->KeyCount = $charge_group_list->RowIndex;
		if ($charge_group_list->isAdd())
			$charge_group_list->loadRowValues();
		if ($charge_group->EventCancelled) // Insert failed
			$charge_group_list->restoreFormValues(); // Restore form values

		// Set row properties
		$charge_group->resetAttributes();
		$charge_group->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_charge_group", "data-rowtype" => ROWTYPE_ADD]);
		$charge_group->RowType = ROWTYPE_ADD;

		// Render row
		$charge_group_list->renderRow();

		// Render list options
		$charge_group_list->renderListOptions();
		$charge_group_list->StartRowCount = 0;
?>
	<tr <?php echo $charge_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charge_group_list->ListOptions->render("body", "left", $charge_group_list->RowCount);
?>
	<?php if ($charge_group_list->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
		<td data-name="ChargeGroupCode">
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupCode" class="form-group charge_group_ChargeGroupCode"></span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupCode" name="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" id="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charge_group_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<td data-name="ChargeGroupName">
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupName" class="form-group charge_group_ChargeGroupName">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupName" name="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->getPlaceHolder()) ?>" value="<?php echo $charge_group_list->ChargeGroupName->EditValue ?>"<?php echo $charge_group_list->ChargeGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupName" name="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charge_group_list->ListOptions->render("body", "right", $charge_group_list->RowCount);
?>
<script>
loadjs.ready(["fcharge_grouplist", "load"], function() {
	fcharge_grouplist.updateLists(<?php echo $charge_group_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($charge_group_list->ExportAll && $charge_group_list->isExport()) {
	$charge_group_list->StopRecord = $charge_group_list->TotalRecords;
} else {

	// Set the last record to display
	if ($charge_group_list->TotalRecords > $charge_group_list->StartRecord + $charge_group_list->DisplayRecords - 1)
		$charge_group_list->StopRecord = $charge_group_list->StartRecord + $charge_group_list->DisplayRecords - 1;
	else
		$charge_group_list->StopRecord = $charge_group_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($charge_group->isConfirm() || $charge_group_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($charge_group_list->FormKeyCountName) && ($charge_group_list->isGridAdd() || $charge_group_list->isGridEdit() || $charge_group->isConfirm())) {
		$charge_group_list->KeyCount = $CurrentForm->getValue($charge_group_list->FormKeyCountName);
		$charge_group_list->StopRecord = $charge_group_list->StartRecord + $charge_group_list->KeyCount - 1;
	}
}
$charge_group_list->RecordCount = $charge_group_list->StartRecord - 1;
if ($charge_group_list->Recordset && !$charge_group_list->Recordset->EOF) {
	$charge_group_list->Recordset->moveFirst();
	$selectLimit = $charge_group_list->UseSelectLimit;
	if (!$selectLimit && $charge_group_list->StartRecord > 1)
		$charge_group_list->Recordset->move($charge_group_list->StartRecord - 1);
} elseif (!$charge_group->AllowAddDeleteRow && $charge_group_list->StopRecord == 0) {
	$charge_group_list->StopRecord = $charge_group->GridAddRowCount;
}

// Initialize aggregate
$charge_group->RowType = ROWTYPE_AGGREGATEINIT;
$charge_group->resetAttributes();
$charge_group_list->renderRow();
$charge_group_list->EditRowCount = 0;
if ($charge_group_list->isEdit())
	$charge_group_list->RowIndex = 1;
if ($charge_group_list->isGridAdd())
	$charge_group_list->RowIndex = 0;
if ($charge_group_list->isGridEdit())
	$charge_group_list->RowIndex = 0;
while ($charge_group_list->RecordCount < $charge_group_list->StopRecord) {
	$charge_group_list->RecordCount++;
	if ($charge_group_list->RecordCount >= $charge_group_list->StartRecord) {
		$charge_group_list->RowCount++;
		if ($charge_group_list->isGridAdd() || $charge_group_list->isGridEdit() || $charge_group->isConfirm()) {
			$charge_group_list->RowIndex++;
			$CurrentForm->Index = $charge_group_list->RowIndex;
			if ($CurrentForm->hasValue($charge_group_list->FormActionName) && ($charge_group->isConfirm() || $charge_group_list->EventCancelled))
				$charge_group_list->RowAction = strval($CurrentForm->getValue($charge_group_list->FormActionName));
			elseif ($charge_group_list->isGridAdd())
				$charge_group_list->RowAction = "insert";
			else
				$charge_group_list->RowAction = "";
		}

		// Set up key count
		$charge_group_list->KeyCount = $charge_group_list->RowIndex;

		// Init row class and style
		$charge_group->resetAttributes();
		$charge_group->CssClass = "";
		if ($charge_group_list->isGridAdd()) {
			$charge_group_list->loadRowValues(); // Load default values
		} else {
			$charge_group_list->loadRowValues($charge_group_list->Recordset); // Load row values
		}
		$charge_group->RowType = ROWTYPE_VIEW; // Render view
		if ($charge_group_list->isGridAdd()) // Grid add
			$charge_group->RowType = ROWTYPE_ADD; // Render add
		if ($charge_group_list->isGridAdd() && $charge_group->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$charge_group_list->restoreCurrentRowFormValues($charge_group_list->RowIndex); // Restore form values
		if ($charge_group_list->isEdit()) {
			if ($charge_group_list->checkInlineEditKey() && $charge_group_list->EditRowCount == 0) { // Inline edit
				$charge_group->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($charge_group_list->isGridEdit()) { // Grid edit
			if ($charge_group->EventCancelled)
				$charge_group_list->restoreCurrentRowFormValues($charge_group_list->RowIndex); // Restore form values
			if ($charge_group_list->RowAction == "insert")
				$charge_group->RowType = ROWTYPE_ADD; // Render add
			else
				$charge_group->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($charge_group_list->isEdit() && $charge_group->RowType == ROWTYPE_EDIT && $charge_group->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$charge_group_list->restoreFormValues(); // Restore form values
		}
		if ($charge_group_list->isGridEdit() && ($charge_group->RowType == ROWTYPE_EDIT || $charge_group->RowType == ROWTYPE_ADD) && $charge_group->EventCancelled) // Update failed
			$charge_group_list->restoreCurrentRowFormValues($charge_group_list->RowIndex); // Restore form values
		if ($charge_group->RowType == ROWTYPE_EDIT) // Edit row
			$charge_group_list->EditRowCount++;

		// Set up row id / data-rowindex
		$charge_group->RowAttrs->merge(["data-rowindex" => $charge_group_list->RowCount, "id" => "r" . $charge_group_list->RowCount . "_charge_group", "data-rowtype" => $charge_group->RowType]);

		// Render row
		$charge_group_list->renderRow();

		// Render list options
		$charge_group_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($charge_group_list->RowAction != "delete" && $charge_group_list->RowAction != "insertdelete" && !($charge_group_list->RowAction == "insert" && $charge_group->isConfirm() && $charge_group_list->emptyRow())) {
?>
	<tr <?php echo $charge_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charge_group_list->ListOptions->render("body", "left", $charge_group_list->RowCount);
?>
	<?php if ($charge_group_list->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
		<td data-name="ChargeGroupCode" <?php echo $charge_group_list->ChargeGroupCode->cellAttributes() ?>>
<?php if ($charge_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupCode" class="form-group"></span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupCode" name="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" id="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($charge_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupCode" class="form-group">
<span<?php echo $charge_group_list->ChargeGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charge_group_list->ChargeGroupCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupCode" name="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" id="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupCode->CurrentValue) ?>">
<?php } ?>
<?php if ($charge_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupCode">
<span<?php echo $charge_group_list->ChargeGroupCode->viewAttributes() ?>><?php echo $charge_group_list->ChargeGroupCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charge_group_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<td data-name="ChargeGroupName" <?php echo $charge_group_list->ChargeGroupName->cellAttributes() ?>>
<?php if ($charge_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupName" class="form-group">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupName" name="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->getPlaceHolder()) ?>" value="<?php echo $charge_group_list->ChargeGroupName->EditValue ?>"<?php echo $charge_group_list->ChargeGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupName" name="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->OldValue) ?>">
<?php } ?>
<?php if ($charge_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupName" class="form-group">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupName" name="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->getPlaceHolder()) ?>" value="<?php echo $charge_group_list->ChargeGroupName->EditValue ?>"<?php echo $charge_group_list->ChargeGroupName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charge_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupName">
<span<?php echo $charge_group_list->ChargeGroupName->viewAttributes() ?>><?php echo $charge_group_list->ChargeGroupName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charge_group_list->ListOptions->render("body", "right", $charge_group_list->RowCount);
?>
	</tr>
<?php if ($charge_group->RowType == ROWTYPE_ADD || $charge_group->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcharge_grouplist", "load"], function() {
	fcharge_grouplist.updateLists(<?php echo $charge_group_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$charge_group_list->isGridAdd())
		if (!$charge_group_list->Recordset->EOF)
			$charge_group_list->Recordset->moveNext();
}
?>
<?php
	if ($charge_group_list->isGridAdd() || $charge_group_list->isGridEdit()) {
		$charge_group_list->RowIndex = '$rowindex$';
		$charge_group_list->loadRowValues();

		// Set row properties
		$charge_group->resetAttributes();
		$charge_group->RowAttrs->merge(["data-rowindex" => $charge_group_list->RowIndex, "id" => "r0_charge_group", "data-rowtype" => ROWTYPE_ADD]);
		$charge_group->RowAttrs->appendClass("ew-template");
		$charge_group->RowType = ROWTYPE_ADD;

		// Render row
		$charge_group_list->renderRow();

		// Render list options
		$charge_group_list->renderListOptions();
		$charge_group_list->StartRowCount = 0;
?>
	<tr <?php echo $charge_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charge_group_list->ListOptions->render("body", "left", $charge_group_list->RowIndex);
?>
	<?php if ($charge_group_list->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
		<td data-name="ChargeGroupCode">
<span id="el$rowindex$_charge_group_ChargeGroupCode" class="form-group charge_group_ChargeGroupCode"></span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupCode" name="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" id="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupCode" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charge_group_list->ChargeGroupName->Visible) { // ChargeGroupName ?>
		<td data-name="ChargeGroupName">
<span id="el$rowindex$_charge_group_ChargeGroupName" class="form-group charge_group_ChargeGroupName">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupName" name="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="x<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->getPlaceHolder()) ?>" value="<?php echo $charge_group_list->ChargeGroupName->EditValue ?>"<?php echo $charge_group_list->ChargeGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupName" name="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" id="o<?php echo $charge_group_list->RowIndex ?>_ChargeGroupName" value="<?php echo HtmlEncode($charge_group_list->ChargeGroupName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charge_group_list->ListOptions->render("body", "right", $charge_group_list->RowIndex);
?>
<script>
loadjs.ready(["fcharge_grouplist", "load"], function() {
	fcharge_grouplist.updateLists(<?php echo $charge_group_list->RowIndex ?>);
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
<?php if ($charge_group_list->isAdd() || $charge_group_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $charge_group_list->FormKeyCountName ?>" id="<?php echo $charge_group_list->FormKeyCountName ?>" value="<?php echo $charge_group_list->KeyCount ?>">
<?php } ?>
<?php if ($charge_group_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $charge_group_list->FormKeyCountName ?>" id="<?php echo $charge_group_list->FormKeyCountName ?>" value="<?php echo $charge_group_list->KeyCount ?>">
<?php echo $charge_group_list->MultiSelectKey ?>
<?php } ?>
<?php if ($charge_group_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $charge_group_list->FormKeyCountName ?>" id="<?php echo $charge_group_list->FormKeyCountName ?>" value="<?php echo $charge_group_list->KeyCount ?>">
<?php } ?>
<?php if ($charge_group_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $charge_group_list->FormKeyCountName ?>" id="<?php echo $charge_group_list->FormKeyCountName ?>" value="<?php echo $charge_group_list->KeyCount ?>">
<?php echo $charge_group_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$charge_group->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($charge_group_list->Recordset)
	$charge_group_list->Recordset->Close();
?>
<?php if (!$charge_group_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$charge_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charge_group_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($charge_group_list->TotalRecords == 0 && !$charge_group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $charge_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$charge_group_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charge_group_list->isExport()) { ?>
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
$charge_group_list->terminate();
?>