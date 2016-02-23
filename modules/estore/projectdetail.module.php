<?php
/*************************************************************************
Estore category module
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/19/2010
**************************************************************************/
$templateFile = 'projectdetail.tpl.html';

$navigationItems[] = array('name' => "Trang chủ", 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => "Danh sách dự án", 'url' => '/du-an/', 'current' => '0');

# Try to get category id & slug, then get the CategoryInfo object
$slug = $request->element('slug');


$template->assign('menId',44);
# Build filters

$condition = "`status` = '1'";		# Front-end, so only get active product
# Get the product info
include_once(ROOT_PATH.'classes/dao/projects.class.php');
$projects= new Projects($storeId);
$projectItem = $projects->getObjectFromSlug($slug);

if($projectItem){
		
		$id = $projectItem->getId();
		# other products
		$projectotherItems = $projects->getObjects(1,"status=1 AND  id <> $id",array('date_created'=>'DESC'),5);
		$template->assign('projectotherItems',$projectotherItems);
		
		
		
		# Assign to the template
		$template->assign('projectItem',$projectItem);
				
		
		
		# In Crease Viewed
		#$projects->increaseViewed($productItem->getViewed()+1,$pId);
		
		# Page title, keywords, description
		$pageTitle = $projectItem->getTitle();
		$pageKeywords = $projectItem->getKeywords();
		$pageDescription = $projectItem->getSapo();
		# Navigation
		$navigationItems[] = array('name' => $projectItem->getTitle(), 'url' => '', 'current' => '1');
		
	
}


$template->assign('navigationItems',$navigationItems);

?>