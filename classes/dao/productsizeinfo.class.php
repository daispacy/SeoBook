<?php
/*************************************************************************
Class QuestionInfo
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class ProductSizeInfo {
	var $id;			# Primary key
	var $pid;			# Slug	
	var $sid;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished

	# Constructor
	function ProductSizeInfo($sid,$pid, $id = 0)
	{
		$this->id = $id;
		$this->sid = $sid;		
		$this->pid = $pid;
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getPid() {
		return $this->pid;
		
	}
	
	
	
	
	function getSid() {
		return $this->sid;
	}
	
	
}	
?>