<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
require_once("include/dbcommon.php");
require_once('include/xtempl.php');

add_nocache_headers();

require_once("include/customerallocation_Report_variables.php");

if( !Security::processPageSecurity( $strTableName, 'S' ) )
	return;

require_once('classes/reportpage.php');
require_once('classes/searchclause.php');




$layout = new TLayout("report5", "FusionAqua", "MobileAqua");
$layout->version = 2;
$layout->blocks["center"] = array();
$layout->containers["message"] = array();
$layout->container_properties["message"] = array(  );
$layout->containers["message"][] = array("name"=>"message", 
	"block"=>"message_block", "substyle"=>1  );

$layout->skins["message"] = "2";

$layout->blocks["center"][] = "message";
$layout->containers["grid"] = array();
$layout->container_properties["grid"] = array(  );
$layout->containers["grid"][] = array("name"=>"report", 
	"block"=>"", "substyle"=>1  );

$layout->skins["grid"] = "grid";

$layout->blocks["center"][] = "grid";
$layout->containers["pagination"] = array();
$layout->container_properties["pagination"] = array(  );
$layout->containers["pagination"][] = array("name"=>"pagination", 
	"block"=>"pagination_block", "substyle"=>1  );

$layout->skins["pagination"] = "2";

$layout->blocks["center"][] = "pagination";
$layout->blocks["left"] = array();
$layout->containers["left"] = array();
$layout->container_properties["left"] = array(  );
$layout->containers["left"][] = array("name"=>"searchpanel", 
	"block"=>"searchPanel", "substyle"=>1  );

$layout->skins["left"] = "1";

$layout->blocks["left"][] = "left";
$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";

$layout->blocks["top"][] = "master";
$layout->containers["toplinks"] = array();
$layout->container_properties["toplinks"] = array(  );
$layout->containers["toplinks"][] = array("name"=>"loggedas", 
	"block"=>"security_block", "substyle"=>1  );

$layout->containers["toplinks"][] = array("name"=>"toplinks_advsearch", 
	"block"=>"asearch_link", "substyle"=>1  );

$layout->containers["toplinks"][] = array("name"=>"toplinks_export_links", 
	"block"=>"export_link", "substyle"=>1  );

$layout->containers["toplinks"][] = array("name"=>"printpanel", 
	"block"=>"", "substyle"=>1  );

$layout->skins["toplinks"] = "2";

$layout->blocks["top"][] = "toplinks";
$layout->containers["hmenu"] = array();
$layout->container_properties["hmenu"] = array(  );
$layout->containers["hmenu"][] = array("name"=>"hmenu", 
	"block"=>"menu_block", "substyle"=>1  );

$layout->skins["hmenu"] = "hmenu";

$layout->blocks["top"][] = "hmenu";
$layout->containers["search"] = array();
$layout->container_properties["search"] = array(  );
$layout->containers["search"][] = array("name"=>"search", 
	"block"=>"searchform_block", "substyle"=>1  );

$layout->containers["search"][] = array("name"=>"search_buttons", 
	"block"=>"searchformbuttons_block", "substyle"=>1  );

$layout->containers["search"][] = array("name"=>"search_saving_buttons", 
	"block"=>"searchsaving_block", "substyle"=>1  );

$layout->containers["search"][] = array("name"=>"details_found", 
	"block"=>"details_block", "substyle"=>1  );

$layout->containers["search"][] = array("name"=>"page_of", 
	"block"=>"pages_block", "substyle"=>1  );

$layout->containers["search"][] = array("name"=>"recsperpage", 
	"block"=>"recordspp_block", "substyle"=>1  );

$layout->skins["search"] = "1";

$layout->blocks["top"][] = "search";
$page_layouts["customerallocation_Report_report"] = $layout;

$layout->skinsparams = array();
$layout->skinsparams["empty"] = array("button"=>"button2");
$layout->skinsparams["menu"] = array("button"=>"button1");
$layout->skinsparams["hmenu"] = array("button"=>"button1");
$layout->skinsparams["undermenu"] = array("button"=>"button1");
$layout->skinsparams["fields"] = array("button"=>"button1");
$layout->skinsparams["form"] = array("button"=>"button1");
$layout->skinsparams["1"] = array("button"=>"button1");
$layout->skinsparams["2"] = array("button"=>"button1");
$layout->skinsparams["3"] = array("button"=>"button1");


// add master layouts 

$mode = postvalue("mode");
if( $mode == "listdetails" )
	$pageMode = REPORT_DETAILS; 
else if( $mode == "listdetailspopup" )
	$pageMode = REPORT_POPUPDETAILS;
else if( $mode == "dashreport" )
	$pageMode = REPORT_DASHBOARD;
else if ( $mode == "dashdetails" )
	$pageMode = REPORT_DASHDETAILS;	
else 
	$pageMode = REPORT_SIMPLE;

$xt = new Xtempl( $pageMode != REPORT_SIMPLE ); //#9607 1. Temporary fix

$id = postvalue("id");
$id = $id ? $id : 1;

//array of params for ReportPage constructor
$params = array();
$params["id"] = $id;
$params["xt"] = &$xt;
$params["mode"] = $pageMode;
$params["tName"] = $strTableName;
$params["pageType"] = PAGE_REPORT;
$params["isGroupSecurity"] = $isGroupSecurity;
$params["arrRecsPerPage"] = $gSettings->getRecordsPerPageArray();
$params["arrGroupsPerPage"] = $gSettings->getGroupsPerPageArray();
$params["masterTable"] = postvalue("mastertable");
$params["mainMasterPageType"] = postvalue("mainmasterpagetype");

if( postvalue("crosstable_refresh") )
	$params["crosstableRefresh"] = true;

if( isset($_REQUEST["masterKeys"]) ) 
	$masterKeys = my_json_decode($_REQUEST["masterKeys"]);
		
$i = 0;
$params["masterKeysReq"] = array();
while (true)
{
	$i++;
	if (isset($_REQUEST["masterkey".$i]))
		$_masterKey = $_REQUEST["masterkey".$i];
	elseif (isset($masterKeys["masterkey".$i]))
		$_masterKey = $masterKeys["masterkey".$i];
	else
		break;
	$params["masterKeysReq"][$i] = $_masterKey;
}

if( $pageMode = REPORT_DASHBOARD )
{
	$params["dashElementName"] = postvalue("dashelement");
	$params["dashTName"] = postvalue("table");
}

$pageObject = new ReportPage($params);
$pageObject->init();


// Save search
if( postvalue("saveSearch") && postvalue("searchName") && !is_null($pageObject->searchLogger) ) 
{
	$searchName = postvalue("searchName");
	$searchParams = $pageObject->getSearchParamsForSaving();
	$pageObject->searchLogger->saveSearch( $searchName, $searchParams );
	
	$pageObject->searchClauseObj->savedSearchIsRun = true;
	$_SESSION[$pageObject->sessionPrefix.'_advsearch'] = serialize( $pageObject->searchClauseObj );
	
	echo my_json_encode( $searchParams );
	exit();
}
// Delete the saved search
if( postvalue("deleteSearch") && postvalue("searchName") && !is_null($pageObject->searchLogger) ) 
{
	$searchName = postvalue("searchName");
	$pageObject->searchLogger->deleteSearch( $searchName );
	exit();
}

$pageObject->process();

?>