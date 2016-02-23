<?php
header('Content-Type: text/plain');
/*************************************************************************
Ajax processing
----------------------------------------------------------------
Vnnavi 2008 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 15/07/2008
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
error_reporting(0);
if (!defined( "ROOT_PATH" )) {
	define("ROOT_PATH", dirname(__FILE__)."/");
}
include_once(ROOT_PATH.'includes/constant.inc.php');
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
# Database connection
$db = new DB();

# Template engine
$template_dir = array(ROOT_PATH.TEMPLATE_PATH.'/default/');
$template = new Smarty();
$template->compile_check = TEMPLATE_COMPILE;
$template->debugging = TEMPLATE_DEBUG;

$templateFolder = 'organicshop/';
$userTemplate = 'standard';
$templateFile = 'index.tpl.html';

# HTTP Request manager
$request = new Request();
$op = $request->element("op");

$sId=1;
	
# Language manager
$lang = $request->element("lang");
if(!$lang) $lang = DEFAULT_LANGUAGE;
include_once(ROOT_PATH."languages/".$lang.".php");

# Session manager
include_once(ROOT_PATH.'includes/session.inc.php');
# Action check
if(!$op) die("Error!");
include_once(ROOT_PATH."modules/ajax/".strtolower($op).".module.php");



# Close database connection
$db->close();
?>