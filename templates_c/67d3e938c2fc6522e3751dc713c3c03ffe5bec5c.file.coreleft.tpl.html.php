<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:30:40
         compiled from "./templates/admin/coreleft.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:21332040455307e60a6fb65-26026835%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67d3e938c2fc6522e3751dc713c3c03ffe5bec5c' => 
    array (
      0 => './templates/admin/coreleft.tpl.html',
      1 => 1428726819,
    ),
  ),
  'nocache_hash' => '21332040455307e60a6fb65-26026835',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_strip_tags')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.strip_tags.php';
?><?php if ($_smarty_tpl->getVariable('authUser')->value){?>
<div id="lev">
<div class="levInner">
<ul>
<li<?php if ($_smarty_tpl->getVariable('op')->value=='dashboard'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=dashboard" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('dash_board');?>
</a>
<?php if ($_smarty_tpl->getVariable('op')->value=='dashboard'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='online'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=dashboard&act=online" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('online_users');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('online_users');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('op')->value=='manage'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_website');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_website');?>
</a>
<?php if ($_smarty_tpl->getVariable('op')->value=='manage'){?>
<ul>
<!--
<li<?php if ($_smarty_tpl->getVariable('act')->value=='order'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_order');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_order');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='order'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=="all"){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=='3'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list&fiter_status=3"><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('amessages')->value['status_payment'][3]);?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=='4'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list&fiter_status=4"><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('amessages')->value['status_payment'][4]);?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=='5'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list&fiter_status=5"><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('amessages')->value['status_payment'][5]);?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=='6'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list&fiter_status=6"><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('amessages')->value['status_payment'][6]);?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=='7'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list&fiter_status=7"><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('amessages')->value['status_payment'][7]);?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('fiter_status')->value=='1'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=order&mod=list&fiter_status=1"><?php echo smarty_modifier_strip_tags($_smarty_tpl->getVariable('amessages')->value['status_payment'][1]);?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='customer'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=customer" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_customer');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_customer');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='customer'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=customer&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=customer&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<li<?php if ($_smarty_tpl->getVariable('act')->value=='product'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_product');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_product');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='product'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='addcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=addcategory<?php if ($_smarty_tpl->getVariable('pId')->value){?>&pId=<?php echo $_smarty_tpl->getVariable('pId')->value;?>
<?php }?>" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_product_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_product_category');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_product_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_category');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='size'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=size" title="Quản lý size">Quản lý size</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='project'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=project" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_project');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_project');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='project'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=project&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=project&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='article'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_article');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_article');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='article'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='addcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=addcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_article_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_article_category');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=article&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_article_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_article_category');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='static'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_static');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_static');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='static'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=static&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='menu'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_menu');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_menu');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='menu'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=menu&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_menu_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_menu_category');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='banner'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_banner');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_banner');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='ads'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listcategory'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=ads&mod=listcategory" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_banner_category');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_banner_category');?>
</a></li>
</ul>
<?php }?>
</li>
<!--<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=gallery" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_gallery');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_gallery');?>
</a></li>-->
<li<?php if ($_smarty_tpl->getVariable('act')->value=='support'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_support');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_support');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='support'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_support');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_support');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=support&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='comment'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=comment" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_comment');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_comment');?>
</a>
</li>
<!-- mangepoll-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='poll'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=poll" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_poll');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_poll');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='poll'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='addanswer'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=poll&mod=addanswer" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_answer');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_answer');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=poll&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_answer');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_answer');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='addquestion'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=poll&mod=addquestion" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_question');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_question');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='listquestion'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=poll&mod=listquestion" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_question');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_question');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='weblink'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=weblink" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_weblink');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_weblink');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='weblink'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=weblink&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=weblink&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--end change by Thai Nguyen-->
</ul>
</li>

<?php }?>
<!--<li<?php if ($_smarty_tpl->getVariable('op')->value=='report'){?> class="current2"}<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=report" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('report');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('report');?>
</a></li>-->
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteAdmin()||$_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?>
<li<?php if ($_smarty_tpl->getVariable('op')->value=='system'){?> class="current"}<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system');?>
</a>
<?php if ($_smarty_tpl->getVariable('op')->value=='system'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='config'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_config');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_config');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='config'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='general'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=general" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('general_config');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('general_config');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='down'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=down" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_down');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_down');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='rate'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=rate" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('rate_config');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('rate_config');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='saleoff'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=saleoff" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sale_off_config');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('sale_off_config');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='order'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=config&mod=order" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('order_config');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('order_config');?>
</a></li>
</ul>
<?php }?>
</li>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteAdmin()||$_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='staff'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=staff" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_staff');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_staff');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='staff'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=staff&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=staff&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
<?php if ($_smarty_tpl->getVariable('authUser')->value->isSiteFounder()){?><li<?php if ($_smarty_tpl->getVariable('mod')->value=='listTracking'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=staff&mod=listTracking" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('tracking_title');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('tracking_title');?>
</a></li><?php }?>
</ul>
<?php }?>
</li>
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='area'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=area" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_area');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('manage_area');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='area'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=area&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=area&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='shipping'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=shipping" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('method_delivery');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('method_delivery');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='shipping'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=shipping&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=shipping&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='payment'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=payment" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_payment_method');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_payment_method');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='payment'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=payment&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=payment&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='currency'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=currency" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_currency');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_currency');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='currency'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=currency&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=currency&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='language'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=language" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_language');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_language');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='language'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=language&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=language&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<li<?php if ($_smarty_tpl->getVariable('act')->value=='email'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=email" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_email_template');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_email_template');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='email'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=email&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=email&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>
<!--
<li<?php if ($_smarty_tpl->getVariable('act')->value=='field'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=field" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_custom_field');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_custom_field');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='field'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=field&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=field&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='event'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=event" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_event');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_event');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='event'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=event&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=event&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<!--<li<?php if ($_smarty_tpl->getVariable('act')->value=='addon'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=addon" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_addon');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_addon');?>
</a>
<?php if ($_smarty_tpl->getVariable('act')->value=='addon'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='add'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=addon&mod=add" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_new');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('mod')->value=='list'){?> class="currentsub"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=system&act=addon&mod=list" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_item');?>
</a></li>
</ul>
<?php }?>
</li>-->
<?php }?>
</ul>
<?php }?>
</li>
<?php }?>

<li<?php if ($_smarty_tpl->getVariable('op')->value=='profile'){?> class="current"}<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=profile" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('profile');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('profile');?>
</a>
<?php if ($_smarty_tpl->getVariable('op')->value=='profile'){?>
<ul>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='information'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=profile&act=information" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_profile');?>
 "><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_profile');?>
</a></li>
<li<?php if ($_smarty_tpl->getVariable('act')->value=='password'){?> class="current"<?php }?>><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=profile&act=password" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('change_password');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('change_password');?>
</a></li>
</ul>
<?php }?>
</li>
</ul>
</div>
<!--
<p>&nbsp;</p>
<p><strong>Account manager</strong></p>
<p>Nguyen Thi Thom</p>
<p>&nbsp;Email: thom.nguyen@derasoft.com</p>
<p>&nbsp;Tel: (08) 3830 7009 (ext. 22)</p>
<p>&nbsp;Cell: 090 3935506</p>
<p>&nbsp;Y!M: thomnguyen</p>
<p>&nbsp;Skype: thomnguyen</p>
-->
</div>
<?php }?>