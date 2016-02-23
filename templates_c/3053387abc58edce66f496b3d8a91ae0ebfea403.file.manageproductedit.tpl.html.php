<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-17 10:39:03
         compiled from "./templates/admin/manageproductedit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1652435958553080577bc4d2-11919044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3053387abc58edce66f496b3d8a91ae0ebfea403' => 
    array (
      0 => './templates/admin/manageproductedit.tpl.html',
      1 => 1429069998,
    ),
  ),
  'nocache_hash' => '1652435958553080577bc4d2-11919044',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_regex_replace')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.regex_replace.php';
?><?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
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
<h1><?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit_product');?>
</h1>
<?php if ($_smarty_tpl->getVariable('validItem')->value){?>
<?php if ($_smarty_tpl->getVariable('item')->value){?>
<!-- Load product info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="cat_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_procate');?>
:</label>
<select name="cat_id" id="cat_id">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status" class="small">
<option value="1"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()=="1"){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if ($_smarty_tpl->getVariable('item')->value->getStatus()=="0"){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
" name="position" id="position" /></p>
<p><label for="sku"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('sku');?>
: </label>
<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getSku();?>
" name="sku" id="sku" /></p>
<p><label for="slug">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('slug');?>
: </label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getSlug();?>
" name="slug" id="slug" /></p>
<p><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('product_name');?>
: </label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" name="name" id="name" /></p>
<p><label for="keyword">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('keyword');?>
: </label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getKeyword();?>
" name="keyword" id="keyword" /></p>


<p><label for="price">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('price');?>
:</label>
<input class="small" type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPrice();?>
" name="price" id="price"  /><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('currency');?>
</p>
<p><label for="market_price">Giá khuyến mãi:</label>
<input class="small" type="text" value="<?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()>1){?><?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
<?php }?>" name="market_price" id="market_price"  /><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('currency');?>
</p>
<p><label for="keyword">* Số lượng: </label>
<input type="text" value="<?php echo $_smarty_tpl->getVariable('item')->value->getQuantity();?>
" name="quantity" id="quantity" /></p>

  <script type="text/javascript">
      function loop()
      {
      var list = document.getElementById('sizes');
      for(var i = 0; i < list.options.length; ++i)
         {
            list.options[i].selected = true;
         }
      }
	  function loop2()
      {
      var list = document.getElementById('list_area_hotel_id');
      for(var i = 1; i < list.options.length; ++i)
         {
            list.options[i].selected = true;
         }
      }
      </script>

<p><label for="sizes">Chọn size:</label>
<?php if ($_smarty_tpl->getVariable('sizeCombo')->value){?>
<select name="sizes[]" id="sizes" multiple="multiple" class="multiple" style="height:100px;">
<?php echo $_smarty_tpl->getVariable('sizeCombo')->value;?>

</select>
<input type="button" id="select_all" value="Select all" onclick="loop()" class="mini" style="width:70px"/>(Ctrl + chuột trái để chọn nhiều size)
<?php }else{ ?>
 <a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=size"> Nhấn vào đây để thêm size </a>
<?php }?>
</p>
<p><label for="description">* Mô tả:</label>
<textarea rows="10" cols="20" name="description" id="description"><?php echo $_smarty_tpl->getVariable('item')->value->getDescription();?>
</textarea></p>
<p><label for="description">* Chi tiết:</label></p>
<textarea rows="10" cols="20" name="detail" id="detail"><?php echo $_smarty_tpl->getVariable('item')->value->getDetail();?>
</textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('detail');</script>

<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
<br /><h2>Nội dung tiếng Anh</h2>
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

<p><label for="files">ảnh đại diện:</label><input type="file" multiple="multiple" name="files[]" id="files[]" /></p>

<?php $_smarty_tpl->assign('photos',$_smarty_tpl->getVariable('item')->value->getProperty('photos'),null,null);?>
<?php if ($_smarty_tpl->getVariable('photos')->value){?>
<p>
<div class="listPhoto">
<ul>
<?php  $_smarty_tpl->tpl_vars['photo'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['photo']->key => $_smarty_tpl->tpl_vars['photo']->value){
?>
<li><a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/a_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['photo']->value,"/(.png"."$"."|.bmp"."$"."|.gif"."$".")/",".jpg");?>
" width="100" /></a><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&doo=delPhoto&photo=<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a></li>
<?php }} ?>
</ul>
</div>
</p>
<?php }?>
<br />
<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="product" />
<input type="hidden" name="mod" value="edit" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="sCode" value="<?php echo $_smarty_tpl->getVariable('sCode')->value;?>
_" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="submit" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_submit');?>
" name="btnSubmit" />
<input type="reset" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_reset');?>
" name="btnReset" />
<input type="button" onclick="javascript:formSubmit('formEdit','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }else{ ?>
<!-- Load submitted info -->
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formEdit" id="formEdit" enctype="multipart/form-data" >
<fieldset>
<p><strong>* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('required_fields');?>
</strong></p>
<p><label for="cat_id"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('of_procate');?>
:</label>
<select name="cat_id" id="cat_id">
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select></p>
<p><label for="status"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
:</label>
<select name="status" id="status">
<option value="1"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==1){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
</option>
<option value="0"<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['status']['value']==0){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
</option>
</select></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['position']['error']){?> class="errormsg"<?php }?>><label for="position"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['position']['value'];?>
<?php }?>" name="position" id="position" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sku']['error']){?> class="errormsg"<?php }?>><label for="sku"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('sku');?>
: </label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['sku']['value'];?>
<?php }?>" name="sku" id="sku" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['name']['error']){?> class="errormsg"<?php }?>><label for="name">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('product_name');?>
: </label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['name']['value'];?>
<?php }?>" name="name" id="name" /></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['error']){?> class="errormsg"<?php }?>><label for="keyword">* <?php echo $_smarty_tpl->getVariable('locale')->value->msg('keyword');?>
:</label>
<input type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['keyword']['value'];?>
<?php }?>" name="keyword" id="keyword" /></p>


<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['price']['error']){?> class="errormsg"<?php }?>><label for="price"> <?php echo $_smarty_tpl->getVariable('locale')->value->msg('price');?>
:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['price']['value'];?>
<?php }?>" name="price" id="price"  /><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('currency');?>
</p>

<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['market_price']['error']){?> class="errormsg"<?php }?>><label for="market_price">Giá khuyến mãi:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['market_price']['value'];?>
<?php }?>" name="market_price" id="market_price"  /><?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('currency');?>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['quantity']['error']){?> class="errormsg"<?php }?>><label for="market_price">Số lượng:</label>
<input class="small" type="text" value="<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['quantity']['value'];?>
<?php }?>" name="quantity" /></p>

  <script type="text/javascript">
      function loop()
      {
      var list = document.getElementById('sizes');
      for(var i = 0; i < list.options.length; ++i)
         {
            list.options[i].selected = true;
         }
      }
	  function loop2()
      {
      var list = document.getElementById('list_area_hotel_id');
      for(var i = 1; i < list.options.length; ++i)
         {
            list.options[i].selected = true;
         }
      }
      </script>

<p <?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['sizes']['error']){?> class="errormsg"<?php }?>><label for="sizes">Chọn size:</label>
<?php if ($_smarty_tpl->getVariable('sizeCombo')->value){?>
<select name="sizes[]" id="sizes" multiple="multiple" class="multiple" style="height:100px;">
<?php echo $_smarty_tpl->getVariable('sizeCombo')->value;?>

</select>
<input type="button" id="select_all" value="Select all" onclick="loop()" class="mini" style="width:70px"/>(Ctrl + chuột trái để chọn nhiều size)
<?php }else{ ?>
 <a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=size"> Nhấn vào đây để thêm size </a>
<?php }?>
</p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['description']['error']){?> class="errormsg"<?php }?>><label for="description">* Mô tả:</label>
<textarea rows="10" cols="20" name="description" id="description"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['description']['value'];?>
<?php }?></textarea></p>
<p<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])&&$_smarty_tpl->getVariable('error')->value['INPUT']['detail']['error']){?> class="errormsg"<?php }?>><label for="detail">* Chi tiết:</label></p>
<textarea rows="10" cols="20" name="detail" id="detail"><?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?><?php echo $_smarty_tpl->getVariable('error')->value['INPUT']['detail']['value'];?>
<?php }?></textarea>
<script type="text/javascript">var editor = CKEDITOR.replace('detail');</script>

<?php if ($_smarty_tpl->getVariable('fieldList')->value){?>
<br /><h2>Nội dung tiếng Anh</h2>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fieldList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
<?php if (isset($_smarty_tpl->getVariable('error')->value['INPUT'])){?>
<?php $_smarty_tpl->assign('field_name',$_smarty_tpl->getVariable('field')->value->getName(),null,null);?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML($_smarty_tpl->getVariable('error')->value['INPUT'][$_smarty_tpl->getVariable('field_name')->value]['value'],$_smarty_tpl->getVariable('error')->value['INPUT'][$_smarty_tpl->getVariable('field_name')->value]['error']);?>

<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('field')->value->displayHTML();?>

<?php }?>
<?php }} ?>
<?php }?>

<p><label for="files"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('attachments');?>
:</label><input type="file" name="files[]" id="files[]" /></p>
<?php $_smarty_tpl->assign('videos',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('videos'),null,null);?>
<?php $_smarty_tpl->assign('files',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('files'),null,null);?>
<?php if ($_smarty_tpl->getVariable('videos')->value||$_smarty_tpl->getVariable('files')->value){?>
<p>
<div class="listFile">
<ul>
<?php  $_smarty_tpl->tpl_vars['video'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('videos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['video']->key => $_smarty_tpl->tpl_vars['video']->value){
?>
<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=edit&id=<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getId();?>
&doo=delVideo&video=<?php echo $_smarty_tpl->tpl_vars['video']->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a><a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/<?php echo $_smarty_tpl->tpl_vars['video']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['video']->value;?>
</a></li>
<?php }} ?>
<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
?>
<li><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=edit&id=<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getId();?>
&doo=delFile&file=<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a><a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['file']->value;?>
</a></li>
<?php }} ?>
</ul>
</div>
</p>
<?php }?>        
<?php $_smarty_tpl->assign('photos',$_smarty_tpl->getVariable('itemInfo')->value->getProperty('photos'),null,null);?>
<?php if ($_smarty_tpl->getVariable('photos')->value){?>
<p>
<div class="listPhoto">
<ul>
<?php  $_smarty_tpl->tpl_vars['photo'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['photo']->key => $_smarty_tpl->tpl_vars['photo']->value){
?>
<li><a href="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" target="_blank"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/a_<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['photo']->value,"/(.png"."$"."|.bmp"."$"."|.gif"."$".")/",".jpg");?>
" width="100" /></a><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=edit&id=<?php echo $_smarty_tpl->getVariable('itemInfo')->value->getId();?>
&doo=delPhoto&photo=<?php echo $_smarty_tpl->tpl_vars['photo']->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete_file');?>
" class="btnDelete"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
</a></li>
<?php }} ?>
</ul>
</div>
<?php }?>

<br />
<p class="btn">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="product" />
<input type="hidden" name="mod" value="edit" />
<input type="hidden" name="doo" value="submit" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->getVariable('id')->value;?>
" />
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
<input type="button" onclick="javascript:formSubmit('formEdit','list','cancel',0);" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_cancel');?>
" name="btnCancel" />
</p>
</fieldset>
</form>
<?php }?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('locale')->value->msg('code_invalid');?>
...<?php }?>
</div>
</div>