<?php
/*************************************************************************
Class Staticinfo
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Name: Tran Thi Kim Que                                  
Last updated: 15/10/2009                                  
**************************************************************************/
class CommentInfo {
	var $id;
	var $pid;
	var $fullname;
	var $email;
	var $tel;
	var $address;
	var $details;
	var $created;
	var $store_id;
	var $status;
	function CommentInfo ($fullname='', $email='',$tel,$address, $details='', $created ='',$store_id, $status = '',$pid='', $id = 0)
	{
		$this->id = $id;
		$this->pid = $pid;
		$this->fullname = $fullname;
		$this->email = $email;
		$this->tel = $tel;
		$this->address = $address;
		$this->details = $details;
		$this->created = $created;
		$this->store_id = $store_id;
		$this->status = $status;
	}

	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getPId() {
		return $this->pid;
	}	
	function setPId($nValue) {
		$this->pid=$nValue;
	}
	function getFullname() {
		return $this->fullname;
	}	
	function setFullname($nValue) {
		$this->fullname=stripslashes($nValue);
	}
	function getEmail() {
		return $this->email;
	}	
	function setEmail($nValue) {
		$this->email=$nValue;
	}
	function getTel() {
		return $this->tel;
	}	
	function setTel($nValue) {
		$this->tel=$nValue;
	}
	function getAddress() {
		return $this->address;
	}	
	function setAddress($nValue) {
		$this->address=$nValue;
	}
	function getDetails() {
		return $this->details;
	}	
	function setDetails($nValue) {
		$this->details=$nValue;
	}
	function getDateCreated() {
		return $this->created;
	}	
	function setDateCreated($nValue) {
		$this->created=$nValue;
	}
	function getStoreId() {
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	function getStatus() {
		return $this->status;
	}	
	function setStatus($nValue) {
		$this->status=$nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status'][$this->status];
	}
	function getProName() {
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products($this->store_id);
		return $products->getNameFromId($this->pid);
	}
	function getUrl($page = 1, $keywords = '', $sort_key = 'created', $sort_direction = 'desc') {
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products($this->store_id);
		$productItem = $products->getObject($this->pid);
		if($productItem) $url = $productItem->getUrl();
		else $url= '#';
		return $url;	
	}
	
}	

?>