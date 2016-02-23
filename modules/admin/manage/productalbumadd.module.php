<?php
/*************************************************************************
Adding product module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Coder: Mai Minh
Email: info@derasoft.com
Last updated: 10/05/2012
Checked by: Mai Minh (10/05/2012)
**************************************************************************/
$userInfo->checkPermission('product','add');
$templateFile = 'manageproduct.tpl.html';
include_once(ROOT_PATH.'classes/dao/albums.class.php');
include_once(ROOT_PATH.'classes/dao/products.class.php');

$albums = new Albums();
$products = new Products($storeId);

$gallery_root = ROOT_PATH."upload/$storeId/";
$gallery_path = $gallery_root."products/";

$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=manage&act=product',
				"Thêm album mới" => '');

$pid= $request->element("pid");

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=product';
$listTabs = array($amessages['list_item'] => $tabLink."&mod=albumlist&pid=$pid",
				$amessages['add_new'] => $tabLink.'&mod=albumadd',								
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);
$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);

#productCombo
$productCombo = $products->generateCombo($request->element("pid"));
if($productCombo)$template->assign("productCombo",$productCombo);


if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		
	} else { # Valid data input
		# check duplicate product name
		if($estore->getProperty('check_duplicate_product_name')) {
			if($albums->checkDuplicate($request->element('name'),'name',"pid = '".$request->element('pid')."'")) {
				$validate['INPUT']['name']['message'] = $amessages['name_duplicated'];
				$validate['INPUT']['name']['error'] = 1;
				$validate['invalid'] = 1;
				$template->assign('error',$validate);
			}
		}
						
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			
			# User upload
			 $userUpload = $userInfo->getUsername();
								
			$properties = array(
								'photos' => $uphotos,
								);
			
			
			$data = array(												  
						  'pid' => $request->element('pid'),						 
						  'name' => Filter($request->element('name')),						  
						  'position' => $request->element('position'),
						  'status' => $request->element('status'));
			$newId = $albums->addData($data);
			if($newId){

				$albumInfo=$albums->getObject($newId);

				$properties =$albumInfo->getProperties();

				# Check if gallery folder is exists
				if(!file_exists($gallery_root)) mkdir("$gallery_root");
				if(!file_exists($gallery_path)) mkdir("$gallery_path");
						# Files upload
				$files = isset($_FILES['photos'])?$_FILES['photos']:'';
				if($files) {					
					$uphotos = array();
					for($i=0; $i<count($files['name']);$i++) {
						$img = addslashes(Filter(rand()."_".$files['name'][$i]));
						$tmp_img = $files['tmp_name'][$i];
						$size = $files['size'][$i];
						$type=strtolower(substr($img,-3));
						if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($type))) {
							# Upload
							if(isImage($img)) {
								$new_img = $img;
								move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
								if(!isJpeg($img)) $new_img = preg_replace("/(png$|bmp$|gif$)/","jpg",$img);
								resize($gallery_path,$gallery_path,'l_'.$img,'l_'.$new_img,DEFAULT_LARGE_SIZE,DEFAULT_LARGE_SQUARE,DEFAULT_PHOTO_QUALITY);
								resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$new_img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
								resize($gallery_path,$gallery_path,'l_'.$img,'m_'.$new_img,DEFAULT_MEDIUM_SIZE,DEFAULT_MEDIUM_SQUARE,DEFAULT_PHOTO_QUALITY);
								resize($gallery_path,$gallery_path,'l_'.$img,'t_'.$new_img,DEFAULT_THUMBNAIL_SIZE,DEFAULT_THUMBNAIL_SQUARE,DEFAULT_PHOTO_QUALITY);
								if($img != $new_img) unlink($gallery_path,'l_'.$img);	# Delete file if it's not a JPEG
								$uphotos[] = $img;				
							}
							
						} 
					}
				}
				# End File upload
				$properties['photos']=$uphotos;
				$albums->updateData(array("properties"=>serialize($properties)),$newId);

			}
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf("Album %s đã được thêm mới",$request->element('name')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=product&mod=albumedit&id=$newId&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['pid'] = $validate->validNumber($request->element('pid'));
	$error['INPUT']['name'] = $validate->validString($request->element('name'),$amessages['name']);		

	
	
	if($error['INPUT']['name']['error'] || $error['INPUT']['pid']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>