<?php
/*************************************************************************
Estore category module
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/19/2010
**************************************************************************/
$templateFile = 'productdetail_org.tpl.html';

$navigationItems[] = array('name' => "Trang chủ", 'url' => '/', 'current' => '0');

# Try to get category id & slug, then get the CategoryInfo object
$pId = $request->element('id');
$slug = $request->element('slug');

$catSlug = $request->element('catslug');
$page = $request->element('pg');
$template->assign('pId',$pId);
# Build filters
$condition = "`status` = '1'";		# Front-end, so only get active product
# Get the product info

$estore->setProperty('products_per_other','');
$productItem = $products->getObject($pId,'id',$condition);
if($productItem){
   
	if(!$slug || !$catSlug || in_array($catSlug,array('0','index',$productItem->getCatSlug())) && in_array($slug,array('0','index',$productItem->getSlug($lang)))) {	# Checking if slug is valid
	
        # Get category
		$cCategory = $productCategories->getObject($productItem->getCatId(), 'id', "`status` = '1'");
		$cId = $productItem->getCatId();
		$template->assign('idCate',$cId);
		
		# other products
			$productotherItems = $products->getObjects(1,"status=1 AND `cat_id` = '$cId' AND id <> $pId",array('created'=>'DESC'),$estore->getProperty('products_per_other'));
			$template->assign('otherProductItems',$productotherItems);
		# Get the parent category, if available
		
		if($cCategory) {
			$template->assign('cId',$cCategory->getParentIdActive());
			$template->assign('productCateInfo',$cCategory);
			$pCategory = $productCategories->getObject($cCategory->getParentId(), 'id', "`status` = '1'");
			if($pCategory) $navigationItems[] = array('name' => $pCategory->getName(), 'url' => $pCategory->getUrl($lang), 'current' => '0');
			$navigationItems[] = array('name' => $cCategory->getName(), 'url' => $cCategory->getUrl(), 'current' => '0');
			
		}
		# Assign to the template
		$template->assign('objectItem',$productItem);
				
		# Load all JS and CSS
		$template->assign('full_header',1);
		
		# In Crease Viewed
		$products->increaseViewed($productItem->getViewed()+1,$pId);
		
		# Page title, keywords, description
		$pageTitle = $productItem->getName();
		$pageKeywords = $productItem->getName().",".$productItem->getKeyword();
		$pageDescription = $productItem->getDescription();
		# Navigation
		$navigationItems[] = array('name' => $productItem->getName(), 'url' => '', 'current' => '1');
		
	}else{	# Product id is ok but the slug is not valid
		$productItem = '';
		$templateFile = '404.tpl.html';
        
	}
    $template->assign('navigationItems',$navigationItems);
}


$template->assign('menId',41);

?>