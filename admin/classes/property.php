<?php namespace PHPMaker2020\revenue; ?>
<?php

/**
 * Table class for property
 */
class property extends DbTable
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
	public $ChargeGroup;
	public $ChargeGropuDes;
	public $ChargeableFee;
	public $BalanceBF;
	public $AmountPayable;
	public $Property;
	public $PropertyId;
	public $PropertyUse;
	public $Location;
	public $AmountPaid;
	public $CurrentBalance;
	public $Description;
	public $DataRegistered;
	public $PhysicalAddress;
	public $Status;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'property';
		$this->TableName = 'property';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`property`";
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
		$this->id = new DbField('property', 'property', 'x_id', 'id', '`id`', '`id`', 3, 255, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// ClientId
		$this->ClientId = new DbField('property', 'property', 'x_ClientId', 'ClientId', '`ClientId`', '`ClientId`', 3, 100, -1, FALSE, '`ClientId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ClientId->IsForeignKey = TRUE; // Foreign key field
		$this->ClientId->Sortable = TRUE; // Allow sort
		$this->ClientId->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ClientId->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ClientId->Lookup = new Lookup('ClientId', 'client', FALSE, 'id', ["ClientName","","",""], [], [], [], [], [], [], '', '');
		$this->ClientId->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ClientId'] = &$this->ClientId;

		// ChargeGroup
		$this->ChargeGroup = new DbField('property', 'property', 'x_ChargeGroup', 'ChargeGroup', '`ChargeGroup`', '`ChargeGroup`', 3, 100, -1, FALSE, '`ChargeGroup`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeGroup->Sortable = TRUE; // Allow sort
		$this->ChargeGroup->Lookup = new Lookup('ChargeGroup', 'charge_group', FALSE, 'ChargeGroupCode', ["ChargeGroupName","","",""], [], [], [], [], [], [], '', '');
		$this->ChargeGroup->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeGroup'] = &$this->ChargeGroup;

		// ChargeGropuDes
		$this->ChargeGropuDes = new DbField('property', 'property', 'x_ChargeGropuDes', 'ChargeGropuDes', '`ChargeGropuDes`', '`ChargeGropuDes`', 3, 100, -1, FALSE, '`ChargeGropuDes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ChargeGropuDes->Sortable = TRUE; // Allow sort
		$this->ChargeGropuDes->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ChargeGropuDes->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->ChargeGropuDes->Lookup = new Lookup('ChargeGropuDes', 'charges', FALSE, 'ChargeCode', ["ChargeDesc","","",""], [], [], [], [], ["Fee","PropertyUse"], ["x_ChargeableFee","x_PropertyUse"], '', '');
		$this->ChargeGropuDes->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ChargeGropuDes'] = &$this->ChargeGropuDes;

		// ChargeableFee
		$this->ChargeableFee = new DbField('property', 'property', 'x_ChargeableFee', 'ChargeableFee', '`ChargeableFee`', '`ChargeableFee`', 5, 10, -1, FALSE, '`ChargeableFee`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ChargeableFee->Nullable = FALSE; // NOT NULL field
		$this->ChargeableFee->Sortable = TRUE; // Allow sort
		$this->ChargeableFee->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ChargeableFee'] = &$this->ChargeableFee;

		// BalanceBF
		$this->BalanceBF = new DbField('property', 'property', 'x_BalanceBF', 'BalanceBF', '`BalanceBF`', '`BalanceBF`', 5, 10, -1, FALSE, '`BalanceBF`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BalanceBF->Nullable = FALSE; // NOT NULL field
		$this->BalanceBF->Sortable = TRUE; // Allow sort
		$this->BalanceBF->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['BalanceBF'] = &$this->BalanceBF;

		// AmountPayable
		$this->AmountPayable = new DbField('property', 'property', 'x_AmountPayable', 'AmountPayable', '`AmountPayable`', '`AmountPayable`', 5, 10, -1, FALSE, '`AmountPayable`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPayable->Nullable = FALSE; // NOT NULL field
		$this->AmountPayable->Sortable = TRUE; // Allow sort
		$this->AmountPayable->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPayable'] = &$this->AmountPayable;

		// Property
		$this->Property = new DbField('property', 'property', 'x_Property', 'Property', '`Property`', '`Property`', 200, 200, -1, FALSE, '`Property`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Property->Sortable = TRUE; // Allow sort
		$this->fields['Property'] = &$this->Property;

		// PropertyId
		$this->PropertyId = new DbField('property', 'property', 'x_PropertyId', 'PropertyId', '`PropertyId`', '`PropertyId`', 200, 10, -1, FALSE, '`PropertyId`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyId->Sortable = TRUE; // Allow sort
		$this->fields['PropertyId'] = &$this->PropertyId;

		// PropertyUse
		$this->PropertyUse = new DbField('property', 'property', 'x_PropertyUse', 'PropertyUse', '`PropertyUse`', '`PropertyUse`', 200, 100, -1, FALSE, '`PropertyUse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PropertyUse->Sortable = TRUE; // Allow sort
		$this->fields['PropertyUse'] = &$this->PropertyUse;

		// Location
		$this->Location = new DbField('property', 'property', 'x_Location', 'Location', '`Location`', '`Location`', 200, 100, -1, FALSE, '`Location`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Location->Sortable = TRUE; // Allow sort
		$this->fields['Location'] = &$this->Location;

		// AmountPaid
		$this->AmountPaid = new DbField('property', 'property', 'x_AmountPaid', 'AmountPaid', '`AmountPaid`', '`AmountPaid`', 5, 10, -1, FALSE, '`AmountPaid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->AmountPaid->Nullable = FALSE; // NOT NULL field
		$this->AmountPaid->Sortable = TRUE; // Allow sort
		$this->AmountPaid->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['AmountPaid'] = &$this->AmountPaid;

		// CurrentBalance
		$this->CurrentBalance = new DbField('property', 'property', 'x_CurrentBalance', 'CurrentBalance', '`CurrentBalance`', '`CurrentBalance`', 5, 10, -1, FALSE, '`CurrentBalance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CurrentBalance->Nullable = FALSE; // NOT NULL field
		$this->CurrentBalance->Sortable = TRUE; // Allow sort
		$this->CurrentBalance->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['CurrentBalance'] = &$this->CurrentBalance;

		// Description
		$this->Description = new DbField('property', 'property', 'x_Description', 'Description', '`Description`', '`Description`', 201, 65535, -1, FALSE, '`Description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Description->Sortable = TRUE; // Allow sort
		$this->fields['Description'] = &$this->Description;

		// DataRegistered
		$this->DataRegistered = new DbField('property', 'property', 'x_DataRegistered', 'DataRegistered', '`DataRegistered`', CastDateFieldForLike("`DataRegistered`", 0, "DB"), 133, 10, 0, FALSE, '`DataRegistered`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DataRegistered->Sortable = TRUE; // Allow sort
		$this->DataRegistered->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['DataRegistered'] = &$this->DataRegistered;

		// PhysicalAddress
		$this->PhysicalAddress = new DbField('property', 'property', 'x_PhysicalAddress', 'PhysicalAddress', '`PhysicalAddress`', '`PhysicalAddress`', 201, 65535, -1, FALSE, '`PhysicalAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->PhysicalAddress->Sortable = TRUE; // Allow sort
		$this->PhysicalAddress->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->PhysicalAddress->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->PhysicalAddress->Lookup = new Lookup('PhysicalAddress', 'property', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->PhysicalAddress->OptionCount = 1;
		$this->fields['PhysicalAddress'] = &$this->PhysicalAddress;

		// Status
		$this->Status = new DbField('property', 'property', 'x_Status', 'Status', '`Status`', '`Status`', 202, 1, -1, FALSE, '`Status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->Status->Sortable = TRUE; // Allow sort
		$this->Status->Lookup = new Lookup('Status', 'property', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->Status->OptionCount = 2;
		$this->fields['Status'] = &$this->Status;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`property`";
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
		$this->ChargeGroup->DbValue = $row['ChargeGroup'];
		$this->ChargeGropuDes->DbValue = $row['ChargeGropuDes'];
		$this->ChargeableFee->DbValue = $row['ChargeableFee'];
		$this->BalanceBF->DbValue = $row['BalanceBF'];
		$this->AmountPayable->DbValue = $row['AmountPayable'];
		$this->Property->DbValue = $row['Property'];
		$this->PropertyId->DbValue = $row['PropertyId'];
		$this->PropertyUse->DbValue = $row['PropertyUse'];
		$this->Location->DbValue = $row['Location'];
		$this->AmountPaid->DbValue = $row['AmountPaid'];
		$this->CurrentBalance->DbValue = $row['CurrentBalance'];
		$this->Description->DbValue = $row['Description'];
		$this->DataRegistered->DbValue = $row['DataRegistered'];
		$this->PhysicalAddress->DbValue = $row['PhysicalAddress'];
		$this->Status->DbValue = $row['Status'];
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
			return "propertylist.php";
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
		if ($pageName == "propertyview.php")
			return $Language->phrase("View");
		elseif ($pageName == "propertyedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "propertyadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "propertylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("propertyview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("propertyview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "propertyadd.php?" . $this->getUrlParm($parm);
		else
			$url = "propertyadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("propertyedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("propertyadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("propertydelete.php", $this->getUrlParm());
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
		$this->ChargeGroup->setDbValue($rs->fields('ChargeGroup'));
		$this->ChargeGropuDes->setDbValue($rs->fields('ChargeGropuDes'));
		$this->ChargeableFee->setDbValue($rs->fields('ChargeableFee'));
		$this->BalanceBF->setDbValue($rs->fields('BalanceBF'));
		$this->AmountPayable->setDbValue($rs->fields('AmountPayable'));
		$this->Property->setDbValue($rs->fields('Property'));
		$this->PropertyId->setDbValue($rs->fields('PropertyId'));
		$this->PropertyUse->setDbValue($rs->fields('PropertyUse'));
		$this->Location->setDbValue($rs->fields('Location'));
		$this->AmountPaid->setDbValue($rs->fields('AmountPaid'));
		$this->CurrentBalance->setDbValue($rs->fields('CurrentBalance'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->DataRegistered->setDbValue($rs->fields('DataRegistered'));
		$this->PhysicalAddress->setDbValue($rs->fields('PhysicalAddress'));
		$this->Status->setDbValue($rs->fields('Status'));
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
		// ChargeGroup
		// ChargeGropuDes
		// ChargeableFee
		// BalanceBF
		// AmountPayable
		// Property
		// PropertyId
		// PropertyUse
		// Location
		// AmountPaid
		// CurrentBalance
		// Description
		// DataRegistered
		// PhysicalAddress
		// Status
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

		// ChargeGroup
		$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
		$curVal = strval($this->ChargeGroup->CurrentValue);
		if ($curVal != "") {
			$this->ChargeGroup->ViewValue = $this->ChargeGroup->lookupCacheOption($curVal);
			if ($this->ChargeGroup->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeGroup->ViewValue = $this->ChargeGroup->CurrentValue;
				}
			}
		} else {
			$this->ChargeGroup->ViewValue = NULL;
		}
		$this->ChargeGroup->ViewCustomAttributes = "";

		// ChargeGropuDes
		$curVal = strval($this->ChargeGropuDes->CurrentValue);
		if ($curVal != "") {
			$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->lookupCacheOption($curVal);
			if ($this->ChargeGropuDes->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`ChargeCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->ChargeGropuDes->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->CurrentValue;
				}
			}
		} else {
			$this->ChargeGropuDes->ViewValue = NULL;
		}
		$this->ChargeGropuDes->ViewCustomAttributes = "";

		// ChargeableFee
		$this->ChargeableFee->ViewValue = $this->ChargeableFee->CurrentValue;
		$this->ChargeableFee->ViewValue = FormatCurrency($this->ChargeableFee->ViewValue, 2, -2, -2, -2);
		$this->ChargeableFee->ViewCustomAttributes = "";

		// BalanceBF
		$this->BalanceBF->ViewValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->ViewValue = FormatCurrency($this->BalanceBF->ViewValue, 2, -2, -2, -2);
		$this->BalanceBF->ViewCustomAttributes = "";

		// AmountPayable
		$this->AmountPayable->ViewValue = $this->AmountPayable->CurrentValue;
		$this->AmountPayable->ViewValue = FormatCurrency($this->AmountPayable->ViewValue, 2, -2, -2, -2);
		$this->AmountPayable->ViewCustomAttributes = "";

		// Property
		$this->Property->ViewValue = $this->Property->CurrentValue;
		$this->Property->ViewCustomAttributes = "";

		// PropertyId
		$this->PropertyId->ViewValue = $this->PropertyId->CurrentValue;
		$this->PropertyId->ViewCustomAttributes = "";

		// PropertyUse
		$this->PropertyUse->ViewValue = $this->PropertyUse->CurrentValue;
		$this->PropertyUse->ViewCustomAttributes = "";

		// Location
		$this->Location->ViewValue = $this->Location->CurrentValue;
		$this->Location->ViewCustomAttributes = "";

		// AmountPaid
		$this->AmountPaid->ViewValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->ViewValue = FormatCurrency($this->AmountPaid->ViewValue, 2, -1, -2, -2);
		$this->AmountPaid->ViewCustomAttributes = "";

		// CurrentBalance
		$this->CurrentBalance->ViewValue = $this->CurrentBalance->CurrentValue;
		$this->CurrentBalance->ViewValue = FormatCurrency($this->CurrentBalance->ViewValue, 2, -2, -2, -2);
		$this->CurrentBalance->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->ViewCustomAttributes = "";

		// DataRegistered
		$this->DataRegistered->ViewValue = $this->DataRegistered->CurrentValue;
		$this->DataRegistered->ViewValue = FormatDateTime($this->DataRegistered->ViewValue, 0);
		$this->DataRegistered->ViewCustomAttributes = "";

		// PhysicalAddress
		if (strval($this->PhysicalAddress->CurrentValue) != "") {
			$this->PhysicalAddress->ViewValue = $this->PhysicalAddress->optionCaption($this->PhysicalAddress->CurrentValue);
		} else {
			$this->PhysicalAddress->ViewValue = NULL;
		}
		$this->PhysicalAddress->ViewCustomAttributes = "";

		// Status
		if (strval($this->Status->CurrentValue) != "") {
			$this->Status->ViewValue = $this->Status->optionCaption($this->Status->CurrentValue);
		} else {
			$this->Status->ViewValue = NULL;
		}
		$this->Status->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// ClientId
		$this->ClientId->LinkCustomAttributes = "";
		$this->ClientId->HrefValue = "";
		$this->ClientId->TooltipValue = "";

		// ChargeGroup
		$this->ChargeGroup->LinkCustomAttributes = "";
		$this->ChargeGroup->HrefValue = "";
		$this->ChargeGroup->TooltipValue = "";

		// ChargeGropuDes
		$this->ChargeGropuDes->LinkCustomAttributes = "";
		$this->ChargeGropuDes->HrefValue = "";
		$this->ChargeGropuDes->TooltipValue = "";

		// ChargeableFee
		$this->ChargeableFee->LinkCustomAttributes = "";
		$this->ChargeableFee->HrefValue = "";
		$this->ChargeableFee->TooltipValue = "";

		// BalanceBF
		$this->BalanceBF->LinkCustomAttributes = "";
		$this->BalanceBF->HrefValue = "";
		$this->BalanceBF->TooltipValue = "";

		// AmountPayable
		$this->AmountPayable->LinkCustomAttributes = "";
		$this->AmountPayable->HrefValue = "";
		$this->AmountPayable->TooltipValue = "";

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

		// Location
		$this->Location->LinkCustomAttributes = "";
		$this->Location->HrefValue = "";
		$this->Location->TooltipValue = "";

		// AmountPaid
		$this->AmountPaid->LinkCustomAttributes = "";
		$this->AmountPaid->HrefValue = "";
		$this->AmountPaid->TooltipValue = "";

		// CurrentBalance
		$this->CurrentBalance->LinkCustomAttributes = "";
		$this->CurrentBalance->HrefValue = "";
		$this->CurrentBalance->TooltipValue = "";

		// Description
		$this->Description->LinkCustomAttributes = "";
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// DataRegistered
		$this->DataRegistered->LinkCustomAttributes = "";
		$this->DataRegistered->HrefValue = "";
		$this->DataRegistered->TooltipValue = "";

		// PhysicalAddress
		$this->PhysicalAddress->LinkCustomAttributes = "";
		$this->PhysicalAddress->HrefValue = "";
		$this->PhysicalAddress->TooltipValue = "";

		// Status
		$this->Status->LinkCustomAttributes = "";
		$this->Status->HrefValue = "";
		$this->Status->TooltipValue = "";

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

		// ChargeGroup
		$this->ChargeGroup->EditAttrs["class"] = "form-control";
		$this->ChargeGroup->EditCustomAttributes = "";
		$this->ChargeGroup->EditValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

		// ChargeGropuDes
		$this->ChargeGropuDes->EditAttrs["class"] = "form-control";
		$this->ChargeGropuDes->EditCustomAttributes = "";

		// ChargeableFee
		$this->ChargeableFee->EditAttrs["class"] = "form-control";
		$this->ChargeableFee->EditCustomAttributes = "";
		$this->ChargeableFee->EditValue = $this->ChargeableFee->CurrentValue;
		$this->ChargeableFee->PlaceHolder = RemoveHtml($this->ChargeableFee->caption());
		if (strval($this->ChargeableFee->EditValue) != "" && is_numeric($this->ChargeableFee->EditValue))
			$this->ChargeableFee->EditValue = FormatNumber($this->ChargeableFee->EditValue, -2, 0, -2, 0);
		

		// BalanceBF
		$this->BalanceBF->EditAttrs["class"] = "form-control";
		$this->BalanceBF->EditCustomAttributes = "";
		$this->BalanceBF->EditValue = $this->BalanceBF->CurrentValue;
		$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
		if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
			$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, 0, -2, 0);
		

		// AmountPayable
		$this->AmountPayable->EditAttrs["class"] = "form-control";
		$this->AmountPayable->EditCustomAttributes = "";
		$this->AmountPayable->EditValue = $this->AmountPayable->CurrentValue;
		$this->AmountPayable->PlaceHolder = RemoveHtml($this->AmountPayable->caption());
		if (strval($this->AmountPayable->EditValue) != "" && is_numeric($this->AmountPayable->EditValue))
			$this->AmountPayable->EditValue = FormatNumber($this->AmountPayable->EditValue, -2, 0, -2, 0);
		

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

		// Location
		$this->Location->EditAttrs["class"] = "form-control";
		$this->Location->EditCustomAttributes = "";
		if (!$this->Location->Raw)
			$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
		$this->Location->EditValue = $this->Location->CurrentValue;
		$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

		// AmountPaid
		$this->AmountPaid->EditAttrs["class"] = "form-control";
		$this->AmountPaid->EditCustomAttributes = "";
		$this->AmountPaid->EditValue = $this->AmountPaid->CurrentValue;
		$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
		if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
			$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
		

		// CurrentBalance
		$this->CurrentBalance->EditAttrs["class"] = "form-control";
		$this->CurrentBalance->EditCustomAttributes = "";
		$this->CurrentBalance->EditValue = $this->CurrentBalance->CurrentValue;
		$this->CurrentBalance->PlaceHolder = RemoveHtml($this->CurrentBalance->caption());
		if (strval($this->CurrentBalance->EditValue) != "" && is_numeric($this->CurrentBalance->EditValue))
			$this->CurrentBalance->EditValue = FormatNumber($this->CurrentBalance->EditValue, -2, 0, -2, 0);
		

		// Description
		$this->Description->EditAttrs["class"] = "form-control";
		$this->Description->EditCustomAttributes = "";
		$this->Description->EditValue = $this->Description->CurrentValue;
		$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

		// DataRegistered
		$this->DataRegistered->EditAttrs["class"] = "form-control";
		$this->DataRegistered->EditCustomAttributes = "";
		$this->DataRegistered->EditValue = FormatDateTime($this->DataRegistered->CurrentValue, 8);
		$this->DataRegistered->PlaceHolder = RemoveHtml($this->DataRegistered->caption());

		// PhysicalAddress
		$this->PhysicalAddress->EditAttrs["class"] = "form-control";
		$this->PhysicalAddress->EditCustomAttributes = "";
		$this->PhysicalAddress->EditValue = $this->PhysicalAddress->options(TRUE);

		// Status
		$this->Status->EditCustomAttributes = "";
		$this->Status->EditValue = $this->Status->options(FALSE);

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
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->ClientId);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ChargeGropuDes);
					$doc->exportCaption($this->ChargeableFee);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->AmountPayable);
					$doc->exportCaption($this->Property);
					$doc->exportCaption($this->PropertyId);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->CurrentBalance);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->DataRegistered);
					$doc->exportCaption($this->PhysicalAddress);
					$doc->exportCaption($this->Status);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->ClientId);
					$doc->exportCaption($this->ChargeGroup);
					$doc->exportCaption($this->ChargeGropuDes);
					$doc->exportCaption($this->ChargeableFee);
					$doc->exportCaption($this->BalanceBF);
					$doc->exportCaption($this->AmountPayable);
					$doc->exportCaption($this->Property);
					$doc->exportCaption($this->PropertyId);
					$doc->exportCaption($this->PropertyUse);
					$doc->exportCaption($this->Location);
					$doc->exportCaption($this->AmountPaid);
					$doc->exportCaption($this->CurrentBalance);
					$doc->exportCaption($this->DataRegistered);
					$doc->exportCaption($this->Status);
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
						$doc->exportField($this->id);
						$doc->exportField($this->ClientId);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ChargeGropuDes);
						$doc->exportField($this->ChargeableFee);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->AmountPayable);
						$doc->exportField($this->Property);
						$doc->exportField($this->PropertyId);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->Location);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->CurrentBalance);
						$doc->exportField($this->Description);
						$doc->exportField($this->DataRegistered);
						$doc->exportField($this->PhysicalAddress);
						$doc->exportField($this->Status);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->ClientId);
						$doc->exportField($this->ChargeGroup);
						$doc->exportField($this->ChargeGropuDes);
						$doc->exportField($this->ChargeableFee);
						$doc->exportField($this->BalanceBF);
						$doc->exportField($this->AmountPayable);
						$doc->exportField($this->Property);
						$doc->exportField($this->PropertyId);
						$doc->exportField($this->PropertyUse);
						$doc->exportField($this->Location);
						$doc->exportField($this->AmountPaid);
						$doc->exportField($this->CurrentBalance);
						$doc->exportField($this->DataRegistered);
						$doc->exportField($this->Status);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'property';
		$usr = CurrentUserID();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'property';

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
		$table = 'property';

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
		$table = 'property';

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

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		$Id = $rsnew['PropertyId'];
		$qry = "SELECT
		`client`.`id`
		,`client`.`ClientID`
		, `client`.`Email`
		, `property`.`Property`
		, `property`.`PropertyId`
		, `property`.`AmountPayable`
		, `property`.`DataRegistered`
		, `charges`.`ChargeDesc`
	FROM
		`client`
		LEFT JOIN `property` 
			ON (`client`.`id` = `property`.`ClientId`)
		LEFT JOIN `charges` 
			ON (`charges`.`ChargeCode` = `property`.`ChargeGropuDes`) WHERE `property`.`PropertyId` = '$Id' ";
					$rs = executeRow($qry);
					$to = $rs['Email'];
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
					$message .= '<p style="font-size:18px;">A New Property has been registered under account# '.$rs['ClientID'].'<br/>
					PROPERTY NUMBER:'.$rs['PropertyId'].'<br/>
					PROPERTY DESC:'.$rs['Property'].'<br/>
					PROPERTY VALUE: ZMK '.$rs['AmountPayable'];
					$message .= '</body></html>';

					// Sending email
					mail($to, $subject, $message, $headers);
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