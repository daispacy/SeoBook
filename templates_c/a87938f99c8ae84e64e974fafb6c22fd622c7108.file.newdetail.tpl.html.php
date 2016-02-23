<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-20 07:14:43
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/newdetail.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1607194576553444f382e728-61111424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a87938f99c8ae84e64e974fafb6c22fd622c7108' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/newdetail.tpl.html',
      1 => 1429066557,
    ),
  ),
  'nocache_hash' => '1607194576553444f382e728-61111424',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.date_format.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

		
		<!-- BEGIN .section 
		<div class="section section-mini">
			<h2 class="site-intro"><?php if ($_smarty_tpl->getVariable('estore')->value->getDescription()){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }?></h2>
		 
		</div>
		-->
		
        <div class="section" style="padding: 0px 30px">
            <?php $_template = new Smarty_Internal_Template('navigation.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
       <!-- BEGIN .section -->
		<div class="section">
			
			<ul class="columns-content page-content clearfix">
            
				               
				<!-- BEGIN .col-main -->
				<li class="col-main">
					<?php if ($_smarty_tpl->getVariable('objectItem')->value){?> 
					<div class="blog-title-single clearfix">
						<div class="fl">
							<h2><?php echo $_smarty_tpl->getVariable('objectItem')->value->getTitle();?>
<span><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('objectItem')->value->getDateCreated(),"%d/%m/%Y %H:%M");?>
</span></h2>
						</div>						
					</div>
					<!-- END .blog-title-single -->
					
					<!-- BEGIN .blog-content -->
					<div class="blog-content clearfix">
						
						<p><?php echo $_smarty_tpl->getVariable('objectItem')->value->getDetails();?>
</p>
						
					<!-- END .blog-content -->
					</div>
				<?php }else{ ?>
                Tin tức không tồn tại.
                <?php }?>
				<!-- END .col-main -->
				</li>
				
				<!-- BEGIN .col-sidebar -->
				<li class="col-sidebar">
				    <!--
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Chuyên mục Sản phẩm</h4></div>
						<ul>
							<li><a href="#">Skin Care</a></li>
							<li><a href="#">Bath &amp; Body Care</a></li>
							<li><a href="#">Fragrance</a></li>
							<li><a href="#">Make-Up</a></li>
							<li><a href="#">Hair</a></li>
							<li><a href="#">Moisturisers</a></li>
						</ul>
					</div>-->
					<!--
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Tags</h4></div>
						<ul class="wp-tag-cloud clearfix">
							<li><a href="#">Tag #1</a></li>
							<li><a href="#">Tag #2</a></li>
							<li><a href="#">Tag #3</a></li>
							<li><a href="#">Tag #4</a></li>
							<li><a href="#">Tag #5</a></li>
							<li><a href="#">Tag #6</a></li>
						</ul>
					</div>
					-->
                    
                    <?php if ($_smarty_tpl->getVariable('articleotherItems')->value){?>
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Sản Phẩm Mới</h4></div>
						
						<ul class="latest-posts-list clearfix">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('articleotherItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<li class="clearfix">
                                <?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?>
								<div class="lpl-img">                                
									<a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" rel="bookmark">
										<img width="66" height="66" src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/l_<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('avatar');?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
" />
									</a>
								</div>
                                <?php }?>
								<div class="lpl-content">
									<h6>
                                        <a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" rel="bookmark"><?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
</a> 
                                        <span><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"%d/%m/%Y %H:%M");?>
</span>
                                    </h6>
								</div>
							</li>
                            <?php }} ?>																					
						</ul>
					
					</div>
					<?php }?>
				<!-- END .col-sidebar -->
				</li>
				
			</ul>
			
		<!-- END .section -->
        
		</div>
        
<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>