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
$property_revenu_preview = new property_revenu_preview();

// Run the page
$property_revenu_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_revenu_preview->Page_Render();
?>
<?php $property_revenu_preview->showPageHeader(); ?>
<?php if ($property_revenu_preview->TotalRecords > 0) { ?>
<div class="card ew-grid property_revenu"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$property_revenu_preview->renderListOptions();

// Render list options (header, left)
$property_revenu_preview->ListOptions->render("header", "left");
?>
<?php if ($property_revenu_preview->id->Visible) { // id ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->id) == "") { ?>
		<th class="<?php echo $property_revenu_preview->id->headerCellClass() ?>"><?php echo $property_revenu_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->id->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->id->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->id->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->ClientId->Visible) { // ClientId ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->ClientId) == "") { ?>
		<th class="<?php echo $property_revenu_preview->ClientId->headerCellClass() ?>"><?php echo $property_revenu_preview->ClientId->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->ClientId->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->ClientId->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->ClientId->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->ClientId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->ClientId->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->ClientProperty->Visible) { // ClientProperty ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->ClientProperty) == "") { ?>
		<th class="<?php echo $property_revenu_preview->ClientProperty->headerCellClass() ?>"><?php echo $property_revenu_preview->ClientProperty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->ClientProperty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->ClientProperty->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->ClientProperty->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->ClientProperty->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->ClientProperty->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->PropertyId->Visible) { // PropertyId ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->PropertyId) == "") { ?>
		<th class="<?php echo $property_revenu_preview->PropertyId->headerCellClass() ?>"><?php echo $property_revenu_preview->PropertyId->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->PropertyId->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->PropertyId->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->PropertyId->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->PropertyId->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->PropertyId->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->PropertyUse) == "") { ?>
		<th class="<?php echo $property_revenu_preview->PropertyUse->headerCellClass() ?>"><?php echo $property_revenu_preview->PropertyUse->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->PropertyUse->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->PropertyUse->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->PropertyUse->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->AmountPaid) == "") { ?>
		<th class="<?php echo $property_revenu_preview->AmountPaid->headerCellClass() ?>"><?php echo $property_revenu_preview->AmountPaid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->AmountPaid->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->AmountPaid->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->AmountPaid->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->Balance->Visible) { // Balance ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->Balance) == "") { ?>
		<th class="<?php echo $property_revenu_preview->Balance->headerCellClass() ?>"><?php echo $property_revenu_preview->Balance->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->Balance->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->Balance->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->Balance->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->Balance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->Balance->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_revenu_preview->date->Visible) { // date ?>
	<?php if ($property_revenu->SortUrl($property_revenu_preview->date) == "") { ?>
		<th class="<?php echo $property_revenu_preview->date->headerCellClass() ?>"><?php echo $property_revenu_preview->date->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $property_revenu_preview->date->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($property_revenu_preview->date->Name) ?>" data-sort-order="<?php echo $property_revenu_preview->SortField == $property_revenu_preview->date->Name && $property_revenu_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_revenu_preview->date->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_revenu_preview->SortField == $property_revenu_preview->date->Name) { ?><?php if ($property_revenu_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_revenu_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_revenu_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$property_revenu_preview->RecCount = 0;
$property_revenu_preview->RowCount = 0;
while ($property_revenu_preview->Recordset && !$property_revenu_preview->Recordset->EOF) {

	// Init row class and style
	$property_revenu_preview->RecCount++;
	$property_revenu_preview->RowCount++;
	$property_revenu_preview->CssStyle = "";
	$property_revenu_preview->loadListRowValues($property_revenu_preview->Recordset);
	$property_revenu_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$property_revenu->RowType = ROWTYPE_PREVIEW; // Preview record
	$property_revenu_preview->resetAttributes();
	$property_revenu_preview->renderListRow();

	// Render list options
	$property_revenu_preview->renderListOptions();
?>
	<tr <?php echo $property_revenu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_revenu_preview->ListOptions->render("body", "left", $property_revenu_preview->RowCount);
?>
<?php if ($property_revenu_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $property_revenu_preview->id->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->id->viewAttributes() ?>><?php echo $property_revenu_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->ClientId->Visible) { // ClientId ?>
		<!-- ClientId -->
		<td<?php echo $property_revenu_preview->ClientId->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->ClientId->viewAttributes() ?>><?php echo $property_revenu_preview->ClientId->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->ClientProperty->Visible) { // ClientProperty ?>
		<!-- ClientProperty -->
		<td<?php echo $property_revenu_preview->ClientProperty->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->ClientProperty->viewAttributes() ?>><?php echo $property_revenu_preview->ClientProperty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->PropertyId->Visible) { // PropertyId ?>
		<!-- PropertyId -->
		<td<?php echo $property_revenu_preview->PropertyId->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->PropertyId->viewAttributes() ?>><?php echo $property_revenu_preview->PropertyId->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->PropertyUse->Visible) { // PropertyUse ?>
		<!-- PropertyUse -->
		<td<?php echo $property_revenu_preview->PropertyUse->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->PropertyUse->viewAttributes() ?>><?php echo $property_revenu_preview->PropertyUse->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td<?php echo $property_revenu_preview->AmountPaid->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->AmountPaid->viewAttributes() ?>><?php echo $property_revenu_preview->AmountPaid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->Balance->Visible) { // Balance ?>
		<!-- Balance -->
		<td<?php echo $property_revenu_preview->Balance->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->Balance->viewAttributes() ?>><?php echo $property_revenu_preview->Balance->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($property_revenu_preview->date->Visible) { // date ?>
		<!-- date -->
		<td<?php echo $property_revenu_preview->date->cellAttributes() ?>>
<span<?php echo $property_revenu_preview->date->viewAttributes() ?>><?php echo $property_revenu_preview->date->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$property_revenu_preview->ListOptions->render("body", "right", $property_revenu_preview->RowCount);
?>
	</tr>
<?php
	$property_revenu_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
<?php

	// Render aggregate row
	$property_revenu->RowType = ROWTYPE_AGGREGATE; // Aggregate
	$property_revenu_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$property_revenu_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$property_revenu_preview->ListOptions->render("footer", "left");
?>
<?php if ($property_revenu_preview->id->Visible) { // id ?>
		<!-- id -->
		<td class="<?php echo $property_revenu_preview->id->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($property_revenu_preview->ClientId->Visible) { // ClientId ?>
		<!-- ClientId -->
		<td class="<?php echo $property_revenu_preview->ClientId->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($property_revenu_preview->ClientProperty->Visible) { // ClientProperty ?>
		<!-- ClientProperty -->
		<td class="<?php echo $property_revenu_preview->ClientProperty->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($property_revenu_preview->PropertyId->Visible) { // PropertyId ?>
		<!-- PropertyId -->
		<td class="<?php echo $property_revenu_preview->PropertyId->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($property_revenu_preview->PropertyUse->Visible) { // PropertyUse ?>
		<!-- PropertyUse -->
		<td class="<?php echo $property_revenu_preview->PropertyUse->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($property_revenu_preview->AmountPaid->Visible) { // AmountPaid ?>
		<!-- AmountPaid -->
		<td class="<?php echo $property_revenu_preview->AmountPaid->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $property_revenu_preview->AmountPaid->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($property_revenu_preview->Balance->Visible) { // Balance ?>
		<!-- Balance -->
		<td class="<?php echo $property_revenu_preview->Balance->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($property_revenu_preview->date->Visible) { // date ?>
		<!-- date -->
		<td class="<?php echo $property_revenu_preview->date->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$property_revenu_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $property_revenu_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($property_revenu_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($property_revenu_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$property_revenu_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($property_revenu_preview->Recordset)
	$property_revenu_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$property_revenu_preview->terminate();
?>