<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-18 15:40:00
         compiled from "./templates/organicshop/ajax_producttooltip.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:175741176655321860e0e1f4-68248230%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a3333f4189010a6d0ac21a483c0a35d71900a4b' => 
    array (
      0 => './templates/organicshop/ajax_producttooltip.tpl.html',
      1 => 1429346380,
    ),
  ),
  'nocache_hash' => '175741176655321860e0e1f4-68248230',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
            <!--<span><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</span>-->
          	<span class="title"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</span>
            <?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><span class="price"> Giá: <?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
 VND</span><?php }?>
            <span><?php echo $_smarty_tpl->getVariable('item')->value->getDescription();?>
</span>
        </div>
		<?php }} ?>