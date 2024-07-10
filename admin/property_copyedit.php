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
$property_copy_edit = new property_copy_edit();

// Run the page
$property_copy_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_copy_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_copyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_copyedit = currentForm = new ew.Form("fproperty_copyedit", "edit");

	// Validate form
	fproperty_copyedit.validate = function() {
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
			<?php if ($property_copy_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->id->caption(), $property_copy_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_edit->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->ClientId->caption(), $property_copy_edit->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->ClientId->errorMessage()) ?>");
			<?php if ($property_copy_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->ChargeGroup->caption(), $property_copy_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->ChargeGroup->errorMessage()) ?>");
			<?php if ($property_copy_edit->ChargeGropuDes->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGropuDes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->ChargeGropuDes->caption(), $property_copy_edit->ChargeGropuDes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_edit->Property->Required) { ?>
				elm = this.getElements("x" + infix + "_Property");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->Property->caption(), $property_copy_edit->Property->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->PropertyUse->caption(), $property_copy_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_edit->ChargeableFee->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->ChargeableFee->caption(), $property_copy_edit->ChargeableFee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->ChargeableFee->errorMessage()) ?>");
			<?php if ($property_copy_edit->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->BalanceBF->caption(), $property_copy_edit->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->BalanceBF->errorMessage()) ?>");
			<?php if ($property_copy_edit->AmountPayable->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->AmountPayable->caption(), $property_copy_edit->AmountPayable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->AmountPayable->errorMessage()) ?>");
			<?php if ($property_copy_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->AmountPaid->caption(), $property_copy_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($property_copy_edit->CurrentBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->CurrentBalance->caption(), $property_copy_edit->CurrentBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->CurrentBalance->errorMessage()) ?>");
			<?php if ($property_copy_edit->DataRegistered->Required) { ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->DataRegistered->caption(), $property_copy_edit->DataRegistered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_edit->DataRegistered->errorMessage()) ?>");
			<?php if ($property_copy_edit->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_edit->Description->caption(), $property_copy_edit->Description->RequiredErrorMessage)) ?>");
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
	fproperty_copyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_copyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproperty_copyedit.lists["x_ClientId"] = <?php echo $property_copy_edit->ClientId->Lookup->toClientList($property_copy_edit) ?>;
	fproperty_copyedit.lists["x_ClientId"].options = <?php echo JsonEncode($property_copy_edit->ClientId->lookupOptions()) ?>;
	fproperty_copyedit.autoSuggests["x_ClientId"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fproperty_copyedit.lists["x_ChargeGroup"] = <?php echo $property_copy_edit->ChargeGroup->Lookup->toClientList($property_copy_edit) ?>;
	fproperty_copyedit.lists["x_ChargeGroup"].options = <?php echo JsonEncode($property_copy_edit->ChargeGroup->lookupOptions()) ?>;
	fproperty_copyedit.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fproperty_copyedit.lists["x_ChargeGropuDes"] = <?php echo $property_copy_edit->ChargeGropuDes->Lookup->toClientList($property_copy_edit) ?>;
	fproperty_copyedit.lists["x_ChargeGropuDes"].options = <?php echo JsonEncode($property_copy_edit->ChargeGropuDes->lookupOptions()) ?>;
	loadjs.done("fproperty_copyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_copy_edit->showPageHeader(); ?>
<?php
$property_copy_edit->showMessage();
?>
<?php if (!$property_copy_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_copy_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproperty_copyedit" id="fproperty_copyedit" class="<?php echo $property_copy_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_copy">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_copy_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_copy_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_property_copy_id" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->id->caption() ?><?php echo $property_copy_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->id->cellAttributes() ?>>
<span id="el_property_copy_id">
<span<?php echo $property_copy_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_copy_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_copy" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($property_copy_edit->id->CurrentValue) ?>">
<?php echo $property_copy_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_property_copy_ClientId" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->ClientId->caption() ?><?php echo $property_copy_edit->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->ClientId->cellAttributes() ?>>
<span id="el_property_copy_ClientId">
<?php
$onchange = $property_copy_edit->ClientId->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_copy_edit->ClientId->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientId">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientId" id="sv_x_ClientId" value="<?php echo RemoveHtml($property_copy_edit->ClientId->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_copy_edit->ClientId->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_copy_edit->ClientId->getPlaceHolder()) ?>"<?php echo $property_copy_edit->ClientId->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_copy_edit->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_copy_edit->ClientId->ReadOnly || $property_copy_edit->ClientId->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_copy" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_copy_edit->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo HtmlEncode($property_copy_edit->ClientId->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_copyedit"], function() {
	fproperty_copyedit.createAutoSuggest({"id":"x_ClientId","forceSelect":true});
});
</script>
<?php echo $property_copy_edit->ClientId->Lookup->getParamTag($property_copy_edit, "p_x_ClientId") ?>
</span>
<?php echo $property_copy_edit->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_property_copy_ChargeGroup" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->ChargeGroup->caption() ?><?php echo $property_copy_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->ChargeGroup->cellAttributes() ?>>
<span id="el_property_copy_ChargeGroup">
<?php
$onchange = $property_copy_edit->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_copy_edit->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeGroup" id="sv_x_ChargeGroup" value="<?php echo RemoveHtml($property_copy_edit->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_copy_edit->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_copy_edit->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_copy_edit->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_copy_edit->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_copy_edit->ChargeGroup->ReadOnly || $property_copy_edit->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_copy" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_copy_edit->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($property_copy_edit->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_copyedit"], function() {
	fproperty_copyedit.createAutoSuggest({"id":"x_ChargeGroup","forceSelect":false});
});
</script>
<?php echo $property_copy_edit->ChargeGroup->Lookup->getParamTag($property_copy_edit, "p_x_ChargeGroup") ?>
</span>
<?php echo $property_copy_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<div id="r_ChargeGropuDes" class="form-group row">
		<label id="elh_property_copy_ChargeGropuDes" for="x_ChargeGropuDes" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->ChargeGropuDes->caption() ?><?php echo $property_copy_edit->ChargeGropuDes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->ChargeGropuDes->cellAttributes() ?>>
<span id="el_property_copy_ChargeGropuDes">
<?php $property_copy_edit->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGropuDes"><?php echo EmptyValue(strval($property_copy_edit->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_copy_edit->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_copy_edit->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_copy_edit->ChargeGropuDes->ReadOnly || $property_copy_edit->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_copy_edit->ChargeGropuDes->Lookup->getParamTag($property_copy_edit, "p_x_ChargeGropuDes") ?>
<input type="hidden" data-table="property_copy" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_copy_edit->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x_ChargeGropuDes" id="x_ChargeGropuDes" value="<?php echo $property_copy_edit->ChargeGropuDes->CurrentValue ?>"<?php echo $property_copy_edit->ChargeGropuDes->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->ChargeGropuDes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->Property->Visible) { // Property ?>
	<div id="r_Property" class="form-group row">
		<label id="elh_property_copy_Property" for="x_Property" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->Property->caption() ?><?php echo $property_copy_edit->Property->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->Property->cellAttributes() ?>>
<span id="el_property_copy_Property">
<input type="text" data-table="property_copy" data-field="x_Property" name="x_Property" id="x_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_copy_edit->Property->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->Property->EditValue ?>"<?php echo $property_copy_edit->Property->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->Property->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_copy_PropertyUse" for="x_PropertyUse" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->PropertyUse->caption() ?><?php echo $property_copy_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->PropertyUse->cellAttributes() ?>>
<span id="el_property_copy_PropertyUse">
<input type="text" data-table="property_copy" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_copy_edit->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->PropertyUse->EditValue ?>"<?php echo $property_copy_edit->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->ChargeableFee->Visible) { // ChargeableFee ?>
	<div id="r_ChargeableFee" class="form-group row">
		<label id="elh_property_copy_ChargeableFee" for="x_ChargeableFee" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->ChargeableFee->caption() ?><?php echo $property_copy_edit->ChargeableFee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->ChargeableFee->cellAttributes() ?>>
<span id="el_property_copy_ChargeableFee">
<input type="text" data-table="property_copy" data-field="x_ChargeableFee" name="x_ChargeableFee" id="x_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_edit->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->ChargeableFee->EditValue ?>"<?php echo $property_copy_edit->ChargeableFee->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->ChargeableFee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_property_copy_BalanceBF" for="x_BalanceBF" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->BalanceBF->caption() ?><?php echo $property_copy_edit->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->BalanceBF->cellAttributes() ?>>
<span id="el_property_copy_BalanceBF">
<input type="text" data-table="property_copy" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_edit->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->BalanceBF->EditValue ?>"<?php echo $property_copy_edit->BalanceBF->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->AmountPayable->Visible) { // AmountPayable ?>
	<div id="r_AmountPayable" class="form-group row">
		<label id="elh_property_copy_AmountPayable" for="x_AmountPayable" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->AmountPayable->caption() ?><?php echo $property_copy_edit->AmountPayable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->AmountPayable->cellAttributes() ?>>
<span id="el_property_copy_AmountPayable">
<input type="text" data-table="property_copy" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_edit->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->AmountPayable->EditValue ?>"<?php echo $property_copy_edit->AmountPayable->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->AmountPayable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_property_copy_AmountPaid" for="x_AmountPaid" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->AmountPaid->caption() ?><?php echo $property_copy_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->AmountPaid->cellAttributes() ?>>
<span id="el_property_copy_AmountPaid">
<input type="text" data-table="property_copy" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->AmountPaid->EditValue ?>"<?php echo $property_copy_edit->AmountPaid->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->CurrentBalance->Visible) { // CurrentBalance ?>
	<div id="r_CurrentBalance" class="form-group row">
		<label id="elh_property_copy_CurrentBalance" for="x_CurrentBalance" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->CurrentBalance->caption() ?><?php echo $property_copy_edit->CurrentBalance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->CurrentBalance->cellAttributes() ?>>
<span id="el_property_copy_CurrentBalance">
<input type="text" data-table="property_copy" data-field="x_CurrentBalance" name="x_CurrentBalance" id="x_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_edit->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->CurrentBalance->EditValue ?>"<?php echo $property_copy_edit->CurrentBalance->editAttributes() ?>>
</span>
<?php echo $property_copy_edit->CurrentBalance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->DataRegistered->Visible) { // DataRegistered ?>
	<div id="r_DataRegistered" class="form-group row">
		<label id="elh_property_copy_DataRegistered" for="x_DataRegistered" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->DataRegistered->caption() ?><?php echo $property_copy_edit->DataRegistered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->DataRegistered->cellAttributes() ?>>
<span id="el_property_copy_DataRegistered">
<input type="text" data-table="property_copy" data-field="x_DataRegistered" name="x_DataRegistered" id="x_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_edit->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_copy_edit->DataRegistered->EditValue ?>"<?php echo $property_copy_edit->DataRegistered->editAttributes() ?>>
<?php if (!$property_copy_edit->DataRegistered->ReadOnly && !$property_copy_edit->DataRegistered->Disabled && !isset($property_copy_edit->DataRegistered->EditAttrs["readonly"]) && !isset($property_copy_edit->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_copyedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_copyedit", "x_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $property_copy_edit->DataRegistered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_edit->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_property_copy_Description" for="x_Description" class="<?php echo $property_copy_edit->LeftColumnClass ?>"><?php echo $property_copy_edit->Description->caption() ?><?php echo $property_copy_edit->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_edit->RightColumnClass ?>"><div <?php echo $property_copy_edit->Description->cellAttributes() ?>>
<span id="el_property_copy_Description">
<textarea data-table="property_copy" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($property_copy_edit->Description->getPlaceHolder()) ?>"<?php echo $property_copy_edit->Description->editAttributes() ?>><?php echo $property_copy_edit->Description->EditValue ?></textarea>
</span>
<?php echo $property_copy_edit->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_copy_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_copy_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_copy_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_copy_edit->IsModal) { ?>
<?php echo $property_copy_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_copy_edit->showPageFooter();
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
$property_copy_edit->terminate();
?>