<?php
/*************************************************************************
Class question
----------------------------------------------------------------
BiDo.vn Project
Last updated:28/06/2010
Coder: Thai Nguyen
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/albuminfo.class.php");

class Albums extends Model {
	var $table;
	var $_db;

	function Albums($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."album";
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
			$object = new AlbumInfo
						(	$result[0]['position'],$result[0]['name'],
							$result[0]['date_created'],
							$result[0]['properties'],
							$result[0]['status'],							
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
				$objects[] = new AlbumInfo
						(	$result['position'],$result['name'],
							$result['date_created'],
							$result['properties'],
							$result['status'],							
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
	# Change article position
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`id` = '$id'")) return 1;
		return 0;
	}
	# Change status
	function changeName($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('name' => $status), "`id` = '$id'")) return 1;
		return 0;
	}

# Clean trash
	function cleanTrash($id=0) {
		if($id){
			$result = $this->select('properties',"pid = '$id'");
			if($result){
				foreach($result as $key => $resul){
					$properties = unserialize($result['properties']);
					foreach($properties['photos'] as $pkey => $pvalue) {
						unlink(ROOT_PATH."upload/1/products/l_".$pvalue);
						unlink(ROOT_PATH."upload/1/products/m_".$pvalue);
						unlink(ROOT_PATH."upload/1/products/t_".$pvalue);
						unlink(ROOT_PATH."upload/1/products/a_".$pvalue);					
					}
				}
			}
		}else{
			$result = $this->delete("`status` = ".S_DELETED);
		}
		if($result) return 1;
		return 0;
	}

	function generateCombo($value=array()) {
		global $amessages;
		$combo = '';
		$results = $this->select('id,name',"status = '1'");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".(in_array($result['id'],$value)?" selected":"")."><strong>".$result['name']."</strong></option>";						
			}
		}
		return $combo;
	}
	function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
    
    # Return a Product name from provided ID
	function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name'," id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
}
?>