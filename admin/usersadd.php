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
$users_add = new users_add();

// Run the page
$users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fusersadd = currentForm = new ew.Form("fusersadd", "add");

	// Validate form
	fusersadd.validate = function() {
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
			<?php if ($users_add->Fullname->Required) { ?>
				elm = this.getElements("x" + infix + "_Fullname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->Fullname->caption(), $users_add->Fullname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->Username->Required) { ?>
				elm = this.getElements("x" + infix + "_Username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->Username->caption(), $users_add->Username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->_Email->caption(), $users_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->Passsword->Required) { ?>
				elm = this.getElements("x" + infix + "_Passsword");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->Passsword->caption(), $users_add->Passsword->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Passsword");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($users_add->userLevelId->Required) { ?>
				elm = this.getElements("x" + infix + "_userLevelId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->userLevelId->caption(), $users_add->userLevelId->RequiredErrorMessage)) ?>");
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
	fusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersadd.lists["x_userLevelId"] = <?php echo $users_add->userLevelId->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_userLevelId"].options = <?php echo JsonEncode($users_add->userLevelId->lookupOptions()) ?>;
	loadjs.done("fusersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_add->showPageHeader(); ?>
<?php
$users_add->showMessage();
?>
<form name="fusersadd" id="fusersadd" class="<?php echo $users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($users_add->Fullname->Visible) { // Fullname ?>
	<div id="r_Fullname" class="form-group row">
		<label id="elh_users_Fullname" for="x_Fullname" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->Fullname->caption() ?><?php echo $users_add->Fullname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->Fullname->cellAttributes() ?>>
<span id="el_users_Fullname">
<input type="text" data-table="users" data-field="x_Fullname" name="x_Fullname" id="x_Fullname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_add->Fullname->getPlaceHolder()) ?>" value="<?php echo $users_add->Fullname->EditValue ?>"<?php echo $users_add->Fullname->editAttributes() ?>>
</span>
<?php echo $users_add->Fullname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->Username->Visible) { // Username ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_users_Username" for="x_Username" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->Username->caption() ?><?php echo $users_add->Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->Username->cellAttributes() ?>>
<span id="el_users_Username">
<input type="text" data-table="users" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_add->Username->getPlaceHolder()) ?>" value="<?php echo $users_add->Username->EditValue ?>"<?php echo $users_add->Username->editAttributes() ?>>
</span>
<?php echo $users_add->Username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_users__Email" for="x__Email" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->_Email->caption() ?><?php echo $users_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->_Email->cellAttributes() ?>>
<span id="el_users__Email">
<input type="text" data-table="users" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_add->_Email->getPlaceHolder()) ?>" value="<?php echo $users_add->_Email->EditValue ?>"<?php echo $users_add->_Email->editAttributes() ?>>
</span>
<?php echo $users_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->Passsword->Visible) { // Passsword ?>
	<div id="r_Passsword" class="form-group row">
		<label id="elh_users_Passsword" for="x_Passsword" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->Passsword->caption() ?><?php echo $users_add->Passsword->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->Passsword->cellAttributes() ?>>
<span id="el_users_Passsword">
<div class="input-group" id="ig_Passsword">
<input type="password" autocomplete="new-password" data-password-strength="pst_Passsword" data-table="users" data-field="x_Passsword" name="x_Passsword" id="x_Passsword" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_add->Passsword->getPlaceHolder()) ?>"<?php echo $users_add->Passsword->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_Passsword" data-password-confirm="c_Passsword" data-password-strength="pst_Passsword"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_Passsword">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $users_add->Passsword->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->userLevelId->Visible) { // userLevelId ?>
	<div id="r_userLevelId" class="form-group row">
		<label id="elh_users_userLevelId" for="x_userLevelId" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->userLevelId->caption() ?><?php echo $users_add->userLevelId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->userLevelId->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_userLevelId">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_add->userLevelId->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_users_userLevelId">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_userLevelId" data-value-separator="<?php echo $users_add->userLevelId->displayValueSeparatorAttribute() ?>" id="x_userLevelId" name="x_userLevelId"<?php echo $users_add->userLevelId->editAttributes() ?>>
			<?php echo $users_add->userLevelId->selectOptionListHtml("x_userLevelId") ?>
		</select>
</div>
<?php echo $users_add->userLevelId->Lookup->getParamTag($users_add, "p_x_userLevelId") ?>
</span>
<?php } ?>
<?php echo $users_add->userLevelId->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_add->showPageFooter();
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
$users_add->terminate();
?>