<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 13:21:36
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/news.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:5626144185530a670c78a74-67841081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a89f794dfebc6d75793d43c9eccae2c13110a96e' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/news.tpl.html',
      1 => 1429091287,
    ),
  ),
  'nocache_hash' => '5626144185530a670c78a74-67841081',
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
		
        <div class="section" style="padding: 0 30px;">
            <?php $_template = new Smarty_Internal_Template('navigation.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
       <!-- BEGIN .section -->
		<div class="section">
			
			<ul class="columns-content page-content clearfix">
            
				               
				<!-- BEGIN .col-main -->
				<li class="col-main">
					<?php if ($_smarty_tpl->getVariable('listItems')->value){?> 
					<h2 class="page-title">Danh sách tin tức</h2>

						
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<!-- BEGIN .blog-title -->
            					<div class="blog-title clearfix">
            						<div class="fl">
            							<h3><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
</a><span><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"%d-%m-%Y %H:%M");?>
</span></h3>
            						</div>
            						
            					<!-- END .blog-title -->
            					</div>
                                
                                <!-- BEGIN .blog-content -->
                				<div class="blog-content clearfix">
                					<div class="block-img1" style="overflow: hidden; height:  150px;"><img  src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/articles/l_<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('avatar');?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
" class="prev-image" /></div>
                					<p><?php echo $_smarty_tpl->getVariable('item')->value->getSapo();?>
</p>
                					<p><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" class="button2">Xem chi tiết</a></p>
                				<!-- END .blog-content -->
                				</div>
							<?php }} ?>
						
				<?php }else{ ?>
                Tin tức đang được cập nhật.
                <?php }?>
				<!-- END .col-main -->
				</li>
				
				<!-- BEGIN .col-sidebar -->
				<?php $_template = new Smarty_Internal_Template('right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				
			</ul>
			
		<!-- END .section -->
        
		</div>
        
<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>