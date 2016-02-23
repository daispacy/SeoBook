<?php
/*************************************************************************
Class question
----------------------------------------------------------------
BiDo.vn Project
Last updated:28/06/2010
Coder: Thai Nguyen
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/productsizeinfo.class.php");

class ProductSize extends Model {
	var $table;
	var $_db;

	function ProductSize($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."product_size";
	}

/* Common methods
/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*', "`$key` = '$value' AND ($condition)");
		if($result) {			
			$object = new ProductSizeInfo
						(	$result[0]['sid'],							
							$result[0]['pid'],
							$result[0]['id']
						);
			return $object;
		}
		return 0;
	}
/*-----------------------------------------------------------------------*
* Function: getObjects
* Parameter: WHERE condition
* Return: Array of Info objects
*-----------------------------------------------------------------------*/
	function getObjects($page = 1, $condition = '1>0', $sort = array(), $items_per_page = DEFAULT_ADMIN_ROWS_PER_PAGE) {
		if(!$page) $page = 1;
		$start = ($page -1) * $items_per_page;
		$results = $this->select('*', "$condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ProductSizeInfo
								(	$result['sid'],									
									$result['pid'],
									$result['id']
								);
			}
			return $objects;
		}
		return 0;
	}

/*-----------------------------------------------------------------------*
* Function: updateData
* Parameter: Info object
* Return: 1 if success, 0 if fail
*-----------------------------------------------------------------------*/	
	# Add record
	function addData($fields,$key = 'id') {
		$result = $this->add($fields,'$key','NULL');
		if($result) return $result;
		return 0;
	}

	# Update record
	function updateData($fields, $value = '', $key = 'id') {
		$result = $this->update($fields,"`$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}

	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`id` = '$id'")) return 1;
		return 0;
	}

	# Change status
	function changeName($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('name' => $status), "`id` = '$id'")) return 1;
		return 0;
	}

# Clean trash
	function cleanTrash() {
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}
	
	function deleteSidFromPid($pid=0) {
		$result = $this->delete("`pid` = $pid");
		if($result) return 1;
		return 0;
	}

	function getAllSidFromPid($pid=0,$isMySql=false) {
		global $amessages;
		$allSid = '0';
		$results = $this->select('sid',"pid=$pid");
		if($results) {
			$tem = array();
			foreach($results as $key => $result) {
				$tem[]=$result['sid'];						
			}
			if($isMySql) return $allSid = implode(",",$tem);
			else return $tem;
		}
		return $allSid;
	}
	
}
?>