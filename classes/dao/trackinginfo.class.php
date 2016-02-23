<?php
/*************************************************************************
Class Tracking Info
----------------------------------------------------------------
DeraCMS Project
Company: Derasoft Co., Ltd                                  
Author: Mai Minh
Email: info@derasoft.com                                    
Last updated: 11/08/2011
**************************************************************************/
class TrackingInfo {
	var $id;
	var $store_id;
	var $username;
	var $action;
	var $date_created;
	var $ip;

	function TrackingInfo($store_id, $username, $action, $date_created, $ip, $id = 0 )
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->username = trim($username);
		$this->action = $action;
		$this->date_created = $date_created;
		$this->ip = $ip;	
	}
	function getId()
	{
		return $this->id;
	}
	function setId($nValue) {
		$this->id = $nValue;
	}
	function getStoreId()
	{
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id = $nValue;
	}
	function getUsername()
	{
		return $this->username;
	}
	function setUsername($nValue) {
		$this->username = $nValue;
	}
	function getAction()
	{
		return $this->action;
	}
	function setAction($nValue) {
		$this->action = $nValue;
	}
	function getDateCreated()
	{
		return $this->date_created;
	}
	function setDateCreated($nValue) 
	{
		$this->date_created = $nValue;
	}
	function getIp()
	{
		return $this->ip;
	}
	function setIp($nValue) 
	{
		$this->ip = $nValue;
	}
}
?>