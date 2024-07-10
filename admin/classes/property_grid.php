<?php
namespace PHPMaker2020\revenue;

/**
 * Page class
 */
class property_grid extends property
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{F82056AB-CEC6-48BF-AA9B-76524AD406BC}";

	// Table name
	public $TableName = 'property';

	// Page object name
	public $PageObjName = "property_grid";

	// Grid form hidden field names
	public $FormName = "fpropertygrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (property)
		if (!isset($GLOBALS["property"]) || get_class($GLOBALS["property"]) == PROJECT_NAMESPACE . "property") {
			$GLOBALS["property"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["property"];

		}
		$this->AddUrl = "propertyadd.php";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'property');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (users)
		$UserTable = $UserTable ?: new users();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $property;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($property);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 10;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,100,250,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id->setVisibility();
		$this->ClientId->setVisibility();
		$this->ChargeGroup->setVisibility();
		$this->ChargeGropuDes->setVisibility();
		$this->ChargeableFee->setVisibility();
		$this->BalanceBF->setVisibility();
		$this->AmountPayable->setVisibility();
		$this->Property->setVisibility();
		$this->PropertyId->setVisibility();
		$this->PropertyUse->setVisibility();
		$this->Location->setVisibility();
		$this->AmountPaid->setVisibility();
		$this->CurrentBalance->setVisibility();
		$this->Description->Visible = FALSE;
		$this->DataRegistered->setVisibility();
		$this->PhysicalAddress->Visible = FALSE;
		$this->Status->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->ClientId);
		$this->setupLookupOptions($this->ChargeGroup);
		$this->setupLookupOptions($this->ChargeGropuDes);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 10; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "client") {
			global $client;
			$rsmaster = $client->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("clientlist.php"); // Return to master page
			} else {
				$client->loadListRowValues($rsmaster);
				$client->RowType = ROWTYPE_MASTER; // Master row
				$client->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 10; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->ChargeableFee->FormValue = ""; // Clear form value
		$this->BalanceBF->FormValue = ""; // Clear form value
		$this->AmountPayable->FormValue = ""; // Clear form value
		$this->AmountPaid->FormValue = ""; // Clear form value
		$this->CurrentBalance->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		if ($this->AuditTrailOnEdit)
			$this->writeAuditTrailDummy($Language->phrase("BatchUpdateBegin")); // Batch update begin
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateSuccess")); // Batch update success
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->AuditTrailOnEdit)
				$this->writeAuditTrailDummy($Language->phrase("BatchUpdateRollback")); // Batch update rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		if ($this->AuditTrailOnAdd)
			$this->writeAuditTrailDummy($Language->phrase("BatchInsertBegin")); // Batch insert begin
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->id->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertSuccess")); // Batch insert success
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailDummy($Language->phrase("BatchInsertRollback")); // Batch insert rollback
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_ClientId") && $CurrentForm->hasValue("o_ClientId") && $this->ClientId->CurrentValue != $this->ClientId->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeGroup") && $CurrentForm->hasValue("o_ChargeGroup") && $this->ChargeGroup->CurrentValue != $this->ChargeGroup->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeGropuDes") && $CurrentForm->hasValue("o_ChargeGropuDes") && $this->ChargeGropuDes->CurrentValue != $this->ChargeGropuDes->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ChargeableFee") && $CurrentForm->hasValue("o_ChargeableFee") && $this->ChargeableFee->CurrentValue != $this->ChargeableFee->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_BalanceBF") && $CurrentForm->hasValue("o_BalanceBF") && $this->BalanceBF->CurrentValue != $this->BalanceBF->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AmountPayable") && $CurrentForm->hasValue("o_AmountPayable") && $this->AmountPayable->CurrentValue != $this->AmountPayable->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Property") && $CurrentForm->hasValue("o_Property") && $this->Property->CurrentValue != $this->Property->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PropertyId") && $CurrentForm->hasValue("o_PropertyId") && $this->PropertyId->CurrentValue != $this->PropertyId->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_PropertyUse") && $CurrentForm->hasValue("o_PropertyUse") && $this->PropertyUse->CurrentValue != $this->PropertyUse->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Location") && $CurrentForm->hasValue("o_Location") && $this->Location->CurrentValue != $this->Location->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_AmountPaid") && $CurrentForm->hasValue("o_AmountPaid") && $this->AmountPaid->CurrentValue != $this->AmountPaid->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_CurrentBalance") && $CurrentForm->hasValue("o_CurrentBalance") && $this->CurrentBalance->CurrentValue != $this->CurrentBalance->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_DataRegistered") && $CurrentForm->hasValue("o_DataRegistered") && $this->DataRegistered->CurrentValue != $this->DataRegistered->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_Status") && $CurrentForm->hasValue("o_Status") && $this->Status->CurrentValue != $this->Status->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->ClientId->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($this->CurrentMode == "view") { // View mode

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('id');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->canAdd();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}

// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->ClientId->CurrentValue = NULL;
		$this->ClientId->OldValue = $this->ClientId->CurrentValue;
		$this->ChargeGroup->CurrentValue = NULL;
		$this->ChargeGroup->OldValue = $this->ChargeGroup->CurrentValue;
		$this->ChargeGropuDes->CurrentValue = NULL;
		$this->ChargeGropuDes->OldValue = $this->ChargeGropuDes->CurrentValue;
		$this->ChargeableFee->CurrentValue = 0;
		$this->ChargeableFee->OldValue = $this->ChargeableFee->CurrentValue;
		$this->BalanceBF->CurrentValue = 0;
		$this->BalanceBF->OldValue = $this->BalanceBF->CurrentValue;
		$this->AmountPayable->CurrentValue = 0;
		$this->AmountPayable->OldValue = $this->AmountPayable->CurrentValue;
		$this->Property->CurrentValue = NULL;
		$this->Property->OldValue = $this->Property->CurrentValue;
		$this->PropertyId->CurrentValue = NULL;
		$this->PropertyId->OldValue = $this->PropertyId->CurrentValue;
		$this->PropertyUse->CurrentValue = NULL;
		$this->PropertyUse->OldValue = $this->PropertyUse->CurrentValue;
		$this->Location->CurrentValue = NULL;
		$this->Location->OldValue = $this->Location->CurrentValue;
		$this->AmountPaid->CurrentValue = 0;
		$this->AmountPaid->OldValue = $this->AmountPaid->CurrentValue;
		$this->CurrentBalance->CurrentValue = 0;
		$this->CurrentBalance->OldValue = $this->CurrentBalance->CurrentValue;
		$this->Description->CurrentValue = NULL;
		$this->Description->OldValue = $this->Description->CurrentValue;
		$this->DataRegistered->CurrentValue = NULL;
		$this->DataRegistered->OldValue = $this->DataRegistered->CurrentValue;
		$this->PhysicalAddress->CurrentValue = NULL;
		$this->PhysicalAddress->OldValue = $this->PhysicalAddress->CurrentValue;
		$this->Status->CurrentValue = NULL;
		$this->Status->OldValue = $this->Status->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);

		// Check field name 'ClientId' first before field var 'x_ClientId'
		$val = $CurrentForm->hasValue("ClientId") ? $CurrentForm->getValue("ClientId") : $CurrentForm->getValue("x_ClientId");
		if (!$this->ClientId->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientId->Visible = FALSE; // Disable update for API request
			else
				$this->ClientId->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ClientId"))
			$this->ClientId->setOldValue($CurrentForm->getValue("o_ClientId"));

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeGroup"))
			$this->ChargeGroup->setOldValue($CurrentForm->getValue("o_ChargeGroup"));

		// Check field name 'ChargeGropuDes' first before field var 'x_ChargeGropuDes'
		$val = $CurrentForm->hasValue("ChargeGropuDes") ? $CurrentForm->getValue("ChargeGropuDes") : $CurrentForm->getValue("x_ChargeGropuDes");
		if (!$this->ChargeGropuDes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGropuDes->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGropuDes->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeGropuDes"))
			$this->ChargeGropuDes->setOldValue($CurrentForm->getValue("o_ChargeGropuDes"));

		// Check field name 'ChargeableFee' first before field var 'x_ChargeableFee'
		$val = $CurrentForm->hasValue("ChargeableFee") ? $CurrentForm->getValue("ChargeableFee") : $CurrentForm->getValue("x_ChargeableFee");
		if (!$this->ChargeableFee->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeableFee->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeableFee->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ChargeableFee"))
			$this->ChargeableFee->setOldValue($CurrentForm->getValue("o_ChargeableFee"));

		// Check field name 'BalanceBF' first before field var 'x_BalanceBF'
		$val = $CurrentForm->hasValue("BalanceBF") ? $CurrentForm->getValue("BalanceBF") : $CurrentForm->getValue("x_BalanceBF");
		if (!$this->BalanceBF->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BalanceBF->Visible = FALSE; // Disable update for API request
			else
				$this->BalanceBF->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_BalanceBF"))
			$this->BalanceBF->setOldValue($CurrentForm->getValue("o_BalanceBF"));

		// Check field name 'AmountPayable' first before field var 'x_AmountPayable'
		$val = $CurrentForm->hasValue("AmountPayable") ? $CurrentForm->getValue("AmountPayable") : $CurrentForm->getValue("x_AmountPayable");
		if (!$this->AmountPayable->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPayable->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPayable->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AmountPayable"))
			$this->AmountPayable->setOldValue($CurrentForm->getValue("o_AmountPayable"));

		// Check field name 'Property' first before field var 'x_Property'
		$val = $CurrentForm->hasValue("Property") ? $CurrentForm->getValue("Property") : $CurrentForm->getValue("x_Property");
		if (!$this->Property->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Property->Visible = FALSE; // Disable update for API request
			else
				$this->Property->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Property"))
			$this->Property->setOldValue($CurrentForm->getValue("o_Property"));

		// Check field name 'PropertyId' first before field var 'x_PropertyId'
		$val = $CurrentForm->hasValue("PropertyId") ? $CurrentForm->getValue("PropertyId") : $CurrentForm->getValue("x_PropertyId");
		if (!$this->PropertyId->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyId->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyId->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PropertyId"))
			$this->PropertyId->setOldValue($CurrentForm->getValue("o_PropertyId"));

		// Check field name 'PropertyUse' first before field var 'x_PropertyUse'
		$val = $CurrentForm->hasValue("PropertyUse") ? $CurrentForm->getValue("PropertyUse") : $CurrentForm->getValue("x_PropertyUse");
		if (!$this->PropertyUse->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyUse->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyUse->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_PropertyUse"))
			$this->PropertyUse->setOldValue($CurrentForm->getValue("o_PropertyUse"));

		// Check field name 'Location' first before field var 'x_Location'
		$val = $CurrentForm->hasValue("Location") ? $CurrentForm->getValue("Location") : $CurrentForm->getValue("x_Location");
		if (!$this->Location->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Location->Visible = FALSE; // Disable update for API request
			else
				$this->Location->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Location"))
			$this->Location->setOldValue($CurrentForm->getValue("o_Location"));

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_AmountPaid"))
			$this->AmountPaid->setOldValue($CurrentForm->getValue("o_AmountPaid"));

		// Check field name 'CurrentBalance' first before field var 'x_CurrentBalance'
		$val = $CurrentForm->hasValue("CurrentBalance") ? $CurrentForm->getValue("CurrentBalance") : $CurrentForm->getValue("x_CurrentBalance");
		if (!$this->CurrentBalance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrentBalance->Visible = FALSE; // Disable update for API request
			else
				$this->CurrentBalance->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_CurrentBalance"))
			$this->CurrentBalance->setOldValue($CurrentForm->getValue("o_CurrentBalance"));

		// Check field name 'DataRegistered' first before field var 'x_DataRegistered'
		$val = $CurrentForm->hasValue("DataRegistered") ? $CurrentForm->getValue("DataRegistered") : $CurrentForm->getValue("x_DataRegistered");
		if (!$this->DataRegistered->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DataRegistered->Visible = FALSE; // Disable update for API request
			else
				$this->DataRegistered->setFormValue($val);
			$this->DataRegistered->CurrentValue = UnFormatDateTime($this->DataRegistered->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_DataRegistered"))
			$this->DataRegistered->setOldValue($CurrentForm->getValue("o_DataRegistered"));

		// Check field name 'Status' first before field var 'x_Status'
		$val = $CurrentForm->hasValue("Status") ? $CurrentForm->getValue("Status") : $CurrentForm->getValue("x_Status");
		if (!$this->Status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Status->Visible = FALSE; // Disable update for API request
			else
				$this->Status->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_Status"))
			$this->Status->setOldValue($CurrentForm->getValue("o_Status"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->ClientId->CurrentValue = $this->ClientId->FormValue;
		$this->ChargeGroup->CurrentValue = $this->ChargeGroup->FormValue;
		$this->ChargeGropuDes->CurrentValue = $this->ChargeGropuDes->FormValue;
		$this->ChargeableFee->CurrentValue = $this->ChargeableFee->FormValue;
		$this->BalanceBF->CurrentValue = $this->BalanceBF->FormValue;
		$this->AmountPayable->CurrentValue = $this->AmountPayable->FormValue;
		$this->Property->CurrentValue = $this->Property->FormValue;
		$this->PropertyId->CurrentValue = $this->PropertyId->FormValue;
		$this->PropertyUse->CurrentValue = $this->PropertyUse->FormValue;
		$this->Location->CurrentValue = $this->Location->FormValue;
		$this->AmountPaid->CurrentValue = $this->AmountPaid->FormValue;
		$this->CurrentBalance->CurrentValue = $this->CurrentBalance->FormValue;
		$this->DataRegistered->CurrentValue = $this->DataRegistered->FormValue;
		$this->DataRegistered->CurrentValue = UnFormatDateTime($this->DataRegistered->CurrentValue, 0);
		$this->Status->CurrentValue = $this->Status->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->ClientId->setDbValue($row['ClientId']);
		$this->ChargeGroup->setDbValue($row['ChargeGroup']);
		$this->ChargeGropuDes->setDbValue($row['ChargeGropuDes']);
		$this->ChargeableFee->setDbValue($row['ChargeableFee']);
		$this->BalanceBF->setDbValue($row['BalanceBF']);
		$this->AmountPayable->setDbValue($row['AmountPayable']);
		$this->Property->setDbValue($row['Property']);
		$this->PropertyId->setDbValue($row['PropertyId']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
		$this->Location->setDbValue($row['Location']);
		$this->AmountPaid->setDbValue($row['AmountPaid']);
		$this->CurrentBalance->setDbValue($row['CurrentBalance']);
		$this->Description->setDbValue($row['Description']);
		$this->DataRegistered->setDbValue($row['DataRegistered']);
		$this->PhysicalAddress->setDbValue($row['PhysicalAddress']);
		$this->Status->setDbValue($row['Status']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['ClientId'] = $this->ClientId->CurrentValue;
		$row['ChargeGroup'] = $this->ChargeGroup->CurrentValue;
		$row['ChargeGropuDes'] = $this->ChargeGropuDes->CurrentValue;
		$row['ChargeableFee'] = $this->ChargeableFee->CurrentValue;
		$row['BalanceBF'] = $this->BalanceBF->CurrentValue;
		$row['AmountPayable'] = $this->AmountPayable->CurrentValue;
		$row['Property'] = $this->Property->CurrentValue;
		$row['PropertyId'] = $this->PropertyId->CurrentValue;
		$row['PropertyUse'] = $this->PropertyUse->CurrentValue;
		$row['Location'] = $this->Location->CurrentValue;
		$row['AmountPaid'] = $this->AmountPaid->CurrentValue;
		$row['CurrentBalance'] = $this->CurrentBalance->CurrentValue;
		$row['Description'] = $this->Description->CurrentValue;
		$row['DataRegistered'] = $this->DataRegistered->CurrentValue;
		$row['PhysicalAddress'] = $this->PhysicalAddress->CurrentValue;
		$row['Status'] = $this->Status->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->id->OldValue = strval($keys[0]); // id
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->ChargeableFee->FormValue == $this->ChargeableFee->CurrentValue && is_numeric(ConvertToFloatString($this->ChargeableFee->CurrentValue)))
			$this->ChargeableFee->CurrentValue = ConvertToFloatString($this->ChargeableFee->CurrentValue);

		// Convert decimal values if posted back
		if ($this->BalanceBF->FormValue == $this->BalanceBF->CurrentValue && is_numeric(ConvertToFloatString($this->BalanceBF->CurrentValue)))
			$this->BalanceBF->CurrentValue = ConvertToFloatString($this->BalanceBF->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPayable->FormValue == $this->AmountPayable->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPayable->CurrentValue)))
			$this->AmountPayable->CurrentValue = ConvertToFloatString($this->AmountPayable->CurrentValue);

		// Convert decimal values if posted back
		if ($this->AmountPaid->FormValue == $this->AmountPaid->CurrentValue && is_numeric(ConvertToFloatString($this->AmountPaid->CurrentValue)))
			$this->AmountPaid->CurrentValue = ConvertToFloatString($this->AmountPaid->CurrentValue);

		// Convert decimal values if posted back
		if ($this->CurrentBalance->FormValue == $this->CurrentBalance->CurrentValue && is_numeric(ConvertToFloatString($this->CurrentBalance->CurrentValue)))
			$this->CurrentBalance->CurrentValue = ConvertToFloatString($this->CurrentBalance->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// DataRegistered
			$this->DataRegistered->ViewValue = $this->DataRegistered->CurrentValue;
			$this->DataRegistered->ViewValue = FormatDateTime($this->DataRegistered->ViewValue, 0);
			$this->DataRegistered->ViewCustomAttributes = "";

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
			if (!$this->isExport())
				$this->Property->ViewValue = $this->highlightValue($this->Property);

			// PropertyId
			$this->PropertyId->LinkCustomAttributes = "";
			$this->PropertyId->HrefValue = "";
			$this->PropertyId->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyId->ViewValue = $this->highlightValue($this->PropertyId);

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";
			$this->PropertyUse->TooltipValue = "";
			if (!$this->isExport())
				$this->PropertyUse->ViewValue = $this->highlightValue($this->PropertyUse);

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";
			$this->Location->TooltipValue = "";
			if (!$this->isExport())
				$this->Location->ViewValue = $this->highlightValue($this->Location);

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";
			$this->AmountPaid->TooltipValue = "";

			// CurrentBalance
			$this->CurrentBalance->LinkCustomAttributes = "";
			$this->CurrentBalance->HrefValue = "";
			$this->CurrentBalance->TooltipValue = "";

			// DataRegistered
			$this->DataRegistered->LinkCustomAttributes = "";
			$this->DataRegistered->HrefValue = "";
			$this->DataRegistered->TooltipValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
			$this->Status->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id
			// ClientId

			$this->ClientId->EditCustomAttributes = "";
			if ($this->ClientId->getSessionValue() != "") {
				$this->ClientId->CurrentValue = $this->ClientId->getSessionValue();
				$this->ClientId->OldValue = $this->ClientId->CurrentValue;
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
				$curVal = trim(strval($this->ClientId->CurrentValue));
				if ($curVal != "")
					$this->ClientId->ViewValue = $this->ClientId->lookupCacheOption($curVal);
				else
					$this->ClientId->ViewValue = $this->ClientId->Lookup !== NULL && is_array($this->ClientId->Lookup->Options) ? $curVal : NULL;
				if ($this->ClientId->ViewValue !== NULL) { // Load from cache
					$this->ClientId->EditValue = array_values($this->ClientId->Lookup->Options);
					if ($this->ClientId->ViewValue == "")
						$this->ClientId->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`id`" . SearchString("=", $this->ClientId->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ClientId->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ClientId->ViewValue = $this->ClientId->displayValue($arwrk);
					} else {
						$this->ClientId->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ClientId->EditValue = $arwrk;
				}
			}

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$curVal = strval($this->ChargeGroup->CurrentValue);
			if ($curVal != "") {
				$this->ChargeGroup->EditValue = $this->ChargeGroup->lookupCacheOption($curVal);
				if ($this->ChargeGroup->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ChargeGroup->EditValue = $this->ChargeGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
					}
				}
			} else {
				$this->ChargeGroup->EditValue = NULL;
			}
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// ChargeGropuDes
			$this->ChargeGropuDes->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeGropuDes->CurrentValue));
			if ($curVal != "")
				$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->lookupCacheOption($curVal);
			else
				$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->Lookup !== NULL && is_array($this->ChargeGropuDes->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeGropuDes->ViewValue !== NULL) { // Load from cache
				$this->ChargeGropuDes->EditValue = array_values($this->ChargeGropuDes->Lookup->Options);
				if ($this->ChargeGropuDes->ViewValue == "")
					$this->ChargeGropuDes->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeCode`" . SearchString("=", $this->ChargeGropuDes->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ChargeGropuDes->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->displayValue($arwrk);
				} else {
					$this->ChargeGropuDes->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGropuDes->EditValue = $arwrk;
			}

			// ChargeableFee
			$this->ChargeableFee->EditAttrs["class"] = "form-control";
			$this->ChargeableFee->EditCustomAttributes = "";
			$this->ChargeableFee->EditValue = HtmlEncode($this->ChargeableFee->CurrentValue);
			$this->ChargeableFee->PlaceHolder = RemoveHtml($this->ChargeableFee->caption());
			if (strval($this->ChargeableFee->EditValue) != "" && is_numeric($this->ChargeableFee->EditValue)) {
				$this->ChargeableFee->EditValue = FormatNumber($this->ChargeableFee->EditValue, -2, 0, -2, 0);
				$this->ChargeableFee->OldValue = $this->ChargeableFee->EditValue;
			}
			

			// BalanceBF
			$this->BalanceBF->EditAttrs["class"] = "form-control";
			$this->BalanceBF->EditCustomAttributes = "";
			$this->BalanceBF->EditValue = HtmlEncode($this->BalanceBF->CurrentValue);
			$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
			if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue)) {
				$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, 0, -2, 0);
				$this->BalanceBF->OldValue = $this->BalanceBF->EditValue;
			}
			

			// AmountPayable
			$this->AmountPayable->EditAttrs["class"] = "form-control";
			$this->AmountPayable->EditCustomAttributes = "";
			$this->AmountPayable->EditValue = HtmlEncode($this->AmountPayable->CurrentValue);
			$this->AmountPayable->PlaceHolder = RemoveHtml($this->AmountPayable->caption());
			if (strval($this->AmountPayable->EditValue) != "" && is_numeric($this->AmountPayable->EditValue)) {
				$this->AmountPayable->EditValue = FormatNumber($this->AmountPayable->EditValue, -2, 0, -2, 0);
				$this->AmountPayable->OldValue = $this->AmountPayable->EditValue;
			}
			

			// Property
			$this->Property->EditAttrs["class"] = "form-control";
			$this->Property->EditCustomAttributes = "";
			if (!$this->Property->Raw)
				$this->Property->CurrentValue = HtmlDecode($this->Property->CurrentValue);
			$this->Property->EditValue = HtmlEncode($this->Property->CurrentValue);
			$this->Property->PlaceHolder = RemoveHtml($this->Property->caption());

			// PropertyId
			$this->PropertyId->EditAttrs["class"] = "form-control";
			$this->PropertyId->EditCustomAttributes = "";
			if (!$this->PropertyId->Raw)
				$this->PropertyId->CurrentValue = HtmlDecode($this->PropertyId->CurrentValue);
			$this->PropertyId->EditValue = HtmlEncode($this->PropertyId->CurrentValue);
			$this->PropertyId->PlaceHolder = RemoveHtml($this->PropertyId->caption());

			// PropertyUse
			$this->PropertyUse->EditAttrs["class"] = "form-control";
			$this->PropertyUse->EditCustomAttributes = "";
			if (!$this->PropertyUse->Raw)
				$this->PropertyUse->CurrentValue = HtmlDecode($this->PropertyUse->CurrentValue);
			$this->PropertyUse->EditValue = HtmlEncode($this->PropertyUse->CurrentValue);
			$this->PropertyUse->PlaceHolder = RemoveHtml($this->PropertyUse->caption());

			// Location
			$this->Location->EditAttrs["class"] = "form-control";
			$this->Location->EditCustomAttributes = "";
			if (!$this->Location->Raw)
				$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
			$this->Location->EditValue = HtmlEncode($this->Location->CurrentValue);
			$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue)) {
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
				$this->AmountPaid->OldValue = $this->AmountPaid->EditValue;
			}
			

			// CurrentBalance
			$this->CurrentBalance->EditAttrs["class"] = "form-control";
			$this->CurrentBalance->EditCustomAttributes = "";
			$this->CurrentBalance->EditValue = HtmlEncode($this->CurrentBalance->CurrentValue);
			$this->CurrentBalance->PlaceHolder = RemoveHtml($this->CurrentBalance->caption());
			if (strval($this->CurrentBalance->EditValue) != "" && is_numeric($this->CurrentBalance->EditValue)) {
				$this->CurrentBalance->EditValue = FormatNumber($this->CurrentBalance->EditValue, -2, 0, -2, 0);
				$this->CurrentBalance->OldValue = $this->CurrentBalance->EditValue;
			}
			

			// DataRegistered
			$this->DataRegistered->EditAttrs["class"] = "form-control";
			$this->DataRegistered->EditCustomAttributes = "";
			$this->DataRegistered->EditValue = HtmlEncode(FormatDateTime($this->DataRegistered->CurrentValue, 8));
			$this->DataRegistered->PlaceHolder = RemoveHtml($this->DataRegistered->caption());

			// Status
			$this->Status->EditCustomAttributes = "";
			$this->Status->EditValue = $this->Status->options(FALSE);

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// ClientId
			$this->ClientId->LinkCustomAttributes = "";
			$this->ClientId->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// ChargeGropuDes
			$this->ChargeGropuDes->LinkCustomAttributes = "";
			$this->ChargeGropuDes->HrefValue = "";

			// ChargeableFee
			$this->ChargeableFee->LinkCustomAttributes = "";
			$this->ChargeableFee->HrefValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";

			// AmountPayable
			$this->AmountPayable->LinkCustomAttributes = "";
			$this->AmountPayable->HrefValue = "";

			// Property
			$this->Property->LinkCustomAttributes = "";
			$this->Property->HrefValue = "";

			// PropertyId
			$this->PropertyId->LinkCustomAttributes = "";
			$this->PropertyId->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// CurrentBalance
			$this->CurrentBalance->LinkCustomAttributes = "";
			$this->CurrentBalance->HrefValue = "";

			// DataRegistered
			$this->DataRegistered->LinkCustomAttributes = "";
			$this->DataRegistered->HrefValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// ClientId
			$this->ClientId->EditCustomAttributes = "";
			if ($this->ClientId->getSessionValue() != "") {
				$this->ClientId->CurrentValue = $this->ClientId->getSessionValue();
				$this->ClientId->OldValue = $this->ClientId->CurrentValue;
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
				$curVal = trim(strval($this->ClientId->CurrentValue));
				if ($curVal != "")
					$this->ClientId->ViewValue = $this->ClientId->lookupCacheOption($curVal);
				else
					$this->ClientId->ViewValue = $this->ClientId->Lookup !== NULL && is_array($this->ClientId->Lookup->Options) ? $curVal : NULL;
				if ($this->ClientId->ViewValue !== NULL) { // Load from cache
					$this->ClientId->EditValue = array_values($this->ClientId->Lookup->Options);
					if ($this->ClientId->ViewValue == "")
						$this->ClientId->ViewValue = $Language->phrase("PleaseSelect");
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`id`" . SearchString("=", $this->ClientId->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->ClientId->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ClientId->ViewValue = $this->ClientId->displayValue($arwrk);
					} else {
						$this->ClientId->ViewValue = $Language->phrase("PleaseSelect");
					}
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->ClientId->EditValue = $arwrk;
				}
			}

			// ChargeGroup
			$this->ChargeGroup->EditAttrs["class"] = "form-control";
			$this->ChargeGroup->EditCustomAttributes = "";
			$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
			$curVal = strval($this->ChargeGroup->CurrentValue);
			if ($curVal != "") {
				$this->ChargeGroup->EditValue = $this->ChargeGroup->lookupCacheOption($curVal);
				if ($this->ChargeGroup->EditValue === NULL) { // Lookup from database
					$filterWrk = "`ChargeGroupCode`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->ChargeGroup->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->ChargeGroup->EditValue = $this->ChargeGroup->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->ChargeGroup->EditValue = HtmlEncode($this->ChargeGroup->CurrentValue);
					}
				}
			} else {
				$this->ChargeGroup->EditValue = NULL;
			}
			$this->ChargeGroup->PlaceHolder = RemoveHtml($this->ChargeGroup->caption());

			// ChargeGropuDes
			$this->ChargeGropuDes->EditCustomAttributes = "";
			$curVal = trim(strval($this->ChargeGropuDes->CurrentValue));
			if ($curVal != "")
				$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->lookupCacheOption($curVal);
			else
				$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->Lookup !== NULL && is_array($this->ChargeGropuDes->Lookup->Options) ? $curVal : NULL;
			if ($this->ChargeGropuDes->ViewValue !== NULL) { // Load from cache
				$this->ChargeGropuDes->EditValue = array_values($this->ChargeGropuDes->Lookup->Options);
				if ($this->ChargeGropuDes->ViewValue == "")
					$this->ChargeGropuDes->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`ChargeCode`" . SearchString("=", $this->ChargeGropuDes->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->ChargeGropuDes->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->ChargeGropuDes->ViewValue = $this->ChargeGropuDes->displayValue($arwrk);
				} else {
					$this->ChargeGropuDes->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->ChargeGropuDes->EditValue = $arwrk;
			}

			// ChargeableFee
			$this->ChargeableFee->EditAttrs["class"] = "form-control";
			$this->ChargeableFee->EditCustomAttributes = "";
			$this->ChargeableFee->EditValue = HtmlEncode($this->ChargeableFee->CurrentValue);
			$this->ChargeableFee->PlaceHolder = RemoveHtml($this->ChargeableFee->caption());
			if (strval($this->ChargeableFee->EditValue) != "" && is_numeric($this->ChargeableFee->EditValue)) {
				$this->ChargeableFee->EditValue = FormatNumber($this->ChargeableFee->EditValue, -2, 0, -2, 0);
				$this->ChargeableFee->OldValue = $this->ChargeableFee->EditValue;
			}
			

			// BalanceBF
			$this->BalanceBF->EditAttrs["class"] = "form-control";
			$this->BalanceBF->EditCustomAttributes = "";
			$this->BalanceBF->EditValue = HtmlEncode($this->BalanceBF->CurrentValue);
			$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
			if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue)) {
				$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, 0, -2, 0);
				$this->BalanceBF->OldValue = $this->BalanceBF->EditValue;
			}
			

			// AmountPayable
			$this->AmountPayable->EditAttrs["class"] = "form-control";
			$this->AmountPayable->EditCustomAttributes = "";
			$this->AmountPayable->EditValue = HtmlEncode($this->AmountPayable->CurrentValue);
			$this->AmountPayable->PlaceHolder = RemoveHtml($this->AmountPayable->caption());
			if (strval($this->AmountPayable->EditValue) != "" && is_numeric($this->AmountPayable->EditValue)) {
				$this->AmountPayable->EditValue = FormatNumber($this->AmountPayable->EditValue, -2, 0, -2, 0);
				$this->AmountPayable->OldValue = $this->AmountPayable->EditValue;
			}
			

			// Property
			$this->Property->EditAttrs["class"] = "form-control";
			$this->Property->EditCustomAttributes = "";
			if (!$this->Property->Raw)
				$this->Property->CurrentValue = HtmlDecode($this->Property->CurrentValue);
			$this->Property->EditValue = HtmlEncode($this->Property->CurrentValue);
			$this->Property->PlaceHolder = RemoveHtml($this->Property->caption());

			// PropertyId
			$this->PropertyId->EditAttrs["class"] = "form-control";
			$this->PropertyId->EditCustomAttributes = "";
			if (!$this->PropertyId->Raw)
				$this->PropertyId->CurrentValue = HtmlDecode($this->PropertyId->CurrentValue);
			$this->PropertyId->EditValue = HtmlEncode($this->PropertyId->CurrentValue);
			$this->PropertyId->PlaceHolder = RemoveHtml($this->PropertyId->caption());

			// PropertyUse
			$this->PropertyUse->EditAttrs["class"] = "form-control";
			$this->PropertyUse->EditCustomAttributes = "";
			if (!$this->PropertyUse->Raw)
				$this->PropertyUse->CurrentValue = HtmlDecode($this->PropertyUse->CurrentValue);
			$this->PropertyUse->EditValue = HtmlEncode($this->PropertyUse->CurrentValue);
			$this->PropertyUse->PlaceHolder = RemoveHtml($this->PropertyUse->caption());

			// Location
			$this->Location->EditAttrs["class"] = "form-control";
			$this->Location->EditCustomAttributes = "";
			if (!$this->Location->Raw)
				$this->Location->CurrentValue = HtmlDecode($this->Location->CurrentValue);
			$this->Location->EditValue = HtmlEncode($this->Location->CurrentValue);
			$this->Location->PlaceHolder = RemoveHtml($this->Location->caption());

			// AmountPaid
			$this->AmountPaid->EditAttrs["class"] = "form-control";
			$this->AmountPaid->EditCustomAttributes = "";
			$this->AmountPaid->EditValue = HtmlEncode($this->AmountPaid->CurrentValue);
			$this->AmountPaid->PlaceHolder = RemoveHtml($this->AmountPaid->caption());
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue)) {
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
				$this->AmountPaid->OldValue = $this->AmountPaid->EditValue;
			}
			

			// CurrentBalance
			$this->CurrentBalance->EditAttrs["class"] = "form-control";
			$this->CurrentBalance->EditCustomAttributes = "";
			$this->CurrentBalance->EditValue = HtmlEncode($this->CurrentBalance->CurrentValue);
			$this->CurrentBalance->PlaceHolder = RemoveHtml($this->CurrentBalance->caption());
			if (strval($this->CurrentBalance->EditValue) != "" && is_numeric($this->CurrentBalance->EditValue)) {
				$this->CurrentBalance->EditValue = FormatNumber($this->CurrentBalance->EditValue, -2, 0, -2, 0);
				$this->CurrentBalance->OldValue = $this->CurrentBalance->EditValue;
			}
			

			// DataRegistered
			$this->DataRegistered->EditAttrs["class"] = "form-control";
			$this->DataRegistered->EditCustomAttributes = "";
			$this->DataRegistered->EditValue = HtmlEncode(FormatDateTime($this->DataRegistered->CurrentValue, 8));
			$this->DataRegistered->PlaceHolder = RemoveHtml($this->DataRegistered->caption());

			// Status
			$this->Status->EditCustomAttributes = "";
			$this->Status->EditValue = $this->Status->options(FALSE);

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// ClientId
			$this->ClientId->LinkCustomAttributes = "";
			$this->ClientId->HrefValue = "";

			// ChargeGroup
			$this->ChargeGroup->LinkCustomAttributes = "";
			$this->ChargeGroup->HrefValue = "";

			// ChargeGropuDes
			$this->ChargeGropuDes->LinkCustomAttributes = "";
			$this->ChargeGropuDes->HrefValue = "";

			// ChargeableFee
			$this->ChargeableFee->LinkCustomAttributes = "";
			$this->ChargeableFee->HrefValue = "";

			// BalanceBF
			$this->BalanceBF->LinkCustomAttributes = "";
			$this->BalanceBF->HrefValue = "";

			// AmountPayable
			$this->AmountPayable->LinkCustomAttributes = "";
			$this->AmountPayable->HrefValue = "";

			// Property
			$this->Property->LinkCustomAttributes = "";
			$this->Property->HrefValue = "";

			// PropertyId
			$this->PropertyId->LinkCustomAttributes = "";
			$this->PropertyId->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";

			// Location
			$this->Location->LinkCustomAttributes = "";
			$this->Location->HrefValue = "";

			// AmountPaid
			$this->AmountPaid->LinkCustomAttributes = "";
			$this->AmountPaid->HrefValue = "";

			// CurrentBalance
			$this->CurrentBalance->LinkCustomAttributes = "";
			$this->CurrentBalance->HrefValue = "";

			// DataRegistered
			$this->DataRegistered->LinkCustomAttributes = "";
			$this->DataRegistered->HrefValue = "";

			// Status
			$this->Status->LinkCustomAttributes = "";
			$this->Status->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->ClientId->Required) {
			if (!$this->ClientId->IsDetailKey && $this->ClientId->FormValue != NULL && $this->ClientId->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ClientId->caption(), $this->ClientId->RequiredErrorMessage));
			}
		}
		if ($this->ChargeGroup->Required) {
			if (!$this->ChargeGroup->IsDetailKey && $this->ChargeGroup->FormValue != NULL && $this->ChargeGroup->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGroup->caption(), $this->ChargeGroup->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ChargeGroup->FormValue)) {
			AddMessage($FormError, $this->ChargeGroup->errorMessage());
		}
		if ($this->ChargeGropuDes->Required) {
			if (!$this->ChargeGropuDes->IsDetailKey && $this->ChargeGropuDes->FormValue != NULL && $this->ChargeGropuDes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeGropuDes->caption(), $this->ChargeGropuDes->RequiredErrorMessage));
			}
		}
		if ($this->ChargeableFee->Required) {
			if (!$this->ChargeableFee->IsDetailKey && $this->ChargeableFee->FormValue != NULL && $this->ChargeableFee->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ChargeableFee->caption(), $this->ChargeableFee->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ChargeableFee->FormValue)) {
			AddMessage($FormError, $this->ChargeableFee->errorMessage());
		}
		if ($this->BalanceBF->Required) {
			if (!$this->BalanceBF->IsDetailKey && $this->BalanceBF->FormValue != NULL && $this->BalanceBF->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BalanceBF->caption(), $this->BalanceBF->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->BalanceBF->FormValue)) {
			AddMessage($FormError, $this->BalanceBF->errorMessage());
		}
		if ($this->AmountPayable->Required) {
			if (!$this->AmountPayable->IsDetailKey && $this->AmountPayable->FormValue != NULL && $this->AmountPayable->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPayable->caption(), $this->AmountPayable->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPayable->FormValue)) {
			AddMessage($FormError, $this->AmountPayable->errorMessage());
		}
		if ($this->Property->Required) {
			if (!$this->Property->IsDetailKey && $this->Property->FormValue != NULL && $this->Property->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Property->caption(), $this->Property->RequiredErrorMessage));
			}
		}
		if ($this->PropertyId->Required) {
			if (!$this->PropertyId->IsDetailKey && $this->PropertyId->FormValue != NULL && $this->PropertyId->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyId->caption(), $this->PropertyId->RequiredErrorMessage));
			}
		}
		if ($this->PropertyUse->Required) {
			if (!$this->PropertyUse->IsDetailKey && $this->PropertyUse->FormValue != NULL && $this->PropertyUse->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PropertyUse->caption(), $this->PropertyUse->RequiredErrorMessage));
			}
		}
		if ($this->Location->Required) {
			if (!$this->Location->IsDetailKey && $this->Location->FormValue != NULL && $this->Location->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Location->caption(), $this->Location->RequiredErrorMessage));
			}
		}
		if ($this->AmountPaid->Required) {
			if (!$this->AmountPaid->IsDetailKey && $this->AmountPaid->FormValue != NULL && $this->AmountPaid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->AmountPaid->caption(), $this->AmountPaid->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->AmountPaid->FormValue)) {
			AddMessage($FormError, $this->AmountPaid->errorMessage());
		}
		if ($this->CurrentBalance->Required) {
			if (!$this->CurrentBalance->IsDetailKey && $this->CurrentBalance->FormValue != NULL && $this->CurrentBalance->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->CurrentBalance->caption(), $this->CurrentBalance->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->CurrentBalance->FormValue)) {
			AddMessage($FormError, $this->CurrentBalance->errorMessage());
		}
		if ($this->DataRegistered->Required) {
			if (!$this->DataRegistered->IsDetailKey && $this->DataRegistered->FormValue != NULL && $this->DataRegistered->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DataRegistered->caption(), $this->DataRegistered->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DataRegistered->FormValue)) {
			AddMessage($FormError, $this->DataRegistered->errorMessage());
		}
		if ($this->Status->Required) {
			if ($this->Status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Status->caption(), $this->Status->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		if ($this->AuditTrailOnDelete)
			$this->writeAuditTrailDummy($Language->phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// ClientId
			$this->ClientId->setDbValueDef($rsnew, $this->ClientId->CurrentValue, NULL, $this->ClientId->ReadOnly);

			// ChargeGroup
			$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, $this->ChargeGroup->ReadOnly);

			// ChargeGropuDes
			$this->ChargeGropuDes->setDbValueDef($rsnew, $this->ChargeGropuDes->CurrentValue, NULL, $this->ChargeGropuDes->ReadOnly);

			// ChargeableFee
			$this->ChargeableFee->setDbValueDef($rsnew, $this->ChargeableFee->CurrentValue, 0, $this->ChargeableFee->ReadOnly);

			// BalanceBF
			$this->BalanceBF->setDbValueDef($rsnew, $this->BalanceBF->CurrentValue, 0, $this->BalanceBF->ReadOnly);

			// AmountPayable
			$this->AmountPayable->setDbValueDef($rsnew, $this->AmountPayable->CurrentValue, 0, $this->AmountPayable->ReadOnly);

			// Property
			$this->Property->setDbValueDef($rsnew, $this->Property->CurrentValue, NULL, $this->Property->ReadOnly);

			// PropertyId
			$this->PropertyId->setDbValueDef($rsnew, $this->PropertyId->CurrentValue, NULL, $this->PropertyId->ReadOnly);

			// PropertyUse
			$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, NULL, $this->PropertyUse->ReadOnly);

			// Location
			$this->Location->setDbValueDef($rsnew, $this->Location->CurrentValue, NULL, $this->Location->ReadOnly);

			// AmountPaid
			$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, 0, $this->AmountPaid->ReadOnly);

			// CurrentBalance
			$this->CurrentBalance->setDbValueDef($rsnew, $this->CurrentBalance->CurrentValue, 0, $this->CurrentBalance->ReadOnly);

			// DataRegistered
			$this->DataRegistered->setDbValueDef($rsnew, UnFormatDateTime($this->DataRegistered->CurrentValue, 0), NULL, $this->DataRegistered->ReadOnly);

			// Status
			$this->Status->setDbValueDef($rsnew, $this->Status->CurrentValue, NULL, $this->Status->ReadOnly);

			// Check referential integrity for master table 'client'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_client();
			$keyValue = isset($rsnew['ClientId']) ? $rsnew['ClientId'] : $rsold['ClientId'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["client"]))
					$GLOBALS["client"] = new client();
				$rsmaster = $GLOBALS["client"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "client", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "client") {
				$this->ClientId->CurrentValue = $this->ClientId->getSessionValue();
			}

		// Check referential integrity for master table 'property'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_client();
		if (strval($this->ClientId->CurrentValue) != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->ClientId->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["client"]))
				$GLOBALS["client"] = new client();
			$rsmaster = $GLOBALS["client"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "client", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// ClientId
		$this->ClientId->setDbValueDef($rsnew, $this->ClientId->CurrentValue, NULL, FALSE);

		// ChargeGroup
		$this->ChargeGroup->setDbValueDef($rsnew, $this->ChargeGroup->CurrentValue, NULL, FALSE);

		// ChargeGropuDes
		$this->ChargeGropuDes->setDbValueDef($rsnew, $this->ChargeGropuDes->CurrentValue, NULL, FALSE);

		// ChargeableFee
		$this->ChargeableFee->setDbValueDef($rsnew, $this->ChargeableFee->CurrentValue, 0, strval($this->ChargeableFee->CurrentValue) == "");

		// BalanceBF
		$this->BalanceBF->setDbValueDef($rsnew, $this->BalanceBF->CurrentValue, 0, strval($this->BalanceBF->CurrentValue) == "");

		// AmountPayable
		$this->AmountPayable->setDbValueDef($rsnew, $this->AmountPayable->CurrentValue, 0, strval($this->AmountPayable->CurrentValue) == "");

		// Property
		$this->Property->setDbValueDef($rsnew, $this->Property->CurrentValue, NULL, FALSE);

		// PropertyId
		$this->PropertyId->setDbValueDef($rsnew, $this->PropertyId->CurrentValue, NULL, FALSE);

		// PropertyUse
		$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, NULL, FALSE);

		// Location
		$this->Location->setDbValueDef($rsnew, $this->Location->CurrentValue, NULL, FALSE);

		// AmountPaid
		$this->AmountPaid->setDbValueDef($rsnew, $this->AmountPaid->CurrentValue, 0, strval($this->AmountPaid->CurrentValue) == "");

		// CurrentBalance
		$this->CurrentBalance->setDbValueDef($rsnew, $this->CurrentBalance->CurrentValue, 0, strval($this->CurrentBalance->CurrentValue) == "");

		// DataRegistered
		$this->DataRegistered->setDbValueDef($rsnew, UnFormatDateTime($this->DataRegistered->CurrentValue, 0), NULL, FALSE);

		// Status
		$this->Status->setDbValueDef($rsnew, $this->Status->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "client") {
			$this->ClientId->Visible = FALSE;
			if ($GLOBALS["client"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_ClientId":
					break;
				case "x_ChargeGroup":
					break;
				case "x_ChargeGropuDes":
					break;
				case "x_PhysicalAddress":
					break;
				case "x_Status":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_ClientId":
							break;
						case "x_ChargeGroup":
							break;
						case "x_ChargeGropuDes":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>