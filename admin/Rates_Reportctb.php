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
$Rates_Report_crosstab = new Rates_Report_crosstab();

// Run the page
$Rates_Report_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Rates_Report_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Rates_Report_crosstab->isExport() && !$Rates_Report_crosstab->DrillDown && !$DashboardReport) { ?>
<script>
var fcrosstab, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fcrosstab = currentForm = new ew.Form("fcrosstab", "crosstab");
	currentPageID = ew.PAGE_ID = "crosstab";

	// Validate function for search
	fcrosstab.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcrosstab.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcrosstab.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fcrosstab.filterList = <?php echo $Rates_Report_crosstab->getFilterList() ?>;
	loadjs.done("fcrosstab");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Rates_Report_crosstab->ShowCurrentFilter) { ?>
<?php $Rates_Report_crosstab->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Rates_Report_crosstab->DrillDownInPanel) {
	$Rates_Report_crosstab->ExportOptions->render("body");
	$Rates_Report_crosstab->SearchOptions->render("body");
	$Rates_Report_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Rates_Report_crosstab->showPageHeader(); ?>
<?php
$Rates_Report_crosstab->showMessage();
?>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Rates_Report_crosstab->CenterContentClass ?>">
<?php } ?>
<!-- Crosstab report (begin) -->
<div id="report_crosstab">
<?php if (!$Rates_Report_crosstab->isExport() && !$Rates_Report_crosstab->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Rates_Report_crosstab->isExport() && !$Rates_Report->CurrentAction) { ?>
<form name="fcrosstab" id="fcrosstab" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcrosstab-search-panel" class="<?php echo $Rates_Report_crosstab->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Rates_Report">
	<div class="ew-extended-search">
<?php

// Render search row
$Rates_Report->RowType = ROWTYPE_SEARCH;
$Rates_Report->resetAttributes();
$Rates_Report_crosstab->renderRow();
?>
<?php if ($Rates_Report_crosstab->date->Visible) { // date ?>
	<?php
		$Rates_Report_crosstab->SearchColumnCount++;
		if (($Rates_Report_crosstab->SearchColumnCount - 1) % $Rates_Report_crosstab->SearchFieldsPerRow == 0) {
			$Rates_Report_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Rates_Report_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_date" class="ew-cell form-group">
	<label for="YEAR__date" class="ew-search-caption ew-label"><?php echo $Language->phrase("Year") ?></label>
	<span class="ew-search-field">
	<select id="YEAR__date" class="form-control" name="YEAR__date">
<?php

// Set up array
if (is_array($Rates_Report_crosstab->YEAR__date->DistinctValues)) {
	$yearCount = count($Rates_Report_crosstab->YEAR__date->DistinctValues);
	for ($yearIndex = 0; $yearIndex < $yearCount; $yearIndex++) {
		$yearValue = $Rates_Report_crosstab->YEAR__date->DistinctValues[$yearIndex];
		$yearSelected = (strval($yearValue) == strval($Rates_Report_crosstab->YEAR__date->CurrentValue)) ? " selected" : "";
?>
	<option value="<?php echo $yearValue ?>"<?php echo $yearSelected ?>><?php echo $yearValue ?></option>
<?php
	}
}
?>
	</select>
	</span>
	</div>
	<?php if ($Rates_Report_crosstab->SearchColumnCount % $Rates_Report_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Rates_Report_crosstab->SearchColumnCount % $Rates_Report_crosstab->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Rates_Report_crosstab->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Rates_Report_crosstab->GroupCount <= count($Rates_Report_crosstab->GroupRecords) && $Rates_Report_crosstab->GroupCount <= $Rates_Report_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Rates_Report_crosstab->ShowHeader) {
?>
<?php if ($Rates_Report_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Rates_Report_crosstab->TotalGroups > 0) { ?>
<?php if (!$Rates_Report_crosstab->isExport() && !($Rates_Report_crosstab->DrillDown && $Rates_Report_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Rates_Report_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Rates_Report_crosstab->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Rates_Report_crosstab->isExport("word") && !$Rates_Report_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Rates_Report_crosstab->ReportTableStyle ?>>
<?php if (!$Rates_Report_crosstab->isExport() && !($Rates_Report_crosstab->DrillDown && $Rates_Report_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Rates_Report_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Rates_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Rates_Report_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Rates_Report_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Rates_Report_crosstab->GroupColumnCount ?>"><div><?php echo $Rates_Report_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Rates_Report_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Rates_Report_crosstab->date->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Rates_Report_crosstab->ChargeGroupName->Visible) { ?>
	<td data-field="ChargeGroupName">
<?php if ($Rates_Report_crosstab->sortUrl($Rates_Report_crosstab->ChargeGroupName) == "") { ?>
		<div class="ew-table-header-btn Rates_Report_ChargeGroupName" style="white-space: nowrap;">
			<span class="ew-table-header-caption"><?php echo $Rates_Report_crosstab->ChargeGroupName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Rates_Report_ChargeGroupName" onclick="ew.sort(event, '<?php echo $Rates_Report_crosstab->sortUrl($Rates_Report_crosstab->ChargeGroupName) ?>', 1);" style="white-space: nowrap;">
			<span class="ew-table-header-caption"><?php echo $Rates_Report_crosstab->ChargeGroupName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Rates_Report_crosstab->ChargeGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Rates_Report_crosstab->ChargeGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Rates_Report_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Rates_Report_crosstab->Columns[$iy]->Visible) {
			$Rates_Report_crosstab->SummaryCurrentValues[$iy-1] = $Rates_Report_crosstab->Columns[$iy]->Caption;
			$Rates_Report_crosstab->SummaryViewValues[$iy-1] = FormatDateTime($Rates_Report_crosstab->SummaryCurrentValues[$iy-1], 7);
?>
		<td class="ew-table-header"<?php echo $Rates_Report_crosstab->date->cellAttributes() ?>><div<?php echo $Rates_Report_crosstab->date->viewAttributes() ?>><?php echo $Rates_Report_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
		<td class="ew-table-header"<?php echo $Rates_Report_crosstab->date->cellAttributes() ?>><div<?php echo $Rates_Report_crosstab->date->viewAttributes() ?>><?php echo $Rates_Report_crosstab->renderSummaryCaptions() ?></div></td>
	</tr>
</thead>
<tbody>
<?php
		if ($Rates_Report_crosstab->TotalGroups == 0)
			break; // Show header only
		$Rates_Report_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Rates_Report_crosstab->ChargeGroupName, $Rates_Report_crosstab->getSqlFirstGroupField(), $Rates_Report_crosstab->ChargeGroupName->groupValue(), $Rates_Report_crosstab->Dbid);
	if ($Rates_Report_crosstab->PageFirstGroupFilter != "") $Rates_Report_crosstab->PageFirstGroupFilter .= " OR ";
	$Rates_Report_crosstab->PageFirstGroupFilter .= $where;
	if ($Rates_Report_crosstab->Filter != "")
		$where = "($Rates_Report_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Rates_Report_crosstab->DistinctColumnFields, $Rates_Report_crosstab->getSqlSelect()), $Rates_Report_crosstab->getSqlWhere(), $Rates_Report_crosstab->getSqlGroupBy(), "", $Rates_Report_crosstab->getSqlOrderBy(), $where, $Rates_Report_crosstab->Sort);
	$rs = $Rates_Report_crosstab->getRecordset($sql);
	$Rates_Report_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Rates_Report_crosstab->DetailRecordCount = count($Rates_Report_crosstab->DetailRecords);

	// Load detail records
	$Rates_Report_crosstab->ChargeGroupName->Records = &$Rates_Report_crosstab->DetailRecords;
	$Rates_Report_crosstab->ChargeGroupName->LevelBreak = TRUE; // Set field level break
	foreach ($Rates_Report_crosstab->ChargeGroupName->Records as $record) {
		$Rates_Report_crosstab->RecordCount++;
		$Rates_Report_crosstab->RecordIndex++;
		$Rates_Report_crosstab->loadRowValues($record);

		// Render row
		$Rates_Report_crosstab->resetAttributes();
		$Rates_Report_crosstab->RowType = ROWTYPE_DETAIL;
		$Rates_Report_crosstab->renderRow();
?>
	<tr<?php echo $Rates_Report_crosstab->rowAttributes(); ?>>
<?php if ($Rates_Report_crosstab->ChargeGroupName->Visible) { ?>
		<!-- ChargeGroupName -->
		<td data-field="ChargeGroupName"<?php echo $Rates_Report_crosstab->ChargeGroupName->cellAttributes(); ?>><span<?php echo $Rates_Report_crosstab->ChargeGroupName->viewAttributes() ?>><?php echo $Rates_Report_crosstab->ChargeGroupName->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Rates_Report_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Rates_Report_crosstab->ColumnCount) ? $Rates_Report_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Rates_Report_crosstab->ColumnCount) ? $Rates_Report_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Rates_Report_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Rates_Report_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
?>
<?php

	// Next group
	$Rates_Report_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Rates_Report_crosstab->isExport())
		$Rates_Report_crosstab->ShowHeader = ($Rates_Report_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Rates_Report_crosstab->GroupCount % $Rates_Report_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Rates_Report_crosstab->ShowHeader)
		$Rates_Report_crosstab->Page_Breaking($Rates_Report_crosstab->ShowHeader, $Rates_Report_crosstab->PageBreakContent);
	$Rates_Report_crosstab->GroupCount++;
} // End while
?>
<?php if ($Rates_Report_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Rates_Report_crosstab->StopGroup - $Rates_Report_crosstab->StartGroup + 1) != $Rates_Report_crosstab->TotalGroups) { ?>
<?php
	$Rates_Report_crosstab->resetAttributes();
	$Rates_Report_crosstab->RowType = ROWTYPE_TOTAL;
	$Rates_Report_crosstab->RowTotalType = ROWTOTAL_PAGE;
	$Rates_Report_crosstab->RowAttrs["class"] = "ew-rpt-page-summary";
	$Rates_Report_crosstab->renderRow();
?>
	<!-- Page Summary -->
	<tr<?php echo $Rates_Report_crosstab->rowAttributes(); ?>>
<?php if ($Rates_Report_crosstab->GroupColumnCount > 0) { ?>
	<td colspan="<?php echo $Rates_Report_crosstab->GroupColumnCount ?>"><?php echo $Rates_Report_crosstab->renderSummaryCaptions("page") ?></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Rates_Report_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Rates_Report_crosstab->ColumnCount) ? $Rates_Report_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Rates_Report_crosstab->ColumnCount) ? $Rates_Report_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Rates_Report_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Rates_Report_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
<?php
	$Rates_Report_crosstab->resetAttributes();
	$Rates_Report_crosstab->RowType = ROWTYPE_TOTAL;
	$Rates_Report_crosstab->RowTotalType = ROWTOTAL_GRAND;
	$Rates_Report_crosstab->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Rates_Report_crosstab->renderRow();
?>
	<!-- Grand Total -->
	<tr<?php echo $Rates_Report_crosstab->rowAttributes(); ?>>
<?php if ($Rates_Report_crosstab->GroupColumnCount > 0) { ?>
	<td colspan="<?php echo $Rates_Report_crosstab->GroupColumnCount ?>"><?php echo $Rates_Report_crosstab->renderSummaryCaptions("grand") ?></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Rates_Report_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Rates_Report_crosstab->ColumnCount) ? $Rates_Report_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Rates_Report_crosstab->ColumnCount) ? $Rates_Report_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Rates_Report_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Rates_Report_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Rates_Report_crosstab->TotalGroups > 0) { ?>
<?php if (!$Rates_Report_crosstab->isExport() && !($Rates_Report_crosstab->DrillDown && $Rates_Report_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Rates_Report_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-crosstab -->
<!-- Crosstab report (end) -->
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div class="row">
	<div id="ew-bottom" class="<?php echo $Rates_Report_crosstab->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($Rates_Report_crosstab->isExport("print") || $Rates_Report_crosstab->isExport("pdf") || $Rates_Report_crosstab->isExport("email") || $Rates_Report_crosstab->isExport("excel") && Config("USE_PHPEXCEL") || $Rates_Report_crosstab->isExport("word") && Config("USE_PHPWORD")) && $Rates_Report_crosstab->ExportChartPageBreak) {

		// Page_Breaking server event
		$Rates_Report_crosstab->Page_Breaking($Rates_Report_crosstab->ExportChartPageBreak, $Rates_Report_crosstab->PageBreakContent);
		$Rates_Report->AnalysisChart->PageBreakType = "before"; // Page break type
		$Rates_Report->AnalysisChart->PageBreak = $Rates_Report_crosstab->ExportChartPageBreak;
		$Rates_Report->AnalysisChart->PageBreakContent = $Rates_Report_crosstab->PageBreakContent;
	}

	// Set up chart drilldown
	$Rates_Report->AnalysisChart->DrillDownInPanel = $Rates_Report_crosstab->DrillDownInPanel;
	$Rates_Report->AnalysisChart->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Rates_Report_crosstab->isExport("email") && !$Rates_Report_crosstab->DrillDown && $Rates_Report->AnalysisChart->hasData()) { ?>
<?php if (!$Rates_Report_crosstab->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?php echo $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
	</div>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if ((!$Rates_Report_crosstab->isExport() || $Rates_Report_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Rates_Report_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Rates_Report_crosstab->isExport() && !$Rates_Report_crosstab->DrillDown && !$DashboardReport) { ?>
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
$Rates_Report_crosstab->terminate();
?>