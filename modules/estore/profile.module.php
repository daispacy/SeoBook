<?php
include_once(ROOT_PATH."classes/data/validate.class.php");
include_once(ROOT_PATH."classes/dao/provinces.class.php");
$provinces = new Provinces();
if(isset($_SESSION['store_customerId'])) $uId = (int)$_SESSION['store_customerId'];
if(isset($uId)) $customerInfo = $customers->getObject($uId,'id');
if($customerInfo) $templateFile = "profile.tpl.html";
else $templateFile = "login.tpl.html";
if($customerInfo){
	$listProvince = $provinces->createComboBox($customerInfo->getProperty('province'), 'id', 'name');
	$template->assign('listProvince',$listProvince);	
	$template->assign('item',$customerInfo);
	if($_POST){
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
				$template->assign('error',$validate);
				$template->assign('note',$messages['item_edit_error']);
				$template->assign('infoClass',"error");
		} else { # Valid data input
				# Check new password and confirm password
				if($request->element('password')) {
					$new_password = md5($request->element('password'));
					$confirm_password = md5($request->element('confirm_password'));
					if($new_password != $confirm_password) { # New password is same as confirm password
						$validate['INPUT']['confirm_password']['message'] = $messages['invalid_confirm_password'];
						$validate['INPUT']['confirm_password']['error'] = 1;
						$validate['invalid'] = 1;
						$template->assign('error',$validate);
						$template->assign('infoClass',"error");
					}
				}		
				# check duplicate email
				if($customers->checkDuplicate($request->element('email'),'email',"`id` <>'$uId'")) {
					$validate['INPUT']['email']['message'] = $amessages['email_duplicated'];
					$validate['INPUT']['email']['error'] = 1;
					$validate['invalid'] = 1;
					$template->assign('error',$validate);
				}
				# Everything is ok. Update data to DB
				if(!$validate['invalid']) {
				$template->assign('note',$messages['update_profile_ok']);
				$infoClass = "infoText";
				$template->assign('infoClass',$infoClass);
				#Property 
				$properties = array('');
				$properties = array('password' => $request->element('password',''),
									'province' => $request->element('province',''),
									'cell' => $request->element('cell',''));
				# End property
				$data = array('store_id' => $storeId,
							  'area_id'  => $request->element('province'),
							  'fullname' => Filter($request->element('fullname')),
							  'address' => Filter($request->element('address')),
							  'email' => Filter($request->element('email')),
							  'tel' => Filter($request->element('tel')),
							  'properties' => serialize($properties),
							  'date_created' => date("Y-m-d H:i:s"));
						if($request->element('password')) $data['password'] = md5($request->element('password'));
						$customers->updateData($data,$uId);
						$template->assign('item',$customerInfo);
						unset($_SESSION['rand_code']);
						header('location:'.$_SERVER['HTTP_REFERER']);
				}
		}
	}
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $messages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	if($request->element('password')) $error['INPUT']['password'] = $validate->validPassword($request->element('password'));
	else $error['INPUT']['password'] = $validate->pasteString($request->element('password'));
	if($request->element('retype_pass')) $error['INPUT']['retype_pass'] = $validate->validPassword($request->element('retype_pass'),$messages['confirm']);
	else $error['INPUT']['retype_pass'] = $validate->pasteString($request->element('retype_pass'));
	$error['INPUT']['fullname'] = $validate->validString($request->element('fullname'),$messages['fullname']);
	$error['INPUT']['email'] = $validate->validEmail($request->element('email'));
	$error['INPUT']['cell'] = $validate->validString($request->element('cell'),$messages['cell']);
	$error['INPUT']['tel'] = $validate->validString($request->element('tel'),$messages['tel']);
	$error['INPUT']['address'] = $validate->validString($request->element('address'),$messages['address']);
	if($error['INPUT']['fullname']['error'] || $error['INPUT']['email']['error'] || $error['INPUT']['cell']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' =>  $messages['profile'], '', 'current' => '1');
$template->assign('navigationItems',$navigationItems);

# Page title, keywords, description
$pageTitle = $messages['profile'];
?>