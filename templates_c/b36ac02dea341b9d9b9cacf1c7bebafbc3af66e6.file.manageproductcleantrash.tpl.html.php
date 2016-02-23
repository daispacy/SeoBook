<?php /* Smarty version Smarty-3.0-RC2, created on 2015-10-21 18:05:27
         compiled from "./templates/admin/manageproductcleantrash.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:20025041456277177dcf3f9-89429629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b36ac02dea341b9d9b9cacf1c7bebafbc3af66e6' => 
    array (
      0 => './templates/admin/manageproductcleantrash.tpl.html',
      1 => 1428722927,
    ),
  ),
  'nocache_hash' => '20025041456277177dcf3f9-89429629',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="contType">
<h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes');?>
:</h2><?php echo $_smarty_tpl->getVariable('locale')->value->msg('notes_clean_trash');?>

</div>
<form name="formClean" id="formClean" action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post">
<fieldset>
<p> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_cate_clean');?>
:</p>
<p><input type="checkbox" name="categories" checked="checked" value="1"/> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('warning_clean_procate');?>
</p>
<p><input type="checkbox" name="items" checked="checked" value="1" /> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('product');?>
</p>
<input type="checkbox" name="sizes" checked="checked" value="1" /> Kích cỡ</fieldset>
</p>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="product" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="cleantrash" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<p class="btn"><input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_ok');?>
" name="btnSubmit2" />
<input type="button" onClick="javascript:formSubmit('formClean','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
</div>