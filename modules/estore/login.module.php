<?php
/*************************************************************************
Login module
----------------------------------------------------------------
Derasoft CMS Project
Company: Derasoft Co., Ltd                                  
Email: info@derasoft.com                                    
**************************************************************************/
$templateFile = "register.tpl.html";
$error ='';
$infoClass = "infoText";
$template->assign('infoClass',$infoClass);

$plus= $request->element('plus','');
$template->assign('plus',$plus);
if($_POST) {
	$username = trim($request->element("username"));
	$password = trim($request->element("password"));
	
	$userId = $customers->authenticateUser($username,$password);
	if($userId) {
	   
		$_SESSION['store_customerId'] = $userId;
		if ($plus == 'loginOrder'){
			header("location: /$lang/orderstep3.html");
		}
		else if($plus == 'loginIndex')
		{header("location: /$lang");}
		else{
			if (URL_TYPE==1)
				header('location:/'.$lang.'/cart.html');
			else
				header("location:/$lang/register.html");
		}
	} else {
            if ($plus == 'loginOrder'){
                $template->assign('isOrder',1);
            }
			$_SESSION['store_customerId'] = 0;
			$error = $messages['login_error'];
			$infoClass = 'error';
			$template->assign('infoClass',$infoClass);
	}
	$template->assign('error',$error);	
    print_r($error);
}
# Generate the navigation bar
$navigationItems[] = array('name' => $estore->getName(), 'url' => '/', 'current' => '0');
$navigationItems[] = array('name' => $messages['login'], 'url' => '', 'current' => '1');
$template->assign('navigationItems',$navigationItems);
# Page title, keywords, description
$pageTitle = $messages['login'];
?>