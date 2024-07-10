<?php
namespace PHPMaker2020\revenue;

/**
 * Page class
 */
class update_requests_edit extends update_requests
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{F82056AB-CEC6-48BF-AA9B-76524AD406BC}";

	// Table name
	public $TableName = 'update_requests';

	// Page object name
	public $PageObjName = "update_requests_edit";

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

		// Table object (update_requests)
		if (!isset($GLOBALS["update_requests"]) || get_class($GLOBALS["update_requests"]) == PROJECT_NAMESPACE . "update_requests") {
			$GLOBALS["update_requests"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["update_requests"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'update_requests');

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
		global $update_requests;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($update_requests);
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
					if ($pageName == "update_requestsview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecords = 1;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecordCount;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("update_requestslist.php"));
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
		$this->NewClientIdentity->setVisibility();
		$this->NewClientName->setVisibility();
		$this->NewAccountType->setVisibility();
		$this->NewMobileNumber->setVisibility();
		$this->NewEmail->setVisibility();
		$this->NewAdditionalInformation->setVisibility();
		$this->date->setVisibility();
		$this->status->setVisibility();
		$this->Property->setVisibility();
		$this->PropertyId->setVisibility();
		$this->PropertyUse->setVisibility();
		$this->Comment->setVisibility();
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

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("update_requestslist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->id->setOldValue($this->id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id->setQueryStringValue(Route(2));
				$this->id->setOldValue($this->id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id")) {
					$this->id->setFormValue($CurrentForm->getValue("x_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id") !== NULL) {
					$this->id->setQueryStringValue(Get("id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id->CurrentValue = NULL;
				}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
			}

			// Load recordset
			$this->StartRecord = 1; // Initialize start position
			if ($rs = $this->loadRecordset()) // Load records
				$this->TotalRecords = $rs->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found
				if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
					$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate("update_requestslist.php"); // Return to list page
			} elseif ($loadByPosition) { // Load record by position
				$this->setupStartRecord(); // Set up start record position

				// Point to current record
				if ($this->StartRecord <= $this->TotalRecords) {
					$rs->move($this->StartRecord - 1);
					$loaded = TRUE;
				}
			} else { // Match key values
				if ($this->id->CurrentValue != NULL) {
					while (!$rs->EOF) {
						if (SameString($this->id->CurrentValue, $rs->fields('id'))) {
							$this->setStartRecordNumber($this->StartRecord); // Save record position
							$loaded = TRUE;
							break;
						} else {
							$this->StartRecord++;
							$rs->moveNext();
						}
					}
				}
			}

			// Load current row values
			if ($loaded)
				$this->loadRowValues($rs);
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("update_requestslist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "update_requestslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
		$this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
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

		// Check field name 'NewClientIdentity' first before field var 'x_NewClientIdentity'
		$val = $CurrentForm->hasValue("NewClientIdentity") ? $CurrentForm->getValue("NewClientIdentity") : $CurrentForm->getValue("x_NewClientIdentity");
		if (!$this->NewClientIdentity->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewClientIdentity->Visible = FALSE; // Disable update for API request
			else
				$this->NewClientIdentity->setFormValue($val);
		}

		// Check field name 'NewClientName' first before field var 'x_NewClientName'
		$val = $CurrentForm->hasValue("NewClientName") ? $CurrentForm->getValue("NewClientName") : $CurrentForm->getValue("x_NewClientName");
		if (!$this->NewClientName->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewClientName->Visible = FALSE; // Disable update for API request
			else
				$this->NewClientName->setFormValue($val);
		}

		// Check field name 'NewAccountType' first before field var 'x_NewAccountType'
		$val = $CurrentForm->hasValue("NewAccountType") ? $CurrentForm->getValue("NewAccountType") : $CurrentForm->getValue("x_NewAccountType");
		if (!$this->NewAccountType->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewAccountType->Visible = FALSE; // Disable update for API request
			else
				$this->NewAccountType->setFormValue($val);
		}

		// Check field name 'NewMobileNumber' first before field var 'x_NewMobileNumber'
		$val = $CurrentForm->hasValue("NewMobileNumber") ? $CurrentForm->getValue("NewMobileNumber") : $CurrentForm->getValue("x_NewMobileNumber");
		if (!$this->NewMobileNumber->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewMobileNumber->Visible = FALSE; // Disable update for API request
			else
				$this->NewMobileNumber->setFormValue($val);
		}

		// Check field name 'NewEmail' first before field var 'x_NewEmail'
		$val = $CurrentForm->hasValue("NewEmail") ? $CurrentForm->getValue("NewEmail") : $CurrentForm->getValue("x_NewEmail");
		if (!$this->NewEmail->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewEmail->Visible = FALSE; // Disable update for API request
			else
				$this->NewEmail->setFormValue($val);
		}

		// Check field name 'NewAdditionalInformation' first before field var 'x_NewAdditionalInformation'
		$val = $CurrentForm->hasValue("NewAdditionalInformation") ? $CurrentForm->getValue("NewAdditionalInformation") : $CurrentForm->getValue("x_NewAdditionalInformation");
		if (!$this->NewAdditionalInformation->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->NewAdditionalInformation->Visible = FALSE; // Disable update for API request
			else
				$this->NewAdditionalInformation->setFormValue($val);
		}

		// Check field name 'date' first before field var 'x_date'
		$val = $CurrentForm->hasValue("date") ? $CurrentForm->getValue("date") : $CurrentForm->getValue("x_date");
		if (!$this->date->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->date->Visible = FALSE; // Disable update for API request
			else
				$this->date->setFormValue($val);
			$this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, 7);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
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

		// Check field name 'Comment' first before field var 'x_Comment'
		$val = $CurrentForm->hasValue("Comment") ? $CurrentForm->getValue("Comment") : $CurrentForm->getValue("x_Comment");
		if (!$this->Comment->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->Comment->Visible = FALSE; // Disable update for API request
			else
				$this->Comment->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->ClientId->CurrentValue = $this->ClientId->FormValue;
		$this->NewClientIdentity->CurrentValue = $this->NewClientIdentity->FormValue;
		$this->NewClientName->CurrentValue = $this->NewClientName->FormValue;
		$this->NewAccountType->CurrentValue = $this->NewAccountType->FormValue;
		$this->NewMobileNumber->CurrentValue = $this->NewMobileNumber->FormValue;
		$this->NewEmail->CurrentValue = $this->NewEmail->FormValue;
		$this->NewAdditionalInformation->CurrentValue = $this->NewAdditionalInformation->FormValue;
		$this->date->CurrentValue = $this->date->FormValue;
		$this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, 7);
		$this->status->CurrentValue = $this->status->FormValue;
		$this->Property->CurrentValue = $this->Property->FormValue;
		$this->PropertyId->CurrentValue = $this->PropertyId->FormValue;
		$this->PropertyUse->CurrentValue = $this->PropertyUse->FormValue;
		$this->Comment->CurrentValue = $this->Comment->FormValue;
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
		$this->NewClientIdentity->setDbValue($row['NewClientIdentity']);
		$this->NewClientName->setDbValue($row['NewClientName']);
		$this->NewAccountType->setDbValue($row['NewAccountType']);
		$this->NewMobileNumber->setDbValue($row['NewMobileNumber']);
		$this->NewEmail->setDbValue($row['NewEmail']);
		$this->NewAdditionalInformation->setDbValue($row['NewAdditionalInformation']);
		$this->date->setDbValue($row['date']);
		$this->status->setDbValue($row['status']);
		$this->Property->setDbValue($row['Property']);
		$this->PropertyId->setDbValue($row['PropertyId']);
		$this->PropertyUse->setDbValue($row['PropertyUse']);
		$this->Comment->setDbValue($row['Comment']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['ClientId'] = NULL;
		$row['NewClientIdentity'] = NULL;
		$row['NewClientName'] = NULL;
		$row['NewAccountType'] = NULL;
		$row['NewMobileNumber'] = NULL;
		$row['NewEmail'] = NULL;
		$row['NewAdditionalInformation'] = NULL;
		$row['date'] = NULL;
		$row['status'] = NULL;
		$row['Property'] = NULL;
		$row['PropertyId'] = NULL;
		$row['PropertyUse'] = NULL;
		$row['Comment'] = NULL;
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// ClientId
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ClientId
			$this->ClientId->EditCustomAttributes = "";
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

			// NewClientIdentity
			$this->NewClientIdentity->EditAttrs["class"] = "form-control";
			$this->NewClientIdentity->EditCustomAttributes = "";
			if (!$this->NewClientIdentity->Raw)
				$this->NewClientIdentity->CurrentValue = HtmlDecode($this->NewClientIdentity->CurrentValue);
			$this->NewClientIdentity->EditValue = HtmlEncode($this->NewClientIdentity->CurrentValue);
			$this->NewClientIdentity->PlaceHolder = RemoveHtml($this->NewClientIdentity->caption());

			// NewClientName
			$this->NewClientName->EditAttrs["class"] = "form-control";
			$this->NewClientName->EditCustomAttributes = "";
			if (!$this->NewClientName->Raw)
				$this->NewClientName->CurrentValue = HtmlDecode($this->NewClientName->CurrentValue);
			$this->NewClientName->EditValue = HtmlEncode($this->NewClientName->CurrentValue);
			$this->NewClientName->PlaceHolder = RemoveHtml($this->NewClientName->caption());

			// NewAccountType
			$this->NewAccountType->EditAttrs["class"] = "form-control";
			$this->NewAccountType->EditCustomAttributes = "";
			$this->NewAccountType->EditValue = HtmlEncode($this->NewAccountType->CurrentValue);
			$this->NewAccountType->PlaceHolder = RemoveHtml($this->NewAccountType->caption());

			// NewMobileNumber
			$this->NewMobileNumber->EditAttrs["class"] = "form-control";
			$this->NewMobileNumber->EditCustomAttributes = "";
			if (!$this->NewMobileNumber->Raw)
				$this->NewMobileNumber->CurrentValue = HtmlDecode($this->NewMobileNumber->CurrentValue);
			$this->NewMobileNumber->EditValue = HtmlEncode($this->NewMobileNumber->CurrentValue);
			$this->NewMobileNumber->PlaceHolder = RemoveHtml($this->NewMobileNumber->caption());

			// NewEmail
			$this->NewEmail->EditAttrs["class"] = "form-control";
			$this->NewEmail->EditCustomAttributes = "";
			if (!$this->NewEmail->Raw)
				$this->NewEmail->CurrentValue = HtmlDecode($this->NewEmail->CurrentValue);
			$this->NewEmail->EditValue = HtmlEncode($this->NewEmail->CurrentValue);
			$this->NewEmail->PlaceHolder = RemoveHtml($this->NewEmail->caption());

			// NewAdditionalInformation
			$this->NewAdditionalInformation->EditAttrs["class"] = "form-control";
			$this->NewAdditionalInformation->EditCustomAttributes = "";
			$this->NewAdditionalInformation->EditValue = HtmlEncode($this->NewAdditionalInformation->CurrentValue);
			$this->NewAdditionalInformation->PlaceHolder = RemoveHtml($this->NewAdditionalInformation->caption());

			// date
			$this->date->EditAttrs["class"] = "form-control";
			$this->date->EditCustomAttributes = "";
			$this->date->EditValue = HtmlEncode(FormatDateTime($this->date->CurrentValue, 7));
			$this->date->PlaceHolder = RemoveHtml($this->date->caption());

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(FALSE);

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

			// Comment
			$this->Comment->EditAttrs["class"] = "form-control";
			$this->Comment->EditCustomAttributes = "";
			if (!$this->Comment->Raw)
				$this->Comment->CurrentValue = HtmlDecode($this->Comment->CurrentValue);
			$this->Comment->EditValue = HtmlEncode($this->Comment->CurrentValue);
			$this->Comment->PlaceHolder = RemoveHtml($this->Comment->caption());

			// Edit refer script
			// ClientId

			$this->ClientId->LinkCustomAttributes = "";
			$this->ClientId->HrefValue = "";

			// NewClientIdentity
			$this->NewClientIdentity->LinkCustomAttributes = "";
			$this->NewClientIdentity->HrefValue = "";

			// NewClientName
			$this->NewClientName->LinkCustomAttributes = "";
			$this->NewClientName->HrefValue = "";

			// NewAccountType
			$this->NewAccountType->LinkCustomAttributes = "";
			$this->NewAccountType->HrefValue = "";

			// NewMobileNumber
			$this->NewMobileNumber->LinkCustomAttributes = "";
			$this->NewMobileNumber->HrefValue = "";

			// NewEmail
			$this->NewEmail->LinkCustomAttributes = "";
			$this->NewEmail->HrefValue = "";

			// NewAdditionalInformation
			$this->NewAdditionalInformation->LinkCustomAttributes = "";
			$this->NewAdditionalInformation->HrefValue = "";

			// date
			$this->date->LinkCustomAttributes = "";
			$this->date->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// Property
			$this->Property->LinkCustomAttributes = "";
			$this->Property->HrefValue = "";

			// PropertyId
			$this->PropertyId->LinkCustomAttributes = "";
			$this->PropertyId->HrefValue = "";

			// PropertyUse
			$this->PropertyUse->LinkCustomAttributes = "";
			$this->PropertyUse->HrefValue = "";

			// Comment
			$this->Comment->LinkCustomAttributes = "";
			$this->Comment->HrefValue = "";
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
		if ($this->NewClientIdentity->Required) {
			if (!$this->NewClientIdentity->IsDetailKey && $this->NewClientIdentity->FormValue != NULL && $this->NewClientIdentity->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewClientIdentity->caption(), $this->NewClientIdentity->RequiredErrorMessage));
			}
		}
		if ($this->NewClientName->Required) {
			if (!$this->NewClientName->IsDetailKey && $this->NewClientName->FormValue != NULL && $this->NewClientName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewClientName->caption(), $this->NewClientName->RequiredErrorMessage));
			}
		}
		if ($this->NewAccountType->Required) {
			if (!$this->NewAccountType->IsDetailKey && $this->NewAccountType->FormValue != NULL && $this->NewAccountType->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewAccountType->caption(), $this->NewAccountType->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->NewAccountType->FormValue)) {
			AddMessage($FormError, $this->NewAccountType->errorMessage());
		}
		if ($this->NewMobileNumber->Required) {
			if (!$this->NewMobileNumber->IsDetailKey && $this->NewMobileNumber->FormValue != NULL && $this->NewMobileNumber->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewMobileNumber->caption(), $this->NewMobileNumber->RequiredErrorMessage));
			}
		}
		if ($this->NewEmail->Required) {
			if (!$this->NewEmail->IsDetailKey && $this->NewEmail->FormValue != NULL && $this->NewEmail->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewEmail->caption(), $this->NewEmail->RequiredErrorMessage));
			}
		}
		if (!CheckEmail($this->NewEmail->FormValue)) {
			AddMessage($FormError, $this->NewEmail->errorMessage());
		}
		if ($this->NewAdditionalInformation->Required) {
			if (!$this->NewAdditionalInformation->IsDetailKey && $this->NewAdditionalInformation->FormValue != NULL && $this->NewAdditionalInformation->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->NewAdditionalInformation->caption(), $this->NewAdditionalInformation->RequiredErrorMessage));
			}
		}
		if ($this->date->Required) {
			if (!$this->date->IsDetailKey && $this->date->FormValue != NULL && $this->date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->date->caption(), $this->date->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->date->FormValue)) {
			AddMessage($FormError, $this->date->errorMessage());
		}
		if ($this->status->Required) {
			if ($this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
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
		if ($this->Comment->Required) {
			if (!$this->Comment->IsDetailKey && $this->Comment->FormValue != NULL && $this->Comment->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Comment->caption(), $this->Comment->RequiredErrorMessage));
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

			// NewClientIdentity
			$this->NewClientIdentity->setDbValueDef($rsnew, $this->NewClientIdentity->CurrentValue, NULL, $this->NewClientIdentity->ReadOnly);

			// NewClientName
			$this->NewClientName->setDbValueDef($rsnew, $this->NewClientName->CurrentValue, NULL, $this->NewClientName->ReadOnly);

			// NewAccountType
			$this->NewAccountType->setDbValueDef($rsnew, $this->NewAccountType->CurrentValue, NULL, $this->NewAccountType->ReadOnly);

			// NewMobileNumber
			$this->NewMobileNumber->setDbValueDef($rsnew, $this->NewMobileNumber->CurrentValue, NULL, $this->NewMobileNumber->ReadOnly);

			// NewEmail
			$this->NewEmail->setDbValueDef($rsnew, $this->NewEmail->CurrentValue, NULL, $this->NewEmail->ReadOnly);

			// NewAdditionalInformation
			$this->NewAdditionalInformation->setDbValueDef($rsnew, $this->NewAdditionalInformation->CurrentValue, NULL, $this->NewAdditionalInformation->ReadOnly);

			// date
			$this->date->setDbValueDef($rsnew, UnFormatDateTime($this->date->CurrentValue, 7), NULL, $this->date->ReadOnly);

			// status
			$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, "", $this->status->ReadOnly);

			// Property
			$this->Property->setDbValueDef($rsnew, $this->Property->CurrentValue, NULL, $this->Property->ReadOnly);

			// PropertyId
			$this->PropertyId->setDbValueDef($rsnew, $this->PropertyId->CurrentValue, NULL, $this->PropertyId->ReadOnly);

			// PropertyUse
			$this->PropertyUse->setDbValueDef($rsnew, $this->PropertyUse->CurrentValue, NULL, $this->PropertyUse->ReadOnly);

			// Comment
			$this->Comment->setDbValueDef($rsnew, $this->Comment->CurrentValue, NULL, $this->Comment->ReadOnly);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("update_requestslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_status":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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