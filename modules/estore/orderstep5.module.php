<?php
/*************************************************************************
Module Order
----------------------------------------------------------------
DerCMS 3.0 Project
Company: Derasoft Co., Ltd
Coder: Tran Thi My Xuyen
Email: info@derasoft.com
Last updated: 05/06/2012
**************************************************************************/
include_once(ROOT_PATH."classes/data/validate.class.php");
include_once(ROOT_PATH."classes/dao/provinces.class.php");
include_once(ROOT_PATH."classes/dao/areas.class.php");
include_once(ROOT_PATH."classes/dao/orders.class.php");
include_once(ROOT_PATH."classes/dao/orderitems.class.php");

$validate = new Validate();
$provinces = new Provinces();
$areas = new Areas($sId);
$orders = new Orders($sId);

#Allow order config
$template->assign('orderRequireLogin',$estore->getProperty('order_require_login'));
$order_status = $estore->getProperty('order_status');
$template->assign('order_vat',$estore->getProperty('order_vat'));
$template->assign('order_hours',$estore->getProperty('order_hours'));
$template->assign('datePicker',1);
$plus = $request->element('plus','');
if($orderOn){
switch ($plus) {
	case 'confirmOrder':		
		# Customer needs to correct the information
		$provincesList = $provinces->createComboBox($request->element('province'));		
		if($provincesList) $template->assign('provincesList',$provincesList);
		        
		# Get province name & recipient's province name
		#$province = $provinces->getNameFromId($request->element('province'));
		#$rprovinceItem = $areas->getObject($request->element('rprovince'),'id',"status = 1");
		#$template->assign('province',$province);
		#if($rprovinceItem){
		#$template->assign('rprovince',$rprovinceItem->getName());
		#$template->assign('rprovinceItem',$rprovinceItem);
		#}
		
		# Get items in cart
		$cartItems = $carts->getObjects(1, '1>0', $sort = array('time_stamp' => 'desc'), 100);
		if($cartItems) $template->assign("cartItems",$cartItems);
        if(!$customerInfo)
		  $templateFile = 'orderstep2.tpl.html';
	     else
            $templateFile = 'orderstep3.tpl.html';
		$template->assign('order',$_REQUEST);
		$template->assign('plus',$plus);
		# Generate the navigation bar
		$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
		$navigationItems[] = array('name' => $messages['confirm_order'], 'url' => Url::genUrl('order',''), 'current' => '0');
		$template->assign('navigationItems',$navigationItems);
		break;    
	case 'editOrder':
		# Customer needs to correct the information
		$provincesList = $provinces->createComboBox($request->element('province'));
		$rProvincesList = $areas->generateCombo("status = 1", $request->element('rprovince'));
		if($provincesList) $template->assign('provincesList',$provincesList);
		if($rProvincesList)	$template->assign('rProvincesList',$rProvincesList);

		$templateFile = 'orderstep1.tpl.html';
		$template->assign('order',$_REQUEST);
		$template->assign('plus',1);
		# Generate the navigation bar
		$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
		$navigationItems[] = array('name' => $messages['order'], 'url' => Url::genUrl('order',''), 'current' => '0');
		$template->assign('navigationItems',$navigationItems);
		break;
	case 'submitOrder':
		if ($_POST){
				
			# Confirm the information before creating the order
				
				$customers = new Customers($storeId);
				$customerInfo = $customers->getObject($_SESSION['store_customerId'],'id');
				$listerror = validateData($request);
				$check = checkvalidate($listerror);
				if($check == 0){
				# Get items in cart
				$cartItems = $carts->getObjects(1, '1>0', $sort = array('time_stamp' => 'desc'), 100);
				if($cartItems) {
					if(isset($_SESSION['store_customerId'])) $userId = $_SESSION['store_customerId'];
					else $userId = '';
					# OK, create the new order
					$properties = array('');
					$properties['rday'] =$_SESSION['rday'];
					$fields = array('store_id'		=> $sId,
									'payment_id'	=> $_SESSION['payment'],
									'user_id'		=> $userId,
									'name'			=> $customerInfo->getFullName(),
									'email'			=> $customerInfo->getEmail(),
									'address'		=> $customerInfo->getAddress(),
									'province'		=> $customerInfo->getAreaId(),
									'tel'			=> $customerInfo->getTel(),
									'cell'			=> $customerInfo->getTel(),
									'rname'			=> $_SESSION['rname'],
									'raddress'		=> $_SESSION['raddress'],
									'rprovince'		=> $_SESSION['rprovinceid'],
									'rtel'			=> $_SESSION['rtel'],
									'rcell'			=> $_SESSION['rtel'],
									'rdate'			=> date("Y-m-d H:i:s",strtotime($_SESSION['rdate'])),
									'rnote'			=> $_SESSION['rnote'],
									'created'		=> date("Y-m-d H:i:s"),
									'updated'		=> '',
									'properties'	=> serialize($properties),
									'status'		=> $order_status
									);
									
					$orderId = $orders->addData($fields);
					$order = $orders->getObject($orderId);
					$template->assign('order',$order);

					# Then create the order items
					$orderItems = new OrderItems($orderId);
					$products = new Products($sId);
					foreach ($cartItems as $cartItem) {
						$product = $products->getObject($cartItem->getProductId());
						$fields = array('order_id'		=> $orderId,
										'product_id'	=> $cartItem->getProductId(),
										'name'			=> $product->getName(),
										'quantity'		=> $cartItem->getQuantity(),
										'price'			=> $product->getPrice(),
										'properties'	=> ''				
										);
						$orderItems->addData($fields);
					}
					
					# Then empty the shopping cart
					unset($_SESSION['rname']);
					unset($_SESSION['raddress']);
					unset($_SESSION['rprovinceid']);
					unset($_SESSION['rtel']);
					unset($_SESSION['rdate']);
					unset($_SESSION['rnote']);
					unset($_SESSION['rprovinceid']);
					unset($_SESSION['payment']);
					unset($_SESSION['paymentname']);
					unset($_SESSION['rday']);
					$carts->emptyCart();
                    
					#Call to ORDERNEW addon
                    foreach($addons->getAddonFromEvent('ORDER_NEW') as $addon) {include_once(ROOT_PATH."addons/$addon/addon.php");}
					// Send email 
					include_once(ROOT_PATH.'classes/dao/emails.class.php');
					$emails = new Emails($sId);
					$emailItem = $emails->getObject('ORDER_CONFIRMATION','name',"status = 1");
						if($emailItem){
							$tokens = explode(',',$emailItem->getTokens()); 
							$bodyEmail = $emailItem->getContent();
							$subjectEmail = $emailItem->getTitle();
							foreach($tokens as $token){
								$subjectEmail = str_replace("{".$token."}",'%s',$subjectEmail);
								$bodyEmail = str_replace("{".$token."}",'%s',$bodyEmail); 
								
							}
						}else{
							$subjectEmail = $messages["order_email_title"];
							$bodyEmail = $messages["order_email_body"];
						}
			
					$adminEmail = $estore->getEmail();
					$cell = $customerInfo->getTel();
					$url_2 = DOMAIN."/orderinfo/$cell/$orderId.html";
					$template->assign("url_2",$url_2);
					
					# Send mail
					/*if(SMTP_MAIL) {	# Use SMTP Mail
						include_once(ROOT_PATH."classes/mail/smtp.class.php");
						include_once(ROOT_PATH."classes/sasl/sasl.class.php");			
						$smtp = new SmtpMail;
						$smtp->SendMessage($adminEmail,array($_REQUEST['email']),array("From: $adminEmail","To: ".$_REQUEST['email'],"Cc: $adminEmail","Subject: ".$messages["order_email_title"],"Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")),$body);
					} else { */# Use Sendmail
						$from = $adminEmail;
						$To = $adminEmail;
						$To1 = $customerInfo->getEmail();
						$subject =  sprintf($subjectEmail,DOMAIN);
						$body = sprintf($bodyEmail,$customerInfo->getFullName(),DOMAIN,$orderId,$customerInfo->getTel(),$url_2,DOMAIN);
						$header = "Content-type: text/html; charset=utf-8\r\nFrom: $from\r\nReply-to: $from";
						$ok = mail($To,$subject,$body,$header);
						$ok2 = mail($To1,$subject,$body,$header);
					//}
					
					# Notice to the customer					
					$template->assign('orderId',$orderId);
					$template->assign('url_2',$url_2);					
					$template->assign('email',$request->element('email'));
					$templateFile = 'ordersuccess.tpl.html';
					#unset(session_id());
					unset($_SESSION['rand_code']);
				} else {
					# Generate the navigation bar
					$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
					$navigationItems[] = array('name' => $messages['order_error'], 'url' => Url::genUrl('order',''), 'current' => '0');
					$template->assign('navigationItems',$navigationItems);
					$templateFile = 'ordererror.tpl.html';
				}
		}
		else{
				$products = new Products($sId);
				#$order = $orders->getObject($orderId);
				#$template->assign('order',$order);
				$template->assign("products",$products);
				$template->assign('listerror',$listerror);
				$cartItems = $carts->getObjects(1, '1>0', $sort = array('time_stamp' => 'desc'), 100);
				if($cartItems) $template->assign("cartItems",$cartItems);
				$templateFile = 'orderstep4.tpl.html';
			}
		}
		break;
		case 'paymentOrder':
		if ($_POST){
			#$orders = new Orders($sId);
			$oId = $request->element('oId');
			$orderCode = $request->element('orderCode');
			$url_2 = $request->element('url_2');
			$payment = $request->element('payment');
			$properties['payment'] = $payment;
			#$payment = $messages['payment'][$payment];
			#$orders->updateData(array('properties'=>serialize($properties)), $oId);
			$templateFile = "orderstep3.tpl.html";
			$template->assign("oId",$oId);
			$template->assign("orderCode",$orderCode);
			$template->assign("url_2",$url_2);
			$request->element('rdate');
		}
		break;
		
	default:
		$templateFile = 'order.tpl.html';
		# At the beginning
		// list Province
		if(isset($_SESSION['store_customerId']) && $_SESSION['store_customerId']!= NULL)	$provincesList = $provinces->createComboBox( $customerInfo->getProperty('province'));
		else	$provincesList = $provinces->createComboBox();
		if($provincesList) $template->assign('provincesList',$provincesList);
		// List RProvince
		$rprovincesList = $areas->generateCombo("status = 1");
		if($rprovincesList)	$template->assign('rProvincesList',$rprovincesList);
		
		# Generate the navigation bar
		$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
		$navigationItems[] = array('name' => $messages['order'], 'url' => Url::genUrl('order',''), 'current' => '0');
		$template->assign('navigationItems',$navigationItems);
		break;
}
}else{	$templateFile = 'note.tpl.html';
# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => $messages['order'], 'url' => Url::genUrl('order',''), 'current' => '0');
$template->assign('navigationItems',$navigationItems);
}
# Ham kiem tra du lieu nguoi dung nhap vao
function checkvalidate($validate){
	foreach($validate as $check){
		if($check != NULL)
			return 1;
	}
	return 0;
}	
# Ham kiem tra du lieu nguoi dung nhap vao
function validateData($request) {
	global $messages;
	$error = array();
	$validate = new Validate();
	if(strtolower($request->element('code'))!= strtolower($_SESSION['rand_code'])) $error['code'] = $messages['invalid_security_code'];
	else $error['code'] = NULL;
	return $error;
}
?>