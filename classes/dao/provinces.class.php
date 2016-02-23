<?php
/*************************************************************************
Class Provinces
----------------------------------------------------------------
BiDo.vn Project
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/provinceinfo.class.php");

class Provinces extends Model {
	var $table;
	var $_db;

	function Provinces($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."provinces";
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
			$object = new ProvinceInfo
						(	$result[0]['slug'],
							$result[0]['name'],
							$result[0]['position'],
							$result[0]['properties'],
							$result[0]['status'],
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
				$objects[] = new ProvinceInfo
								(	$result['slug'],
									$result['name'],
									$result['position'],
									$result['properties'],
									$result['status'],
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

	# Clean trash
	function cleanTrash() {
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
		
	# Return a ProductCategory Id from provided ID
	function getIdFromSlug($slug='') {
		if(!$slug) return 0;
		$result = $this->select('id',"`slug` = '$slug'");
		if($result) return $result[0]['id'];
		return 0;
	}

	# Return a ProductCategory Name from provided slug
	function getNameFromSlug($slug='') {
		if(!$slug) return '';
		$result = $this->select('name',"`slug` = '$slug'");
		if($result) return $result[0]['name'];
		return '';
	}

	# Return a ProductCategory slug from provided ID
	function getSlugFromId($id='') {
		if(!$id) return '';
		$result = $this->select('slug',"``id` = '$id'");
		if($result) return $result[0]['slug'];
		return '';
	}

	# Return a ProductCategory name from provided ID
	function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name',"`id` = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}

	# Check duplicate
	function duplicateSlug($slug, $id = 0) {
		$rows = $this->countItems('id',"`slug` = '$slug'".($id?" AND `id` <> '$id'":''));
		if($rows) return 1;
		return 0;		
	}
	function createComboBox($value = 0, $pkey = 'id', $field = 'name', $sort = array('position' => 'ASC')) {
		$options = '';
		$results = $this->select("`$pkey`, `$field`", "1>0", $sort, 0, 500);
		if($results) {
			foreach($results as $key => $result)
				$options .= '<option value="'.$result[$pkey].'"'.($result[$pkey]==$value?' selected="selected"':'').'>'.$result[$field].'</option>';
		}
		return $options;		
	}
}
?>