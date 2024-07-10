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
$client_add = new client_add();

// Run the page
$client_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fclientadd = currentForm = new ew.Form("fclientadd", "add");

	// Validate form
	fclientadd.validate = function() {
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
			<?php if ($client_add->ClientName->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->ClientName->caption(), $client_add->ClientName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->ClientType->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->ClientType->caption(), $client_add->ClientType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->IdentityType->Required) { ?>
				elm = this.getElements("x" + infix + "_IdentityType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->IdentityType->caption(), $client_add->IdentityType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->ClientID->caption(), $client_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Surname->caption(), $client_add->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->FirstName->caption(), $client_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->MiddleName->caption(), $client_add->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Gender->Required) { ?>
				elm = this.getElements("x" + infix + "_Gender");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Gender->caption(), $client_add->Gender->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->MaritalStatus->caption(), $client_add->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->DateOfBirth->caption(), $client_add->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_add->DateOfBirth->errorMessage()) ?>");
			<?php if ($client_add->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->PostalAddress->caption(), $client_add->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->PhysicalAddress->caption(), $client_add->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->TownOrVillage->caption(), $client_add->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Mobile->caption(), $client_add->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->_Email->caption(), $client_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->NextOfKin->caption(), $client_add->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->NextOfKinMobile->caption(), $client_add->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->NextOfKinEmail->caption(), $client_add->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->AdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_AdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->AdditionalInformation->caption(), $client_add->AdditionalInformation->RequiredErrorMessage)) ?>");
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
	fclientadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclientadd.lists["x_ClientType"] = <?php echo $client_add->ClientType->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_ClientType"].options = <?php echo JsonEncode($client_add->ClientType->lookupOptions()) ?>;
	fclientadd.lists["x_IdentityType"] = <?php echo $client_add->IdentityType->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_IdentityType"].options = <?php echo JsonEncode($client_add->IdentityType->options(FALSE, TRUE)) ?>;
	fclientadd.lists["x_Gender"] = <?php echo $client_add->Gender->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_Gender"].options = <?php echo JsonEncode($client_add->Gender->options(FALSE, TRUE)) ?>;
	fclientadd.lists["x_MaritalStatus"] = <?php echo $client_add->MaritalStatus->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_MaritalStatus"].options = <?php echo JsonEncode($client_add->MaritalStatus->options(FALSE, TRUE)) ?>;
	loadjs.done("fclientadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_add->showPageHeader(); ?>
<?php
$client_add->showMessage();
?>
<form name="fclientadd" id="fclientadd" class="<?php echo $client_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<?php if ($client->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$client_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($client_add->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label id="elh_client_ClientName" for="x_ClientName" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->ClientName->caption() ?><?php echo $client_add->ClientName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->ClientName->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_ClientName">
<input type="text" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->ClientName->getPlaceHolder()) ?>" value="<?php echo $client_add->ClientName->EditValue ?>"<?php echo $client_add->ClientName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_ClientName">
<span<?php echo $client_add->ClientName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->ClientName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" value="<?php echo HtmlEncode($client_add->ClientName->FormValue) ?>">
<?php } ?>
<?php echo $client_add->ClientName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->ClientType->Visible) { // ClientType ?>
	<div id="r_ClientType" class="form-group row">
		<label id="elh_client_ClientType" for="x_ClientType" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->ClientType->caption() ?><?php echo $client_add->ClientType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->ClientType->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_ClientType">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientType"><?php echo EmptyValue(strval($client_add->ClientType->ViewValue)) ? $Language->phrase("PleaseSelect") : $client_add->ClientType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($client_add->ClientType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($client_add->ClientType->ReadOnly || $client_add->ClientType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $client_add->ClientType->Lookup->getParamTag($client_add, "p_x_ClientType") ?>
<input type="hidden" data-table="client" data-field="x_ClientType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $client_add->ClientType->displayValueSeparatorAttribute() ?>" name="x_ClientType" id="x_ClientType" value="<?php echo $client_add->ClientType->CurrentValue ?>"<?php echo $client_add->ClientType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_ClientType">
<span<?php echo $client_add->ClientType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->ClientType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientType" name="x_ClientType" id="x_ClientType" value="<?php echo HtmlEncode($client_add->ClientType->FormValue) ?>">
<?php } ?>
<?php echo $client_add->ClientType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->IdentityType->Visible) { // IdentityType ?>
	<div id="r_IdentityType" class="form-group row">
		<label id="elh_client_IdentityType" for="x_IdentityType" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->IdentityType->caption() ?><?php echo $client_add->IdentityType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->IdentityType->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_IdentityType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_IdentityType" data-value-separator="<?php echo $client_add->IdentityType->displayValueSeparatorAttribute() ?>" id="x_IdentityType" name="x_IdentityType"<?php echo $client_add->IdentityType->editAttributes() ?>>
			<?php echo $client_add->IdentityType->selectOptionListHtml("x_IdentityType") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_client_IdentityType">
<span<?php echo $client_add->IdentityType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->IdentityType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_IdentityType" name="x_IdentityType" id="x_IdentityType" value="<?php echo HtmlEncode($client_add->IdentityType->FormValue) ?>">
<?php } ?>
<?php echo $client_add->IdentityType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_client_ClientID" for="x_ClientID" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->ClientID->caption() ?><?php echo $client_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->ClientID->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_ClientID">
<input type="text" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($client_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $client_add->ClientID->EditValue ?>"<?php echo $client_add->ClientID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_ClientID">
<span<?php echo $client_add->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" value="<?php echo HtmlEncode($client_add->ClientID->FormValue) ?>">
<?php } ?>
<?php echo $client_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_client_Surname" for="x_Surname" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Surname->caption() ?><?php echo $client_add->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Surname->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_Surname">
<input type="text" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->Surname->getPlaceHolder()) ?>" value="<?php echo $client_add->Surname->EditValue ?>"<?php echo $client_add->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_Surname">
<span<?php echo $client_add->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" value="<?php echo HtmlEncode($client_add->Surname->FormValue) ?>">
<?php } ?>
<?php echo $client_add->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_client_FirstName" for="x_FirstName" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->FirstName->caption() ?><?php echo $client_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->FirstName->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_FirstName">
<input type="text" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $client_add->FirstName->EditValue ?>"<?php echo $client_add->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_FirstName">
<span<?php echo $client_add->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" value="<?php echo HtmlEncode($client_add->FirstName->FormValue) ?>">
<?php } ?>
<?php echo $client_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_client_MiddleName" for="x_MiddleName" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->MiddleName->caption() ?><?php echo $client_add->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->MiddleName->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_MiddleName">
<input type="text" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($client_add->MiddleName->getPlaceHolder()) ?>" value="<?php echo $client_add->MiddleName->EditValue ?>"<?php echo $client_add->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_MiddleName">
<span<?php echo $client_add->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" value="<?php echo HtmlEncode($client_add->MiddleName->FormValue) ?>">
<?php } ?>
<?php echo $client_add->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Gender->Visible) { // Gender ?>
	<div id="r_Gender" class="form-group row">
		<label id="elh_client_Gender" for="x_Gender" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Gender->caption() ?><?php echo $client_add->Gender->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Gender->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_Gender">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Gender" data-value-separator="<?php echo $client_add->Gender->displayValueSeparatorAttribute() ?>" id="x_Gender" name="x_Gender"<?php echo $client_add->Gender->editAttributes() ?>>
			<?php echo $client_add->Gender->selectOptionListHtml("x_Gender") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_client_Gender">
<span<?php echo $client_add->Gender->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->Gender->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_Gender" name="x_Gender" id="x_Gender" value="<?php echo HtmlEncode($client_add->Gender->FormValue) ?>">
<?php } ?>
<?php echo $client_add->Gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_client_MaritalStatus" for="x_MaritalStatus" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->MaritalStatus->caption() ?><?php echo $client_add->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->MaritalStatus->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_MaritalStatus" data-value-separator="<?php echo $client_add->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $client_add->MaritalStatus->editAttributes() ?>>
			<?php echo $client_add->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_client_MaritalStatus">
<span<?php echo $client_add->MaritalStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->MaritalStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_MaritalStatus" name="x_MaritalStatus" id="x_MaritalStatus" value="<?php echo HtmlEncode($client_add->MaritalStatus->FormValue) ?>">
<?php } ?>
<?php echo $client_add->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_client_DateOfBirth" for="x_DateOfBirth" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->DateOfBirth->caption() ?><?php echo $client_add->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->DateOfBirth->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_DateOfBirth">
<input type="text" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" maxlength="10" placeholder="<?php echo HtmlEncode($client_add->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $client_add->DateOfBirth->EditValue ?>"<?php echo $client_add->DateOfBirth->editAttributes() ?>>
<?php if (!$client_add->DateOfBirth->ReadOnly && !$client_add->DateOfBirth->Disabled && !isset($client_add->DateOfBirth->EditAttrs["readonly"]) && !isset($client_add->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fclientadd", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_client_DateOfBirth">
<span<?php echo $client_add->DateOfBirth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->DateOfBirth->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" value="<?php echo HtmlEncode($client_add->DateOfBirth->FormValue) ?>">
<?php } ?>
<?php echo $client_add->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_client_PostalAddress" for="x_PostalAddress" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->PostalAddress->caption() ?><?php echo $client_add->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->PostalAddress->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_PostalAddress">
<input type="text" data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $client_add->PostalAddress->EditValue ?>"<?php echo $client_add->PostalAddress->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_PostalAddress">
<span<?php echo $client_add->PostalAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->PostalAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" value="<?php echo HtmlEncode($client_add->PostalAddress->FormValue) ?>">
<?php } ?>
<?php echo $client_add->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_client_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->PhysicalAddress->caption() ?><?php echo $client_add->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->PhysicalAddress->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_PhysicalAddress">
<input type="text" data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $client_add->PhysicalAddress->EditValue ?>"<?php echo $client_add->PhysicalAddress->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_PhysicalAddress">
<span<?php echo $client_add->PhysicalAddress->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->PhysicalAddress->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" value="<?php echo HtmlEncode($client_add->PhysicalAddress->FormValue) ?>">
<?php } ?>
<?php echo $client_add->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_client_TownOrVillage" for="x_TownOrVillage" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->TownOrVillage->caption() ?><?php echo $client_add->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->TownOrVillage->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_TownOrVillage">
<input type="text" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $client_add->TownOrVillage->EditValue ?>"<?php echo $client_add->TownOrVillage->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_TownOrVillage">
<span<?php echo $client_add->TownOrVillage->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->TownOrVillage->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" value="<?php echo HtmlEncode($client_add->TownOrVillage->FormValue) ?>">
<?php } ?>
<?php echo $client_add->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_client_Mobile" for="x_Mobile" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Mobile->caption() ?><?php echo $client_add->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Mobile->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_Mobile">
<input type="text" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->Mobile->getPlaceHolder()) ?>" value="<?php echo $client_add->Mobile->EditValue ?>"<?php echo $client_add->Mobile->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_Mobile">
<span<?php echo $client_add->Mobile->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->Mobile->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" value="<?php echo HtmlEncode($client_add->Mobile->FormValue) ?>">
<?php } ?>
<?php echo $client_add->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_client__Email" for="x__Email" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->_Email->caption() ?><?php echo $client_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->_Email->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client__Email">
<input type="text" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->_Email->getPlaceHolder()) ?>" value="<?php echo $client_add->_Email->EditValue ?>"<?php echo $client_add->_Email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client__Email">
<span<?php echo $client_add->_Email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->_Email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" value="<?php echo HtmlEncode($client_add->_Email->FormValue) ?>">
<?php } ?>
<?php echo $client_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label id="elh_client_NextOfKin" for="x_NextOfKin" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->NextOfKin->caption() ?><?php echo $client_add->NextOfKin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->NextOfKin->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_NextOfKin">
<input type="text" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $client_add->NextOfKin->EditValue ?>"<?php echo $client_add->NextOfKin->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_NextOfKin">
<span<?php echo $client_add->NextOfKin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->NextOfKin->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" value="<?php echo HtmlEncode($client_add->NextOfKin->FormValue) ?>">
<?php } ?>
<?php echo $client_add->NextOfKin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label id="elh_client_NextOfKinMobile" for="x_NextOfKinMobile" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->NextOfKinMobile->caption() ?><?php echo $client_add->NextOfKinMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->NextOfKinMobile->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_NextOfKinMobile">
<input type="text" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $client_add->NextOfKinMobile->EditValue ?>"<?php echo $client_add->NextOfKinMobile->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_NextOfKinMobile">
<span<?php echo $client_add->NextOfKinMobile->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->NextOfKinMobile->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" value="<?php echo HtmlEncode($client_add->NextOfKinMobile->FormValue) ?>">
<?php } ?>
<?php echo $client_add->NextOfKinMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label id="elh_client_NextOfKinEmail" for="x_NextOfKinEmail" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->NextOfKinEmail->caption() ?><?php echo $client_add->NextOfKinEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->NextOfKinEmail->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_NextOfKinEmail">
<input type="text" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $client_add->NextOfKinEmail->EditValue ?>"<?php echo $client_add->NextOfKinEmail->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_client_NextOfKinEmail">
<span<?php echo $client_add->NextOfKinEmail->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_add->NextOfKinEmail->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" value="<?php echo HtmlEncode($client_add->NextOfKinEmail->FormValue) ?>">
<?php } ?>
<?php echo $client_add->NextOfKinEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label id="elh_client_AdditionalInformation" for="x_AdditionalInformation" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->AdditionalInformation->caption() ?><?php echo $client_add->AdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->AdditionalInformation->cellAttributes() ?>>
<?php if (!$client->isConfirm()) { ?>
<span id="el_client_AdditionalInformation">
<textarea data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_add->AdditionalInformation->getPlaceHolder()) ?>"<?php echo $client_add->AdditionalInformation->editAttributes() ?>><?php echo $client_add->AdditionalInformation->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_client_AdditionalInformation">
<span<?php echo $client_add->AdditionalInformation->viewAttributes() ?>><?php echo $client_add->AdditionalInformation->ViewValue ?></span>
</span>
<input type="hidden" data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" value="<?php echo HtmlEncode($client_add->AdditionalInformation->FormValue) ?>">
<?php } ?>
<?php echo $client_add->AdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($client->getCurrentDetailTable() != "") { ?>
<?php
	$client_add->DetailPages->ValidKeys = explode(",", $client->getCurrentDetailTable());
	$firstActiveDetailTable = $client_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="client_add_details"><!-- tabs -->
	<ul class="<?php echo $client_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property") {
			$firstActiveDetailTable = "property";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_add->DetailPages->pageStyle("property") ?>" href="#tab_property" data-toggle="tab"><?php echo $Language->tablePhrase("property", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("property_revenu", explode(",", $client->getCurrentDetailTable())) && $property_revenu->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_revenu") {
			$firstActiveDetailTable = "property_revenu";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_add->DetailPages->pageStyle("property_revenu") ?>" href="#tab_property_revenu" data-toggle="tab"><?php echo $Language->tablePhrase("property_revenu", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property")
			$firstActiveDetailTable = "property";
?>
		<div class="tab-pane <?php echo $client_add->DetailPages->pageStyle("property") ?>" id="tab_property"><!-- page* -->
<?php include_once "propertygrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("property_revenu", explode(",", $client->getCurrentDetailTable())) && $property_revenu->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_revenu")
			$firstActiveDetailTable = "property_revenu";
?>
		<div class="tab-pane <?php echo $client_add->DetailPages->pageStyle("property_revenu") ?>" id="tab_property_revenu"><!-- page* -->
<?php include_once "property_revenugrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$client_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$client->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$client_add->showPageFooter();
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
$client_add->terminate();
?>