<?php namespace PHPMaker2020\revenue; ?>
<?php

/**
 * Table class for update_requests
 */
class update_requests extends DbTable
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

	// Fields
	public $id;
	public $ClientId;
	public $NewClientIdentity;
	public $NewClientName;
	public $NewAccountType;
	public $NewMobileNumber;
	public $NewEmail;
	public $NewAdditionalInformation;
	public $date;
	public $status;
	public $Property;
	public $PropertyId;
	public $PropertyUse;
	public $Comment;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'update_requests';
		$this->TableName = 'update_requests';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`update_requests`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('update_requests', 'update_requests', 'x_id', 'id', '`id`', '`id`', 3, 255, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = FALSE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// ClientId
		$this->ClientId = new DbField('update_requests', 'update_requests', 'x_ClientId', 'ClientId', '`ClientId`', '`ClientId`', 3, 255, -1, FALSE, '`ClientId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ClientId->Sortable = TRUE; // Allow sort
		$this->ClientId->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ClientId->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ClientId->Lookup = new Lookup('ClientId', 'client', FALSE, 'id', ["ClientName","","",""], [], [], [], [], [], [], '', '');
		$this->ClientId->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientId'] = &$this->ClientId;

		// NewClientIdentity
		$this->NewClientIdentity = new DbField('update_requests', 'update_requests', 'x_NewClientIdentity', 'NewClientIdentity', '`NewClientIdentity`', '`NewClientIdentity`', 200, 100, -1, FALSE, '`NewClientIdentity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewClientIdentity->Sortable = TRUE; // Allow sort
		$this->fields['NewClientIdentity'] = &$this->NewClientIdentity;

		// NewClientName
		$this->NewClientName = new DbField('update_requests', 'update_requests', 'x_NewClientName', 'NewClientName', '`NewClientName`', '`NewClientName`', 200, 100, -1, FALSE, '`NewClientName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewClientName->Sortable = TRUE; // Allow sort
		$this->fields['NewClientName'] = &$this->NewClientName;

		// NewAccountType
		$this->NewAccountType = new DbField('update_requests', 'update_requests', 'x_NewAccountType', 'NewAccountType', '`NewAccountType`', '`NewAccountType`', 3, 3, -1, FALSE, '`NewAccountType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewAccountType->Sortable = TRUE; // Allow sort
		$this->NewAccountType->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['NewAccountType'] = &$this->NewAccountType;

		// NewMobileNumber
		$this->NewMobileNumber = new DbField('update_requests', 'update_requests', 'x_NewMobileNumber', 'NewMobileNumber', '`NewMobileNumber`', '`NewMobileNumber`', 200, 50, -1, FALSE, '`NewMobileNumber`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewMobileNumber->Sortable = TRUE; // Allow sort
		$this->fields['NewMobileNumber'] = &$this->NewMobileNumber;

		// NewEmail
		$this->NewEmail = new DbField('update_requests', 'update_requests', 'x_NewEmail', 'NewEmail', '`NewEmail`', '`NewEmail`', 200, 100, -1, FALSE, '`NewEmail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->NewEmail->Sortable = TRUE; // Allow sort
		$this->NewEmail->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
		$this->fields['NewEmail'] = &$this->NewEmail;

		// NewAdditionalInformation
		$this->NewAdditionalInformation = new DbField('update_requests', 'update_requests', 'x_NewAdditionalInformation', 'NewAdditionalInformation', '`NewAdditionalInformation`', '`NewAdditionalInformation`', 201, 65535, -1, FALSE, '`NewAdditionalInformation`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->NewAdditionalInformation->Sortable = TRUE; // Allow sort
		$this->fields['NewAdditionalInformation'] = &$this->NewAdditionalInformation;

		// date
		$this->date = new DbField('update_requests', 'update_requests', 'x_date', 'date', '`date`', CastDateFieldForLike("`date`", 7, "DB"), 135, 19, 7, FALSE, '`date`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->date->Sortable = TRUE; // Allow sort
		$this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['date'] = &$this->date;

		// status
		$this->status = new DbField('update_requests', 'update_requests', 'x_status', 'status', '`status`', '`status`', 202, 1, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->Lookup = new Lookup('status', 'update_requests', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status->OptionCount = 3;
		$this->fields['status'] = &$this->status;

		// Property
		$this->Property = new DbField('update_requests', 'update_requests', 'x_Property', 'Property', '`Property`', '`Property`', 200, 100, -1, FALSE, '`Property`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Property->Sortable = TRUE; // Allow sort
		$this->fields['Property'] = &$this->Property;

		// PropertyId
		$this->PropertyId = new DbField('update_requests', 'update_requests', 'x_PropertyId', 'PropertyId', '`PropertyId`', '`PropertyId`', 200, 20, -1, FALSE, '`PropertyId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyId->Sortable = TRUE; // Allow sort
		$this->fields['PropertyId'] = &$this->PropertyId;

		// PropertyUse
		$this->PropertyUse = new DbField('update_requests', 'update_requests', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 100, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// Comment
		$this->Comment = new DbField('update_requests', 'update_requests', 'x_Comment', 'Comment', '`Comment`', '`Comment`', 200, 100, -1, FALSE, '`Comment`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Comment->Sortable = TRUE; // Allow sort
		$this->fields['Comment'] = &$this->Comment;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`update_requests`";
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
		$this->NewClientIdentity->DbValue = $row['NewClientIdentity'];
		$this->NewClientName->DbValue = $row['NewClientName'];
		$this->NewAccountType->DbValue = $row['NewAccountType'];
		$this->NewMobileNumber->DbValue = $row['NewMobileNumber'];
		$this->NewEmail->DbValue = $row['NewEmail'];
		$this->NewAdditionalInformation->DbValue = $row['NewAdditionalInformation'];
		$this->date->DbValue = $row['date'];
		$this->status->DbValue = $row['status'];
		$this->Property->DbValue = $row['Property'];
		$this->PropertyId->DbValue = $row['PropertyId'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->Comment->DbValue = $row['Comment'];
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
			return "update_requestslist.php";
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
		if ($pageName == "update_requestsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "update_requestsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "update_requestsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "update_requestslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("update_requestsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("update_requestsview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "update_requestsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "update_requestsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("update_requestsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("update_requestsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("update_requestsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
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
		$this->NewClientIdentity->setDbValue($rs->fields('NewClientIdentity'));
		$this->NewClientName->setDbValue($rs->fields('NewClientName'));
		$this->NewAccountType->setDbValue($rs->fields('NewAccountType'));
		$this->NewMobileNumber->setDbValue($rs->fields('NewMobileNumber'));
		$this->NewEmail->setDbValue($rs->fields('NewEmail'));
		$this->NewAdditionalInformation->setDbValue($rs->fields('NewAdditionalInformation'));
		$this->date->setDbValue($rs->fields('date'));
		$this->status->setDbValue($rs->fields('status'));
		$this->Property->setDbValue($rs->fields('Property'));
		$this->PropertyId->setDbValue($rs->fields('PropertyId'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->Comment->setDbValue($rs->fields('Comment'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// ClientId
		$this->ClientId->CellCssStyle = "white-space: nowrap;";

		// NewClientIdentity
		// NewClientName
		// NewAccountType
		// NewMobileNumber
		// NewEmail
		// NewAdditionalInformation
		// date
		// status
		// Property
		// PropertyId
		// PropertyUse
		// Comment
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

		// NewClientIdentity
		$this->NewClientIdentity->ViewValue = $this->NewClientIdentity->CurrentValue;
		$this->NewClientIdentity->ViewCustomAttributes = "";

		// NewClientName
		$this->NewClientName->ViewValue = $this->NewClientName->CurrentValue;
		$this->NewClientName->ViewCustomAttributes = "";

		// NewAccountType
		$this->NewAccountType->ViewValue = $this->NewAccountType->CurrentValue;
		$this->NewAccountType->ViewValue = FormatNumber($this->NewAccountType->ViewValue, 0, -2, -2, -2);
		$this->NewAccountType->ViewCustomAttributes = "";

		// NewMobileNumber
		$this->NewMobileNumber->ViewValue = $this->NewMobileNumber->CurrentValue;
		$this->NewMobileNumber->ViewCustomAttributes = "";

		// NewEmail
		$this->NewEmail->ViewValue = $this->NewEmail->CurrentValue;
		$this->NewEmail->ViewCustomAttributes = "";

		// NewAdditionalInformation
		$this->NewAdditionalInformation->ViewValue = $this->NewAdditionalInformation->CurrentValue;
		$this->NewAdditionalInformation->ViewCustomAttributes = "";

		// date
		$this->date->ViewValue = $this->date->CurrentValue;
		$this->date->ViewValue = FormatDateTime($this->date->ViewValue, 7);
		$this->date->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) != "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// Property
		$this->Property->ViewValue = $this->Property->CurrentValue;
		$this->Property->ViewCustomAttributes = "";

		// PropertyId
		$this->PropertyId->ViewValue = $this->PropertyId->CurrentValue;
		$this->PropertyId->ViewCustomAttributes = "";

		// PropertyUse
		$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
		$this->PropertyUse->ViewCustomAttributes = "";

		// Comment
		$this->Comment->ViewValue = $this->Comment->CurrentValue;
		$this->Comment->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// ClientId
		$this->ClientId->LinkCustomAttributes = "";
		$this->ClientId->HrefValue = "";
		$this->ClientId->TooltipValue = "";

		// NewClientIdentity
		$this->NewClientIdentity->LinkCustomAttributes = "";
		$this->NewClientIdentity->HrefValue = "";
		$this->NewClientIdentity->TooltipValue = "";

		// NewClientName
		$this->NewClientName->LinkCustomAttributes = "";
		$this->NewClientName->HrefValue = "";
		$this->NewClientName->TooltipValue = "";

		// NewAccountType
		$this->NewAccountType->LinkCustomAttributes = "";
		$this->NewAccountType->HrefValue = "";
		$this->NewAccountType->TooltipValue = "";

		// NewMobileNumber
		$this->NewMobileNumber->LinkCustomAttributes = "";
		$this->NewMobileNumber->HrefValue = "";
		$this->NewMobileNumber->TooltipValue = "";

		// NewEmail
		$this->NewEmail->LinkCustomAttributes = "";
		$this->NewEmail->HrefValue = "";
		$this->NewEmail->TooltipValue = "";

		// NewAdditionalInformation
		$this->NewAdditionalInformation->LinkCustomAttributes = "";
		$this->NewAdditionalInformation->HrefValue = "";
		$this->NewAdditionalInformation->TooltipValue = "";

		// date
		$this->date->LinkCustomAttributes = "";
		$this->date->HrefValue = "";
		$this->date->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// Property
		$this->Property->LinkCustomAttributes = "";
		$this->Property->HrefValue = "";
		$this->Property->TooltipValue = "";

		// PropertyId
		$this->PropertyId->LinkCustomAttributes = "";
		$this->PropertyId->HrefValue = "";
		$this->PropertyId->TooltipValue = "";

		// PropertyUse
		$this->PropertyUse->LinkCustomAttributes = "";
		$this->PropertyUse->HrefValue = "";
		$this->PropertyUse->TooltipValue = "";

		// Comment
		$this->Comment->LinkCustomAttributes = "";
		$this->Comment->HrefValue = "";
		$this->Comment->TooltipValue = "";

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

		// NewClientIdentity
		$this->NewClientIdentity->EditAttrs["class"] = "form-control";
		$this->NewClientIdentity->EditCustomAttributes = "";
		if (!$this->NewClientIdentity->Raw)
			$this->NewClientIdentity->CurrentValue = HtmlDecode($this->NewClientIdentity->CurrentValue);
		$this->NewClientIdentity->EditValue = $this->NewClientIdentity->CurrentValue;
		$this->NewClientIdentity->PlaceHolder = RemoveHtml($this->NewClientIdentity->caption());

		// NewClientName
		$this->NewClientName->EditAttrs["class"] = "form-control";
		$this->NewClientName->EditCustomAttributes = "";
		if (!$this->NewClientName->Raw)
			$this->NewClientName->CurrentValue = HtmlDecode($this->NewClientName->CurrentValue);
		$this->NewClientName->EditValue = $this->NewClientName->CurrentValue;
		$this->NewClientName->PlaceHolder = RemoveHtml($this->NewClientName->caption());

		// NewAccountType
		$this->NewAccountType->EditAttrs["class"] = "form-control";
		$this->NewAccountType->EditCustomAttributes = "";
		$this->NewAccountType->EditValue = $this->NewAccountType->CurrentValue;
		$this->NewAccountType->PlaceHolder = RemoveHtml($this->NewAccountType->caption());

		// NewMobileNumber
		$this->NewMobileNumber->EditAttrs["class"] = "form-control";
		$this->NewMobileNumber->EditCustomAttributes = "";
		if (!$this->NewMobileNumber->Raw)
			$this->NewMobileNumber->CurrentValue = HtmlDecode($this->NewMobileNumber->CurrentValue);
		$this->NewMobileNumber->EditValue = $this->NewMobileNumber->CurrentValue;
		$this->NewMobileNumber->PlaceHolder = RemoveHtml($this->NewMobileNumber->caption());

		// NewEmail
		$this->NewEmail->EditAttrs["class"] = "form-control";
		$this->NewEmail->EditCustomAttributes = "";
		if (!$this->NewEmail->Raw)
			$this->NewEmail->CurrentValue = HtmlDecode($this->NewEmail->CurrentValue);
		$this->NewEmail->EditValue = $this->NewEmail->CurrentValue;
		$this->NewEmail->PlaceHolder = RemoveHtml($this->NewEmail->caption());

		// NewAdditionalInformation
		$this->NewAdditionalInformation->EditAttrs["class"] = "form-control";
		$this->NewAdditionalInformation->EditCustomAttributes = "";
		$this->NewAdditionalInformation->EditValue = $this->NewAdditionalInformation->CurrentValue;
		$this->NewAdditionalInformation->PlaceHolder = RemoveHtml($this->NewAdditionalInformation->caption());

		// date
		$this->date->EditAttrs["class"] = "form-control";
		$this->date->EditCustomAttributes = "";
		$this->date->EditValue = FormatDateTime($this->date->CurrentValue, 7);
		$this->date->PlaceHolder = RemoveHtml($this->date->caption());

		// status
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(FALSE);

		// Property
		$this->Property->EditAttrs["class"] = "form-control";
		$this->Property->EditCustomAttributes = "";
		if (!$this->Property->Raw)
			$this->Property->CurrentValue = HtmlDecode($this->Property->CurrentValue);
		$this->Property->EditValue = $this->Property->CurrentValue;
		$this->Property->PlaceHolder = RemoveHtml($this->Property->caption());

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

		// Comment
		$this->Comment->EditAttrs["class"] = "form-control";
		$this->Comment->EditCustomAttributes = "";
		if (!$this->Comment->Raw)
			$this->Comment->CurrentValue = HtmlDecode($this->Comment->CurrentValue);
		$this->Comment->EditValue = $this->Comment->CurrentValue;
		$this->Comment->PlaceHolder = RemoveHtml($this->Comment->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

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
					$doc->exportCaption($this->ClientId);
					$doc->exportCaption($this->NewClientIdentity);
					$doc->exportCaption($this->NewClientName);
					$doc->exportCaption($this->NewAccountType);
					$doc->exportCaption($this->NewMobileNumber);
					$doc->exportCaption($this->NewEmail);
					$doc->exportCaption($this->NewAdditionalInformation);
					$doc->exportCaption($this->date);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->Property);
					$doc->exportCaption($this->PropertyId);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->Comment);
				} else {
					$doc->exportCaption($this->ClientId);
					$doc->exportCaption($this->NewClientIdentity);
					$doc->exportCaption($this->NewClientName);
					$doc->exportCaption($this->NewAccountType);
					$doc->exportCaption($this->NewMobileNumber);
					$doc->exportCaption($this->NewEmail);
					$doc->exportCaption($this->date);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->Property);
					$doc->exportCaption($this->PropertyId);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->Comment);
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

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->ClientId);
						$doc->exportField($this->NewClientIdentity);
						$doc->exportField($this->NewClientName);
						$doc->exportField($this->NewAccountType);
						$doc->exportField($this->NewMobileNumber);
						$doc->exportField($this->NewEmail);
						$doc->exportField($this->NewAdditionalInformation);
						$doc->exportField($this->date);
						$doc->exportField($this->status);
						$doc->exportField($this->Property);
						$doc->exportField($this->PropertyId);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->Comment);
					} else {
						$doc->exportField($this->ClientId);
						$doc->exportField($this->NewClientIdentity);
						$doc->exportField($this->NewClientName);
						$doc->exportField($this->NewAccountType);
						$doc->exportField($this->NewMobileNumber);
						$doc->exportField($this->NewEmail);
						$doc->exportField($this->date);
						$doc->exportField($this->status);
						$doc->exportField($this->Property);
						$doc->exportField($this->PropertyId);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->Comment);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
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

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
			$to = $rsold['Email'];
					$subject = 'REVENUE DEPARTMENT';
					$from = 'revenuedepartments@rcs.com';

					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Create email headers
					$headers .= 'From: '.$from."\r\n".
						'Reply-To: '.$from."\r\n" .
						'X-Mailer: PHP/' . phpversion();

					// Compose a simple HTML email message
					$message = '<html><body style="">';
					$message .= '<h3 style="color:;">CONGRATULATION!....</h3>';
					$message .= '<p style="font-size:18px;">Account associated with  Client ID: <b>'.$rsold['ClientID'].'</b> has been updated.<br/>';
					$message .= '</body></html>';

					// Sending email
					if(mail($to, $subject, $message, $headers)){
						echo '<span style="color:green;text-align:center;">Success! Check your email for your Details</span>';
					} else{
					}
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