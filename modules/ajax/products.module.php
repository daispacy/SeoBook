<?php
/*************************************************************************
Estore category module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                  
**************************************************************************/
$templateFile = 'ajax_products.tpl.html';
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');
$productCategories = new ProductCategories(1);
$products = new Products(1);

# Get keywords, sort key, sort direction, current page
$sort_key = $request->element('sk');
if(!$sort_key) $sort_key = 'price';
$sort_direction = $request->element('sd');
if(!$sort_direction) $sort_direction = 'asc';
$cId = $request->element('cId',0);
$page = $request->element('page');
$kw = $request->element('kw','');

$cat_id =$request->element('cat_id');

if(!$page) $page = 1;
# Build filters
$condition = "`status` = '1'";		# Front-end, so only get active products


if($cId){
   
# Product list		
$productCateInfo = $productCategories->getObject($cId);

if($productCateInfo){
    
	                       
		$allCid = $productCategories->getAllSubCategory($cId);
		if($allCid) $condition .= " and `cat_id` in ($allCid)";
		else $condition .= " AND `cat_id`='$cId'";
		
		    
		$sort = array($sort_key => $sort_direction);
		$ipp=$productCateInfo->getProperty('ipp');
		if(!$ipp) $ipp='15';

		# Get the product list
		$rowsPages = $products->getNumItems('id', $condition,$ipp);
		
	
		
		/// end page
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];

		
		$productItems = $products->getObjects($page,$condition,$sort,$ipp);
		if($productItems) $template->assign('productItems',$productItems);
		
		
		
		echo $page."|&".$template->fetch($templateFolder.$templateFile)."|&".$template->fetch($templateFolder."ajax_producttooltip.tpl.html");
				
	}
}
?>