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
$property_revenu_edit = new property_revenu_edit();

// Run the page
$property_revenu_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_revenu_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_revenuedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_revenuedit = currentForm = new ew.Form("fproperty_revenuedit", "edit");

	// Validate form
	fproperty_revenuedit.validate = function() {
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
			<?php if ($property_revenu_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->id->caption(), $property_revenu_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_edit->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->ClientId->caption(), $property_revenu_edit->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_edit->ClientProperty->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientProperty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->ClientProperty->caption(), $property_revenu_edit->ClientProperty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientProperty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_edit->ClientProperty->errorMessage()) ?>");
			<?php if ($property_revenu_edit->PropertyId->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->PropertyId->caption(), $property_revenu_edit->PropertyId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->PropertyUse->caption(), $property_revenu_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_revenu_edit->AmountPayable->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->AmountPayable->caption(), $property_revenu_edit->AmountPayable->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPayable");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_edit->AmountPayable->errorMessage()) ?>");
			<?php if ($property_revenu_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->AmountPaid->caption(), $property_revenu_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($property_revenu_edit->Balance->Required) { ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->Balance->caption(), $property_revenu_edit->Balance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Balance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_edit->Balance->errorMessage()) ?>");
			<?php if ($property_revenu_edit->date->Required) { ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_revenu_edit->date->caption(), $property_revenu_edit->date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_revenu_edit->date->errorMessage()) ?>");

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
	fproperty_revenuedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_revenuedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fproperty_revenuedit.lists["x_ClientId"] = <?php echo $property_revenu_edit->ClientId->Lookup->toClientList($property_revenu_edit) ?>;
	fproperty_revenuedit.lists["x_ClientId"].options = <?php echo JsonEncode($property_revenu_edit->ClientId->lookupOptions()) ?>;
	fproperty_revenuedit.lists["x_ClientProperty"] = <?php echo $property_revenu_edit->ClientProperty->Lookup->toClientList($property_revenu_edit) ?>;
	fproperty_revenuedit.lists["x_ClientProperty"].options = <?php echo JsonEncode($property_revenu_edit->ClientProperty->lookupOptions()) ?>;
	fproperty_revenuedit.autoSuggests["x_ClientProperty"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fproperty_revenuedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#x_AmountPayable").prop("readonly","true"),$("#x_PropertyUse").prop("readonly","true"),$("#x_Balance").prop("readonly","true");
});
</script>
<?php $property_revenu_edit->showPageHeader(); ?>
<?php
$property_revenu_edit->showMessage();
?>
<?php if (!$property_revenu_edit->IsModal) { ?>
<?php if (!$property_revenu->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_revenu_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fproperty_revenuedit" id="fproperty_revenuedit" class="<?php echo $property_revenu_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_revenu">
<?php if ($property_revenu->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$property_revenu_edit->IsModal ?>">
<?php if ($property_revenu->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($property_revenu_edit->ClientId->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_revenu_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_property_revenu_id" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->id->caption() ?><?php echo $property_revenu_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->id->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_id">
<span<?php echo $property_revenu_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($property_revenu_edit->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_revenu_id">
<span<?php echo $property_revenu_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($property_revenu_edit->id->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_property_revenu_ClientId" for="x_ClientId" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->ClientId->caption() ?><?php echo $property_revenu_edit->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->ClientId->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<?php if ($property_revenu_edit->ClientId->getSessionValue() != "") { ?>
<span id="el_property_revenu_ClientId">
<span<?php echo $property_revenu_edit->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientId" name="x_ClientId" value="<?php echo HtmlEncode($property_revenu_edit->ClientId->CurrentValue) ?>">
<?php } else { ?>
<span id="el_property_revenu_ClientId">
<?php $property_revenu_edit->ClientId->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientId"><?php echo EmptyValue(strval($property_revenu_edit->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_revenu_edit->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_edit->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_edit->ClientId->ReadOnly || $property_revenu_edit->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_revenu_edit->ClientId->Lookup->getParamTag($property_revenu_edit, "p_x_ClientId") ?>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_edit->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo $property_revenu_edit->ClientId->CurrentValue ?>"<?php echo $property_revenu_edit->ClientId->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_property_revenu_ClientId">
<span<?php echo $property_revenu_edit->ClientId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->ClientId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientId" name="x_ClientId" id="x_ClientId" value="<?php echo HtmlEncode($property_revenu_edit->ClientId->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->ClientProperty->Visible) { // ClientProperty ?>
	<div id="r_ClientProperty" class="form-group row">
		<label id="elh_property_revenu_ClientProperty" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->ClientProperty->caption() ?><?php echo $property_revenu_edit->ClientProperty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->ClientProperty->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_ClientProperty">
<?php
$onchange = $property_revenu_edit->ClientProperty->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_revenu_edit->ClientProperty->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientProperty">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientProperty" id="sv_x_ClientProperty" value="<?php echo RemoveHtml($property_revenu_edit->ClientProperty->EditValue) ?>" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_edit->ClientProperty->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_revenu_edit->ClientProperty->getPlaceHolder()) ?>"<?php echo $property_revenu_edit->ClientProperty->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_revenu_edit->ClientProperty->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientProperty',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_revenu_edit->ClientProperty->ReadOnly || $property_revenu_edit->ClientProperty->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_revenu_edit->ClientProperty->displayValueSeparatorAttribute() ?>" name="x_ClientProperty" id="x_ClientProperty" value="<?php echo HtmlEncode($property_revenu_edit->ClientProperty->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fproperty_revenuedit"], function() {
	fproperty_revenuedit.createAutoSuggest({"id":"x_ClientProperty","forceSelect":true});
});
</script>
<?php echo $property_revenu_edit->ClientProperty->Lookup->getParamTag($property_revenu_edit, "p_x_ClientProperty") ?>
</span>
<?php } else { ?>
<span id="el_property_revenu_ClientProperty">
<span<?php echo $property_revenu_edit->ClientProperty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->ClientProperty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_ClientProperty" name="x_ClientProperty" id="x_ClientProperty" value="<?php echo HtmlEncode($property_revenu_edit->ClientProperty->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->ClientProperty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->PropertyId->Visible) { // PropertyId ?>
	<div id="r_PropertyId" class="form-group row">
		<label id="elh_property_revenu_PropertyId" for="x_PropertyId" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->PropertyId->caption() ?><?php echo $property_revenu_edit->PropertyId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->PropertyId->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_PropertyId">
<input type="text" data-table="property_revenu" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($property_revenu_edit->PropertyId->getPlaceHolder()) ?>" value="<?php echo $property_revenu_edit->PropertyId->EditValue ?>"<?php echo $property_revenu_edit->PropertyId->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_revenu_PropertyId">
<span<?php echo $property_revenu_edit->PropertyId->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->PropertyId->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" value="<?php echo HtmlEncode($property_revenu_edit->PropertyId->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->PropertyId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_revenu_PropertyUse" for="x_PropertyUse" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->PropertyUse->caption() ?><?php echo $property_revenu_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->PropertyUse->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_PropertyUse">
<input type="text" data-table="property_revenu" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_revenu_edit->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_revenu_edit->PropertyUse->EditValue ?>"<?php echo $property_revenu_edit->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_revenu_PropertyUse">
<span<?php echo $property_revenu_edit->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" value="<?php echo HtmlEncode($property_revenu_edit->PropertyUse->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->AmountPayable->Visible) { // AmountPayable ?>
	<div id="r_AmountPayable" class="form-group row">
		<label id="elh_property_revenu_AmountPayable" for="x_AmountPayable" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->AmountPayable->caption() ?><?php echo $property_revenu_edit->AmountPayable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->AmountPayable->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_AmountPayable">
<input type="text" data-table="property_revenu" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_edit->AmountPayable->getPlaceHolder()) ?>" value="<?php echo $property_revenu_edit->AmountPayable->EditValue ?>"<?php echo $property_revenu_edit->AmountPayable->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_revenu_AmountPayable">
<span<?php echo $property_revenu_edit->AmountPayable->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->AmountPayable->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPayable" name="x_AmountPayable" id="x_AmountPayable" value="<?php echo HtmlEncode($property_revenu_edit->AmountPayable->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->AmountPayable->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_property_revenu_AmountPaid" for="x_AmountPaid" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->AmountPaid->caption() ?><?php echo $property_revenu_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->AmountPaid->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_AmountPaid">
<input type="text" data-table="property_revenu" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $property_revenu_edit->AmountPaid->EditValue ?>"<?php echo $property_revenu_edit->AmountPaid->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_revenu_AmountPaid">
<span<?php echo $property_revenu_edit->AmountPaid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->AmountPaid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" value="<?php echo HtmlEncode($property_revenu_edit->AmountPaid->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->Balance->Visible) { // Balance ?>
	<div id="r_Balance" class="form-group row">
		<label id="elh_property_revenu_Balance" for="x_Balance" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->Balance->caption() ?><?php echo $property_revenu_edit->Balance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->Balance->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_Balance">
<input type="text" data-table="property_revenu" data-field="x_Balance" name="x_Balance" id="x_Balance" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($property_revenu_edit->Balance->getPlaceHolder()) ?>" value="<?php echo $property_revenu_edit->Balance->EditValue ?>"<?php echo $property_revenu_edit->Balance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_property_revenu_Balance">
<span<?php echo $property_revenu_edit->Balance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->Balance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_Balance" name="x_Balance" id="x_Balance" value="<?php echo HtmlEncode($property_revenu_edit->Balance->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->Balance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_revenu_edit->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_property_revenu_date" for="x_date" class="<?php echo $property_revenu_edit->LeftColumnClass ?>"><?php echo $property_revenu_edit->date->caption() ?><?php echo $property_revenu_edit->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_revenu_edit->RightColumnClass ?>"><div <?php echo $property_revenu_edit->date->cellAttributes() ?>>
<?php if (!$property_revenu->isConfirm()) { ?>
<span id="el_property_revenu_date">
<input type="text" data-table="property_revenu" data-field="x_date" data-format="7" name="x_date" id="x_date" maxlength="19" placeholder="<?php echo HtmlEncode($property_revenu_edit->date->getPlaceHolder()) ?>" value="<?php echo $property_revenu_edit->date->EditValue ?>"<?php echo $property_revenu_edit->date->editAttributes() ?>>
<?php if (!$property_revenu_edit->date->ReadOnly && !$property_revenu_edit->date->Disabled && !isset($property_revenu_edit->date->EditAttrs["readonly"]) && !isset($property_revenu_edit->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproperty_revenuedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fproperty_revenuedit", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_property_revenu_date">
<span<?php echo $property_revenu_edit->date->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_revenu_edit->date->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property_revenu" data-field="x_date" name="x_date" id="x_date" value="<?php echo HtmlEncode($property_revenu_edit->date->FormValue) ?>">
<?php } ?>
<?php echo $property_revenu_edit->date->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_revenu_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_revenu_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$property_revenu->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_revenu_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_revenu_edit->IsModal) { ?>
<?php if (!$property_revenu->isConfirm()) { // Confirm page ?>
<?php echo $property_revenu_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$property_revenu_edit->showPageFooter();
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
$property_revenu_edit->terminate();
?>