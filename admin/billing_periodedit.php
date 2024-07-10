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
$billing_period_edit = new billing_period_edit();

// Run the page
$billing_period_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$billing_period_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbilling_periodedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbilling_periodedit = currentForm = new ew.Form("fbilling_periodedit", "edit");

	// Validate form
	fbilling_periodedit.validate = function() {
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
			<?php if ($billing_period_edit->BillingYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillingYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_edit->BillingYear->caption(), $billing_period_edit->BillingYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillingYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($billing_period_edit->BillingYear->errorMessage()) ?>");
			<?php if ($billing_period_edit->BillingCycle->Required) { ?>
				elm = this.getElements("x" + infix + "_BillingCycle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_edit->BillingCycle->caption(), $billing_period_edit->BillingCycle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($billing_period_edit->From->Required) { ?>
				elm = this.getElements("x" + infix + "_From");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_edit->From->caption(), $billing_period_edit->From->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_From");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($billing_period_edit->From->errorMessage()) ?>");
			<?php if ($billing_period_edit->To->Required) { ?>
				elm = this.getElements("x" + infix + "_To");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_edit->To->caption(), $billing_period_edit->To->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_To");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($billing_period_edit->To->errorMessage()) ?>");
			<?php if ($billing_period_edit->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_edit->Status->caption(), $billing_period_edit->Status->RequiredErrorMessage)) ?>");
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
	fbilling_periodedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbilling_periodedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbilling_periodedit.lists["x_BillingCycle"] = <?php echo $billing_period_edit->BillingCycle->Lookup->toClientList($billing_period_edit) ?>;
	fbilling_periodedit.lists["x_BillingCycle"].options = <?php echo JsonEncode($billing_period_edit->BillingCycle->options(FALSE, TRUE)) ?>;
	fbilling_periodedit.lists["x_Status"] = <?php echo $billing_period_edit->Status->Lookup->toClientList($billing_period_edit) ?>;
	fbilling_periodedit.lists["x_Status"].options = <?php echo JsonEncode($billing_period_edit->Status->options(FALSE, TRUE)) ?>;
	loadjs.done("fbilling_periodedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $billing_period_edit->showPageHeader(); ?>
<?php
$billing_period_edit->showMessage();
?>
<?php if (!$billing_period_edit->IsModal) { ?>
<?php if (!$billing_period->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $billing_period_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbilling_periodedit" id="fbilling_periodedit" class="<?php echo $billing_period_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="billing_period">
<input type="hidden" name="k_hash" id="k_hash" value="<?php echo $billing_period_edit->HashValue ?>">
<?php if ($billing_period->UpdateConflict == "U") { // Record already updated by other user ?>
<input type="hidden" name="conflict" id="conflict" value="1">
<?php } ?>
<?php if ($billing_period->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$billing_period_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($billing_period_edit->BillingYear->Visible) { // BillingYear ?>
	<div id="r_BillingYear" class="form-group row">
		<label id="elh_billing_period_BillingYear" for="x_BillingYear" class="<?php echo $billing_period_edit->LeftColumnClass ?>"><?php echo $billing_period_edit->BillingYear->caption() ?><?php echo $billing_period_edit->BillingYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_edit->RightColumnClass ?>"><div <?php echo $billing_period_edit->BillingYear->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_BillingYear">
<input type="text" data-table="billing_period" data-field="x_BillingYear" name="x_BillingYear" id="x_BillingYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($billing_period_edit->BillingYear->getPlaceHolder()) ?>" value="<?php echo $billing_period_edit->BillingYear->EditValue ?>"<?php echo $billing_period_edit->BillingYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_billing_period_BillingYear">
<span<?php echo $billing_period_edit->BillingYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_edit->BillingYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_BillingYear" name="x_BillingYear" id="x_BillingYear" value="<?php echo HtmlEncode($billing_period_edit->BillingYear->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_edit->BillingYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_edit->BillingCycle->Visible) { // BillingCycle ?>
	<div id="r_BillingCycle" class="form-group row">
		<label id="elh_billing_period_BillingCycle" for="x_BillingCycle" class="<?php echo $billing_period_edit->LeftColumnClass ?>"><?php echo $billing_period_edit->BillingCycle->caption() ?><?php echo $billing_period_edit->BillingCycle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_edit->RightColumnClass ?>"><div <?php echo $billing_period_edit->BillingCycle->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_BillingCycle">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($billing_period_edit->BillingCycle->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $billing_period_edit->BillingCycle->ViewValue ?></button>
		<div id="dsl_x_BillingCycle" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $billing_period_edit->BillingCycle->radioButtonListHtml(TRUE, "x_BillingCycle") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_BillingCycle" class="ew-template"><input type="radio" class="custom-control-input" data-table="billing_period" data-field="x_BillingCycle" data-value-separator="<?php echo $billing_period_edit->BillingCycle->displayValueSeparatorAttribute() ?>" name="x_BillingCycle" id="x_BillingCycle" value="{value}"<?php echo $billing_period_edit->BillingCycle->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$billing_period_edit->BillingCycle->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php } else { ?>
<span id="el_billing_period_BillingCycle">
<span<?php echo $billing_period_edit->BillingCycle->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_edit->BillingCycle->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_BillingCycle" name="x_BillingCycle" id="x_BillingCycle" value="<?php echo HtmlEncode($billing_period_edit->BillingCycle->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_edit->BillingCycle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_edit->From->Visible) { // From ?>
	<div id="r_From" class="form-group row">
		<label id="elh_billing_period_From" for="x_From" class="<?php echo $billing_period_edit->LeftColumnClass ?>"><?php echo $billing_period_edit->From->caption() ?><?php echo $billing_period_edit->From->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_edit->RightColumnClass ?>"><div <?php echo $billing_period_edit->From->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_From">
<input type="text" data-table="billing_period" data-field="x_From" name="x_From" id="x_From" maxlength="10" placeholder="<?php echo HtmlEncode($billing_period_edit->From->getPlaceHolder()) ?>" value="<?php echo $billing_period_edit->From->EditValue ?>"<?php echo $billing_period_edit->From->editAttributes() ?>>
<?php if (!$billing_period_edit->From->ReadOnly && !$billing_period_edit->From->Disabled && !isset($billing_period_edit->From->EditAttrs["readonly"]) && !isset($billing_period_edit->From->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbilling_periodedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbilling_periodedit", "x_From", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_billing_period_From">
<span<?php echo $billing_period_edit->From->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_edit->From->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_From" name="x_From" id="x_From" value="<?php echo HtmlEncode($billing_period_edit->From->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_edit->From->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_edit->To->Visible) { // To ?>
	<div id="r_To" class="form-group row">
		<label id="elh_billing_period_To" for="x_To" class="<?php echo $billing_period_edit->LeftColumnClass ?>"><?php echo $billing_period_edit->To->caption() ?><?php echo $billing_period_edit->To->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_edit->RightColumnClass ?>"><div <?php echo $billing_period_edit->To->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_To">
<input type="text" data-table="billing_period" data-field="x_To" name="x_To" id="x_To" maxlength="10" placeholder="<?php echo HtmlEncode($billing_period_edit->To->getPlaceHolder()) ?>" value="<?php echo $billing_period_edit->To->EditValue ?>"<?php echo $billing_period_edit->To->editAttributes() ?>>
<?php if (!$billing_period_edit->To->ReadOnly && !$billing_period_edit->To->Disabled && !isset($billing_period_edit->To->EditAttrs["readonly"]) && !isset($billing_period_edit->To->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbilling_periodedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbilling_periodedit", "x_To", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_billing_period_To">
<span<?php echo $billing_period_edit->To->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_edit->To->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_To" name="x_To" id="x_To" value="<?php echo HtmlEncode($billing_period_edit->To->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_edit->To->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_edit->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_billing_period_Status" for="x_Status" class="<?php echo $billing_period_edit->LeftColumnClass ?>"><?php echo $billing_period_edit->Status->caption() ?><?php echo $billing_period_edit->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_edit->RightColumnClass ?>"><div <?php echo $billing_period_edit->Status->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_Status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($billing_period_edit->Status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $billing_period_edit->Status->ViewValue ?></button>
		<div id="dsl_x_Status" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $billing_period_edit->Status->radioButtonListHtml(TRUE, "x_Status") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="billing_period" data-field="x_Status" data-value-separator="<?php echo $billing_period_edit->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="{value}"<?php echo $billing_period_edit->Status->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$billing_period_edit->Status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php } else { ?>
<span id="el_billing_period_Status">
<span<?php echo $billing_period_edit->Status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_edit->Status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_Status" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($billing_period_edit->Status->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_edit->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="billing_period" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($billing_period_edit->id->CurrentValue) ?>">
<?php if (!$billing_period_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $billing_period_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($billing_period->UpdateConflict == "U") { // Record already updated by other user ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='overwrite';"><?php echo $Language->phrase("OverwriteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-reload" id="btn-reload" type="submit" onclick="this.form.action.value='show';"><?php echo $Language->phrase("ReloadBtn") ?></button>
<?php } else { ?>
<?php if (!$billing_period->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $billing_period_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$billing_period_edit->IsModal) { ?>
<?php if (!$billing_period->isConfirm()) { // Confirm page ?>
<?php echo $billing_period_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$billing_period_edit->showPageFooter();
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
$billing_period_edit->terminate();
?>