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
$users_edit = new users_edit();

// Run the page
$users_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusersedit = currentForm = new ew.Form("fusersedit", "edit");

	// Validate form
	fusersedit.validate = function() {
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
			<?php if ($users_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->id->caption(), $users_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Fullname->Required) { ?>
				elm = this.getElements("x" + infix + "_Fullname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Fullname->caption(), $users_edit->Fullname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Username->Required) { ?>
				elm = this.getElements("x" + infix + "_Username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Username->caption(), $users_edit->Username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->_Email->caption(), $users_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->Passsword->Required) { ?>
				elm = this.getElements("x" + infix + "_Passsword");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->Passsword->caption(), $users_edit->Passsword->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Passsword");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($users_edit->userLevelId->Required) { ?>
				elm = this.getElements("x" + infix + "_userLevelId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->userLevelId->caption(), $users_edit->userLevelId->RequiredErrorMessage)) ?>");
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
	fusersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersedit.lists["x_userLevelId"] = <?php echo $users_edit->userLevelId->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_userLevelId"].options = <?php echo JsonEncode($users_edit->userLevelId->lookupOptions()) ?>;
	loadjs.done("fusersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_edit->showPageHeader(); ?>
<?php
$users_edit->showMessage();
?>
<?php if (!$users_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $users_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fusersedit" id="fusersedit" class="<?php echo $users_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$users_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($users_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_users_id" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->id->caption() ?><?php echo $users_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->id->cellAttributes() ?>>
<span id="el_users_id">
<span<?php echo $users_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($users_edit->id->CurrentValue) ?>">
<?php echo $users_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Fullname->Visible) { // Fullname ?>
	<div id="r_Fullname" class="form-group row">
		<label id="elh_users_Fullname" for="x_Fullname" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Fullname->caption() ?><?php echo $users_edit->Fullname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Fullname->cellAttributes() ?>>
<span id="el_users_Fullname">
<input type="text" data-table="users" data-field="x_Fullname" name="x_Fullname" id="x_Fullname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_edit->Fullname->getPlaceHolder()) ?>" value="<?php echo $users_edit->Fullname->EditValue ?>"<?php echo $users_edit->Fullname->editAttributes() ?>>
</span>
<?php echo $users_edit->Fullname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Username->Visible) { // Username ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_users_Username" for="x_Username" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Username->caption() ?><?php echo $users_edit->Username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Username->cellAttributes() ?>>
<span id="el_users_Username">
<input type="text" data-table="users" data-field="x_Username" name="x_Username" id="x_Username" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_edit->Username->getPlaceHolder()) ?>" value="<?php echo $users_edit->Username->EditValue ?>"<?php echo $users_edit->Username->editAttributes() ?>>
</span>
<?php echo $users_edit->Username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_users__Email" for="x__Email" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->_Email->caption() ?><?php echo $users_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->_Email->cellAttributes() ?>>
<span id="el_users__Email">
<input type="text" data-table="users" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($users_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $users_edit->_Email->EditValue ?>"<?php echo $users_edit->_Email->editAttributes() ?>>
</span>
<?php echo $users_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->Passsword->Visible) { // Passsword ?>
	<div id="r_Passsword" class="form-group row">
		<label id="elh_users_Passsword" for="x_Passsword" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->Passsword->caption() ?><?php echo $users_edit->Passsword->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->Passsword->cellAttributes() ?>>
<span id="el_users_Passsword">
<div class="input-group" id="ig_Passsword">
<input type="password" autocomplete="new-password" data-password-strength="pst_Passsword" data-table="users" data-field="x_Passsword" name="x_Passsword" id="x_Passsword" value="<?php echo $users_edit->Passsword->EditValue ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users_edit->Passsword->getPlaceHolder()) ?>"<?php echo $users_edit->Passsword->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_Passsword" data-password-confirm="c_Passsword" data-password-strength="pst_Passsword"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_Passsword">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $users_edit->Passsword->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->userLevelId->Visible) { // userLevelId ?>
	<div id="r_userLevelId" class="form-group row">
		<label id="elh_users_userLevelId" for="x_userLevelId" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->userLevelId->caption() ?><?php echo $users_edit->userLevelId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->userLevelId->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_userLevelId">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_edit->userLevelId->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_users_userLevelId">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_userLevelId" data-value-separator="<?php echo $users_edit->userLevelId->displayValueSeparatorAttribute() ?>" id="x_userLevelId" name="x_userLevelId"<?php echo $users_edit->userLevelId->editAttributes() ?>>
			<?php echo $users_edit->userLevelId->selectOptionListHtml("x_userLevelId") ?>
		</select>
</div>
<?php echo $users_edit->userLevelId->Lookup->getParamTag($users_edit, "p_x_userLevelId") ?>
</span>
<?php } ?>
<?php echo $users_edit->userLevelId->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$users_edit->IsModal) { ?>
<?php echo $users_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$users_edit->showPageFooter();
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
$users_edit->terminate();
?>