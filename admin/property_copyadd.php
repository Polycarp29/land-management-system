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
$property_copy_add = new property_copy_add();

// Run the page
$property_copy_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_copy_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_copyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproperty_copyadd = currentForm = new ew.Form("fproperty_copyadd", "add");

	// Validate form
	fproperty_copyadd.validate = function() {
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
			<?php if ($property_copy_add->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->ClientId->caption(), $property_copy_add->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->ClientId->errorMessage()) ?>");
			<?php if ($property_copy_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->ChargeGroup->caption(), $property_copy_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->ChargeGroup->errorMessage()) ?>");
			<?php if ($property_copy_add->ChargeGropuDes->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGropuDes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->ChargeGropuDes->caption(), $property_copy_add->ChargeGropuDes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_add->Property->Required) { ?>
				elm = this.getElements("x" + infix + "_Property");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->Property->caption(), $property_copy_add->Property->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->PropertyUse->caption(), $property_copy_add->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_copy_add->ChargeableFee->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->ChargeableFee->caption(), $property_copy_add->ChargeableFee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->ChargeableFee->errorMessage()) ?>");
			<?php if ($property_copy_add->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->BalanceBF->caption(), $property_copy_add->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->BalanceBF->errorMessage()) ?>");
			<?php if ($property_copy_add->AmountPayable->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->AmountPayable->caption(), $property_copy_add->AmountPayable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->AmountPayable->errorMessage()) ?>");
			<?php if ($property_copy_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->AmountPaid->caption(), $property_copy_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->AmountPaid->errorMessage()) ?>");
			<?php if ($property_copy_add->CurrentBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->CurrentBalance->caption(), $property_copy_add->CurrentBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->CurrentBalance->errorMessage()) ?>");
			<?php if ($property_copy_add->DataRegistered->Required) { ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->DataRegistered->caption(), $property_copy_add->DataRegistered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_copy_add->DataRegistered->errorMessage()) ?>");
			<?php if ($property_copy_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_copy_add->Description->caption(), $property_copy_add->Description->RequiredErrorMessage)) ?>");
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
	fproperty_copyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_copyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproperty_copyadd.lists["x_ClientId"] = <?php echo $property_copy_add->ClientId->Lookup->toClientList($property_copy_add) ?>;
	fproperty_copyadd.lists["x_ClientId"].options = <?php echo JsonEncode($property_copy_add->ClientId->lookupOptions()) ?>;
	fproperty_copyadd.autoSuggests["x_ClientId"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fproperty_copyadd.lists["x_ChargeGroup"] = <?php echo $property_copy_add->ChargeGroup->Lookup->toClientList($property_copy_add) ?>;
	fproperty_copyadd.lists["x_ChargeGroup"].options = <?php echo JsonEncode($property_copy_add->ChargeGroup->lookupOptions()) ?>;
	fproperty_copyadd.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fproperty_copyadd.lists["x_ChargeGropuDes"] = <?php echo $property_copy_add->ChargeGropuDes->Lookup->toClientList($property_copy_add) ?>;
	fproperty_copyadd.lists["x_ChargeGropuDes"].options = <?php echo JsonEncode($property_copy_add->ChargeGropuDes->lookupOptions()) ?>;
	loadjs.done("fproperty_copyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#x_BalanceBF").attr("disabled","disabled"),$("#x_ChargeableFee").attr("disabled","disabled"),$("#x_AmountPayable").attr("disabled","disabled"),$("#x_CurrentBalance").attr("disabled","disabled"),$("#x_AmountPaid").attr("disabled","disabled"),$("#x_ChargeableFee").on("focus input change",function(){var e=parseFloat(document.getElementById("x_ChargeableFee").value),a=parseFloat(document.getElementById("x_BalanceBF").value),t=document.getElementById("x_AmountPayable"),d=document.getElementById("x_CurrentBalance");t.value=+e+a,d.value=+e+a});
});
</script>
<?php $property_copy_add->showPageHeader(); ?>
<?php
$property_copy_add->showMessage();
?>
<form name="fproperty_copyadd" id="fproperty_copyadd" class="<?php echo $property_copy_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_copy">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_copy_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($property_copy_add->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_property_copy_ClientId" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->ClientId->caption() ?><?php echo $property_copy_add->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->ClientId->cellAttributes() ?>>
<span id="el_property_copy_ClientId">
<?php
$onchange = $property_copy_add->ClientId->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_copy_add->ClientId->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientId">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientId" id="sv_x_ClientId" value="<?php echo RemoveHtml($property_copy_add->ClientId->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_copy_add->ClientId->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_copy_add->ClientId->getPlaceHolder()) ?>"<?php echo $property_copy_add->ClientId->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_copy_add->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_copy_add->ClientId->ReadOnly || $property_copy_add->ClientId->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_copy" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_copy_add->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo HtmlEncode($property_copy_add->ClientId->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_copyadd"], function() {
	fproperty_copyadd.createAutoSuggest({"id":"x_ClientId","forceSelect":true});
});
</script>
<?php echo $property_copy_add->ClientId->Lookup->getParamTag($property_copy_add, "p_x_ClientId") ?>
</span>
<?php echo $property_copy_add->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_property_copy_ChargeGroup" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->ChargeGroup->caption() ?><?php echo $property_copy_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->ChargeGroup->cellAttributes() ?>>
<span id="el_property_copy_ChargeGroup">
<?php
$onchange = $property_copy_add->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_copy_add->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeGroup" id="sv_x_ChargeGroup" value="<?php echo RemoveHtml($property_copy_add->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_copy_add->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_copy_add->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_copy_add->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_copy_add->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_copy_add->ChargeGroup->ReadOnly || $property_copy_add->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_copy" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_copy_add->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($property_copy_add->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_copyadd"], function() {
	fproperty_copyadd.createAutoSuggest({"id":"x_ChargeGroup","forceSelect":false});
});
</script>
<?php echo $property_copy_add->ChargeGroup->Lookup->getParamTag($property_copy_add, "p_x_ChargeGroup") ?>
</span>
<?php echo $property_copy_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<div id="r_ChargeGropuDes" class="form-group row">
		<label id="elh_property_copy_ChargeGropuDes" for="x_ChargeGropuDes" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->ChargeGropuDes->caption() ?><?php echo $property_copy_add->ChargeGropuDes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->ChargeGropuDes->cellAttributes() ?>>
<span id="el_property_copy_ChargeGropuDes">
<?php $property_copy_add->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGropuDes"><?php echo EmptyValue(strval($property_copy_add->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_copy_add->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_copy_add->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_copy_add->ChargeGropuDes->ReadOnly || $property_copy_add->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_copy_add->ChargeGropuDes->Lookup->getParamTag($property_copy_add, "p_x_ChargeGropuDes") ?>
<input type="hidden" data-table="property_copy" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_copy_add->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x_ChargeGropuDes" id="x_ChargeGropuDes" value="<?php echo $property_copy_add->ChargeGropuDes->CurrentValue ?>"<?php echo $property_copy_add->ChargeGropuDes->editAttributes() ?>>
</span>
<?php echo $property_copy_add->ChargeGropuDes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->Property->Visible) { // Property ?>
	<div id="r_Property" class="form-group row">
		<label id="elh_property_copy_Property" for="x_Property" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->Property->caption() ?><?php echo $property_copy_add->Property->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->Property->cellAttributes() ?>>
<span id="el_property_copy_Property">
<input type="text" data-table="property_copy" data-field="x_Property" name="x_Property" id="x_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_copy_add->Property->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->Property->EditValue ?>"<?php echo $property_copy_add->Property->editAttributes() ?>>
</span>
<?php echo $property_copy_add->Property->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_copy_PropertyUse" for="x_PropertyUse" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->PropertyUse->caption() ?><?php echo $property_copy_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->PropertyUse->cellAttributes() ?>>
<span id="el_property_copy_PropertyUse">
<input type="text" data-table="property_copy" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_copy_add->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->PropertyUse->EditValue ?>"<?php echo $property_copy_add->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_copy_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->ChargeableFee->Visible) { // ChargeableFee ?>
	<div id="r_ChargeableFee" class="form-group row">
		<label id="elh_property_copy_ChargeableFee" for="x_ChargeableFee" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->ChargeableFee->caption() ?><?php echo $property_copy_add->ChargeableFee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->ChargeableFee->cellAttributes() ?>>
<span id="el_property_copy_ChargeableFee">
<input type="text" data-table="property_copy" data-field="x_ChargeableFee" name="x_ChargeableFee" id="x_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_add->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->ChargeableFee->EditValue ?>"<?php echo $property_copy_add->ChargeableFee->editAttributes() ?>>
</span>
<?php echo $property_copy_add->ChargeableFee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_property_copy_BalanceBF" for="x_BalanceBF" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->BalanceBF->caption() ?><?php echo $property_copy_add->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->BalanceBF->cellAttributes() ?>>
<span id="el_property_copy_BalanceBF">
<input type="text" data-table="property_copy" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_add->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->BalanceBF->EditValue ?>"<?php echo $property_copy_add->BalanceBF->editAttributes() ?>>
</span>
<?php echo $property_copy_add->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->AmountPayable->Visible) { // AmountPayable ?>
	<div id="r_AmountPayable" class="form-group row">
		<label id="elh_property_copy_AmountPayable" for="x_AmountPayable" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->AmountPayable->caption() ?><?php echo $property_copy_add->AmountPayable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->AmountPayable->cellAttributes() ?>>
<span id="el_property_copy_AmountPayable">
<input type="text" data-table="property_copy" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_add->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->AmountPayable->EditValue ?>"<?php echo $property_copy_add->AmountPayable->editAttributes() ?>>
</span>
<?php echo $property_copy_add->AmountPayable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_property_copy_AmountPaid" for="x_AmountPaid" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->AmountPaid->caption() ?><?php echo $property_copy_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->AmountPaid->cellAttributes() ?>>
<span id="el_property_copy_AmountPaid">
<input type="text" data-table="property_copy" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->AmountPaid->EditValue ?>"<?php echo $property_copy_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $property_copy_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->CurrentBalance->Visible) { // CurrentBalance ?>
	<div id="r_CurrentBalance" class="form-group row">
		<label id="elh_property_copy_CurrentBalance" for="x_CurrentBalance" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->CurrentBalance->caption() ?><?php echo $property_copy_add->CurrentBalance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->CurrentBalance->cellAttributes() ?>>
<span id="el_property_copy_CurrentBalance">
<input type="text" data-table="property_copy" data-field="x_CurrentBalance" name="x_CurrentBalance" id="x_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_add->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->CurrentBalance->EditValue ?>"<?php echo $property_copy_add->CurrentBalance->editAttributes() ?>>
</span>
<?php echo $property_copy_add->CurrentBalance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->DataRegistered->Visible) { // DataRegistered ?>
	<div id="r_DataRegistered" class="form-group row">
		<label id="elh_property_copy_DataRegistered" for="x_DataRegistered" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->DataRegistered->caption() ?><?php echo $property_copy_add->DataRegistered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->DataRegistered->cellAttributes() ?>>
<span id="el_property_copy_DataRegistered">
<input type="text" data-table="property_copy" data-field="x_DataRegistered" name="x_DataRegistered" id="x_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_copy_add->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_copy_add->DataRegistered->EditValue ?>"<?php echo $property_copy_add->DataRegistered->editAttributes() ?>>
<?php if (!$property_copy_add->DataRegistered->ReadOnly && !$property_copy_add->DataRegistered->Disabled && !isset($property_copy_add->DataRegistered->EditAttrs["readonly"]) && !isset($property_copy_add->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_copyadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_copyadd", "x_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $property_copy_add->DataRegistered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_copy_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_property_copy_Description" for="x_Description" class="<?php echo $property_copy_add->LeftColumnClass ?>"><?php echo $property_copy_add->Description->caption() ?><?php echo $property_copy_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_copy_add->RightColumnClass ?>"><div <?php echo $property_copy_add->Description->cellAttributes() ?>>
<span id="el_property_copy_Description">
<textarea data-table="property_copy" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($property_copy_add->Description->getPlaceHolder()) ?>"<?php echo $property_copy_add->Description->editAttributes() ?>><?php echo $property_copy_add->Description->EditValue ?></textarea>
</span>
<?php echo $property_copy_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_copy_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_copy_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_copy_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_copy_add->showPageFooter();
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
$property_copy_add->terminate();
?>