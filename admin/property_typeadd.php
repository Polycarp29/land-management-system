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
$property_type_add = new property_type_add();

// Run the page
$property_type_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fproperty_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fproperty_typeadd = currentForm = new ew.Form("fproperty_typeadd", "add");

	// Validate form
	fproperty_typeadd.validate = function() {
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
			<?php if ($property_type_add->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_add->PropertyType->caption(), $property_type_add->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_type_add->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_type_add->PropertyUse->caption(), $property_type_add->PropertyUse->RequiredErrorMessage)) ?>");
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
	fproperty_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fproperty_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fproperty_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $property_type_add->showPageHeader(); ?>
<?php
$property_type_add->showMessage();
?>
<form name="fproperty_typeadd" id="fproperty_typeadd" class="<?php echo $property_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$property_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($property_type_add->PropertyType->Visible) { // PropertyType ?>
	<div id="r_PropertyType" class="form-group row">
		<label id="elh_property_type_PropertyType" for="x_PropertyType" class="<?php echo $property_type_add->LeftColumnClass ?>"><?php echo $property_type_add->PropertyType->caption() ?><?php echo $property_type_add->PropertyType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_type_add->RightColumnClass ?>"><div <?php echo $property_type_add->PropertyType->cellAttributes() ?>>
<span id="el_property_type_PropertyType">
<input type="text" data-table="property_type" data-field="x_PropertyType" name="x_PropertyType" id="x_PropertyType" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_type_add->PropertyType->getPlaceHolder()) ?>" value="<?php echo $property_type_add->PropertyType->EditValue ?>"<?php echo $property_type_add->PropertyType->editAttributes() ?>>
</span>
<?php echo $property_type_add->PropertyType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($property_type_add->PropertyUse->Visible) { // PropertyUse ?>
	<div id="r_PropertyUse" class="form-group row">
		<label id="elh_property_type_PropertyUse" for="x_PropertyUse" class="<?php echo $property_type_add->LeftColumnClass ?>"><?php echo $property_type_add->PropertyUse->caption() ?><?php echo $property_type_add->PropertyUse->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $property_type_add->RightColumnClass ?>"><div <?php echo $property_type_add->PropertyUse->cellAttributes() ?>>
<span id="el_property_type_PropertyUse">
<input type="text" data-table="property_type" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($property_type_add->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $property_type_add->PropertyUse->EditValue ?>"<?php echo $property_type_add->PropertyUse->editAttributes() ?>>
</span>
<?php echo $property_type_add->PropertyUse->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$property_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $property_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $property_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$property_type_add->showPageFooter();
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
$property_type_add->terminate();
?>