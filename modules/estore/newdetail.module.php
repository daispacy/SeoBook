<?php
/*************************************************************************
Module new detail
----------------------------------------------------------------
DeraMCS 3.0 Project
Company: Derasoft Co., Ltd                                                                   
Coder: Tran Thi My Xuyen
Email: info@derasoft.com
Last updated: 06/06/2012
**************************************************************************/
$templateFile = "newdetail.tpl.html";


include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles = new Articles($sId);
$navigationItems[] = array('name' => "Trang chủ", 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => "Tin tức", 'url' => '/tin-tuc/', 'current' => '0');
#article
$aId = $request->element('id'); 
$cateslug = $request->element('cateslug');
$slug = $request->element('slug');
$condition="`status`=1";
if ($aId){
	$objectItem = $articles->getObject($aId,'id',$condition); 
	if($objectItem){
		if((!$slug || in_array($slug,array('0','index',$objectItem->getSlug($lang)))) && ( !$cateslug || in_array($cateslug,array('0','index',$objectItem->getCatSlug($lang))))) {
			$template->assign('objectItem',$objectItem);
			$cateId = $objectItem->getCatId();
			## other article
			$articleotherItems = $articles->getObjects(1,"status=1 AND cat_id= '$cateId' AND id <> $aId",array('date_created'=>'DESC'),$estore->getProperty('articles_per_other'));
			$template->assign('otherItems',$articleotherItems);
			
			// Navigation
			$objectCate = $articleCategories->getObject($objectItem->getCatId(),'id');
			$template->assign('objectCate',$objectCate);
			if($objectCate) $navigationItems[] = array('name' => $objectCate->getName($lang), 'url' => $objectCate->getUrl($lang), 'current' => '0');
			$navigationItems[] = array('name' => $objectItem->getTitle($lang), '', 'current' => '1');
			# Page title, keywords, description
			$pageTitle = $objectItem->getTitle($lang);
			$pageKeywords = $objectItem->getKeyword($lang);
			$pageDescription = $objectItem->getSapo($lang);
		}
	}
}
// list new specials
#$listhightNews = $articles->getObjects(1,"`status` = 1 AND `home` = 1",array('date_created'=>'DESC'),5);
#$template->assign('listhightNews',$listhightNews);
// list new hot
#$listHotNew = $articles->getObjects(1,"`status` = 1",array('viewed'=>'DESC'),5);
#$template->assign('listHotNew',$listHotNew);
//Navigation
$template->assign('navigationItems',$navigationItems);
$template->assign('menId',42);

?>