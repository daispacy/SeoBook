<?php
/*************************************************************************
Adding Ads module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Email: info@derasoft.com
Last updated: 21/09/2011
Coder: Tran Thi My Xuyen
Checkeb by: Mai Minh (07/05/2012)
**************************************************************************/
$userInfo->checkPermission('banner','add');
$templateFile = 'manageads.tpl.html';
include_once(ROOT_PATH.'classes/dao/adscategories.class.php');
include_once(ROOT_PATH.'classes/dao/ads.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$adsCategories = new AdsCategories($storeId);
$ads = new Ads($storeId);
$gallery_path = ROOT_PATH."upload/$storeId/resources/";
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_banner'] => '/'.ADMIN_SCRIPT.'?op=manage&act=ads',
				$amessages['add_new'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=ads';
$listTabs = array($amessages['list_item'] => $tabLink.'&mod=list',
				$amessages['add_new'] => '#',
				$amessages['list_ads_category'] => $tabLink.'&mod=listcategory',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode');
if($result_code) $template->assign('result_code',$result_code);
# Category combo box
$categoryCombo = $adsCategories->generateCombo($request->element('gId'),1);  
if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);

if($_POST && $request->element('doo') == 'submit') { # if form is submitted
	# Validate the data input
	$validate = validateData($request);
	if($validate['invalid']) {	# data input is not in valid form
		$template->assign('error',$validate);	
		# Category combo box
		$categoryCombo = $adsCategories->generateCombo($request->element('gId'),1);
		if($categoryCombo) $template->assign('categoryCombo',$categoryCombo);
	} else { # Valid data input
		# Everything is ok. Add data to DB
		if(!$validate['invalid']) {
			$properties = array('');
			$width = $request->element('width');
			$height = $request->element('height');
			# Files upload
			$files = isset($_FILES['logo'])?$_FILES['logo']:'';
			if($files) {
				$img = addslashes(Filter(rand()."_".$files['name']));
				$tmp_img = $files['tmp_name'];
				$size = $files['size'];
				$type=strtolower(substr($img,-3));
				if(preg_match("/".ALLOW_FILE_TYPES."/",strtolower($img))) {
					# Upload
					if(isImage($img)) {
					move_uploaded_file($tmp_img,$gallery_path.'l_'.$img);
					resize($gallery_path,$gallery_path,'l_'.$img,'a_'.$img,DEFAULT_AVATAR_SIZE,DEFAULT_AVATAR_SQUARE,DEFAULT_PHOTO_QUALITY);
					$logo = $img;
					} elseif(isVideo($img)) {
						move_uploaded_file($tmp_img,$gallery_path.$img);
						$logo = $img;
					} else {
						move_uploaded_file($tmp_img,$gallery_path.$img);
						$logo = $img;
					}
				} #/if (preg_match
			}
			$properties = array('logo' => $logo,
								'logo_type' => $type,
								'url_logo' => Filter($request->element('urllogo')),
								'url_logo_type' => $request->element('typeurl'),
								'width' => Filter($request->element('width')),
								'height' => Filter($request->element('height')),
								'url' => Filter($request->element('url'))
								);
			$data = array('store_id' => $storeId,
						  'gid' => $request->element('gId'),
						  'position' => $request->element('position'),
						  'status' => $request->element('status'),
						  'properties' => serialize($properties),
						  'date_created' => date("Y-m-d H:i:s"),
						  'content' => $request->element('altcontent'));
		   $newId = $ads->addData($data);
				
			# Operation tracking
			$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['add_ads'],$newId),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
			header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=ads&mod=list&gId=".$request->element('gId')."&rcode=6");
		}
	}
}

# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['gid'] = $validate->pasteString($request->element('gid'));
	$error['INPUT']['position'] = $validate->validNumber($request->element('position'),$amessages['position']);
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	$error['INPUT']['urllogo'] = $validate->pasteString($request->element('urllogo'));
	$error['INPUT']['altcontent'] = $validate->pasteString($request->element('altcontent'));
	$error['INPUT']['url'] = $validate->pasteString($request->element('url'),$amessages['url']);
	$error['INPUT']['logo'] = $validate->pasteString($request->element('logo'),$amessages['logourl']);
	if( $error['INPUT']['position']['error']) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}

?>