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
$charge_group_add = new charge_group_add();

// Run the page
$charge_group_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_groupadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcharge_groupadd = currentForm = new ew.Form("fcharge_groupadd", "add");

	// Validate form
	fcharge_groupadd.validate = function() {
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
			<?php if ($charge_group_add->ChargeGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_add->ChargeGroupName->caption(), $charge_group_add->ChargeGroupName->RequiredErrorMessage)) ?>");
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
	fcharge_groupadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcharge_groupadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcharge_groupadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_group_add->showPageHeader(); ?>
<?php
$charge_group_add->showMessage();
?>
<form name="fcharge_groupadd" id="fcharge_groupadd" class="<?php echo $charge_group_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<?php if ($charge_group->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$charge_group_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($charge_group_add->ChargeGroupName->Visible) { // ChargeGroupName ?>
	<div id="r_ChargeGroupName" class="form-group row">
		<label id="elh_charge_group_ChargeGroupName" for="x_ChargeGroupName" class="<?php echo $charge_group_add->LeftColumnClass ?>"><?php echo $charge_group_add->ChargeGroupName->caption() ?><?php echo $charge_group_add->ChargeGroupName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_add->RightColumnClass ?>"><div <?php echo $charge_group_add->ChargeGroupName->cellAttributes() ?>>
<?php if (!$charge_group->isConfirm()) { ?>
<span id="el_charge_group_ChargeGroupName">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupName" name="x_ChargeGroupName" id="x_ChargeGroupName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charge_group_add->ChargeGroupName->getPlaceHolder()) ?>" value="<?php echo $charge_group_add->ChargeGroupName->EditValue ?>"<?php echo $charge_group_add->ChargeGroupName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charge_group_ChargeGroupName">
<span<?php echo $charge_group_add->ChargeGroupName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charge_group_add->ChargeGroupName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupName" name="x_ChargeGroupName" id="x_ChargeGroupName" value="<?php echo HtmlEncode($charge_group_add->ChargeGroupName->FormValue) ?>">
<?php } ?>
<?php echo $charge_group_add->ChargeGroupName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charge_group_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charge_group_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$charge_group->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_group_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$charge_group_add->showPageFooter();
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
$charge_group_add->terminate();
?>