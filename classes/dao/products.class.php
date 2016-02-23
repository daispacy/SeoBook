<?php
/*************************************************************************
Class Products
----------------------------------------------------------------
BiDo.vn Project
Last updated: 06/23/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
include_once(ROOT_PATH."classes/database/model.class.php");
include_once(ROOT_PATH."classes/dao/productinfo.class.php");

class Products extends Model {
	var $table;
	var $_db;
	var $store_id;
	
	function Products($store_id = 0, $database = '') {
		if(!$database) {
			global $db;
			$this->_db = $db;
		} else $this->_db = $database;
		$this->table = DB_PREFIX."products";
		$this->store_id = $store_id;
	}

/* Common methods
/*-----------------------------------------------------------------------*
* Function: getObject
* Parameter: key
* Return: Info object
*-----------------------------------------------------------------------*/
	function getObject($value = '0', $key = 'id', $condition = '1>0') {
		if(!$key || !$value) return '';
		$result = $this->select('*', "`store_id` = '".$this->store_id."' AND `$key` = '$value' AND ($condition)");
		if($result) {
			$object = new ProductInfo
						(	$result[0]['quantity'],$result[0]['seller'],
							$result[0]['special'],
							$result[0]['en_name'],
							$result[0]['en_keyword'],
							$result[0]['sku'],
							$result[0]['slug'],
							$result[0]['name'],
							$result[0]['keyword'],
							$result[0]['description'],
							$result[0]['detail'],
							$result[0]['avatar'],
							$result[0]['price'],
							$result[0]['market_price'],
							$result[0]['currency'],
							$result[0]['viewed'],
							$result[0]['created'],
							$result[0]['updated'],
							$result[0]['position'],
							$result[0]['properties'],
							$result[0]['status'],
							$result[0]['home'],
							$result[0]['cat_id'],
							$result[0]['store_id'],
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
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND $condition", $sort, $start, $items_per_page);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {
				$objects[] = new ProductInfo
								(	$result['quantity'],$result['seller'],
									$result['special'],
									$result['en_name'],
									$result['en_keyword'],
									$result['sku'],
									$result['slug'],
									$result['name'],
									$result['keyword'],
									$result['description'],
									$result['detail'],
									$result['avatar'],
									$result['price'],
									$result['market_price'],
									$result['currency'],
									$result['viewed'],
									$result['created'],
									$result['updated'],
									$result['position'],
									$result['properties'],
									$result['status'],
									$result['home'],
									$result['cat_id'],
									$result['store_id'],
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
		$result = $this->update($fields,"`store_id` = '".$this->store_id."' AND `$key` = '$value'");
		if($result)
			return $result;
		return 0;
	}

	# Change status
	function changeStatus($id = 0, $status = '') {
		if(!$id) return 0;
		if($this->update(array('status' => $status), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change home
	function changeHome($id = 0, $home = '') {
		if(!$id) return 0;
		if($this->update(array('home' => $home), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change seller
	function changeSeller($id = 0, $home = '') {
		if(!$id) return 0;
		if($this->update(array('seller' => $home), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change special
	function changeSpecial($id = 0, $home = '') {
		if(!$id) return 0;
		if($this->update(array('special' => $home), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change product category
	function changeCatId($id = 0, $catId = 0) {
		if(!$id) return 0;
		if($this->update(array('cat_id' => $catId), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change product position
	function changePosition($id = 0, $position = 0) {
		if(!$id) return 0;
		if($this->update(array('position' => $position), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		return 0;
	}
	# Change product price
	function changePrice($id = 0, $price = 0) {
		if(!$id) return 0;
		
		if($this->update(array('price' => str_replace(',','',$price)), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		
		return 0;

	}
	# Change product price
	function changeMarketPrice($id = 0, $price = 0) {
		if(!$id) return 0;
		
		if($this->update(array('market_price' => $price), "`store_id` = '".$this->store_id."' AND `id` = '$id'")) return 1;
		
		return 0;
	}

	# Clean trash
	function cleanTrash() {
		include_once(ROOT_PATH."classes/dao/albums.class.php");
		$albums = new Albums();
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($results) {
			$objects = array();
			foreach($results as $key => $result) {

				$album = $albums->getObjects(1,"pid = ".$result['id'],array(),1000);
				
				if($album){
					foreach ($album as $item){
						$albums->cleantrash($item->getId());
					}
				}

				$properties = unserialize($result['properties']);
				if($properties['avatar']){
					unlink(ROOT_PATH."upload/".$this->store_id."/products/l_".$properties['avatar']);
					unlink(ROOT_PATH."upload/".$this->store_id."/products/m_".$properties['avatar']);
					unlink(ROOT_PATH."upload/".$this->store_id."/products/t_".$properties['avatar']);
					unlink(ROOT_PATH."upload/".$this->store_id."/products/a_".$properties['avatar']);
				}
				foreach($properties['photos'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/products/l_".$pvalue);
					unlink(ROOT_PATH."upload/".$this->store_id."/products/m_".$pvalue);
					unlink(ROOT_PATH."upload/".$this->store_id."/products/t_".$pvalue);
					unlink(ROOT_PATH."upload/".$this->store_id."/products/a_".$pvalue);					
				}
				foreach($properties['videos'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/products/".$pvalue);					
				}
				foreach($properties['files'] as $pkey => $pvalue) {
					unlink(ROOT_PATH."upload/".$this->store_id."/products/".$pvalue);					
				}
			}
		}
		$result = $this->delete("`store_id` = '".$this->store_id."' AND `status` = ".S_DELETED);
		if($result) return 1;
		return 0;
	}	
	function increaseViewed($viewed,$pId) {
		$sql = $this->update(array('viewed'=>$viewed), "id='$pId'");
		if($sql) return 1;
		return 0;
	}
	# Return a Product Id from provided ID
	function getIdFromSlug($slug='') {
		if(!$slug) return 0;
		$result = $this->select('id',"`store_id` = '".$this->store_id."' AND slug = '$slug'");
		if($result) return $result[0]['id'];
		return 0;
	}

	# Return a Product Name from provided slug
	function getNameFromSlug($slug='') {
		if(!$slug) return '';
		$result = $this->select('name',"`store_id` = '".$this->store_id."' AND slug = '$slug'");
		if($result) return $result[0]['name'];
		return '';
	}

	# Return a Product slug from provided ID
	function getSlugFromId($id='') {
		if(!$id) return '';
		$result = $this->select('slug',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['slug'];
		return '';
	}

	# Return a Product name from provided ID
	function getNameFromId($id='') {
		if(!$id) return '';
		$result = $this->select('name',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['name'];
		return '';
	}
	# Return a Product price from provided ID
	function getPriceFromId($id='') {
		if(!$id) return '';
		$result = $this->select('price',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['price'];
		return '';
	}
	# Return a Product price from provided ID
	function getSKUFromId($id='') {
		if(!$id) return '';
		$result = $this->select('sku',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['sku'];
		return '';
	}

/*-----------------------------------------------------------------------*
* Function: CheckDuplicate
* Parameter: Info object
* Return: 1 if key already exists, 0 if not exists
*------------------------------------------------------------------------*/
	function checkDuplicate($value = '', $key = 'name', $condition = '') {
		$result = $this->select("`$key`","`store_id` = '".$this->store_id."' AND `$key` = '$value'".($condition?" AND $condition":''));
		if($result) return 1;
		return 0;
	}

	# Return a Product name from provided ID
	function getCatIdFromId($id='') {
		if(!$id) return '';
		$result = $this->select('cat_id',"`store_id` = '".$this->store_id."' AND id = '$id'");
		if($result) return $result[0]['cat_id'];
		return '';
	}
	function getProductFromPid($pId) {
		$results = $this->select('*', "`store_id` = '".$this->store_id."' AND status =1 AND `cat_id`=$pId", array('created' => 'DESC'),  $start, '');
		if($results) {
			$productInfos = array();
			foreach($results as $key => $result) {
				$productInfos[] = new ProductInfo (	$result['seller'],
													$result['special'],
													$result['en_name'],
													$result['en_keyword'],
													$result['sku'],
													$result['slug'],
													$result['name'],
													$result['keyword'],
													$result['description'],
													$result['detail'],
													$result['avatar'],
													$result['price'],
													$result['market_price'],
													$result['currency'],
													$result['viewed'],
													$result['created'],
													$result['updated'],
													$result['position'],
													$result['properties'],
													$result['status'],
													$result['home'],
													$result['cat_id'],
													$result['store_id'],
													$result['id']
													);
			}
			return $productInfos;
		}
		return '';
	}
	/*-----------------------------------------------------------------------*
* Function: Get number of rows from price
* Parameter: query id
* Return: number of rows
*-----------------------------------------------------------------------*/
	# under price
	function getNumRowsUnderPrice($price =0) {
	$results = $this->select('id', "`store_id` = '".$this->store_id."' AND status =1 AND `price` <= $price");
		if($results) 
		return count($results);
		else
		return 0;
	}
	#from price to price
	function getNumRowsInPrice($priceStart =0,$priceEnd=0) {
	$results = $this->select('id', "`store_id` = '".$this->store_id."' AND status =1 AND `price` >= $priceStart AND `price` <= $priceEnd");
		if($results) 
		return count($results);
		else
		return 0;
	}
	#over price
	function getNumRowsOverPrice($price =0) {
	$results = $this->select('id', "`store_id` = '".$this->store_id."' AND status =1 AND `price` >= $price");
		if($results) 
		return count($results);
		else
		return 0;
	}
	# get price from pid
    function getPriceFromPid($id){
        $results = $this->select('*', "`store_id` = '".$this->store_id."' AND status =1 AND `id`=$id", array(),  0,    100);
        $price=0;
        if($results) {
			
            if($results[0]['market_price'] > 1000 && $results[0]['market_price'] < $results[0]['price']) $price = $results[0]['market_price'];
    		else $price = $results[0]['price'];
            /*
    		if($results[0]['currency'] == 2) $price = $price*$rate;
    		if($currency == 1) $rate = 1;
    		if($currency == 2) $rate = 1/$rate;
    		return $price*$rate;*/
			
		}
		return $price;
    }

	function generateCombo($value) {
		
		$combo = '';
		$results = $this->select('*',"`store_id` = '".$this->store_id."' AND status = '1'");
		if($results) {
			foreach($results as $key => $result) {
				$combo .= "<option value='".$result['id']."'".($result['id']==$value?" selected":"")."><strong>".$result['name']."</strong></option>";						
			}
		}
		return $combo;
	}
	
}
?>