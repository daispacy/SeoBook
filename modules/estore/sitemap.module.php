<?php
/*************************************************************************
Module sitemap
----------------------------------------------------------------
DeraMCS 3.0 Project
Company: Derasoft Co., Ltd                                                                   
Last updated:06/06/2012
Coder: Tran Thi My Xuyen
**************************************************************************/
#Sitemap Page
$templateFile = "sitemap.tpl.html";


include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles = new Articles($sId);

$listNew = $articles->getObjects(1,"status=1",array("date_created"=>"DESC"),100);
if($listNew)$template->assign('listItems',$listNew);

# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => $messages['sitemap'], '', 'current' => '1');
$template->assign('navigationItems',$navigationItems);

# Page title, keywords, description
$pageTitle = $messages['sitemap'];


?>