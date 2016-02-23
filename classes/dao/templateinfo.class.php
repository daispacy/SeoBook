<?php
/*************************************************************************
Class Template Info
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
Last updated: 06/20/2010
**************************************************************************/
class TemplateInfo {
	var $id;
	var $owner_id;
	var $name;
	var $folder;
	var $type;
	var $properties;
	var $status;
				
	function TemplateInfo($owner_id, $name, $folder, $type, $properties, $status, $id = '0')
	{
		$this->id = $id;
		$this->owner_id = $owner_id;
		$this->name = stripslashes($name);
		$this->folder = stripslashes($folder);
		$this->type = $type;		
		$this->properties = unserialize($properties);
		$this->status = $status;
	}
	function getId()
	{
		return $this->id;
	}
	function setId($nValue)
	{
		$this->id=$nValue;
	}
	function getOwnerId()
	{
		return $this->owner_id;
	}
	function setOwnerId($nValue)
	{
		$this->owner_id=$nValue;
	}
	function getName()
	{
		return $this->name;
	}
	function setName($nValue)
	{
		$this->name=stripslashes($nValue);
	}
	function getFolder()
	{
		return $this->folder;
	}
	function setFolder($nValue)
	{
		$this->folder=stripslashes($nValue);
	}
	function getType()
	{
		return $this->type;
	}
	function setType($nValue)
	{
		$this->type=stripslashes($nValue);
	}
	function getProperty($key)
	{
		if(isset($this->properties[$key])) return ''.$this->properties[$key];
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
	function getStatus()
	{
		return $this->status;
	}
	function setStatus($nValue)
	{
		$this->status=$nValue;
	}
}
?>