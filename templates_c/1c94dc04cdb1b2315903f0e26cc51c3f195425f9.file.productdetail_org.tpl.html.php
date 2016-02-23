<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-29 19:47:36
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/productdetail_org.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:12240553715540d2e8de32b5-47373195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c94dc04cdb1b2315903f0e26cc51c3f195425f9' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/productdetail_org.tpl.html',
      1 => 1430311647,
    ),
  ),
  'nocache_hash' => '12240553715540d2e8de32b5-47373195',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<style>
.zoom {
			display:inline-block;
			position: relative;
		}
		
		/* magnifying glass icon */
		.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(icon.png);
		}

		.zoom img {
			display: block;
		}

		.zoom img::selection { background-color: transparent; }
</style>

		
	
		
		<div class="section" style="padding: 0 30px;">
            <?php $_template = new Smarty_Internal_Template('navigation.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
        
       <!-- BEGIN .section -->
		<div class="section">
			
			<ul class="columns-content page-content clearfix">
				
                
				<!-- BEGIN .col-main -->
				<li class="col-main">
					<?php if ($_smarty_tpl->getVariable('objectItem')->value){?>
					
                    <div class="blog-title-single clearfix">
						<div class="fl">
							<h2><?php echo $_smarty_tpl->getVariable('objectItem')->value->getName();?>
<span><?php echo $_smarty_tpl->getVariable('objectItem')->value->getCatName();?>
</span></h2>
						</div>
						
					</div>
                    
                    <div class="blog-content clearfix">
                        <?php $_smarty_tpl->assign('photos',$_smarty_tpl->getVariable('objectItem')->value->getProperty('photos'),null,null);?>
                        <?php if ($_smarty_tpl->getVariable('photos')->value){?>
						<div class="block-img1 zoom" id="ex1"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('photos')->value[0];?>
" alt="" class="prev-image" /></div>
                        <?php }?>
                        <?php if ($_smarty_tpl->getVariable('objectItem')->value->getMarketPrice()){?><h2><span>Giá: </span> <?php echo $_smarty_tpl->getVariable('objectItem')->value->getMarketPrice();?>
 VND</h2><?php }?>
						<p><?php echo $_smarty_tpl->getVariable('objectItem')->value->getDetail();?>
</p>
						
					<!-- END .blog-content -->
					</div>
                    Để biết thêm chi tiết vui lòng <a href="/lien-he.html">Liên hệ với chúng tôi</a>.
						
				        <?php }else{ ?>
                        Sản phẩm không tồn tại.
                        <?php }?>
				<!-- END .col-main -->
				</li>
				
				<!-- BEGIN .col-sidebar -->
				<?php $_template = new Smarty_Internal_Template('right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				
			</ul>
			
		<!-- END .section -->
        
		</div>
        
<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>