<?php
/*************************************************************************
Class email template
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd                                  
Last updated: 21/05/2012
Coder: Mai Minh
**************************************************************************/
class EmailInfo {
	var $Id;			# email code (primary key)
	var $store_id;		
	var $name;			# Name method
	var $title;			# Email title
	var $content;		# Email content
	var $tokens;		# List of tokens
	var $status;		# 0-Disabled, 1-Active, 2-Deleted
	var $can_del;		# Can be deleted via CMS
	# Constructor
	function EmailInfo($name, $title, $content, $tokens, $status=0, $can_del=1,$store_id=0, $Id = 0)
	{
		$this->Id = $Id;
		$this->store_id=$store_id;
		$this->name = $name;
		$this->title = $title;
		$this->content = $content;
		$this->tokens = $tokens;
		$this->status = $status;
		$this->can_del = $can_del;
	}

	function getId() {
		return $this->Id;
	}	
	function setId($nValue) {
		$this->Id=$nValue;
	}	
	
	function getName() {
		return $this->name;
	}	
	function setName($nValue) {
		$this->name=$nValue;
	}
	
	function getTitle() {
		return $this->title;
	}	
	function setTitle($nValue) {
		$this->title=$nValue;
	}
	function getContent() {
		return unserialize($this->content);
	}
	function setContent($nValue) {
		$this->content=$nValue;
	}
	function getTokens() {
		return $this->tokens;
	}
	function setTokens($nValue) {
		$this->tokens=$nValue;
	}
	function getStatus() {
		return $this->status;
	}
	function setStatus($nValue) {
		$this->status = $nValue;
	}
	function getCanDel() {
		return $this->can_del;
	}
	function setCanDel($nValue) {
		$this->can_del = $nValue;
	}
	function getStatusText() {
		global $amessages;
		return $amessages['status_text'][$this->status];
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	function getCanDelTextBackend() {
		if($this->can_del==1) return "Có";
		return "Không";
	}
}	
?>