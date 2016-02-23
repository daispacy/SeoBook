<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:30:41
         compiled from "./templates/admin/corenavigation.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:87609303255307e61ab0760-03850448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c434801c7bf3d3a30fd9a7e995c24005815a7a71' => 
    array (
      0 => './templates/admin/corenavigation.tpl.html',
      1 => 1428722925,
    ),
  ),
  'nocache_hash' => '87609303255307e61ab0760-03850448',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('topNav')->value){?>
<ul class="breadcrumb">
<?php  $_smarty_tpl->tpl_vars['url'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('topNav')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['url']->total=count($_from);
 $_smarty_tpl->tpl_vars['url']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nav']['total'] = $_smarty_tpl->tpl_vars['url']->total;
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['url']->key => $_smarty_tpl->tpl_vars['url']->value){
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['url']->key;
 $_smarty_tpl->tpl_vars['url']->iteration++;
 $_smarty_tpl->tpl_vars['url']->last = $_smarty_tpl->tpl_vars['url']->iteration === $_smarty_tpl->tpl_vars['url']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['nav']['last'] = $_smarty_tpl->tpl_vars['url']->last;
?>
<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['nav']['last']){?><li class="last"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</li>
<?php }else{ ?><li><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</a></li>
<?php }?>
<?php }} ?>
</ul>
<?php }?>