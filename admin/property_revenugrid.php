<?php
namespace PHPMaker2020\revenue;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($property_revenu_grid))
	$property_revenu_grid = new property_revenu_grid();

// Run the page
$property_revenu_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_revenu_grid->Page_Render();
?>
<?php if (!$property_revenu_grid->isExport()) { ?>
<script>
var fproperty_revenugrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fproperty_revenugrid = new ew.Form("fproperty_revenugrid", "grid");
	fproperty_revenugrid.formKeyCountName = '<?php echo $property_revenu_grid->FormKeyCountName ?>';

	// Validate form
	fproperty_revenugrid.validate = function() {
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
			<?php if ($property_revenu_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->id->caption(), $property_revenu_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_grid->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->ClientId->caption(), $property_revenu_grid->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_grid->ClientProperty->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientProperty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->ClientProperty->caption(), $property_revenu_grid->ClientProperty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientProperty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_grid->ClientProperty->errorMessage()) ?>");
			<?php if ($property_revenu_grid->PropertyId->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->PropertyId->caption(), $property_revenu_grid->PropertyId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_grid->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->PropertyUse->caption(), $property_revenu_grid->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->AmountPaid->caption(), $property_revenu_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($property_revenu_grid->Balance->Required) { ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->Balance->caption(), $property_revenu_grid->Balance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_grid->Balance->errorMessage()) ?>");
			<?php if ($property_revenu_grid->date->Required) { ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_grid->date->caption(), $property_revenu_grid->date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_grid->date->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fproperty_revenugrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ClientId", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientProperty", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyId", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "Balance", false)) return false;
		if (ew.valueChanged(fobj, infix, "date", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fproperty_revenugrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_revenugrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproperty_revenugrid.lists["x_ClientId"] = <?php echo $property_revenu_grid->ClientId->Lookup->toClientList($property_revenu_grid) ?>;
	fproperty_revenugrid.lists["x_ClientId"].options = <?php echo JsonEncode($property_revenu_grid->ClientId->lookupOptions()) ?>;
	fproperty_revenugrid.lists["x_ClientProperty"] = <?php echo $property_revenu_grid->ClientProperty->Lookup->toClientList($property_revenu_grid) ?>;
	fproperty_revenugrid.lists["x_ClientProperty"].options = <?php echo JsonEncode($property_revenu_grid->ClientProperty->lookupOptions()) ?>;
	fproperty_revenugrid.autoSuggests["x_ClientProperty"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fproperty_revenugrid");
});
</script>
<?php } ?>
<?php
$property_revenu_grid->renderOtherOptions();
?>
<?php if ($property_revenu_grid->TotalRecords > 0 || $property_revenu->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_revenu_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_revenu">
<?php if ($property_revenu_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $property_revenu_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fproperty_revenugrid" class="ew-form ew-list-form form-inline">
<div id="gmp_property_revenu" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_property_revenugrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_revenu->RowType = ROWTYPE_HEADER;

// Render list options
$property_revenu_grid->renderListOptions();

// Render list options (header, left)
$property_revenu_grid->ListOptions->render("header", "left");
?>
<?php if ($property_revenu_grid->id->Visible) { // id ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $property_revenu_grid->id->headerCellClass() ?>"><div id="elh_property_revenu_id" class="property_revenu_id"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $property_revenu_grid->id->headerCellClass() ?>"><div><div id="elh_property_revenu_id" class="property_revenu_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->ClientId->Visible) { // ClientId ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $property_revenu_grid->ClientId->headerCellClass() ?>"><div id="elh_property_revenu_ClientId" class="property_revenu_ClientId"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $property_revenu_grid->ClientId->headerCellClass() ?>"><div><div id="elh_property_revenu_ClientId" class="property_revenu_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->ClientProperty->Visible) { // ClientProperty ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->ClientProperty) == "") { ?>
		<th data-name="ClientProperty" class="<?php echo $property_revenu_grid->ClientProperty->headerCellClass() ?>"><div id="elh_property_revenu_ClientProperty" class="property_revenu_ClientProperty"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->ClientProperty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientProperty" class="<?php echo $property_revenu_grid->ClientProperty->headerCellClass() ?>"><div><div id="elh_property_revenu_ClientProperty" class="property_revenu_ClientProperty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->ClientProperty->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->ClientProperty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->ClientProperty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->PropertyId->Visible) { // PropertyId ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->PropertyId) == "") { ?>
		<th data-name="PropertyId" class="<?php echo $property_revenu_grid->PropertyId->headerCellClass() ?>"><div id="elh_property_revenu_PropertyId" class="property_revenu_PropertyId"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->PropertyId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyId" class="<?php echo $property_revenu_grid->PropertyId->headerCellClass() ?>"><div><div id="elh_property_revenu_PropertyId" class="property_revenu_PropertyId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->PropertyId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->PropertyId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->PropertyId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_revenu_grid->PropertyUse->headerCellClass() ?>"><div id="elh_property_revenu_PropertyUse" class="property_revenu_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_revenu_grid->PropertyUse->headerCellClass() ?>"><div><div id="elh_property_revenu_PropertyUse" class="property_revenu_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_revenu_grid->AmountPaid->headerCellClass() ?>"><div id="elh_property_revenu_AmountPaid" class="property_revenu_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_revenu_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_property_revenu_AmountPaid" class="property_revenu_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->Balance->Visible) { // Balance ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->Balance) == "") { ?>
		<th data-name="Balance" class="<?php echo $property_revenu_grid->Balance->headerCellClass() ?>"><div id="elh_property_revenu_Balance" class="property_revenu_Balance"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->Balance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Balance" class="<?php echo $property_revenu_grid->Balance->headerCellClass() ?>"><div><div id="elh_property_revenu_Balance" class="property_revenu_Balance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->Balance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->Balance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->Balance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_grid->date->Visible) { // date ?>
	<?php if ($property_revenu_grid->SortUrl($property_revenu_grid->date) == "") { ?>
		<th data-name="date" class="<?php echo $property_revenu_grid->date->headerCellClass() ?>"><div id="elh_property_revenu_date" class="property_revenu_date"><div class="ew-table-header-caption"><?php echo $property_revenu_grid->date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="date" class="<?php echo $property_revenu_grid->date->headerCellClass() ?>"><div><div id="elh_property_revenu_date" class="property_revenu_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_grid->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_grid->date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_grid->date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_revenu_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$property_revenu_grid->StartRecord = 1;
$property_revenu_grid->StopRecord = $property_revenu_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($property_revenu->isConfirm() || $property_revenu_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($property_revenu_grid->FormKeyCountName) && ($property_revenu_grid->isGridAdd() || $property_revenu_grid->isGridEdit() || $property_revenu->isConfirm())) {
		$property_revenu_grid->KeyCount = $CurrentForm->getValue($property_revenu_grid->FormKeyCountName);
		$property_revenu_grid->StopRecord = $property_revenu_grid->StartRecord + $property_revenu_grid->KeyCount - 1;
	}
}
$property_revenu_grid->RecordCount = $property_revenu_grid->StartRecord - 1;
if ($property_revenu_grid->Recordset && !$property_revenu_grid->Recordset->EOF) {
	$property_revenu_grid->Recordset->moveFirst();
	$selectLimit = $property_revenu_grid->UseSelectLimit;
	if (!$selectLimit && $property_revenu_grid->StartRecord > 1)
		$property_revenu_grid->Recordset->move($property_revenu_grid->StartRecord - 1);
} elseif (!$property_revenu->AllowAddDeleteRow && $property_revenu_grid->StopRecord == 0) {
	$property_revenu_grid->StopRecord = $property_revenu->GridAddRowCount;
}

// Initialize aggregate
$property_revenu->RowType = ROWTYPE_AGGREGATEINIT;
$property_revenu->resetAttributes();
$property_revenu_grid->renderRow();
if ($property_revenu_grid->isGridAdd())
	$property_revenu_grid->RowIndex = 0;
if ($property_revenu_grid->isGridEdit())
	$property_revenu_grid->RowIndex = 0;
while ($property_revenu_grid->RecordCount < $property_revenu_grid->StopRecord) {
	$property_revenu_grid->RecordCount++;
	if ($property_revenu_grid->RecordCount >= $property_revenu_grid->StartRecord) {
		$property_revenu_grid->RowCount++;
		if ($property_revenu_grid->isGridAdd() || $property_revenu_grid->isGridEdit() || $property_revenu->isConfirm()) {
			$property_revenu_grid->RowIndex++;
			$CurrentForm->Index = $property_revenu_grid->RowIndex;
			if ($CurrentForm->hasValue($property_revenu_grid->FormActionName) && ($property_revenu->isConfirm() || $property_revenu_grid->EventCancelled))
				$property_revenu_grid->RowAction = strval($CurrentForm->getValue($property_revenu_grid->FormActionName));
			elseif ($property_revenu_grid->isGridAdd())
				$property_revenu_grid->RowAction = "insert";
			else
				$property_revenu_grid->RowAction = "";
		}

		// Set up key count
		$property_revenu_grid->KeyCount = $property_revenu_grid->RowIndex;

		// Init row class and style
		$property_revenu->resetAttributes();
		$property_revenu->CssClass = "";
		if ($property_revenu_grid->isGridAdd()) {
			if ($property_revenu->CurrentMode == "copy") {
				$property_revenu_grid->loadRowValues($property_revenu_grid->Recordset); // Load row values
				$property_revenu_grid->setRecordKey($property_revenu_grid->RowOldKey, $property_revenu_grid->Recordset); // Set old record key
			} else {
				$property_revenu_grid->loadRowValues(); // Load default values
				$property_revenu_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$property_revenu_grid->loadRowValues($property_revenu_grid->Recordset); // Load row values
		}
		$property_revenu->RowType = ROWTYPE_VIEW; // Render view
		if ($property_revenu_grid->isGridAdd()) // Grid add
			$property_revenu->RowType = ROWTYPE_ADD; // Render add
		if ($property_revenu_grid->isGridAdd() && $property_revenu->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$property_revenu_grid->restoreCurrentRowFormValues($property_revenu_grid->RowIndex); // Restore form values
		if ($property_revenu_grid->isGridEdit()) { // Grid edit
			if ($property_revenu->EventCancelled)
				$property_revenu_grid->restoreCurrentRowFormValues($property_revenu_grid->RowIndex); // Restore form values
			if ($property_revenu_grid->RowAction == "insert")
				$property_revenu->RowType = ROWTYPE_ADD; // Render add
			else
				$property_revenu->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($property_revenu_grid->isGridEdit() && ($property_revenu->RowType == ROWTYPE_EDIT || $property_revenu->RowType == ROWTYPE_ADD) && $property_revenu->EventCancelled) // Update failed
			$property_revenu_grid->restoreCurrentRowFormValues($property_revenu_grid->RowIndex); // Restore form values
		if ($property_revenu->RowType == ROWTYPE_EDIT) // Edit row
			$property_revenu_grid->EditRowCount++;
		if ($property_revenu->isConfirm()) // Confirm row
			$property_revenu_grid->restoreCurrentRowFormValues($property_revenu_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$property_revenu->RowAttrs->merge(["data-rowindex" => $property_revenu_grid->RowCount, "id" => "r" . $property_revenu_grid->RowCount . "_property_revenu", "data-rowtype" => $property_revenu->RowType]);

		// Render row
		$property_revenu_grid->renderRow();

		// Render list options
		$property_revenu_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($property_revenu_grid->RowAction != "delete" && $property_revenu_grid->RowAction != "insertdelete" && !($property_revenu_grid->RowAction == "insert" && $property_revenu->isConfirm() && $property_revenu_grid->emptyRow())) {
?>
	<tr <?php echo $property_revenu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_revenu_grid->ListOptions->render("body", "left", $property_revenu_grid->RowCount);
?>
	<?php if ($property_revenu_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $property_revenu_grid->id->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_id" class="form-group"></span>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="o<?php echo $property_revenu_grid->RowIndex ?>_id" id="o<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_id" class="form-group">
<span<?php echo $property_revenu_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="x<?php echo $property_revenu_grid->RowIndex ?>_id" id="x<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_id">
<span<?php echo $property_revenu_grid->id->viewAttributes() ?>><?php echo $property_revenu_grid->id->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="x<?php echo $property_revenu_grid->RowIndex ?>_id" id="x<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_id" name="o<?php echo $property_revenu_grid->RowIndex ?>_id" id="o<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_id" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_id" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_id" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $property_revenu_grid->ClientId->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($property_revenu_grid->ClientId->getSessionValue() != "") { ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientId" class="form-group">
<span<?php echo $property_revenu_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientId" class="form-group">
<?php $property_revenu_grid->ClientId->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_revenu_grid->RowIndex ?>_ClientId"><?php echo EmptyValue(strval($property_revenu_grid->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_revenu_grid->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_grid->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_grid->ClientId->ReadOnly || $property_revenu_grid->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_revenu_grid->RowIndex ?>_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_revenu_grid->ClientId->Lookup->getParamTag($property_revenu_grid, "p_x" . $property_revenu_grid->RowIndex . "_ClientId") ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_grid->ClientId->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo $property_revenu_grid->ClientId->CurrentValue ?>"<?php echo $property_revenu_grid->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($property_revenu_grid->ClientId->getSessionValue() != "") { ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientId" class="form-group">
<span<?php echo $property_revenu_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientId" class="form-group">
<?php $property_revenu_grid->ClientId->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_revenu_grid->RowIndex ?>_ClientId"><?php echo EmptyValue(strval($property_revenu_grid->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_revenu_grid->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_grid->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_grid->ClientId->ReadOnly || $property_revenu_grid->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_revenu_grid->RowIndex ?>_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_revenu_grid->ClientId->Lookup->getParamTag($property_revenu_grid, "p_x" . $property_revenu_grid->RowIndex . "_ClientId") ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_grid->ClientId->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo $property_revenu_grid->ClientId->CurrentValue ?>"<?php echo $property_revenu_grid->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientId">
<span<?php echo $property_revenu_grid->ClientId->viewAttributes() ?>><?php echo $property_revenu_grid->ClientId->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->ClientProperty->Visible) { // ClientProperty ?>
		<td data-name="ClientProperty" <?php echo $property_revenu_grid->ClientProperty->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientProperty" class="form-group">
<?php
$onchange = $property_revenu_grid->ClientProperty->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_revenu_grid->ClientProperty->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="sv_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo RemoveHtml($property_revenu_grid->ClientProperty->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->getPlaceHolder()) ?>"<?php echo $property_revenu_grid->ClientProperty->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_grid->ClientProperty->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_grid->ClientProperty->ReadOnly || $property_revenu_grid->ClientProperty->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_grid->ClientProperty->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_revenugrid"], function() {
	fproperty_revenugrid.createAutoSuggest({"id":"x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty","forceSelect":true});
});
</script>
<?php echo $property_revenu_grid->ClientProperty->Lookup->getParamTag($property_revenu_grid, "p_x" . $property_revenu_grid->RowIndex . "_ClientProperty") ?>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientProperty" class="form-group">
<?php
$onchange = $property_revenu_grid->ClientProperty->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_revenu_grid->ClientProperty->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="sv_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo RemoveHtml($property_revenu_grid->ClientProperty->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->getPlaceHolder()) ?>"<?php echo $property_revenu_grid->ClientProperty->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_grid->ClientProperty->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_grid->ClientProperty->ReadOnly || $property_revenu_grid->ClientProperty->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_grid->ClientProperty->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_revenugrid"], function() {
	fproperty_revenugrid.createAutoSuggest({"id":"x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty","forceSelect":true});
});
</script>
<?php echo $property_revenu_grid->ClientProperty->Lookup->getParamTag($property_revenu_grid, "p_x" . $property_revenu_grid->RowIndex . "_ClientProperty") ?>
</span>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_ClientProperty">
<span<?php echo $property_revenu_grid->ClientProperty->viewAttributes() ?>><?php echo $property_revenu_grid->ClientProperty->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" <?php echo $property_revenu_grid->PropertyId->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_PropertyId" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_PropertyId" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_revenu_grid->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->PropertyId->EditValue ?>"<?php echo $property_revenu_grid->PropertyId->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_PropertyId" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_PropertyId" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_revenu_grid->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->PropertyId->EditValue ?>"<?php echo $property_revenu_grid->PropertyId->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_PropertyId">
<span<?php echo $property_revenu_grid->PropertyId->viewAttributes() ?>><?php echo $property_revenu_grid->PropertyId->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_revenu_grid->PropertyUse->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_PropertyUse" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_PropertyUse" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->PropertyUse->EditValue ?>"<?php echo $property_revenu_grid->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_PropertyUse" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_PropertyUse" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->PropertyUse->EditValue ?>"<?php echo $property_revenu_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_PropertyUse">
<span<?php echo $property_revenu_grid->PropertyUse->viewAttributes() ?>><?php echo $property_revenu_grid->PropertyUse->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_revenu_grid->AmountPaid->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_AmountPaid" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_AmountPaid" name="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->AmountPaid->EditValue ?>"<?php echo $property_revenu_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_AmountPaid" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_AmountPaid" name="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->AmountPaid->EditValue ?>"<?php echo $property_revenu_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_AmountPaid">
<span<?php echo $property_revenu_grid->AmountPaid->viewAttributes() ?>><?php echo $property_revenu_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->Balance->Visible) { // Balance ?>
		<td data-name="Balance" <?php echo $property_revenu_grid->Balance->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_Balance" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_Balance" name="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_grid->Balance->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->Balance->EditValue ?>"<?php echo $property_revenu_grid->Balance->editAttributes() ?>>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="o<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="o<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_Balance" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_Balance" name="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_grid->Balance->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->Balance->EditValue ?>"<?php echo $property_revenu_grid->Balance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_Balance">
<span<?php echo $property_revenu_grid->Balance->viewAttributes() ?>><?php echo $property_revenu_grid->Balance->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="o<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="o<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->date->Visible) { // date ?>
		<td data-name="date" <?php echo $property_revenu_grid->date->cellAttributes() ?>>
<?php if ($property_revenu->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_date" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_date" data-format="7" name="x<?php echo $property_revenu_grid->RowIndex ?>_date" id="x<?php echo $property_revenu_grid->RowIndex ?>_date" maxlength="19" placeholder="<?php echo HtmlEncode($property_revenu_grid->date->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->date->EditValue ?>"<?php echo $property_revenu_grid->date->editAttributes() ?>>
<?php if (!$property_revenu_grid->date->ReadOnly && !$property_revenu_grid->date->Disabled && !isset($property_revenu_grid->date->EditAttrs["readonly"]) && !isset($property_revenu_grid->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_revenugrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_revenugrid", "x<?php echo $property_revenu_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_date" name="o<?php echo $property_revenu_grid->RowIndex ?>_date" id="o<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->OldValue) ?>">
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_date" class="form-group">
<input type="text" data-table="property_revenu" data-field="x_date" data-format="7" name="x<?php echo $property_revenu_grid->RowIndex ?>_date" id="x<?php echo $property_revenu_grid->RowIndex ?>_date" maxlength="19" placeholder="<?php echo HtmlEncode($property_revenu_grid->date->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->date->EditValue ?>"<?php echo $property_revenu_grid->date->editAttributes() ?>>
<?php if (!$property_revenu_grid->date->ReadOnly && !$property_revenu_grid->date->Disabled && !isset($property_revenu_grid->date->EditAttrs["readonly"]) && !isset($property_revenu_grid->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_revenugrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_revenugrid", "x<?php echo $property_revenu_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($property_revenu->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_revenu_grid->RowCount ?>_property_revenu_date">
<span<?php echo $property_revenu_grid->date->viewAttributes() ?>><?php echo $property_revenu_grid->date->getViewValue() ?></span>
</span>
<?php if (!$property_revenu->isConfirm()) { ?>
<input type="hidden" data-table="property_revenu" data-field="x_date" name="x<?php echo $property_revenu_grid->RowIndex ?>_date" id="x<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_date" name="o<?php echo $property_revenu_grid->RowIndex ?>_date" id="o<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property_revenu" data-field="x_date" name="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_date" id="fproperty_revenugrid$x<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->FormValue) ?>">
<input type="hidden" data-table="property_revenu" data-field="x_date" name="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_date" id="fproperty_revenugrid$o<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_revenu_grid->ListOptions->render("body", "right", $property_revenu_grid->RowCount);
?>
	</tr>
<?php if ($property_revenu->RowType == ROWTYPE_ADD || $property_revenu->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fproperty_revenugrid", "load"], function() {
	fproperty_revenugrid.updateLists(<?php echo $property_revenu_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$property_revenu_grid->isGridAdd() || $property_revenu->CurrentMode == "copy")
		if (!$property_revenu_grid->Recordset->EOF)
			$property_revenu_grid->Recordset->moveNext();
}
?>
<?php
	if ($property_revenu->CurrentMode == "add" || $property_revenu->CurrentMode == "copy" || $property_revenu->CurrentMode == "edit") {
		$property_revenu_grid->RowIndex = '$rowindex$';
		$property_revenu_grid->loadRowValues();

		// Set row properties
		$property_revenu->resetAttributes();
		$property_revenu->RowAttrs->merge(["data-rowindex" => $property_revenu_grid->RowIndex, "id" => "r0_property_revenu", "data-rowtype" => ROWTYPE_ADD]);
		$property_revenu->RowAttrs->appendClass("ew-template");
		$property_revenu->RowType = ROWTYPE_ADD;

		// Render row
		$property_revenu_grid->renderRow();

		// Render list options
		$property_revenu_grid->renderListOptions();
		$property_revenu_grid->StartRowCount = 0;
?>
	<tr <?php echo $property_revenu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_revenu_grid->ListOptions->render("body", "left", $property_revenu_grid->RowIndex);
?>
	<?php if ($property_revenu_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_id" class="form-group property_revenu_id"></span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_id" class="form-group property_revenu_id">
<span<?php echo $property_revenu_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="x<?php echo $property_revenu_grid->RowIndex ?>_id" id="x<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="o<?php echo $property_revenu_grid->RowIndex ?>_id" id="o<?php echo $property_revenu_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_revenu_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId">
<?php if (!$property_revenu->isConfirm()) { ?>
<?php if ($property_revenu_grid->ClientId->getSessionValue() != "") { ?>
<span id="el$rowindex$_property_revenu_ClientId" class="form-group property_revenu_ClientId">
<span<?php echo $property_revenu_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_property_revenu_ClientId" class="form-group property_revenu_ClientId">
<?php $property_revenu_grid->ClientId->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_revenu_grid->RowIndex ?>_ClientId"><?php echo EmptyValue(strval($property_revenu_grid->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_revenu_grid->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_grid->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_grid->ClientId->ReadOnly || $property_revenu_grid->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_revenu_grid->RowIndex ?>_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_revenu_grid->ClientId->Lookup->getParamTag($property_revenu_grid, "p_x" . $property_revenu_grid->RowIndex . "_ClientId") ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_grid->ClientId->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo $property_revenu_grid->ClientId->CurrentValue ?>"<?php echo $property_revenu_grid->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_ClientId" class="form-group property_revenu_ClientId">
<span<?php echo $property_revenu_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" id="o<?php echo $property_revenu_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_revenu_grid->ClientId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->ClientProperty->Visible) { // ClientProperty ?>
		<td data-name="ClientProperty">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_ClientProperty" class="form-group property_revenu_ClientProperty">
<?php
$onchange = $property_revenu_grid->ClientProperty->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_revenu_grid->ClientProperty->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="sv_x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo RemoveHtml($property_revenu_grid->ClientProperty->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->getPlaceHolder()) ?>"<?php echo $property_revenu_grid->ClientProperty->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_grid->ClientProperty->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_grid->ClientProperty->ReadOnly || $property_revenu_grid->ClientProperty->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_grid->ClientProperty->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_revenugrid"], function() {
	fproperty_revenugrid.createAutoSuggest({"id":"x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty","forceSelect":true});
});
</script>
<?php echo $property_revenu_grid->ClientProperty->Lookup->getParamTag($property_revenu_grid, "p_x" . $property_revenu_grid->RowIndex . "_ClientProperty") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_ClientProperty" class="form-group property_revenu_ClientProperty">
<span<?php echo $property_revenu_grid->ClientProperty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->ClientProperty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="x<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" id="o<?php echo $property_revenu_grid->RowIndex ?>_ClientProperty" value="<?php echo HtmlEncode($property_revenu_grid->ClientProperty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_PropertyId" class="form-group property_revenu_PropertyId">
<input type="text" data-table="property_revenu" data-field="x_PropertyId" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_revenu_grid->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->PropertyId->EditValue ?>"<?php echo $property_revenu_grid->PropertyId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_PropertyId" class="form-group property_revenu_PropertyId">
<span<?php echo $property_revenu_grid->PropertyId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->PropertyId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" id="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_revenu_grid->PropertyId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_PropertyUse" class="form-group property_revenu_PropertyUse">
<input type="text" data-table="property_revenu" data-field="x_PropertyUse" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->PropertyUse->EditValue ?>"<?php echo $property_revenu_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_PropertyUse" class="form-group property_revenu_PropertyUse">
<span<?php echo $property_revenu_grid->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_revenu_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_revenu_grid->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_AmountPaid" class="form-group property_revenu_AmountPaid">
<input type="text" data-table="property_revenu" data-field="x_AmountPaid" name="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->AmountPaid->EditValue ?>"<?php echo $property_revenu_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_AmountPaid" class="form-group property_revenu_AmountPaid">
<span<?php echo $property_revenu_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_revenu_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_revenu_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->Balance->Visible) { // Balance ?>
		<td data-name="Balance">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_Balance" class="form-group property_revenu_Balance">
<input type="text" data-table="property_revenu" data-field="x_Balance" name="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_grid->Balance->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->Balance->EditValue ?>"<?php echo $property_revenu_grid->Balance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_Balance" class="form-group property_revenu_Balance">
<span<?php echo $property_revenu_grid->Balance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->Balance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="x<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="o<?php echo $property_revenu_grid->RowIndex ?>_Balance" id="o<?php echo $property_revenu_grid->RowIndex ?>_Balance" value="<?php echo HtmlEncode($property_revenu_grid->Balance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_revenu_grid->date->Visible) { // date ?>
		<td data-name="date">
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el$rowindex$_property_revenu_date" class="form-group property_revenu_date">
<input type="text" data-table="property_revenu" data-field="x_date" data-format="7" name="x<?php echo $property_revenu_grid->RowIndex ?>_date" id="x<?php echo $property_revenu_grid->RowIndex ?>_date" maxlength="19" placeholder="<?php echo HtmlEncode($property_revenu_grid->date->getPlaceHolder()) ?>" value="<?php echo $property_revenu_grid->date->EditValue ?>"<?php echo $property_revenu_grid->date->editAttributes() ?>>
<?php if (!$property_revenu_grid->date->ReadOnly && !$property_revenu_grid->date->Disabled && !isset($property_revenu_grid->date->EditAttrs["readonly"]) && !isset($property_revenu_grid->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_revenugrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_revenugrid", "x<?php echo $property_revenu_grid->RowIndex ?>_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_revenu_date" class="form-group property_revenu_date">
<span<?php echo $property_revenu_grid->date->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_grid->date->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_date" name="x<?php echo $property_revenu_grid->RowIndex ?>_date" id="x<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property_revenu" data-field="x_date" name="o<?php echo $property_revenu_grid->RowIndex ?>_date" id="o<?php echo $property_revenu_grid->RowIndex ?>_date" value="<?php echo HtmlEncode($property_revenu_grid->date->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_revenu_grid->ListOptions->render("body", "right", $property_revenu_grid->RowIndex);
?>
<script>
loadjs.ready(["fproperty_revenugrid", "load"], function() {
	fproperty_revenugrid.updateLists(<?php echo $property_revenu_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
<?php

// Render aggregate row
$property_revenu->RowType = ROWTYPE_AGGREGATE;
$property_revenu->resetAttributes();
$property_revenu_grid->renderRow();
?>
<?php if ($property_revenu_grid->TotalRecords > 0 && $property_revenu->CurrentMode == "view") { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$property_revenu_grid->renderListOptions();

// Render list options (footer, left)
$property_revenu_grid->ListOptions->render("footer", "left");
?>
	<?php if ($property_revenu_grid->id->Visible) { // id ?>
		<td data-name="id" class="<?php echo $property_revenu_grid->id->footerCellClass() ?>"><span id="elf_property_revenu_id" class="property_revenu_id">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" class="<?php echo $property_revenu_grid->ClientId->footerCellClass() ?>"><span id="elf_property_revenu_ClientId" class="property_revenu_ClientId">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->ClientProperty->Visible) { // ClientProperty ?>
		<td data-name="ClientProperty" class="<?php echo $property_revenu_grid->ClientProperty->footerCellClass() ?>"><span id="elf_property_revenu_ClientProperty" class="property_revenu_ClientProperty">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" class="<?php echo $property_revenu_grid->PropertyId->footerCellClass() ?>"><span id="elf_property_revenu_PropertyId" class="property_revenu_PropertyId">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" class="<?php echo $property_revenu_grid->PropertyUse->footerCellClass() ?>"><span id="elf_property_revenu_PropertyUse" class="property_revenu_PropertyUse">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $property_revenu_grid->AmountPaid->footerCellClass() ?>"><span id="elf_property_revenu_AmountPaid" class="property_revenu_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $property_revenu_grid->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->Balance->Visible) { // Balance ?>
		<td data-name="Balance" class="<?php echo $property_revenu_grid->Balance->footerCellClass() ?>"><span id="elf_property_revenu_Balance" class="property_revenu_Balance">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($property_revenu_grid->date->Visible) { // date ?>
		<td data-name="date" class="<?php echo $property_revenu_grid->date->footerCellClass() ?>"><span id="elf_property_revenu_date" class="property_revenu_date">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$property_revenu_grid->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($property_revenu->CurrentMode == "add" || $property_revenu->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $property_revenu_grid->FormKeyCountName ?>" id="<?php echo $property_revenu_grid->FormKeyCountName ?>" value="<?php echo $property_revenu_grid->KeyCount ?>">
<?php echo $property_revenu_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property_revenu->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $property_revenu_grid->FormKeyCountName ?>" id="<?php echo $property_revenu_grid->FormKeyCountName ?>" value="<?php echo $property_revenu_grid->KeyCount ?>">
<?php echo $property_revenu_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property_revenu->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fproperty_revenugrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_revenu_grid->Recordset)
	$property_revenu_grid->Recordset->Close();
?>
<?php if ($property_revenu_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $property_revenu_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_revenu_grid->TotalRecords == 0 && !$property_revenu->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_revenu_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$property_revenu_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$property_revenu_grid->terminate();
?>