<?php
/*************************************************************************
Editing ads module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 01/05/2012
Coder: Mai Minh
Checked by: Mai Minh (07/05/2012)
**************************************************************************/
$userInfo->checkPermission('banner','edit');
$templateFile = 'manageads.tpl.html';
include_once(ROOT_PATH.'classes/dao/adscategories.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$adsCategories = new AdsCategories($storeId);
$ads = new Ads($storeId);
$adsCategories = new AdsCategories($storeId);
$gallery_path = ROOT_PATH."upload/$storeId/resources/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_product'] => '/'.ADMIN_SCRIPT.'?op=manage&act=ads',
				$amessages['update_banner_category'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=ads';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['edit_ads'] => '#',
				$amessages['list_ads_category'] => $tabLink.'&mod=listcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
	if($request->element('doo') == 'delFile') {
		$adsInfo = $ads->getObject($id);
		$properties = $adsInfo->getProperties();
		if($adsInfo->getProperty('logo')) {
			unlink($gallery_path.'a_'.$adsInfo->getProperty('logo'));
			unlink($gallery_path.'l_'.$adsInfo->getProperty('logo'));
			unset($properties['logo']);
			$data = array('properties' => serialize($properties));
			$ads->updateData($data,$id);
			$adsInfo = $ads->getObject($id);
		}
	}
$adsInfo = $ads->getObject($id);
if(!$adsInfo) {
	$template->assign('validItem',0);
} else {
	$template->assign('validItem',1);
	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$template->assign('itemInfo',$adsInfo);
			print_r($adsInfo);
			
			# Category combo box
			$categoryCombo = $adsCategories->generateCombo($request->element('gid',1));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
		} else { # Valid data input
			# Category combo box
			$categoryCombo = $adsCategories->generateCombo($request->element('gid',1));
			if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);	
						
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$adsInfo = $ads->getObject($id);
				if($adsInfo) {			
					$properties = $adsInfo->getProperties();
					# Files upload
					$files = isset($_FILES['logo'])?$_FILES['logo']:'';
					$logo = '';
					if($files['name']) {
						$img = addslashes(Filter(rand()."_".$files['name']));
						$tmp_img = $files['tmp_name'];
						$size = $files['size'];
						$type=strtolower(substr($img,-3));
						$properties['type_file'] = $type;
						if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
							if(isImage($img)) {
								move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
								resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
								$logo = $img;
							}elseif(isVideo($img)) {
								move_uploaded_file($tmp_img,$gallery_path.$img);
								$logo = $img;
							} else {
								move_uploaded_file($tmp_img,$gallery_path.$img);
								$logo = $img;
							}
						} #/if (preg_match				
					}
					$properties['url_logo'] = Filter($request->element('urllogo'));
					$properties['url_logo_type'] = $request->element('typeurl');
					$properties['width'] = Filter($request->element('width'));
					$properties['height'] = Filter($request->element('height'));
					$properties['url'] = Filter($request->element('url'));
					if($logo) {
						$properties['logo'] = $logo;
						$properties['logo_type'] = $type;	
					}
					
					# End File upload
					$data = array('store_id' => $storeId,
								  'gid' => $request->element('gId'),
								  'position' => $request->element('position'),
								  'status' => $request->element('status'),
								  'properties' => serialize($properties),
								  'date_created' => date("Y-m-d H:i:s"),
								  'content' => $request->element('altcontent'));
					$ads->updateData($data,$id);
					
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_ads'],$request->element('id')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
					# Redirect to editing page
					header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=ads&mod=edit&lang=$lang&id=$id&rcode=7");
				}
			}
		}
	} else { # Load ads category information to edit
		$template->assign('item',$adsInfo);

		# Category combo box
		$categoryCombo = $adsCategories->generateCombo($adsInfo->getGId(),1);
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
	}
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['gid'] = $validate->pasteString($request->element('gId'));
	$error['INPUT']['position'] = $validate->validNumber($request->element('position'),$amessages['position']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	$error['INPUT']['urllogo'] = $validate->pasteString($request->element('urllogo'));
	$error['INPUT']['altcontent'] = $validate->pasteString($request->element('altcontent'));
	$error['INPUT']['url'] = $validate->pasteString($request->element('url'),$amessages['url']);
	$error['INPUT']['logo'] = $validate->pasteString($request->element('logo'),$amessages['logourl']);
	$error['INPUT']['width'] = $validate->pasteString($request->element('width'));
	$error['INPUT']['height'] = $validate->pasteString($request->element('height'));
	
if($error['INPUT']['position']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>
