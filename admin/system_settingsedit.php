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
$system_settings_edit = new system_settings_edit();

// Run the page
$system_settings_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$system_settings_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsystem_settingsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsystem_settingsedit = currentForm = new ew.Form("fsystem_settingsedit", "edit");

	// Validate form
	fsystem_settingsedit.validate = function() {
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
			<?php if ($system_settings_edit->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $system_settings_edit->name->caption(), $system_settings_edit->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($system_settings_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $system_settings_edit->_email->caption(), $system_settings_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($system_settings_edit->contact->Required) { ?>
				elm = this.getElements("x" + infix + "_contact");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $system_settings_edit->contact->caption(), $system_settings_edit->contact->RequiredErrorMessage)) ?>");
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
	fsystem_settingsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsystem_settingsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsystem_settingsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $system_settings_edit->showPageHeader(); ?>
<?php
$system_settings_edit->showMessage();
?>
<?php if (!$system_settings_edit->IsModal) { ?>
<?php if (!$system_settings->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $system_settings_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsystem_settingsedit" id="fsystem_settingsedit" class="<?php echo $system_settings_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="system_settings">
<?php if ($system_settings->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$system_settings_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($system_settings_edit->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_system_settings_name" for="x_name" class="<?php echo $system_settings_edit->LeftColumnClass ?>"><?php echo $system_settings_edit->name->caption() ?><?php echo $system_settings_edit->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $system_settings_edit->RightColumnClass ?>"><div <?php echo $system_settings_edit->name->cellAttributes() ?>>
<?php if (!$system_settings->isConfirm()) { ?>
<span id="el_system_settings_name">
<textarea data-table="system_settings" data-field="x_name" name="x_name" id="x_name" cols="35" rows="4" placeholder="<?php echo HtmlEncode($system_settings_edit->name->getPlaceHolder()) ?>"<?php echo $system_settings_edit->name->editAttributes() ?>><?php echo $system_settings_edit->name->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_system_settings_name">
<span<?php echo $system_settings_edit->name->viewAttributes() ?>><?php echo $system_settings_edit->name->ViewValue ?></span>
</span>
<input type="hidden" data-table="system_settings" data-field="x_name" name="x_name" id="x_name" value="<?php echo HtmlEncode($system_settings_edit->name->FormValue) ?>">
<?php } ?>
<?php echo $system_settings_edit->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($system_settings_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_system_settings__email" for="x__email" class="<?php echo $system_settings_edit->LeftColumnClass ?>"><?php echo $system_settings_edit->_email->caption() ?><?php echo $system_settings_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $system_settings_edit->RightColumnClass ?>"><div <?php echo $system_settings_edit->_email->cellAttributes() ?>>
<?php if (!$system_settings->isConfirm()) { ?>
<span id="el_system_settings__email">
<input type="text" data-table="system_settings" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($system_settings_edit->_email->getPlaceHolder()) ?>" value="<?php echo $system_settings_edit->_email->EditValue ?>"<?php echo $system_settings_edit->_email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_system_settings__email">
<span<?php echo $system_settings_edit->_email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($system_settings_edit->_email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="system_settings" data-field="x__email" name="x__email" id="x__email" value="<?php echo HtmlEncode($system_settings_edit->_email->FormValue) ?>">
<?php } ?>
<?php echo $system_settings_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($system_settings_edit->contact->Visible) { // contact ?>
	<div id="r_contact" class="form-group row">
		<label id="elh_system_settings_contact" for="x_contact" class="<?php echo $system_settings_edit->LeftColumnClass ?>"><?php echo $system_settings_edit->contact->caption() ?><?php echo $system_settings_edit->contact->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $system_settings_edit->RightColumnClass ?>"><div <?php echo $system_settings_edit->contact->cellAttributes() ?>>
<?php if (!$system_settings->isConfirm()) { ?>
<span id="el_system_settings_contact">
<input type="text" data-table="system_settings" data-field="x_contact" name="x_contact" id="x_contact" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($system_settings_edit->contact->getPlaceHolder()) ?>" value="<?php echo $system_settings_edit->contact->EditValue ?>"<?php echo $system_settings_edit->contact->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_system_settings_contact">
<span<?php echo $system_settings_edit->contact->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($system_settings_edit->contact->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="system_settings" data-field="x_contact" name="x_contact" id="x_contact" value="<?php echo HtmlEncode($system_settings_edit->contact->FormValue) ?>">
<?php } ?>
<?php echo $system_settings_edit->contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="system_settings" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($system_settings_edit->id->CurrentValue) ?>">
<?php if (!$system_settings_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $system_settings_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$system_settings->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $system_settings_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$system_settings_edit->IsModal) { ?>
<?php if (!$system_settings->isConfirm()) { // Confirm page ?>
<?php echo $system_settings_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$system_settings_edit->showPageFooter();
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
$system_settings_edit->terminate();
?>