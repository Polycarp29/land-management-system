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
$system_settings_add = new system_settings_add();

// Run the page
$system_settings_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$system_settings_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsystem_settingsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fsystem_settingsadd = currentForm = new ew.Form("fsystem_settingsadd", "add");

	// Validate form
	fsystem_settingsadd.validate = function() {
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
			<?php if ($system_settings_add->name->Required) { ?>
				elm = this.getElements("x" + infix + "_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $system_settings_add->name->caption(), $system_settings_add->name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($system_settings_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $system_settings_add->_email->caption(), $system_settings_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($system_settings_add->contact->Required) { ?>
				elm = this.getElements("x" + infix + "_contact");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $system_settings_add->contact->caption(), $system_settings_add->contact->RequiredErrorMessage)) ?>");
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
	fsystem_settingsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsystem_settingsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsystem_settingsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $system_settings_add->showPageHeader(); ?>
<?php
$system_settings_add->showMessage();
?>
<form name="fsystem_settingsadd" id="fsystem_settingsadd" class="<?php echo $system_settings_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="system_settings">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$system_settings_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($system_settings_add->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_system_settings_name" for="x_name" class="<?php echo $system_settings_add->LeftColumnClass ?>"><?php echo $system_settings_add->name->caption() ?><?php echo $system_settings_add->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $system_settings_add->RightColumnClass ?>"><div <?php echo $system_settings_add->name->cellAttributes() ?>>
<span id="el_system_settings_name">
<textarea data-table="system_settings" data-field="x_name" name="x_name" id="x_name" cols="35" rows="4" placeholder="<?php echo HtmlEncode($system_settings_add->name->getPlaceHolder()) ?>"<?php echo $system_settings_add->name->editAttributes() ?>><?php echo $system_settings_add->name->EditValue ?></textarea>
</span>
<?php echo $system_settings_add->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($system_settings_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_system_settings__email" for="x__email" class="<?php echo $system_settings_add->LeftColumnClass ?>"><?php echo $system_settings_add->_email->caption() ?><?php echo $system_settings_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $system_settings_add->RightColumnClass ?>"><div <?php echo $system_settings_add->_email->cellAttributes() ?>>
<span id="el_system_settings__email">
<input type="text" data-table="system_settings" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($system_settings_add->_email->getPlaceHolder()) ?>" value="<?php echo $system_settings_add->_email->EditValue ?>"<?php echo $system_settings_add->_email->editAttributes() ?>>
</span>
<?php echo $system_settings_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($system_settings_add->contact->Visible) { // contact ?>
	<div id="r_contact" class="form-group row">
		<label id="elh_system_settings_contact" for="x_contact" class="<?php echo $system_settings_add->LeftColumnClass ?>"><?php echo $system_settings_add->contact->caption() ?><?php echo $system_settings_add->contact->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $system_settings_add->RightColumnClass ?>"><div <?php echo $system_settings_add->contact->cellAttributes() ?>>
<span id="el_system_settings_contact">
<input type="text" data-table="system_settings" data-field="x_contact" name="x_contact" id="x_contact" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($system_settings_add->contact->getPlaceHolder()) ?>" value="<?php echo $system_settings_add->contact->EditValue ?>"<?php echo $system_settings_add->contact->editAttributes() ?>>
</span>
<?php echo $system_settings_add->contact->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$system_settings_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $system_settings_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $system_settings_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$system_settings_add->showPageFooter();
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
$system_settings_add->terminate();
?>