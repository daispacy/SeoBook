<?php
/*************************************************************************
Class QuestionInfo
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class AlbumInfo {
	var $id;			# Primary key
	var $name;			# Slug	
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	var $pid;
	var $properties;
	var $date_created;
	var $position;

	# Constructor
	function AlbumInfo($position,$name,$date_created,$properties,$status,$pid, $id = 0)
	{
		$this->id = $id;
		$this->name = $name;		
		$this->status = $status;
		$this->date_created = $date_created;
		$this->properties=unserialize($properties);
		$this->pid=$pid;
		$this->position=$position;
	}
	function getId() {
		return $this->id;
	}	
	function getPosition(){
		return $this->position;
	}
	function setId($nValue) {
		$this->id=$nValue;
	}

	function getPid(){
		return $this->pid;
	}

	function getDateCreated(){
		return $this->date_created;
	}
		
	function getAvatar() {
		$photos = $this->properties['photos'];
		if($photos) return $photos[0];
		return '';
	}
	function getName($lang = 'vn') {
		if($lang == 'vn')	return $this->name;
		else return $this->properties['custom_'.$lang.'_name'];
	}
	function setName($lang = 'vn', $nValue) {
		if($lang == 'vn')	$this->name=stripslashes($nValue);
		else	$this->properties['custom_'.$lang.'_name']=stripslashes($nValue);
	}
	


	function getProperty($key)
	{
		if(isset($this->properties[$key])) return $this->properties[$key];
		return '';
	}
	function setProperty($key,$nValue)
	{
		$this->properties[$key]=$nValue;
	}
	function getProperties()
	{
		return $this->properties;
	}
	function setProperties($nValue)
	{
		$this->properties=$nValue;
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
	function getNameProduct(){
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products(1);
		$product = $products->getObject($this->pid);
		if($product) return $product->getName();
		return "";
	}
	function getNumberPhoto(){
		return count($this->getProperty('photos'));
	}
	
}	
?>