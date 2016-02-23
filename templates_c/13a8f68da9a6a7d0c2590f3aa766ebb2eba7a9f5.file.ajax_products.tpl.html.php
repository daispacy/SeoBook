<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-18 15:40:00
         compiled from "./templates/organicshop/ajax_products.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:50368691355321860caeee8-84177642%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13a8f68da9a6a7d0c2590f3aa766ebb2eba7a9f5' => 
    array (
      0 => './templates/organicshop/ajax_products.tpl.html',
      1 => 1429346393,
    ),
  ),
  'nocache_hash' => '50368691355321860caeee8-84177642',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
<li class="col3">
		<?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?><?php if ($_smarty_tpl->getVariable('item')->value->getHome()||$_smarty_tpl->getVariable('item')->value->getSeller()){?><div class="<?php if ($_smarty_tpl->getVariable('item')->value->getHome()){?>offer<?php }elseif($_smarty_tpl->getVariable('item')->value->getSeller()){?>seller<?php }?>_icon"></div><?php }?><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" class="full-image product-image" data-tooltip="tooltip-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
"/></a><?php }?>
		<p class="product-title"><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</a></p>
        <!--<p class="product-price"><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</p>-->
		<?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><p class="product-price"><?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
</p><?php }?>
</li>
<?php }} ?>