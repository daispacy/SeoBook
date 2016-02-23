<?php
/*************************************************************************
Estore category module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                  
**************************************************************************/
$templateFile = 'projects.tpl.html';
include_once(ROOT_PATH.'classes/dao/projects.class.php');
$projects= new Projects($storeId);

# Get keywords, sort key, sort direction, current page
$sort_key = $request->element('sk');
if(!$sort_key) $sort_key = 'date_created';
$sort_direction = $request->element('sd');
if(!$sort_direction) $sort_direction = 'desc';
$slug = $request->element('slug');
$page = $request->element('pg');
$kw = $request->element('kw','');


if(!$page) $page = 1;
# Build filters
$condition = "`status` = '1'";		# Front-end, so only get active products
# Generate the navigation bar
$navigationItems[] = array('name' => "Trang chủ", 'url' => '/', 'current' => '0');

	
if($kw)$condition .= " AND `title` like '%$kw%'";

$template->assign('kw',$kw);

$sort = array($sort_key => $sort_direction);
$ipp="";
if(!$ipp) $ipp='';


# Get the product list
$rowsPages = $projects->getNumItems('id', $condition,$ipp);
$template->assign('rowsPages',$rowsPages);
/// start page 
$end = $page * $ipp;
if($end > $estore->getProperty('items_per_page')) $start  = $end -  $ipp +1;
else $start = 1;
if($end > $rowsPages['rows']) $end = $rowsPages['rows'];

/// end page
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];


$productItems = $projects->getObjects($page,$condition,$sort,$ipp);
if($productItems) $template->assign('projects',$productItems);



$navigationItems[] = array('name' => "Danh sách dự án", 'url' => "#", 'current' => '1');
# Page title, keywords, description
$pageTitle = "Danh sách dự án";
$pageKeywords = "Danh sách dự án";
$pageDescription = "Danh sách dự án";

$template->assign('navigationItems',$navigationItems);


$template->assign('menId',44);
?>