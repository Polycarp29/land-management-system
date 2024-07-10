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
$charge_group_edit = new charge_group_edit();

// Run the page
$charge_group_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcharge_groupedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcharge_groupedit = currentForm = new ew.Form("fcharge_groupedit", "edit");

	// Validate form
	fcharge_groupedit.validate = function() {
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
			<?php if ($charge_group_edit->ChargeGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_edit->ChargeGroupCode->caption(), $charge_group_edit->ChargeGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charge_group_edit->ChargeGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charge_group_edit->ChargeGroupName->caption(), $charge_group_edit->ChargeGroupName->RequiredErrorMessage)) ?>");
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
	fcharge_groupedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcharge_groupedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcharge_groupedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $charge_group_edit->showPageHeader(); ?>
<?php
$charge_group_edit->showMessage();
?>
<?php if (!$charge_group_edit->IsModal) { ?>
<?php if (!$charge_group->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_group_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcharge_groupedit" id="fcharge_groupedit" class="<?php echo $charge_group_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<?php if ($charge_group->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$charge_group_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($charge_group_edit->ChargeGroupCode->Visible) { // ChargeGroupCode ?>
	<div id="r_ChargeGroupCode" class="form-group row">
		<label id="elh_charge_group_ChargeGroupCode" class="<?php echo $charge_group_edit->LeftColumnClass ?>"><?php echo $charge_group_edit->ChargeGroupCode->caption() ?><?php echo $charge_group_edit->ChargeGroupCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_edit->RightColumnClass ?>"><div <?php echo $charge_group_edit->ChargeGroupCode->cellAttributes() ?>>
<?php if (!$charge_group->isConfirm()) { ?>
<span id="el_charge_group_ChargeGroupCode">
<span<?php echo $charge_group_edit->ChargeGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charge_group_edit->ChargeGroupCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupCode" name="x_ChargeGroupCode" id="x_ChargeGroupCode" value="<?php echo HtmlEncode($charge_group_edit->ChargeGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_charge_group_ChargeGroupCode">
<span<?php echo $charge_group_edit->ChargeGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charge_group_edit->ChargeGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupCode" name="x_ChargeGroupCode" id="x_ChargeGroupCode" value="<?php echo HtmlEncode($charge_group_edit->ChargeGroupCode->FormValue) ?>">
<?php } ?>
<?php echo $charge_group_edit->ChargeGroupCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($charge_group_edit->ChargeGroupName->Visible) { // ChargeGroupName ?>
	<div id="r_ChargeGroupName" class="form-group row">
		<label id="elh_charge_group_ChargeGroupName" for="x_ChargeGroupName" class="<?php echo $charge_group_edit->LeftColumnClass ?>"><?php echo $charge_group_edit->ChargeGroupName->caption() ?><?php echo $charge_group_edit->ChargeGroupName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $charge_group_edit->RightColumnClass ?>"><div <?php echo $charge_group_edit->ChargeGroupName->cellAttributes() ?>>
<?php if (!$charge_group->isConfirm()) { ?>
<span id="el_charge_group_ChargeGroupName">
<input type="text" data-table="charge_group" data-field="x_ChargeGroupName" name="x_ChargeGroupName" id="x_ChargeGroupName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($charge_group_edit->ChargeGroupName->getPlaceHolder()) ?>" value="<?php echo $charge_group_edit->ChargeGroupName->EditValue ?>"<?php echo $charge_group_edit->ChargeGroupName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_charge_group_ChargeGroupName">
<span<?php echo $charge_group_edit->ChargeGroupName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charge_group_edit->ChargeGroupName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="charge_group" data-field="x_ChargeGroupName" name="x_ChargeGroupName" id="x_ChargeGroupName" value="<?php echo HtmlEncode($charge_group_edit->ChargeGroupName->FormValue) ?>">
<?php } ?>
<?php echo $charge_group_edit->ChargeGroupName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$charge_group_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $charge_group_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$charge_group->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $charge_group_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$charge_group_edit->IsModal) { ?>
<?php if (!$charge_group->isConfirm()) { // Confirm page ?>
<?php echo $charge_group_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$charge_group_edit->showPageFooter();
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
$charge_group_edit->terminate();
?>