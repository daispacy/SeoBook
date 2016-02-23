<?php /* Smarty version Smarty-3.0-RC2, created on 2015-04-21 11:18:05
         compiled from "/home/hun6fd6d/public_html/templates/organicshop/contact.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:3373898545535cf7dee86d5-39075550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3dacb00071be7daace3fa0067e843a0fbd5c6f72' => 
    array (
      0 => '/home/hun6fd6d/public_html/templates/organicshop/contact.tpl.html',
      1 => 1429589883,
    ),
  ),
  'nocache_hash' => '3373898545535cf7dee86d5-39075550',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('header.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

		
		<!-- BEGIN .section -->
		<div class="section section-mini">
			<h2 class="site-intro"><?php if ($_smarty_tpl->getVariable('estore')->value->getDescription()){?><?php echo $_smarty_tpl->getVariable('estore')->value->getDescription();?>
<?php }?></h2>
		<!-- END .section -->
		</div>
		
		
        
       <!-- BEGIN .section -->
		<div class="section">
			
			<ul class="columns-content page-content clearfix">
				
				<!-- BEGIN .col-main -->
				<li class="col-main">
					
					<h2 class="page-title">Liên hệ</h2>
					
					<ul class="columns-2 clearfix">					
						<li class="col2">
							<h4 style="text-transform: capitalize;"><?php echo $_smarty_tpl->getVariable('estore')->value->getName();?>
</h4>
							<ul>
								<li><?php echo $_smarty_tpl->getVariable('estore')->value->getAddress();?>
</li>
								<li><?php echo $_smarty_tpl->getVariable('estore')->value->getTel();?>
</li>
								<li><?php echo $_smarty_tpl->getVariable('estore')->value->getEmail();?>
</li>
							</ul>
						</li>
					</ul>

					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
					<script type="text/javascript" src="/<?php echo $_smarty_tpl->getVariable('templatePath')->value;?>
/<?php echo $_smarty_tpl->getVariable('userTemplate')->value;?>
/js/jquery.gmap.min.js?v=1"></script>

					<div id="google-map" style="width:100%;height:250px;"></div>
                    
					<script type="text/javascript">
						$(document).ready(function($) {
							$("#google-map").gMap({latitude: 10.795786,longitude: 106.627363,maptype: "ROADMAP",zoom: 18,markers: [
								{latitude: 10.795786,longitude: 106.627363,address: "61 Gò Dầu, Tân Quý, Ho Chi Minh, Vietnam",popup: true,html: "Thiết Bị Vệ Sinh - Nội Thất Hưng Phát"}
									],controls: {panControl: true,zoomControl: true,mapTypeControl: true,scaleControl: true,streetViewControl: false,overviewMapControl: false}
							});
						});
					</script>
                    
                    <!--
					<h4>Send Us An Email</h4>

					<form action="#" id="contactform" class="clearfix" method="post">

						<div class="field-row">
							<label for="contact_name">Name <span>(required)</span></label>
						    <input type="text" name="contact_name" id="contact_name" class="text_input" value="" />
						</div>

						<div class="field-row">
							<label for="email">Email <span>(required)</span></label>
							<input type="text" name="email" id="email" class="text_input" value="" />		
						</div>

						<div class="field-row">
							<label for="message_text">Message</label>
							<textarea name="message" id="message_text" class="text_input" cols="60" rows="9"></textarea>
						</div>

						<input class="button2" type="submit" value="Send Email" id="submit" name="submit">

					</form>
				    -->
				<!-- END .col-main -->
				</li>
				
				<?php $_template = new Smarty_Internal_Template('right.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
				
			</ul>
			
		<!-- END .section -->
		</div>
        
<?php $_template = new Smarty_Internal_Template('footer.tpl.html', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','site-header'); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>