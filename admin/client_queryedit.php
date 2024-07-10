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
$client_query_edit = new client_query_edit();

// Run the page
$client_query_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_query_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclient_queryedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fclient_queryedit = currentForm = new ew.Form("fclient_queryedit", "edit");

	// Validate form
	fclient_queryedit.validate = function() {
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
			<?php if ($client_query_edit->ClientId->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientId");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_query_edit->ClientId->caption(), $client_query_edit->ClientId->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_query_edit->Query->Required) { ?>
				elm = this.getElements("x" + infix + "_Query");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_query_edit->Query->caption(), $client_query_edit->Query->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_query_edit->Reply->Required) { ?>
				elm = this.getElements("x" + infix + "_Reply");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_query_edit->Reply->caption(), $client_query_edit->Reply->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_query_edit->Date->Required) { ?>
				elm = this.getElements("x" + infix + "_Date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_query_edit->Date->caption(), $client_query_edit->Date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_query_edit->Date->errorMessage()) ?>");
			<?php if ($client_query_edit->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_query_edit->Status->caption(), $client_query_edit->Status->RequiredErrorMessage)) ?>");
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
	fclient_queryedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclient_queryedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclient_queryedit.lists["x_ClientId"] = <?php echo $client_query_edit->ClientId->Lookup->toClientList($client_query_edit) ?>;
	fclient_queryedit.lists["x_ClientId"].options = <?php echo JsonEncode($client_query_edit->ClientId->lookupOptions()) ?>;
	fclient_queryedit.lists["x_Status"] = <?php echo $client_query_edit->Status->Lookup->toClientList($client_query_edit) ?>;
	fclient_queryedit.lists["x_Status"].options = <?php echo JsonEncode($client_query_edit->Status->options(FALSE, TRUE)) ?>;
	loadjs.done("fclient_queryedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_query_edit->showPageHeader(); ?>
<?php
$client_query_edit->showMessage();
?>
<?php if (!$client_query_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_query_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fclient_queryedit" id="fclient_queryedit" class="<?php echo $client_query_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_query">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$client_query_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($client_query_edit->ClientId->Visible) { // ClientId ?>
	<div id="r_ClientId" class="form-group row">
		<label id="elh_client_query_ClientId" for="x_ClientId" class="<?php echo $client_query_edit->LeftColumnClass ?>"><?php echo $client_query_edit->ClientId->caption() ?><?php echo $client_query_edit->ClientId->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_query_edit->RightColumnClass ?>"><div <?php echo $client_query_edit->ClientId->cellAttributes() ?>>
<span id="el_client_query_ClientId">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ClientId"><?php echo EmptyValue(strval($client_query_edit->ClientId->ViewValue)) ? $Language->phrase("PleaseSelect") : $client_query_edit->ClientId->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($client_query_edit->ClientId->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($client_query_edit->ClientId->ReadOnly || $client_query_edit->ClientId->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ClientId',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $client_query_edit->ClientId->Lookup->getParamTag($client_query_edit, "p_x_ClientId") ?>
<input type="hidden" data-table="client_query" data-field="x_ClientId" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $client_query_edit->ClientId->displayValueSeparatorAttribute() ?>" name="x_ClientId" id="x_ClientId" value="<?php echo $client_query_edit->ClientId->CurrentValue ?>"<?php echo $client_query_edit->ClientId->editAttributes() ?>>
</span>
<?php echo $client_query_edit->ClientId->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_query_edit->Query->Visible) { // Query ?>
	<div id="r_Query" class="form-group row">
		<label id="elh_client_query_Query" for="x_Query" class="<?php echo $client_query_edit->LeftColumnClass ?>"><?php echo $client_query_edit->Query->caption() ?><?php echo $client_query_edit->Query->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_query_edit->RightColumnClass ?>"><div <?php echo $client_query_edit->Query->cellAttributes() ?>>
<span id="el_client_query_Query">
<textarea data-table="client_query" data-field="x_Query" name="x_Query" id="x_Query" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_query_edit->Query->getPlaceHolder()) ?>"<?php echo $client_query_edit->Query->editAttributes() ?>><?php echo $client_query_edit->Query->EditValue ?></textarea>
</span>
<?php echo $client_query_edit->Query->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_query_edit->Reply->Visible) { // Reply ?>
	<div id="r_Reply" class="form-group row">
		<label id="elh_client_query_Reply" for="x_Reply" class="<?php echo $client_query_edit->LeftColumnClass ?>"><?php echo $client_query_edit->Reply->caption() ?><?php echo $client_query_edit->Reply->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_query_edit->RightColumnClass ?>"><div <?php echo $client_query_edit->Reply->cellAttributes() ?>>
<span id="el_client_query_Reply">
<textarea data-table="client_query" data-field="x_Reply" name="x_Reply" id="x_Reply" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_query_edit->Reply->getPlaceHolder()) ?>"<?php echo $client_query_edit->Reply->editAttributes() ?>><?php echo $client_query_edit->Reply->EditValue ?></textarea>
</span>
<?php echo $client_query_edit->Reply->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_query_edit->Date->Visible) { // Date ?>
	<div id="r_Date" class="form-group row">
		<label id="elh_client_query_Date" for="x_Date" class="<?php echo $client_query_edit->LeftColumnClass ?>"><?php echo $client_query_edit->Date->caption() ?><?php echo $client_query_edit->Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_query_edit->RightColumnClass ?>"><div <?php echo $client_query_edit->Date->cellAttributes() ?>>
<span id="el_client_query_Date">
<input type="text" data-table="client_query" data-field="x_Date" name="x_Date" id="x_Date" maxlength="19" placeholder="<?php echo HtmlEncode($client_query_edit->Date->getPlaceHolder()) ?>" value="<?php echo $client_query_edit->Date->EditValue ?>"<?php echo $client_query_edit->Date->editAttributes() ?>>
<?php if (!$client_query_edit->Date->ReadOnly && !$client_query_edit->Date->Disabled && !isset($client_query_edit->Date->EditAttrs["readonly"]) && !isset($client_query_edit->Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclient_queryedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fclient_queryedit", "x_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $client_query_edit->Date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_query_edit->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_client_query_Status" class="<?php echo $client_query_edit->LeftColumnClass ?>"><?php echo $client_query_edit->Status->caption() ?><?php echo $client_query_edit->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_query_edit->RightColumnClass ?>"><div <?php echo $client_query_edit->Status->cellAttributes() ?>>
<span id="el_client_query_Status">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($client_query_edit->Status->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $client_query_edit->Status->ViewValue ?></button>
		<div id="dsl_x_Status" data-repeatcolumn="5" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $client_query_edit->Status->radioButtonListHtml(TRUE, "x_Status") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_Status" class="ew-template"><input type="radio" class="custom-control-input" data-table="client_query" data-field="x_Status" data-value-separator="<?php echo $client_query_edit->Status->displayValueSeparatorAttribute() ?>" name="x_Status" id="x_Status" value="{value}"<?php echo $client_query_edit->Status->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$client_query_edit->Status->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
<?php echo $client_query_edit->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="client_query" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($client_query_edit->id->CurrentValue) ?>">
<?php if (!$client_query_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_query_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_query_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$client_query_edit->IsModal) { ?>
<?php echo $client_query_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$client_query_edit->showPageFooter();
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
$client_query_edit->terminate();
?>