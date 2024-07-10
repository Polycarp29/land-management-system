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
WriteHeader(FALSE, "utf-8");

// Create page object
$property_preview = new property_preview();

// Run the page
$property_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_preview->Page_Render();
?>
<?php $property_preview->showPageHeader(); ?>
<?php if ($property_preview->TotalRecords > 0) { ?>
<div class="card ew-grid property"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$property_preview->renderListOptions();

// Render list options (header, left)
$property_preview->ListOptions->render("header", "left");
?>
<?php if ($property_preview->id->Visible) { // id ?>
	<?php if ($property->SortUrl($property_preview->id) == "") { ?>
		<th class="<?php echo $property_preview->id->headerCellClass() ?>"><?php echo $property_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->id->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->id->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->id->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ClientId->Visible) { // ClientId ?>
	<?php if ($property->SortUrl($property_preview->ClientId) == "") { ?>
		<th class="<?php echo $property_preview->ClientId->headerCellClass() ?>"><?php echo $property_preview->ClientId->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ClientId->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ClientId->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ClientId->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ClientId->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property->SortUrl($property_preview->ChargeGroup) == "") { ?>
		<th class="<?php echo $property_preview->ChargeGroup->headerCellClass() ?>"><?php echo $property_preview->ChargeGroup->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ChargeGroup->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ChargeGroup->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ChargeGroup->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
	<?php if ($property->SortUrl($property_preview->ChargeGropuDes) == "") { ?>
		<th class="<?php echo $property_preview->ChargeGropuDes->headerCellClass() ?>"><?php echo $property_preview->ChargeGropuDes->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ChargeGropuDes->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ChargeGropuDes->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ChargeGropuDes->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ChargeGropuDes->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ChargeGropuDes->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->ChargeableFee->Visible) { // ChargeableFee ?>
	<?php if ($property->SortUrl($property_preview->ChargeableFee) == "") { ?>
		<th class="<?php echo $property_preview->ChargeableFee->headerCellClass() ?>"><?php echo $property_preview->ChargeableFee->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->ChargeableFee->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->ChargeableFee->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->ChargeableFee->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->ChargeableFee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->ChargeableFee->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property->SortUrl($property_preview->BalanceBF) == "") { ?>
		<th class="<?php echo $property_preview->BalanceBF->headerCellClass() ?>"><?php echo $property_preview->BalanceBF->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->BalanceBF->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->BalanceBF->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->BalanceBF->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->AmountPayable->Visible) { // AmountPayable ?>
	<?php if ($property->SortUrl($property_preview->AmountPayable) == "") { ?>
		<th class="<?php echo $property_preview->AmountPayable->headerCellClass() ?>"><?php echo $property_preview->AmountPayable->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->AmountPayable->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->AmountPayable->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->AmountPayable->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->AmountPayable->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->AmountPayable->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Property->Visible) { // Property ?>
	<?php if ($property->SortUrl($property_preview->Property) == "") { ?>
		<th class="<?php echo $property_preview->Property->headerCellClass() ?>"><?php echo $property_preview->Property->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Property->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Property->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Property->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Property->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Property->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->PropertyId->Visible) { // PropertyId ?>
	<?php if ($property->SortUrl($property_preview->PropertyId) == "") { ?>
		<th class="<?php echo $property_preview->PropertyId->headerCellClass() ?>"><?php echo $property_preview->PropertyId->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyId->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyId->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyId->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyId->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property->SortUrl($property_preview->PropertyUse) == "") { ?>
		<th class="<?php echo $property_preview->PropertyUse->headerCellClass() ?>"><?php echo $property_preview->PropertyUse->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->PropertyUse->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->PropertyUse->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->PropertyUse->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Location->Visible) { // Location ?>
	<?php if ($property->SortUrl($property_preview->Location) == "") { ?>
		<th class="<?php echo $property_preview->Location->headerCellClass() ?>"><?php echo $property_preview->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Location->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Location->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Location->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property->SortUrl($property_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $property_preview->AmountPaid->headerCellClass() ?>"><?php echo $property_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->AmountPaid->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->AmountPaid->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->CurrentBalance->Visible) { // CurrentBalance ?>
	<?php if ($property->SortUrl($property_preview->CurrentBalance) == "") { ?>
		<th class="<?php echo $property_preview->CurrentBalance->headerCellClass() ?>"><?php echo $property_preview->CurrentBalance->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->CurrentBalance->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->CurrentBalance->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->CurrentBalance->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->CurrentBalance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->CurrentBalance->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->DataRegistered->Visible) { // DataRegistered ?>
	<?php if ($property->SortUrl($property_preview->DataRegistered) == "") { ?>
		<th class="<?php echo $property_preview->DataRegistered->headerCellClass() ?>"><?php echo $property_preview->DataRegistered->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->DataRegistered->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->DataRegistered->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->DataRegistered->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->DataRegistered->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->DataRegistered->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_preview->Status->Visible) { // Status ?>
	<?php if ($property->SortUrl($property_preview->Status) == "") { ?>
		<th class="<?php echo $property_preview->Status->headerCellClass() ?>"><?php echo $property_preview->Status->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_preview->Status->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_preview->Status->Name) ?>" data-sort-order="<?php echo $property_preview->SortField == $property_preview->Status->Name && $property_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_preview->Status->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_preview->SortField == $property_preview->Status->Name) { ?><?php if ($property_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$property_preview->RecCount = 0;
$property_preview->RowCount = 0;
while ($property_preview->Recordset && !$property_preview->Recordset->EOF) {

	// Init row class and style
	$property_preview->RecCount++;
	$property_preview->RowCount++;
	$property_preview->CssStyle = "";
	$property_preview->loadListRowValues($property_preview->Recordset);

	// Render row
	$property->RowType = ROWTYPE_PREVIEW; // Preview record
	$property_preview->resetAttributes();
	$property_preview->renderListRow();

	// Render list options
	$property_preview->renderListOptions();
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_preview->ListOptions->render("body", "left", $property_preview->RowCount);
?>
<?php if ($property_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $property_preview->id->cellAttributes() ?>>
<span<?php echo $property_preview->id->viewAttributes() ?>><?php echo $property_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ClientId->Visible) { // ClientId ?>
		<!-- ClientId -->
		<td<?php echo $property_preview->ClientId->cellAttributes() ?>>
<span<?php echo $property_preview->ClientId->viewAttributes() ?>><?php echo $property_preview->ClientId->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ChargeGroup->Visible) { // ChargeGroup ?>
		<!-- ChargeGroup -->
		<td<?php echo $property_preview->ChargeGroup->cellAttributes() ?>>
<span<?php echo $property_preview->ChargeGroup->viewAttributes() ?>><?php echo $property_preview->ChargeGroup->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ChargeGropuDes->Visible) { // ChargeGropuDes ?>
		<!-- ChargeGropuDes -->
		<td<?php echo $property_preview->ChargeGropuDes->cellAttributes() ?>>
<span<?php echo $property_preview->ChargeGropuDes->viewAttributes() ?>><?php echo $property_preview->ChargeGropuDes->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->ChargeableFee->Visible) { // ChargeableFee ?>
		<!-- ChargeableFee -->
		<td<?php echo $property_preview->ChargeableFee->cellAttributes() ?>>
<span<?php echo $property_preview->ChargeableFee->viewAttributes() ?>><?php echo $property_preview->ChargeableFee->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->BalanceBF->Visible) { // BalanceBF ?>
		<!-- BalanceBF -->
		<td<?php echo $property_preview->BalanceBF->cellAttributes() ?>>
<span<?php echo $property_preview->BalanceBF->viewAttributes() ?>><?php echo $property_preview->BalanceBF->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->AmountPayable->Visible) { // AmountPayable ?>
		<!-- AmountPayable -->
		<td<?php echo $property_preview->AmountPayable->cellAttributes() ?>>
<span<?php echo $property_preview->AmountPayable->viewAttributes() ?>><?php echo $property_preview->AmountPayable->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Property->Visible) { // Property ?>
		<!-- Property -->
		<td<?php echo $property_preview->Property->cellAttributes() ?>>
<span<?php echo $property_preview->Property->viewAttributes() ?>><?php echo $property_preview->Property->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->PropertyId->Visible) { // PropertyId ?>
		<!-- PropertyId -->
		<td<?php echo $property_preview->PropertyId->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyId->viewAttributes() ?>><?php echo $property_preview->PropertyId->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->PropertyUse->Visible) { // PropertyUse ?>
		<!-- PropertyUse -->
		<td<?php echo $property_preview->PropertyUse->cellAttributes() ?>>
<span<?php echo $property_preview->PropertyUse->viewAttributes() ?>><?php echo $property_preview->PropertyUse->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $property_preview->Location->cellAttributes() ?>>
<span<?php echo $property_preview->Location->viewAttributes() ?>><?php echo $property_preview->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $property_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $property_preview->AmountPaid->viewAttributes() ?>><?php echo $property_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->CurrentBalance->Visible) { // CurrentBalance ?>
		<!-- CurrentBalance -->
		<td<?php echo $property_preview->CurrentBalance->cellAttributes() ?>>
<span<?php echo $property_preview->CurrentBalance->viewAttributes() ?>><?php echo $property_preview->CurrentBalance->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->DataRegistered->Visible) { // DataRegistered ?>
		<!-- DataRegistered -->
		<td<?php echo $property_preview->DataRegistered->cellAttributes() ?>>
<span<?php echo $property_preview->DataRegistered->viewAttributes() ?>><?php echo $property_preview->DataRegistered->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_preview->Status->Visible) { // Status ?>
		<!-- Status -->
		<td<?php echo $property_preview->Status->cellAttributes() ?>>
<span<?php echo $property_preview->Status->viewAttributes() ?>><?php echo $property_preview->Status->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$property_preview->ListOptions->render("body", "right", $property_preview->RowCount);
?>
	</tr>
<?php
	$property_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $property_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($property_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($property_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$property_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($property_preview->Recordset)
	$property_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$property_preview->terminate();
?>