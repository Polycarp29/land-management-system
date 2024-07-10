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
$userlevels_add = new userlevels_add();

// Run the page
$userlevels_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevels_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuserlevelsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fuserlevelsadd = currentForm = new ew.Form("fuserlevelsadd", "add");

	// Validate form
	fuserlevelsadd.validate = function() {
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
			<?php if ($userlevels_add->userlevelid->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevelid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevels_add->userlevelid->caption(), $userlevels_add->userlevelid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_userlevelid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($userlevels_add->userlevelid->errorMessage()) ?>");
			<?php if ($userlevels_add->userlevelname->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevelname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevels_add->userlevelname->caption(), $userlevels_add->userlevelname->RequiredErrorMessage)) ?>");
			<?php } ?>
				var elId = fobj.elements["x" + infix + "_userlevelid"];
				var elName = fobj.elements["x" + infix + "_userlevelname"];
				if (elId && elName) {
					elId.value = $.trim(elId.value);
					elName.value = $.trim(elName.value);
					if (elId && !ew.checkInteger(elId.value))
						return this.onError(elId, ew.language.phrase("UserLevelIDInteger"));
					var level = parseInt(elId.value, 10);
					if (level == 0 && !ew.sameText(elName.value, "Default")) {
						return this.onError(elName, ew.language.phrase("UserLevelDefaultName"));
					} else if (level == -1 && !ew.sameText(elName.value, "Administrator")) {
						return this.onError(elName, ew.language.phrase("UserLevelAdministratorName"));
					} else if (level == -2 && !ew.sameText(elName.value, "Anonymous")) {
						return this.onError(elName, ew.language.phrase("UserLevelAnonymousName"));
					} else if (level < -2) {
						return this.onError(elId, ew.language.phrase("UserLevelIDIncorrect"));
					} else if (level > 0 && ["anonymous", "administrator", "default"].includes(elName.value.toLowerCase())) {
						return this.onError(elName, ew.language.phrase("UserLevelNameIncorrect"));
					}
				}

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
	fuserlevelsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuserlevelsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuserlevelsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $userlevels_add->showPageHeader(); ?>
<?php
$userlevels_add->showMessage();
?>
<form name="fuserlevelsadd" id="fuserlevelsadd" class="<?php echo $userlevels_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevels">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$userlevels_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($userlevels_add->userlevelid->Visible) { // userlevelid ?>
	<div id="r_userlevelid" class="form-group row">
		<label id="elh_userlevels_userlevelid" for="x_userlevelid" class="<?php echo $userlevels_add->LeftColumnClass ?>"><?php echo $userlevels_add->userlevelid->caption() ?><?php echo $userlevels_add->userlevelid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevels_add->RightColumnClass ?>"><div <?php echo $userlevels_add->userlevelid->cellAttributes() ?>>
<span id="el_userlevels_userlevelid">
<input type="text" data-table="userlevels" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($userlevels_add->userlevelid->getPlaceHolder()) ?>" value="<?php echo $userlevels_add->userlevelid->EditValue ?>"<?php echo $userlevels_add->userlevelid->editAttributes() ?>>
</span>
<?php echo $userlevels_add->userlevelid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($userlevels_add->userlevelname->Visible) { // userlevelname ?>
	<div id="r_userlevelname" class="form-group row">
		<label id="elh_userlevels_userlevelname" for="x_userlevelname" class="<?php echo $userlevels_add->LeftColumnClass ?>"><?php echo $userlevels_add->userlevelname->caption() ?><?php echo $userlevels_add->userlevelname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevels_add->RightColumnClass ?>"><div <?php echo $userlevels_add->userlevelname->cellAttributes() ?>>
<span id="el_userlevels_userlevelname">
<input type="text" data-table="userlevels" data-field="x_userlevelname" name="x_userlevelname" id="x_userlevelname" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($userlevels_add->userlevelname->getPlaceHolder()) ?>" value="<?php echo $userlevels_add->userlevelname->EditValue ?>"<?php echo $userlevels_add->userlevelname->editAttributes() ?>>
</span>
<?php echo $userlevels_add->userlevelname->CustomMsg ?></div></div>
	</div>
<?php } ?>
	<!-- row for permission values -->
	<div id="rp_permission" class="form-group row">
		<label id="elh_permission" class="<?php echo $userlevels_add->LeftColumnClass ?>"><?php echo HtmlTitle($Language->phrase("Permission")) ?></label>
		<div class="<?php echo $userlevels_add->RightColumnClass ?>">
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowAdd" id="Add" value="<?php echo Config("ALLOW_ADD") ?>"><label class="custom-control-label" for="Add"><?php echo $Language->phrase("PermissionAdd") ?></label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowDelete" id="Delete" value="<?php echo Config("ALLOW_DELETE") ?>"><label class="custom-control-label" for="Delete"><?php echo $Language->phrase("PermissionDelete") ?></label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowEdit" id="Edit" value="<?php echo Config("ALLOW_EDIT") ?>"><label class="custom-control-label" for="Edit"><?php echo $Language->phrase("PermissionEdit") ?></label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowList" id="List" value="<?php echo Config("ALLOW_LIST") ?>"><label class="custom-control-label" for="List"><?php echo $Language->phrase("PermissionList") ?></label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowLookup" id="Lookup" value="<?php echo Config("ALLOW_LOOKUP") ?>"><label class="custom-control-label" for="Lookup"><?php echo $Language->phrase("PermissionLookup") ?></label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowView" id="View" value="<?php echo Config("ALLOW_VIEW") ?>"><label class="custom-control-label" for="View"><?php echo $Language->phrase("PermissionView") ?></label>
			</div>
			<div class="custom-control custom-checkbox custom-control-inline">
				<input type="checkbox" class="custom-control-input" name="x__AllowSearch" id="Search" value="<?php echo Config("ALLOW_SEARCH") ?>"><label class="custom-control-label" for="Search"><?php echo $Language->phrase("PermissionSearch") ?></label>
			</div>
		</div>
	</div>
</div><!-- /page* -->
<?php if (!$userlevels_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevels_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $userlevels_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$userlevels_add->showPageFooter();
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
$userlevels_add->terminate();
?>