<?php namespace PHPMaker2020\revenue; ?>
<?php

/**
 * Table class for Rates_Report
 */
class Rates_Report extends CrosstabTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;
	public $AnalysisChart;
	public $YEAR__date;

	// Fields
	public $ChargeGroupName;
	public $AmountPayable;
	public $AmountPaid;
	public $Balance;
	public $date;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'Rates_Report';
		$this->TableName = 'Rates_Report';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`reportview`";
		$this->ReportSourceTable = 'reportview'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// ChargeGroupName
		$this->ChargeGroupName = new ReportField('Rates_Report', 'Rates_Report', 'x_ChargeGroupName', 'ChargeGroupName', '`ChargeGroupName`', '`ChargeGroupName`', 200, 100, -1, FALSE, '`ChargeGroupName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeGroupName->GroupingFieldId = 1;
		$this->ChargeGroupName->Sortable = TRUE; // Allow sort
		$this->ChargeGroupName->SourceTableVar = 'reportview';
		$this->fields['ChargeGroupName'] = &$this->ChargeGroupName;

		// AmountPayable
		$this->AmountPayable = new ReportField('Rates_Report', 'Rates_Report', 'x_AmountPayable', 'AmountPayable', '`AmountPayable`', '`AmountPayable`', 5, 10, -1, FALSE, '`AmountPayable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPayable->Sortable = TRUE; // Allow sort
		$this->AmountPayable->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->AmountPayable->SourceTableVar = 'reportview';
		$this->fields['AmountPayable'] = &$this->AmountPayable;

		// AmountPaid
		$this->AmountPaid = new ReportField('Rates_Report', 'Rates_Report', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 10, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->AmountPaid->SourceTableVar = 'reportview';
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// Balance
		$this->Balance = new ReportField('Rates_Report', 'Rates_Report', 'x_Balance', 'Balance', '`Balance`', '`Balance`', 5, 10, -1, FALSE, '`Balance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Balance->Sortable = TRUE; // Allow sort
		$this->Balance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->Balance->SourceTableVar = 'reportview';
		$this->fields['Balance'] = &$this->Balance;

		// date
		$this->date = new ReportField('Rates_Report', 'Rates_Report', 'x_date', 'date', '`date`', CastDateFieldForLike("`date`", 7, "DB"), 135, 19, 7, FALSE, '`date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date->Sortable = TRUE; // Allow sort
		$this->date->LookupExpression = "YEAR(`date`)";
		$this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->date->SourceTableVar = 'reportview';
		$this->fields['date'] = &$this->date;

		// YEAR__date
		$this->YEAR__date = new ReportField('Rates_Report', 'Rates_Report', 'x_YEAR__date', 'YEAR__date', 'YEAR(`date`)', '', 3, -1, -1, FALSE, '', FALSE, FALSE, FALSE);
		$this->fields['YEAR__date'] = &$this->YEAR__date;

		// AnalysisChart
		$this->AnalysisChart = new DbChart($this, 'AnalysisChart', 'AnalysisChart', 'date', 'AmountPaid', 1001, '', 0, 'SUM', 600, 500);
		$this->AnalysisChart->SortType = 0;
		$this->AnalysisChart->SortSequence = "";
		$this->AnalysisChart->SqlSelect = "SELECT MONTH(`date`), '', SUM(`AmountPaid`) FROM ";
		$this->AnalysisChart->SqlGroupBy = "MONTH(`date`)";
		$this->AnalysisChart->SqlOrderBy = "";
		$this->AnalysisChart->SeriesDateType = "xm";
		$this->AnalysisChart->XAxisDateFormat = 7;
		$this->AnalysisChart->ID = "Rates_Report_AnalysisChart"; // Chart ID
		$this->AnalysisChart->setParameters([
			["type", "1001"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->AnalysisChart->setParameters([
			["caption", $this->AnalysisChart->caption()],
			["xaxisname", $this->AnalysisChart->xAxisName()]
		]); // Chart caption / X axis name
		$this->AnalysisChart->setParameter("yaxisname", $this->AnalysisChart->yAxisName()); // Y axis name
		$this->AnalysisChart->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "1"]
		]); // Show names / Show values / Show hover
		$this->AnalysisChart->setParameter("alpha", "50"); // Chart alpha
		$this->AnalysisChart->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->AnalysisChart->setParameters([["options.legend.display",false],["options.legend.fullWidth",false],["options.legend.reverse",false],["options.legend.labels.usePointStyle",false],["options.title.display",false],["options.tooltips.enabled",false],["options.tooltips.intersect",false],["options.tooltips.displayColors",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["scale.gridLines.offsetGridLines",false]]);
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->ChargeGroupName;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Crosstab properties
	private $_sqlSelectAggregate = "";
	private $_sqlGroupByAggregate = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT YEAR(`date`) AS `YEAR__date`, {DistinctColumnFields} FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Group By Aggregate
	public function getSqlGroupByAggregate()
	{
		return ($this->_sqlGroupByAggregate != "") ? $this->_sqlGroupByAggregate : "YEAR(`date`)";
	}
	public function setSqlGroupByAggregate($v)
	{
		$this->_sqlGroupByAggregate = $v;
	}

	// Table level SQL
	private $_columnField = "";
	private $_columnDateType = "";
	private $_columnCaptions = "";
	private $_columnNames = "";
	private $_columnValues = "";
	private $_sqlCrosstabYear = "";
	public $Columns;
	public $ColumnCount;
	public $Col;
	public $DistinctColumnFields = "";
	private $_columnLoaded = FALSE;

	// Column field
	public function getColumnField()
	{
		return ($this->_columnField != "") ? $this->_columnField : "`date`";
	}
	public function setColumnField($v)
	{
		$this->_columnField = $v;
	}

	// Column date type
	public function getColumnDateType()
	{
		return ($this->_columnDateType != "") ? $this->_columnDateType : "m";
	}
	public function setColumnDateType($v)
	{
		$this->_columnDateType = $v;
	}

	// Column captions
	public function getColumnCaptions()
	{
		global $Language;
		return ($this->_columnCaptions != "") ? $this->_columnCaptions : $Language->phrase("MonthJan") . "," . $Language->phrase("MonthFeb") . "," . $Language->phrase("MonthMar") . "," . $Language->phrase("MonthApr") . "," . $Language->phrase("MonthMay") . "," . $Language->phrase("MonthJun") . "," . $Language->phrase("MonthJul") . "," . $Language->phrase("MonthAug") . "," . $Language->phrase("MonthSep") . "," . $Language->phrase("MonthOct") . "," . $Language->phrase("MonthNov") . "," . $Language->phrase("MonthDec");
	}
	public function setColumnCaptions($v)
	{
		$this->_columnCaptions = $v;
	}

	// Column names
	public function getColumnNames()
	{
		return ($this->_columnNames != "") ? $this->_columnNames : "MonthJan,MonthFeb,MonthMar,MonthApr,MonthMay,MonthJun,MonthJul,MonthAug,MonthSep,MonthOct,MonthNov,MonthDec";
	}
	public function setColumnNames($v)
	{
		$this->_columnNames = $v;
	}

	// Column values
	public function getColumnValues()
	{
		return ($this->_columnValues != "") ? $this->_columnValues : "1,2,3,4,5,6,7,8,9,10,11,12";
	}
	public function setColumnValues($v)
	{
		$this->_columnValues = $v;
	}

	// Crosstab Year
	public function getSqlCrosstabYear()
	{
		return ($this->_sqlCrosstabYear != "") ? $this->_sqlCrosstabYear : "SELECT DISTINCT YEAR(`date`) AS `YEAR__date` FROM `reportview` ORDER BY YEAR(`date`)";
	}
	public function setSqlCrosstabYear($v)
	{
		$this->_sqlCrosstabYear = $v;
	}

	// Load column values
	public function loadColumnValues($filter = "")
	{
		global $Language;

		// Data already loaded, return
		if ($this->_columnLoaded)
			return;
		$conn = $this->getConnection();
		$arColumnCaptions = explode(",", $this->getColumnCaptions());
		$arColumnNames = explode(",", $this->getColumnNames());
		$arColumnValues = explode(",", $this->getColumnValues());

		// Get distinct column count
		$this->ColumnCount = count($arColumnNames);
		$this->Columns = Init2DArray($this->ColumnCount + 1, 2, NULL);
		for ($colcnt = 1; $colcnt <= $this->ColumnCount; $colcnt++)
			$this->Columns[$colcnt] = new CrosstabColumn($arColumnValues[$colcnt - 1], $arColumnCaptions[$colcnt - 1], TRUE);

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$groupCount = 1;
		$this->SummaryFields[0] = new SummaryField('x_AmountPayable', 'AmountPayable', '`AmountPayable`', 'SUM');
		$this->SummaryFields[0]->SummaryCaption = $Language->phrase("RptSum");
		$this->SummaryFields[0]->SummaryValues = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryValueCounts = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[0]->SummaryInitValue = 0;
		$this->SummaryFields[1] = new SummaryField('x_AmountPaid', 'AmountPaid', '`AmountPaid`', 'SUM');
		$this->SummaryFields[1]->SummaryCaption = $Language->phrase("RptSum");
		$this->SummaryFields[1]->SummaryValues = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[1]->SummaryValueCounts = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[1]->SummaryInitValue = 0;
		$this->SummaryFields[2] = new SummaryField('x_Balance', 'Balance', '`Balance`', 'SUM');
		$this->SummaryFields[2]->SummaryCaption = $Language->phrase("RptSum");
		$this->SummaryFields[2]->SummaryValues = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[2]->SummaryValueCounts = InitArray($this->ColumnCount+1, NULL);
		$this->SummaryFields[2]->SummaryInitValue = 0;

		// Update crosstab SQL
		$sqlFlds = "";
		$cnt = count($this->SummaryFields);
		for ($is = 0; $is < $cnt; $is++) {
			$smry = &$this->SummaryFields[$is];
			for ($i = 0; $i < $this->ColumnCount; $i++) {
				$fld = CrosstabFieldExpression($smry->SummaryType, $smry->Expression,
					$this->getColumnField(), $this->getColumnDateType(), $arColumnValues[$i], "", $arColumnNames[$i] . $is, $this->Dbid);
				if ($sqlFlds != "")
					$sqlFlds .= ", ";
				$sqlFlds .= $fld;
			}
		}
		$this->DistinctColumnFields = $sqlFlds ?: "NULL"; // In case ColumnCount = 0
		$this->_columnLoaded = TRUE;
	}

	// Render for lookup
	public function renderLookup()
	{
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`reportview`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT `ChargeGroupName`, YEAR(`date`) AS `YEAR__date`, {DistinctColumnFields} FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "`ChargeGroupName`, YEAR(`date`)";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>