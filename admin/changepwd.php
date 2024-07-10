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
$changepwd = new changepwd();

// Run the page
$changepwd->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$changepwd->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<script>
var fchangepwd;
loadjs.ready("head", function() {
	fchangepwd = new ew.Form("fchangepwd");

	// Extend form with Validate function
	fchangepwd.validate = function() {
		var $ = jQuery, fobj = this._form, $npwd = $(fobj.npwd);
		if (!this.validateRequired)
			return true; // Ignore validation
	<?php if (!IsPasswordReset()) { ?>
		if (!ew.hasValue(fobj.opwd))
			return this.onError(fobj.opwd, ew.language.phrase("EnterOldPassword"));
	<?php } ?>
		if (!ew.hasValue(fobj.npwd))
			return this.onError(fobj.npwd, ew.language.phrase("EnterNewPassword"));
		if ($npwd.hasClass("ew-password-strength") && !$npwd.data("validated"))
			return this.onError(fobj.npwd, ew.language.phrase("PasswordTooSimple"));
		if (fobj.npwd.value != fobj.cpwd.value)
			return this.onError(fobj.cpwd, ew.language.phrase("MismatchPassword"));

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fchangepwd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation
	fchangepwd.validateRequired = <?php echo JsonEncode(Config("CLIENT_VALIDATE")) ?>;
	loadjs.done("fchangepwd");
});
</script>
<?php $changepwd->showPageHeader(); ?>
<?php
$changepwd->showMessage();
?>
<form name="fchangepwd" id="fchangepwd" class="ew-form ew-change-pwd-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$changepwd->IsModal ?>">
<div class="ew-change-pwd-box">
<div class="card">
<div class="card-body">
<p class="login-box-msg"><?php echo $Language->phrase("ChangePwdMsg") ?></p>
<?php if (!IsPasswordReset()) { ?>
	<div class="form-group row">
		<div class="input-group"><input type="password" name="opwd" id="opwd" autocomplete="current-password" class="form-control ew-control" placeholder="<?php echo HtmlEncode($Language->phrase("OldPassword")) ?>"><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
	</div>
<?php } ?>
	<div class="form-group row">
		<div class="input-group">
			<input type="password" name="npwd" id="npwd" autocomplete="new-password" class="form-control ew-control ew-password-strength" placeholder="<?php echo HtmlEncode($Language->phrase("NewPassword")) ?>" data-password-strength="pst_npwd">
			<div class="input-group-append">
				<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
				<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="npwd" data-password-confirm="cpwd" data-password-strength="pst_npwd"><?php echo $Language->phrase("GeneratePassword") ?></button>
			</div>
		</div>
		<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_npwd">
			<div class="progress-bar" role="progressbar"></div>
		</div>
	</div>
	<div class="form-group row">
		<div class="input-group"><input type="password" name="cpwd" id="cpwd" autocomplete="new-password" class="form-control ew-control" placeholder="<?php echo HtmlEncode($Language->phrase("ConfirmPassword")) ?>"><div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div></div>
	</div>
<?php if (!$changepwd->IsModal) { ?>
	<button class="btn btn-primary ew-btn" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("ChangePwdBtn") ?></button>
<?php } ?>
</div>
</div>
</div>
</form>
<?php
$changepwd->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$changepwd->terminate();
?>