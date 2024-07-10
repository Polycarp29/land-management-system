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
$users_delete = new users_delete();

// Run the page
$users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");
	loadjs.done("fusersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_delete->showPageHeader(); ?>
<?php
$users_delete->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($users_delete->id->Visible) { // id ?>
		<th class="<?php echo $users_delete->id->headerCellClass() ?>"><span id="elh_users_id" class="users_id"><?php echo $users_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->Fullname->Visible) { // Fullname ?>
		<th class="<?php echo $users_delete->Fullname->headerCellClass() ?>"><span id="elh_users_Fullname" class="users_Fullname"><?php echo $users_delete->Fullname->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->Username->Visible) { // Username ?>
		<th class="<?php echo $users_delete->Username->headerCellClass() ?>"><span id="elh_users_Username" class="users_Username"><?php echo $users_delete->Username->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->_Email->Visible) { // Email ?>
		<th class="<?php echo $users_delete->_Email->headerCellClass() ?>"><span id="elh_users__Email" class="users__Email"><?php echo $users_delete->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->Passsword->Visible) { // Passsword ?>
		<th class="<?php echo $users_delete->Passsword->headerCellClass() ?>"><span id="elh_users_Passsword" class="users_Passsword"><?php echo $users_delete->Passsword->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->userLevelId->Visible) { // userLevelId ?>
		<th class="<?php echo $users_delete->userLevelId->headerCellClass() ?>"><span id="elh_users_userLevelId" class="users_userLevelId"><?php echo $users_delete->userLevelId->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecordCount = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecordCount++;
	$users_delete->RowCount++;

	// Set row properties
	$users->resetAttributes();
	$users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->loadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->renderRow();
?>
	<tr <?php echo $users->rowAttributes() ?>>
<?php if ($users_delete->id->Visible) { // id ?>
		<td <?php echo $users_delete->id->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_id" class="users_id">
<span<?php echo $users_delete->id->viewAttributes() ?>><?php echo $users_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->Fullname->Visible) { // Fullname ?>
		<td <?php echo $users_delete->Fullname->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_Fullname" class="users_Fullname">
<span<?php echo $users_delete->Fullname->viewAttributes() ?>><?php echo $users_delete->Fullname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->Username->Visible) { // Username ?>
		<td <?php echo $users_delete->Username->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_Username" class="users_Username">
<span<?php echo $users_delete->Username->viewAttributes() ?>><?php echo $users_delete->Username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->_Email->Visible) { // Email ?>
		<td <?php echo $users_delete->_Email->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users__Email" class="users__Email">
<span<?php echo $users_delete->_Email->viewAttributes() ?>><?php echo $users_delete->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->Passsword->Visible) { // Passsword ?>
		<td <?php echo $users_delete->Passsword->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_Passsword" class="users_Passsword">
<span<?php echo $users_delete->Passsword->viewAttributes() ?>><?php echo $users_delete->Passsword->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->userLevelId->Visible) { // userLevelId ?>
		<td <?php echo $users_delete->userLevelId->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_userLevelId" class="users_userLevelId">
<span<?php echo $users_delete->userLevelId->viewAttributes() ?>><?php echo $users_delete->userLevelId->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->moveNext();
}
$users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$users_delete->showPageFooter();
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
$users_delete->terminate();
?>