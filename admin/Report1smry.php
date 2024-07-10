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
$Report1_summary = new Report1_summary();

// Run the page
$Report1_summary->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Report1_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<script>
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Report1_summary->DrillDownInPanel) {
	$Report1_summary->ExportOptions->render("body");
	$Report1_summary->SearchOptions->render("body");
	$Report1_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Report1_summary->showPageHeader(); ?>
<?php
$Report1_summary->showMessage();
?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Report1_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Report1_summary->GroupCount <= count($Report1_summary->GroupRecords) && $Report1_summary->GroupCount <= $Report1_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Report1_summary->ShowHeader) {
?>
<?php if ($Report1_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Report1_summary->TotalGroups > 0) { ?>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Report1_summary->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Report1_summary->isExport("word") && !$Report1_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Report1_summary->ReportTableStyle ?>>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Report1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Report1_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Report1_summary->id->Visible) { ?>
	<?php if ($Report1_summary->id->ShowGroupHeaderAsRow) { ?>
	<th data-name="id">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Report1_summary->sortUrl($Report1_summary->id) == "") { ?>
	<th data-name="id" class="<?php echo $Report1_summary->id->headerCellClass() ?>" style="white-space: nowrap;"><div class="Report1_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->id->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="id" class="<?php echo $Report1_summary->id->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->id) ?>', 1);"><div class="Report1_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ClientName->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->ClientName) == "") { ?>
	<th data-name="ClientName" class="<?php echo $Report1_summary->ClientName->headerCellClass() ?>"><div class="Report1_ClientName"><div class="ew-table-header-caption"><?php echo $Report1_summary->ClientName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ClientName" class="<?php echo $Report1_summary->ClientName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->ClientName) ?>', 1);"><div class="Report1_ClientName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->ClientName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->ClientName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->ClientName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ClientType->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->ClientType) == "") { ?>
	<th data-name="ClientType" class="<?php echo $Report1_summary->ClientType->headerCellClass() ?>"><div class="Report1_ClientType"><div class="ew-table-header-caption"><?php echo $Report1_summary->ClientType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ClientType" class="<?php echo $Report1_summary->ClientType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->ClientType) ?>', 1);"><div class="Report1_ClientType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->ClientType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->ClientType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->ClientType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->IdentityType->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->IdentityType) == "") { ?>
	<th data-name="IdentityType" class="<?php echo $Report1_summary->IdentityType->headerCellClass() ?>"><div class="Report1_IdentityType"><div class="ew-table-header-caption"><?php echo $Report1_summary->IdentityType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="IdentityType" class="<?php echo $Report1_summary->IdentityType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->IdentityType) ?>', 1);"><div class="Report1_IdentityType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->IdentityType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->IdentityType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->IdentityType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ClientID->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->ClientID) == "") { ?>
	<th data-name="ClientID" class="<?php echo $Report1_summary->ClientID->headerCellClass() ?>"><div class="Report1_ClientID"><div class="ew-table-header-caption"><?php echo $Report1_summary->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ClientID" class="<?php echo $Report1_summary->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->ClientID) ?>', 1);"><div class="Report1_ClientID">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->Surname->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Report1_summary->Surname->headerCellClass() ?>"><div class="Report1_Surname"><div class="ew-table-header-caption"><?php echo $Report1_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Report1_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->Surname) ?>', 1);"><div class="Report1_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->FirstName->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Report1_summary->FirstName->headerCellClass() ?>"><div class="Report1_FirstName"><div class="ew-table-header-caption"><?php echo $Report1_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Report1_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->FirstName) ?>', 1);"><div class="Report1_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->MiddleName->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Report1_summary->MiddleName->headerCellClass() ?>"><div class="Report1_MiddleName"><div class="ew-table-header-caption"><?php echo $Report1_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Report1_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->MiddleName) ?>', 1);"><div class="Report1_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->Gender->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->Gender) == "") { ?>
	<th data-name="Gender" class="<?php echo $Report1_summary->Gender->headerCellClass() ?>"><div class="Report1_Gender"><div class="ew-table-header-caption"><?php echo $Report1_summary->Gender->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Gender" class="<?php echo $Report1_summary->Gender->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->Gender) ?>', 1);"><div class="Report1_Gender">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->Gender->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->Gender->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->Gender->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->MaritalStatus->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->MaritalStatus) == "") { ?>
	<th data-name="MaritalStatus" class="<?php echo $Report1_summary->MaritalStatus->headerCellClass() ?>"><div class="Report1_MaritalStatus"><div class="ew-table-header-caption"><?php echo $Report1_summary->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MaritalStatus" class="<?php echo $Report1_summary->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->MaritalStatus) ?>', 1);"><div class="Report1_MaritalStatus">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->DateOfBirth->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->DateOfBirth) == "") { ?>
	<th data-name="DateOfBirth" class="<?php echo $Report1_summary->DateOfBirth->headerCellClass() ?>"><div class="Report1_DateOfBirth"><div class="ew-table-header-caption"><?php echo $Report1_summary->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DateOfBirth" class="<?php echo $Report1_summary->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->DateOfBirth) ?>', 1);"><div class="Report1_DateOfBirth">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->PostalAddress->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->PostalAddress) == "") { ?>
	<th data-name="PostalAddress" class="<?php echo $Report1_summary->PostalAddress->headerCellClass() ?>"><div class="Report1_PostalAddress"><div class="ew-table-header-caption"><?php echo $Report1_summary->PostalAddress->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PostalAddress" class="<?php echo $Report1_summary->PostalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->PostalAddress) ?>', 1);"><div class="Report1_PostalAddress">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->PostalAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->PostalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->PostalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->PhysicalAddress->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->PhysicalAddress) == "") { ?>
	<th data-name="PhysicalAddress" class="<?php echo $Report1_summary->PhysicalAddress->headerCellClass() ?>"><div class="Report1_PhysicalAddress"><div class="ew-table-header-caption"><?php echo $Report1_summary->PhysicalAddress->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PhysicalAddress" class="<?php echo $Report1_summary->PhysicalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->PhysicalAddress) ?>', 1);"><div class="Report1_PhysicalAddress">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->PhysicalAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->PhysicalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->PhysicalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->TownOrVillage->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->TownOrVillage) == "") { ?>
	<th data-name="TownOrVillage" class="<?php echo $Report1_summary->TownOrVillage->headerCellClass() ?>"><div class="Report1_TownOrVillage"><div class="ew-table-header-caption"><?php echo $Report1_summary->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="TownOrVillage" class="<?php echo $Report1_summary->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->TownOrVillage) ?>', 1);"><div class="Report1_TownOrVillage">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->TownOrVillage->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->Mobile->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->Mobile) == "") { ?>
	<th data-name="Mobile" class="<?php echo $Report1_summary->Mobile->headerCellClass() ?>"><div class="Report1_Mobile"><div class="ew-table-header-caption"><?php echo $Report1_summary->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Mobile" class="<?php echo $Report1_summary->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->Mobile) ?>', 1);"><div class="Report1_Mobile">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->Mobile->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->_Email->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->_Email) == "") { ?>
	<th data-name="_Email" class="<?php echo $Report1_summary->_Email->headerCellClass() ?>"><div class="Report1__Email"><div class="ew-table-header-caption"><?php echo $Report1_summary->_Email->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="_Email" class="<?php echo $Report1_summary->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->_Email) ?>', 1);"><div class="Report1__Email">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->_Email->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->NextOfKin->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->NextOfKin) == "") { ?>
	<th data-name="NextOfKin" class="<?php echo $Report1_summary->NextOfKin->headerCellClass() ?>"><div class="Report1_NextOfKin"><div class="ew-table-header-caption"><?php echo $Report1_summary->NextOfKin->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NextOfKin" class="<?php echo $Report1_summary->NextOfKin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->NextOfKin) ?>', 1);"><div class="Report1_NextOfKin">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->NextOfKin->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->NextOfKin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->NextOfKin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->NextOfKinMobile->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->NextOfKinMobile) == "") { ?>
	<th data-name="NextOfKinMobile" class="<?php echo $Report1_summary->NextOfKinMobile->headerCellClass() ?>"><div class="Report1_NextOfKinMobile"><div class="ew-table-header-caption"><?php echo $Report1_summary->NextOfKinMobile->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NextOfKinMobile" class="<?php echo $Report1_summary->NextOfKinMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->NextOfKinMobile) ?>', 1);"><div class="Report1_NextOfKinMobile">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->NextOfKinMobile->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->NextOfKinMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->NextOfKinMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->NextOfKinEmail->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->NextOfKinEmail) == "") { ?>
	<th data-name="NextOfKinEmail" class="<?php echo $Report1_summary->NextOfKinEmail->headerCellClass() ?>"><div class="Report1_NextOfKinEmail"><div class="ew-table-header-caption"><?php echo $Report1_summary->NextOfKinEmail->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NextOfKinEmail" class="<?php echo $Report1_summary->NextOfKinEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->NextOfKinEmail) ?>', 1);"><div class="Report1_NextOfKinEmail">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->NextOfKinEmail->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->NextOfKinEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->NextOfKinEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->AdditionalInformation->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->AdditionalInformation) == "") { ?>
	<th data-name="AdditionalInformation" class="<?php echo $Report1_summary->AdditionalInformation->headerCellClass() ?>"><div class="Report1_AdditionalInformation"><div class="ew-table-header-caption"><?php echo $Report1_summary->AdditionalInformation->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="AdditionalInformation" class="<?php echo $Report1_summary->AdditionalInformation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->AdditionalInformation) ?>', 1);"><div class="Report1_AdditionalInformation">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->AdditionalInformation->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->AdditionalInformation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->AdditionalInformation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Report1_summary->TotalGroups == 0)
			break; // Show header only
		$Report1_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Report1_summary->id, $Report1_summary->getSqlFirstGroupField(), $Report1_summary->id->groupValue(), $Report1_summary->Dbid);
	if ($Report1_summary->PageFirstGroupFilter != "") $Report1_summary->PageFirstGroupFilter .= " OR ";
	$Report1_summary->PageFirstGroupFilter .= $where;
	if ($Report1_summary->Filter != "")
		$where = "($Report1_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Report1_summary->getSqlSelect(), $Report1_summary->getSqlWhere(), $Report1_summary->getSqlGroupBy(), $Report1_summary->getSqlHaving(), $Report1_summary->getSqlOrderBy(), $where, $Report1_summary->Sort);
	$rs = $Report1_summary->getRecordset($sql);
	$Report1_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Report1_summary->DetailRecordCount = count($Report1_summary->DetailRecords);
	$Report1_summary->setGroupCount($Report1_summary->DetailRecordCount, $Report1_summary->GroupCount);

	// Load detail records
	$Report1_summary->id->Records = &$Report1_summary->DetailRecords;
	$Report1_summary->id->LevelBreak = TRUE; // Set field level break
		$Report1_summary->GroupCounter[1] = $Report1_summary->GroupCount;
		$Report1_summary->id->getCnt($Report1_summary->id->Records); // Get record count
		$Report1_summary->setGroupCount($Report1_summary->id->Count, $Report1_summary->GroupCounter[1]);
?>
<?php if ($Report1_summary->id->Visible && $Report1_summary->id->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_TOTAL;
		$Report1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Report1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Report1_summary->RowGroupLevel = 1;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Report1_summary->id->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="id" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Report1_summary->id->cellAttributes() ?>>
<?php if ($Report1_summary->sortUrl($Report1_summary->id) == "") { ?>
		<span class="ew-summary-caption Report1_id"><span class="ew-table-header-caption"><?php echo $Report1_summary->id->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Report1_id" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Report1_summary->id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Report1_summary->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Report1_summary->id->viewAttributes() ?>><?php echo $Report1_summary->id->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->id->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Report1_summary->RecordCount = 0; // Reset record count
	foreach ($Report1_summary->id->Records as $record) {
		$Report1_summary->RecordCount++;
		$Report1_summary->RecordIndex++;
		$Report1_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_DETAIL;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->id->Visible) { ?>
	<?php if ($Report1_summary->id->ShowGroupHeaderAsRow) { ?>
		<td data-field="id"<?php echo $Report1_summary->id->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="id"<?php echo $Report1_summary->id->cellAttributes(); ?>><span<?php echo $Report1_summary->id->viewAttributes() ?>><?php echo $Report1_summary->id->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ClientName->Visible) { ?>
		<td data-field="ClientName"<?php echo $Report1_summary->ClientName->cellAttributes() ?>>
<span<?php echo $Report1_summary->ClientName->viewAttributes() ?>><?php echo $Report1_summary->ClientName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->ClientType->Visible) { ?>
		<td data-field="ClientType"<?php echo $Report1_summary->ClientType->cellAttributes() ?>>
<span<?php echo $Report1_summary->ClientType->viewAttributes() ?>><?php echo $Report1_summary->ClientType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->IdentityType->Visible) { ?>
		<td data-field="IdentityType"<?php echo $Report1_summary->IdentityType->cellAttributes() ?>>
<span<?php echo $Report1_summary->IdentityType->viewAttributes() ?>><?php echo $Report1_summary->IdentityType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->ClientID->Visible) { ?>
		<td data-field="ClientID"<?php echo $Report1_summary->ClientID->cellAttributes() ?>>
<span<?php echo $Report1_summary->ClientID->viewAttributes() ?>><?php echo $Report1_summary->ClientID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Report1_summary->Surname->cellAttributes() ?>>
<span<?php echo $Report1_summary->Surname->viewAttributes() ?>><?php echo $Report1_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Report1_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Report1_summary->FirstName->viewAttributes() ?>><?php echo $Report1_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Report1_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Report1_summary->MiddleName->viewAttributes() ?>><?php echo $Report1_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->Gender->Visible) { ?>
		<td data-field="Gender"<?php echo $Report1_summary->Gender->cellAttributes() ?>>
<span<?php echo $Report1_summary->Gender->viewAttributes() ?>><?php echo $Report1_summary->Gender->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->MaritalStatus->Visible) { ?>
		<td data-field="MaritalStatus"<?php echo $Report1_summary->MaritalStatus->cellAttributes() ?>>
<span<?php echo $Report1_summary->MaritalStatus->viewAttributes() ?>><?php echo $Report1_summary->MaritalStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->DateOfBirth->Visible) { ?>
		<td data-field="DateOfBirth"<?php echo $Report1_summary->DateOfBirth->cellAttributes() ?>>
<span<?php echo $Report1_summary->DateOfBirth->viewAttributes() ?>><?php echo $Report1_summary->DateOfBirth->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->PostalAddress->Visible) { ?>
		<td data-field="PostalAddress"<?php echo $Report1_summary->PostalAddress->cellAttributes() ?>>
<span<?php echo $Report1_summary->PostalAddress->viewAttributes() ?>><?php echo $Report1_summary->PostalAddress->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->PhysicalAddress->Visible) { ?>
		<td data-field="PhysicalAddress"<?php echo $Report1_summary->PhysicalAddress->cellAttributes() ?>>
<span<?php echo $Report1_summary->PhysicalAddress->viewAttributes() ?>><?php echo $Report1_summary->PhysicalAddress->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->TownOrVillage->Visible) { ?>
		<td data-field="TownOrVillage"<?php echo $Report1_summary->TownOrVillage->cellAttributes() ?>>
<span<?php echo $Report1_summary->TownOrVillage->viewAttributes() ?>><?php echo $Report1_summary->TownOrVillage->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->Mobile->Visible) { ?>
		<td data-field="Mobile"<?php echo $Report1_summary->Mobile->cellAttributes() ?>>
<span<?php echo $Report1_summary->Mobile->viewAttributes() ?>><?php echo $Report1_summary->Mobile->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->_Email->Visible) { ?>
		<td data-field="_Email"<?php echo $Report1_summary->_Email->cellAttributes() ?>>
<span<?php echo $Report1_summary->_Email->viewAttributes() ?>><?php echo $Report1_summary->_Email->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->NextOfKin->Visible) { ?>
		<td data-field="NextOfKin"<?php echo $Report1_summary->NextOfKin->cellAttributes() ?>>
<span<?php echo $Report1_summary->NextOfKin->viewAttributes() ?>><?php echo $Report1_summary->NextOfKin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->NextOfKinMobile->Visible) { ?>
		<td data-field="NextOfKinMobile"<?php echo $Report1_summary->NextOfKinMobile->cellAttributes() ?>>
<span<?php echo $Report1_summary->NextOfKinMobile->viewAttributes() ?>><?php echo $Report1_summary->NextOfKinMobile->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->NextOfKinEmail->Visible) { ?>
		<td data-field="NextOfKinEmail"<?php echo $Report1_summary->NextOfKinEmail->cellAttributes() ?>>
<span<?php echo $Report1_summary->NextOfKinEmail->viewAttributes() ?>><?php echo $Report1_summary->NextOfKinEmail->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->AdditionalInformation->Visible) { ?>
		<td data-field="AdditionalInformation"<?php echo $Report1_summary->AdditionalInformation->cellAttributes() ?>>
<span<?php echo $Report1_summary->AdditionalInformation->viewAttributes() ?>><?php echo $Report1_summary->AdditionalInformation->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Report1_summary->TotalGroups > 0) { ?>
<?php
	$Report1_summary->resetAttributes();
	$Report1_summary->RowType = ROWTYPE_TOTAL;
	$Report1_summary->RowTotalType = ROWTOTAL_GROUP;
	$Report1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Report1_summary->RowGroupLevel = 1;
	$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->id->ShowCompactSummaryFooter) { ?>
	<?php if (!$Report1_summary->id->ShowGroupHeaderAsRow) { ?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Report1_summary->id->cellAttributes() ?>>
	<?php if ($Report1_summary->id->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Report1_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->id->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Report1_summary->ClientName->Visible) { ?>
		<td data-field="ClientName"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->ClientType->Visible) { ?>
		<td data-field="ClientType"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->IdentityType->Visible) { ?>
		<td data-field="IdentityType"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->ClientID->Visible) { ?>
		<td data-field="ClientID"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->Gender->Visible) { ?>
		<td data-field="Gender"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->MaritalStatus->Visible) { ?>
		<td data-field="MaritalStatus"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->DateOfBirth->Visible) { ?>
		<td data-field="DateOfBirth"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->PostalAddress->Visible) { ?>
		<td data-field="PostalAddress"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->PhysicalAddress->Visible) { ?>
		<td data-field="PhysicalAddress"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->TownOrVillage->Visible) { ?>
		<td data-field="TownOrVillage"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->Mobile->Visible) { ?>
		<td data-field="Mobile"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->_Email->Visible) { ?>
		<td data-field="_Email"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->NextOfKin->Visible) { ?>
		<td data-field="NextOfKin"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->NextOfKinMobile->Visible) { ?>
		<td data-field="NextOfKinMobile"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->NextOfKinEmail->Visible) { ?>
		<td data-field="NextOfKinEmail"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Report1_summary->AdditionalInformation->Visible) { ?>
		<td data-field="AdditionalInformation"<?php echo $Report1_summary->id->cellAttributes() ?>></td>
<?php } ?>
	</tr>
	<?php } ?>
<?php } else { ?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"<?php echo $Report1_summary->id->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Report1_summary->id->GroupViewValue, $Report1_summary->id->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Report1_summary->id->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Report1_summary->loadGroupRowValues();

	// Show header if page break
	if ($Report1_summary->isExport())
		$Report1_summary->ShowHeader = ($Report1_summary->ExportPageBreakCount == 0) ? FALSE : ($Report1_summary->GroupCount % $Report1_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Report1_summary->ShowHeader)
		$Report1_summary->Page_Breaking($Report1_summary->ShowHeader, $Report1_summary->PageBreakContent);
	$Report1_summary->GroupCount++;
} // End while
?>
<?php if ($Report1_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Report1_summary->resetAttributes();
	$Report1_summary->RowType = ROWTYPE_TOTAL;
	$Report1_summary->RowTotalType = ROWTOTAL_GRAND;
	$Report1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Report1_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->id->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Report1_summary->rowAttributes() ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Report1_summary->rowAttributes() ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Report1_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Report1_summary->TotalGroups > 0) { ?>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div class="row">
	<div id="ew-bottom" class="<?php echo $Report1_summary->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($Report1_summary->isExport("print") || $Report1_summary->isExport("pdf") || $Report1_summary->isExport("email") || $Report1_summary->isExport("excel") && Config("USE_PHPEXCEL") || $Report1_summary->isExport("word") && Config("USE_PHPWORD")) && $Report1_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$Report1_summary->Page_Breaking($Report1_summary->ExportChartPageBreak, $Report1_summary->PageBreakContent);
		$Report1->Chart1->PageBreakType = "before"; // Page break type
		$Report1->Chart1->PageBreak = $Report1_summary->ExportChartPageBreak;
		$Report1->Chart1->PageBreakContent = $Report1_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$Report1->Chart1->DrillDownInPanel = $Report1_summary->DrillDownInPanel;

	// Update chart drill down URL from filter
	$Report1->Chart1->DrillDownUrl = str_replace("=f0", "=" . Encrypt($Report1_summary->getDrillDownSql($Report1_summary->id, "ClientName", 0, -1)), $Report1->Chart1->DrillDownUrl);
	$Report1->Chart1->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Report1_summary->isExport("email") && !$Report1_summary->DrillDown && $Report1->Chart1->hasData()) { ?>
<?php if (!$Report1_summary->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?php echo $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
	</div>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Report1_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Report1_summary->terminate();
?>