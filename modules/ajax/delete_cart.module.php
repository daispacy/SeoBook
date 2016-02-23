<?php
    $id = $request->element('id');
    $sId = $request->element('sid');
    $sessId = $request->element('ssid');
    include_once(ROOT_PATH.'classes/dao/carts.class.php');
    $carts = new Carts($sId, $sessId);        
    if($id){
        $carts->deleteData($id);
        echo number_format($carts->getTotalCart()).'|'.$carts->getNumItemsInCart();
    }
?>