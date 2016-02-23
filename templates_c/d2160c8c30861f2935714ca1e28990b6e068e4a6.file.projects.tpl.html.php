<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 13:21:15
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/projects.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:9749698905530a65b8fafd0-45630283%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2160c8c30861f2935714ca1e28990b6e068e4a6' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/projects.tpl.html',
      1 => 1429091320,
    ),
  ),
  'nocache_hash' => '9749698905530a65b8fafd0-45630283',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

		
		<!-- 
		<div class="section section-mini">
			<h2 class="site-intro"><?php if ($_smarty_tpl->getVariable('estore')->value->getDescription()){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }?></h2>
		 
		</div>-->
		
		<div class="section" style="padding: 0 30px;">
            <?php $_template = new Smarty_Internal_Template('navigation.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
        
       <!-- BEGIN .section -->
		<div class="section">
			
			<ul class="columns-content page-content clearfix">
				
                
				<!-- BEGIN .col-main -->
				<li class="col-main">
					<?php if ($_smarty_tpl->getVariable('projects')->value){?>
					<h2 class="page-title">Danh sách dự án</h2>

						<ul class="columns-3 clearfix product-list">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('projects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<li class="col3">
									<?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/projects/l_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
" class="full-image product-image" /></a><?php }?>
                					<p class="product-title"><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getTitle();?>
</a></p>
                				
							</li>
							<?php }} ?>
						</ul>
				        <?php }else{ ?>
                Dự án đang được cập nhật.
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