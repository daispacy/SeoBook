<?php
/*************************************************************************
Customer clean trash module
----------------------------------------------------------------
Derasoft CMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 05/05/2012
Coder: Mai Minh
**************************************************************************/
$userInfo->checkPermission('customer','clean',0);
$templateFile = 'managecustomer.tpl.html';
include_once(ROOT_PATH.'classes/dao/customers.class.php');
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
$customers = new Customers($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_customer'] => '/'.ADMIN_SCRIPT.'?op=manage&act=customer',
				$amessages['list_item'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=customer';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',3);

# Get parameters
$items_per_page = $request->element('ipp')?$request->element('ipp'):DEFAULT_ADMIN_ROWS_PER_PAGE;
if($items_per_page) $template->assign('ipp',$items_per_page);
$page = $request->element('pg')?$request->element('pg'):1;
if($page) $template->assign('pg',$page);
$sort_key = $request->element('sk')?$request->element('sk'):'id';
if($sort_key) $template->assign('sk',$sort_key);
$sort_direction = $request->element('sd')?$request->element('sd'):'DESC';
if($sort_direction) $template->assign('sd',$sort_direction);
$do = $request->element('doo')?$request->element('doo'):'';
if($do) $template->assign('do',$do);
$kw = $request->element('kw')?$request->element('kw'):'';
if($kw) $template->assign('kw',$kw);

# Link
$link = '/'.ADMIN_SCRIPT."?op=manage&act=customer&mod=list&kw=$kw&lang=$lang&ipp=$items_per_page&sk=$sort_key&sd=$sort_direction&pg=$page";
$template->assign('link',$link);
?>