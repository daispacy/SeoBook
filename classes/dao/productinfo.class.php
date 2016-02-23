<?php
/*************************************************************************
Class Product
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 06/24/2010
Author: Mai Minh (http://maiminh.vnweblogs.com)
**************************************************************************/
class ProductInfo {
	var $id;			# Primary key
	var $store_id;		# Estore id
	var $cat_id;		# Category id
	var $sku;			# SKU
	var $slug;			# Slug
	var $name;			# Product name
	var $keyword;		# Product keyword
	var $description;	# Description
	var $detail;		# Detail
	var $avatar;		# avatar
	var $price;			# Price
	var $market_price;	# Market price
	var $currency;		# Currency
	var $viewed;		# Number of views
	var $date_created;	# Date created
	var $updated;		# Date update
	var $position;
	var $properties;	# Properties
	var $status;		# 0-Disabled, 1-Active, 2-Deleted, 3-Unpublished
	var $home;
	var $seller;
	var $special;
	var $en_name;
	var $en_keyword;
	var $quantity;
	# Constructor
	function ProductInfo($quantity,$seller,$special,$en_name,$en_keyword,$sku, $slug, $name, $keyword, $description, $detail, $avatar, $price, $market_price, $currency, $viewed, $date_created, $updated, $position, $properties, $status, $home, $cat_id = 0, $store_id = 0, $id = 0)
	{
		$this->id = $id;
		$this->store_id = $store_id;
		$this->cat_id = $cat_id;
		$this->sku = stripslashes(htmlspecialchars($sku));
		$this->slug = stripslashes(htmlspecialchars($slug));
		$this->name = stripslashes(htmlspecialchars($name));
		$this->keyword = stripslashes(htmlspecialchars($keyword));
		$this->description = stripslashes(htmlspecialchars($description));
		$this->detail = stripslashes($detail);
		$this->avatar = $avatar;
		$this->price = $price;
		$this->market_price = $market_price;
		$this->currency = $currency;
		$this->viewed = $viewed;
		$this->date_created = $date_created;
		$this->updated = $updated;
		$this->position = $position;
		$this->properties = unserialize($properties);
		$this->status = $status;
		$this->home = $home;
		$this->seller=$seller;
		$this->special=$special;
		$this->en_name=$en_name;
		$this->en_keyword=$en_keyword;
		$this->quantity=$quantity;
	}

	function getSeller(){
		return $this->seller;
	}

	function getSpecial(){
		return $this->special;
	}
	function getQuantity(){
		return $this->quantity;
	}
	function getId() {
		return $this->id;
	}	
	function setId($nValue) {
		$this->id=$nValue;
	}
	function getStoreId() {
		return $this->store_id;
	}
	function setStoreId($nValue) {
		$this->store_id=$nValue;
	}
	function getCatId() {
		return $this->cat_id;
	}
	function setCatId($nValue) {
		$this->cat_id=$nValue;
	}
	function getCatSlug() {
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		$productCategories = new ProductCategories($this->store_id);
		return $productCategories->getSlugFromId($this->cat_id);
	}
	function getCatName() {
		include_once(ROOT_PATH."classes/dao/productcategories.class.php");
		$productCategories = new ProductCategories($this->store_id);
        if($this->cat_id==0)
		return $productCategories->getNameFromId($this->cat_id);
        else{
            $rootId = $productCategories->getParentIdFromId($this->cat_id);
            $nameRoot = $productCategories->getNameFromId($rootId);
            return $nameRoot." - ".$productCategories->getNameFromId($this->cat_id);
        }
	}
	function getSku() {
		return $this->sku;		
	}
	function setSku($nValue) {
		$this->sku=stripslashes($nValue);
	}
	function getSlug() {
		return $this->slug;		
	}
	function setSlug($nValue) {
		$this->slug=stripslashes($nValue);
	}
	function getName($lang='vn') {
		if($lang == 'vn')	return $this->name;
		return $this->en_name;	
	}
	
	function getKeyword($lang='vn') {
		if($lang == 'vn')	return $this->keyword;	
		return $this->en_keyword;		
	}
	
	function getDescription($lang='vn') {
	if($lang == 'vn')	return $this->description;
	elseif(isset($this->properties['custom_'.$lang.'_description'])) return $this->properties['custom_'.$lang.'_description'];
		}
	function setDescription($nValue,$lang='vn') {
		if($lang == 'vn')	$this->description=stripslashes($nValue);
		else  $this->properties['custom_'.$lang.'_description']=stripslashes($nValue);;	
	}
	function getDetail($lang='vn') {
		if($lang == 'vn')	return $this->detail;
		elseif(isset($this->properties['custom_'.$lang.'_detail'])) return $this->properties['custom_'.$lang.'_detail'];
	}
	function setDetail($nValue,$lang='vn') {
		
		if($lang == 'vn')$this->detail=stripslashes($nValue);
		else $this->properties['custom_'.$lang.'_detail']=stripslashes($nValue);;
	}
	function getAvatar() {
		$photos = $this->properties['photos'];
		if($photos) return $photos[0];
		return '';
	}
	function setAvatar($nValue) {
		$this->avatar=$nValue;
	}
	function getPrice() {
		return $this->price;
	}	
	function setPrice($nValue) {
		$this->price=$nValue;
	}
	function getMarketPrice() {
		return $this->market_price;
	}
	function setMarketPrice($nValue) {
		$this->market_price=$nValue;
	}
	function getCurrency() {
		return $this->currency;
	}	
	function setCurrency($nValue) {
		$this->currency=$nValue;
	}
	
	function getViewed() {
		return $this->viewed;
	}	
	function setViewed($nValue) {
		$this->viewed=$nValue;
	}
	function getDateCreated()
	{
		return $this->date_created;
	}
	function setDateCreated($nValue)
	{
		$this->date_created=$nValue;
	}
	function getUpdated()
	{
		return $this->updated;
	}
	function setUpdated($nValue)
	{
		$this->updated=$nValue;
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
	function getPosition() {
		return $this->position;
	}
	function setPosition($nValue) {
		$this->position = $nValue;
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
	function getHome() {
		return $this->home;
	}
	function setHome($nValue) {
		$this->home = $nValue;
	}
	function getStatusTextBackend() {
		global $amessages;
		return $amessages['status_product'][$this->status];
	}
	# Return 1 if File is not null
	function getNullFile($n) {
		for($i=1;$i<=$n;$i++){
		$key = "file".$i;
		if($this->$key!='')
			return 1;
		}
		return '';
	}
	function getUrl($lang = 'vn') {
		$url = '';
		if(URL_TYPE == 1) {	# Query string
			$url = '/'.SCRIPT.'?act=product&id='.$this->id;
			return $url;
		} elseif(URL_TYPE == 2) {	# SEO
			if($lang == 'vn')	$url = '/'.$this->getCatSlug().'/'.$this->slug.'-p'.$this->id.'.html';
			else $url = '/'.$lang.'/'.$this->getCatSlug().'/'.$this->slug.'-p'.$this->id.'.html';
			return $url;
		} else return '';	
	}
	function generalComboSizes(){
		include_once(ROOT_PATH.'classes/dao/sizes.class.php');
		$sizes= new Sizes();
		return $sizes->generateComboFromPid($this->id);
	}
	function getColors($only=0){
		include_once(ROOT_PATH.'classes/dao/albums.class.php');
		$albums = new Albums();
		$listAlbums = $albums->getObjects(1,"status=1 and pid=".$this->id,array(),100);
		if($only) return $listAlbums[0];
		return $listAlbums;
	}
    function getFinalPrice(){
        if($this->market_price >1000 && $this->market_price < $this->price){
            return $this->market_price;
        }else{
            return $this->price;
        }
    }
    function getColor($cid){
        include_once(ROOT_PATH.'classes/dao/albums.class.php');
		$albums = new Albums();
        $info = $albums->getObject($cid);
        if($info) return $info->getName();
        return "";
    }
    function getSize($sid){
        include_once(ROOT_PATH.'classes/dao/sizes.class.php');
		$sizes= new Sizes();
        $info = $sizes->getObject($sid);
        if($info) return $info->getName();
        return "";
    }
}	
?>