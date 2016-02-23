<?php
/*************************************************************************
Estore main module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 27/04/2012
Coder: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
include_once(ROOT_PATH.'classes/dao/templates.class.php');
$estores = new EStores();
$templates = new Templates();
$cId = 0;
$cCategory = '';
$pCategory = '';

include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
include_once(ROOT_PATH.'classes/dao/articlecategories.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');

# Checking if this estore is enable
if($estore->getStatus() == S_EXPIRED) $act = 'suspended';
elseif($estore->getStatus() != S_ENABLED) $act = 'disabled';

#Get user template
$templateId = $estore->getProperty('domain_template_id');
$userTemplate = $templates->getTemplateFolderFromId($templateId);
if(isset($_SESSION['template']))
$userTemplate=$_SESSION['template'];
if($request->element('template'))
$_SESSION['template']=$request->element('template');
if(!$userTemplate) $userTemplate = STANDARD_TEMPLATE;
//$userTemplate = 'tiffanyhotel';
# Add the template path of this estore to the template paths array
$template_dir[] = ROOT_PATH.TEMPLATE_PATH.'/'.$userTemplate.'/';

// Change by XuyenTran
#Allow order
$orderOn = $estore->getProperty('order_on');
$template->assign('orderOn',$orderOn);



# Get the list Menus 
include_once(ROOT_PATH.'classes/dao/menus.class.php');
$menus = new Menus($storeId);
$menuItems = $menus->getObjects(1,"status = 1",array('position'=>'ASC'),'');
if($menuItems){
	$items = array();
	foreach($menuItems as $item){
		$items[$item->getCId()][$item->getParentId()][] = array('id' => $item->getId(),'parent_id' => $item->getParentId(),'name' => $item->getName(),'url' => $item->getUrl());
        #if($item->getParentId())	$items['parent'][$item->getParentId()][] = array('id' => $item->getId(),'parent_id' => $item->getParentId(),'name' => $item->getName(),'url' => $item->getUrl());
	}    
	$template->assign('menuItems',$items);
}

$menId = $menus->getIdFromSlug($slug);
if($menId)$template->assign('menId',$menId);

# Get the list Ads
include_once(ROOT_PATH.'classes/dao/ads.class.php');
$ads = new Ads($storeId);
$adItems = $ads->getObjects(1,"status = 1",array('position'=>'asc'));
if($adItems){
	$items = array();
	foreach($adItems as $item){
		$items[$item->getGId()][] = array('id' => $item->getId(),'url_logo' => $item->getProperty('url_logo'),'url_logo_type' => $item->getProperty('url_logo_type'), 'logo' => $item->getProperty('logo'),'logo_type' => $item->getProperty('logo_type'), 'width' =>$item->getProperty('width'), 'height' => $item->getProperty('height'), 'url' => $item->getProperty('url'),'content' => $item->getContent());
	}
	$template->assign('adItems',$items);
}

# support
include_once(ROOT_PATH.'classes/dao/supports.class.php');
$support = new Supports();
$supportItems = $support->getObjects(1,"status=1", array('position'=>'ASC'));
$template->assign("supportItems",$supportItems);

# Get product categories of this estore
$productCategories = new ProductCategories($storeId);
$productCategoryItems = $productCategories->getObjects(1,"`status` = '1'",array('position' => 'ASC'),200);
if($productCategoryItems) {
	$items = array();
	foreach($productCategoryItems as $item) {
		$items[$item->getParentId()][] = array('id' => $item->getId(),'name' => $item->getName(),'url' => $item->getUrl());
	}
	$template->assign('productCategoryItems',$items);
}

# Get article categories of this estore
$articleCategories = new ArticleCategories($storeId);
$articleCategoryItems = $articleCategories->getObjects(1,"`status` = '1'",array('position' => 'ASC'),200);
if($articleCategoryItems) {
	$items = array();
	foreach($articleCategoryItems as $item) {
		$items[$item->getParentId()][] = array('id' => $item->getId(),'name' => $item->getName(),'url' => $item->getUrl());
	}
	$template->assign('articleCategoryItems',$items);
}

# Get the product list
$products = new Products($storeId);
$estore->setProperty('products_per_seller', 10);

$productSeller = $products->getObjects(1,"status = 1 and (home = 1 || seller = 1)",array('position'=>'ASC','home'=>"DESC",'seller'=>'DESC'),$estore->getProperty('products_per_seller'));
$template->assign('productSeller',$productSeller);

$productSpecial = $products->getObjects(1,"status = 1 and special = 1",array('position'=>'ASC'),$estore->getProperty('products_per_seller'));
$template->assign('productSpecial',$productSpecial);


# Get Articles newest
include_once(ROOT_PATH.'classes/dao/articles.class.php');
$articles= new Articles($storeId);
$articleItems = $articles->getObjects(1,"`status` = '1'",array('date_created' => 'DESC'),3);
if($articleItems)$template->assign('articleNewest',$articleItems);



#Ti gia ngoai te by Mai Tran Nguyen An
include_once(ROOT_PATH."classes/dao/currencies.class.php");
$currencies = new Currencies($storeId);
$listCurrencies = $currencies->getObjects(1,"status=1", array('position'=>'ASC'));
$template->assign('listTigia',$listCurrencies);

# Try to get current category id & slug, then get the CategoryInfo object
$slug = $request->element('slug');


$template->assign("sessId",$sessId);

// OnlineCustomersCounter
#$session_1=session_id();
/*$customerOnline=1;
$time=time();
$time_check=$time-600; // 600=10minute*60
$customerOnline=OnlineCustomersCounter($sessId,$time,$time_check,$_SERVER['REMOTE_ADDR']);
$template->assign('online',$customerOnline);
$template->assign('count',$count);*/
if($estore->getProperty('site_down')){
	$templateFile = 'undercontruction.tpl.html';
	//die();	
}else{
# Include the appropriated action module
    if ($act) include_once(ROOT_PATH.'modules/estore/'.strtolower($act).'.module.php');
}
#get url for facebook
function full_url($s)
{
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
    return $protocol . '://' . $host . $port . $s['REQUEST_URI'];
}
$absolute_url= full_url($_SERVER);
$template->assign('url_link',$absolute_url);

#Current Date
$date=date("l F j, Y");
$template->assign("date",$date);
# Assign the template variables

$template->assign('userTemplate',$userTemplate);
$template->assign('estore',$estore);
$estore->setProperty('currency',1);
$estore->setProperty('rate',19000);
$estore->setProperty('accept_payment_wire',1);
$estore->setProperty('accept_payment_payoo',1);
$estore->setProperty('accept_payment_mobivi',1);
$estore->setProperty('accept_payment_nganluong',1);
$estore->setProperty('accept_payment_paypal',1);
$estore->setProperty('accept_payment_onepay',1);
$estore->setProperty('accept_payment_zingpay',1);
?>