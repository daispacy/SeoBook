<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:41:47
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/navigation.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1124203831553080fb1f2473-45966117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f04aa52b365a2f6c32b170fe6bb4997065f898c3' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/navigation.tpl.html',
      1 => 1429008060,
    ),
  ),
  'nocache_hash' => '1124203831553080fb1f2473-45966117',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('navigationItems')->value){?>
<div id="pageName">
	<div class="name_tag">        
		<p>	
            <?php  $_smarty_tpl->tpl_vars['navigation'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navigationItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['navigation']->key => $_smarty_tpl->tpl_vars['navigation']->value){
?>
            <?php if ($_smarty_tpl->tpl_vars['navigation']->value['current']){?><?php echo $_smarty_tpl->tpl_vars['navigation']->value['name'];?>
<?php }else{ ?><a href="<?php if ($_smarty_tpl->tpl_vars['navigation']->value['url']){?><?php echo $_smarty_tpl->tpl_vars['navigation']->value['url'];?>
<?php }else{ ?>#<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['navigation']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['navigation']->value['name'];?>
</a> &raquo;<?php }?> 
            <?php }} ?>	            
            
		</p>		
	</div>
</div>
<?php }?>