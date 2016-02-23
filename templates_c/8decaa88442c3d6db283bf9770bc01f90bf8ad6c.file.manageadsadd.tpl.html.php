<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-21 09:13:46
         compiled from "./templates/admin/manageadsadd.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:9780670185535b25ad3dfb8-11955276%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8decaa88442c3d6db283bf9770bc01f90bf8ad6c' => 
    array (
      0 => './templates/admin/manageadsadd.tpl.html',
      1 => 1428727483,
    ),
  ),
  'nocache_hash' => '9780670185535b25ad3dfb8-11955276',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<?php if ($_smarty_tpl->getVariable('error')->value['invalid']||$_smarty_tpl->getVariable('error')->value['message']){?>
<?php $_smarty_tpl->assign('input',$_smarty_tpl->getVariable('error')->value['INPUT'],null,null);?>
<div class="errorBox">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('error_notes');?>
:</h2>
<ul class="listStyle">
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('input')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?>
<?php if ($_smarty_tpl->tpl_vars['field']->value['error']){?><li><?php echo $_smarty_tpl->tpl_vars['field']->value['message'];?>
</li><?php }?>
<?php }} ?>
<li><?php echo $_smarty_tpl->getVariable('error')->value['message'];?>
</li>
</ul>
</div>
<?php }?>
<?php }?>
<div class="formContent">
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_banner');?>
</h1>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="cat_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_group');?>
:</label>
<select name="gId" id="gId">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select>
</p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<div class="boxTyle">
<label for="urllogo"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_banner');?>
:</label><input type="text" name="urllogo" id="urllogo" /></label>
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_banner');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_urllogo');?>
</p>
</div>
</div>
</div>
<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('banner_type_from_url');?>
:</label>
<select name="typeurl">
<option value="img" >Image</option>
<option value="swf" >Flash</option>
<option value="video" >Video</option>
</select></p>
<div class="boxTyle">
<label for="photos"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('upload_banner');?>
:</label><input type="file" name="logo" id="logo" /></label>
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4>Upload banner</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label>Ghi chú:</label>
<div style="float:left; width:350px;">
Banner kích thước chuẩn: 940x350px 
</div>
</div>
<div class="boxTyle">
<label for="with"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('width');?>
 (pixel):</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['with']['value'];?>
 <?php }?>" name="width" id="width" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('width');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_width_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="height"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('height');?>
 (pixel):</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['height']['value'];?>
<?php }?>" name="height" id="height" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('height');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_heigt_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="url"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_ads');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['url']['value'];?>
<?php }?>" name="url" id="url" />
<div class="helpIcon"><a href="#" class="btnHelp"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('url_ads');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_url_logo');?>
</p>
</div>
</div>
</div>
<div class="boxTyle">
<label for="url"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_change');?>
:</label>
<textarea rows="10" cols="20" name="altcontent" id="altcontent"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['altcontent']['value'];?>
<?php }?></textarea>
<div class="helpIcon"><a href="#" class="btnHelp">&nbsp;<img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/help_button.gif" width="14" height="14" alt="Hint" /></a>
<div class="alertPopup">
<h4><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_change');?>
</h4>
<p><?php echo $_smarty_tpl->getVariable('locale')->value->msg('note_altcontent');?>
</p>
</div>
</div>
</div>
<p>&nbsp;</p>
<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="ads" />
<input type="hidden" name="mod" value="add" />
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
<input type="button" onClick="javascript:formSubmit('formAdd','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>
</div>