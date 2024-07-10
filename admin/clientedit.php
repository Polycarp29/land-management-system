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
$client_edit = new client_edit();

// Run the page
$client_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fclientedit = currentForm = new ew.Form("fclientedit", "edit");

	// Validate form
	fclientedit.validate = function() {
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
			<?php if ($client_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->id->caption(), $client_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->ClientName->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientName->caption(), $client_edit->ClientName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->ClientType->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientType->caption(), $client_edit->ClientType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->IdentityType->Required) { ?>
				elm = this.getElements("x" + infix + "_IdentityType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->IdentityType->caption(), $client_edit->IdentityType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientID->caption(), $client_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Surname->caption(), $client_edit->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->FirstName->caption(), $client_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->MiddleName->caption(), $client_edit->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Gender->Required) { ?>
				elm = this.getElements("x" + infix + "_Gender");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Gender->caption(), $client_edit->Gender->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->MaritalStatus->caption(), $client_edit->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->DateOfBirth->caption(), $client_edit->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_edit->DateOfBirth->errorMessage()) ?>");
			<?php if ($client_edit->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->PostalAddress->caption(), $client_edit->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->PhysicalAddress->caption(), $client_edit->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->TownOrVillage->caption(), $client_edit->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Mobile->caption(), $client_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->_Email->caption(), $client_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->NextOfKin->caption(), $client_edit->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->NextOfKinMobile->caption(), $client_edit->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->NextOfKinEmail->caption(), $client_edit->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->AdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_AdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->AdditionalInformation->caption(), $client_edit->AdditionalInformation->RequiredErrorMessage)) ?>");
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
	fclientedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclientedit.lists["x_ClientType"] = <?php echo $client_edit->ClientType->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_ClientType"].options = <?php echo JsonEncode($client_edit->ClientType->lookupOptions()) ?>;
	fclientedit.lists["x_IdentityType"] = <?php echo $client_edit->IdentityType->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_IdentityType"].options = <?php echo JsonEncode($client_edit->IdentityType->options(FALSE, TRUE)) ?>;
	fclientedit.lists["x_Gender"] = <?php echo $client_edit->Gender->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_Gender"].options = <?php echo JsonEncode($client_edit->Gender->options(FALSE, TRUE)) ?>;
	fclientedit.lists["x_MaritalStatus"] = <?php echo $client_edit->MaritalStatus->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_MaritalStatus"].options = <?php echo JsonEncode($client_edit->MaritalStatus->options(FALSE, TRUE)) ?>;
	loadjs.done("fclientedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_edit->showPageHeader(); ?>
<?php
$client_edit->showMessage();
?>
<?php if (!$client_edit->IsModal) { ?>
<?php if (!$client->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fclientedit" id="fclientedit" class="<?php echo $client_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<?php if ($client->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$client_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($client_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_client_id" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->id->caption() ?><?php echo $client_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->id->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_id">
<span<?php echo $client_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($client_edit->id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_client_id">
<span<?php echo $client_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($client_edit->id->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label id="elh_client_ClientName" for="x_ClientName" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientName->caption() ?><?php echo $client_edit->ClientName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientName->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_ClientName">
<input type="text" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->ClientName->getPlaceHolder()) ?>" value="<?php echo $client_edit->ClientName->EditValue ?>"<?php echo $client_edit->ClientName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_ClientName">
<span<?php echo $client_edit->ClientName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->ClientName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" value="<?php echo HtmlEncode($client_edit->ClientName->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->ClientName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->ClientType->Visible) { // ClientType ?>
	<div id="r_ClientType" class="form-group row">
		<label id="elh_client_ClientType" for="x_ClientType" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientType->caption() ?><?php echo $client_edit->ClientType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientType->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_ClientType">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientType"><?php echo EmptyValue(strval($client_edit->ClientType->ViewValue)) ? $Language->phrase("PleaseSelect") : $client_edit->ClientType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($client_edit->ClientType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($client_edit->ClientType->ReadOnly || $client_edit->ClientType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $client_edit->ClientType->Lookup->getParamTag($client_edit, "p_x_ClientType") ?>
<input type="hidden" data-table="client" data-field="x_ClientType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $client_edit->ClientType->displayValueSeparatorAttribute() ?>" name="x_ClientType" id="x_ClientType" value="<?php echo $client_edit->ClientType->CurrentValue ?>"<?php echo $client_edit->ClientType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_ClientType">
<span<?php echo $client_edit->ClientType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->ClientType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientType" name="x_ClientType" id="x_ClientType" value="<?php echo HtmlEncode($client_edit->ClientType->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->ClientType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->IdentityType->Visible) { // IdentityType ?>
	<div id="r_IdentityType" class="form-group row">
		<label id="elh_client_IdentityType" for="x_IdentityType" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->IdentityType->caption() ?><?php echo $client_edit->IdentityType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->IdentityType->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_IdentityType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_IdentityType" data-value-separator="<?php echo $client_edit->IdentityType->displayValueSeparatorAttribute() ?>" id="x_IdentityType" name="x_IdentityType"<?php echo $client_edit->IdentityType->editAttributes() ?>>
			<?php echo $client_edit->IdentityType->selectOptionListHtml("x_IdentityType") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_client_IdentityType">
<span<?php echo $client_edit->IdentityType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->IdentityType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_IdentityType" name="x_IdentityType" id="x_IdentityType" value="<?php echo HtmlEncode($client_edit->IdentityType->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->IdentityType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_client_ClientID" for="x_ClientID" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientID->caption() ?><?php echo $client_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientID->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<input type="text" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($client_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $client_edit->ClientID->EditValue ?>"<?php echo $client_edit->ClientID->editAttributes() ?>>
<input type="hidden" data-table="client" data-field="x_ClientID" name="o_ClientID" id="o_ClientID" value="<?php echo HtmlEncode($client_edit->ClientID->OldValue != null ? $client_edit->ClientID->OldValue : $client_edit->ClientID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_client_ClientID">
<span<?php echo $client_edit->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($client_edit->ClientID->FormValue) ?>">
<input type="hidden" data-table="client" data-field="x_ClientID" name="o_ClientID" id="o_ClientID" value="<?php echo HtmlEncode($client_edit->ClientID->OldValue != null ? $client_edit->ClientID->OldValue : $client_edit->ClientID->CurrentValue) ?>">
<?php } ?>
<?php echo $client_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_client_Surname" for="x_Surname" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Surname->caption() ?><?php echo $client_edit->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Surname->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_Surname">
<input type="text" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->Surname->getPlaceHolder()) ?>" value="<?php echo $client_edit->Surname->EditValue ?>"<?php echo $client_edit->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_Surname">
<span<?php echo $client_edit->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" value="<?php echo HtmlEncode($client_edit->Surname->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_client_FirstName" for="x_FirstName" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->FirstName->caption() ?><?php echo $client_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->FirstName->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_FirstName">
<input type="text" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $client_edit->FirstName->EditValue ?>"<?php echo $client_edit->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_FirstName">
<span<?php echo $client_edit->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" value="<?php echo HtmlEncode($client_edit->FirstName->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_client_MiddleName" for="x_MiddleName" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->MiddleName->caption() ?><?php echo $client_edit->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->MiddleName->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_MiddleName">
<input type="text" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($client_edit->MiddleName->getPlaceHolder()) ?>" value="<?php echo $client_edit->MiddleName->EditValue ?>"<?php echo $client_edit->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_MiddleName">
<span<?php echo $client_edit->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" value="<?php echo HtmlEncode($client_edit->MiddleName->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Gender->Visible) { // Gender ?>
	<div id="r_Gender" class="form-group row">
		<label id="elh_client_Gender" for="x_Gender" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Gender->caption() ?><?php echo $client_edit->Gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Gender->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_Gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Gender" data-value-separator="<?php echo $client_edit->Gender->displayValueSeparatorAttribute() ?>" id="x_Gender" name="x_Gender"<?php echo $client_edit->Gender->editAttributes() ?>>
			<?php echo $client_edit->Gender->selectOptionListHtml("x_Gender") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_client_Gender">
<span<?php echo $client_edit->Gender->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->Gender->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_Gender" name="x_Gender" id="x_Gender" value="<?php echo HtmlEncode($client_edit->Gender->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->Gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_client_MaritalStatus" for="x_MaritalStatus" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->MaritalStatus->caption() ?><?php echo $client_edit->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->MaritalStatus->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_MaritalStatus" data-value-separator="<?php echo $client_edit->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $client_edit->MaritalStatus->editAttributes() ?>>
			<?php echo $client_edit->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_client_MaritalStatus">
<span<?php echo $client_edit->MaritalStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->MaritalStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_MaritalStatus" name="x_MaritalStatus" id="x_MaritalStatus" value="<?php echo HtmlEncode($client_edit->MaritalStatus->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_client_DateOfBirth" for="x_DateOfBirth" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->DateOfBirth->caption() ?><?php echo $client_edit->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->DateOfBirth->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_DateOfBirth">
<input type="text" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" maxlength="10" placeholder="<?php echo HtmlEncode($client_edit->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $client_edit->DateOfBirth->EditValue ?>"<?php echo $client_edit->DateOfBirth->editAttributes() ?>>
<?php if (!$client_edit->DateOfBirth->ReadOnly && !$client_edit->DateOfBirth->Disabled && !isset($client_edit->DateOfBirth->EditAttrs["readonly"]) && !isset($client_edit->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fclientedit", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_client_DateOfBirth">
<span<?php echo $client_edit->DateOfBirth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->DateOfBirth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" value="<?php echo HtmlEncode($client_edit->DateOfBirth->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_client_PostalAddress" for="x_PostalAddress" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->PostalAddress->caption() ?><?php echo $client_edit->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->PostalAddress->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_PostalAddress">
<input type="text" data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $client_edit->PostalAddress->EditValue ?>"<?php echo $client_edit->PostalAddress->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_PostalAddress">
<span<?php echo $client_edit->PostalAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->PostalAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" value="<?php echo HtmlEncode($client_edit->PostalAddress->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_client_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->PhysicalAddress->caption() ?><?php echo $client_edit->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->PhysicalAddress->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_PhysicalAddress">
<input type="text" data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $client_edit->PhysicalAddress->EditValue ?>"<?php echo $client_edit->PhysicalAddress->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_PhysicalAddress">
<span<?php echo $client_edit->PhysicalAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->PhysicalAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" value="<?php echo HtmlEncode($client_edit->PhysicalAddress->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_client_TownOrVillage" for="x_TownOrVillage" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->TownOrVillage->caption() ?><?php echo $client_edit->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->TownOrVillage->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_TownOrVillage">
<input type="text" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $client_edit->TownOrVillage->EditValue ?>"<?php echo $client_edit->TownOrVillage->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_TownOrVillage">
<span<?php echo $client_edit->TownOrVillage->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->TownOrVillage->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" value="<?php echo HtmlEncode($client_edit->TownOrVillage->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_client_Mobile" for="x_Mobile" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Mobile->caption() ?><?php echo $client_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Mobile->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_Mobile">
<input type="text" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $client_edit->Mobile->EditValue ?>"<?php echo $client_edit->Mobile->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_Mobile">
<span<?php echo $client_edit->Mobile->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->Mobile->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" value="<?php echo HtmlEncode($client_edit->Mobile->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_client__Email" for="x__Email" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->_Email->caption() ?><?php echo $client_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->_Email->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client__Email">
<input type="text" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $client_edit->_Email->EditValue ?>"<?php echo $client_edit->_Email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client__Email">
<span<?php echo $client_edit->_Email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->_Email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" value="<?php echo HtmlEncode($client_edit->_Email->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label id="elh_client_NextOfKin" for="x_NextOfKin" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->NextOfKin->caption() ?><?php echo $client_edit->NextOfKin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->NextOfKin->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_NextOfKin">
<input type="text" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $client_edit->NextOfKin->EditValue ?>"<?php echo $client_edit->NextOfKin->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_NextOfKin">
<span<?php echo $client_edit->NextOfKin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->NextOfKin->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" value="<?php echo HtmlEncode($client_edit->NextOfKin->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->NextOfKin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label id="elh_client_NextOfKinMobile" for="x_NextOfKinMobile" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->NextOfKinMobile->caption() ?><?php echo $client_edit->NextOfKinMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->NextOfKinMobile->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_NextOfKinMobile">
<input type="text" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $client_edit->NextOfKinMobile->EditValue ?>"<?php echo $client_edit->NextOfKinMobile->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_NextOfKinMobile">
<span<?php echo $client_edit->NextOfKinMobile->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->NextOfKinMobile->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" value="<?php echo HtmlEncode($client_edit->NextOfKinMobile->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->NextOfKinMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label id="elh_client_NextOfKinEmail" for="x_NextOfKinEmail" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->NextOfKinEmail->caption() ?><?php echo $client_edit->NextOfKinEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->NextOfKinEmail->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_NextOfKinEmail">
<input type="text" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $client_edit->NextOfKinEmail->EditValue ?>"<?php echo $client_edit->NextOfKinEmail->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_NextOfKinEmail">
<span<?php echo $client_edit->NextOfKinEmail->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->NextOfKinEmail->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" value="<?php echo HtmlEncode($client_edit->NextOfKinEmail->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->NextOfKinEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label id="elh_client_AdditionalInformation" for="x_AdditionalInformation" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->AdditionalInformation->caption() ?><?php echo $client_edit->AdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->AdditionalInformation->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_AdditionalInformation">
<textarea data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_edit->AdditionalInformation->getPlaceHolder()) ?>"<?php echo $client_edit->AdditionalInformation->editAttributes() ?>><?php echo $client_edit->AdditionalInformation->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_client_AdditionalInformation">
<span<?php echo $client_edit->AdditionalInformation->viewAttributes() ?>><?php echo $client_edit->AdditionalInformation->ViewValue ?></span>
</span>
<input type="hidden" data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" value="<?php echo HtmlEncode($client_edit->AdditionalInformation->FormValue) ?>">
<?php } ?>
<?php echo $client_edit->AdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($client->getCurrentDetailTable() != "") { ?>
<?php
	$client_edit->DetailPages->ValidKeys = explode(",", $client->getCurrentDetailTable());
	$firstActiveDetailTable = $client_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="client_edit_details"><!-- tabs -->
	<ul class="<?php echo $client_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property") {
			$firstActiveDetailTable = "property";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_edit->DetailPages->pageStyle("property") ?>" href="#tab_property" data-toggle="tab"><?php echo $Language->tablePhrase("property", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("property_revenu", explode(",", $client->getCurrentDetailTable())) && $property_revenu->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_revenu") {
			$firstActiveDetailTable = "property_revenu";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_edit->DetailPages->pageStyle("property_revenu") ?>" href="#tab_property_revenu" data-toggle="tab"><?php echo $Language->tablePhrase("property_revenu", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property")
			$firstActiveDetailTable = "property";
?>
		<div class="tab-pane <?php echo $client_edit->DetailPages->pageStyle("property") ?>" id="tab_property"><!-- page* -->
<?php include_once "propertygrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("property_revenu", explode(",", $client->getCurrentDetailTable())) && $property_revenu->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_revenu")
			$firstActiveDetailTable = "property_revenu";
?>
		<div class="tab-pane <?php echo $client_edit->DetailPages->pageStyle("property_revenu") ?>" id="tab_property_revenu"><!-- page* -->
<?php include_once "property_revenugrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$client_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$client->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$client_edit->IsModal) { ?>
<?php if (!$client->isConfirm()) { // Confirm page ?>
<?php echo $client_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$client_edit->showPageFooter();
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
$client_edit->terminate();
?>