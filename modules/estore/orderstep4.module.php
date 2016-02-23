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
include_once(ROOT_PATH."classes/data/validate.class.php");
include_once(ROOT_PATH."classes/dao/provinces.class.php");
include_once(ROOT_PATH."classes/dao/areas.class.php");
include_once(ROOT_PATH."classes/dao/orders.class.php");
include_once(ROOT_PATH."classes/dao/orderitems.class.php");

$validate = new Validate();
$provinces = new Provinces();
$areas = new Areas($sId);
$orders = new Orders($sId);

#Allow order config
$template->assign('orderRequireLogin',$estore->getProperty('order_require_login'));
$order_status = $estore->getProperty('order_status');
$template->assign('order_vat',$estore->getProperty('order_vat'));
$template->assign('order_hours',$estore->getProperty('order_hours'));
$template->assign('datePicker',1);
$plus = $request->element('plus','');
include_once(ROOT_PATH."classes/dao/paymentmethods.class.php");
$paymentMethod = new PaymentMethods(1);
$listMethod = $paymentMethod->getObjects(1,"status = 1",array('position'=>'ASC'),'');
$template->assign('listMethod',$listMethod);
if($orderOn){
switch ($plus) {
	
	case 'submitOrder':
		if ($_POST){
	$templateFile = 'orderstep4.tpl.html';
	global $messages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$provincename = $provinces->getNameFromId($request->element('rprovince'));
	$_SESSION['rprovinceid'] = $request->element('rprovince');
	$_SESSION['payment'] = $request->element('payment');
	$_SESSION['provincename'] = $provincename;
	$_SESSION['rtel'] = $request->element('rtel');
	$_SESSION['raddress'] = $request->element('raddress');
	$_SESSION['rdate'] = $request->element('rdate');
	$_SESSION['rday'] = $request->element('rday');
	$_SESSION['rnote'] = $request->element('rnote');
	$_SESSION['rname'] = $request->element('rname');
	$_SESSION['paymentname'] = $paymentMethod->getNameFromId($request->element('payment'));
	unset($_SESSION['orderStep3error']);
	/*$template->assign('rprovinceid',$request->element('rprovince'));
	$template->assign('provincename',$provincename);
	$template->assign('raddress',$request->element('raddress'));
	$template->assign('rdate',$request->element('rdate'));
	$template->assign('rday',$request->element('rday'));
	$template->assign('rnote',$request->element('rnote'));
	$template->assign('rname',$request->element('rname'));
	$template->assign('paymentname',$paymentMethod->getNameFromId($request->element('payment')));*/
	$cartItems = $carts->getObjects(1, '1>0', $sort = array('time_stamp' => 'desc'), 100);
	if($cartItems) $template->assign("cartItems",$cartItems);
	# Confirm the information before creating the order
			$validate = validateData($request);
			if($validate['invalid']) 
			{	$_SESSION['orderStep3error'] =$messages['comment_error'];
				header("location: /$lang/orderstep3.html");
				}
		}
		break;
		
}
}
	
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $messages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	#$error['INPUT']['email'] = $validate->validEmail($request->element('email'),$messages['email']);
	#$error['INPUT']['name'] = $validate->validString($request->element('name'),$messages['name']);
	#$error['INPUT']['cell'] = $validate->validString($request->element('cell'),$messages['cell']);
	#$error['INPUT']['tel'] = $validate->validString($request->element('tel'),$messages['tel']);
	#$error['INPUT']['address'] = $validate->validString($request->element('address'),$messages['address']);
	$error['INPUT']['rname'] = $validate->validString($request->element('rname'),$messages['rname']);
	$error['INPUT']['raddress'] = $validate->validString($request->element('raddress'),$messages['raddress']);
	$error['INPUT']['rprovince'] = $validate->validString($request->element('rprovince'),$messages['rprovince']);
	$error['INPUT']['rtel'] = $validate->validString($request->element('rtel'),$messages['tel']);
	#$error['INPUT']['rcell'] = $validate->validString($request->element('rcell'),$messages['cell']);
	#$error['INPUT']['rnote'] = $validate->validString($request->element('rnote'),$messages['comment']);
	$rdate = date("Y-m-d H:i:s",strtotime($request->element('rdate')));
	$error['INPUT']['rdate'] = $validate->validTime($rdate);
	if($error['INPUT']['rname']['error'] || $error['INPUT']['rdate']['error'] || $error['INPUT']['raddress']['error'] || $error['INPUT']['rtel']['error']) {
		$error['invalid'] = 1;
		print_r($error);
		return $error;
	}
	$error['invalid'] = 0;
	
	return $error;
}
?>