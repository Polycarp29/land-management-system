<?php namespace PHPMaker2020\revenue; ?>
<?php

/**
 * Table class for property_revenu
 */
class property_revenu extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $ClientId;
	public $ClientProperty;
	public $PropertyId;
	public $PropertyUse;
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
		$this->TableVar = 'property_revenu';
		$this->TableName = 'property_revenu';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`property_revenu`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('property_revenu', 'property_revenu', 'x_id', 'id', '`id`', '`id`', 3, 255, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// ClientId
		$this->ClientId = new DbField('property_revenu', 'property_revenu', 'x_ClientId', 'ClientId', '`ClientId`', '`ClientId`', 3, 100, -1, FALSE, '`ClientId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ClientId->IsForeignKey = TRUE; // Foreign key field
		$this->ClientId->Sortable = TRUE; // Allow sort
		$this->ClientId->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ClientId->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ClientId->Lookup = new Lookup('ClientId', 'client', FALSE, 'id', ["ClientName","","",""], [], ["x_ClientProperty"], [], [], [], [], '', '');
		$this->ClientId->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientId'] = &$this->ClientId;

		// ClientProperty
		$this->ClientProperty = new DbField('property_revenu', 'property_revenu', 'x_ClientProperty', 'ClientProperty', '`ClientProperty`', '`ClientProperty`', 3, 100, -1, FALSE, '`ClientProperty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ClientProperty->Sortable = TRUE; // Allow sort
		$this->ClientProperty->Lookup = new Lookup('ClientProperty', 'property', FALSE, 'id', ["Property","","",""], ["x_ClientId"], [], ["ClientId"], ["x_ClientId"], ["PropertyUse","CurrentBalance","PropertyId"], ["x_PropertyUse","x_AmountPayable","x_PropertyId"], '', '');
		$this->ClientProperty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientProperty'] = &$this->ClientProperty;

		// PropertyId
		$this->PropertyId = new DbField('property_revenu', 'property_revenu', 'x_PropertyId', 'PropertyId', '`PropertyId`', '`PropertyId`', 200, 10, -1, FALSE, '`PropertyId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyId->Sortable = TRUE; // Allow sort
		$this->fields['PropertyId'] = &$this->PropertyId;

		// PropertyUse
		$this->PropertyUse = new DbField('property_revenu', 'property_revenu', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 100, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// AmountPayable
		$this->AmountPayable = new DbField('property_revenu', 'property_revenu', 'x_AmountPayable', 'AmountPayable', '`AmountPayable`', '`AmountPayable`', 5, 10, -1, FALSE, '`AmountPayable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPayable->Sortable = FALSE; // Allow sort
		$this->AmountPayable->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPayable'] = &$this->AmountPayable;

		// AmountPaid
		$this->AmountPaid = new DbField('property_revenu', 'property_revenu', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 10, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// Balance
		$this->Balance = new DbField('property_revenu', 'property_revenu', 'x_Balance', 'Balance', '`Balance`', '`Balance`', 5, 10, -1, FALSE, '`Balance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Balance->Sortable = TRUE; // Allow sort
		$this->Balance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Balance'] = &$this->Balance;

		// date
		$this->date = new DbField('property_revenu', 'property_revenu', 'x_date', 'date', '`date`', CastDateFieldForLike("`date`", 7, "DB"), 135, 19, 7, FALSE, '`date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date->Sortable = TRUE; // Allow sort
		$this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['date'] = &$this->date;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
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
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "client") {
			if ($this->ClientId->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->ClientId->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "client") {
			if ($this->ClientId->getSessionValue() != "")
				$detailFilter .= "`ClientId`=" . QuotedValue($this->ClientId->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_client()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_client()
	{
		return "`ClientId`=@ClientId@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`property_revenu`";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
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
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
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

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->ClientId->DbValue = $row['ClientId'];
		$this->ClientProperty->DbValue = $row['ClientProperty'];
		$this->PropertyId->DbValue = $row['PropertyId'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->AmountPayable->DbValue = $row['AmountPayable'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->Balance->DbValue = $row['Balance'];
		$this->date->DbValue = $row['date'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "property_revenulist.php";
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
		if ($pageName == "property_revenuview.php")
			return $Language->phrase("View");
		elseif ($pageName == "property_revenuedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "property_revenuadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "property_revenulist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("property_revenuview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("property_revenuview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "property_revenuadd.php?" . $this->getUrlParm($parm);
		else
			$url = "property_revenuadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("property_revenuedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("property_revenuadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("property_revenudelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "client" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->ClientId->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
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
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
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
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
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

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->ClientId->setDbValue($rs->fields('ClientId'));
		$this->ClientProperty->setDbValue($rs->fields('ClientProperty'));
		$this->PropertyId->setDbValue($rs->fields('PropertyId'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->AmountPayable->setDbValue($rs->fields('AmountPayable'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->Balance->setDbValue($rs->fields('Balance'));
		$this->date->setDbValue($rs->fields('date'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// ClientId
		// ClientProperty
		// PropertyId
		// PropertyUse
		// AmountPayable

		$this->AmountPayable->CellCssStyle = "white-space: nowrap;";

		// AmountPaid
		// Balance
		// date
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// ClientId
		$curVal = strval($this->ClientId->CurrentValue);
		if ($curVal != "") {
			$this->ClientId->ViewValue = $this->ClientId->lookupCacheOption($curVal);
			if ($this->ClientId->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ClientId->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ClientId->ViewValue = $this->ClientId->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientId->ViewValue = $this->ClientId->CurrentValue;
				}
			}
		} else {
			$this->ClientId->ViewValue = NULL;
		}
		$this->ClientId->ViewCustomAttributes = "";

		// ClientProperty
		$this->ClientProperty->ViewValue = $this->ClientProperty->CurrentValue;
		$curVal = strval($this->ClientProperty->CurrentValue);
		if ($curVal != "") {
			$this->ClientProperty->ViewValue = $this->ClientProperty->lookupCacheOption($curVal);
			if ($this->ClientProperty->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ClientProperty->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ClientProperty->ViewValue = $this->ClientProperty->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ClientProperty->ViewValue = $this->ClientProperty->CurrentValue;
				}
			}
		} else {
			$this->ClientProperty->ViewValue = NULL;
		}
		$this->ClientProperty->ViewCustomAttributes = "";

		// PropertyId
		$this->PropertyId->ViewValue = $this->PropertyId->CurrentValue;
		$this->PropertyId->ViewCustomAttributes = "";

		// PropertyUse
		$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
		$this->PropertyUse->ViewCustomAttributes = "";

		// AmountPayable
		$this->AmountPayable->ViewValue = $this->AmountPayable->CurrentValue;
		$this->AmountPayable->ViewValue = FormatCurrency($this->AmountPayable->ViewValue, 2, -2, -2, -2);
		$this->AmountPayable->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatCurrency($this->AmountPaid->ViewValue, 2, -2, -2, -2);
		$this->AmountPaid->CssClass = "font-weight-bold";
		$this->AmountPaid->ViewCustomAttributes = "";

		// Balance
		$this->Balance->ViewValue = $this->Balance->CurrentValue;
		$this->Balance->ViewValue = FormatCurrency($this->Balance->ViewValue, 2, -2, -2, -2);
		$this->Balance->ViewCustomAttributes = "";

		// date
		$this->date->ViewValue = $this->date->CurrentValue;
		$this->date->ViewValue = FormatDateTime($this->date->ViewValue, 7);
		$this->date->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// ClientId
		$this->ClientId->LinkCustomAttributes = "";
		$this->ClientId->HrefValue = "";
		$this->ClientId->TooltipValue = "";

		// ClientProperty
		$this->ClientProperty->LinkCustomAttributes = "";
		$this->ClientProperty->HrefValue = "";
		$this->ClientProperty->TooltipValue = "";

		// PropertyId
		$this->PropertyId->LinkCustomAttributes = "";
		$this->PropertyId->HrefValue = "";
		$this->PropertyId->TooltipValue = "";

		// PropertyUse
		$this->PropertyUse->LinkCustomAttributes = "";
		$this->PropertyUse->HrefValue = "";
		$this->PropertyUse->TooltipValue = "";

		// AmountPayable
		$this->AmountPayable->LinkCustomAttributes = "";
		$this->AmountPayable->HrefValue = "";
		$this->AmountPayable->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

		// Balance
		$this->Balance->LinkCustomAttributes = "";
		$this->Balance->HrefValue = "";
		$this->Balance->TooltipValue = "";

		// date
		$this->date->LinkCustomAttributes = "";
		$this->date->HrefValue = "";
		$this->date->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// ClientId
		$this->ClientId->EditAttrs["class"] = "form-control";
		$this->ClientId->EditCustomAttributes = "";
		if ($this->ClientId->getSessionValue() != "") {
			$this->ClientId->CurrentValue = $this->ClientId->getSessionValue();
			$curVal = strval($this->ClientId->CurrentValue);
			if ($curVal != "") {
				$this->ClientId->ViewValue = $this->ClientId->lookupCacheOption($curVal);
				if ($this->ClientId->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ClientId->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->ClientId->ViewValue = $this->ClientId->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ClientId->ViewValue = $this->ClientId->CurrentValue;
					}
				}
			} else {
				$this->ClientId->ViewValue = NULL;
			}
			$this->ClientId->ViewCustomAttributes = "";
		} else {
		}

		// ClientProperty
		$this->ClientProperty->EditAttrs["class"] = "form-control";
		$this->ClientProperty->EditCustomAttributes = "";
		$this->ClientProperty->EditValue = $this->ClientProperty->CurrentValue;
		$this->ClientProperty->PlaceHolder = RemoveHtml($this->ClientProperty->caption());

		// PropertyId
		$this->PropertyId->EditAttrs["class"] = "form-control";
		$this->PropertyId->EditCustomAttributes = "";
		if (!$this->PropertyId->Raw)
			$this->PropertyId->CurrentValue = HtmlDecode($this->PropertyId->CurrentValue);
		$this->PropertyId->EditValue = $this->PropertyId->CurrentValue;
		$this->PropertyId->PlaceHolder = RemoveHtml($this->PropertyId->caption());

		// PropertyUse
		$this->PropertyUse->EditAttrs["class"] = "form-control";
		$this->PropertyUse->EditCustomAttributes = "";
		if (!$this->PropertyUse->Raw)
			$this->PropertyUse->CurrentValue = HtmlDecode($this->PropertyUse->CurrentValue);
		$this->PropertyUse->EditValue = $this->PropertyUse->CurrentValue;
		$this->PropertyUse->PlaceHolder = RemoveHtml($this->PropertyUse->caption());

		// AmountPayable
		$this->AmountPayable->EditAttrs["class"] = "form-control";
		$this->AmountPayable->EditCustomAttributes = "";
		$this->AmountPayable->EditValue = $this->AmountPayable->CurrentValue;
		$this->AmountPayable->PlaceHolder = RemoveHtml($this->AmountPayable->caption());
		if (strval($this->AmountPayable->EditValue) != "" && is_numeric($this->AmountPayable->EditValue))
			$this->AmountPayable->EditValue = FormatNumber($this->AmountPayable->EditValue, -2, 0, -2, 0);
		

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, 0, -2, 0);
		

		// Balance
		$this->Balance->EditAttrs["class"] = "form-control";
		$this->Balance->EditCustomAttributes = "";
		$this->Balance->EditValue = $this->Balance->CurrentValue;
		$this->Balance->PlaceHolder = RemoveHtml($this->Balance->caption());
		if (strval($this->Balance->EditValue) != "" && is_numeric($this->Balance->EditValue))
			$this->Balance->EditValue = FormatNumber($this->Balance->EditValue, -2, 0, -2, 0);
		

		// date
		$this->date->EditAttrs["class"] = "form-control";
		$this->date->EditCustomAttributes = "";
		$this->date->EditValue = FormatDateTime($this->date->CurrentValue, 7);
		$this->date->PlaceHolder = RemoveHtml($this->date->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
			if (is_numeric($this->AmountPaid->CurrentValue))
				$this->AmountPaid->Total += $this->AmountPaid->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{
			$this->AmountPaid->CurrentValue = $this->AmountPaid->Total;
			$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
			$this->AmountPaid->ViewValue = FormatCurrency($this->AmountPaid->ViewValue, 2, -2, -2, -2);
			$this->AmountPaid->CssClass = "font-weight-bold";
			$this->AmountPaid->ViewCustomAttributes = "";
			$this->AmountPaid->HrefValue = ""; // Clear href value

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->ClientId);
					$doc->exportCaption($this->ClientProperty);
					$doc->exportCaption($this->PropertyId);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->Balance);
					$doc->exportCaption($this->date);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->ClientId);
					$doc->exportCaption($this->ClientProperty);
					$doc->exportCaption($this->PropertyId);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->Balance);
					$doc->exportCaption($this->date);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);
				$this->aggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->ClientId);
						$doc->exportField($this->ClientProperty);
						$doc->exportField($this->PropertyId);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->Balance);
						$doc->exportField($this->date);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->ClientId);
						$doc->exportField($this->ClientProperty);
						$doc->exportField($this->PropertyId);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->Balance);
						$doc->exportField($this->date);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}

		// Export aggregates (horizontal format only)
		if ($doc->Horizontal) {
			$this->RowType = ROWTYPE_AGGREGATE;
			$this->resetAttributes();
			$this->aggregateListRow();
			if (!$doc->ExportCustom) {
				$doc->beginExportRow(-1);
				$doc->exportAggregate($this->id, '');
				$doc->exportAggregate($this->ClientId, '');
				$doc->exportAggregate($this->ClientProperty, '');
				$doc->exportAggregate($this->PropertyId, '');
				$doc->exportAggregate($this->PropertyUse, '');
				$doc->exportAggregate($this->AmountPaid, 'TOTAL');
				$doc->exportAggregate($this->Balance, '');
				$doc->exportAggregate($this->date, '');
				$doc->endExportRow();
			}
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'property_revenu';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'property_revenu';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'property_revenu';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'property_revenu';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

	$NewAmountPaid = $rsnew['AmountPaid'];
	$ClientId = $rsnew['ClientId'];
	$ClientProperty = $rsnew['ClientProperty'];
	$Balance = $rsnew['Balance'];
	$sql = "SELECT * FROM property WHERE ClientId = '$ClientId' AND id = '$ClientProperty' ";
	$e = executeRow($sql);
	$OldeAmountPaid = $e['AmountPaid'];
	$AmountPaid = $OldeAmountPaid + $NewAmountPaid;
	$query = "UPDATE property SET AmountPaid = '$AmountPaid', CurrentBalance = '$Balance' WHERE ClientId = '$ClientId' AND id = '$ClientProperty' ";
	$row = executeRow($query);
	return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

			//echo "Row Inserted";
	$id = $rsnew['id'];
	$qry = "SELECT
	`client`.`ClientName`
	, `client`.`ClientID`
	, `client`.`Mobile`
	, `client`.`Email`
	, `property`.`Property`
	, `property`.`PropertyId`
	, `property`.`Location`
	, `property`.`PropertyUse`
	, `charges`.`ChargeDesc`
	, `property`.`ChargeableFee`
	, `property`.`BalanceBF`
	, `property`.`AmountPayable`
	, `property_revenu`.`id`
	, FORMAT(`property_revenu`.`AmountPayable`, 2) AS AmountPayable
	, FORMAT(`property_revenu`.`AmountPaid`, 2) AS AmountPaid
	, FORMAT(`property_revenu`.`Balance`, 2) AS Balance
	, `property_revenu`.`ClientProperty`
	, `charge_group`.`ChargeGroupName`
	, DATE_FORMAT(`property_revenu`.`date`, '%D %M, %Y') AS date
	FROM
	`client`
	LEFT JOIN `property` 
		ON (`client`.`id` = `property`.`ClientId`)
	LEFT JOIN `charges` 
		ON (`charges`.`ChargeDesc` = `property`.`ChargeGroup`)
	LEFT JOIN `charge_group` 
		ON (`charge_group`.`ChargeGroupCode` = `charges`.`ChargeGroup`)
	LEFT JOIN `property_revenu` 
		ON (`property_revenu`.`ClientProperty` = `property`.`id`) WHERE `property_revenu`.`id` = '$id' ";
	$rs = ExecuteRows($qry);
	echo '
	<style>
	.text-danger strong {
		color: #9f181c;
	}
	.receipt-main {
		background: #ffffff none repeat scroll 0 0;
		border-bottom: 12px solid #333333;
		border-top: 12px solid #9f181c;
		margin-top: 50px;
		margin-bottom: 50px;
		padding: 40px 30px !important;
		position: relative;
		box-shadow: 0 1px 21px #acacac;
		color: #333333;
		font-family: open sans;
	}
	.receipt-main p {
		color: #333333;
		font-family: open sans;
		line-height: 1.42857;
	}
	.receipt-footer h1 {
		font-size: 15px;
		font-weight: 400 !important;
		margin: 0 !important;
	}
	.receipt-main::after {
		background: #414143 none repeat scroll 0 0;
		content: "";
		height: 5px;
		left: 0;
		position: absolute;
		right: 0;
		top: -13px;
	}
	.receipt-main thead {
		background: #414143 none repeat scroll 0 0;
	}
	.receipt-main thead th {
		color: #fff;
	}
	.receipt-right h5 {
		font-size: 16px;
		font-weight: bold;
		margin: 0 0 7px 0;
	}
	.receipt-right p {
		font-size: 12px;
		margin: 0px;
	}
	.receipt-right p i {
		text-align: center;
		width: 18px;
	}
	.receipt-main td {
		padding: 9px 20px !important;
	}
	.receipt-main th {
		padding: 13px 20px !important;
	}
	.receipt-main td {
		font-size: 18px;
		font-weight: initial !important;
	}
	.receipt-main td p:last-child {
		margin: 0;
		padding: 0;
	}
	.receipt-main td h2 {
		font-size: 20px;
		font-weight: 900;
		margin: 0;
		text-transform: uppercase;
	}
	.receipt-header-mid .receipt-left h1 {
		font-weight: 100;
		margin: 34px 0 0;
		text-align: center;
		text-transform: uppercase;
	}
	.receipt-header-mid {
		margin: 24px 0;
		overflow: hidden;
	}
	#container {
		background-color: #dcdcdc;
	}
	table {
		border-color: black;
		width: 100%;
	}
	@media print {
		table {
			border-color: grey;
			width: 100%;
		}
		.receipt-footer {
			padding-top: 50px;
		}
		receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
	}
	</style>
	<div class="col-lg-12">
		<div class="card card-outline card-primary">
			<div class="card-header">
				<div class="card-tools">
					<a class="btn btn-block btn-sm btn-default btn-flat border-primary update_client"
						onclick="print_div()"><i class="fa fa-print"></i>PRINT</a>
				</div>
			</div>
			<div class="card-body" id="print_div">
				<div class="row">
					<div class="receipt-main col-xs-12 col-sm-12 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
						<h3>
							<center>LAND/PROPERTY RATES DEPARTMENT</center>
						</h3>
						<div class="row">
							<div class="receipt-header receipt-header-mid">
								<div class="col-xs-12 col-sm-12 col-md-12text-left">
									<div class="receipt-right">
										<h5>CLIENT NUMBER.: '.$rs['ClientName'].'</h5>
										<h5>CLIENT NAME.: '.$rs['ClientID'].'</h5>
										<h5>PAYMENT DATE.: '.$rs['date'].'</h5>
										<h5>RECEIPT NUMBER: '.$rs['id'].'</h5>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="receipt-left">
										<h1>Payment Receipt</h1>
									</div>
								</div>
							</div>
						</div>
						<div>
							<table width="100%" style="border-color: #e4dddd;" border="1">
								<thead style="background-color: #414143; color:#fff">
									<tr>
										<th style="background-color: #414143; text-align:center;">Property Desc</th>
										<th style="background-color: #414143; text-align:center;">Property Num</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style="padding-left:20px;">'.$rs['Property'].'</td>
										<td style="text-align:right; padding-right:20px;">'.$rs['PropertyId'].'
										</td>
									</tr>
									<tr>
										<td class="text-right" style="padding-right:20px;">
											<strong>Amount Due: </strong>
										</td>
										<td style="text-align:right; padding-right:20px;">
											<strong><i class="fa fa-inr"></i>ZMK
												'.$rs['AmountPayable'].'</strong>
										</td>
									</tr>
									<tr>
										<td class="text-right" style="padding-right:20px;">
											<strong>Amount Paid: </strong>
										</td>
										<td style="text-align:right; padding-right:20px;">
											<strong><i class="fa fa-inr"></i>ZMK
												'.$rs['AmountPaid'].'</strong>
										</td>
									</tr>
									<tr>
										<td class="text-right" style="padding-right:20px;">
											<strong>Balance Due: </strong>
										</td>
										<td style="text-align:right; padding-right:20px;">
											<strong><i class="fa fa-inr"></i>ZMK '.$rs['Balance'].'</strong>
										</td>
									</tr>
									<tr>
										<td class="text-right" style="border-bottom: none; padding-right:20px;">
											<strong>Total: </strong>
										</td>
										<td class="text-right text-danger" style="padding-right:20px;">
											<strong><i class="fa fa-inr"></i>ZMK
												'.$rs['AmountPaid'].'</strong>
										</td>
									</tr>
								</tbody>
							</table>
						</div><br />
						<div class="footer-text">
							<hr style="border-style:dotted; border-color: black;" />
							<p>
								<center>&copy;2021, LAND/PROPERTY RATES DEPARTMENT</center>
							</p>
							<i>
								<center>You can print this receipt and present it as proof od payment. THANK YOU.</center>
							</i>
						</div>
						<div class="row">
							<div class="receipt-header receipt-header-mid receipt-footer">
								<div class="col-xs-12 col-sm-12 col-md-12text-left">
									<div class="receipt-right">
										<p><b>Date Printed:</b> '.date('d M, Y').'</p>
										<h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="receipt-left">
										<!--<h5>Signature</h5>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	function print_div(div) {
		var restorepage = document.body.innerHTML;
		var printDiv = document.getElementById("print_div").innerHTML;
		document.body.innerHTML = printDiv;
		window.print();
		document.body.innerHTML = restorepage;
	}
	</script>';
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {
	$NewAmountPaid = $rsnew['AmountPaid'];
	$ClientId = $rsnew['ClientId'];
	$ClientProperty = $rsnew['ClientProperty'];
	$Balance = $rsnew['Balance'];
	$sql = "SELECT * FROM property WHERE ClientId = '$ClientId' AND id = '$ClientProperty' ";
	$e = executeRow($sql);
	$OldeAmountPaid = $e['AmountPaid'];
	$AmountPaid = $OldeAmountPaid + $NewAmountPaid;
	$query = "UPDATE property SET AmountPaid = '$AmountPaid', CurrentBalance = '$Balance' WHERE ClientId = '$ClientId' AND id = '$ClientProperty' ";
	$row = executeRow($query);
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
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