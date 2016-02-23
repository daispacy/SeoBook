<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-21 10:14:58
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/products.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:19004848435535c0b2098979-05124591%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '36cb2d579e84a2037b159699df0976c890c8d659' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/products.tpl.html',
      1 => 1429586095,
    ),
  ),
  'nocache_hash' => '19004848435535c0b2098979-05124591',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    
	
    <!--
    <style>
    .columns-3 li.col3 {        
        min-height: 280px;
    }
    </style>-->
    <script>
    function realImgDimension(img) {
        var i = new Image();
        i.src = img.src;
        return {
            naturalWidth: i.width, 
            naturalHeight: i.height
        };
    }
    function setHeightLi(){
        var images = $("#results").find("li").map(function() { 
                //var realSize = realImgDimension(this);
                return $(this).height(); 
            
            }).get();
        var maxValueInArray = Math.max.apply(Math, images);
        console.log(images);
        console.log(maxValueInArray);
        $(".columns-3 li.col3").css("height",maxValueInArray);  
    }
    $(window).load(function(){
        
           setHeightLi();
        
        
    });
    //var myImage = document.getElementById('myImage');
           //var myImage = document.getElementsByTagName('img');
            //myImage.addEventListener('load', function() {
                //var realSize = realImgDimension(this);
            	//console.log('My width is: ', realSize.naturalWidth);
            	//console.log('My height is: ', realSize.naturalHeight);
            //});
    </script>
    	
    
		<!-- BEGIN .section 
		<div class="section section-mini">
			<h2 class="site-intro"><?php if ($_smarty_tpl->getVariable('estore')->value->getDescription()){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }?></h2>
		 
		</div>
		-->
		
        <div class="section" style="padding: 0 30px;">
            <?php $_template = new Smarty_Internal_Template('navigation.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
        </div>
       <!-- BEGIN .section -->
		<div class="section">
			
			<ul class="columns-content page-content clearfix">
            
				               
				<!-- BEGIN .col-main -->
				<li class="col-main">
					
					<h2 class="page-title">Danh sách sản phẩm</h2>
                    <?php if ($_smarty_tpl->getVariable('productItems')->value){?> 
						<ul id="results" class="columns-3 clearfix product-list">
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['no']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<li class="col3">
									<?php if ($_smarty_tpl->getVariable('item')->value->getAvatar()){?>
                                    <?php if ($_smarty_tpl->getVariable('item')->value->getSpecial()||$_smarty_tpl->getVariable('item')->value->getHome()||$_smarty_tpl->getVariable('item')->value->getSeller()){?><div class="<?php if ($_smarty_tpl->getVariable('item')->value->getSpecial()){?>deal<?php }elseif($_smarty_tpl->getVariable('item')->value->getHome()){?>offer<?php }else{ ?>seller<?php }?>_icon"></div><?php }?>
                                    <a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><img src="/upload/<?php echo $_smarty_tpl->getVariable('storeId')->value;?>
/products/l_<?php echo $_smarty_tpl->getVariable('item')->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
" class="full-image product-image" data-tooltip="tooltip-<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
"/></a><?php }?>
                					<p class="product-title"><a href="<?php echo $_smarty_tpl->getVariable('item')->value->getUrl();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</a></p>
                                    <!--<p class="product-price"><?php echo $_smarty_tpl->getVariable('item')->value->getCatName();?>
</p>-->
                					<?php if ($_smarty_tpl->getVariable('item')->value->getMarketPrice()){?><p class="product-price"><?php echo $_smarty_tpl->getVariable('item')->value->getMarketPrice();?>
</p><?php }?>
							</li>
							<?php }} ?>
						</ul> 
				<?php }else{ ?>
                Sản phẩm đang được cập nhật.
                <?php }?>
                <div class="animation_image" style="display:none" align="center">
                    <img src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/images/ajax-loader.gif"/>
                </div>
				<!-- END .col-main -->
				</li>
				
				<!-- BEGIN .col-sidebar -->
				<?php $_template = new Smarty_Internal_Template('right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				
			</ul>
			
		<!-- END .section -->
        
		</div>        
        <?php if (isset($_smarty_tpl->getVariable('rowsPages')->value)&&$_smarty_tpl->getVariable('rowsPages')->value['pages']>1){?>
        <input type="hidden" id="pages" value="<?php echo $_smarty_tpl->getVariable('rowsPages')->value['pages'];?>
"/>
        <input type="hidden" id="page" value="1"/>
        <?php if ($_smarty_tpl->getVariable('cCategory')->value){?><input type="hidden" id="cId" value="<?php echo $_smarty_tpl->getVariable('cCategory')->value->getId();?>
"/><?php }?>
        <input type="hidden" id="op" value="<?php echo $_smarty_tpl->getVariable('act')->value;?>
"/>
        <input type="hidden" id="kw" value="<?php echo $_smarty_tpl->getVariable('kw')->value;?>
"/>
        
        <script>
            $(document).ready(function() {
                 //total loaded record group(s)
                var loading  = false; //to prevents multipal ajax loads
                var total_groups = $("#pages").val(); //total record group(s)
                var cId = $("#cId").val(); //total record group(s) 
                var op = $("#op").val(); //total record group(s)  
                var kw = $("#kw").val(); //total record group(s)  
                var dk = 0;                       
                $(window).scroll(function() { //detect page scroll
                if (/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)){
                    dk=$("#rightside").offset().top
                }else{
                    dk=$("#footer").offset().top;
                }
                    var track_load = $("#page").val();
                    if(($(window).scrollTop() + $(window).height()) >= dk)  //user scrolled to bottom of the page?
                    {
                          
                        track_load ++;
                        if(track_load <= total_groups && loading==false) //there's more data to load
                        {
                            loading = true; //prevent further ajax loading
                            $('.animation_image').show(); //show loading image
                           
                            //load data from the server using a HTTP POST request
                            $.get('/ajax.php',{page: track_load,op:op,cId:cId,kw:kw}, function(data){
                                 
                                var result = data.split('|&');       
                                $("#page").val(result[0]);             
                                $("#results").append(result[1]); //append received data into the element
                                $("#resultTool").append(result[2]);
                                setHeightLi();
                                //hide loading image
                                $('.animation_image').hide(); //hide loading image once data is received
                               if (/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)){			
                                        if($('#ex1').length) $('#ex1').zoom();
                                        $('#image-tooltip').html('');
                                }else{
                                    stickytooltip("*[data-tooltip]", "image-tooltip");
                                }
                                
                                loading = false;
                           
                            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                               
                                alert(thrownError); //alert with HTTP error
                                $('.animation_image').hide(); //hide loading image
                                loading = false;
                           
                            });
                           
                        }
                    }
                });
            });
        </script>
        
        <?php }?>
        
<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>