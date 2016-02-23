<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-19 10:56:22
         compiled from "./templates/admin/manageproductaddcategory.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:208170529355332766cc29f4-23196137%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a8c83131f65089c4c6ab0ca5dc23c638a6e0834' => 
    array (
      0 => './templates/admin/manageproductaddcategory.tpl.html',
      1 => 1428722926,
    ),
  ),
  'nocache_hash' => '208170529355332766cc29f4-23196137',
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('add_product_category');?>
</h1>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data">
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="parent_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_procate');?>
:</label>
<select name="parent_id" id="parent_id">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status" class="small">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_procate');?>
: </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['name']['value'];?>
<?php }?>" name="name" id="name" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['error']){?> class="errormsg"<?php }?>><label for="keyword">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('keyword');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['value'];?>
<?php }?>" name="keyword" id="keyword" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sapo']['error']){?> class="errormsg"<?php }?>><label for="description">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('sapo');?>
:</label>
<textarea rows="10" cols="20" name="sapo" id="sapo"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['sapo']['value'];?>
<?php }?></textarea></p>
<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
<br />
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

<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML();?>

<?php }?>
<?php }} ?>
<?php }?>

<p><label for="avatar"> Hình đại diện : </label><input type="file"  name="avatar" id="avatar" /></p>

<p>
<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_sort_result');?>
:</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="position"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="position"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('parameter_position');?>
</label>
<input type="radio" name="sort_type" id="radio2" class="box" value="created"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="created"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('time_created');?>
</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="updated"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="updated"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('time_update');?>
</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="slug"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="slug"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name_title');?>
</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="viewed"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="viewed"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('num_of_accsess');?>
</label>
<input type="radio" name="sort_type" id="radio3" class="box" value="price"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_type']['value']=="price"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('product_price');?>
</label>
</p>
<p>
<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_result');?>
:</label>
<input type="radio" name="sort_dir" id="radio1" class="box" value="ASC"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sort_dir']['value']=="ASC"){?> checked<?php }?> />
<label for="radio1" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('asc');?>
</label>
<input type="radio" name="sort_dir" id="radio2" class="box" value="DESC"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['sort_dir']['value']=="DESC"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('desc');?>
</label>
</p>
<p>
<label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('type_display_result');?>
:</label>
<input type="radio" name="display" id="radio2" class="box" value="1"<?php if (!isset($_smarty_tpl->getVariable('error')->value['INPUT'])||$_smarty_tpl->getVariable('error')->value['INPUT']['display']['value']=="1"){?> checked<?php }?> />
<label for="radio2" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('acolum_rows');?>
</label>
<input type="radio" name="display" id="radio1" class="box" value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['display']['value']=="0"){?> checked<?php }?> />
<label for="radio1" class="lbl"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('colums_rows');?>
</label>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['error']){?> class="errormsg"<?php }?>><label for="ipp">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('items_per_page');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['ipp']['value'];?>
<?php }else{ ?>20<?php }?>" name="ipp" id="ipp" /></p>
<p><label><?php echo $_smarty_tpl->getVariable('locale')->value->msg('page_landing');?>
:</label>
<input type="checkbox" name="landing" value="1" id="landing" class="box" <?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['landing']['value']=="1"){?>checked<?php }?>/>
<label for="landing_page" class="lbl"></label></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['landing_page']['error']){?> class="errormsg"<?php }?>><label for="comment"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('content_landing');?>
:</label></p>
<textarea rows="5" cols="10" name="landing_page" id="landing_page"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['landing_page']['value'];?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('landing_page');</script>

<br />
<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="product" />
<input type="hidden" name="mod" value="addcategory" />
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
<input type="button" onclick="javascript:formSubmit('formAdd','listcategory','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>
</div>