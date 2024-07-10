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
$property_add = new property_add();

// Run the page
$property_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropertyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpropertyadd = currentForm = new ew.Form("fpropertyadd", "add");

	// Validate form
	fpropertyadd.validate = function() {
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
			<?php if ($property_add->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ClientId->caption(), $property_add->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ChargeGroup->caption(), $property_add->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->ChargeGroup->errorMessage()) ?>");
			<?php if ($property_add->ChargeGropuDes->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGropuDes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ChargeGropuDes->caption(), $property_add->ChargeGropuDes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->ChargeableFee->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->ChargeableFee->caption(), $property_add->ChargeableFee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChargeableFee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->ChargeableFee->errorMessage()) ?>");
			<?php if ($property_add->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->BalanceBF->caption(), $property_add->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->BalanceBF->errorMessage()) ?>");
			<?php if ($property_add->AmountPayable->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->AmountPayable->caption(), $property_add->AmountPayable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->AmountPayable->errorMessage()) ?>");
			<?php if ($property_add->Property->Required) { ?>
				elm = this.getElements("x" + infix + "_Property");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Property->caption(), $property_add->Property->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->PropertyId->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyId->caption(), $property_add->PropertyId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PropertyUse->caption(), $property_add->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Location->caption(), $property_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->AmountPaid->caption(), $property_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->AmountPaid->errorMessage()) ?>");
			<?php if ($property_add->CurrentBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->CurrentBalance->caption(), $property_add->CurrentBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->CurrentBalance->errorMessage()) ?>");
			<?php if ($property_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Description->caption(), $property_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->DataRegistered->Required) { ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->DataRegistered->caption(), $property_add->DataRegistered->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataRegistered");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_add->DataRegistered->errorMessage()) ?>");
			<?php if ($property_add->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->PhysicalAddress->caption(), $property_add->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_add->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_add->Status->caption(), $property_add->Status->RequiredErrorMessage)) ?>");
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
	fpropertyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertyadd.lists["x_ClientId"] = <?php echo $property_add->ClientId->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_ClientId"].options = <?php echo JsonEncode($property_add->ClientId->lookupOptions()) ?>;
	fpropertyadd.lists["x_ChargeGroup"] = <?php echo $property_add->ChargeGroup->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_ChargeGroup"].options = <?php echo JsonEncode($property_add->ChargeGroup->lookupOptions()) ?>;
	fpropertyadd.autoSuggests["x_ChargeGroup"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertyadd.lists["x_ChargeGropuDes"] = <?php echo $property_add->ChargeGropuDes->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_ChargeGropuDes"].options = <?php echo JsonEncode($property_add->ChargeGropuDes->lookupOptions()) ?>;
	fpropertyadd.lists["x_PhysicalAddress"] = <?php echo $property_add->PhysicalAddress->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_PhysicalAddress"].options = <?php echo JsonEncode($property_add->PhysicalAddress->options(FALSE, TRUE)) ?>;
	fpropertyadd.lists["x_Status"] = <?php echo $property_add->Status->Lookup->toClientList($property_add) ?>;
	fpropertyadd.lists["x_Status"].options = <?php echo JsonEncode($property_add->Status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpropertyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#x_BalanceBF").prop("readonly","true"),$("#x_ChargeableFee").prop("readonly","true"),$("#x_AmountPayable").prop("readonly","true"),$("#x_CurrentBalance").prop("readonly","true"),$("#x_AmountPaid").prop("readonly","true"),$("#x_ChargeableFee").on("focus input change",function(){var e=parseFloat(document.getElementById("x_ChargeableFee").value),a=parseFloat(document.getElementById("x_BalanceBF").value),n=document.getElementById("x_AmountPayable"),t=document.getElementById("x_CurrentBalance");n.value=+e+a,t.value=+e+a});
});
</script>
<?php $property_add->showPageHeader(); ?>
<?php
$property_add->showMessage();
?>
<form name="fpropertyadd" id="fpropertyadd" class="<?php echo $property_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property">
<?php if ($property->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$property_add->IsModal ?>">
<?php if ($property->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($property_add->ClientId->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($property_add->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_property_ClientId" for="x_ClientId" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ClientId->caption() ?><?php echo $property_add->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ClientId->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<?php if ($property_add->ClientId->getSessionValue() != "") { ?>
<span id="el_property_ClientId">
<span<?php echo $property_add->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientId" name="x_ClientId" value="<?php echo HtmlEncode($property_add->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_ClientId">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientId"><?php echo EmptyValue(strval($property_add->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_add->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->ClientId->ReadOnly || $property_add->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_add->ClientId->Lookup->getParamTag($property_add, "p_x_ClientId") ?>
<input type="hidden" data-table="property" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_add->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo $property_add->ClientId->CurrentValue ?>"<?php echo $property_add->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_property_ClientId">
<span<?php echo $property_add->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ClientId" name="x_ClientId" id="x_ClientId" value="<?php echo HtmlEncode($property_add->ClientId->FormValue) ?>">
<?php } ?>
<?php echo $property_add->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ChargeGroup->Visible) { // ChargeGroup ?>
	<div id="r_ChargeGroup" class="form-group row">
		<label id="elh_property_ChargeGroup" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ChargeGroup->caption() ?><?php echo $property_add->ChargeGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ChargeGroup->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_ChargeGroup">
<?php
$onchange = $property_add->ChargeGroup->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_add->ChargeGroup->EditAttrs["onchange"] = "";
?>
<span id="as_x_ChargeGroup">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ChargeGroup" id="sv_x_ChargeGroup" value="<?php echo RemoveHtml($property_add->ChargeGroup->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_add->ChargeGroup->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_add->ChargeGroup->getPlaceHolder()) ?>"<?php echo $property_add->ChargeGroup->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->ChargeGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGroup',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->ChargeGroup->ReadOnly || $property_add->ChargeGroup->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_add->ChargeGroup->displayValueSeparatorAttribute() ?>" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($property_add->ChargeGroup->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertyadd"], function() {
	fpropertyadd.createAutoSuggest({"id":"x_ChargeGroup","forceSelect":true});
});
</script>
<?php echo $property_add->ChargeGroup->Lookup->getParamTag($property_add, "p_x_ChargeGroup") ?>
</span>
<?php } else { ?>
<span id="el_property_ChargeGroup">
<span<?php echo $property_add->ChargeGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->ChargeGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGroup" name="x_ChargeGroup" id="x_ChargeGroup" value="<?php echo HtmlEncode($property_add->ChargeGroup->FormValue) ?>">
<?php } ?>
<?php echo $property_add->ChargeGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<div id="r_ChargeGropuDes" class="form-group row">
		<label id="elh_property_ChargeGropuDes" for="x_ChargeGropuDes" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ChargeGropuDes->caption() ?><?php echo $property_add->ChargeGropuDes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ChargeGropuDes->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_ChargeGropuDes">
<?php $property_add->ChargeGropuDes->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeGropuDes"><?php echo EmptyValue(strval($property_add->ChargeGropuDes->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_add->ChargeGropuDes->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_add->ChargeGropuDes->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_add->ChargeGropuDes->ReadOnly || $property_add->ChargeGropuDes->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeGropuDes',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_add->ChargeGropuDes->Lookup->getParamTag($property_add, "p_x_ChargeGropuDes") ?>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_add->ChargeGropuDes->displayValueSeparatorAttribute() ?>" name="x_ChargeGropuDes" id="x_ChargeGropuDes" value="<?php echo $property_add->ChargeGropuDes->CurrentValue ?>"<?php echo $property_add->ChargeGropuDes->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_ChargeGropuDes">
<span<?php echo $property_add->ChargeGropuDes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->ChargeGropuDes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeGropuDes" name="x_ChargeGropuDes" id="x_ChargeGropuDes" value="<?php echo HtmlEncode($property_add->ChargeGropuDes->FormValue) ?>">
<?php } ?>
<?php echo $property_add->ChargeGropuDes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->ChargeableFee->Visible) { // ChargeableFee ?>
	<div id="r_ChargeableFee" class="form-group row">
		<label id="elh_property_ChargeableFee" for="x_ChargeableFee" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->ChargeableFee->caption() ?><?php echo $property_add->ChargeableFee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->ChargeableFee->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_ChargeableFee">
<input type="text" data-table="property" data-field="x_ChargeableFee" name="x_ChargeableFee" id="x_ChargeableFee" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->ChargeableFee->getPlaceHolder()) ?>" value="<?php echo $property_add->ChargeableFee->EditValue ?>"<?php echo $property_add->ChargeableFee->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_ChargeableFee">
<span<?php echo $property_add->ChargeableFee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->ChargeableFee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ChargeableFee" name="x_ChargeableFee" id="x_ChargeableFee" value="<?php echo HtmlEncode($property_add->ChargeableFee->FormValue) ?>">
<?php } ?>
<?php echo $property_add->ChargeableFee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_property_BalanceBF" for="x_BalanceBF" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->BalanceBF->caption() ?><?php echo $property_add->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->BalanceBF->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_BalanceBF">
<input type="text" data-table="property" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $property_add->BalanceBF->EditValue ?>"<?php echo $property_add->BalanceBF->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_BalanceBF">
<span<?php echo $property_add->BalanceBF->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->BalanceBF->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" value="<?php echo HtmlEncode($property_add->BalanceBF->FormValue) ?>">
<?php } ?>
<?php echo $property_add->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->AmountPayable->Visible) { // AmountPayable ?>
	<div id="r_AmountPayable" class="form-group row">
		<label id="elh_property_AmountPayable" for="x_AmountPayable" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->AmountPayable->caption() ?><?php echo $property_add->AmountPayable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->AmountPayable->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_AmountPayable">
<input type="text" data-table="property" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_add->AmountPayable->EditValue ?>"<?php echo $property_add->AmountPayable->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_AmountPayable">
<span<?php echo $property_add->AmountPayable->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->AmountPayable->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" value="<?php echo HtmlEncode($property_add->AmountPayable->FormValue) ?>">
<?php } ?>
<?php echo $property_add->AmountPayable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Property->Visible) { // Property ?>
	<div id="r_Property" class="form-group row">
		<label id="elh_property_Property" for="x_Property" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Property->caption() ?><?php echo $property_add->Property->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Property->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Property">
<input type="text" data-table="property" data-field="x_Property" name="x_Property" id="x_Property" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_add->Property->getPlaceHolder()) ?>" value="<?php echo $property_add->Property->EditValue ?>"<?php echo $property_add->Property->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_Property">
<span<?php echo $property_add->Property->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->Property->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Property" name="x_Property" id="x_Property" value="<?php echo HtmlEncode($property_add->Property->FormValue) ?>">
<?php } ?>
<?php echo $property_add->Property->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PropertyId->Visible) { // PropertyId ?>
	<div id="r_PropertyId" class="form-group row">
		<label id="elh_property_PropertyId" for="x_PropertyId" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyId->caption() ?><?php echo $property_add->PropertyId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyId->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_PropertyId">
<input type="text" data-table="property" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_add->PropertyId->EditValue ?>"<?php echo $property_add->PropertyId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_PropertyId">
<span<?php echo $property_add->PropertyId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->PropertyId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" value="<?php echo HtmlEncode($property_add->PropertyId->FormValue) ?>">
<?php } ?>
<?php echo $property_add->PropertyId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_PropertyUse" for="x_PropertyUse" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PropertyUse->caption() ?><?php echo $property_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PropertyUse->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_PropertyUse">
<input type="text" data-table="property" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_add->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_add->PropertyUse->EditValue ?>"<?php echo $property_add->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_PropertyUse">
<span<?php echo $property_add->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo HtmlEncode($property_add->PropertyUse->FormValue) ?>">
<?php } ?>
<?php echo $property_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_property_Location" for="x_Location" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Location->caption() ?><?php echo $property_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Location->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Location">
<input type="text" data-table="property" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_add->Location->getPlaceHolder()) ?>" value="<?php echo $property_add->Location->EditValue ?>"<?php echo $property_add->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_Location">
<span<?php echo $property_add->Location->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->Location->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Location" name="x_Location" id="x_Location" value="<?php echo HtmlEncode($property_add->Location->FormValue) ?>">
<?php } ?>
<?php echo $property_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_property_AmountPaid" for="x_AmountPaid" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->AmountPaid->caption() ?><?php echo $property_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->AmountPaid->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_AmountPaid">
<input type="text" data-table="property" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_add->AmountPaid->EditValue ?>"<?php echo $property_add->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_AmountPaid">
<span<?php echo $property_add->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" value="<?php echo HtmlEncode($property_add->AmountPaid->FormValue) ?>">
<?php } ?>
<?php echo $property_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->CurrentBalance->Visible) { // CurrentBalance ?>
	<div id="r_CurrentBalance" class="form-group row">
		<label id="elh_property_CurrentBalance" for="x_CurrentBalance" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->CurrentBalance->caption() ?><?php echo $property_add->CurrentBalance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->CurrentBalance->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_CurrentBalance">
<input type="text" data-table="property" data-field="x_CurrentBalance" name="x_CurrentBalance" id="x_CurrentBalance" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->CurrentBalance->getPlaceHolder()) ?>" value="<?php echo $property_add->CurrentBalance->EditValue ?>"<?php echo $property_add->CurrentBalance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_CurrentBalance">
<span<?php echo $property_add->CurrentBalance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->CurrentBalance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_CurrentBalance" name="x_CurrentBalance" id="x_CurrentBalance" value="<?php echo HtmlEncode($property_add->CurrentBalance->FormValue) ?>">
<?php } ?>
<?php echo $property_add->CurrentBalance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_property_Description" for="x_Description" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Description->caption() ?><?php echo $property_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Description->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Description">
<textarea data-table="property" data-field="x_Description" name="x_Description" id="x_Description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($property_add->Description->getPlaceHolder()) ?>"<?php echo $property_add->Description->editAttributes() ?>><?php echo $property_add->Description->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_property_Description">
<span<?php echo $property_add->Description->viewAttributes() ?>><?php echo $property_add->Description->ViewValue ?></span>
</span>
<input type="hidden" data-table="property" data-field="x_Description" name="x_Description" id="x_Description" value="<?php echo HtmlEncode($property_add->Description->FormValue) ?>">
<?php } ?>
<?php echo $property_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->DataRegistered->Visible) { // DataRegistered ?>
	<div id="r_DataRegistered" class="form-group row">
		<label id="elh_property_DataRegistered" for="x_DataRegistered" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->DataRegistered->caption() ?><?php echo $property_add->DataRegistered->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->DataRegistered->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_DataRegistered">
<input type="text" data-table="property" data-field="x_DataRegistered" name="x_DataRegistered" id="x_DataRegistered" maxlength="10" placeholder="<?php echo HtmlEncode($property_add->DataRegistered->getPlaceHolder()) ?>" value="<?php echo $property_add->DataRegistered->EditValue ?>"<?php echo $property_add->DataRegistered->editAttributes() ?>>
<?php if (!$property_add->DataRegistered->ReadOnly && !$property_add->DataRegistered->Disabled && !isset($property_add->DataRegistered->EditAttrs["readonly"]) && !isset($property_add->DataRegistered->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpropertyadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpropertyadd", "x_DataRegistered", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_property_DataRegistered">
<span<?php echo $property_add->DataRegistered->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->DataRegistered->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_DataRegistered" name="x_DataRegistered" id="x_DataRegistered" value="<?php echo HtmlEncode($property_add->DataRegistered->FormValue) ?>">
<?php } ?>
<?php echo $property_add->DataRegistered->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_property_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->PhysicalAddress->caption() ?><?php echo $property_add->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->PhysicalAddress->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_PhysicalAddress">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PhysicalAddress" data-value-separator="<?php echo $property_add->PhysicalAddress->displayValueSeparatorAttribute() ?>" id="x_PhysicalAddress" name="x_PhysicalAddress"<?php echo $property_add->PhysicalAddress->editAttributes() ?>>
			<?php echo $property_add->PhysicalAddress->selectOptionListHtml("x_PhysicalAddress") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_property_PhysicalAddress">
<span<?php echo $property_add->PhysicalAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->PhysicalAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" value="<?php echo HtmlEncode($property_add->PhysicalAddress->FormValue) ?>">
<?php } ?>
<?php echo $property_add->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_add->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_property_Status" class="<?php echo $property_add->LeftColumnClass ?>"><?php echo $property_add->Status->caption() ?><?php echo $property_add->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_add->RightColumnClass ?>"><div <?php echo $property_add->Status->cellAttributes() ?>>
<?php if (!$property->isConfirm()) { ?>
<span id="el_property_Status">
<div id="tp_x_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="property" data-field="x_Status" data-value-separator="<?php echo $property_add->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="{value}"<?php echo $property_add->Status->editAttributes() ?>></div>
<div id="dsl_x_Status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $property_add->Status->radioButtonListHtml(FALSE, "x_Status") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_property_Status">
<span<?php echo $property_add->Status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_add->Status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Status" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($property_add->Status->FormValue) ?>">
<?php } ?>
<?php echo $property_add->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$property->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_add->showPageFooter();
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
$property_add->terminate();
?>