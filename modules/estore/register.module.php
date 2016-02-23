<?php
/*************************************************************************
Estore register module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                  
**************************************************************************/
include_once(ROOT_PATH."classes/dao/provinces.class.php");
include_once(ROOT_PATH.'classes/dao/emails.class.php');

$templateFile = "register.tpl.html";
$provinces = new Provinces();
$emails = new Emails($sId);
$plus = $request->element('plus');


if (preg_match('/cart.html/',$_SERVER['HTTP_REFERER'])|| $plus=="loginOrder") {    
    $template->assign('isOrder',1);
}
# Get Register
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$messages["result_code"][$result_code]);
# At the beginning
$provincesList = $provinces->createComboBox();
if($provincesList) $template->assign('provincesList',$provincesList);
		
$infoClass = "infoText";
$template->assign("infoClass",$infoClass);

if ($plus == 'apply'){ 
	$pageTitle = $messages['active_profile'];
	#$templateFile = "login.tpl.html";
	$cId = $request->element('id');
	$customerInfo = $customers->getObject($cId,'id');
	if ($customerInfo){
		$customers->changeStatus($cId ,1);
	}
	# Generate the navigation bar
	$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
	$navigationItems[] = array('name' => $messages['active_profile'], 'url' => '', 'current' => '1');
	$template->assign('navigationItems',$navigationItems);

}else{
if($_POST){	
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		$template->assign("infoClass","error");
		$template->assign('note',$messages["register_error"]);
		$listProvince = $provinces->createComboBox($request->element('province'), 'id', 'name');
		$template->assign('listProvince',$listProvince);        
	} else { # Valid data input
		# check duplicate customer username
			if($customers->checkDuplicate($request->element('email'),'username')) {
				$validate['INPUT']['username']['message'] = $messages['username_aready'];
				$validate['INPUT']['username']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		# check duplicate customer email
			if($customers->checkDuplicate($request->element('email'),'email')) {
				$validate['INPUT']['email']['message'] = $messages['email_aready'];
				$validate['INPUT']['email']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		$template->assign('error',$validate);	
		$template->assign("infoClass","error");
		$template->assign('note',$messages["register_error"]);
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			# Password
			$pass = $request->element('password','');
			$password = md5($pass);
			#Property 
			$properties = array('');
			$properties = array('password' => $pass,
								'province' => $request->element('province'),
								'cell' => $request->element('cell'));
			# End property
			$data = array('store_id' => $storeId,
						  'area_id'  => $request->element('province'),
						  'username' => $request->element('email'),
						  'password' => $password,
						  'fullname' => Filter($request->element('fullname')),
						  'address' => Filter($request->element('address')),
						  'email' => Filter($request->element('email')),
						  'tel' => Filter($request->element('cell')),
						  'properties' => serialize($properties),
						  'date_created' => date("Y-m-d H:i:s"),
						  'status' => 1);
			$newId = $customers->addData($data);
            if($newId)$_SESSION['store_customerId'] = $newId;
			$emailItem = $emails->getObject('REGISTRATION_EMAIL','name',"status = 1");
			if($emailItem){
				$tokens = explode(',',$emailItem->getTokens());
				$bodyEmail = $emailItem->getContent();
				$subjectEmail = $emailItem->getTitle();
				foreach($tokens as $token){
					$subjectEmail = str_replace("{".$token."}",'%s',$subjectEmail);
					$bodyEmail = str_replace("{".$token."}",'%s',$bodyEmail); 
				}
			}else{
				$subjectEmail = $messages["register_email_title"];
				$bodyEmail = $messages["register_email_body"];
			}
			$To = $request->element('email');
			$url = DOMAIN."/register/apply-".$newId.".html";
			$Subject     =sprintf($subjectEmail,DOMAIN);
			$from=$estore->getEmail();
			$Body = sprintf($bodyEmail,$request->element('fullname'),DOMAIN,$request->element('email'),$pass,DOMAIN,DOMAIN);
			$header = "Content-type: text/html; charset=utf-8\r\nFrom: $from\r\nReply-to: $from";
			$ok = mail($To,$Subject,$Body,$header);
			unset($_SESSION['rand_code']);
			$template->assign('note',$messages['result_code'][1]);
            header('location: /'.$lang.'/orderstep3.html');
            exit();
		}
	}
}

# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => $messages['register'], 'url' => '', 'current' => '1');
$template->assign('navigationItems',$navigationItems);
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $messages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();	
	$error['INPUT']['password'] = $validate->validString($request->element('password'));
	$error['INPUT']['cpassword']['value'] = $request->element('cpassword');
    $error['INPUT']['cpassword']['error']=0;
    if($error['INPUT']['cpassword']['value'] != $error['INPUT']['password']['value']){
        $error['INPUT']['cpassword']['error']=1;
        $error['INPUT']['cpassword']['message']=$messages['cofirm_password'];
    }
	$error['INPUT']['fullname'] = $validate->validString($request->element('fullname'),$messages['fullname']);
	$error['INPUT']['email'] = $validate->validEmail($request->element('email'));
	$error['INPUT']['address'] = $validate->validString($request->element('address'),$messages['address']);
	$error['INPUT']['cell'] = $validate->validString($request->element('cell'),$messages['tel']);
	$error['INPUT']['province'] = $validate->validString($request->element('province'),$messages['province']);
	#$code = strtolower($request->element('code'));
	#$error['INPUT']['code'] = $validate->validCode($code,$messages['security']);
	if($error['INPUT']['password']['error'] ||
       $error['INPUT']['cpassword']['error'] || 
       $error['INPUT']['fullname']['error'] || 
       $error['INPUT']['email']['error'] || 
       $error['INPUT']['cell']['error'] 
       ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;


# Page title, keywords, description
$pageTitle = $messages['register'];
}
?>