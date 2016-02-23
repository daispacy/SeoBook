<?php
/*************************************************************************
Index page
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 30/05/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
#---111

error_reporting(9);
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', dirname(__FILE__).'/');
}


include_once(ROOT_PATH.'includes/constant.inc.php');

# Setting time zone
ini_set('date.timezone',TIME_ZONE);

# Initialize query count variable
$query_count = 0;

# Set the debug options
if(DEBUG1 && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {
	$debug_file = ROOT_PATH.'debug/'.DEBUG_IP.'.txt';
	file_put_contents($debug_file, "***** Start runtime: ".date("Y-m-d H:i:s")." *****\n", DEBUG_FILE_APPEND);
	$debugText = '';
	$time_start = microtime(true);
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
} else {
	error_reporting(0);
	ini_set('display_errors', FALSE);
	ini_set('display_startup_errors', FALSE);
}

  

# include

include_once(ROOT_PATH.'includes/config.inc.php');
include_once(ROOT_PATH.'classes/data/translator.class.php');
include_once(ROOT_PATH.'includes/functions.inc.php');
include_once(ROOT_PATH.'classes/database/mysql.class.php');
include_once(ROOT_PATH.'classes/template/smarty.class.php');
include_once(ROOT_PATH.'classes/http/request.class.php');
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/estores.class.php');
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/carts.class.php');
include_once(ROOT_PATH.'classes/dao/languages.class.php');
include_once(ROOT_PATH.'classes/dao/currencies.class.php');
include_once(ROOT_PATH.'classes/dao/addons.class.php');
#include_once(ROOT_PATH.'truycap.php');



# Setting time zone
if(function_exists('date_default_timezone_set')) date_default_timezone_set(TIME_ZONE);

# Database connection
$db = new DB();

# Template engine
$template_dir = array(ROOT_PATH.TEMPLATE_PATH.'/default/');
$template = new Smarty;
$template->compile_check = TEMPLATE_COMPILE;
$template->debugging = TEMPLATE_DEBUG;

# Initialize some variables
$sort_key = '';
$sort_direction = '';
$pageTitle = '';
$pageKeywords = '';
$pageDescription = '';
		
# E-store configuration
$templateFolder = 'standard/';
$userTemplate = 'standard';
$templateFile = 'index.tpl.html';

# HTTP Request manager
$request = new Request;
$op = $request->element('op'); 
$act = $request->element('act');
$slug = $request->element('slug');
# Bootstrap


$sId=1;


# Checking if this is an e-store.
if($sId) $op = 'estore';
if(!$op) $op = DEFAULT_OP;
if(!$act) $act = DEFAULT_ACT;

$addons = new Addons($sId);

# Put this code any where in the modules
#foreach($addons->getAddonFromEvent('ORDER_NEW') as $addon) {include_once(ROOT_PATH."addons/$addon/addon.php");}

# Session manager
include_once(ROOT_PATH.'includes/session.inc.php');


# Include action module
if (in_array($op,$ops)) include_once(ROOT_PATH.'modules/'.strtolower($op).'/main.module.php');
$full_header = 1;

# Some global variables
$template->assign('templatePath',TEMPLATE_PATH);
$template->assign('domain',DOMAIN);
$template->assign('url_link',"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."");
#$template->assign("count", $count);
$template->assign('op',$op);
$template->assign('act',$act);
$template->assign('slug',$slug);
if($sort_key) $template->assign('sk',$sort_key);
if($sort_direction) $template->assign('sd',$sort_direction);
$template->assign('pageTitle',$pageTitle);
$template->assign('pageKeywords',$pageKeywords);
$template->assign('pageDescription',$pageDescription);
$template->assign('full_header',$full_header);
if(isset($storeId)) $template->assign('storeId',$storeId);

# Display the web page
$template->template_dir = $template_dir;
$template->display($templateFile);

# User log
$userId = 0;
$usertype = 0;
$username = 'Guest';
if(isset($_SESSION['userId']) && $_SESSION['userId'] && $userInfo) {$userId = $_SESSION['userId']; $username = $userInfo->getUsername(); $usertype = $userInfo->getType();}
if(isset($_SESSION['store_customerId']) && $_SESSION['store_customerId'] && $customerInfo) {$userId = $_SESSION['store_customerId']; $usertype = 4; $username = $customerInfo->getUsername();}
if($act != "logout") userLog($storeId,$userId,$username,$usertype,$_SERVER['REQUEST_URI']);
increaseHit($storeId);

# Close database connection
$db->close();
if(DEBUG1 && $_SERVER['REMOTE_ADDR'] == DEBUG_IP) {	
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	if(!isset($plus))	$plus = '';
	$debugText .= "* op-act-plus-lang: $op-$act-$plus-$lang<br />\n";
	$debugText .= "* Templates: ".print_r($template_dir,true)."<br />\n";
	$debugText .= "* Template file: ".$templateFile."<br />\n";
	$debugText .= "* Session: ".print_r($_SESSION,true)."<br />\n";
	$debugText .= "* Last errors: ".print_r(error_get_last(),true)."<br />\n";
	$debugText .= "* Queries: ".$query_count.'-'.memory_get_usage()." <br />\n";
	$debugText .= "* Execute time: ".$time."s <br />\n";
	if(DEBUG_DISPLAY) echo $debugText;
	
	# Write to debug file
	file_put_contents($debug_file, $debugText, FILE_APPEND);		
	file_put_contents($debug_file, "***** End runtime *****\n\n", FILE_APPEND);
}

?>