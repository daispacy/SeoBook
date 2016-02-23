<?php
/*************************************************************************
Class ProductCategory
----------------------------------------------------------------
DeraCMS 3.0 Project
Company: Derasoft Co., Ltd
Last updated: 06/23/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/

class ProductCategoryInfo {
	var $id;			# Primary key
	var $parent_id;		# Parent category
	var $store_id;		# Estore id
	var $slug;			# Slug
	var $name;			# Category name
	var $keyword;		# Cagegory keyword
	var $sapo;			# Category sapo
	var $position;		# Position
	var $viewed;		# Number of views
	var $properties;	# Properties
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished

	# Constructor
	function ProductCategoryInfo($slug, $name, $keyword, $sapo, $position, $viewed, $properties, $status, $store_id = 0, $parent_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->parent_id = $parent_id;
		$this->store_id = $store_id;
		$this->slug = $slug;
		$this->name = stripslashes($name);
		$this->keyword = stripslashes($keyword);
		$this->sapo = stripslashes($sapo);
		$this->position = $position;
		$this->viewed = $viewed;
		$this->properties = unserialize($properties);
		$this->status = $status;
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getParentId() {
		return $this->parent_id;
	}
	function setParentId($nValue) {
		$this->parent_id=$nValue;
	}
	function getStoreId() {
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	function getSlug() {
		return $this->slug;
	}	
	
	function setSlug($lang='vn',$nValue) {
		if($lang == 'vn') $this->slug=$nValue;
		else $this->properties['custom_'.$lang.'_slug']=stripslashes($nValue);
	}
	function getName($lang='vn') {
		 if($lang=='vn') return $this->name;
		 elseif(isset($this->properties['custom_'.$lang.'_name'])) return $this->properties['custom_'.$lang.'_name'];		
	}
	function setName($lang='vn',$nValue) {
		if($lang == 'vn') $this->name=stripslashes($nValue);
		else  $this->properties['custom_'.$lang.'_name']=stripslashes($nValue);
	}
	function getKeyword() {
		return $this->keyword;		
	}
	function setKeyword($nValue) {
		$this->keyword=stripslashes($nValue);
	}
	function getSapo() {
		return $this->sapo;		
	}
	function setSapo($nValue) {
		$this->sapo=stripslashes($nValue);
	}
	function getPosition() {
		return $this->position;
	}	
	function setPosition($nValue) {
		$this->position=$nValue;
	}
	
	function getActiveProducts() {
		include_once(ROOT_PATH."classes/dao/productes.class.php");
		$products = new Products($this->store_id);
		$rowsPages = $products->getNumItems('id', "`cat_id` = '".$this->id."' AND `status` = '1'");
		return $rowsPages['rows'];
	}	
	function getNumProducts() {
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products($this->store_id);
		$rowsPages = $products->getNumItems('id', "`cat_id` = '".$this->id."'");
		return $rowsPages['rows'];
	}
	function getNumberProducts() {
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products($this->store_id);
		$productCategories = new ProductCategories($this->store_id);
		$subIds  = $productCategories->getAllSubCategory($this->id);
		$products = $products->getObjects(1,"`status` = '1' AND `cat_id` in (".$subIds.")");
        if($products) return count($products);
        
        return "";
	}
    function getAllProducts() {
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		include_once(ROOT_PATH."classes/dao/products.class.php");
		$products = new Products($this->store_id);
		$productCategories = new ProductCategories($this->store_id);
		$subIds  = $productCategories->getAllSubCategory($this->id);
		$products = $products->getObjects(1,"`status` = '1' AND `cat_id` in (".$subIds.")",array("special"=>"DESC","home"=>"DESC","seller"=>"DESC","price"=>"ASC"),16);
        if($products) return $products;
        
        return "";
	}
	function getViewed() {
		return $this->viewed;
	}	
	function setViewed($nValue) {
		$this->viewed=$nValue;
	}
	function getProperty($key)
	{
		if(isset($this->properties[$key])) return ''.$this->properties[$key];
		return '';
	}
	function setProperty($key,$nValue)
	{
		$this->properties[$key]=stripslashes($nValue);
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
		return $amessages['status_product'][$this->status];
	}
		function getUrl($page = 1, $keywords = '', $sort_key = 'position', $sort_direction = 'asc') {
		$url = '';
		if(URL_TYPE == 1 || $page > 1) {	# Query string
			$url = '/'.SCRIPT.'?act=category&id='.$this->id.'&pg='.$page.'&kw='.$keywords.'&sk='.$sort_key.'&sd='.$sort_direction;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			$url = '/'.$this->slug.'-c'.$this->id.($page>1?'-p'.$page:'').'.html';
			return $url;
		} else return '';	
	}
	
	function getChildren($page = 1, $condition = "`status` = '1'", $sort = array('position' => 'asc'), $items_per_page = 100) {
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		$productCategories = new ProductCategories($this->store_id);
		$productCategoryItems = $productCategories->getObjects($page,"`parent_id` = '".$this->id."' AND $condition",$sort,$items_per_page);
		return $productCategoryItems;
	}

	function getParentIdActive(){
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		$productCategories = new ProductCategories($this->store_id);
		if($this->parent_id==1) return $this->id;
		elseif($this->parent_id > 1){
			$categoryInfo = $productCategories->getObject($this->parent_id);
			return $categoryInfo->getId();
		}else return '';
	}
	
	function getRootParentId(){		
		return $this->findRootParent($this->parent_id);
	}
	
	function getRootParentName($lang="vn"){
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		$productCategories = new ProductCategories($this->store_id);

		$info=$productCategories->getObject($this->getRootParentId());
		if($info) return $info->getName($lang);

		return "";
	}

	function findRootParent($parentId=0){
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		$productCategories = new ProductCategories($this->store_id);
		if($parentId==0) return $this->id;
		else{
		      
			$categoryInfo = $productCategories->getObject($parentId);
			if($categoryInfo->getParentId()==0) return $categoryInfo->getId();
			else{
			     
				return $this->findRootParent($categoryInfo->getParentId());
			}
		}
	}

}	
?>