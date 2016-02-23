<?php
/*************************************************************************
Class question
----------------------------------------------------------------
BiDo.vn Project
Last updated: 07/11/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/questioninfo.class.php");

class Questions extends Model {
	var $table;
	var $_db;

	function Questions($database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."question";
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
			$object = new QuestionInfo
						(	$result[0]['slug'],
							$result[0]['title'],
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
				$objects[] = new QuestionInfo
								(	$result['slug'],
									$result['title'],
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
		# Change article position
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`id` = '$id'")) return 1;
		return 0;
	}
# Clean trash
	function cleanTrash() {
		$results = $this->select('id',"`status` = ".S_DELETED);
		if($results) {
			include_once(ROOT_PATH."classes/dao/answers.class.php");
			$answers = new Answers();
			# Loop all DELETED categories
			foreach($results as $key => $result) {
				# Change status of all anawer in each question to DELETED too
				$answers->update(array('status' => S_DELETED)," `qid` = '".$result['id']."'");
			}	
		}
		$result = $this->delete("`status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
		
	# Return a  Id from question slug
	function getIdFromSlug($slug='') {
		if(!$slug) return 0;
		$result = $this->select('id',"`slug` = '$slug'");
		if($result) return $result[0]['id'];
		return 0;
	}

	# Return a  title from question slug
	function getTileFromSlug($slug='') {
		if(!$slug) return '';
		$result = $this->select('title',"`slug` = '$slug'");
		if($result) return $result[0]['title'];
		return '';
	}

	# Return a  slug from question ID
	function getSlugFromId($id='') {
		if(!$id) return '';
		$result = $this->select('slug',"``id` = '$id'");
		if($result) return $result[0]['slug'];
		return '';
	}

	# Return a  title from question ID
	function getTitleFromId($id='') {
		if(!$id) return '';
		$result = $this->select('title',"`id` = '$id'");
		if($result) return $result[0]['title'];
		return '';
	}

	# Check duplicate
	function duplicateSlug($slug, $id = 0) {
		$rows = $this->countItems('id',"`slug` = '$slug'".($id?" AND `id` <> '$id'":''));
		if($rows) return 1;
		return 0;		
	}
	function checkDuplicate($value = '', $key = 'title', $condition = '') {
		$result = $this->select("`$key`","`$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}
	function createComboBox($value = 0, $pkey = 'id', $field = 'title', $sort = array('position' => 'ASC')) {
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