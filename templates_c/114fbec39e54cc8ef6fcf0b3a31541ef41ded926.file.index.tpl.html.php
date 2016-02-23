<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:42:29
         compiled from "./templates/admin/index.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:176787839955308125601f87-53623657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '114fbec39e54cc8ef6fcf0b3a31541ef41ded926' => 
    array (
      0 => './templates/admin/index.tpl.html',
      1 => 1428722925,
    ),
  ),
  'nocache_hash' => '176787839955308125601f87-53623657',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coreheader.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="main">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/coreleft.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'top'-'menu'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div id="content">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corenavigation.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','navigation'-'bar'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="innerContent">
<div class="icons">
<ul>
<!--<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_order');?>
"><img alt="" src="templates/admin/images/icon_01.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_order');?>
</a></p></li>-->
<!--<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=customer" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_customer');?>
"><img alt="" src="templates/admin/images/icon_02.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_customer');?>
</a></p></li>-->
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('product');?>
"><img alt="" src="templates/admin/images/icon_03.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('product');?>
</a></p></li>
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('posts');?>
"><img alt="" src="templates/admin/images/icon_04.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('posts');?>
</a></p></li>
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_static');?>
"><img alt="" src="templates/admin/images/icon_05.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_static');?>
</a></p></li>
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('web_menu');?>
"><img alt="" src="templates/admin/images/icon_06.png" width="80" height="80" /><br />&nbsp;<?php echo $_smarty_tpl->getVariable('locale')->value->msg('web_menu');?>
</a></p></li>
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('ads');?>
"><img alt="" src="templates/admin/images/icon_07.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('ads');?>
</a></p></li>
<!--<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=gallery" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('gallery');?>
"><img alt="" src="templates/admin/images/icon_08.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('gallery');?>
</a></p></li>-->
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('support');?>
"><img alt="" src="templates/admin/images/icon_11.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('support');?>
</a></p></li>
<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=comment" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('comment');?>
"><img alt="" src="templates/admin/images/icon_12.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('comment');?>
</a></p></li>
<!--<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=poll" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_poll');?>
"><img alt="" src="templates/admin/images/icon_13.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_poll');?>
</a></p></li>-->
<!--<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=weblink" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_weblink');?>
"><img alt="" src="templates/admin/images/icon_14.png" width="80" height="80" /><br /> &nbsp;<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_weblink');?>
</a></p></li>-->

<li><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
"><img alt="" src="templates/admin/images/icon_9.png" width="80" height="80" /><br /><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
</a></p></li>   
<!--<li class="last"><p><a target="_blank" href="/" title="Trợ giúp"><img alt="" src="templates/admin/images/icon_11.png" width="80" height="80" /><br />Trợ giúp</a></p></li>-->
</ul>
</div>
</div>
</div>
</div>
</div>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corefooter.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site'-'footer'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>