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
$billing_period_add = new billing_period_add();

// Run the page
$billing_period_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$billing_period_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbilling_periodadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbilling_periodadd = currentForm = new ew.Form("fbilling_periodadd", "add");

	// Validate form
	fbilling_periodadd.validate = function() {
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
			<?php if ($billing_period_add->BillingYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillingYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_add->BillingYear->caption(), $billing_period_add->BillingYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillingYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($billing_period_add->BillingYear->errorMessage()) ?>");
			<?php if ($billing_period_add->BillingCycle->Required) { ?>
				elm = this.getElements("x" + infix + "_BillingCycle");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_add->BillingCycle->caption(), $billing_period_add->BillingCycle->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($billing_period_add->From->Required) { ?>
				elm = this.getElements("x" + infix + "_From");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_add->From->caption(), $billing_period_add->From->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_From");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($billing_period_add->From->errorMessage()) ?>");
			<?php if ($billing_period_add->To->Required) { ?>
				elm = this.getElements("x" + infix + "_To");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_add->To->caption(), $billing_period_add->To->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_To");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($billing_period_add->To->errorMessage()) ?>");
			<?php if ($billing_period_add->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $billing_period_add->Status->caption(), $billing_period_add->Status->RequiredErrorMessage)) ?>");
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
	fbilling_periodadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbilling_periodadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbilling_periodadd.lists["x_BillingCycle"] = <?php echo $billing_period_add->BillingCycle->Lookup->toClientList($billing_period_add) ?>;
	fbilling_periodadd.lists["x_BillingCycle"].options = <?php echo JsonEncode($billing_period_add->BillingCycle->options(FALSE, TRUE)) ?>;
	fbilling_periodadd.lists["x_Status"] = <?php echo $billing_period_add->Status->Lookup->toClientList($billing_period_add) ?>;
	fbilling_periodadd.lists["x_Status"].options = <?php echo JsonEncode($billing_period_add->Status->options(FALSE, TRUE)) ?>;
	loadjs.done("fbilling_periodadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $billing_period_add->showPageHeader(); ?>
<?php
$billing_period_add->showMessage();
?>
<form name="fbilling_periodadd" id="fbilling_periodadd" class="<?php echo $billing_period_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="billing_period">
<?php if ($billing_period->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$billing_period_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($billing_period_add->BillingYear->Visible) { // BillingYear ?>
	<div id="r_BillingYear" class="form-group row">
		<label id="elh_billing_period_BillingYear" for="x_BillingYear" class="<?php echo $billing_period_add->LeftColumnClass ?>"><?php echo $billing_period_add->BillingYear->caption() ?><?php echo $billing_period_add->BillingYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_add->RightColumnClass ?>"><div <?php echo $billing_period_add->BillingYear->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_BillingYear">
<input type="text" data-table="billing_period" data-field="x_BillingYear" name="x_BillingYear" id="x_BillingYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($billing_period_add->BillingYear->getPlaceHolder()) ?>" value="<?php echo $billing_period_add->BillingYear->EditValue ?>"<?php echo $billing_period_add->BillingYear->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_billing_period_BillingYear">
<span<?php echo $billing_period_add->BillingYear->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_add->BillingYear->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_BillingYear" name="x_BillingYear" id="x_BillingYear" value="<?php echo HtmlEncode($billing_period_add->BillingYear->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_add->BillingYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_add->BillingCycle->Visible) { // BillingCycle ?>
	<div id="r_BillingCycle" class="form-group row">
		<label id="elh_billing_period_BillingCycle" for="x_BillingCycle" class="<?php echo $billing_period_add->LeftColumnClass ?>"><?php echo $billing_period_add->BillingCycle->caption() ?><?php echo $billing_period_add->BillingCycle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_add->RightColumnClass ?>"><div <?php echo $billing_period_add->BillingCycle->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_BillingCycle">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($billing_period_add->BillingCycle->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $billing_period_add->BillingCycle->ViewValue ?></button>
		<div id="dsl_x_BillingCycle" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $billing_period_add->BillingCycle->radioButtonListHtml(TRUE, "x_BillingCycle") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_BillingCycle" class="ew-template"><input type="radio" class="custom-control-input" data-table="billing_period" data-field="x_BillingCycle" data-value-separator="<?php echo $billing_period_add->BillingCycle->displayValueSeparatorAttribute() ?>" name="x_BillingCycle" id="x_BillingCycle" value="{value}"<?php echo $billing_period_add->BillingCycle->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$billing_period_add->BillingCycle->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php } else { ?>
<span id="el_billing_period_BillingCycle">
<span<?php echo $billing_period_add->BillingCycle->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_add->BillingCycle->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_BillingCycle" name="x_BillingCycle" id="x_BillingCycle" value="<?php echo HtmlEncode($billing_period_add->BillingCycle->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_add->BillingCycle->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_add->From->Visible) { // From ?>
	<div id="r_From" class="form-group row">
		<label id="elh_billing_period_From" for="x_From" class="<?php echo $billing_period_add->LeftColumnClass ?>"><?php echo $billing_period_add->From->caption() ?><?php echo $billing_period_add->From->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_add->RightColumnClass ?>"><div <?php echo $billing_period_add->From->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_From">
<input type="text" data-table="billing_period" data-field="x_From" name="x_From" id="x_From" maxlength="10" placeholder="<?php echo HtmlEncode($billing_period_add->From->getPlaceHolder()) ?>" value="<?php echo $billing_period_add->From->EditValue ?>"<?php echo $billing_period_add->From->editAttributes() ?>>
<?php if (!$billing_period_add->From->ReadOnly && !$billing_period_add->From->Disabled && !isset($billing_period_add->From->EditAttrs["readonly"]) && !isset($billing_period_add->From->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbilling_periodadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbilling_periodadd", "x_From", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_billing_period_From">
<span<?php echo $billing_period_add->From->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_add->From->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_From" name="x_From" id="x_From" value="<?php echo HtmlEncode($billing_period_add->From->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_add->From->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_add->To->Visible) { // To ?>
	<div id="r_To" class="form-group row">
		<label id="elh_billing_period_To" for="x_To" class="<?php echo $billing_period_add->LeftColumnClass ?>"><?php echo $billing_period_add->To->caption() ?><?php echo $billing_period_add->To->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_add->RightColumnClass ?>"><div <?php echo $billing_period_add->To->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_To">
<input type="text" data-table="billing_period" data-field="x_To" name="x_To" id="x_To" maxlength="10" placeholder="<?php echo HtmlEncode($billing_period_add->To->getPlaceHolder()) ?>" value="<?php echo $billing_period_add->To->EditValue ?>"<?php echo $billing_period_add->To->editAttributes() ?>>
<?php if (!$billing_period_add->To->ReadOnly && !$billing_period_add->To->Disabled && !isset($billing_period_add->To->EditAttrs["readonly"]) && !isset($billing_period_add->To->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbilling_periodadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbilling_periodadd", "x_To", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_billing_period_To">
<span<?php echo $billing_period_add->To->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_add->To->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_To" name="x_To" id="x_To" value="<?php echo HtmlEncode($billing_period_add->To->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_add->To->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($billing_period_add->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_billing_period_Status" for="x_Status" class="<?php echo $billing_period_add->LeftColumnClass ?>"><?php echo $billing_period_add->Status->caption() ?><?php echo $billing_period_add->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $billing_period_add->RightColumnClass ?>"><div <?php echo $billing_period_add->Status->cellAttributes() ?>>
<?php if (!$billing_period->isConfirm()) { ?>
<span id="el_billing_period_Status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($billing_period_add->Status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $billing_period_add->Status->ViewValue ?></button>
		<div id="dsl_x_Status" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $billing_period_add->Status->radioButtonListHtml(TRUE, "x_Status") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="billing_period" data-field="x_Status" data-value-separator="<?php echo $billing_period_add->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="{value}"<?php echo $billing_period_add->Status->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$billing_period_add->Status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php } else { ?>
<span id="el_billing_period_Status">
<span<?php echo $billing_period_add->Status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($billing_period_add->Status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="billing_period" data-field="x_Status" name="x_Status" id="x_Status" value="<?php echo HtmlEncode($billing_period_add->Status->FormValue) ?>">
<?php } ?>
<?php echo $billing_period_add->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$billing_period_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $billing_period_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$billing_period->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $billing_period_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$billing_period_add->showPageFooter();
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
$billing_period_add->terminate();
?>