<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-20 08:04:27
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/footer.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:3215255745534509b613060-55577411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a7c182d2d61f9868de5c81adcbc74faada7cf1c' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/footer.tpl.html',
      1 => 1429491830,
    ),
  ),
  'nocache_hash' => '3215255745534509b613060-55577411',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.date_format.php';
?>
  <div id="image-tooltip" class="stickytooltip">
      <div id="resultTool">
	  <?php if ($_smarty_tpl->getVariable('act')->value=='index'){?>
      <?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCateProducts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
?>
      <?php $_smarty_tpl->assign('products',$_smarty_tpl->getVariable('cate')->value->getAllProducts(),null,null);?>
      <?php if ($_smarty_tpl->getVariable('products')->value){?>
	  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['ii']->value = $_smarty_tpl->tpl_vars['item']->key;
?>	  
	  <?php $_smarty_tpl->assign('avatar',$_smarty_tpl->getVariable('item')->value->getAvatar(),null,null);?>
        <div id="tooltip-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="atip">
        	<img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
"/>
            
        </div>
		<?php }} ?>
        <?php }?>                
		<?php }} ?>
        <?php }?>
                                
	  <?php if ($_smarty_tpl->getVariable('act')->value=='products'||$_smarty_tpl->getVariable('act')->value=='search'){?>
	  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['ii']->value = $_smarty_tpl->tpl_vars['item']->key;
?>	  
	  <?php $_smarty_tpl->assign('avatar',$_smarty_tpl->getVariable('item')->value->getAvatar(),null,null);?>
        <div id="tooltip-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="atip">
        	<img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
"/>
            
        </div>
		<?php }} ?>        
        <?php }?>
        
        <?php if ($_smarty_tpl->getVariable('act')->value!='index'){?>
        <?php if ($_smarty_tpl->getVariable('productSeller')->value){?>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productSeller')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['ii']->value = $_smarty_tpl->tpl_vars['item']->key;
?>	  
        <?php $_smarty_tpl->assign('avatar',$_smarty_tpl->getVariable('item')->value->getAvatar(),null,null);?>
        <div id="tooltip-s<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="atip">
        	<img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
"/>
            <span><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</span>
          	<span class="title"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</span>
            <?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><span class="price"> Giá: <?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
 VND</span><?php }?>
            <span><?php echo $_smarty_tpl->getVariable('item')->value->getDescription();?>
</span>
            
        </div>
		<?php }} ?>
        <?php }?>
        <?php if ($_smarty_tpl->getVariable('productSpecial')->value){?>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['ii'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productSpecial')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['ii']->value = $_smarty_tpl->tpl_vars['item']->key;
?>	  
        <?php $_smarty_tpl->assign('avatar',$_smarty_tpl->getVariable('item')->value->getAvatar(),null,null);?>
        <div id="tooltip-d<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="atip">
        	<img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('avatar')->value;?>
"/>
            <!--
            <span><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</span>
          	<span class="title"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</span>
            <?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><span class="price"> Giá: <?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
 VND</span><?php }?>
            <span><?php echo $_smarty_tpl->getVariable('item')->value->getDescription();?>
</span>-->
            
        </div>
		<?php }} ?>
        <?php }?> 
        <?php }?>

      </div>
      <div class="stickystatus"></div>
  </div>

<div id="footer">
			
			<ul class="columns-3 clearfix">
				<li class="col3">
					
					<!-- BEGIN .widget -->
					<div class="widget">
						<div class="widget-title clearfix">
							<h6><?php echo $_smarty_tpl->getVariable('estore')->value->getName();?>
</h6>
						</div>
						
						<ul>
                            <?php if ($_smarty_tpl->getVariable('estore')->value->getAddress()){?><li class="contact-addr"> <?php echo $_smarty_tpl->getVariable('estore')->value->getAddress();?>
</li><?php }?>
							<?php if ($_smarty_tpl->getVariable('estore')->value->getTel()){?><li class="contact-phone"> <?php echo $_smarty_tpl->getVariable('estore')->value->getTel();?>
</li><?php }?>
                            <?php if ($_smarty_tpl->getVariable('estore')->value->getCell()){?> <li class="contact-phone"><?php echo $_smarty_tpl->getVariable('estore')->value->getCell();?>
</li><?php }?>
							<li class="contact-mail"><a href="mailto:<?php echo $_smarty_tpl->getVariable('estore')->value->getEmail();?>
"><?php echo $_smarty_tpl->getVariable('estore')->value->getEmail();?>
</a></li>
						</ul>
						
					<!-- END .widget -->
					</div>
					
				</li>
                
				<li class="col3">
					
					
					<div class="widget">
                    
						<div class="widget-title clearfix">
							<h6>Chuyên mục Sản phẩm</h6>
						</div>
						
						<ul>
							<?php if ($_smarty_tpl->getVariable('productCategoryItems')->value){?>
                            <?php  $_smarty_tpl->tpl_vars['itemRoot'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productCategoryItems')->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['itemRoot']->key => $_smarty_tpl->tpl_vars['itemRoot']->value){
?>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['itemRoot']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['itemRoot']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemRoot']->value['name'];?>
</a></li>
                            <?php }} ?>
                            <?php }?>
						</ul>
					
					
					</div>
				
				</li>
			
                
				<li class="col3">
					
					<!-- BEGIN .widget -->
					<div class="widget">
						<div class="widget-title clearfix">
							<h6>Facebook</h6>
						</div>
						
						<div class="flickr_badge_wrapper clearfix">
							<fb:like-box href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('link_fb');?>
" colorscheme="light" show_faces="false" header="false" stream="false" show_border="false"></fb:like-box>
							<div style="clear:both;margin:0 0 10px 0;"></div>
							<p class="button2"><a href="<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('link_fb');?>
">Xem tất cả &raquo;</a></p>
						</div>
						
					<!-- END .widget -->
					</div>
					
				</li>
			</ul>
		
		<!-- END #footer -->
		</div>
		
		<div id="footer-bottom" class="clearfix">
			
			<div class="fl">
				<?php if ($_smarty_tpl->getVariable('menuItems')->value[2]){?>
                <ul>
                <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuItems')->value[2][0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['menu']->key;
?>                 
                    <li ><a title="<?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a></li>								                                        
                <?php }} ?>
                </ul>
                <?php }?>
				
				
				<p>Copyright &copy; <?php echo smarty_modifier_date_format(time(),'%Y');?>
 <?php echo $_smarty_tpl->getVariable('estore')->value->getName();?>
, All rights reserved.<br>
					Powered by <a target="_blank" href="http://<?php echo $_smarty_tpl->getVariable('domain')->value;?>
"><?php echo $_smarty_tpl->getVariable('domain')->value;?>
</a></p>
				
			</div>
			
		
			
		</div>
			
	<!-- END .wrapper -->
	</div>
	
<!-- END body -->
</body>
</html>