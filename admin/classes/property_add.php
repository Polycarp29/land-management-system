<?php
namespace PHPMaker2020\revenue;

/**
 * Page class
 */
class property_add extends property
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{F82056AB-CEC6-48BF-AA9B-76524AD406BC}";

	// Table name
	public $TableName = 'property';

	// Page object name
	public $PageObjName = "property_add";

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (property)
		if (!isset($GLOBALS["property"]) || get_class($GLOBALS["property"]) == PROJECT_NAMESPACE . "property") {
			$GLOBALS["property"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["property"];
		}

		// Table object (client)
		if (!isset($GLOBALS['client']))
			$GLOBALS['client'] = new client();

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

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
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "propertyview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("propertylist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
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
		$this->Description->setVisibility();
		$this->DataRegistered->setVisibility();
		$this->PhysicalAddress->setVisibility();
		$this->Status->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->ClientId);
		$this->setupLookupOptions($this->ChargeGroup);
		$this->setupLookupOptions($this->ChargeGropuDes);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("propertylist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("propertylist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "propertylist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "propertyview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view type
		} else {
			$this->RowType = ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->resetAttributes();
		$this->renderRow();
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
		$this->BalanceBF->CurrentValue = 0;
		$this->AmountPayable->CurrentValue = 0;
		$this->Property->CurrentValue = NULL;
		$this->Property->OldValue = $this->Property->CurrentValue;
		$this->PropertyId->CurrentValue = NULL;
		$this->PropertyId->OldValue = $this->PropertyId->CurrentValue;
		$this->PropertyUse->CurrentValue = NULL;
		$this->PropertyUse->OldValue = $this->PropertyUse->CurrentValue;
		$this->Location->CurrentValue = NULL;
		$this->Location->OldValue = $this->Location->CurrentValue;
		$this->AmountPaid->CurrentValue = 0;
		$this->CurrentBalance->CurrentValue = 0;
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

		// Check field name 'ClientId' first before field var 'x_ClientId'
		$val = $CurrentForm->hasValue("ClientId") ? $CurrentForm->getValue("ClientId") : $CurrentForm->getValue("x_ClientId");
		if (!$this->ClientId->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ClientId->Visible = FALSE; // Disable update for API request
			else
				$this->ClientId->setFormValue($val);
		}

		// Check field name 'ChargeGroup' first before field var 'x_ChargeGroup'
		$val = $CurrentForm->hasValue("ChargeGroup") ? $CurrentForm->getValue("ChargeGroup") : $CurrentForm->getValue("x_ChargeGroup");
		if (!$this->ChargeGroup->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGroup->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGroup->setFormValue($val);
		}

		// Check field name 'ChargeGropuDes' first before field var 'x_ChargeGropuDes'
		$val = $CurrentForm->hasValue("ChargeGropuDes") ? $CurrentForm->getValue("ChargeGropuDes") : $CurrentForm->getValue("x_ChargeGropuDes");
		if (!$this->ChargeGropuDes->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeGropuDes->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeGropuDes->setFormValue($val);
		}

		// Check field name 'ChargeableFee' first before field var 'x_ChargeableFee'
		$val = $CurrentForm->hasValue("ChargeableFee") ? $CurrentForm->getValue("ChargeableFee") : $CurrentForm->getValue("x_ChargeableFee");
		if (!$this->ChargeableFee->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->ChargeableFee->Visible = FALSE; // Disable update for API request
			else
				$this->ChargeableFee->setFormValue($val);
		}

		// Check field name 'BalanceBF' first before field var 'x_BalanceBF'
		$val = $CurrentForm->hasValue("BalanceBF") ? $CurrentForm->getValue("BalanceBF") : $CurrentForm->getValue("x_BalanceBF");
		if (!$this->BalanceBF->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->BalanceBF->Visible = FALSE; // Disable update for API request
			else
				$this->BalanceBF->setFormValue($val);
		}

		// Check field name 'AmountPayable' first before field var 'x_AmountPayable'
		$val = $CurrentForm->hasValue("AmountPayable") ? $CurrentForm->getValue("AmountPayable") : $CurrentForm->getValue("x_AmountPayable");
		if (!$this->AmountPayable->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPayable->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPayable->setFormValue($val);
		}

		// Check field name 'Property' first before field var 'x_Property'
		$val = $CurrentForm->hasValue("Property") ? $CurrentForm->getValue("Property") : $CurrentForm->getValue("x_Property");
		if (!$this->Property->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Property->Visible = FALSE; // Disable update for API request
			else
				$this->Property->setFormValue($val);
		}

		// Check field name 'PropertyId' first before field var 'x_PropertyId'
		$val = $CurrentForm->hasValue("PropertyId") ? $CurrentForm->getValue("PropertyId") : $CurrentForm->getValue("x_PropertyId");
		if (!$this->PropertyId->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyId->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyId->setFormValue($val);
		}

		// Check field name 'PropertyUse' first before field var 'x_PropertyUse'
		$val = $CurrentForm->hasValue("PropertyUse") ? $CurrentForm->getValue("PropertyUse") : $CurrentForm->getValue("x_PropertyUse");
		if (!$this->PropertyUse->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PropertyUse->Visible = FALSE; // Disable update for API request
			else
				$this->PropertyUse->setFormValue($val);
		}

		// Check field name 'Location' first before field var 'x_Location'
		$val = $CurrentForm->hasValue("Location") ? $CurrentForm->getValue("Location") : $CurrentForm->getValue("x_Location");
		if (!$this->Location->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Location->Visible = FALSE; // Disable update for API request
			else
				$this->Location->setFormValue($val);
		}

		// Check field name 'AmountPaid' first before field var 'x_AmountPaid'
		$val = $CurrentForm->hasValue("AmountPaid") ? $CurrentForm->getValue("AmountPaid") : $CurrentForm->getValue("x_AmountPaid");
		if (!$this->AmountPaid->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->AmountPaid->Visible = FALSE; // Disable update for API request
			else
				$this->AmountPaid->setFormValue($val);
		}

		// Check field name 'CurrentBalance' first before field var 'x_CurrentBalance'
		$val = $CurrentForm->hasValue("CurrentBalance") ? $CurrentForm->getValue("CurrentBalance") : $CurrentForm->getValue("x_CurrentBalance");
		if (!$this->CurrentBalance->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->CurrentBalance->Visible = FALSE; // Disable update for API request
			else
				$this->CurrentBalance->setFormValue($val);
		}

		// Check field name 'Description' first before field var 'x_Description'
		$val = $CurrentForm->hasValue("Description") ? $CurrentForm->getValue("Description") : $CurrentForm->getValue("x_Description");
		if (!$this->Description->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Description->Visible = FALSE; // Disable update for API request
			else
				$this->Description->setFormValue($val);
		}

		// Check field name 'DataRegistered' first before field var 'x_DataRegistered'
		$val = $CurrentForm->hasValue("DataRegistered") ? $CurrentForm->getValue("DataRegistered") : $CurrentForm->getValue("x_DataRegistered");
		if (!$this->DataRegistered->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->DataRegistered->Visible = FALSE; // Disable update for API request
			else
				$this->DataRegistered->setFormValue($val);
			$this->DataRegistered->CurrentValue = UnFormatDateTime($this->DataRegistered->CurrentValue, 0);
		}

		// Check field name 'PhysicalAddress' first before field var 'x_PhysicalAddress'
		$val = $CurrentForm->hasValue("PhysicalAddress") ? $CurrentForm->getValue("PhysicalAddress") : $CurrentForm->getValue("x_PhysicalAddress");
		if (!$this->PhysicalAddress->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->PhysicalAddress->Visible = FALSE; // Disable update for API request
			else
				$this->PhysicalAddress->setFormValue($val);
		}

		// Check field name 'Status' first before field var 'x_Status'
		$val = $CurrentForm->hasValue("Status") ? $CurrentForm->getValue("Status") : $CurrentForm->getValue("x_Status");
		if (!$this->Status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Status->Visible = FALSE; // Disable update for API request
			else
				$this->Status->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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
		$this->Description->CurrentValue = $this->Description->FormValue;
		$this->DataRegistered->CurrentValue = $this->DataRegistered->FormValue;
		$this->DataRegistered->CurrentValue = UnFormatDateTime($this->DataRegistered->CurrentValue, 0);
		$this->PhysicalAddress->CurrentValue = $this->PhysicalAddress->FormValue;
		$this->Status->CurrentValue = $this->Status->FormValue;
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
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// ClientId
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
			if (strval($this->ChargeableFee->EditValue) != "" && is_numeric($this->ChargeableFee->EditValue))
				$this->ChargeableFee->EditValue = FormatNumber($this->ChargeableFee->EditValue, -2, 0, -2, 0);
			

			// BalanceBF
			$this->BalanceBF->EditAttrs["class"] = "form-control";
			$this->BalanceBF->EditCustomAttributes = "";
			$this->BalanceBF->EditValue = HtmlEncode($this->BalanceBF->CurrentValue);
			$this->BalanceBF->PlaceHolder = RemoveHtml($this->BalanceBF->caption());
			if (strval($this->BalanceBF->EditValue) != "" && is_numeric($this->BalanceBF->EditValue))
				$this->BalanceBF->EditValue = FormatNumber($this->BalanceBF->EditValue, -2, 0, -2, 0);
			

			// AmountPayable
			$this->AmountPayable->EditAttrs["class"] = "form-control";
			$this->AmountPayable->EditCustomAttributes = "";
			$this->AmountPayable->EditValue = HtmlEncode($this->AmountPayable->CurrentValue);
			$this->AmountPayable->PlaceHolder = RemoveHtml($this->AmountPayable->caption());
			if (strval($this->AmountPayable->EditValue) != "" && is_numeric($this->AmountPayable->EditValue))
				$this->AmountPayable->EditValue = FormatNumber($this->AmountPayable->EditValue, -2, 0, -2, 0);
			

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
			if (strval($this->AmountPaid->EditValue) != "" && is_numeric($this->AmountPaid->EditValue))
				$this->AmountPaid->EditValue = FormatNumber($this->AmountPaid->EditValue, -2, -1, -2, 0);
			

			// CurrentBalance
			$this->CurrentBalance->EditAttrs["class"] = "form-control";
			$this->CurrentBalance->EditCustomAttributes = "";
			$this->CurrentBalance->EditValue = HtmlEncode($this->CurrentBalance->CurrentValue);
			$this->CurrentBalance->PlaceHolder = RemoveHtml($this->CurrentBalance->caption());
			if (strval($this->CurrentBalance->EditValue) != "" && is_numeric($this->CurrentBalance->EditValue))
				$this->CurrentBalance->EditValue = FormatNumber($this->CurrentBalance->EditValue, -2, 0, -2, 0);
			

			// Description
			$this->Description->EditAttrs["class"] = "form-control";
			$this->Description->EditCustomAttributes = "";
			$this->Description->EditValue = HtmlEncode($this->Description->CurrentValue);
			$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

			// DataRegistered
			$this->DataRegistered->EditAttrs["class"] = "form-control";
			$this->DataRegistered->EditCustomAttributes = "";
			$this->DataRegistered->EditValue = HtmlEncode(FormatDateTime($this->DataRegistered->CurrentValue, 8));
			$this->DataRegistered->PlaceHolder = RemoveHtml($this->DataRegistered->caption());

			// PhysicalAddress
			$this->PhysicalAddress->EditAttrs["class"] = "form-control";
			$this->PhysicalAddress->EditCustomAttributes = "";
			$this->PhysicalAddress->EditValue = $this->PhysicalAddress->options(TRUE);

			// Status
			$this->Status->EditCustomAttributes = "";
			$this->Status->EditValue = $this->Status->options(FALSE);

			// Add refer script
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

			// Description
			$this->Description->LinkCustomAttributes = "";
			$this->Description->HrefValue = "";

			// DataRegistered
			$this->DataRegistered->LinkCustomAttributes = "";
			$this->DataRegistered->HrefValue = "";

			// PhysicalAddress
			$this->PhysicalAddress->LinkCustomAttributes = "";
			$this->PhysicalAddress->HrefValue = "";

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

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
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
		if ($this->Description->Required) {
			if (!$this->Description->IsDetailKey && $this->Description->FormValue != NULL && $this->Description->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Description->caption(), $this->Description->RequiredErrorMessage));
			}
		}
		if ($this->DataRegistered->Required) {
			if (!$this->DataRegistered->IsDetailKey && $this->DataRegistered->FormValue != NULL && $this->DataRegistered->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->DataRegistered->caption(), $this->DataRegistered->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->DataRegistered->FormValue)) {
			AddMessage($FormError, $this->DataRegistered->errorMessage());
		}
		if ($this->PhysicalAddress->Required) {
			if (!$this->PhysicalAddress->IsDetailKey && $this->PhysicalAddress->FormValue != NULL && $this->PhysicalAddress->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PhysicalAddress->caption(), $this->PhysicalAddress->RequiredErrorMessage));
			}
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

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

		// Description
		$this->Description->setDbValueDef($rsnew, $this->Description->CurrentValue, NULL, FALSE);

		// DataRegistered
		$this->DataRegistered->setDbValueDef($rsnew, UnFormatDateTime($this->DataRegistered->CurrentValue, 0), NULL, FALSE);

		// PhysicalAddress
		$this->PhysicalAddress->setDbValueDef($rsnew, $this->PhysicalAddress->CurrentValue, NULL, FALSE);

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
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("ClientId"))) !== NULL) {
					$GLOBALS["client"]->id->setQueryStringValue($parm);
					$this->ClientId->setQueryStringValue($GLOBALS["client"]->id->QueryStringValue);
					$this->ClientId->setSessionValue($this->ClientId->QueryStringValue);
					if (!is_numeric($GLOBALS["client"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "client") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("ClientId"))) !== NULL) {
					$GLOBALS["client"]->id->setFormValue($parm);
					$this->ClientId->setFormValue($GLOBALS["client"]->id->FormValue);
					$this->ClientId->setSessionValue($this->ClientId->FormValue);
					if (!is_numeric($GLOBALS["client"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "client") {
				if ($this->ClientId->CurrentValue == "")
					$this->ClientId->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("propertylist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
} // End class
?>