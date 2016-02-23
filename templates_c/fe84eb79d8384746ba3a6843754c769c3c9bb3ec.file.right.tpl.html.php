<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-18 15:17:04
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/right.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:193585285532130016b8c3-54346901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe84eb79d8384746ba3a6843754c769c3c9bb3ec' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/right.tpl.html',
      1 => 1429344937,
    ),
  ),
  'nocache_hash' => '193585285532130016b8c3-54346901',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li class="col-sidebar" id="rightside">
				    <!--
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Chuyên mục Sản phẩm</h4></div>
						<ul>
							<li><a href="#">Skin Care</a></li>
							<li><a href="#">Bath &amp; Body Care</a></li>
							<li><a href="#">Fragrance</a></li>
							<li><a href="#">Make-Up</a></li>
							<li><a href="#">Hair</a></li>
							<li><a href="#">Moisturisers</a></li>
						</ul>
					</div>-->
					<!--
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Tags</h4></div>
						<ul class="wp-tag-cloud clearfix">
							<li><a href="#">Tag #1</a></li>
							<li><a href="#">Tag #2</a></li>
							<li><a href="#">Tag #3</a></li>
							<li><a href="#">Tag #4</a></li>
							<li><a href="#">Tag #5</a></li>
							<li><a href="#">Tag #6</a></li>
						</ul>
					</div>
					-->
                    <?php if ($_smarty_tpl->getVariable('productSpecial')->value){?>
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Sản Phẩm khuyến mãi</h4></div>
						
						<ul class="latest-posts-list clearfix">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productSpecial')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<li class="clearfix">
                                <?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?>
								<div class="lpl-img">                                
									<a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" rel="bookmark">
										<img width="66" height="66" src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" data-tooltip="tooltip-d<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
"/>
									</a>
								</div>
                                <?php }?>
								<div class="lpl-content">
									<h6>
                                        <a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" rel="bookmark"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</a> 
                                        <?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><span><?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
</span><?php }?>
                                    </h6>
								</div>
							</li>
                            <?php }} ?>																					
						</ul>
					
					</div>
					<?php }?>
                    <?php if ($_smarty_tpl->getVariable('productSeller')->value){?>
					<div class="widget">
						<div class="widget-title clearfix"><h4 class="tag-title">Sản Phẩm Mới / ưa chuộng</h4></div>
						
						<ul class="latest-posts-list clearfix">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productSeller')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<li class="clearfix">
                                <?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?>
								<div class="lpl-img">                                
									<a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" rel="bookmark">
										<img width="66" height="66" src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" data-tooltip="tooltip-s<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
"/>
									</a>
								</div>
                                <?php }?>
								<div class="lpl-content">
									<h6>
                                        <a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
" rel="bookmark"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</a> 
                                        <?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><span><?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
</span><?php }?>
                                    </h6>
								</div>
							</li>
                            <?php }} ?>																					
						</ul>
					
					</div>
					<?php }?>
				<!-- END .col-sidebar -->
				</li>