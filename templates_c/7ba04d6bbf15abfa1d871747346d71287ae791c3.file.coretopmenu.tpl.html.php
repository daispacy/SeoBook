<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:30:40
         compiled from "./templates/admin/coretopmenu.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:96985449155307e609a5185-21783927%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ba04d6bbf15abfa1d871747346d71287ae791c3' => 
    array (
      0 => './templates/admin/coretopmenu.tpl.html',
      1 => 1428722925,
    ),
  ),
  'nocache_hash' => '96985449155307e609a5185-21783927',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('authUser')->value){?>
<div id="nav">
<?php if ($_smarty_tpl->getVariable('authUser')->value){?><p class="datetime"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('hello');?>
 <a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=profile" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_profile');?>
"><strong><?php echo $_smarty_tpl->getVariable('authUser')->value->getFullname();?>
</strong></a> (<?php echo $_smarty_tpl->getVariable('authUser')->value->getUsername();?>
) [<?php echo $_smarty_tpl->getVariable('authUser')->value->getType();?>
]. [<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=logout" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('log_out');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('log_out');?>
</a>]</p><?php }?>
<ul id="listmenu">
<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=dashboard" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
</a></li>
<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_website');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_website');?>
</a></li>
<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
</a></li>
</ul>
</div>
<?php }else{ ?>
<div id="nav">
<ul id="listmenu">
<li><a href="/" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('home_page');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('home_page');?>
</a></li>
</ul>
</div>
<?php }?>