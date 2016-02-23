<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-20 08:19:00
         compiled from "./templates/admin/systemconfiggeneral.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:909389725553454041fb544-51494816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16d244eeb92c50ea2cb7a223034747c4ac20a617' => 
    array (
      0 => './templates/admin/systemconfiggeneral.tpl.html',
      1 => 1428722927,
    ),
  ),
  'nocache_hash' => '909389725553454041fb544-51494816',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="tableContent">
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<div class="contType"><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes');?>
:</h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('config_general_notes');?>
</div>
<?php if ($_smarty_tpl->getVariable('error')->value){?><?php if ($_smarty_tpl->getVariable('error')->value['invalid']||$_smarty_tpl->getVariable('error')->value['message']){?>
<?php $_smarty_tpl->assign('input',$_smarty_tpl->getVariable('error')->value['INPUT'],null,null);?>
<div class="errorBox">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('error_notes');?>
:</h2>
<ul class="listStyle"><?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('input')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?><?php if ($_smarty_tpl->tpl_vars['field']->value['error']){?><li><?php echo $_smarty_tpl->tpl_vars['field']->value['message'];?>
</li><?php }?><?php }} ?><li><?php echo $_smarty_tpl->getVariable('error')->value['message'];?>
</li></ul>
</div>
<?php }?><?php }?>
<?php if ($_smarty_tpl->getVariable('success')->value){?>
<div class="infoBox">
<h2><?php echo $_smarty_tpl->getVariable('success')->value;?>
</h2>
</div>
<?php }?>
<div class="formContent">
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_config_general');?>
</h1>
<?php if ($_smarty_tpl->getVariable('item')->value){?>
<!-- Load estore info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="private_domain"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('domain');?>
:</label><strong><?php echo $_smarty_tpl->getVariable('item')->value->getDomain();?>
</strong></p>
<!--<p><label for="private_domain">*<?php echo $_smarty_tpl->getVariable('locale')->value->msg('price_room');?>
:</label>
<input type="text" name="price_room" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('price_room');?>
"  class="small"/> VNĐ</p>-->
<p><label for="template_domain"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('web_interface');?>
:</label>
<select class="medium" name="domain_template_id" id="domain_template_id">
<?php echo $_smarty_tpl->getVariable('domainTemplates')->value;?>

</select></p>
<p><label for="site_name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_name');?>
:</label>
<input class="medium" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" name="site_name" id="site_name" /></p>
<p><label for="email">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_keywords');?>
:</label>
<input type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getKeywords();?>
" name="keywords" id="keywords" /></p>
<p><label for="site_description">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_description');?>
:</label>
<textarea rows="10" cols="20" name="site_description" id="site_description"><?php echo $_smarty_tpl->getVariable('item')->value->getDescription();?>
</textarea></p>
<p><label for="currency">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('currency');?>
:</label>
<input class="small" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getCurrency();?>
" name="currency" id="currency" />(<?php echo $_smarty_tpl->getVariable('locale')->value->msg('currency_type');?>
)</p>
<p><label for="company"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_company');?>
:</label>
<input type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getCompany();?>
" name="company" id="company" /></p>
<p><label for="address"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('address');?>
:</label>
<input type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getAddress();?>
" name="address" id="address" /></p>
<p><label for="email"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('email_add');?>
:</label>
<input class="medium" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
" name="email" id="email" /></p>
<p><label for="tel"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('telephone');?>
:</label>
<input class="small" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getTel();?>
" name="tel" id="tel" /></p>
<p><label for="cell"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('cell');?>
:</label>
<input class="small" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getCell();?>
" name="cell" id="cell" /></p>
<p><label for="duplicate"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('check_name_product');?>
:</label>
<input type="checkbox" name="check_duplicate_product_name" value="1" id="check_duplicate_product_name" class="box"<?php if ($_smarty_tpl->getVariable('item')->value->getProperty('check_duplicate_product_name')){?> checked<?php }?> />
<label for="check_duplicate_product_name" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</label></p>
<div class="boxTyle">
<label for="admin_logo"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('admin_logo');?>
:</label>
<input class="selectPhoto" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('admin_logo');?>
" name="admin_logo" id="admin_logo" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('admin_logo');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('admin_logo_hint');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="store_logo"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('store_logo');?>
:</label>
<input class="selectPhoto" type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('store_logo');?>
" name="store_logo" id="store_logo" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('store_logo');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('store_logo_hint');?>
</p>
</div>
</div>
</div>
<p><label for="cell">Link Facebook:</label>
<input type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('link_fb');?>
" name="link_fb" id="link_fb" /></p>
<p><label for="cell">Link Google:</label>
<input type="type" value="<?php echo $_smarty_tpl->getVariable('item')->value->getProperty('link_gg');?>
" name="link_gg" id="link_gg" /></p>
<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
<br /><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_custom_field');?>
</h2>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fieldList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML($_smarty_tpl->getVariable('item')->value->getProperty($_smarty_tpl->getVariable('field')->value->getName()));?>

<?php }} ?>
<?php }?>
<p class="btn">
<input type="hidden" name="op" value="system" />
<input type="hidden" name="act" value="config" />
<input type="hidden" name="mod" value="general" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit" />
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
<input type="button" onclick="javascript:formSubmit('formEdit','general','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }else{ ?>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['price_room']['error']){?> class="errormsg"<?php }?>><label for="price_room">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('price_room');?>
:</label>
<input class="small" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['price_room']['value'];?>
<?php }?>" name="price_room" id="site_name" /> VNĐ</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['private_domain']['error']){?> class="errormsg"<?php }?>><label for="private_domain">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('domain');?>
:</label><strong><?php echo $_smarty_tpl->getVariable('estore')->value->getDomain();?>
</strong></p>
<p><label for="template_domain"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('web_interface');?>
:</label>
<select name="template_domain" id="template_domain">
<?php echo $_smarty_tpl->getVariable('domainTemplates')->value;?>

</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['site_name']['error']){?> class="errormsg"<?php }?>><label for="site_name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_name');?>
:</label>
<input class="medium" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['site_name']['value'];?>
<?php }?>" name="site_name" id="site_name" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['keywords']['error']){?> class="errormsg"<?php }?>><label for="keywords">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_keywords');?>
:</label>
<input type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['keywords']['value'];?>
<?php }?>" name="keywords" id="keywords" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['site_description']['error']){?> class="errormsg"<?php }?>><label for="site_description">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('site_description');?>
:</label>
<textarea rows="10" cols="20" name="site_description" id="site_description"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['site_description']['value'];?>
<?php }?></textarea></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['currency']['error']){?> class="errormsg"<?php }?>><label for="currency">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('currency');?>
:</label>
<input class="small" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['currency']['value'];?>
<?php }?>" name="currency" id="currency" />(<?php echo $_smarty_tpl->getVariable('locale')->value->msg('currency_type');?>
)</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['company']['error']){?> class="errormsg"<?php }?>><label for="company"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_company');?>
:</label>
<input type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['company']['value'];?>
<?php }?>" name="company" id="company" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['address']['error']){?> class="errormsg"<?php }?>><label for="address"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('address');?>
:</label>
<input class="long" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['address']['value'];?>
<?php }?>" name="address" id="address" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['email']['error']){?> class="errormsg"<?php }?>><label for="email"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('email_add');?>
:</label>
<input class="medium" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['email']['value'];?>
<?php }?>" name="email" id="email" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['tel']['error']){?> class="errormsg"<?php }?>><label for="tel"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('telephone');?>
:</label>
<input class="small" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['tel']['value'];?>
<?php }?>" name="tel" id="tel" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['cell']['error']){?> class="errormsg"<?php }?>><label for="cell"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('cell');?>
:</label>
<input class="small" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['cell']['value'];?>
<?php }?>" name="cell" id="cell" /></p>
<p><label for="check_duplicate_product_name"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('check_name_product');?>
:</label>
<input type="checkbox" name="check_duplicate_product_name" value="1" id="check_duplicate_product_name" class="box"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?> checked<?php }?> />
<label for="check_duplicate_product_name" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</label></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['admin_logo']['error']){?> class="errormsg"<?php }?>><label for="admin_logo"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('admin_logo');?>
:</label>
<input class="selectPhoto" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['admin_logo']['value'];?>
<?php }?>" name="admin_logo" id="admin_logo" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['store_logo']['error']){?> class="errormsg"<?php }?>><label for="store_logo"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('store_logo');?>
:</label>
<input class="selectPhoto" type="type" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['store_logo']['value'];?>
<?php }?>" name="store_logo" id="store_logo" /></p>
<br />
<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
<br /><h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('list_custom_field');?>
</h2>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fieldList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?>
<?php $_smarty_tpl->assign('field_name',$_smarty_tpl->getVariable('field')->value->getName(),null,null);?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML($_smarty_tpl->getVariable('error')->value['INPUT'][$_smarty_tpl->getVariable('field_name')->value]['value']);?>

<?php }?>
<?php }} ?>
<?php }?>
<p class="btn">
<input type="hidden" name="op" value="system" />
<input type="hidden" name="act" value="config" />
<input type="hidden" name="mod" value="general" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="Submit" name="btnSubmit" />
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="Reset" name="btnReset" />
<input type="button" onclick="javascript:formSubmit('formEdit','general','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }?>
</div>
</div>