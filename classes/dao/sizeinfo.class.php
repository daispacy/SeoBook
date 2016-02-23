<?php
/*************************************************************************
Class QuestionInfo
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class SizeInfo {
	var $id;			# Primary key
	var $name;			# Slug	
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished

	# Constructor
	function SizeInfo($name,$status, $id = 0)
	{
		$this->id = $id;
		$this->name = $name;		
		$this->status = $status;
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getName($lang = 'vn') {
		if($lang == 'vn')	return $this->name;
		else return $this->properties['custom_'.$lang.'_name'];
	}
	function setName($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->name=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_name']=stripslashes($nValue);
	}
	
	
	
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	
}	
?>