<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-18 15:04:50
         compiled from "./templates/admin/manageproductlist.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:323632442553210221fea48-05572606%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c5df73a031532c8c0fbadbd7c3885e7a08fcd9b' => 
    array (
      0 => './templates/admin/manageproductlist.tpl.html',
      1 => 1429344286,
    ),
  ),
  'nocache_hash' => '323632442553210221fea48-05572606',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/hun6fd6d/public_html/classes/template/plugins/modifier.date_format.php';
?><?php if ($_smarty_tpl->getVariable('result_code')->value){?><div class="message"><?php echo $_smarty_tpl->getVariable('amessages')->value['result_code'][$_smarty_tpl->getVariable('result_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('error_code')->value){?><div class="message2"><?php echo $_smarty_tpl->getVariable('amessages')->value['error_code'][$_smarty_tpl->getVariable('error_code')->value];?>
</div><?php }?>
<?php if ($_smarty_tpl->getVariable('pId')->value){?><p><a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=list&pId=<?php echo $_smarty_tpl->getVariable('gfId')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back_group');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/icon_parent.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back_group');?>
" width="32" height="32" />...<?php echo $_smarty_tpl->getVariable('locale')->value->msg('back');?>
</a></p><?php }?>
<?php if ($_smarty_tpl->getVariable('listItems')->value){?>
<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th><input type="checkbox" name="all" id="all" value="1" class="box3" onclick="toggleAllChecks('formType');" /></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('numbers');?>
</th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','id','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_code');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('code');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="id"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('images');?>
</th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','cat_id','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sort_by_procate');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('product_cate');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="cat_id"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','name','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_name');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('product_infomation');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="name"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','price','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_price');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('price');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="price"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?> (<?php echo $_smarty_tpl->getVariable('estore')->value->getProperty('currency');?>
)</th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','position','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_position');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('position');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="position"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('posts_user');?>
</th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','viewed','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_view');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('num_of_views');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="viewed"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><a href="javascript:void(0)" onclick="javascript:MM_sortField('parent','<?php echo $_smarty_tpl->getVariable('sk')->value;?>
','status','<?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>ASC<?php }else{ ?>DESC<?php }?>');" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('arrangement_by_status');?>
"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('system_status');?>
</a><?php if ($_smarty_tpl->getVariable('sk')->value=="status"){?><?php if ($_smarty_tpl->getVariable('sd')->value=="DESC"){?>&darr;<?php }else{ ?>&uarr;<?php }?><?php }?></th>
<th><?php echo $_smarty_tpl->getVariable('locale')->value->msg('actions');?>
</th>
</tr>
</thead>
<tbody>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
<tr<?php if ($_smarty_tpl->tpl_vars['no']->value%2==0){?> class="bgType"<?php }?>>
<td><input type="checkbox" name="ids[]" id="ids[]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" class="box3" /></td>
<td><?php echo $_smarty_tpl->getVariable('startNum')->value+$_smarty_tpl->tpl_vars['no']->value;?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
</td>
<td>
<?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?>
<img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/a_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" width="100" />
<?php }?>
</td>
<td><a class="underline" href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=list&pId=<?php echo $_smarty_tpl->getVariable('item')->value->getCatId();?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('view_list_product_of_group');?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</a></td>
<td><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" target="_blank"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('name');?>
: <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
<br />
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('sku');?>
: <?php echo $_smarty_tpl->getVariable('item')->value->getSku();?>
<br />
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('slug');?>
: <?php echo $_smarty_tpl->getVariable('item')->value->getSlug();?>
<br/>
<strong>Số lượng: <?php echo $_smarty_tpl->getVariable('item')->value->getQuantity();?>
</strong></a></td>
<td><p>Giá sắp xếp: <input class="price" type="text" id="prices[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]" name="prices[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]" value="<?php echo number_format($_smarty_tpl->getVariable('item')->value->getPrice(),2);?>
" onBlur="formatCurrency('prices[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]');" /></p>
<p>Giá trưng bày: <input style="width: 100%; text-align: left;"  type="text" id="market_prices[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]" name="market_prices[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
"  /></p>

</td>
<td><input class="position" type="text" name="positions[<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getPosition();?>
" /></td>
<td>
<?php $_smarty_tpl->assign('userUpload',$_smarty_tpl->getVariable('item')->value->getProperty('user_upload'),null,null);?>
<?php $_smarty_tpl->assign('userUpdate',$_smarty_tpl->getVariable('item')->value->getProperty('user_update'),null,null);?>
<?php if ($_smarty_tpl->getVariable('userUpload')->value){?><p>[P]<?php echo $_smarty_tpl->getVariable('userUpload')->value;?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"%Y-%m-%d");?>
</p><?php }?>
<?php if ($_smarty_tpl->getVariable('userUpdate')->value){?>[U]<?php echo $_smarty_tpl->getVariable('userUpdate')->value;?>
<br /><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('item')->value->getDateCreated(),"%Y-%m-%d");?>
<?php }?>
</td>
<td><?php echo number_format($_smarty_tpl->getVariable('item')->value->getViewed());?>
</td>
<td><?php echo $_smarty_tpl->getVariable('item')->value->getStatusTextBackend();?>
</td>
<td>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=edit&id=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
&lang=<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_edit.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('edit');?>
" width="16" height="16" /></a>
<a href="javascript:formSubmit('formType','list','enable',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_enable.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
" width="16" height="16" /></a>
<a href="javascript:formSubmit('formType','list','disable',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_disable.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable');?>
" width="16" height="16" /></a>
<a href="javascript:formSubmit('formType','list','delete',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_delete.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('delete');?>
" width="16" height="16" /></a>

<?php if ($_smarty_tpl->getVariable('item')->value->getHome()){?>
<a href="javascript:formSubmit('formType','list','deletehome',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Hủy sản phẩm mới"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/delete_home.gif" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('disable_home');?>
" width="16" height="16" /></a>
<?php }else{ ?>
<a href="javascript:formSubmit('formType','list','sethome',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Set sản phẩm mới"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/home_ico.gif" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('enable');?>
" width="16" height="16" /></a>
<?php }?>

<?php if ($_smarty_tpl->getVariable('item')->value->getSeller()){?>
<a href="javascript:formSubmit('formType','list','deleteseller',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Hủy sản phẩm yêu thích"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/delete_sellers.gif" alt="Hủy sản phẩm yêu thích" width="16" height="16" /></a>
<?php }else{ ?>
<a href="javascript:formSubmit('formType','list','setseller',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Set sản phẩm yêu thích"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/sellers.gif" alt="Set sảm phẩm yêu thích" width="16" height="16" /></a>
<?php }?>

<?php if ($_smarty_tpl->getVariable('item')->value->getSpecial()){?>
<a href="javascript:formSubmit('formType','list','deletespecial',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Hủy Khuyễn mãi"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/delete_special.png" alt="Hủy Khuyễn mãi" width="16" height="16" /></a>
<?php }else{ ?>
<a href="javascript:formSubmit('formType','list','setspecial',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="Set Khuyễn mãi"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/special.png" alt="Set Khuyễn mãi" width="16" height="16" /></a>
<?php }?>

<!--
<a href="javascript:formSubmit('formType','list','duplicate',<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
);" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('copy');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_copy.png" alt="Copy" width="16" height="16" /></a>-->
<a target="_blank" href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('first_view');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_preview.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('first_view');?>
" width="16" height="16" /></a>
<a href="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
?op=manage&act=product&mod=albumlist&pid=<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
" title="Xem Album"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/album.ico" alt="Xem Album" width="16" height="16" /></a>
<span class="check"><a rel="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" href="#" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('link');?>
"><img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ico_link.png" alt="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('link');?>
" width="16" height="16" /></a><span>

</td>
</tr>
<?php }} ?>
</tbody>
</table>
<div class="paging">
<p class="listBtn">
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_update');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','changeposition','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_update');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','enable','0');;"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_enable');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','disable','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_disable');?>
</a>
<a title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
" href="javascript:void(0);" onclick="javascript:formSubmit('formType','list','delete','0');"><?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_delete');?>
</a>
</p>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corepager.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','pager'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
<div class="infoType2">
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('userTemplate')->value)."/corecomboipp.tpl.html", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','ipp'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="listCategory">
<select name="parent_id">
<option value="0" selected="selected">----- <?php echo $_smarty_tpl->getVariable('locale')->value->msg('select_group');?>
 -----</option>
<?php echo $_smarty_tpl->getVariable('categoryCombo')->value;?>

</select>
<input type="button" value="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_move');?>
" title="<?php echo $_smarty_tpl->getVariable('locale')->value->msg('button_move');?>
" class="btnSubmit2" name="btnSubmit2" onclick="javascript:formSubmit('formType','list','changegroup','0');" />
</div>
</div>
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="product" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="pId" value="<?php echo $_smarty_tpl->getVariable('pId')->value;?>
" />
<input type="hidden" name="doo" value="" />
<input type="hidden" name="kw" value="<?php echo $_smarty_tpl->getVariable('kw')->value;?>
" />
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->getVariable('lang')->value;?>
" />
<input type="hidden" name="ipp" value="<?php echo $_smarty_tpl->getVariable('ipp')->value;?>
" />
<input type="hidden" name="sk" value="<?php echo $_smarty_tpl->getVariable('sk')->value;?>
" />
<input type="hidden" name="sd" value="<?php echo $_smarty_tpl->getVariable('sd')->value;?>
" />
<input type="hidden" name="pg" value="<?php echo $_smarty_tpl->getVariable('pg')->value;?>
" />
<input type="hidden" name="id" value="" />
</form>
<?php }else{ ?>
<?php echo $_smarty_tpl->getVariable('locale')->value->msg('no_record');?>

<form action="/<?php echo $_smarty_tpl->getVariable('aScript')->value;?>
" method="post" name="formType" id="formType">
<input type="hidden" name="op" value="manage" />
<input type="hidden" name="act" value="product" />
<input type="hidden" name="mod" value="list" />
<input type="hidden" name="doo" value="" />
</form>
<?php }?>
</div>