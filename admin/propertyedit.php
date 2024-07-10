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
$property_edit = new property_edit();

// Run the page
$property_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertyedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpropertyedit = currentForm = new ew.Form("fpropertyedit", "edit");

	// Validate form
	fpropertyedit.validate = function() {
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
			<?php if ($property_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->id->caption(), $property_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ClientId->caption(), $property_edit->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ChargeGroup->caption(), $property_edit->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->ChargeGroup->errorMessage()) ?>");
			<?php if ($property_edit->ChargeGropuDes->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGropuDes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ChargeGropuDes->caption(), $property_edit->ChargeGropuDes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->ChargeableFee->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->ChargeableFee->caption(), $property_edit->ChargeableFee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->ChargeableFee->errorMessage()) ?>");
			<?php if ($property_edit->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->BalanceBF->caption(), $property_edit->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->BalanceBF->errorMessage()) ?>");
			<?php if ($property_edit->AmountPayable->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->AmountPayable->caption(), $property_edit->AmountPayable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->AmountPayable->errorMessage()) ?>");
			<?php if ($property_edit->Property->Required) { ?>
				elm = this.getElements("x" + infix + "_Property");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Property->caption(), $property_edit->Property->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->PropertyId->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyId->caption(), $property_edit->PropertyId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PropertyUse->caption(), $property_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Location->caption(), $property_edit->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->AmountPaid->caption(), $property_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($property_edit->CurrentBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->CurrentBalance->caption(), $property_edit->CurrentBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->CurrentBalance->errorMessage()) ?>");
			<?php if ($property_edit->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Description->caption(), $property_edit->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->DataRegistered->Required) { ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->DataRegistered->caption(), $property_edit->DataRegistered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_edit->DataRegistered->errorMessage()) ?>");
			<?php if ($property_edit->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->PhysicalAddress->caption(), $property_edit->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_edit->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_edit->Status->caption(), $property_edit->Status->RequiredErrorMessage)) ?>");
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
	fpropertyedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertyedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertyedit.lists["x_ClientId"] = <?php echo $property_edit->ClientId->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_ClientId"].options = <?php echo JsonEncode($property_edit->ClientId->lookupOptions()) ?>;
	fpropertyedit.lists["x_ChargeGroup"] = <?php echo $property_edit->ChargeGroup->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_ChargeGroup"].options = <?php echo JsonEncode($property_edit->ChargeGroup->lookupOptions()) ?>;
	fpropertyedit.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyedit.lists["x_ChargeGropuDes"] = <?php echo $property_edit->ChargeGropuDes->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_ChargeGropuDes"].options = <?php echo JsonEncode($property_edit->ChargeGropuDes->lookupOptions()) ?>;
	fpropertyedit.lists["x_PhysicalAddress"] = <?php echo $property_edit->PhysicalAddress->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_PhysicalAddress"].options = <?php echo JsonEncode($property_edit->PhysicalAddress->options(FALSE, TRUE)) ?>;
	fpropertyedit.lists["x_Status"] = <?php echo $property_edit->Status->Lookup->toClientList($property_edit) ?>;
	fpropertyedit.lists["x_Status"].options = <?php echo JsonEncode($property_edit->Status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpropertyedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#x_BalanceBF").prop("readonly","true"),$("#x_ChargeableFee").prop("readonly","true"),$("#x_AmountPayable").prop("readonly","true"),$("#x_CurrentBalance").prop("readonly","true"),$("#x_AmountPaid").prop("readonly","true"),$("#x_ChargeableFee").on("focus input change",function(){var e=parseFloat(document.getElementById("x_ChargeableFee").value),a=parseFloat(document.getElementById("x_BalanceBF").value),n=document.getElementById("x_AmountPayable"),t=document.getElementById("x_CurrentBalance");n.value=+e+a,t.value=+e+a});
});
</script>
<?php $property_edit->showPageHeader(); ?>
<?php
$property_edit->showMessage();
?>
<?php if (!$property_edit->IsModal) { ?>
<?php if (!$property->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpropertyedit" id="fpropertyedit" class="<?php echo $property_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<?php if ($property->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$property_edit->IsModal ?>">
<?php if ($property->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($property_edit->ClientId->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_property_id" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->id->caption() ?><?php echo $property_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->id->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_id">
<span<?php echo $property_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($property_edit->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_id">
<span<?php echo $property_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($property_edit->id->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_property_ClientId" for="x_ClientId" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ClientId->caption() ?><?php echo $property_edit->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ClientId->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<?php if ($property_edit->ClientId->getSessionValue() != "") { ?>
<span id="el_property_ClientId">
<span<?php echo $property_edit->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientId" name="x_ClientId" value="<?php echo HtmlEncode($property_edit->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_ClientId">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientId"><?php echo EmptyValue(strval($property_edit->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_edit->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->ClientId->ReadOnly || $property_edit->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_edit->ClientId->Lookup->getParamTag($property_edit, "p_x_ClientId") ?>
<input type="hidden" data-table="property" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_edit->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo $property_edit->ClientId->CurrentValue ?>"<?php echo $property_edit->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_property_ClientId">
<span<?php echo $property_edit->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ClientId" name="x_ClientId" id="x_ClientId" value="<?php echo HtmlEncode($property_edit->ClientId->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_property_ChargeGroup" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ChargeGroup->caption() ?><?php echo $property_edit->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ChargeGroup->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_ChargeGroup">
<?php
$onchange = $property_edit->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_edit->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeGroup" id="sv_x_ChargeGroup" value="<?php echo RemoveHtml($property_edit->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_edit->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_edit->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_edit->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->ChargeGroup->ReadOnly || $property_edit->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_edit->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($property_edit->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyedit"], function() {
	fpropertyedit.createAutoSuggest({"id":"x_ChargeGroup","forceSelect":true});
});
</script>
<?php echo $property_edit->ChargeGroup->Lookup->getParamTag($property_edit, "p_x_ChargeGroup") ?>
</span>
<?php } else { ?>
<span id="el_property_ChargeGroup">
<span<?php echo $property_edit->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($property_edit->ChargeGroup->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<div id="r_ChargeGropuDes" class="form-group row">
		<label id="elh_property_ChargeGropuDes" for="x_ChargeGropuDes" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ChargeGropuDes->caption() ?><?php echo $property_edit->ChargeGropuDes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ChargeGropuDes->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_ChargeGropuDes">
<?php $property_edit->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGropuDes"><?php echo EmptyValue(strval($property_edit->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_edit->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_edit->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_edit->ChargeGropuDes->ReadOnly || $property_edit->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_edit->ChargeGropuDes->Lookup->getParamTag($property_edit, "p_x_ChargeGropuDes") ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_edit->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x_ChargeGropuDes" id="x_ChargeGropuDes" value="<?php echo $property_edit->ChargeGropuDes->CurrentValue ?>"<?php echo $property_edit->ChargeGropuDes->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_ChargeGropuDes">
<span<?php echo $property_edit->ChargeGropuDes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ChargeGropuDes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="x_ChargeGropuDes" id="x_ChargeGropuDes" value="<?php echo HtmlEncode($property_edit->ChargeGropuDes->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->ChargeGropuDes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->ChargeableFee->Visible) { // ChargeableFee ?>
	<div id="r_ChargeableFee" class="form-group row">
		<label id="elh_property_ChargeableFee" for="x_ChargeableFee" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->ChargeableFee->caption() ?><?php echo $property_edit->ChargeableFee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->ChargeableFee->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_ChargeableFee">
<input type="text" data-table="property" data-field="x_ChargeableFee" name="x_ChargeableFee" id="x_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_edit->ChargeableFee->EditValue ?>"<?php echo $property_edit->ChargeableFee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_ChargeableFee">
<span<?php echo $property_edit->ChargeableFee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->ChargeableFee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="x_ChargeableFee" id="x_ChargeableFee" value="<?php echo HtmlEncode($property_edit->ChargeableFee->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->ChargeableFee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_property_BalanceBF" for="x_BalanceBF" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->BalanceBF->caption() ?><?php echo $property_edit->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->BalanceBF->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_BalanceBF">
<input type="text" data-table="property" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_edit->BalanceBF->EditValue ?>"<?php echo $property_edit->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_BalanceBF">
<span<?php echo $property_edit->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" value="<?php echo HtmlEncode($property_edit->BalanceBF->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->AmountPayable->Visible) { // AmountPayable ?>
	<div id="r_AmountPayable" class="form-group row">
		<label id="elh_property_AmountPayable" for="x_AmountPayable" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->AmountPayable->caption() ?><?php echo $property_edit->AmountPayable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->AmountPayable->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_AmountPayable">
<input type="text" data-table="property" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_edit->AmountPayable->EditValue ?>"<?php echo $property_edit->AmountPayable->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_AmountPayable">
<span<?php echo $property_edit->AmountPayable->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->AmountPayable->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" value="<?php echo HtmlEncode($property_edit->AmountPayable->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->AmountPayable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Property->Visible) { // Property ?>
	<div id="r_Property" class="form-group row">
		<label id="elh_property_Property" for="x_Property" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Property->caption() ?><?php echo $property_edit->Property->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Property->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Property">
<input type="text" data-table="property" data-field="x_Property" name="x_Property" id="x_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_edit->Property->getPlaceHolder()) ?>" value="<?php echo $property_edit->Property->EditValue ?>"<?php echo $property_edit->Property->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_Property">
<span<?php echo $property_edit->Property->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->Property->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Property" name="x_Property" id="x_Property" value="<?php echo HtmlEncode($property_edit->Property->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->Property->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PropertyId->Visible) { // PropertyId ?>
	<div id="r_PropertyId" class="form-group row">
		<label id="elh_property_PropertyId" for="x_PropertyId" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyId->caption() ?><?php echo $property_edit->PropertyId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyId->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_PropertyId">
<input type="text" data-table="property" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_edit->PropertyId->EditValue ?>"<?php echo $property_edit->PropertyId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_PropertyId">
<span<?php echo $property_edit->PropertyId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->PropertyId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" value="<?php echo HtmlEncode($property_edit->PropertyId->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->PropertyId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_PropertyUse" for="x_PropertyUse" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PropertyUse->caption() ?><?php echo $property_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PropertyUse->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_PropertyUse">
<input type="text" data-table="property" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_edit->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_edit->PropertyUse->EditValue ?>"<?php echo $property_edit->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_PropertyUse">
<span<?php echo $property_edit->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo HtmlEncode($property_edit->PropertyUse->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_property_Location" for="x_Location" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Location->caption() ?><?php echo $property_edit->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Location->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Location">
<input type="text" data-table="property" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_edit->Location->getPlaceHolder()) ?>" value="<?php echo $property_edit->Location->EditValue ?>"<?php echo $property_edit->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_Location">
<span<?php echo $property_edit->Location->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->Location->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Location" name="x_Location" id="x_Location" value="<?php echo HtmlEncode($property_edit->Location->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_property_AmountPaid" for="x_AmountPaid" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->AmountPaid->caption() ?><?php echo $property_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->AmountPaid->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_AmountPaid">
<input type="text" data-table="property" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_edit->AmountPaid->EditValue ?>"<?php echo $property_edit->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_AmountPaid">
<span<?php echo $property_edit->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" value="<?php echo HtmlEncode($property_edit->AmountPaid->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->CurrentBalance->Visible) { // CurrentBalance ?>
	<div id="r_CurrentBalance" class="form-group row">
		<label id="elh_property_CurrentBalance" for="x_CurrentBalance" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->CurrentBalance->caption() ?><?php echo $property_edit->CurrentBalance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->CurrentBalance->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_CurrentBalance">
<input type="text" data-table="property" data-field="x_CurrentBalance" name="x_CurrentBalance" id="x_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_edit->CurrentBalance->EditValue ?>"<?php echo $property_edit->CurrentBalance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_CurrentBalance">
<span<?php echo $property_edit->CurrentBalance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->CurrentBalance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="x_CurrentBalance" id="x_CurrentBalance" value="<?php echo HtmlEncode($property_edit->CurrentBalance->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->CurrentBalance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_property_Description" for="x_Description" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Description->caption() ?><?php echo $property_edit->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Description->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Description">
<textarea data-table="property" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($property_edit->Description->getPlaceHolder()) ?>"<?php echo $property_edit->Description->editAttributes() ?>><?php echo $property_edit->Description->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_property_Description">
<span<?php echo $property_edit->Description->viewAttributes() ?>><?php echo $property_edit->Description->ViewValue ?></span>
</span>
<input type="hidden" data-table="property" data-field="x_Description" name="x_Description" id="x_Description" value="<?php echo HtmlEncode($property_edit->Description->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->DataRegistered->Visible) { // DataRegistered ?>
	<div id="r_DataRegistered" class="form-group row">
		<label id="elh_property_DataRegistered" for="x_DataRegistered" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->DataRegistered->caption() ?><?php echo $property_edit->DataRegistered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->DataRegistered->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_DataRegistered">
<input type="text" data-table="property" data-field="x_DataRegistered" name="x_DataRegistered" id="x_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_edit->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_edit->DataRegistered->EditValue ?>"<?php echo $property_edit->DataRegistered->editAttributes() ?>>
<?php if (!$property_edit->DataRegistered->ReadOnly && !$property_edit->DataRegistered->Disabled && !isset($property_edit->DataRegistered->EditAttrs["readonly"]) && !isset($property_edit->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpropertyedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpropertyedit", "x_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_property_DataRegistered">
<span<?php echo $property_edit->DataRegistered->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->DataRegistered->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="x_DataRegistered" id="x_DataRegistered" value="<?php echo HtmlEncode($property_edit->DataRegistered->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->DataRegistered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_property_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->PhysicalAddress->caption() ?><?php echo $property_edit->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->PhysicalAddress->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_PhysicalAddress">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PhysicalAddress" data-value-separator="<?php echo $property_edit->PhysicalAddress->displayValueSeparatorAttribute() ?>" id="x_PhysicalAddress" name="x_PhysicalAddress"<?php echo $property_edit->PhysicalAddress->editAttributes() ?>>
			<?php echo $property_edit->PhysicalAddress->selectOptionListHtml("x_PhysicalAddress") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_property_PhysicalAddress">
<span<?php echo $property_edit->PhysicalAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->PhysicalAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" value="<?php echo HtmlEncode($property_edit->PhysicalAddress->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_edit->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_property_Status" class="<?php echo $property_edit->LeftColumnClass ?>"><?php echo $property_edit->Status->caption() ?><?php echo $property_edit->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_edit->RightColumnClass ?>"><div <?php echo $property_edit->Status->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Status">
<div id="tp_x_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="property" data-field="x_Status" data-value-separator="<?php echo $property_edit->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="{value}"<?php echo $property_edit->Status->editAttributes() ?>></div>
<div id="dsl_x_Status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $property_edit->Status->radioButtonListHtml(FALSE, "x_Status") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_property_Status">
<span<?php echo $property_edit->Status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_edit->Status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Status" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($property_edit->Status->FormValue) ?>">
<?php } ?>
<?php echo $property_edit->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$property->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_edit->IsModal) { ?>
<?php if (!$property->isConfirm()) { // Confirm page ?>
<?php echo $property_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_edit->showPageFooter();
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
$property_edit->terminate();
?>