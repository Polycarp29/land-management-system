<?php
namespace PHPMaker2020\revenue;

/**
 * File Viewer class
 */
class FileViewer
{

	/**
	 * Output file
	 * Note: Uncomment ** for database connectivity
	 *
	 * @return bool Whether file is outputted successfully
	 */
	public function getFile()
	{
		global $Security;

		//**$GLOBALS["Conn"] = GetConnection();
		// Get parameters

		$tbl = NULL;
		$tableName = "";
		if (IsPost()) {
			$token = Post(Config("TOKEN_NAME"), "");
			$sessionId = Post("session", "");
			$fn = Post("fn", "");
			$table = Post("object", "");
			$field = Post("field", "");
			$recordkey = Post("key", "");
			$resize = Post("resize", "0") == "1";
			$width = Post("width", 0);
			$height = Post("height", 0);
			$download = Post("download", "1") == "1"; // Download by default
			$crop = Post("crop", "");
		} else { // api/file/object/field/key
			$token = Get(Config("TOKEN_NAME"), "");
			$sessionId = Get("session", "");
			$fn = Get("fn", "");
			$table = Get("object", Route(1));
			$field = Get("field", Route(2));
			$recordkey = Get("key", Route("key"));
			$resize = Get("resize", "0") == "1";
			$width = Get("width", 0);
			$height = Get("height", 0);
			$download = Get("download", "1") == "1"; // Download by default
			$crop = Get("crop", "");
		}
		$sessionId = Decrypt($sessionId);
		$key = Config("RANDOM_KEY") . $sessionId;
		if (!is_numeric($width))
			$width = 0;
		if (!is_numeric($height))
			$height = 0;
		if ($width == 0 && $height == 0 && $resize) {
			$width = Config("THUMBNAIL_DEFAULT_WIDTH");
			$height = Config("THUMBNAIL_DEFAULT_HEIGHT");
		}
		$validRequest = ValidApiRequest();

		// Get table object
		$tbl = $this->getTable($table);
		$tableName = is_object($tbl) ? $tbl->TableName : "";

		// For internal request, check if valid token
		if ($token != "") {
			$fn = Decrypt($fn, $key); // File path is always encrypted

		// API request with table/fn
		} elseif ($tableName != "") {
			$fn = Decrypt($fn, Config("RANDOM_KEY")); // File path is always encrypted
		} else { // DO NOT support external request for file path
			$fn = "";
		}

		// Check security
		if ($validRequest && $tableName != "") {
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $tableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			$validRequest = $Security->canList() || $Security->canView() || $Security->canDelete(); // With permission
			if ($validRequest) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Resize image from physical file
		$res = FALSE;
		$func = function($phpthumb) use ($width, $height) {
			$phpthumb->adaptiveResize($width, $height);
		};
		$plugins = $crop ? [$func] : [];
		if ($fn != "") {
			$fn = str_replace("\0", "", $fn);
			$info = pathinfo($fn);
			if (file_exists($fn) || @fopen($fn, "rb") !== FALSE) {
				$ext = strtolower(@$info["extension"]);
				$isPdf = SameText($ext, "pdf");
				$ct = MimeContentType($fn);
				if ($ct != "")
					AddHeader("Content-type", $ct);
				if (in_array($ext, explode(",", Config("IMAGE_ALLOWED_FILE_EXT")))) { // Skip "Content-Disposition" header if images
					$size = @getimagesize($fn);
					if ($size && @$size['mime'] != "")
						AddHeader("Content-type", $size['mime']);
					if ($width > 0 || $height > 0)
						$data = ResizeFileToBinary($fn, $width, $height, $plugins);
					else
						$data = file_get_contents($fn);
				} elseif (in_array($ext, explode(",", Config("DOWNLOAD_ALLOWED_FILE_EXT")))) {
					if ($download && !((Config("EMBED_PDF") || !Config("DOWNLOAD_PDF_FILE")) && $isPdf)) // Skip header if embed/inline PDF
						AddHeader("Content-Disposition", "attachment; filename=\"" . $info["basename"] . "\"");
					$data = file_get_contents($fn);
				}
				Write($data);
				$res = TRUE;
			}

		// Get image from table
		} elseif (is_object($tbl) && $field != "" && $recordkey != "") {
			$res = $tbl->getFileData($field, $recordkey, FALSE);
			if ($width > 0 || $height > 0)
				$res = ResizeBinary($res, $width, $height, 100, $plugins);
		}

		// Close connection
		//**CloseConnections();

		return $res;
	}

	/**
	 * Get table object
	 *
	 * @param string $table Table variable name
	 * @return mixed Table class
	 */
	protected function getTable($table) {
		$class = PROJECT_NAMESPACE . $table;
		if (class_exists($class)) {
			$tbl = new $class();
			return $tbl;
		}
		return NULL;
	}
}
?>