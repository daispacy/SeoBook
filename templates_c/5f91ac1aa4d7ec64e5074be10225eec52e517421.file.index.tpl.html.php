<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-21 10:56:20
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/index.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:7281744755535ca64911de7-30178662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f91ac1aa4d7ec64e5074be10225eec52e517421' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/index.tpl.html',
      1 => 1429588575,
    ),
  ),
  'nocache_hash' => '7281744755535ca64911de7-30178662',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php if (isset($_smarty_tpl->getVariable('adItems')->value)&&$_smarty_tpl->getVariable('adItems')->value){?>
<?php if ($_smarty_tpl->getVariable('adItems')->value[1]){?>
<div class="slider slide-loader clearfix">
	<ul class="slides">
        <?php  $_smarty_tpl->tpl_vars['ad'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('adItems')->value[1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['ad']->key => $_smarty_tpl->tpl_vars['ad']->value){
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['ad']->key;
?>
        <?php $_smarty_tpl->assign('url_logo',$_smarty_tpl->tpl_vars['ad']->value['url_logo'],null,null);?>
        <?php $_smarty_tpl->assign('url_logo_type',$_smarty_tpl->tpl_vars['ad']->value['url_logo_type'],null,null);?>
        <?php $_smarty_tpl->assign('logo',$_smarty_tpl->tpl_vars['ad']->value['logo'],null,null);?>
        <?php $_smarty_tpl->assign('logo_type',$_smarty_tpl->tpl_vars['ad']->value['logo_type'],null,null);?>
        <?php $_smarty_tpl->assign('width',$_smarty_tpl->tpl_vars['ad']->value['width'],null,null);?>
        <?php $_smarty_tpl->assign('height',$_smarty_tpl->tpl_vars['ad']->value['height'],null,null);?>
        <?php $_smarty_tpl->assign('url',$_smarty_tpl->tpl_vars['ad']->value['url'],null,null);?>
        <?php if ($_smarty_tpl->getVariable('url_logo_type')->value=='img'){?>
		<li>
			<?php if ($_smarty_tpl->getVariable('url')->value){?><a href="<?php echo $_smarty_tpl->getVariable('url')->value;?>
"><?php }?><img style="width:100%"  src="<?php if (isset($_smarty_tpl->getVariable('url_logo')->value)&&$_smarty_tpl->getVariable('url_logo')->value){?><?php echo $_smarty_tpl->getVariable('url_logo')->value;?>
<?php }else{ ?>/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/resources/l_<?php echo $_smarty_tpl->getVariable('logo')->value;?>
<?php }?>" /><?php if ($_smarty_tpl->getVariable('url')->value){?></a><?php }?>
            <!--
			<div class="flex-caption">
				<p>Endless summer deals</p>
				<div class="clearboth"></div>
				<p>Don't miss out!</p>
			</div>-->
		</li>
        <?php }?>
		<?php }} ?>
	</ul>
<!-- END .slider -->
</div>
<?php }?>
<?php }?>
		
		<!-- BEGIN .section -->
		<div class="section section-mini">
			<h2 class="site-intro"><?php if ($_smarty_tpl->getVariable('estore')->value->getDescription()){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }?></h2>
		<!-- END .section -->
		</div>
		
        <?php if ($_smarty_tpl->getVariable('listCateProducts')->value){?>
        <?php $_smarty_tpl->assign('i',0,null,null);?>
		<!-- BEGIN .section -->   
        <?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCateProducts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
?>   
        <?php $_smarty_tpl->assign('products',$_smarty_tpl->getVariable('cate')->value->getAllProducts(),null,null);?>  
        <?php if ($_smarty_tpl->getVariable('products')->value){?>
		<div class="section-mini2">
			
			<div class="tag-title-wrap clearfix">
				<a href="<?php echo $_smarty_tpl->getVariable('cate')->value->getUrl();?>
"><h4 class="tag-title"><?php echo $_smarty_tpl->getVariable('cate')->value->getName();?>
</h4></a>
			</div>			
			<ul class="columns-4 clearfix" id="sect<?php echo $_smarty_tpl->getVariable('i')->value;?>
">
                <?php  $_smarty_tpl->tpl_vars['pro'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pro']->key => $_smarty_tpl->tpl_vars['pro']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['pro']->key;
?>
				<li class="col4">
					<?php if ($_smarty_tpl->getVariable('pro')->value->getAvatar()){?>
                    <?php if ($_smarty_tpl->getVariable('pro')->value->getSpecial()||$_smarty_tpl->getVariable('pro')->value->getHome()||$_smarty_tpl->getVariable('pro')->value->getSeller()){?><div class="<?php if ($_smarty_tpl->getVariable('pro')->value->getSpecial()){?>deal<?php }elseif($_smarty_tpl->getVariable('pro')->value->getHome()){?>offer<?php }else{ ?>seller<?php }?>_icon"></div><?php }?>
                    <a href="<?php echo $_smarty_tpl->getVariable('pro')->value->getUrl();?>
"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('pro')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('pro')->value->getName();?>
" class="full-image product-image" data-tooltip="tooltip-<?php echo $_smarty_tpl->getVariable('pro')->value->getId();?>
"/></a>
                    
                    <?php }?>
					<p class="product-title"><a href="<?php echo $_smarty_tpl->getVariable('pro')->value->getUrl();?>
"><?php echo $_smarty_tpl->getVariable('pro')->value->getName();?>
</a></p>
                    <!--<p class="product-price"><?php echo $_smarty_tpl->getVariable('pro')->value->getCatName();?>
</p>-->
					<?php if ($_smarty_tpl->getVariable('pro')->value->getMarketPrice()){?><p class="product-price"><?php echo $_smarty_tpl->getVariable('pro')->value->getMarketPrice();?>
</p><?php }?>
					<!--<p class="product-button clearfix"><a href="cart.html" class="button2">Add to Cart &raquo;</a></p>-->
				</li>
				<?php }} ?>
			</ul>
           
			
		<!-- END .section -->
		</div>
        <?php $_smarty_tpl->assign('i',$_smarty_tpl->getVariable('i')->value+1,null,null);?>
        <?php }?>
        <?php }} ?>
        <?php }?>
        
        <?php if ($_smarty_tpl->getVariable('projectItems')->value){?>
        <!-- BEGIN .section -->        
		<div class="section-mini2">
			
			<div class="tag-title-wrap clearfix">
				<h4 class="tag-title">Dự án</h4>
			</div>
			
			<ul class="columns-4 clearfix">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('projectItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
				<li class="col4">
					<?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/projects/l_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
" class="full-image product-image" /></a><?php }?>
					<p class="product-title"><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
</a></p>
					
					<!--<p class="product-button clearfix"><a href="cart.html" class="button2">Add to Cart &raquo;</a></p>-->
				</li>
				<?php }} ?>
			</ul>
            
			
		<!-- END .section -->
		</div>
        <?php }?>
        
   
    <script>
    function realImgDimension(img) {
        var i = new Image();
        i.src = img.src;
        return {
            naturalWidth: i.width, 
            naturalHeight: i.height
        };
    }
    function setHeightLi4(){
        var i =0;
       $('.section-mini2').each(function(){
            var images = $(this).find("li").map(function() { 
                    //var realSize = realImgDimension(this);
                    return $(this).height(); 
                
                }).get();
            var maxValueInArray = Math.max.apply(Math, images);
            console.log(images);
            console.log(maxValueInArray);
            console.log(i);
            $("#sect"+ i +" li.col4").css("height",maxValueInArray);  
            i++;
        });
    }
    $(window).load(function(){
        
           setHeightLi4();
        
        
    });
    //var myImage = document.getElementById('myImage');
           //var myImage = document.getElementsByTagName('img');
            //myImage.addEventListener('load', function() {
                //var realSize = realImgDimension(this);
            	//console.log('My width is: ', realSize.naturalWidth);
            	//console.log('My height is: ', realSize.naturalHeight);
            //});
    </script>
    	

<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>