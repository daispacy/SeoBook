<?php
/*************************************************************************
Estore index module
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/19/2010
**************************************************************************/
$templateFile = 'interior.tpl.html';

# Get keywords, sort key, sort direction, current page
$sort_key = $request->element('sk');
if(!$sort_key) $sort_key = 'created';
$sort_direction = $request->element('sd');
if(!$sort_direction) $sort_direction = 'desc';
$page = $request->element('pg');
if(!$page) $page = 1;

# Build filters
$condition = "`status` = '1'";		# Front-end, so only get active products
$sort = array($sort_key => $sort_direction);

# Get the product list
$estore->setProperty('products_per_page', 12);
$rowsPages = $products->getNumItems('id', $condition,$estore->getProperty('products_per_page'));
$template->assign('rowsPages',$rowsPages);
/// start page 
$end = $page * $estore->getProperty('products_per_page');
if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
$start  = ($page * $estore->getProperty('products_per_page')) -  $estore->getProperty('products_per_page') +1;
$template->assign('end',$end);
$template->assign('start',$start);
/// end page
if($page < 1) $page = 1;
if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
$productItems = $products->getObjects($page,$condition,$sort,$estore->getProperty('products_per_page'));
if($productItems) $template->assign('productItems',$productItems);

# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => $messages['index'], 'url' => '', 'current' => '1');
$template->assign('navigationItems',$navigationItems);

# Generate pager
$url = "/page-%d.html";
#$pager = LinkPager($url,$rowsPages['pages'],$page,10,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
$pager = LinkPage($url,$rowsPages['pages'],$page,10,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
$template->assign('pager',$pager);
# news
include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles= new Articles($sId);
$estore->setProperty('news_index_item', 2);
$listNew = $articles->getObjects(1,"`status`=1 and `home`=1",array("date_created"=>"DESC"),$estore->getProperty('news_index_item'));
$template->assign('listItem',$listNew);
#include static item 
include_once(ROOT_PATH.'modules/estore/plugin/static.plugin.php');

$pageTitle = $messages['index'];
?>