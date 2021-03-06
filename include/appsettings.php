<?php
$dDebug = false;
$dSQL = "";

$bUseMobileStyleOnly = false;

$tables_data = array ();
$page_layouts = array ();
$field_labels = array ();
$fieldToolTips = array ();
$page_titles = array ();
$lookupTableLinks = array ();

$_gmdays = array (
		0 => 31,
		1 => 31,
		2 => 28,
		3 => 31,
		4 => 30,
		5 => 31,
		6 => 30,
		7 => 31,
		8 => 31,
		9 => 30,
		10 => 31,
		11 => 30,
		12 => 31 
);

include (getabspath ( 'classes/layout.php' ));

// custom labels
$custom_labels = array ();
$custom_labels ["English"] = array ();

define ( 'NOT_TABLE_BASED_TNAME', ".global" );

/**
 * Define constants of page name
 */
define ( 'PAGE_LIST', "list" );
define ( 'PAGE_ADD', "add" );
define ( 'PAGE_EDIT', "edit" );
define ( 'PAGE_VIEW', "view" );
define ( 'PAGE_MENU', "menu" );
define ( 'PAGE_LOGIN', "login" );
define ( 'PAGE_REGISTER', "register" );
define ( 'PAGE_REMIND', "remind" );
define ( 'PAGE_CHANGEPASS', "changepwd" );
define ( 'PAGE_SEARCH', "search" );
define ( 'PAGE_REPORT', "report" );
define ( 'PAGE_CHART', "chart" );
define ( 'PAGE_PRINT', "print" );
define ( 'PAGE_RPRINT', "rprint" );
define ( 'PAGE_EXPORT', "export" );
define ( 'PAGE_IMPORT', "import" );
define ( 'PAGE_ADMIN_MEMBERS', "admin_members" );
define ( 'PAGE_ADMIN_RIGHTS', "admin_rights" );
define ( 'PAGE_INLINEADD', "inlineadd" );
define ( 'PAGE_INLINEEDIT', "inlineedit" );
define ( 'PAGE_DASHBOARD', "dashboard" );
define ( 'PAGE_DASHMAP', "map" );

define ( 'ADMIN_USERS', "admin_users" );

define ( 'FORMAT_VIEW', "ViewFormats" );
define ( 'FORMAT_EDIT', "EditFormats" );
/**
 * Define constants of view format
 */
define ( "FORMAT_NONE", "" );
define ( "FORMAT_DATE_SHORT", "Short Date" );
define ( "FORMAT_DATE_LONG", "Long Date" );
define ( "FORMAT_DATE_TIME", "Datetime" );
define ( "FORMAT_TIME", "Time" );
define ( "FORMAT_CURRENCY", "Currency" );
define ( "FORMAT_PERCENT", "Percent" );
define ( "FORMAT_HYPERLINK", "Hyperlink" );
define ( "FORMAT_EMAILHYPERLINK", "Email Hyperlink" );
define ( "FORMAT_FILE_IMAGE", "File-based Image" );
define ( "FORMAT_FILE_IMAGE_OLD", "Old file-based Image" );
define ( "FORMAT_DATABASE_IMAGE", "Database Image" );
define ( "FORMAT_DATABASE_FILE", "Database File" );
define ( "FORMAT_FILE", "Document Download" );
define ( "FORMAT_LOOKUP_WIZARD", "Lookup wizard" );
define ( "FORMAT_PHONE_NUMBER", "Phone Number" );
define ( "FORMAT_NUMBER", "Number" );
define ( "FORMAT_HTML", "HTML" );
define ( "FORMAT_CHECKBOX", "Checkbox" );
define ( "FORMAT_MAP", "Map" );
define ( "FORMAT_CUSTOM", "Custom" );
define ( "FORMAT_AUDIO", "Audio file" );
define ( "FORMAT_DATABASE_AUDIO", "Database audio" );
define ( "FORMAT_VIDEO", "Video file" );
define ( "FORMAT_VIDEO_HTML5", "Video file HTML5" );
define ( "FORMAT_DATABASE_VIDEO", "Database video" );
/**
 * Define constants of edit format
 */
define ( "EDIT_FORMAT_NONE", "" );
define ( "EDIT_FORMAT_TEXT_FIELD", "Text field" );
define ( "EDIT_FORMAT_TEXT_AREA", "Text area" );
define ( "EDIT_FORMAT_PASSWORD", "Password" );
define ( "EDIT_FORMAT_DATE", "Date" );
define ( "EDIT_FORMAT_TIME", "Time" );
define ( "EDIT_FORMAT_RADIO", "Radio button" );
define ( "EDIT_FORMAT_CHECKBOX", "Checkbox" );
define ( "EDIT_FORMAT_DATABASE_IMAGE", "Database image" );
define ( "EDIT_FORMAT_DATABASE_FILE", "Database file" );
define ( "EDIT_FORMAT_FILE", "Document upload" );
define ( "EDIT_FORMAT_LOOKUP_WIZARD", "Lookup wizard" );
define ( "EDIT_FORMAT_HIDDEN", "Hidden field" );
define ( "EDIT_FORMAT_READONLY", "Readonly" );

define ( "EDIT_DATE_SIMPLE", 0 );
define ( "EDIT_DATE_SIMPLE_INLINE", 2 );
define ( "EDIT_DATE_SIMPLE_DP", 11 );
define ( "EDIT_DATE_DD", 12 );
define ( "EDIT_DATE_DD_INLINE", 5 );
define ( "EDIT_DATE_DD_DP", 13 );

define ( "MODE_ADD", 0 );
define ( "MODE_EDIT", 1 );
define ( "MODE_SEARCH", 2 );
define ( "MODE_LIST", 3 );
define ( "MODE_PRINT", 4 );
define ( "MODE_VIEW", 5 );
define ( "MODE_INLINE_ADD", 6 );
define ( "MODE_INLINE_EDIT", 7 );
define ( "MODE_EXPORT", 8 );

define ( "LOGIN_HARDCODED", 0 );
define ( "LOGIN_TABLE", 1 );

define ( "SECURITY_NONE", - 1 );
define ( "SECURITY_HARDCODED", 0 );
define ( "SECURITY_TABLE", 1 );
define ( "SECURITY_AD", 2 );

define ( "ADVSECURITY_ALL", 0 );
define ( "ADVSECURITY_VIEW_OWN", 1 );
define ( "ADVSECURITY_EDIT_OWN", 2 );
define ( "ADVSECURITY_NONE", 3 );

define ( "ACCESS_LEVEL_ADMIN", "Admin" );
define ( "ACCESS_LEVEL_ADMINGROUP", "AdminGroup" );
define ( "ACCESS_LEVEL_USER", "User" );
define ( "ACCESS_LEVEL_GUEST", "Guest" );

define ( "nDATABASE_MySQL", 0 );
define ( "nDATABASE_Oracle", 1 );
define ( "nDATABASE_MSSQLServer", 2 );
define ( "nDATABASE_Access", 3 );
define ( "nDATABASE_PostgreSQL", 4 );
define ( "nDATABASE_Informix", 5 );
define ( "nDATABASE_SQLite3", 6 );
define ( "nDATABASE_DB2", 7 );
define ( "nDATABASE_Interbase", 16 );

define ( "ADD_SIMPLE", 0 );
define ( "ADD_INLINE", 1 );
define ( "ADD_ONTHEFLY", 2 );
define ( "ADD_MASTER", 3 );
define ( "ADD_POPUP", 4 );
define ( "ADD_DASHBOARD", 5 );
define ( "ADD_MASTER_POPUP", 6 );

// Edit page modes
define ( "EDIT_SIMPLE", 0 ); // standalone Edit page
define ( "EDIT_INLINE", 1 ); // inlineEdit
define ( "EDIT_POPUP", 3 ); // edit page in popup
define ( "EDIT_DASHBOARD", 4 ); // edit page in dashboard
                            
// View page modes
define ( "VIEW_SIMPLE", 0 ); // standalone View page
define ( "VIEW_POPUP", 1 ); // View page in popup
define ( "VIEW_DASHBOARD", 2 ); // View page in dashboard

define ( "titTABLE", 0 );
define ( "titVIEW", 1 );
define ( "titREPORT", 2 );
define ( "titCHART", 3 );
define ( "titDASHBOARD", 4 );

define ( "TAB_TYPE_TAB", 0 );
define ( "TAB_TYPE_SECTION", 1 );
define ( "TAB_TYPE_STEP", 2 );

// for report lib
define ( "REPORT_STEPPED", 0 );
define ( "REPORT_BLOCK", 1 );
define ( "REPORT_OUTLINE", 2 );
define ( "REPORT_ALIGN", 3 );
define ( "REPORT_TABULAR", 6 );

define ( "TOTAL_NONE", - 1 );
define ( "TOTAL_MAX", 0 );
define ( "TOTAL_AVG", 1 );
define ( "TOTAL_SUM", 3 );
define ( "TOTAL_MIN", 4 );

define ( "LIST_SIMPLE", 0 );
define ( "LIST_LOOKUP", 1 );
define ( "LIST_DETAILS", 3 );
define ( "LIST_AJAX", 4 );
define ( "RIGHTS_PAGE", 5 );
define ( "MEMBERS_PAGE", 6 );
define ( "LIST_DASHBOARD", 7 );
define ( "LIST_DASHDETAILS", 8 );
define ( "MAP_DASHBOARD", 9 );
define ( "LIST_MASTER", 10 );

define ( "REPORT_SIMPLE", 0 );
define ( "REPORT_POPUPDETAILS", 1 );
define ( "REPORT_DASHBOARD", 2 );
define ( "REPORT_DETAILS", 3 );
define ( "REPORT_DASHDETAILS", 4 );

define ( "CHART_SIMPLE", 0 );
define ( "CHART_POPUPDETAILS", 1 );
define ( "CHART_DASHBOARD", 2 );
define ( "CHART_DETAILS", 3 );
define ( "CHART_DASHDETAILS", 4 );

define ( "DP_POPUP", 0 );
define ( "DP_INLINE", 1 );
define ( "DP_NONE", 2 );

define ( "DL_SINGLE", 0 );
define ( "DL_INDIVIDUAL", 1 );
define ( "DL_NONE", 2 );

define ( "SEARCH_SIMPLE", 0 );
define ( "SEARCH_LOAD_CONTROL", 1 );
define ( "SEARCH_DASHBOARD", 2 );

define ( "LCT_DROPDOWN", 0 );
define ( "LCT_AJAX", 1 );
define ( "LCT_LIST", 2 );
define ( "LCT_CBLIST", 3 );
define ( "LCT_RADIO", 4 );

define ( "LT_LISTOFVALUES", 0 );
// lookup table is not added to the project
define ( "LT_LOOKUPTABLE", 1 );
define ( "LT_QUERY", 2 );

define ( "ENCRYPTION_NONE", 0 );
define ( "ENCRYPTION_DB", 1 );
define ( "ENCRYPTION_PHP", 2 );

define ( "SETTING_TYPE_GLOBAL", "global" );
define ( "SETTING_TYPE_VIEW", "view" );
define ( "SETTING_TYPE_EDIT", "edit" );

define ( 'otNone', 0 );
define ( 'otUseMobile', 1 );
define ( 'otUseDesktop', 2 );

define ( "CONTAINS", "Contains" );
define ( "EQUALS", "Equals" );
define ( "STARTS_WITH", "Starts with" );
define ( "MORE_THAN", "More than" );
define ( "LESS_THAN", "Less than" );
define ( "BETWEEN", "Between" );
define ( "EMPTY_SEARCH", "Empty" );
define ( "NOT_CONTAINS", "NOT Contains" );
define ( "NOT_EQUALS", "NOT Equals" );
define ( "NOT_STARTS_WITH", "NOT Starts with" );
define ( "NOT_MORE_THAN", "NOT More than" );
define ( "NOT_LESS_THAN", "NOT Less than" );
define ( "NOT_BETWEEN", "NOT Between" );
define ( "NOT_EMPTY", "NOT Empty" );

define ( "SEARCHID_SIMPLE", 1 );
define ( "SEARCHID_PANEL", 10 );
define ( "SEARCHID_ALL", 10000 );

/* Define constants for the filters settings */
// fiter totals
define ( "FT_NONE", 0 );
define ( "FT_COUNT", 1 );
define ( "FT_MIN", 2 );
define ( "FT_MAX", 3 );
// filter multiselect
define ( "FM_NONE", 0 );
define ( "FM_ON_DEMAND", 1 );
define ( "FM_ALWAYS", 2 );
// filter format
define ( "FF_VALUE_LIST", "Values list" );
define ( "FF_BOOLEAN", "Options list" );
define ( "FF_INTERVAL_LIST", "Interval list" );
define ( "FF_INTERVAL_SLIDER", "Interval slider" );
// define filter interval limits' constants
define ( "FIL_NONE", 0 );
define ( "FIL_MORE_THAN", 1 );
define ( "FIL_LESS_THAN", 1 );
define ( "FIL_LESS_THAN_OR_EQUAL", 2 );
define ( "FIL_MORE_THAN_OR_EQUAL", 2 );
define ( "FIL_REMAINDER", 3 );
// define slider filter constants
define ( "FS_BOTH", 0 );
define ( "FS_MIN_ONLY", 1 );
define ( "FS_MAX_ONLY", 2 );
// define slider step types
define ( "FSST_SECONDS", 0 );
define ( "FSST_MINUTES", 1 );
define ( "FSST_HOURS", 2 );
define ( "FSST_DAYS", 3 );
define ( "FSST_MONTHS", 4 );
define ( "FSST_YEARS", 5 );
// sorting constants
define ( 'SORT_BY_DISP_VALUE', 0 );
define ( 'SORT_BY_DB_VALUE', 1 );
define ( 'SORT_BY_GR_VALUE', 2 );
/* */

define ( "gltHORIZONTAL", 0 );
define ( "gltVERTICAL", 1 );
define ( "gltCOLUMNS", 2 );

/* Define comstamts for hidden columns devices */
define ( "DESKTOP", 1 );
define ( "TABLET_10_IN", 2 );
define ( "TABLET_7_IN", 3 );
define ( "SMARTPHONE_LANDSCAPE", 4 );
define ( "SMARTPHONE_PORTRAIT", 5 );
/* */

/* Dashboard types */
define ( "DASHBOARD_LIST", 0 );
define ( "DASHBOARD_CHART", 1 );
define ( "DASHBOARD_REPORT", 2 );
define ( "DASHBOARD_RECORD", 3 );
define ( "DASHBOARD_SEARCH", 4 );
define ( "DASHBOARD_DETAILS", 5 );
define ( "DASHBOARD_MAP", 6 );
/* */

/* Define message type constants */
define ( "MESSAGE_INFO", 1 );
define ( "MESSAGE_ERROR", 2 );

/* Define print page and pdf page constants */
define ( "PRINT_PAGE_WIDTH", 700 );
define ( "PRINT_PAGE_HEIGHT", 900 );
define ( "PDF_PAGE_WIDTH", 750 );
define ( "PDF_PAGE_HEIGHT", 1060 );

/* Defined maps type */
define ( "GOOGLE_MAPS", 0 );
define ( "OPEN_STREET_MAPS", 1 );
define ( "BING_MAPS", 2 );

/* Defined captcha type */
define ( "FLASH_CAPTCHA", 0 );
define ( "RE_CAPTCHA", 1 );

/* Define 'after record added/edited actions' constants */
define ( "AA_TO_LIST", 0 );
define ( "AA_TO_ADD", 1 );
define ( "AA_TO_VIEW", 2 );
define ( "AA_TO_EDIT", 3 );
define ( "AA_TO_DETAIL_ADD", 4 );
define ( "AA_TO_DETAIL_LIST", 5 );

define ( "AE_TO_LIST", 0 );
define ( "AE_TO_EDIT", 1 );
define ( "AE_TO_VIEW", 2 );
define ( "AE_TO_NEXT_EDIT", 3 );
define ( "AE_TO_PREV_EDIT", 4 );
define ( "AE_TO_DETAIL_LIST", 5 );
/* */

$globalSettings = array ();
$globalSettings ["nLoginForm"] = 1;
if (isMobile ())
	$globalSettings ["nLoginForm"] = 0;

$globalSettings ["nLoginMethod"] = 1;

$globalSettings ["popupPagesLayoutNames"] = array ();
if (! isMobile ()) {
	
	;
	$globalSettings ["popupPagesLayoutNames"] ["login"] = "login2";
	
	;
	$globalSettings ["popupPagesLayoutNames"] ["register"] = "register2";
	
	;
	$globalSettings ["popupPagesLayoutNames"] ["remind"] = "remind2";
}

$globalSettings ["isDynamicPerm"] = true;

$globalSettings ["createLoginPage"] = true;
$globalSettings ["isUseEncryption"] = 1;
$globalSettings ["encryptionKey"] = "";

$globalSettings ["apiGoogleMapsCode"] = "";

$globalSettings ["useBuiltInMailer"] = false;

/**
 * If true then detail table name will be printed before detail table on the view page
 * 
 * @var {bool}
 */
$globalSettings ["printDetailTableName"] = true;

/**
 * Alias for custom expression in display field in ListPage_Lookup
 * 
 * @var {string}
 */
$globalSettings ["dispFieldAlias"] = "rrdf1";

/**
 * If true then search suggest result will be handled in Lookup control
 * 
 * @var {bool}
 */
$globalSettings ["handleSearchSuggestInLookup"] = true;

/**
 * Maximum size of search suggest result string
 * 
 * @var {int}
 */
$globalSettings ["suggestStringSize"] = 40;

/**
 * The number of seach suggests displayed
 */
$globalSettings ["searchSuggestsNumber"] = 10;

$globalSettings ["override"] = array ();

$globalSettings ["mapProvider"] = 0;

$globalSettings ["CaptchaSettings"] = array ();
$globalSettings ["CaptchaSettings"] ["type"] = 0;
$globalSettings ["CaptchaSettings"] ["siteKey"] = "";
$globalSettings ["CaptchaSettings"] ["secretKey"] = "";
$globalSettings ["CaptchaSettings"] ["captchaPassesCount"] = "5";

$globalSettings ["CaptchaSettings"] ["isEnabledOnLogin"] = false;
$globalSettings ["CaptchaSettings"] ["isEnabledOnRegister"] = false;
$globalSettings ["CaptchaSettings"] ["isEnabledOnRemind"] = false;

$wr_pagestylepath = "FusionAqua";
$wr_is_standalone = false;
$WRAdminPagePassword = "";

$cLoginTable = "users";
$cDisplayNameField = "FullName";
$cUserNameField = "UserName";
$cPasswordField = "Password";
$cUserGroupField = "UserName";
$cEmailField = "Email";

if ($cDisplayNameField == '') {
	$cDisplayNameField = $cUserNameField;
}

$cDisplayNameFieldType = 200;
$cUserNameFieldType = 200;
$cPasswordFieldType = 200;
$cEmailFieldType = 200;
$useFlashChartLibrary = true;

$cUserNameFieldType = 200;
$cPasswordFieldType = 200;
$cEmailFieldType = 200;

$gPermissionsRefreshTime = 0;
$gPermissionsRead = false;

$useAJAX = true;
$suggestAllContent = true;

$strLastSQL = "";
$showCustomMarkerOnPrint = false;

$mlang_messages = array ();
$mlang_charsets = array ();

$menuAssignments = array ();

$menuStyles = array ();

// table captions
$tableCaptions = array();
$tableCaptions["English"] = array();
$tableCaptions["English"]["customer_header"] = "Customer Profile";
$tableCaptions["English"]["customer_platform"] = "Customer Platform";
$tableCaptions["English"]["customer_stage"] = "Customer Stage";
$tableCaptions["English"]["customer_resource_allocation"] = "Customer Resource Allocation";
$tableCaptions["English"]["employee_auth"] = "Employee Auth";
$tableCaptions["English"]["employee_header"] = "Employee Profile";
$tableCaptions["English"]["lookup"] = "Lookup";
$tableCaptions["English"]["admin_rights"] = "Admin Rights";
$tableCaptions["English"]["users"] = "Users";
$tableCaptions["English"]["admin_members"] = "Admin Members";
$tableCaptions["English"]["admin_users"] = "Add/Edit users";
$tableCaptions["English"]["customerallocation"] = "Resource Allocation";
$tableCaptions["English"]["backup"] = "Backup";
$tableCaptions["English"]["database"] = "Database";
$tableCaptions["English"]["application"] = "Application";
$tableCaptions["English"]["stage"] = "Stage";
$tableCaptions["English"]["CUST_ALLOC"] = "CUST ALLOC";
$tableCaptions["English"]["calandar"] = "Calandar";
$tableCaptions["English"][""] = "";
$tableCaptions["English"][""] = "";
$tableCaptions["English"]["MRP_Dashboard"] = "MRP Dashboard";
$tableCaptions["English"]["allocation"] = "Allocation";
$tableCaptions["English"]["View"] = "View";
$tableCaptions["English"]["skillstable"] = "Skillstable";
$tableCaptions["English"]["employeeskills"] = "Employee Skills";
$tableCaptions["English"]["skilllevel"] = "Skilllevel";
$tableCaptions["English"]["category"] = "Category";
$tableCaptions["English"]["customer_Geotag"] = "Customer Geotag";
$tableCaptions["English"]["tbl_test_center"] = "Tbl Test Center";
$tableCaptions["English"]["tbl_director"] = "Tbl Director";
$tableCaptions["English"]["stage2"] = "Stage2";
$tableCaptions["English"]["tbl_categorytechnology"] = "Tbl Categorytechnology";
$tableCaptions["English"]["tbl_technologycustomer"] = "Tbl Technologycustomer";
$tableCaptions["English"]["customertechnology"] = "Customertechnology";
$tableCaptions["English"]["tbl_role"] = "Tbl Role";
$tableCaptions["English"]["sizecategory"] = "Sizecategory";
$tableCaptions["English"]["Workload"] = "Workload";
$tableCaptions["English"]["time"] = "Time";
$tableCaptions["English"]["tbl_sme"] = "Tbl Sme";
$tableCaptions["English"]["emptime"] = "Emptime";
$tableCaptions["English"]["timezone"] = "Timezone";
$tableCaptions["English"]["color"] = "Color";
$tableCaptions["English"]["customerallocation1"] = "Customerallocation1";
$tableCaptions["English"]["tbl_director1"] = "Tbl Director1";
$tableCaptions["English"]["size"] = "Size";
$tableCaptions["English"]["tbl_allocation_input"] = "Tbl Allocation Input";
$tableCaptions["English"]["Allocation_Dashboard_New"] = "Allocation Dashboard New";
$tableCaptions["English"]["tbl_resource_allocation"] = "Tbl Resource Allocation";
$tableCaptions[""] = array();
$tableCaptions[""][""] = "";
$tableCaptions[""]["customer_header"] = "Customer Profile";
$tableCaptions[""]["timezone"] = "Timezone";
$tableCaptions[""]["color"] = "Color";
$tableCaptions[""]["customertechnology"] = "Customertechnology";
$tableCaptions[""]["customerallocation"] = "Resource Allocation";
$tableCaptions[""]["employee_header"] = "Employee Profile";
$tableCaptions[""]["employeeskills"] = "Employee Skills";
$tableCaptions[""]["customerallocation1"] = "Customerallocation1";
$tableCaptions[""]["stage"] = "Stage";
$tableCaptions[""]["Workload"] = "Workload";
$tableCaptions[""]["emptime"] = "Emptime";
$tableCaptions[""]["tbl_director"] = "Tbl Director";
$tableCaptions[""]["tbl_director1"] = "Tbl Director1";
$tableCaptions[""]["skillstable"] = "Skillstable";
$tableCaptions[""]["customer_Geotag"] = "Customer Geotag";
$tableCaptions[""]["stage2"] = "Stage2";
$tableCaptions[""]["size"] = "Size";
$tableCaptions[""]["tbl_allocation_input"] = "Tbl Allocation Input";
$tableCaptions[""]["Allocation_Dashboard_New"] = "Allocation Dashboard New";
$tableCaptions[""]["tbl_resource_allocation"] = "Tbl Resource Allocation";


$globalEvents = new class_GlobalEvents;
$tableEvents = array();

include(getabspath('classes/security.php'));
include( getabspath("connections/dbfunctions_legacy.php") ); 
include( getabspath("connections/ConnectionManager.php") ); 
$cman = new ConnectionManager();

$mlang_defaultlang = getDefaultLanguage();



$page_titles[".global"] = array();
if(mlang_getcurrentlang()=="English")
{
}
if (mlang_getcurrentlang () == "") {
}

$globalSettings ["showDetailedError"] = true;

// default connection link #9875
$conn = $cman->getDefault ()->conn;

$logoutPerformed = false;
$scriptname = getFileNameFromURL ();
if (! isLogged () && $scriptname != "login.php" && $scriptname != "remind.php" && $scriptname != "register.php" && $scriptname != "checkduplicates.php") {
	Security::doGuestLogin ();
}

$isGroupSecurity = true;

$isUseRTEBasic = true;

$isUseRTECK = false;

$isUseRTEInnova = false;

$caseInsensitiveUsername = 0;

include (getabspath ( 'classes/projectsettings.php' ));
include_once (getabspath ( 'classes/runnerpage.php' ));
include_once (getabspath ( "classes/controls/ViewControl.php" ));

?>