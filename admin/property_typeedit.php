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
$property_type_edit = new property_type_edit();

// Run the page
$property_type_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fproperty_typeedit = currentForm = new ew.Form("fproperty_typeedit", "edit");

	// Validate form
	fproperty_typeedit.validate = function() {
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
			<?php if ($property_type_edit->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_edit->PropertyType->caption(), $property_type_edit->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_type_edit->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_edit->PropertyUse->caption(), $property_type_edit->PropertyUse->RequiredErrorMessage)) ?>");
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
	fproperty_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_type_edit->showPageHeader(); ?>
<?php
$property_type_edit->showMessage();
?>
<?php if (!$property_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fproperty_typeedit" id="fproperty_typeedit" class="<?php echo $property_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$property_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($property_type_edit->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label id="elh_property_type_PropertyType" for="x_PropertyType" class="<?php echo $property_type_edit->LeftColumnClass ?>"><?php echo $property_type_edit->PropertyType->caption() ?><?php echo $property_type_edit->PropertyType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_type_edit->RightColumnClass ?>"><div <?php echo $property_type_edit->PropertyType->cellAttributes() ?>>
<span id="el_property_type_PropertyType">
<input type="text" data-table="property_type" data-field="x_PropertyType" name="x_PropertyType" id="x_PropertyType" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_type_edit->PropertyType->getPlaceHolder()) ?>" value="<?php echo $property_type_edit->PropertyType->EditValue ?>"<?php echo $property_type_edit->PropertyType->editAttributes() ?>>
</span>
<?php echo $property_type_edit->PropertyType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_type_edit->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_type_PropertyUse" for="x_PropertyUse" class="<?php echo $property_type_edit->LeftColumnClass ?>"><?php echo $property_type_edit->PropertyUse->caption() ?><?php echo $property_type_edit->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_type_edit->RightColumnClass ?>"><div <?php echo $property_type_edit->PropertyUse->cellAttributes() ?>>
<span id="el_property_type_PropertyUse">
<input type="text" data-table="property_type" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_type_edit->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_type_edit->PropertyUse->EditValue ?>"<?php echo $property_type_edit->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_type_edit->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="property_type" data-field="x_PropertyTypeCode" name="x_PropertyTypeCode" id="x_PropertyTypeCode" value="<?php echo HtmlEncode($property_type_edit->PropertyTypeCode->CurrentValue) ?>">
<?php if (!$property_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$property_type_edit->IsModal) { ?>
<?php echo $property_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$property_type_edit->showPageFooter();
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
$property_type_edit->terminate();
?>