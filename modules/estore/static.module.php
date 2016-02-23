<?php
/*************************************************************************
Module static
----------------------------------------------------------------
DeraMCS 3.0 Project
Company: Derasoft Co., Ltd                                                                   
Last updated: 16/09/2011
Coder: Tran Thi My Xuyen
**************************************************************************/
#Static Page
include_once(ROOT_PATH.'classes/dao/static.class.php');
$templateFile = "static.tpl.html";
$statics = new StaticPage($sId);
# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName($lang), 'url' => '/', 'current' => '0');

#Get Static
$slug = $request->element('slug'); 
$template->assign('slug',$slug);
if ($slug){
	$aboutusItem = $statics->getObjectFromSlug($slug); 
	if($aboutusItem){
		$template->assign('aboutusItem',$aboutusItem);
		
		# Generate the navigation bar
		$navigationItems[] = array('name' => $aboutusItem->getTitle($lang), 'url'=>'', 'current' => '1');
		$template->assign('navigationItems',$navigationItems);
		
		# Page title, keywords, description
		$pageTitle = $aboutusItem->getTitle($lang);
		$pageKeywords = $aboutusItem->getKeywords($lang);
		$pageDescription = $aboutusItem->getSapo($lang);
	}
	// active menu
	//$mId = $menus->getIdFromSlug($slug);
	
}
?>