<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-21 10:16:33
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/header.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:8846112805535c1119ce1b4-91743401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '049421a0273e805b9f46612d5c250c2558aa9cae' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/header.tpl.html',
      1 => 1429586188,
    ),
  ),
  'nocache_hash' => '8846112805535c1119ce1b4-91743401',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_strip_tags')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.strip_tags.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.regex_replace.php';
?><!DOCTYPE html>
<!--[if lt IE 7]> <html dir="ltr" lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7]>    <html dir="ltr" lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8]>    <html dir="ltr" lang="en-US" class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en"> <!--<![endif]-->


<!-- BEGIN head -->
<head>

	<!--Meta Tags-->
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
	<meta name="robots" content="index, follow" />
	<meta name="keywords" content="<?php if ($_smarty_tpl->getVariable('pageKeywords')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageKeywords')->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getKeywords();?>
<?php }?>" />
	<meta name="description" content="<?php if ($_smarty_tpl->getVariable('pageDescription')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageDescription')->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }?>" />
	<title><?php if ($_smarty_tpl->getVariable('pageTitle')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageTitle')->value);?>
 - <?php }?><?php echo $_smarty_tpl->getVariable('estore')->value->getName();?>
</title>
	<!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->
	
    <meta name="author" content="">
	<meta property="og:title" content="<?php if ($_smarty_tpl->getVariable('pageTitle')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageTitle')->value);?>
 - <?php }?><?php if ($_smarty_tpl->getVariable('act')->value!='restaurant'){?><?php echo $_smarty_tpl->getVariable('messages')->value['web_title'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('messages')->value['site_name'];?>
<?php }?><?php if ($_smarty_tpl->getVariable('pageFix')->value){?> - <?php echo $_smarty_tpl->getVariable('pageFix')->value;?>
<?php }?>" />
	<meta property="og:type" content="website" />    
	<meta property="og:url" content="<?php echo $_smarty_tpl->getVariable('url_link')->value;?>
" />
	<meta property="og:site_name" content="<?php echo $_smarty_tpl->getVariable('site')->value;?>
" />
	<meta property="og:description" content="<?php if ($_smarty_tpl->getVariable('pageDescription')->value){?><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('pageDescription')->value);?>
 - <?php }?><?php echo $_smarty_tpl->getVariable('messages')->value['web_description'];?>
<?php if ($_smarty_tpl->getVariable('pageFix')->value){?> - <?php echo $_smarty_tpl->getVariable('pageFix')->value;?>
<?php }?>" />
	<meta property="og:image:width" content="230"/>
	<meta property="og:image:height" content="230"/>
	  <?php if ($_smarty_tpl->getVariable('act')->value!='static'){?>
		<meta property="og:image" content="http://<?php echo $_smarty_tpl->getVariable('domain')->value;?>
<?php if ($_smarty_tpl->getVariable('estore')->value){?>/gallery/0/resources/l_<?php echo smarty_modifier_regex_replace($_smarty_tpl->getVariable('estore')->value->getProperty('avatar'),'/( )/','%20');?>
<?php }elseif($_smarty_tpl->getVariable('objectItem')->value){?>/gallery/0/resources/l_<?php echo smarty_modifier_regex_replace($_smarty_tpl->getVariable('objectItem')->value->getProperty('avatar'),'/( )/','%20');?>
<?php }else{ ?>/gallery/0/resources/<?php echo $_smarty_tpl->getVariable('logo')->value;?>
<?php }?>" /> 
	<?php }?>

	<!--Stylesheets-->
	<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/superfish.css" type="text/css"  media="all" />
	<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/prettyPhoto.css" type="text/css" media="all" />
	<link type="text/css" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/jquery.ui.datepicker.css" rel="stylesheet" />
	<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/style.css?v=47" type="text/css"  media="all" />
	<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/responsive.css?v=1" type="text/css"  media="all" />
	<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/flexslider.css" type="text/css"  media="all" />
	<link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/colours/green.css" type="text/css"  media="all" />	
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/slimbox2.css" type="text/css"  media="all" />       
    <link rel="stylesheet" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/css/product.css" type="text/css"  media="all" />        
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700' rel='stylesheet' type='text/css'>

	<!--Favicon-->
	<link rel="shortcut icon" href="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/favicon.ico?v=1" type="image/x-icon" />

	<!--JavaScript-->
	<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery.min.js"></script>
	<script type='text/javascript' src='/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery-ui.min.js'></script>
    <script type='text/javascript' src='/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/superfish.js'></script>
	<script type='text/javascript' src='/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery.prettyPhoto.js'></script>
	<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery.flexslider-min.js"></script>
    <?php if ($_smarty_tpl->getVariable('act')->value=='product'){?>    
        <script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery.zoom.js"></script>
    <?php }?>
	<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/scripts.js?v=12"></script>
	
    
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/selectivizr-min.js"></script>
	<![endif]-->
    <div id="fb-root"></div>

<!--
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=357713597593501";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61953134-1', 'auto');
  ga('send', 'pageview');

</script>


<!-- END head -->
</head>

<!-- BEGIN body -->
<body>
	
	<!-- BEGIN .wrapper -->
	<div class="wrapper">
		
		<!-- BEGIN .topbar -->
		<div class="topbar clearfix">
			
			<!-- BEGIN .social-icons -->
			<ul class="social-icons">
			
				<li><a href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('link_fb');?>
"><span id="facebook_icon"></span></a></li>
				<li><a href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('link_gg');?>
"><span id="googleplus_icon"></span></a></li>
			
			<!-- END .social-icons -->
			</ul>
			
			<!-- BEGIN .topbar-right -->
			<div class="topbar-right clearfix">
				
				<ul class="clearfix">
					<li><a href="/"><img width="100px" height="auto" src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('store_logo');?>
" /></a></li>					
				</ul>

			</div>
            <div class="topbar-right clearfix">
				
				<ul class="clearfix">
					<li><a href="/"><?php echo $_smarty_tpl->getVariable('estore')->value->getName();?>
</a></li>					
				</ul>

			</div>
		<!-- END .topbar -->
		</div>
		
		<!-- BEGIN #site-title 
		<div id="site-title">
			<a href="/">
				<img width="130px" height="auto" src="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('store_logo');?>
" />                            
			</a>
  	        <a href="/">				  
                <h1><?php echo $_smarty_tpl->getVariable('estore')->value->getName();?>
</h1>             
			</a>
            
		
		</div>-->
		
		<!-- BEGIN .main-menu-wrapper -->
		<div id="main-menu-wrapper" class="clearfix">
			
			<ul id="main-menu" class="fl">
                <?php if ($_smarty_tpl->getVariable('menuItems')->value[2]){?>
                <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuItems')->value[2][0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['menu']->key;
?>            
             <?php $_smarty_tpl->assign('submenuId',$_smarty_tpl->tpl_vars['menu']->value['id'],null,null);?>
             <?php $_smarty_tpl->assign('children','',null,null);?>
                    
                    <li <?php if (isset($_smarty_tpl->getVariable('menId')->value)&&$_smarty_tpl->getVariable('menId')->value>0){?><?php if ($_smarty_tpl->getVariable('menId')->value==$_smarty_tpl->tpl_vars['menu']->value['id']){?> class="current_page_item" <?php }?> <?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['i']->value==0){?> class="current_page_item" <?php }?><?php }?>><a title="<?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['id']==41){?>
                    <?php if ($_smarty_tpl->getVariable('productCategoryItems')->value){?>
                    <ul>
                        
                        <?php  $_smarty_tpl->tpl_vars['itemRoot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productCategoryItems')->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemRoot']->key => $_smarty_tpl->tpl_vars['itemRoot']->value){
?>
                        <?php $_smarty_tpl->assign('itemRootId',$_smarty_tpl->tpl_vars['itemRoot']->value['id'],null,null);?>
                        <?php $_smarty_tpl->assign('children','',null,null);?>
                        <?php if (isset($_smarty_tpl->getVariable('productCategoryItems')->value[$_smarty_tpl->getVariable('itemRootId')->value])){?>
                        <?php $_smarty_tpl->assign('children',$_smarty_tpl->getVariable('productCategoryItems')->value[$_smarty_tpl->getVariable('itemRootId')->value],null,null);?>
                        <?php }?>                        
                         <li><a href="<?php echo $_smarty_tpl->tpl_vars['itemRoot']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['itemRoot']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemRoot']->value['name'];?>
</a>
                            <?php if ($_smarty_tpl->getVariable('children')->value){?>
                            <ul>
                            <?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('children')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
?>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['child']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['child']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value['name'];?>
</a>
                            <?php }} ?>
                            </ul>
                            <?php }?>
                         </li>
                        
                         <?php }} ?>
                    </ul>
                    <?php }?>
                    <?php }?>
                    </li>
                <?php }} ?>
                <?php }?>
                <!--
				<li class="current_page_item"><a href="index.html">Home</a></li>
				<li><a href="products.html">Products</a>
					<ul>
						<li><a href="product-single.html">Cleansers</a></li>
						<li><a href="product-single.html">Exfoliators &amp; Masks</a></li>
						<li><a href="product-single.html">Toners</a></li>
						<li><a href="product-single.html">Moisturisers</a>
							<ul>
								<li><a href="product-single.html">Hands</a></li>
								<li><a href="product-single.html">Face</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="blog.html">Blog</a></li>
				<li><a href="testimonials.html">Testimonials</a></li>
				<li><a href="typography.html">About</a>
					<ul>
						<li><a href="typography.html">Typography</a></li>
						<li><a href="js-elements.html">JS Elements</a></li>
					</ul>
				</li>
				<li><a href="contact.html">Contact</a></li>	
                -->
			</ul>
			
			<form method="post" action="/" id="menu-search" class="fr">
				<input type="hidden" value="search" name="act" />
                <input type="text"  value="<?php if (isset($_smarty_tpl->getVariable('kw')->value)&&$_smarty_tpl->getVariable('kw')->value){?><?php echo $_smarty_tpl->getVariable('kw')->value;?>
<?php }else{ ?>Tìm sản phẩm<?php }?>" onFocus="if(this.value == 'Tìm sản phẩm') {this.value=''}" onBlur="if(this.value == ''){this.value ='Tìm sản phẩm'}" name="kw" />
			</form>
		
		<!-- END .main-menu-wrapper -->	
		</div>