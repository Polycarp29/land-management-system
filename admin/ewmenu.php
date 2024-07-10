<?php
namespace PHPMaker2020\revenue;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(12, "mci_Revenue_Collection", $MenuLanguage->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(7, "mi_property_revenu", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "property_revenulist.php?cmd=resetall", 12, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_revenu'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(13, "mci_Client_Manangement", $MenuLanguage->MenuPhrase("13", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(4, "mi_client_type", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "client_typelist.php", 13, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_type'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(3, "mi_client", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "clientlist.php", 13, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(40, "mi_update_requests", $MenuLanguage->MenuPhrase("40", "MenuText"), $MenuRelativePath . "update_requestslist.php", 13, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}update_requests'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(14, "mci_Charge_Management", $MenuLanguage->MenuPhrase("14", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(1, "mi_charge_group", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "charge_grouplist.php", 14, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charge_group'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(2, "mi_charges", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "chargeslist.php", 14, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charges'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(27, "mci_Property_Management", $MenuLanguage->MenuPhrase("27", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(29, "mi_property_use", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "property_uselist.php", 27, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_use'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(6, "mi_property", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "propertylist.php?cmd=resetall", 27, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property'), FALSE, FALSE, "", "", TRUE);
$topMenu->addMenuItem(28, "mci_Certificates", $MenuLanguage->MenuPhrase("28", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$topMenu->addMenuItem(125, "mi_billing_period", $MenuLanguage->MenuPhrase("125", "MenuText"), $MenuRelativePath . "billing_periodlist.php", -1, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}billing_period'), FALSE, FALSE, "", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(91, "mci_LAND-PROPERTY_BILLS", $MenuLanguage->MenuPhrase("91", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(64, "mi_bills", $MenuLanguage->MenuPhrase("64", "MenuText"), $MenuRelativePath . "bills.php", 91, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}bills.php'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(65, "mi_billRecords", $MenuLanguage->MenuPhrase("65", "MenuText"), $MenuRelativePath . "billRecords.php", 91, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}billRecords.php'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(61, "mci_REVENUE_REPORTS", $MenuLanguage->MenuPhrase("61", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(42, "mi_Rates_Report", $MenuLanguage->MenuPhrase("42", "MenuText"), $MenuRelativePath . "Rates_Reportctb.php", 61, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}Rates_Report'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(62, "mi_client_query", $MenuLanguage->MenuPhrase("62", "MenuText"), $MenuRelativePath . "client_querylist.php", -1, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_query'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(33, "mci_USER_MANAGEMENT", $MenuLanguage->MenuPhrase("33", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(36, "mi_userlevels", $MenuLanguage->MenuPhrase("36", "MenuText"), $MenuRelativePath . "userlevelslist.php", 33, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(34, "mi_users", $MenuLanguage->MenuPhrase("34", "MenuText"), $MenuRelativePath . "userslist.php", 33, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}users'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(35, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("35", "MenuText"), $MenuRelativePath . "userlevelpermissionslist.php", 33, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(124, "mci_SYSTEM", $MenuLanguage->MenuPhrase("124", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(93, "mi_backup", $MenuLanguage->MenuPhrase("93", "MenuText"), $MenuRelativePath . "backup.php", 124, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}backup.php'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(94, "mi_backupFiles", $MenuLanguage->MenuPhrase("94", "MenuText"), $MenuRelativePath . "backupFiles.php", 124, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}backupFiles.php'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(39, "mi_system_settings", $MenuLanguage->MenuPhrase("39", "MenuText"), $MenuRelativePath . "system_settingslist.php", 124, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}system_settings'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mci_Revenue_Collection", $MenuLanguage->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(7, "mi_property_revenu", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "property_revenulist.php?cmd=resetall", 12, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_revenu'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(13, "mci_Client_Manangement", $MenuLanguage->MenuPhrase("13", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(4, "mi_client_type", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "client_typelist.php", 13, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client_type'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(3, "mi_client", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "clientlist.php", 13, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}client'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(40, "mi_update_requests", $MenuLanguage->MenuPhrase("40", "MenuText"), $MenuRelativePath . "update_requestslist.php", 13, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}update_requests'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(14, "mci_Charge_Management", $MenuLanguage->MenuPhrase("14", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(1, "mi_charge_group", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "charge_grouplist.php", 14, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charge_group'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(2, "mi_charges", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "chargeslist.php", 14, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}charges'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(27, "mci_Property_Management", $MenuLanguage->MenuPhrase("27", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(29, "mi_property_use", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "property_uselist.php", 27, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property_use'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(6, "mi_property", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "propertylist.php?cmd=resetall", 27, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}property'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(28, "mci_Certificates", $MenuLanguage->MenuPhrase("28", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", TRUE);
$sideMenu->addMenuItem(32, "mci_Revenue_Reports", $MenuLanguage->MenuPhrase("32", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(125, "mi_billing_period", $MenuLanguage->MenuPhrase("125", "MenuText"), $MenuRelativePath . "billing_periodlist.php", -1, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}billing_period'), FALSE, FALSE, "", "", TRUE);
$sideMenu->addMenuItem(37, "mi_audittrail", $MenuLanguage->MenuPhrase("37", "MenuText"), $MenuRelativePath . "audittraillist.php", -1, "", AllowListMenu('{F82056AB-CEC6-48BF-AA9B-76524AD406BC}audittrail'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>