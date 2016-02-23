<?php
/*************************************************************************
Admin index page
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 02/06/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
$time_start = microtime(true);
error_reporting(9);
if (!defined('ROOT_PATH')) {
	define('ROOT_PATH', dirname(__FILE__).'/');
}



include_once(ROOT_PATH.'includes/config.inc.php');
include_once(ROOT_PATH.'includes/constant.inc.php');
include_once(ROOT_PATH.'classes/data/translator.class.php');
include_once(ROOT_PATH.'includes/admin/functions.inc.php');
include_once(ROOT_PATH.'classes/database/mysql.class.php');
include_once(ROOT_PATH.'classes/template/smarty.class.php');
include_once(ROOT_PATH.'classes/http/request.class.php');
include_once(ROOT_PATH.'classes/http/url.class.php');
include_once(ROOT_PATH.'classes/dao/users.class.php');
include_once(ROOT_PATH.'classes/dao/estores.class.php');
include_once(ROOT_PATH.'classes/dao/trackings.class.php');
include_once(ROOT_PATH.'classes/dao/storeusers.class.php');
include_once(ROOT_PATH.'classes/dao/addons.class.php');


# Setting time zone
if(function_exists('date_default_timezone_set')) date_default_timezone_set(TIME_ZONE);

# Database connection
$db = new DB();

# Template engine
$template = new Smarty;
$template->compile_check = true;
$template->debugging = false;

# HTTP Request manager
$request = new Request;
$op = $request->element('op');
$act = $request->element('act');
$mod = $request->element('mod');
$site = $request->element('site');

# Template configuration
$templateFolder = 'admin/';
$userTemplate = 'admin';
$templateFile = 'index.tpl.html';
	
# Language manager
$lang = $request->element('lang');
if(!$lang) $lang = DEFAULT_ADMIN_LANGUAGE;
include_once(ROOT_PATH.'languages/admin/'.$lang.'.php');
$template->assign('amessages',$amessages);
$template->assign('lang',$lang);
# Translate messages
$translator = new Translator($amessages);
$template->assign('locale',$translator);


$sCode = "estore";
# Action check
if(!$op || !in_array($op,$aops)) $op = 'login';
if($op=='admin' && !$userInfo->isAdmin()) $op = DEFAULT_ADMIN_OP;

$addons = new Addons(1);
# Session manager
include_once(ROOT_PATH.'includes/admin/sessions.inc.php');

# Load module
include_once(ROOT_PATH.'modules/admin/'.$op.'.module.php');

# Global variable
$template->assign('aScript',ADMIN_SCRIPT);
$template->assign('domain',DOMAIN);

# Operations
if(isset($op)) $template->assign('op',$op);
if(isset($act)) $template->assign('act',$act);
if(isset($mod)) $template->assign('mod',$mod);
if(isset($storeId)) $template->assign('storeId',$storeId);

# Navigation bar
if(isset($topNav)) $template->assign('topNav',$topNav);

# Display the web page
$template->assign('templatePath',TEMPLATE_PATH);
$template->assign('userTemplate',$userTemplate);
$template->display($templateFolder.$templateFile);

# Close database connection
$db->close();

$time_end = microtime(true);
$time = $time_end - $time_start;
echo '<center>'.$time.'</center>';
?>