<?php
namespace PHPMaker2020\revenue;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($property_grid))
	$property_grid = new property_grid();

// Run the page
$property_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_grid->Page_Render();
?>
<?php if (!$property_grid->isExport()) { ?>
<script>
var fpropertygrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpropertygrid = new ew.Form("fpropertygrid", "grid");
	fpropertygrid.formKeyCountName = '<?php echo $property_grid->FormKeyCountName ?>';

	// Validate form
	fpropertygrid.validate = function() {
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
			<?php if ($property_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->id->caption(), $property_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ClientId->caption(), $property_grid->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ChargeGroup->caption(), $property_grid->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->ChargeGroup->errorMessage()) ?>");
			<?php if ($property_grid->ChargeGropuDes->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGropuDes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ChargeGropuDes->caption(), $property_grid->ChargeGropuDes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->ChargeableFee->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ChargeableFee->caption(), $property_grid->ChargeableFee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->ChargeableFee->errorMessage()) ?>");
			<?php if ($property_grid->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->BalanceBF->caption(), $property_grid->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->BalanceBF->errorMessage()) ?>");
			<?php if ($property_grid->AmountPayable->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->AmountPayable->caption(), $property_grid->AmountPayable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->AmountPayable->errorMessage()) ?>");
			<?php if ($property_grid->Property->Required) { ?>
				elm = this.getElements("x" + infix + "_Property");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Property->caption(), $property_grid->Property->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->PropertyId->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyId->caption(), $property_grid->PropertyId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyUse->caption(), $property_grid->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Location->caption(), $property_grid->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->AmountPaid->caption(), $property_grid->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->AmountPaid->errorMessage()) ?>");
			<?php if ($property_grid->CurrentBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->CurrentBalance->caption(), $property_grid->CurrentBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->CurrentBalance->errorMessage()) ?>");
			<?php if ($property_grid->DataRegistered->Required) { ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->DataRegistered->caption(), $property_grid->DataRegistered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->DataRegistered->errorMessage()) ?>");
			<?php if ($property_grid->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Status->caption(), $property_grid->Status->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpropertygrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ClientId", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGroup", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGropuDes", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeableFee", false)) return false;
		if (ew.valueChanged(fobj, infix, "BalanceBF", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPayable", false)) return false;
		if (ew.valueChanged(fobj, infix, "Property", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyId", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse", false)) return false;
		if (ew.valueChanged(fobj, infix, "Location", false)) return false;
		if (ew.valueChanged(fobj, infix, "AmountPaid", false)) return false;
		if (ew.valueChanged(fobj, infix, "CurrentBalance", false)) return false;
		if (ew.valueChanged(fobj, infix, "DataRegistered", false)) return false;
		if (ew.valueChanged(fobj, infix, "Status", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpropertygrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertygrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertygrid.lists["x_ClientId"] = <?php echo $property_grid->ClientId->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_ClientId"].options = <?php echo JsonEncode($property_grid->ClientId->lookupOptions()) ?>;
	fpropertygrid.lists["x_ChargeGroup"] = <?php echo $property_grid->ChargeGroup->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_ChargeGroup"].options = <?php echo JsonEncode($property_grid->ChargeGroup->lookupOptions()) ?>;
	fpropertygrid.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertygrid.lists["x_ChargeGropuDes"] = <?php echo $property_grid->ChargeGropuDes->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_ChargeGropuDes"].options = <?php echo JsonEncode($property_grid->ChargeGropuDes->lookupOptions()) ?>;
	fpropertygrid.lists["x_Status"] = <?php echo $property_grid->Status->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_Status"].options = <?php echo JsonEncode($property_grid->Status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpropertygrid");
});
</script>
<?php } ?>
<?php
$property_grid->renderOtherOptions();
?>
<?php if ($property_grid->TotalRecords > 0 || $property->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property">
<?php if ($property_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $property_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpropertygrid" class="ew-form ew-list-form form-inline">
<div id="gmp_property" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_propertygrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property->RowType = ROWTYPE_HEADER;

// Render list options
$property_grid->renderListOptions();

// Render list options (header, left)
$property_grid->ListOptions->render("header", "left");
?>
<?php if ($property_grid->id->Visible) { // id ?>
	<?php if ($property_grid->SortUrl($property_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $property_grid->id->headerCellClass() ?>"><div id="elh_property_id" class="property_id"><div class="ew-table-header-caption"><?php echo $property_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $property_grid->id->headerCellClass() ?>"><div><div id="elh_property_id" class="property_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ClientId->Visible) { // ClientId ?>
	<?php if ($property_grid->SortUrl($property_grid->ClientId) == "") { ?>
		<th data-name="ClientId" class="<?php echo $property_grid->ClientId->headerCellClass() ?>"><div id="elh_property_ClientId" class="property_ClientId"><div class="ew-table-header-caption"><?php echo $property_grid->ClientId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientId" class="<?php echo $property_grid->ClientId->headerCellClass() ?>"><div><div id="elh_property_ClientId" class="property_ClientId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ClientId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ClientId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property_grid->SortUrl($property_grid->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_grid->ChargeGroup->headerCellClass() ?>"><div id="elh_property_ChargeGroup" class="property_ChargeGroup"><div class="ew-table-header-caption"><?php echo $property_grid->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_grid->ChargeGroup->headerCellClass() ?>"><div><div id="elh_property_ChargeGroup" class="property_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<?php if ($property_grid->SortUrl($property_grid->ChargeGropuDes) == "") { ?>
		<th data-name="ChargeGropuDes" class="<?php echo $property_grid->ChargeGropuDes->headerCellClass() ?>"><div id="elh_property_ChargeGropuDes" class="property_ChargeGropuDes"><div class="ew-table-header-caption"><?php echo $property_grid->ChargeGropuDes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGropuDes" class="<?php echo $property_grid->ChargeGropuDes->headerCellClass() ?>"><div><div id="elh_property_ChargeGropuDes" class="property_ChargeGropuDes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ChargeGropuDes->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ChargeGropuDes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ChargeGropuDes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ChargeableFee->Visible) { // ChargeableFee ?>
	<?php if ($property_grid->SortUrl($property_grid->ChargeableFee) == "") { ?>
		<th data-name="ChargeableFee" class="<?php echo $property_grid->ChargeableFee->headerCellClass() ?>"><div id="elh_property_ChargeableFee" class="property_ChargeableFee"><div class="ew-table-header-caption"><?php echo $property_grid->ChargeableFee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeableFee" class="<?php echo $property_grid->ChargeableFee->headerCellClass() ?>"><div><div id="elh_property_ChargeableFee" class="property_ChargeableFee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ChargeableFee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ChargeableFee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ChargeableFee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_grid->SortUrl($property_grid->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $property_grid->BalanceBF->headerCellClass() ?>"><div id="elh_property_BalanceBF" class="property_BalanceBF"><div class="ew-table-header-caption"><?php echo $property_grid->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $property_grid->BalanceBF->headerCellClass() ?>"><div><div id="elh_property_BalanceBF" class="property_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->AmountPayable->Visible) { // AmountPayable ?>
	<?php if ($property_grid->SortUrl($property_grid->AmountPayable) == "") { ?>
		<th data-name="AmountPayable" class="<?php echo $property_grid->AmountPayable->headerCellClass() ?>"><div id="elh_property_AmountPayable" class="property_AmountPayable"><div class="ew-table-header-caption"><?php echo $property_grid->AmountPayable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPayable" class="<?php echo $property_grid->AmountPayable->headerCellClass() ?>"><div><div id="elh_property_AmountPayable" class="property_AmountPayable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->AmountPayable->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->AmountPayable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->AmountPayable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Property->Visible) { // Property ?>
	<?php if ($property_grid->SortUrl($property_grid->Property) == "") { ?>
		<th data-name="Property" class="<?php echo $property_grid->Property->headerCellClass() ?>"><div id="elh_property_Property" class="property_Property"><div class="ew-table-header-caption"><?php echo $property_grid->Property->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Property" class="<?php echo $property_grid->Property->headerCellClass() ?>"><div><div id="elh_property_Property" class="property_Property">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Property->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Property->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Property->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->PropertyId->Visible) { // PropertyId ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyId) == "") { ?>
		<th data-name="PropertyId" class="<?php echo $property_grid->PropertyId->headerCellClass() ?>"><div id="elh_property_PropertyId" class="property_PropertyId"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyId->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyId" class="<?php echo $property_grid->PropertyId->headerCellClass() ?>"><div><div id="elh_property_PropertyId" class="property_PropertyId">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyId->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyId->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_grid->PropertyUse->headerCellClass() ?>"><div id="elh_property_PropertyUse" class="property_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_grid->PropertyUse->headerCellClass() ?>"><div><div id="elh_property_PropertyUse" class="property_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Location->Visible) { // Location ?>
	<?php if ($property_grid->SortUrl($property_grid->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_grid->Location->headerCellClass() ?>"><div id="elh_property_Location" class="property_Location"><div class="ew-table-header-caption"><?php echo $property_grid->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_grid->Location->headerCellClass() ?>"><div><div id="elh_property_Location" class="property_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_grid->SortUrl($property_grid->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_grid->AmountPaid->headerCellClass() ?>"><div id="elh_property_AmountPaid" class="property_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_grid->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_grid->AmountPaid->headerCellClass() ?>"><div><div id="elh_property_AmountPaid" class="property_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->CurrentBalance->Visible) { // CurrentBalance ?>
	<?php if ($property_grid->SortUrl($property_grid->CurrentBalance) == "") { ?>
		<th data-name="CurrentBalance" class="<?php echo $property_grid->CurrentBalance->headerCellClass() ?>"><div id="elh_property_CurrentBalance" class="property_CurrentBalance"><div class="ew-table-header-caption"><?php echo $property_grid->CurrentBalance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentBalance" class="<?php echo $property_grid->CurrentBalance->headerCellClass() ?>"><div><div id="elh_property_CurrentBalance" class="property_CurrentBalance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->CurrentBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->CurrentBalance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->CurrentBalance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->DataRegistered->Visible) { // DataRegistered ?>
	<?php if ($property_grid->SortUrl($property_grid->DataRegistered) == "") { ?>
		<th data-name="DataRegistered" class="<?php echo $property_grid->DataRegistered->headerCellClass() ?>"><div id="elh_property_DataRegistered" class="property_DataRegistered"><div class="ew-table-header-caption"><?php echo $property_grid->DataRegistered->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DataRegistered" class="<?php echo $property_grid->DataRegistered->headerCellClass() ?>"><div><div id="elh_property_DataRegistered" class="property_DataRegistered">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->DataRegistered->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->DataRegistered->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->DataRegistered->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Status->Visible) { // Status ?>
	<?php if ($property_grid->SortUrl($property_grid->Status) == "") { ?>
		<th data-name="Status" class="<?php echo $property_grid->Status->headerCellClass() ?>"><div id="elh_property_Status" class="property_Status"><div class="ew-table-header-caption"><?php echo $property_grid->Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status" class="<?php echo $property_grid->Status->headerCellClass() ?>"><div><div id="elh_property_Status" class="property_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$property_grid->StartRecord = 1;
$property_grid->StopRecord = $property_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($property->isConfirm() || $property_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($property_grid->FormKeyCountName) && ($property_grid->isGridAdd() || $property_grid->isGridEdit() || $property->isConfirm())) {
		$property_grid->KeyCount = $CurrentForm->getValue($property_grid->FormKeyCountName);
		$property_grid->StopRecord = $property_grid->StartRecord + $property_grid->KeyCount - 1;
	}
}
$property_grid->RecordCount = $property_grid->StartRecord - 1;
if ($property_grid->Recordset && !$property_grid->Recordset->EOF) {
	$property_grid->Recordset->moveFirst();
	$selectLimit = $property_grid->UseSelectLimit;
	if (!$selectLimit && $property_grid->StartRecord > 1)
		$property_grid->Recordset->move($property_grid->StartRecord - 1);
} elseif (!$property->AllowAddDeleteRow && $property_grid->StopRecord == 0) {
	$property_grid->StopRecord = $property->GridAddRowCount;
}

// Initialize aggregate
$property->RowType = ROWTYPE_AGGREGATEINIT;
$property->resetAttributes();
$property_grid->renderRow();
if ($property_grid->isGridAdd())
	$property_grid->RowIndex = 0;
if ($property_grid->isGridEdit())
	$property_grid->RowIndex = 0;
while ($property_grid->RecordCount < $property_grid->StopRecord) {
	$property_grid->RecordCount++;
	if ($property_grid->RecordCount >= $property_grid->StartRecord) {
		$property_grid->RowCount++;
		if ($property_grid->isGridAdd() || $property_grid->isGridEdit() || $property->isConfirm()) {
			$property_grid->RowIndex++;
			$CurrentForm->Index = $property_grid->RowIndex;
			if ($CurrentForm->hasValue($property_grid->FormActionName) && ($property->isConfirm() || $property_grid->EventCancelled))
				$property_grid->RowAction = strval($CurrentForm->getValue($property_grid->FormActionName));
			elseif ($property_grid->isGridAdd())
				$property_grid->RowAction = "insert";
			else
				$property_grid->RowAction = "";
		}

		// Set up key count
		$property_grid->KeyCount = $property_grid->RowIndex;

		// Init row class and style
		$property->resetAttributes();
		$property->CssClass = "";
		if ($property_grid->isGridAdd()) {
			if ($property->CurrentMode == "copy") {
				$property_grid->loadRowValues($property_grid->Recordset); // Load row values
				$property_grid->setRecordKey($property_grid->RowOldKey, $property_grid->Recordset); // Set old record key
			} else {
				$property_grid->loadRowValues(); // Load default values
				$property_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$property_grid->loadRowValues($property_grid->Recordset); // Load row values
		}
		$property->RowType = ROWTYPE_VIEW; // Render view
		if ($property_grid->isGridAdd()) // Grid add
			$property->RowType = ROWTYPE_ADD; // Render add
		if ($property_grid->isGridAdd() && $property->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values
		if ($property_grid->isGridEdit()) { // Grid edit
			if ($property->EventCancelled)
				$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values
			if ($property_grid->RowAction == "insert")
				$property->RowType = ROWTYPE_ADD; // Render add
			else
				$property->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($property_grid->isGridEdit() && ($property->RowType == ROWTYPE_EDIT || $property->RowType == ROWTYPE_ADD) && $property->EventCancelled) // Update failed
			$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values
		if ($property->RowType == ROWTYPE_EDIT) // Edit row
			$property_grid->EditRowCount++;
		if ($property->isConfirm()) // Confirm row
			$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$property->RowAttrs->merge(["data-rowindex" => $property_grid->RowCount, "id" => "r" . $property_grid->RowCount . "_property", "data-rowtype" => $property->RowType]);

		// Render row
		$property_grid->renderRow();

		// Render list options
		$property_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($property_grid->RowAction != "delete" && $property_grid->RowAction != "insertdelete" && !($property_grid->RowAction == "insert" && $property->isConfirm() && $property_grid->emptyRow())) {
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_grid->ListOptions->render("body", "left", $property_grid->RowCount);
?>
	<?php if ($property_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $property_grid->id->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_id" class="form-group"></span>
<input type="hidden" data-table="property" data-field="x_id" name="o<?php echo $property_grid->RowIndex ?>_id" id="o<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_id" class="form-group">
<span<?php echo $property_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_id" name="x<?php echo $property_grid->RowIndex ?>_id" id="x<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_id">
<span<?php echo $property_grid->id->viewAttributes() ?>><?php echo $property_grid->id->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_id" name="x<?php echo $property_grid->RowIndex ?>_id" id="x<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_id" name="o<?php echo $property_grid->RowIndex ?>_id" id="o<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_id" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_id" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_id" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_id" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId" <?php echo $property_grid->ClientId->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($property_grid->ClientId->getSessionValue() != "") { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientId" class="form-group">
<span<?php echo $property_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_grid->RowIndex ?>_ClientId" name="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientId" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_ClientId"><?php echo EmptyValue(strval($property_grid->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientId->ReadOnly || $property_grid->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->ClientId->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientId") ?>
<input type="hidden" data-table="property" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientId->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientId" id="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo $property_grid->ClientId->CurrentValue ?>"<?php echo $property_grid->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ClientId" name="o<?php echo $property_grid->RowIndex ?>_ClientId" id="o<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($property_grid->ClientId->getSessionValue() != "") { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientId" class="form-group">
<span<?php echo $property_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_grid->RowIndex ?>_ClientId" name="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientId" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_ClientId"><?php echo EmptyValue(strval($property_grid->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientId->ReadOnly || $property_grid->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->ClientId->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientId") ?>
<input type="hidden" data-table="property" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientId->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientId" id="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo $property_grid->ClientId->CurrentValue ?>"<?php echo $property_grid->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientId">
<span<?php echo $property_grid->ClientId->viewAttributes() ?>><?php echo $property_grid->ClientId->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ClientId" name="x<?php echo $property_grid->RowIndex ?>_ClientId" id="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ClientId" name="o<?php echo $property_grid->RowIndex ?>_ClientId" id="o<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ClientId" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ClientId" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ClientId" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ClientId" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $property_grid->ChargeGroup->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeGroup" class="form-group">
<?php
$onchange = $property_grid->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="sv_x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo RemoveHtml($property_grid->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_grid->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ChargeGroup',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ChargeGroup->ReadOnly || $property_grid->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ChargeGroup","forceSelect":true});
});
</script>
<?php echo $property_grid->ChargeGroup->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ChargeGroup") ?>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="o<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeGroup" class="form-group">
<?php
$onchange = $property_grid->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="sv_x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo RemoveHtml($property_grid->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_grid->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ChargeGroup',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ChargeGroup->ReadOnly || $property_grid->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ChargeGroup","forceSelect":true});
});
</script>
<?php echo $property_grid->ChargeGroup->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ChargeGroup") ?>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeGroup">
<span<?php echo $property_grid->ChargeGroup->viewAttributes() ?>><?php echo $property_grid->ChargeGroup->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="o<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<td data-name="ChargeGropuDes" <?php echo $property_grid->ChargeGropuDes->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeGropuDes" class="form-group">
<?php $property_grid->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes"><?php echo EmptyValue(strval($property_grid->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ChargeGropuDes->ReadOnly || $property_grid->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->ChargeGropuDes->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ChargeGropuDes") ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo $property_grid->ChargeGropuDes->CurrentValue ?>"<?php echo $property_grid->ChargeGropuDes->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeGropuDes" class="form-group">
<?php $property_grid->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes"><?php echo EmptyValue(strval($property_grid->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ChargeGropuDes->ReadOnly || $property_grid->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->ChargeGropuDes->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ChargeGropuDes") ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo $property_grid->ChargeGropuDes->CurrentValue ?>"<?php echo $property_grid->ChargeGropuDes->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeGropuDes">
<span<?php echo $property_grid->ChargeGropuDes->viewAttributes() ?>><?php echo $property_grid->ChargeGropuDes->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ChargeableFee->Visible) { // ChargeableFee ?>
		<td data-name="ChargeableFee" <?php echo $property_grid->ChargeableFee->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeableFee" class="form-group">
<input type="text" data-table="property" data-field="x_ChargeableFee" name="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_grid->ChargeableFee->EditValue ?>"<?php echo $property_grid->ChargeableFee->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="o<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="o<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeableFee" class="form-group">
<input type="text" data-table="property" data-field="x_ChargeableFee" name="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_grid->ChargeableFee->EditValue ?>"<?php echo $property_grid->ChargeableFee->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ChargeableFee">
<span<?php echo $property_grid->ChargeableFee->viewAttributes() ?>><?php echo $property_grid->ChargeableFee->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="o<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="o<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $property_grid->BalanceBF->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_BalanceBF" class="form-group">
<input type="text" data-table="property" data-field="x_BalanceBF" name="x<?php echo $property_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_grid->RowIndex ?>_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_grid->BalanceBF->EditValue ?>"<?php echo $property_grid->BalanceBF->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="o<?php echo $property_grid->RowIndex ?>_BalanceBF" id="o<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_BalanceBF" class="form-group">
<input type="text" data-table="property" data-field="x_BalanceBF" name="x<?php echo $property_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_grid->RowIndex ?>_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_grid->BalanceBF->EditValue ?>"<?php echo $property_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_BalanceBF">
<span<?php echo $property_grid->BalanceBF->viewAttributes() ?>><?php echo $property_grid->BalanceBF->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="x<?php echo $property_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="o<?php echo $property_grid->RowIndex ?>_BalanceBF" id="o<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_BalanceBF" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_BalanceBF" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->AmountPayable->Visible) { // AmountPayable ?>
		<td data-name="AmountPayable" <?php echo $property_grid->AmountPayable->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_AmountPayable" class="form-group">
<input type="text" data-table="property" data-field="x_AmountPayable" name="x<?php echo $property_grid->RowIndex ?>_AmountPayable" id="x<?php echo $property_grid->RowIndex ?>_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_grid->AmountPayable->EditValue ?>"<?php echo $property_grid->AmountPayable->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="o<?php echo $property_grid->RowIndex ?>_AmountPayable" id="o<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_AmountPayable" class="form-group">
<input type="text" data-table="property" data-field="x_AmountPayable" name="x<?php echo $property_grid->RowIndex ?>_AmountPayable" id="x<?php echo $property_grid->RowIndex ?>_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_grid->AmountPayable->EditValue ?>"<?php echo $property_grid->AmountPayable->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_AmountPayable">
<span<?php echo $property_grid->AmountPayable->viewAttributes() ?>><?php echo $property_grid->AmountPayable->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="x<?php echo $property_grid->RowIndex ?>_AmountPayable" id="x<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="o<?php echo $property_grid->RowIndex ?>_AmountPayable" id="o<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_AmountPayable" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_AmountPayable" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Property->Visible) { // Property ?>
		<td data-name="Property" <?php echo $property_grid->Property->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Property" class="form-group">
<input type="text" data-table="property" data-field="x_Property" name="x<?php echo $property_grid->RowIndex ?>_Property" id="x<?php echo $property_grid->RowIndex ?>_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_grid->Property->getPlaceHolder()) ?>" value="<?php echo $property_grid->Property->EditValue ?>"<?php echo $property_grid->Property->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_Property" name="o<?php echo $property_grid->RowIndex ?>_Property" id="o<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Property" class="form-group">
<input type="text" data-table="property" data-field="x_Property" name="x<?php echo $property_grid->RowIndex ?>_Property" id="x<?php echo $property_grid->RowIndex ?>_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_grid->Property->getPlaceHolder()) ?>" value="<?php echo $property_grid->Property->EditValue ?>"<?php echo $property_grid->Property->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Property">
<span<?php echo $property_grid->Property->viewAttributes() ?>><?php echo $property_grid->Property->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Property" name="x<?php echo $property_grid->RowIndex ?>_Property" id="x<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Property" name="o<?php echo $property_grid->RowIndex ?>_Property" id="o<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Property" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Property" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Property" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Property" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId" <?php echo $property_grid->PropertyId->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyId" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyId" name="x<?php echo $property_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_grid->RowIndex ?>_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyId->EditValue ?>"<?php echo $property_grid->PropertyId->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="o<?php echo $property_grid->RowIndex ?>_PropertyId" id="o<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyId" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyId" name="x<?php echo $property_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_grid->RowIndex ?>_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyId->EditValue ?>"<?php echo $property_grid->PropertyId->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyId">
<span<?php echo $property_grid->PropertyId->viewAttributes() ?>><?php echo $property_grid->PropertyId->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="x<?php echo $property_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyId" name="o<?php echo $property_grid->RowIndex ?>_PropertyId" id="o<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyId" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyId" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyId" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_grid->PropertyUse->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyUse" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyUse->EditValue ?>"<?php echo $property_grid->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="o<?php echo $property_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyUse" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyUse->EditValue ?>"<?php echo $property_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyUse">
<span<?php echo $property_grid->PropertyUse->viewAttributes() ?>><?php echo $property_grid->PropertyUse->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="o<?php echo $property_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyUse" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_grid->Location->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Location" class="form-group">
<input type="text" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->Location->getPlaceHolder()) ?>" value="<?php echo $property_grid->Location->EditValue ?>"<?php echo $property_grid->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_Location" name="o<?php echo $property_grid->RowIndex ?>_Location" id="o<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Location" class="form-group">
<input type="text" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->Location->getPlaceHolder()) ?>" value="<?php echo $property_grid->Location->EditValue ?>"<?php echo $property_grid->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Location">
<span<?php echo $property_grid->Location->viewAttributes() ?>><?php echo $property_grid->Location->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Location" name="o<?php echo $property_grid->RowIndex ?>_Location" id="o<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Location" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Location" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Location" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Location" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_grid->AmountPaid->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_AmountPaid" class="form-group">
<input type="text" data-table="property" data-field="x_AmountPaid" name="x<?php echo $property_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_grid->RowIndex ?>_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_grid->AmountPaid->EditValue ?>"<?php echo $property_grid->AmountPaid->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="o<?php echo $property_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_AmountPaid" class="form-group">
<input type="text" data-table="property" data-field="x_AmountPaid" name="x<?php echo $property_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_grid->RowIndex ?>_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_grid->AmountPaid->EditValue ?>"<?php echo $property_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_AmountPaid">
<span<?php echo $property_grid->AmountPaid->viewAttributes() ?>><?php echo $property_grid->AmountPaid->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="x<?php echo $property_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="o<?php echo $property_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_AmountPaid" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_AmountPaid" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->CurrentBalance->Visible) { // CurrentBalance ?>
		<td data-name="CurrentBalance" <?php echo $property_grid->CurrentBalance->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_CurrentBalance" class="form-group">
<input type="text" data-table="property" data-field="x_CurrentBalance" name="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_grid->CurrentBalance->EditValue ?>"<?php echo $property_grid->CurrentBalance->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="o<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="o<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_CurrentBalance" class="form-group">
<input type="text" data-table="property" data-field="x_CurrentBalance" name="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_grid->CurrentBalance->EditValue ?>"<?php echo $property_grid->CurrentBalance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_CurrentBalance">
<span<?php echo $property_grid->CurrentBalance->viewAttributes() ?>><?php echo $property_grid->CurrentBalance->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="o<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="o<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->DataRegistered->Visible) { // DataRegistered ?>
		<td data-name="DataRegistered" <?php echo $property_grid->DataRegistered->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_DataRegistered" class="form-group">
<input type="text" data-table="property" data-field="x_DataRegistered" name="x<?php echo $property_grid->RowIndex ?>_DataRegistered" id="x<?php echo $property_grid->RowIndex ?>_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_grid->DataRegistered->EditValue ?>"<?php echo $property_grid->DataRegistered->editAttributes() ?>>
<?php if (!$property_grid->DataRegistered->ReadOnly && !$property_grid->DataRegistered->Disabled && !isset($property_grid->DataRegistered->EditAttrs["readonly"]) && !isset($property_grid->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpropertygrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpropertygrid", "x<?php echo $property_grid->RowIndex ?>_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="o<?php echo $property_grid->RowIndex ?>_DataRegistered" id="o<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_DataRegistered" class="form-group">
<input type="text" data-table="property" data-field="x_DataRegistered" name="x<?php echo $property_grid->RowIndex ?>_DataRegistered" id="x<?php echo $property_grid->RowIndex ?>_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_grid->DataRegistered->EditValue ?>"<?php echo $property_grid->DataRegistered->editAttributes() ?>>
<?php if (!$property_grid->DataRegistered->ReadOnly && !$property_grid->DataRegistered->Disabled && !isset($property_grid->DataRegistered->EditAttrs["readonly"]) && !isset($property_grid->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpropertygrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpropertygrid", "x<?php echo $property_grid->RowIndex ?>_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_DataRegistered">
<span<?php echo $property_grid->DataRegistered->viewAttributes() ?>><?php echo $property_grid->DataRegistered->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="x<?php echo $property_grid->RowIndex ?>_DataRegistered" id="x<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="o<?php echo $property_grid->RowIndex ?>_DataRegistered" id="o<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_DataRegistered" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_DataRegistered" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Status->Visible) { // Status ?>
		<td data-name="Status" <?php echo $property_grid->Status->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Status" class="form-group">
<div id="tp_x<?php echo $property_grid->RowIndex ?>_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="property" data-field="x_Status" data-value-separator="<?php echo $property_grid->Status->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_Status" id="x<?php echo $property_grid->RowIndex ?>_Status" value="{value}"<?php echo $property_grid->Status->editAttributes() ?>></div>
<div id="dsl_x<?php echo $property_grid->RowIndex ?>_Status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $property_grid->Status->radioButtonListHtml(FALSE, "x{$property_grid->RowIndex}_Status") ?>
</div></div>
</span>
<input type="hidden" data-table="property" data-field="x_Status" name="o<?php echo $property_grid->RowIndex ?>_Status" id="o<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Status" class="form-group">
<div id="tp_x<?php echo $property_grid->RowIndex ?>_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="property" data-field="x_Status" data-value-separator="<?php echo $property_grid->Status->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_Status" id="x<?php echo $property_grid->RowIndex ?>_Status" value="{value}"<?php echo $property_grid->Status->editAttributes() ?>></div>
<div id="dsl_x<?php echo $property_grid->RowIndex ?>_Status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $property_grid->Status->radioButtonListHtml(FALSE, "x{$property_grid->RowIndex}_Status") ?>
</div></div>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Status">
<span<?php echo $property_grid->Status->viewAttributes() ?>><?php echo $property_grid->Status->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Status" name="x<?php echo $property_grid->RowIndex ?>_Status" id="x<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Status" name="o<?php echo $property_grid->RowIndex ?>_Status" id="o<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Status" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Status" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Status" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Status" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_grid->ListOptions->render("body", "right", $property_grid->RowCount);
?>
	</tr>
<?php if ($property->RowType == ROWTYPE_ADD || $property->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpropertygrid", "load"], function() {
	fpropertygrid.updateLists(<?php echo $property_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$property_grid->isGridAdd() || $property->CurrentMode == "copy")
		if (!$property_grid->Recordset->EOF)
			$property_grid->Recordset->moveNext();
}
?>
<?php
	if ($property->CurrentMode == "add" || $property->CurrentMode == "copy" || $property->CurrentMode == "edit") {
		$property_grid->RowIndex = '$rowindex$';
		$property_grid->loadRowValues();

		// Set row properties
		$property->resetAttributes();
		$property->RowAttrs->merge(["data-rowindex" => $property_grid->RowIndex, "id" => "r0_property", "data-rowtype" => ROWTYPE_ADD]);
		$property->RowAttrs->appendClass("ew-template");
		$property->RowType = ROWTYPE_ADD;

		// Render row
		$property_grid->renderRow();

		// Render list options
		$property_grid->renderListOptions();
		$property_grid->StartRowCount = 0;
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_grid->ListOptions->render("body", "left", $property_grid->RowIndex);
?>
	<?php if ($property_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_id" class="form-group property_id"></span>
<?php } else { ?>
<span id="el$rowindex$_property_id" class="form-group property_id">
<span<?php echo $property_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_id" name="x<?php echo $property_grid->RowIndex ?>_id" id="x<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_id" name="o<?php echo $property_grid->RowIndex ?>_id" id="o<?php echo $property_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($property_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ClientId->Visible) { // ClientId ?>
		<td data-name="ClientId">
<?php if (!$property->isConfirm()) { ?>
<?php if ($property_grid->ClientId->getSessionValue() != "") { ?>
<span id="el$rowindex$_property_ClientId" class="form-group property_ClientId">
<span<?php echo $property_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_grid->RowIndex ?>_ClientId" name="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_property_ClientId" class="form-group property_ClientId">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_ClientId"><?php echo EmptyValue(strval($property_grid->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientId->ReadOnly || $property_grid->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->ClientId->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientId") ?>
<input type="hidden" data-table="property" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientId->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientId" id="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo $property_grid->ClientId->CurrentValue ?>"<?php echo $property_grid->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_property_ClientId" class="form-group property_ClientId">
<span<?php echo $property_grid->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ClientId" name="x<?php echo $property_grid->RowIndex ?>_ClientId" id="x<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ClientId" name="o<?php echo $property_grid->RowIndex ?>_ClientId" id="o<?php echo $property_grid->RowIndex ?>_ClientId" value="<?php echo HtmlEncode($property_grid->ClientId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ChargeGroup" class="form-group property_ChargeGroup">
<?php
$onchange = $property_grid->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="sv_x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo RemoveHtml($property_grid->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_grid->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ChargeGroup',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ChargeGroup->ReadOnly || $property_grid->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ChargeGroup","forceSelect":true});
});
</script>
<?php echo $property_grid->ChargeGroup->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ChargeGroup") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_ChargeGroup" class="form-group property_ChargeGroup">
<span<?php echo $property_grid->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="x<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="o<?php echo $property_grid->RowIndex ?>_ChargeGroup" id="o<?php echo $property_grid->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($property_grid->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<td data-name="ChargeGropuDes">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ChargeGropuDes" class="form-group property_ChargeGropuDes">
<?php $property_grid->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes"><?php echo EmptyValue(strval($property_grid->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ChargeGropuDes->ReadOnly || $property_grid->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->ChargeGropuDes->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ChargeGropuDes") ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo $property_grid->ChargeGropuDes->CurrentValue ?>"<?php echo $property_grid->ChargeGropuDes->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_ChargeGropuDes" class="form-group property_ChargeGropuDes">
<span<?php echo $property_grid->ChargeGropuDes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ChargeGropuDes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="x<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" id="o<?php echo $property_grid->RowIndex ?>_ChargeGropuDes" value="<?php echo HtmlEncode($property_grid->ChargeGropuDes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ChargeableFee->Visible) { // ChargeableFee ?>
		<td data-name="ChargeableFee">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ChargeableFee" class="form-group property_ChargeableFee">
<input type="text" data-table="property" data-field="x_ChargeableFee" name="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_grid->ChargeableFee->EditValue ?>"<?php echo $property_grid->ChargeableFee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_ChargeableFee" class="form-group property_ChargeableFee">
<span<?php echo $property_grid->ChargeableFee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ChargeableFee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="x<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="o<?php echo $property_grid->RowIndex ?>_ChargeableFee" id="o<?php echo $property_grid->RowIndex ?>_ChargeableFee" value="<?php echo HtmlEncode($property_grid->ChargeableFee->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_BalanceBF" class="form-group property_BalanceBF">
<input type="text" data-table="property" data-field="x_BalanceBF" name="x<?php echo $property_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_grid->RowIndex ?>_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_grid->BalanceBF->EditValue ?>"<?php echo $property_grid->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_BalanceBF" class="form-group property_BalanceBF">
<span<?php echo $property_grid->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="x<?php echo $property_grid->RowIndex ?>_BalanceBF" id="x<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="o<?php echo $property_grid->RowIndex ?>_BalanceBF" id="o<?php echo $property_grid->RowIndex ?>_BalanceBF" value="<?php echo HtmlEncode($property_grid->BalanceBF->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->AmountPayable->Visible) { // AmountPayable ?>
		<td data-name="AmountPayable">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_AmountPayable" class="form-group property_AmountPayable">
<input type="text" data-table="property" data-field="x_AmountPayable" name="x<?php echo $property_grid->RowIndex ?>_AmountPayable" id="x<?php echo $property_grid->RowIndex ?>_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_grid->AmountPayable->EditValue ?>"<?php echo $property_grid->AmountPayable->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_AmountPayable" class="form-group property_AmountPayable">
<span<?php echo $property_grid->AmountPayable->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->AmountPayable->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="x<?php echo $property_grid->RowIndex ?>_AmountPayable" id="x<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="o<?php echo $property_grid->RowIndex ?>_AmountPayable" id="o<?php echo $property_grid->RowIndex ?>_AmountPayable" value="<?php echo HtmlEncode($property_grid->AmountPayable->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Property->Visible) { // Property ?>
		<td data-name="Property">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Property" class="form-group property_Property">
<input type="text" data-table="property" data-field="x_Property" name="x<?php echo $property_grid->RowIndex ?>_Property" id="x<?php echo $property_grid->RowIndex ?>_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_grid->Property->getPlaceHolder()) ?>" value="<?php echo $property_grid->Property->EditValue ?>"<?php echo $property_grid->Property->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Property" class="form-group property_Property">
<span<?php echo $property_grid->Property->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Property->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Property" name="x<?php echo $property_grid->RowIndex ?>_Property" id="x<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Property" name="o<?php echo $property_grid->RowIndex ?>_Property" id="o<?php echo $property_grid->RowIndex ?>_Property" value="<?php echo HtmlEncode($property_grid->Property->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyId->Visible) { // PropertyId ?>
		<td data-name="PropertyId">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyId" class="form-group property_PropertyId">
<input type="text" data-table="property" data-field="x_PropertyId" name="x<?php echo $property_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_grid->RowIndex ?>_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyId->EditValue ?>"<?php echo $property_grid->PropertyId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyId" class="form-group property_PropertyId">
<span<?php echo $property_grid->PropertyId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="x<?php echo $property_grid->RowIndex ?>_PropertyId" id="x<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="o<?php echo $property_grid->RowIndex ?>_PropertyId" id="o<?php echo $property_grid->RowIndex ?>_PropertyId" value="<?php echo HtmlEncode($property_grid->PropertyId->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyUse" class="form-group property_PropertyUse">
<input type="text" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyUse->EditValue ?>"<?php echo $property_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyUse" class="form-group property_PropertyUse">
<span<?php echo $property_grid->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="o<?php echo $property_grid->RowIndex ?>_PropertyUse" id="o<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Location" class="form-group property_Location">
<input type="text" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->Location->getPlaceHolder()) ?>" value="<?php echo $property_grid->Location->EditValue ?>"<?php echo $property_grid->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Location" class="form-group property_Location">
<span<?php echo $property_grid->Location->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Location->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Location" name="o<?php echo $property_grid->RowIndex ?>_Location" id="o<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_AmountPaid" class="form-group property_AmountPaid">
<input type="text" data-table="property" data-field="x_AmountPaid" name="x<?php echo $property_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_grid->RowIndex ?>_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_grid->AmountPaid->EditValue ?>"<?php echo $property_grid->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_AmountPaid" class="form-group property_AmountPaid">
<span<?php echo $property_grid->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="x<?php echo $property_grid->RowIndex ?>_AmountPaid" id="x<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="o<?php echo $property_grid->RowIndex ?>_AmountPaid" id="o<?php echo $property_grid->RowIndex ?>_AmountPaid" value="<?php echo HtmlEncode($property_grid->AmountPaid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->CurrentBalance->Visible) { // CurrentBalance ?>
		<td data-name="CurrentBalance">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_CurrentBalance" class="form-group property_CurrentBalance">
<input type="text" data-table="property" data-field="x_CurrentBalance" name="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_grid->CurrentBalance->EditValue ?>"<?php echo $property_grid->CurrentBalance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_CurrentBalance" class="form-group property_CurrentBalance">
<span<?php echo $property_grid->CurrentBalance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->CurrentBalance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="x<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="o<?php echo $property_grid->RowIndex ?>_CurrentBalance" id="o<?php echo $property_grid->RowIndex ?>_CurrentBalance" value="<?php echo HtmlEncode($property_grid->CurrentBalance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->DataRegistered->Visible) { // DataRegistered ?>
		<td data-name="DataRegistered">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_DataRegistered" class="form-group property_DataRegistered">
<input type="text" data-table="property" data-field="x_DataRegistered" name="x<?php echo $property_grid->RowIndex ?>_DataRegistered" id="x<?php echo $property_grid->RowIndex ?>_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_grid->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_grid->DataRegistered->EditValue ?>"<?php echo $property_grid->DataRegistered->editAttributes() ?>>
<?php if (!$property_grid->DataRegistered->ReadOnly && !$property_grid->DataRegistered->Disabled && !isset($property_grid->DataRegistered->EditAttrs["readonly"]) && !isset($property_grid->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpropertygrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpropertygrid", "x<?php echo $property_grid->RowIndex ?>_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_DataRegistered" class="form-group property_DataRegistered">
<span<?php echo $property_grid->DataRegistered->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->DataRegistered->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="x<?php echo $property_grid->RowIndex ?>_DataRegistered" id="x<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="o<?php echo $property_grid->RowIndex ?>_DataRegistered" id="o<?php echo $property_grid->RowIndex ?>_DataRegistered" value="<?php echo HtmlEncode($property_grid->DataRegistered->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Status->Visible) { // Status ?>
		<td data-name="Status">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Status" class="form-group property_Status">
<div id="tp_x<?php echo $property_grid->RowIndex ?>_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="property" data-field="x_Status" data-value-separator="<?php echo $property_grid->Status->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_Status" id="x<?php echo $property_grid->RowIndex ?>_Status" value="{value}"<?php echo $property_grid->Status->editAttributes() ?>></div>
<div id="dsl_x<?php echo $property_grid->RowIndex ?>_Status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $property_grid->Status->radioButtonListHtml(FALSE, "x{$property_grid->RowIndex}_Status") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Status" class="form-group property_Status">
<span<?php echo $property_grid->Status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Status" name="x<?php echo $property_grid->RowIndex ?>_Status" id="x<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Status" name="o<?php echo $property_grid->RowIndex ?>_Status" id="o<?php echo $property_grid->RowIndex ?>_Status" value="<?php echo HtmlEncode($property_grid->Status->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_grid->ListOptions->render("body", "right", $property_grid->RowIndex);
?>
<script>
loadjs.ready(["fpropertygrid", "load"], function() {
	fpropertygrid.updateLists(<?php echo $property_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($property->CurrentMode == "add" || $property->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $property_grid->FormKeyCountName ?>" id="<?php echo $property_grid->FormKeyCountName ?>" value="<?php echo $property_grid->KeyCount ?>">
<?php echo $property_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $property_grid->FormKeyCountName ?>" id="<?php echo $property_grid->FormKeyCountName ?>" value="<?php echo $property_grid->KeyCount ?>">
<?php echo $property_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpropertygrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_grid->Recordset)
	$property_grid->Recordset->Close();
?>
<?php if ($property_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $property_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_grid->TotalRecords == 0 && !$property->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$property_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$property_grid->terminate();
?>