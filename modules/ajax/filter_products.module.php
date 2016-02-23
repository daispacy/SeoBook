<?php
include_once(ROOT_PATH.'classes/dao/products.class.php');
include_once(ROOT_PATH.'classes/dao/productcategories.class.php');
$products = new Products(1);
$productCategories = new ProductCategories(1);

$cId = $request->element("cid");
$price = $request->element("price");
$sortR = $request->element("sort");
$size = $request->element("size");
$lang = $request->element("lang");
$slug = $request->element("slug");
$sort_key = 'created';
$sort_direction = 'desc';

$condition = "status = 1";
if($price){
    $prices = split(",",$price);
    $i=0;
    $condition.=" AND (";    
    foreach($prices as $pr){
        
        switch($pr){
            case 1:
                $condition.=" OR price <= '300000'";                 
            break;
            case 2:
                $condition.=" OR price BETWEEN '300000' AND '500000'";
            break;
            case 3:
                $condition.=" OR price BETWEEN '500000' AND '1000000'";
            break;
            case 4:
                $condition.=" OR price BETWEEN '1000000' AND '1500000'";
            break;
            case 5:
                $condition.=" OR price >= '1500000'";
            break;           
        }   
        if($i==0)$condition = str_replace("OR","",$condition);
        $i++;                    
    }
    $condition.=") ";
}


if($size){
    $sizes = split(",",$size);
    $ii=0;
    $condition1=" AND (id in (select distinct(pid) from dc_product_size where ";    
    foreach($sizes as $sr){               
        $condition1.=" OR sid = $sr";                                
        if($ii==0)$condition1 = str_replace("OR","",$condition1);
        $ii++;                    
    }
    $condition1.=")) ";
    $condition.=$condition1;
}

if($sortR){
    $sorts = split("_",$sortR);
    $sort_key = $sorts[0];
    $sort_direction = $sorts[1];
}

$sort = array($sort_key => $sort_direction);

$productItems=array();

if($cId){

# Product list		
$productCateInfo = $productCategories->getObject($cId);
		$allCid = $productCategories->getAllSubCategory($cId);
		if($allCid) $condition .= " and `cat_id` in ($allCid)";
		else $condition .= " AND `cat_id`='$cId'";
		
		       
		
		$ipp=$productCateInfo->getProperty('ipp');
		if(!$ipp) $ipp='9';

		# Get the product list
		$rowsPages = $products->getNumItems('id', $condition,$ipp);
		
		/// start page 
		$end = $page * $ipp;
		if($end > $ipp) $start  = $end -  $ipp +1;
		else $start = 1;
		if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
	
		/// end page
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];

		
		$productItems = $products->getObjects($page,$condition,$sort,$ipp);
		
		
		# Generate pager
		if($lang!='en') $url = "/$slug-c$cId/page-%d.html";
		else $url = "/$lang/$slug-c$cId/page-%d.html";
		$pager = LinkPage($url,$rowsPages['pages'],$page,5,'/templates/main/images/');
				
}else{
    
		if(!$ipp) $ipp='40';
		
		
		# Get the product list
		$rowsPages = $products->getNumItems('id', $condition,$ipp);
		
		/// start page 
		$end = $page * $ipp;
		if($end > $ipp) $start  = $end -  $ipp +1;
		else $start = 1;
		if($end > $rowsPages['rows']) $end = $rowsPages['rows'];
		
		/// end page
		if($page < 1) $page = 1;
		if($page > $rowsPages['pages']) $page = $rowsPages['pages'];

		
		$productItems = $products->getObjects(1,$condition,$sort,$ipp);
	
		
		# Generate pager
		if($lang!='en') $url = "/$slug-c$cId/page-%d.html";
		else $url = "/$lang/$slug-c$cId/page-%d.html";
		$pager = LinkPage($url,$rowsPages['pages'],$page,5,'/templates/main/images/');
}

if(is_array($productItems) && $productItems){
    $iii=0;
    $result="";
    foreach ($productItems as $item){
		$photos=$item->getProperty('photos');
		$result.='<li ';if ($iii%5==4)$result.='class="last"';$result.='>';
			if ($photos){
			$result.='<div class="img">';
				if ($item->getMarketPrice() > 1000){$result.='<div class="offer_icon"><p class="price">-'.number_format(($item->getPrice()-$item->getMarketPrice())/($item->getPrice())*100).'%</p></div>';}
				$result.='<a href="'.$item->getUrl($lang).'">
					<img src="/upload/1/products/m_'.$photos[0].'" alt="'.$item->getName($lang).'" width="175" height="215">
				</a>';
				if (count($photos)>1){
                $result.='<div class="product-slider" style="display: none;">';	
						foreach($photos as $photo){
                		$result.='<img src="/upload/1/products/l_'.$photo.'"  alt="'.$item->getName($lang).'" width="175" height="215" />';
						}                						
				$result.='</div>';				                
				}
			$result.='</div>';
			}
			$result.='<p class="product-title"><a href="'.$item->getUrl($lang).'">'.$item->getName($lang).'</a></p>
            <p class="product-price">';
            
			if ($item->getMarketPrice() > 1000){
			$result.='<span class="current">'.number_format($item->getMarketPrice()).' VND</span>
			<br>
            <span class="old">'.number_format($item->getPrice()).' VND</span>';
			}else{
			$result.='<span class="current">'.number_format($item->getPrice()).' VND</span>';
			}
		$result.='</p></li>';
        $iii++;
	}
    
    if ($rowsPages['pages'] > 1){
                    $paginate='<div class="paging clearfix">
                                    <div class="paging-inner">
                                        <ul>';
                                            $i=0;
    										foreach ($pager as $pageItem){
    											$paginate.='<li><a '; if ($pageItem['current'] == 1){$paginate.='class="current"';}elseif ($i == 0){$paginate.='class="paging_prev"';}elseif ($i == count($pager)-1){$paginate.='class="paging_next"';} $paginate.='href="'.$pageItem['url'].'" title="'.$pageItem['name'].'">'.$pageItem['name'].'</a></li>';
    										$i++;
                                            }
    										
                                        $paginate.='</ul>
                                    </div>
                                </div>';
    
    }
    
    echo $rowsPages['rows']."|".$result."|".$paginate;
}


?>