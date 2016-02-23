<?php
/*************************************************************************
Module search 
----------------------------------------------------------------
DerCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Coder: Tran Thi My Xuyen
Email: info@derasoft.com                                    
Last updated: 06/07/2012
**************************************************************************/
$templateFile = 'products.tpl.html';



# Get keywords, sort key, sort direction, current page
$cId = $request->element('cId');
$keywords = $request->element('kw','');
$sort_key = $request->element('sk');
if(!$sort_key) $sort_key = 'price';
$sort_direction = $request->element('sd');
if(!$sort_direction) $sort_direction = 'asc';
$page = $request->element('pg');



# Build filters
$condition = "`status` = '1'";		# Front-end, so only get active products
$condition .= $keywords?" AND (`slug` LIKE '%$keywords%' OR `keyword` LIKE '%$keywords%' OR `description` LIKE '%$keywords%' OR `name` LIKE '%$keywords%' OR `en_name` LIKE '%$keywords%' OR `en_keyword` LIKE '%$keywords%')":'';
$condition .= $alpha?" AND `name` LIKE '$alpha%' OR `en_name` LIKE '$alpha%'":'';
if($cId){

# Product list		
$productCateInfo = $productCategories->getObject($cId);
if($productCateInfo){
	
        $slug=$productCateInfo->getSlug($lang);
       
        
		$allCid = $productCategories->getAllSubCategory($cId);
		if($allCid) $condition .= " and `cat_id` in ($allCid)";
		else $condition .= " AND `cat_id`='$cId'";
		
		$template->assign('cId',$productCateInfo->getParentIdActive());
		$template->assign('cCategory',$productCateInfo);         
		$sort = array("special"=>"DESC","home"=>"DESC","seller"=>"DESC","price"=>"ASC");
		$ipp=$productCateInfo->getProperty('ipp');
		if(!$ipp) $ipp='15';

		# Get the product list
		$rowsPages = $products->getNumItems('id', $condition,$ipp);
		$template->assign('rowsPages',$rowsPages);
		/// start page 
		$end = $page * $ipp;
		if($end > $estore->getProperty('items_per_page')) $start  = $end -  $ipp +1;
		else $start = 1;
		if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
		$template->assign('end',$end);
		$template->assign('start',$start);
		/// end page
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];

		
		$productItems = $products->getObjects($page,$condition,$sort,$ipp);
		if($productItems) $template->assign('productItems',$productItems);
		
		# Generate pager
		if($lang!='en') $url = "/$slug-c$cId/page-%d.html";
		else $url = "/$lang/$slug-c$cId/page-%d.html";
		$pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
		
		$template->assign('pager',$pager);
		# Navigation
		$pCategory = $productCategories->getObject($productCateInfo->getParentId(), 'id', "`status` = '1'");
		if($pCategory){
		  if($pCategory->getParentId()){
		      $pCategorys = $productCategories->getObject($pCategory->getParentId(), 'id', "`status` = '1'");
			  if($pCategorys){
				 $navigationItems[] = array('name' => $pCategorys->getName(), 'url' => $pCategorys->getUrl(), 'current' => '0');
		       
			  }
		  }
		  $navigationItems[] = array('name' => $pCategory->getName(), 'url' => $pCategory->getUrl(), 'current' => '0');
		}
		$navigationItems[] = array('name' => $productCateInfo->getName(), 'url' => $productCateInfo->getUrl(), 'current' => '0');
		# Page title, keywords, description
		$pageTitle = $productCateInfo->getName($lang);
		$pageKeywords = $productCateInfo->getKeyword($lang);
		$pageDescription = $productCateInfo->getSapo($lang);
	} 
}else{
	
	$sort = array("special"=>"DESC","home"=>"DESC","seller"=>"DESC","price"=>"ASC");
		$ipp="";
		if(!$ipp) $ipp='15';
		
		
		# Get the product list
		$rowsPages = $products->getNumItems('id', $condition,$ipp);
		$template->assign('rowsPages',$rowsPages);
		/// start page 
		$end = $page * $ipp;
		if($end > $estore->getProperty('items_per_page')) $start  = $end -  $ipp +1;
		else $start = 1;
		if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
		$template->assign('end',$end);
		$template->assign('start',$start);
		/// end page
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];

		
		$productItems = $products->getObjects($page,$condition,$sort,$ipp);
		if($productItems) $template->assign('productItems',$productItems);
		
		# Generate pager
		if($lang!='en') $url = "/$slug-c$cId/page-%d.html";
		else $url = "/$lang/$slug-c$cId/page-%d.html";
		$pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
		
		$template->assign('pager',$pager);
		
		$navigationItems[] = array('name' => $messages['list_product'], 'url' => "#", 'current' => '0');
	
}
$template->assign('kw',$keywords);
$template->assign('cId',$cId);
# Page title, keywords, description
$pageTitle = $messages['products'];
$pageKeywords = $estore->getKeywords();
$pageDescription = $estore->getDescription();
$template->assign('menId',41);
?>