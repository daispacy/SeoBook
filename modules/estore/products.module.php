<?php
/*************************************************************************
Estore category module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                  
**************************************************************************/
$templateFile = 'products.tpl.html';


# Get keywords, sort key, sort direction, current page
$sort_key = $request->element('sk');
if(!$sort_key) $sort_key = 'price';
$sort_direction = $request->element('sd');
if(!$sort_direction) $sort_direction = 'asc';
$cId = $request->element('cid',0);
$template->assign('cid',$cId);
$slug = $request->element('slug');
$page = $request->element('pg');
$kw = $request->element('kw','');

$cat_id =$request->element('cat_id');

if(!$page) $page = 1;
# Build filters
$condition = "`status` = '1'";		# Front-end, so only get active products
# Generate the navigation bar
$navigationItems[] = array('name' => "Trang chủ", 'url' => '/', 'current' => '0');


if($cId){
# Product list		
$productCateInfo = $productCategories->getObject($cId);

if($productCateInfo){
    
	if(!$slug || in_array($slug,array('0','index',$productCateInfo->getSlug($lang)))) {                       
		$allCid = $productCategories->getAllSubCategory($cId);
		if($allCid) $condition .= " and `cat_id` in ($allCid)";
		else $condition .= " AND `cat_id`='$cId'";
		
		$template->assign('cId',$productCateInfo->getParentIdActive());
		$template->assign('cCategory',$productCateInfo);         
		$sort = array($sort_key => $sort_direction);
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
		
		$url = "/$slug-c$cId/page-%d.html";
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
		$navigationItems[] = array('name' => $productCateInfo->getName(), 'url' => $productCateInfo->getUrl(), 'current' => '1');
		# Page title, keywords, description
		$pageTitle = $productCateInfo->getName();
		$pageKeywords = $productCateInfo->getKeyword();
		$pageDescription = $productCateInfo->getSapo();
	}else $navigationItems[] = array('name' => $messages['products'], 'url' => Url::genUrl('products',''), 'current' => '1');
	}else $navigationItems[] = array('name' => $messages['products'], 'url' => Url::genUrl('products',''), 'current' => '1');
}else{
	
	if($kw)$condition .= " AND `name` like '%$kw%'";
	if($priceto>$pricefrom) $condition .= " AND  (price >= $pricefrom AND price<=$priceto)";
	if($market_price) $condition .= " AND `market_price` > 0";
	if($cat_id) $condition .= " AND `cat_id` = '$cat_id'";

	$template->assign('kw',$kw);
	$template->assign('priceto',$priceto);
	$template->assign('pricefrom',$pricefrom);
	$template->assign('market_price',$market_price);
	$template->assign('cat_id',$cat_id);

	$sort = array($sort_key => $sort_direction);
		$ipp="";
		if(!$ipp) $ipp='9';
		
		
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
		
		$navigationItems[] = array('name' => "Danh sách sản phẩm", 'url' => "#", 'current' => '0');
		# Page title, keywords, description
		$pageTitle = $messages['list_product'];
		$pageKeywords = $messages['list_product'];
		$pageDescription = $messages['list_product'];
}



/*# Page title, keywords, description
$pageTitle = $productCateInfo->getName($lang);
$pageKeywords = $productCateInfo->getKeyword($lang);
$pageDescription = $productCateInfo->getSapo($lang);*/

$template->assign('navigationItems',$navigationItems);
$template->assign('idCate',$cId);
$template->assign('menId',41);
?>