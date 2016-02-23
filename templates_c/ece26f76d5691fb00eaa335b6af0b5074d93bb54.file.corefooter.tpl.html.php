<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:30:42
         compiled from "./templates/admin/corefooter.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:72174717955307e62645213-64408928%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ece26f76d5691fb00eaa335b6af0b5074d93bb54' => 
    array (
      0 => './templates/admin/corefooter.tpl.html',
      1 => 1428722925,
    ),
  ),
  'nocache_hash' => '72174717955307e62645213-64408928',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div id="footer">

</div>
<?php if ($_smarty_tpl->getVariable('urlPopup')->value){?>
<!--Get URL Popup-->  
<div class="popup2">
<p class="btnClose2"><a href="javascript:;" class="close" title="Close">X Close</a></p>
<div class="popupInner2">
<form action="" method="post" name="formContact">
<fieldset>
<ul>
<li>Get URL</li>
</ul>
<p>
<label for="name">Relative link</label>
<input type="text" value="" name="relative" id="valueRelative" /> 
</p>
<p>
<label for="name">Permanent link</label>
<input type="text" value="http://<?php echo $_smarty_tpl->getVariable('estore')->value->getDomain();?>
" name="relative" id="valuePermanent" />  
</p>
</fieldset>
</form>
</div>
</div>
<!--end Get URL Popup-->
<?php }?>
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/common.js"></script>
<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/scripts/forms.js"></script>
</body>
</html>