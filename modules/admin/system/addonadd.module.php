<?php
/*************************************************************************
Addon Adding module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 30/05/2012
Coder: Mai Minh
**************************************************************************/
$templateFile = 'systemaddon.tpl.html';
include_once(ROOT_PATH.'classes/dao/addons.class.php');
include_once(ROOT_PATH.'classes/dao/events.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$addons = new Addons($storeId);
$events = new Events($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['system'] => '/'.ADMIN_SCRIPT.'?op=system',
				$amessages['system_addon'] => '/'.ADMIN_SCRIPT.'?op=system&act=addon',
				$amessages['add_new'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=system&act=addon';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => $tabLink.'&mod=add',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

# Events combo box
$eventCombo = $events->generateCombo($request->element('event'));
if($eventCombo) $template->assign('eventCombo',$eventCombo);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);
	} else { # Valid data input
		# check duplicate category name
		if($addons->checkDuplicate($request->element('prefix'),'prefix')) {
			$validate['INPUT']['prefix']['message'] = $amessages['addon_prefix_duplicated'];
			$validate['INPUT']['prefix']['error'] = 1;
			$validate['invalid'] = 1;
			$template->assign('error',$validate);
		}
		
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$data = array('store_id' => $storeId,
						  'name' => Filter($request->element('name')),					  
						  'event' => Filter($request->element('event')),
						  'description' => Filter($request->element('description')),
						  'position' => Filter($request->element('position')),
						  'status' => Filter($request->element('status')));
			$addons->addData($data);
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_addon'],$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=system&act=addon&mod=list&pId=".$request->element('parent_id')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);
	$error['INPUT']['event'] = $validate->validNumber($request->element('event'));	
	$error['INPUT']['description'] = $validate->validString($request->element('description'),$amessages['addon_description']);
	$error['INPUT']['position'] = $validate->pasteString($request->element('position'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	
	if($error['INPUT']['name']['error'] || $error['INPUT']['event']['error'] || $error['INPUT']['description']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>