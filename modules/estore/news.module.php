<?php
/*************************************************************************
News module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd   
Coder: Tran Thi My Xuyen                               
Email: info@derasoft.com                                    
Last updated: 06/06/2012
**************************************************************************/
include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles = new Articles($storeId);

$templateFile = 'news.tpl.html';

# Generate the navigation bar
$navigationItems[] = array('name' => "Trang chủ", 'url' => '/', 'current' => '0');

#get the news list
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
$cId = $request->element('cId'); 
$slug = $request->element('slug'); 
$lang = $request->element('lang'); 

$articleCategories = new ArticleCategories($sId);
if($cId){

$cateObject = $articleCategories->getObject($cId,'id');
if($cateObject){
	if(!$slug || in_array($slug,array('0','index',$cateObject->getSlug($lang)))) {
		$cateId = $cateObject->getId();
		$template->assign('objectCate',$cateObject);
		# Get keywords, sort key, sort direction, current page
		$sort_key = $cateObject->getProperty('sort_type');
		if(!$sort_key) $sort_key = 'date_created';
		$sort_direction =$cateObject->getProperty('sort_dir');
		if(!$sort_direction) $sort_direction = 'desc';
		$page = $request->element('pg');
		if(!$page) $page = 1;
		
		# Build filters
		$condition = "`status` = '1'";		# Front-end, so only get active products
		if($cateId) $condition .= "and cat_id = '$cateId'";
		$sort = array($sort_key => $sort_direction);
		
		$article_per_page = $cateObject->getProperty('ipp');
		$rowsPages = $articles->getNumItems('id', $condition,$article_per_page);
		$template->assign('rowsPages',$rowsPages);
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
		$listNew = $articles->getObjects($page,$condition,$sort,$article_per_page);
		$template->assign('listItems',$listNew);
		
		/// start page 
		$end = $page * $article_per_page;
		if($end > $article_per_page) $start  = $end -  $article_per_page +1;
		else $start = 1;
		if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
		$template->assign('end',$end);
		$template->assign('start',$start);
		/// end page
		# Generate pager
		if(!$lang)	$lang=$_SESSION['lang'];
		$url = "/$lang/$slug-c$cId/page-%d.htm";
		$pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
		$template->assign('pager',$pager);
		$navigationItems[] = array('name' => $cateObject->getName($_SESSION['lang']), 'url' => $cateObject->getUrl($_SESSION['lang']), 'current' => '0'); // navigation
		
		# Page title, keywords, description
		$pageTitle = $cateObject->getName($_SESSION['lang']);
		$pageKeywords = $cateObject->getKeyword($_SESSION['lang']);
		$pageDescription = $cateObject->getSapo($_SESSION['lang']);
	}
}
}else{
	# Get keywords, sort key, sort direction, current page
		$sort_key = "";
		if(!$sort_key) $sort_key = 'date_created';
		$sort_direction ="";
		if(!$sort_direction) $sort_direction = 'desc';
		$page = $request->element('pg');
	
	# Build filters
		$condition = "`status` = '1'";		# Front-end, so only get active products
		#if($cateId) $condition .= "and cat_id = '$cateId'";
		$sort = array($sort_key => $sort_direction);
		
		$article_per_page = 20;
		$rowsPages = $articles->getNumItems('id', $condition,$article_per_page);
		$template->assign('rowsPages',$rowsPages);
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];
		$listNew = $articles->getObjects($page,$condition,$sort,$article_per_page);
		$template->assign('listItems',$listNew);
		
		/// start page 
		$end = $page * $article_per_page;
		if($end > $article_per_page) $start  = $end -  $article_per_page +1;
		else $start = 1;
		if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
		$template->assign('end',$end);
		$template->assign('start',$start);
		/// end page
		# Generate pager
		
		$url = "/$slug-n$cId/page-%d.htm";
		$pager = LinkPage($url,$rowsPages['pages'],$page,5,'/'.TEMPLATE_PATH.'/'.$userTemplate.'/images/');
		$template->assign('pager',$pager);
		$navigationItems[] = array('name' => "Tin tức", 'url' => '#', 'current' => '1'); // navigation
		
		# Page title, keywords, description
		$pageTitle = "Tin tức " . $page>1?$page:'';
		$pageKeywords = "Tin tức";
		$pageDescription = $estore->getDescription();

}
// list new specials
$listhightNews = $articles->getObjects(1,"`status` = 1 AND `home` = 1",array('date_created'=>'DESC'),5);
$template->assign('listhightNews',$listhightNews);
// list new hot
$listHotNew = $articles->getObjects(1,"`status` = 1",array('viewed'=>'DESC'),5);
$template->assign('listHotNew',$listHotNew);
// back end navigation
$template->assign('navigationItems',$navigationItems);
$template->assign('menId',42);
?>