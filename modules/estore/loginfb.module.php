<?php
/*************************************************************************
Login module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com     
Code: PhanTom                               
**************************************************************************/

$templateFile = "register.tpl.html";
$Url=$_SERVER['REQUEST_URI'];
$position=strpos ($_SERVER['REQUEST_URI'],'?code=');
if($position){
    
$app_id = 254272471399192;
$app_secret = '648b02d54de8385008f2c48ef504dd26';
$redirect_uri = urlencode("http://www.maramara.vn/loginfb.html");
$code=substr($_SERVER['REQUEST_URI'],$position+6);


// Get access token info
 $facebook_access_token_uri = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&redirect_uri=$redirect_uri&client_secret=$app_secret&code=$code";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
$response = curl_exec($ch);
curl_close($ch);
// Get access token
$aResponse = explode("&", $response);
$access_token = str_replace('access_token=', '', $aResponse[0]);
// Get user infomation
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?fields=id,name,email,birthday,location&access_token=$access_token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
$response = curl_exec($ch);
curl_close($ch);
$user = json_decode($response);



$birthday=$user->birthday;
$email=$user->email;
$name=$user->name;
$username=$user->email;
$location=$user->location;
# check duplicate customer email
if(!$customers->checkDuplicate($email,'email')) {
			# Check if duplicate slug
            $i = 0;
		    $dup = 1;
		    while($dup) {
			$dup = $customers->checkDuplicate($username.($i?'-'.$i:''),'username');
			if($dup) $i++;
			else $dup=0;
		     }
		    $username = $username.($i?'-'.$i:'');
	        # Password
			$pass= str_replace('/','', $birthday);
			$password = md5($pass);
			#Property 
			$properties = array('');
			$properties = array('password' => $pass);
			# End property
			$data = array('store_id' => $storeId,
						  'username' => $username,
						  'password' => $password,
						  'fullname' => $name,
						  'address' => $location->name,
						  'email' => $email,
						  'properties' => serialize($properties),
						  'date_created' => date("Y-m-d H:i:s"),
                          'last_login'=>date("Y-m-d H:i:s"),
						  'status' => 1);
			$newId = $customers->addData($data);
			
			
			 $_SESSION['store_customerId'] = $newId;
			
}else{#isset account
	 $userId=$customers->getIdFromEmail($email);
     $customers->updateData(array('last_login'=>date("Y-m-d H:i:s")),$userId);
     $_SESSION['store_customerId'] = $userId;
}

}
header('location: /orderstep3.html');
?>