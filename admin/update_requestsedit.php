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
$update_requests_edit = new update_requests_edit();

// Run the page
$update_requests_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$update_requests_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fupdate_requestsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fupdate_requestsedit = currentForm = new ew.Form("fupdate_requestsedit", "edit");

	// Validate form
	fupdate_requestsedit.validate = function() {
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
			<?php if ($update_requests_edit->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->ClientId->caption(), $update_requests_edit->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->NewClientIdentity->Required) { ?>
				elm = this.getElements("x" + infix + "_NewClientIdentity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->NewClientIdentity->caption(), $update_requests_edit->NewClientIdentity->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->NewClientName->Required) { ?>
				elm = this.getElements("x" + infix + "_NewClientName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->NewClientName->caption(), $update_requests_edit->NewClientName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->NewAccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_NewAccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->NewAccountType->caption(), $update_requests_edit->NewAccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewAccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($update_requests_edit->NewAccountType->errorMessage()) ?>");
			<?php if ($update_requests_edit->NewMobileNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_NewMobileNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->NewMobileNumber->caption(), $update_requests_edit->NewMobileNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->NewEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NewEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->NewEmail->caption(), $update_requests_edit->NewEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($update_requests_edit->NewEmail->errorMessage()) ?>");
			<?php if ($update_requests_edit->NewAdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_NewAdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->NewAdditionalInformation->caption(), $update_requests_edit->NewAdditionalInformation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->date->Required) { ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->date->caption(), $update_requests_edit->date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_date");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($update_requests_edit->date->errorMessage()) ?>");
			<?php if ($update_requests_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->status->caption(), $update_requests_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->Property->Required) { ?>
				elm = this.getElements("x" + infix + "_Property");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->Property->caption(), $update_requests_edit->Property->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->PropertyId->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->PropertyId->caption(), $update_requests_edit->PropertyId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->PropertyUse->caption(), $update_requests_edit->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($update_requests_edit->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $update_requests_edit->Comment->caption(), $update_requests_edit->Comment->RequiredErrorMessage)) ?>");
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
	fupdate_requestsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fupdate_requestsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fupdate_requestsedit.lists["x_ClientId"] = <?php echo $update_requests_edit->ClientId->Lookup->toClientList($update_requests_edit) ?>;
	fupdate_requestsedit.lists["x_ClientId"].options = <?php echo JsonEncode($update_requests_edit->ClientId->lookupOptions()) ?>;
	fupdate_requestsedit.lists["x_status"] = <?php echo $update_requests_edit->status->Lookup->toClientList($update_requests_edit) ?>;
	fupdate_requestsedit.lists["x_status"].options = <?php echo JsonEncode($update_requests_edit->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fupdate_requestsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $update_requests_edit->showPageHeader(); ?>
<?php
$update_requests_edit->showMessage();
?>
<?php if (!$update_requests_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $update_requests_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fupdate_requestsedit" id="fupdate_requestsedit" class="<?php echo $update_requests_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="update_requests">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$update_requests_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($update_requests_edit->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_update_requests_ClientId" for="x_ClientId" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->ClientId->caption() ?><?php echo $update_requests_edit->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->ClientId->cellAttributes() ?>>
<span id="el_update_requests_ClientId">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientId"><?php echo EmptyValue(strval($update_requests_edit->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $update_requests_edit->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($update_requests_edit->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($update_requests_edit->ClientId->ReadOnly || $update_requests_edit->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $update_requests_edit->ClientId->Lookup->getParamTag($update_requests_edit, "p_x_ClientId") ?>
<input type="hidden" data-table="update_requests" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $update_requests_edit->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo $update_requests_edit->ClientId->CurrentValue ?>"<?php echo $update_requests_edit->ClientId->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->NewClientIdentity->Visible) { // NewClientIdentity ?>
	<div id="r_NewClientIdentity" class="form-group row">
		<label id="elh_update_requests_NewClientIdentity" for="x_NewClientIdentity" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->NewClientIdentity->caption() ?><?php echo $update_requests_edit->NewClientIdentity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->NewClientIdentity->cellAttributes() ?>>
<span id="el_update_requests_NewClientIdentity">
<input type="text" data-table="update_requests" data-field="x_NewClientIdentity" name="x_NewClientIdentity" id="x_NewClientIdentity" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($update_requests_edit->NewClientIdentity->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->NewClientIdentity->EditValue ?>"<?php echo $update_requests_edit->NewClientIdentity->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->NewClientIdentity->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->NewClientName->Visible) { // NewClientName ?>
	<div id="r_NewClientName" class="form-group row">
		<label id="elh_update_requests_NewClientName" for="x_NewClientName" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->NewClientName->caption() ?><?php echo $update_requests_edit->NewClientName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->NewClientName->cellAttributes() ?>>
<span id="el_update_requests_NewClientName">
<input type="text" data-table="update_requests" data-field="x_NewClientName" name="x_NewClientName" id="x_NewClientName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($update_requests_edit->NewClientName->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->NewClientName->EditValue ?>"<?php echo $update_requests_edit->NewClientName->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->NewClientName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->NewAccountType->Visible) { // NewAccountType ?>
	<div id="r_NewAccountType" class="form-group row">
		<label id="elh_update_requests_NewAccountType" for="x_NewAccountType" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->NewAccountType->caption() ?><?php echo $update_requests_edit->NewAccountType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->NewAccountType->cellAttributes() ?>>
<span id="el_update_requests_NewAccountType">
<input type="text" data-table="update_requests" data-field="x_NewAccountType" name="x_NewAccountType" id="x_NewAccountType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($update_requests_edit->NewAccountType->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->NewAccountType->EditValue ?>"<?php echo $update_requests_edit->NewAccountType->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->NewAccountType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->NewMobileNumber->Visible) { // NewMobileNumber ?>
	<div id="r_NewMobileNumber" class="form-group row">
		<label id="elh_update_requests_NewMobileNumber" for="x_NewMobileNumber" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->NewMobileNumber->caption() ?><?php echo $update_requests_edit->NewMobileNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->NewMobileNumber->cellAttributes() ?>>
<span id="el_update_requests_NewMobileNumber">
<input type="text" data-table="update_requests" data-field="x_NewMobileNumber" name="x_NewMobileNumber" id="x_NewMobileNumber" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($update_requests_edit->NewMobileNumber->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->NewMobileNumber->EditValue ?>"<?php echo $update_requests_edit->NewMobileNumber->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->NewMobileNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->NewEmail->Visible) { // NewEmail ?>
	<div id="r_NewEmail" class="form-group row">
		<label id="elh_update_requests_NewEmail" for="x_NewEmail" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->NewEmail->caption() ?><?php echo $update_requests_edit->NewEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->NewEmail->cellAttributes() ?>>
<span id="el_update_requests_NewEmail">
<input type="text" data-table="update_requests" data-field="x_NewEmail" name="x_NewEmail" id="x_NewEmail" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($update_requests_edit->NewEmail->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->NewEmail->EditValue ?>"<?php echo $update_requests_edit->NewEmail->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->NewEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->NewAdditionalInformation->Visible) { // NewAdditionalInformation ?>
	<div id="r_NewAdditionalInformation" class="form-group row">
		<label id="elh_update_requests_NewAdditionalInformation" for="x_NewAdditionalInformation" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->NewAdditionalInformation->caption() ?><?php echo $update_requests_edit->NewAdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->NewAdditionalInformation->cellAttributes() ?>>
<span id="el_update_requests_NewAdditionalInformation">
<textarea data-table="update_requests" data-field="x_NewAdditionalInformation" name="x_NewAdditionalInformation" id="x_NewAdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($update_requests_edit->NewAdditionalInformation->getPlaceHolder()) ?>"<?php echo $update_requests_edit->NewAdditionalInformation->editAttributes() ?>><?php echo $update_requests_edit->NewAdditionalInformation->EditValue ?></textarea>
</span>
<?php echo $update_requests_edit->NewAdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->date->Visible) { // date ?>
	<div id="r_date" class="form-group row">
		<label id="elh_update_requests_date" for="x_date" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->date->caption() ?><?php echo $update_requests_edit->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->date->cellAttributes() ?>>
<span id="el_update_requests_date">
<input type="text" data-table="update_requests" data-field="x_date" data-format="7" name="x_date" id="x_date" maxlength="19" placeholder="<?php echo HtmlEncode($update_requests_edit->date->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->date->EditValue ?>"<?php echo $update_requests_edit->date->editAttributes() ?>>
<?php if (!$update_requests_edit->date->ReadOnly && !$update_requests_edit->date->Disabled && !isset($update_requests_edit->date->EditAttrs["readonly"]) && !isset($update_requests_edit->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fupdate_requestsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fupdate_requestsedit", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $update_requests_edit->date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_update_requests_status" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->status->caption() ?><?php echo $update_requests_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->status->cellAttributes() ?>>
<span id="el_update_requests_status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($update_requests_edit->status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $update_requests_edit->status->ViewValue ?></button>
		<div id="dsl_x_status" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $update_requests_edit->status->radioButtonListHtml(TRUE, "x_status") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="update_requests" data-field="x_status" data-value-separator="<?php echo $update_requests_edit->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $update_requests_edit->status->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$update_requests_edit->status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php echo $update_requests_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->Property->Visible) { // Property ?>
	<div id="r_Property" class="form-group row">
		<label id="elh_update_requests_Property" for="x_Property" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->Property->caption() ?><?php echo $update_requests_edit->Property->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->Property->cellAttributes() ?>>
<span id="el_update_requests_Property">
<input type="text" data-table="update_requests" data-field="x_Property" name="x_Property" id="x_Property" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($update_requests_edit->Property->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->Property->EditValue ?>"<?php echo $update_requests_edit->Property->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->Property->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->PropertyId->Visible) { // PropertyId ?>
	<div id="r_PropertyId" class="form-group row">
		<label id="elh_update_requests_PropertyId" for="x_PropertyId" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->PropertyId->caption() ?><?php echo $update_requests_edit->PropertyId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->PropertyId->cellAttributes() ?>>
<span id="el_update_requests_PropertyId">
<input type="text" data-table="update_requests" data-field="x_PropertyId" name="x_PropertyId" id="x_PropertyId" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($update_requests_edit->PropertyId->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->PropertyId->EditValue ?>"<?php echo $update_requests_edit->PropertyId->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->PropertyId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_update_requests_PropertyUse" for="x_PropertyUse" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->PropertyUse->caption() ?><?php echo $update_requests_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->PropertyUse->cellAttributes() ?>>
<span id="el_update_requests_PropertyUse">
<input type="text" data-table="update_requests" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($update_requests_edit->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->PropertyUse->EditValue ?>"<?php echo $update_requests_edit->PropertyUse->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($update_requests_edit->Comment->Visible) { // Comment ?>
	<div id="r_Comment" class="form-group row">
		<label id="elh_update_requests_Comment" for="x_Comment" class="<?php echo $update_requests_edit->LeftColumnClass ?>"><?php echo $update_requests_edit->Comment->caption() ?><?php echo $update_requests_edit->Comment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $update_requests_edit->RightColumnClass ?>"><div <?php echo $update_requests_edit->Comment->cellAttributes() ?>>
<span id="el_update_requests_Comment">
<input type="text" data-table="update_requests" data-field="x_Comment" name="x_Comment" id="x_Comment" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($update_requests_edit->Comment->getPlaceHolder()) ?>" value="<?php echo $update_requests_edit->Comment->EditValue ?>"<?php echo $update_requests_edit->Comment->editAttributes() ?>>
</span>
<?php echo $update_requests_edit->Comment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="update_requests" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($update_requests_edit->id->CurrentValue) ?>">
<?php if (!$update_requests_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $update_requests_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $update_requests_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$update_requests_edit->IsModal) { ?>
<?php echo $update_requests_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$update_requests_edit->showPageFooter();
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
$update_requests_edit->terminate();
?>