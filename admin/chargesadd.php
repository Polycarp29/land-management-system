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
$charges_add = new charges_add();

// Run the page
$charges_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fchargesadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fchargesadd = currentForm = new ew.Form("fchargesadd", "add");

	// Validate form
	fchargesadd.validate = function() {
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
			<?php if ($charges_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->ChargeGroup->caption(), $charges_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->ChargeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->ChargeDesc->caption(), $charges_add->ChargeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->PropertyUse->caption(), $charges_add->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->Fee->Required) { ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->Fee->caption(), $charges_add->Fee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_add->Fee->errorMessage()) ?>");
			<?php if ($charges_add->Factor->Required) { ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->Factor->caption(), $charges_add->Factor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_add->Factor->errorMessage()) ?>");
			<?php if ($charges_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->UnitOfMeasure->caption(), $charges_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_add->PeriodType->caption(), $charges_add->PeriodType->RequiredErrorMessage)) ?>");
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
	fchargesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fchargesadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fchargesadd.lists["x_ChargeGroup"] = <?php echo $charges_add->ChargeGroup->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_ChargeGroup"].options = <?php echo JsonEncode($charges_add->ChargeGroup->lookupOptions()) ?>;
	fchargesadd.lists["x_PropertyUse"] = <?php echo $charges_add->PropertyUse->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_PropertyUse"].options = <?php echo JsonEncode($charges_add->PropertyUse->lookupOptions()) ?>;
	fchargesadd.lists["x_PeriodType"] = <?php echo $charges_add->PeriodType->Lookup->toClientList($charges_add) ?>;
	fchargesadd.lists["x_PeriodType"].options = <?php echo JsonEncode($charges_add->PeriodType->options(FALSE, TRUE)) ?>;
	loadjs.done("fchargesadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charges_add->showPageHeader(); ?>
<?php
$charges_add->showMessage();
?>
<form name="fchargesadd" id="fchargesadd" class="<?php echo $charges_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<?php if ($charges->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$charges_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($charges_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_charges_ChargeGroup" for="x_ChargeGroup" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->ChargeGroup->caption() ?><?php echo $charges_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->ChargeGroup->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_ChargeGroup">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGroup"><?php echo EmptyValue(strval($charges_add->ChargeGroup->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->ChargeGroup->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->ChargeGroup->ReadOnly || $charges_add->ChargeGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->ChargeGroup->Lookup->getParamTag($charges_add, "p_x_ChargeGroup") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_add->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo $charges_add->ChargeGroup->CurrentValue ?>"<?php echo $charges_add->ChargeGroup->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_ChargeGroup">
<span<?php echo $charges_add->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($charges_add->ChargeGroup->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->ChargeDesc->Visible) { // ChargeDesc ?>
	<div id="r_ChargeDesc" class="form-group row">
		<label id="elh_charges_ChargeDesc" for="x_ChargeDesc" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->ChargeDesc->caption() ?><?php echo $charges_add->ChargeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->ChargeDesc->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_ChargeDesc">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charges_add->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_add->ChargeDesc->EditValue ?>"<?php echo $charges_add->ChargeDesc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_ChargeDesc">
<span<?php echo $charges_add->ChargeDesc->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->ChargeDesc->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" value="<?php echo HtmlEncode($charges_add->ChargeDesc->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->ChargeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_charges_PropertyUse" for="x_PropertyUse" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->PropertyUse->caption() ?><?php echo $charges_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->PropertyUse->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_PropertyUse">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyUse"><?php echo EmptyValue(strval($charges_add->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_add->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_add->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_add->PropertyUse->ReadOnly || $charges_add->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyUse',m:0,n:5});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_add->PropertyUse->Lookup->getParamTag($charges_add, "p_x_PropertyUse") ?>
<input type="hidden" data-table="charges" data-field="x_PropertyUse" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_add->PropertyUse->displayValueSeparatorAttribute() ?>" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo $charges_add->PropertyUse->CurrentValue ?>"<?php echo $charges_add->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_PropertyUse">
<span<?php echo $charges_add->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo HtmlEncode($charges_add->PropertyUse->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->Fee->Visible) { // Fee ?>
	<div id="r_Fee" class="form-group row">
		<label id="elh_charges_Fee" for="x_Fee" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->Fee->caption() ?><?php echo $charges_add->Fee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->Fee->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_Fee">
<input type="text" data-table="charges" data-field="x_Fee" name="x_Fee" id="x_Fee" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($charges_add->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_add->Fee->EditValue ?>"<?php echo $charges_add->Fee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_Fee">
<span<?php echo $charges_add->Fee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->Fee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_Fee" name="x_Fee" id="x_Fee" value="<?php echo HtmlEncode($charges_add->Fee->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->Fee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->Factor->Visible) { // Factor ?>
	<div id="r_Factor" class="form-group row">
		<label id="elh_charges_Factor" for="x_Factor" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->Factor->caption() ?><?php echo $charges_add->Factor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->Factor->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_Factor">
<input type="text" data-table="charges" data-field="x_Factor" name="x_Factor" id="x_Factor" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($charges_add->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_add->Factor->EditValue ?>"<?php echo $charges_add->Factor->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_Factor">
<span<?php echo $charges_add->Factor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->Factor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_Factor" name="x_Factor" id="x_Factor" value="<?php echo HtmlEncode($charges_add->Factor->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->Factor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_charges_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->UnitOfMeasure->caption() ?><?php echo $charges_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->UnitOfMeasure->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_UnitOfMeasure">
<input type="text" data-table="charges" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($charges_add->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $charges_add->UnitOfMeasure->EditValue ?>"<?php echo $charges_add->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charges_UnitOfMeasure">
<span<?php echo $charges_add->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" value="<?php echo HtmlEncode($charges_add->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charges_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_charges_PeriodType" for="x_PeriodType" class="<?php echo $charges_add->LeftColumnClass ?>"><?php echo $charges_add->PeriodType->caption() ?><?php echo $charges_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charges_add->RightColumnClass ?>"><div <?php echo $charges_add->PeriodType->cellAttributes() ?>>
<?php if (!$charges->isConfirm()) { ?>
<span id="el_charges_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_add->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $charges_add->PeriodType->editAttributes() ?>>
			<?php echo $charges_add->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_charges_PeriodType">
<span<?php echo $charges_add->PeriodType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_add->PeriodType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_PeriodType" name="x_PeriodType" id="x_PeriodType" value="<?php echo HtmlEncode($charges_add->PeriodType->FormValue) ?>">
<?php } ?>
<?php echo $charges_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charges_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charges_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$charges->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charges_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$charges_add->showPageFooter();
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
$charges_add->terminate();
?>