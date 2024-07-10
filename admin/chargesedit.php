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
$charges_edit = new charges_edit();

// Run the page
$charges_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fchargesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fchargesedit = currentForm = new ew.Form("fchargesedit", "edit");

	// Validate form
	fchargesedit.validate = function() {
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
			<?php if ($charges_edit->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeCode->caption(), $charges_edit->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeGroup->caption(), $charges_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->ChargeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->ChargeDesc->caption(), $charges_edit->ChargeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->PropertyUse->caption(), $charges_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->Fee->Required) { ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->Fee->caption(), $charges_edit->Fee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_edit->Fee->errorMessage()) ?>");
			<?php if ($charges_edit->Factor->Required) { ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->Factor->caption(), $charges_edit->Factor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_edit->Factor->errorMessage()) ?>");
			<?php if ($charges_edit->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->UnitOfMeasure->caption(), $charges_edit->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_edit->PeriodType->caption(), $charges_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fchargesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fchargesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fchargesedit.lists["x_ChargeGroup"] = <?php echo $charges_edit->ChargeGroup->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_ChargeGroup"].options = <?php echo JsonEncode($charges_edit->ChargeGroup->lookupOptions()) ?>;
	fchargesedit.lists["x_PropertyUse"] = <?php echo $charges_edit->PropertyUse->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_PropertyUse"].options = <?php echo JsonEncode($charges_edit->PropertyUse->lookupOptions()) ?>;
	fchargesedit.lists["x_PeriodType"] = <?php echo $charges_edit->PeriodType->Lookup->toClientList($charges_edit) ?>;
	fchargesedit.lists["x_PeriodType"].options = <?php echo JsonEncode($charges_edit->PeriodType->options(FALSE, TRUE)) ?>;
	loadjs.done("fchargesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charges_edit->showPageHeader(); ?>
<?php
$charges_edit->showMessage();
?>
<?php if (!$charges_edit->IsModal) { ?>
<?php if (!$charges->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fchargesedit" id="fchargesedit" class="<?php echo $charges_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<?php if ($charges->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$charges_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($charges_edit->ChargeCode->Visible) { // ChargeCode ?>
	<div id="r_ChargeCode" class="form-group row">
		<label id="elh_charges_ChargeCode" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeCode->caption() ?><?php echo $charges_edit->ChargeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeCode->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_ChargeCode">
<span<?php echo $charges_edit->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->ChargeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($charges_edit->ChargeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_charges_ChargeCode">
<span<?php echo $charges_edit->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->ChargeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" value="<?php echo HtmlEncode($charges_edit->ChargeCode->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->ChargeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_charges_ChargeGroup" for="x_ChargeGroup" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeGroup->caption() ?><?php echo $charges_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeGroup->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_ChargeGroup">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGroup"><?php echo EmptyValue(strval($charges_edit->ChargeGroup->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->ChargeGroup->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->ChargeGroup->ReadOnly || $charges_edit->ChargeGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->ChargeGroup->Lookup->getParamTag($charges_edit, "p_x_ChargeGroup") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_edit->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo $charges_edit->ChargeGroup->CurrentValue ?>"<?php echo $charges_edit->ChargeGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_ChargeGroup">
<span<?php echo $charges_edit->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($charges_edit->ChargeGroup->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->ChargeDesc->Visible) { // ChargeDesc ?>
	<div id="r_ChargeDesc" class="form-group row">
		<label id="elh_charges_ChargeDesc" for="x_ChargeDesc" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->ChargeDesc->caption() ?><?php echo $charges_edit->ChargeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->ChargeDesc->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_ChargeDesc">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charges_edit->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_edit->ChargeDesc->EditValue ?>"<?php echo $charges_edit->ChargeDesc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_ChargeDesc">
<span<?php echo $charges_edit->ChargeDesc->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->ChargeDesc->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" value="<?php echo HtmlEncode($charges_edit->ChargeDesc->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->ChargeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_charges_PropertyUse" for="x_PropertyUse" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->PropertyUse->caption() ?><?php echo $charges_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->PropertyUse->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_PropertyUse">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($charges_edit->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_edit->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_edit->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_edit->PropertyUse->ReadOnly || $charges_edit->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse',m:0,n:5});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_edit->PropertyUse->Lookup->getParamTag($charges_edit, "p_x_PropertyUse") ?>
<input type="hidden" data-table="charges" data-field="x_PropertyUse" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_edit->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo $charges_edit->PropertyUse->CurrentValue ?>"<?php echo $charges_edit->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_PropertyUse">
<span<?php echo $charges_edit->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo HtmlEncode($charges_edit->PropertyUse->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->Fee->Visible) { // Fee ?>
	<div id="r_Fee" class="form-group row">
		<label id="elh_charges_Fee" for="x_Fee" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->Fee->caption() ?><?php echo $charges_edit->Fee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->Fee->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_Fee">
<input type="text" data-table="charges" data-field="x_Fee" name="x_Fee" id="x_Fee" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($charges_edit->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_edit->Fee->EditValue ?>"<?php echo $charges_edit->Fee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_Fee">
<span<?php echo $charges_edit->Fee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->Fee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_Fee" name="x_Fee" id="x_Fee" value="<?php echo HtmlEncode($charges_edit->Fee->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->Fee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->Factor->Visible) { // Factor ?>
	<div id="r_Factor" class="form-group row">
		<label id="elh_charges_Factor" for="x_Factor" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->Factor->caption() ?><?php echo $charges_edit->Factor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->Factor->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_Factor">
<input type="text" data-table="charges" data-field="x_Factor" name="x_Factor" id="x_Factor" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($charges_edit->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_edit->Factor->EditValue ?>"<?php echo $charges_edit->Factor->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_Factor">
<span<?php echo $charges_edit->Factor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->Factor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_Factor" name="x_Factor" id="x_Factor" value="<?php echo HtmlEncode($charges_edit->Factor->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->Factor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_charges_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->UnitOfMeasure->caption() ?><?php echo $charges_edit->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->UnitOfMeasure->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_UnitOfMeasure">
<input type="text" data-table="charges" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($charges_edit->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $charges_edit->UnitOfMeasure->EditValue ?>"<?php echo $charges_edit->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_UnitOfMeasure">
<span<?php echo $charges_edit->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" value="<?php echo HtmlEncode($charges_edit->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_charges_PeriodType" for="x_PeriodType" class="<?php echo $charges_edit->LeftColumnClass ?>"><?php echo $charges_edit->PeriodType->caption() ?><?php echo $charges_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_edit->RightColumnClass ?>"><div <?php echo $charges_edit->PeriodType->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_edit->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $charges_edit->PeriodType->editAttributes() ?>>
			<?php echo $charges_edit->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_charges_PeriodType">
<span<?php echo $charges_edit->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_edit->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" value="<?php echo HtmlEncode($charges_edit->PeriodType->FormValue) ?>">
<?php } ?>
<?php echo $charges_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charges_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charges_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$charges->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charges_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$charges_edit->IsModal) { ?>
<?php if (!$charges->isConfirm()) { // Confirm page ?>
<?php echo $charges_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$charges_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$charges_edit->terminate();
?>