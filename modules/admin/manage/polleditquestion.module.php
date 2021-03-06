<?php
/*************************************************************************
Editing article module
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Last updated: 01/05/2012
Last updated: 28/06/2012
Coder: Thai Nguyen
**************************************************************************/
$userInfo->checkPermission('poll','edit');
$templateFile = 'managepoll.tpl.html';
include_once(ROOT_PATH.'classes/dao/questions.class.php');
include_once(ROOT_PATH.'classes/dao/answers.class.php');
include_once(ROOT_PATH.'classes/dao/fields.class.php');
include_once(ROOT_PATH."classes/data/textfilter.class.php");
$answers = new Answers();
$questions = new Questions();
$fields = new Fields($storeId);
$topNav = array($amessages['dash_board'] => '/'.ADMIN_SCRIPT.'?op=dashboard',
				$amessages['manage_website'] => '/'.ADMIN_SCRIPT.'?op=manage',
				$amessages['manage_poll'] => '/'.ADMIN_SCRIPT.'?op=manage&act=poll',
				$amessages['edit_question'] => '');

$tabLink = '/'.ADMIN_SCRIPT.'?op=manage&act=poll';
$listTabs = array($amessages['list_answer'] => $tabLink.'&mod=list',
				$amessages['edit_question'] => '#',
				$amessages['list_question'] => $tabLink.'&mod=listquestion',
				$amessages['add_question'] => $tabLink.'&mod=addquestion',
				$amessages['clean_trash'] => $tabLink.'&mod=cleantrash');			
$template->assign('listTabs',$listTabs);
$template->assign('currentTab',2);

$result_code = $request->element('rcode'); 
if($result_code) $template->assign('result_code',$result_code);
$id = $request->element('id');
if($id) $template->assign('id',$id);
$questionInfo = $questions->getObject($id);
if(!$questionInfo) {
	$template->assign('validItem',0);
} else{
	$template->assign('validItem',1);

	if($_POST && $request->element('doo') == 'submit') { # if form is submitted
		# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='question'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
		
		# Validate the data input
		$validate = validateData($request);
		if($validate['invalid']) {	# data input is not in valid form
			$template->assign('error',$validate);
			$answersInfo = $questions->getObject($id);
			$template->assign('itemInfo',$questionInfo);

		} else { # Valid data input
			# Category combo box
			$questionCombo = $questions->createComboBox();
			if($questionCombo) $template->assign('questionCombo',$questionCombo);
		
			# Check if duplicate slug
			$slug = TextFilter::urlize($request->element('slug'),false,'-');
			$i = 0;
			$dup = 1;
			while($dup) {
				$dup = $questions->checkDuplicate($slug.($i?'-'.$i:''),'slug',"`id` <> '$id' AND `id` = '".$id."'");
				if($dup) $i++;
			}
			$slug .= $i?'-'.$i:'';
			# Everything is ok. Update data to DB
			if(!$validate['invalid']) {
				$questionInfo = $questions->getObject($id);
				if($questionInfo) {			
					$properties = $questionInfo->getProperties();
					# Custom fields
					foreach($fieldList as $field) {
						$properties[$field->getName()] = $request->element($field->getName());
					}
			
					$data = array('slug' => $slug,
						  'title' => Filter($request->element('title')),
						  'position' => $request->element('position'),
						  'status' => $request->element('status'),
						  'properties' => serialize($properties),
						 );
					$questions->updateData($data,$id);
					
					# Operation tracking
					$trackings->addData(array('store_id'=>$storeId,'username'=>$userInfo->getUsername(),'action'=>sprintf($amessages['tracking']['edit_question'],$request->element('title')),'date_created'=>date("Y-m-d H:i:s"),'ip'=>$_SERVER['REMOTE_ADDR']));
					
					# Redirect to editing page
					header('location:'.'/'.ADMIN_SCRIPT."?op=manage&act=poll&mod=editquestion&lang=$lang&id=$id&rcode=7");
				}
			}
		}
	} else { # Load article category information to edit
		$template->assign('item',$questionInfo);
		
		# Get list of custom fields
		$fieldList = $fields->getObjects(1,"`status`='1' AND `module`='question'",array('position' => 'ASC'));
		if($fieldList) $template->assign('fieldList',$fieldList);
	}
}
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $amessages;
	include_once(ROOT_PATH.'classes/data/validate.class.php');
	$error = array();
	$validate = new Validate();
	$error['INPUT']['title'] = $validate->validString($request->element('title'),$amessages['title']);
	$error['INPUT']['slug'] = $validate->validString($request->element('slug'),$amessages['slug']);
	$error['INPUT']['position'] = $validate->pasteString($request->element('position'));
	$error['INPUT']['status'] = $validate->pasteString($request->element('status'));
	
	# Paste value of custom fields
	global $fieldList;
	foreach($fieldList as $field) {
		$error['INPUT'][$field->getName()] = $validate->pasteString($request->element($field->getName()));
		if($field->getType() == 4 || $field->getType() == 7) {	# Listbox and checkbox
			$error['INPUT'][$field->getName()]['value'] = $request->element($field->getName());
		}
	}
		
	if($error['INPUT']['title']['error']||$error['INPUT']['slug']['error'] ) {
		$error['invalid'] = 1;
		return $error;
	}
	$error['invalid'] = 0;
	return $error;
}
?>