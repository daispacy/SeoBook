<?php

/*************************************************************************

Module Order

----------------------------------------------------------------

DerCMS 3.0 Project

Company: Derasoft Co., Ltd

Coder: Tran Thi My Xuyen

Email: info@derasoft.com

Last updated: 05/06/2012

**************************************************************************/



if(!$customerInfo)

    header("location: /$lang");

else $templateFile = 'orderstep3.tpl.html';



include_once(ROOT_PATH."classes/data/validate.class.php");

include_once(ROOT_PATH."classes/dao/provinces.class.php");

include_once(ROOT_PATH."classes/dao/areas.class.php");

include_once(ROOT_PATH."classes/dao/orders.class.php");

include_once(ROOT_PATH."classes/dao/orderitems.class.php");



$validate = new Validate();

$provinces = new Provinces();

$areas = new Areas($sId);

$orders = new Orders($sId);

include_once(ROOT_PATH."classes/dao/paymentmethods.class.php");
$paymentMethod = new PaymentMethods(1);
$listMethod = $paymentMethod->getObjects(1,"status = 1",array('position'=>'ASC'),'');
$template->assign('listMethod',$listMethod);

#Allow order config

$template->assign('orderRequireLogin',$estore->getProperty('order_require_login'));

$order_status = $estore->getProperty('order_status');

$template->assign('order_vat',$estore->getProperty('order_vat'));

$template->assign('order_hours',$estore->getProperty('order_hours'));

$template->assign('datePicker',1);

$plus = $request->element('plus','');

if($orderOn){

    

		# Customer needs to correct the information

		$provincesList = $provinces->createComboBox($request->element('province'));		
		$template->assign('provincesList',$provincesList);
		
		        

		# Get province name & recipient's province name

		#$province = $provinces->getNameFromId($request->element('province'));

		#$rprovinceItem = $areas->getObject($request->element('rprovince'),'id',"status = 1");

		#$template->assign('province',$province);

		#if($rprovinceItem){

		#$template->assign('rprovince',$rprovinceItem->getName());

		#$template->assign('rprovinceItem',$rprovinceItem);

		#}

        		

		# Get items in cart

        

		$cartItems = $carts->getObjects(1, '1>0', $sort = array('time_stamp' => 'desc'), 100);

		if($cartItems) $template->assign("cartItems",$cartItems);

        else{

            $templateFile = 'note.tpl.html';

        }                

		

		# Generate the navigation bar

		$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');

		$navigationItems[] = array('name' => $messages['confirm_order'], 'url' => Url::genUrl('order',''), 'current' => '0');

		$template->assign('navigationItems',$navigationItems);

		   



}else{	$templateFile = 'note.tpl.html';

# Generate the navigation bar

$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');

$navigationItems[] = array('name' => $messages['order'], 'url' => Url::genUrl('order',''), 'current' => '0');

$template->assign('navigationItems',$navigationItems);

}

	

# Ham kiem tra du lieu nguoi dung nhap vao

function validateData($request) {

	global $messages;

	include_once(ROOT_PATH.'classes/data/validate.class.php');

	$error = array();

	$validate = new Validate();

	$error['INPUT']['email'] = $validate->validEmail($request->element('email'),$messages['email']);

	$error['INPUT']['name'] = $validate->validString($request->element('name'),$messages['name']);

	$error['INPUT']['cell'] = $validate->validString($request->element('cell'),$messages['cell']);

	$error['INPUT']['tel'] = $validate->validString($request->element('tel'),$messages['tel']);

	$error['INPUT']['address'] = $validate->validString($request->element('address'),$messages['address']);

	$error['INPUT']['rname'] = $validate->validString($request->element('rname'),$messages['rname']);

	$error['INPUT']['raddress'] = $validate->validString($request->element('raddress'),$messages['raddress']);

	#$error['INPUT']['rprovince'] = $validate->validString($request->element('rprovince'),$messages['rprovince']);

	$error['INPUT']['rtel'] = $validate->validString($request->element('rtell'),$messages['tel']);

	$error['INPUT']['rcell'] = $validate->validString($request->element('rcell'),$messages['cell']);

	#$error['INPUT']['rnote'] = $validate->validString($request->element('rnote'),$messages['comment']);

	$rdate = date("Y-m-d H:i:s",strtotime($request->element('rdate')));

	$error['INPUT']['rdate'] = $validate->validTime($rdate);

	if($error['INPUT']['email']['error'] || $error['INPUT']['name']['error'] || $error['INPUT']['cell']['error'] || $error['INPUT']['rname']['error'] || $error['INPUT']['raddress']['error'] || $error['INPUT']['rcell']['error']) {

		$error['invalid'] = 1;

		return $error;

	}

	$error['invalid'] = 0;

	return $error;

}

?>