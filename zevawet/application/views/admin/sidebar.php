<div id="wrapper">
<div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
		
            <ul class="nav" id="side-menu">
			<?php if($this->session->userdata('user_role') == 1){ ?>
				<li>
                <a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                </li>
				<?php  $temp_name=""; foreach($sidemenus as $menu){ ?>
				<li>
				<?php if($menu->crm_submenu != "" ) { ?>
				<?php if($menu->crm_menuname != $temp_name) { $string = str_replace("_", " ", $menu->crm_menuname); ?>
				<a href="#" onclick="submenu_change('<?php echo $menu->crm_menuname; ?>')"><?php echo $string; ?></a>
				<?php } ?>
				<ul class="submenus_list">
				
			    </ul>
				
				<?php } else if($menu->crm_menuname != $temp_name){ ?>
				<a href="<?php echo base_url(); ?><?php echo $menu->crm_menuname; ?>"><?php echo $menu->crm_menuname; ?></a>
				<?php } ?>
			    </li>
				<?php  $temp_name = $menu->crm_menuname; } ?>
				
				
				<!--Moderator -->
			<?php } else if($this->session->userdata('user_role') == 2) { ?>
			    <li>
                <a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                </li>
			    <?php  $temp_name=""; foreach($sidemenus as $menu){ 
				 if($menu->role_id == 2){
				
				?>
				<li>
				<?php if($menu->crm_submenu != "" ) { ?>
				<?php if($menu->crm_menuname != $temp_name) { ?>
				<a href="#" onclick="submenu_change('<?php echo $menu->crm_menuname; ?>')"><?php echo $menu->crm_menuname; ?></a>
				<?php } ?>
				<ul class="submenus_list">
				
			    </ul>
				
				<?php } else if($menu->crm_menuname != $temp_name){ ?>
				<a href="<?php echo base_url(); ?><?php echo $menu->crm_menuname; ?>"><?php echo $menu->crm_menuname; ?></a>
				<?php } ?>
			    </li>
				<?php  $temp_name = $menu->crm_menuname; } }?>
			
			<!--marketing -->
			<?php }  else { ?>
			    
			    <li>
                <a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
                </li>
				 <?php  $temp_name=""; foreach($sidemenus as $menu){   

                          if($menu->role_id == 3){

				 ?>
				 
				<li>
				<?php if($menu->crm_submenu != "" ) { ?>
				<?php if($menu->crm_menuname != $temp_name) { ?>
				<a href="#" onclick="submenu_change('<?php echo $menu->crm_menuname; ?>')"><?php echo $menu->crm_menuname; ?></a>
				<?php } ?>
				<ul class="submenus_list">
				
			    </ul>
				
				<?php } else if($menu->crm_menuname != $temp_name){ ?>
				<a href="<?php echo base_url(); ?><?php echo $menu->crm_menuname; ?>"><?php echo $menu->crm_menuname; ?></a>
				<?php } ?>
			    </li>
				<?php  $temp_name = $menu->crm_menuname; } ?>
			<?php } }?>
			</ul>
        </div>
</div>

<script>
function submenu_change(suman)
{
	//alert(suman);
	
	$(".submenus_list").empty().prepend('');
	   $.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>get_submenulist/'+suman,
			success: function(data) {
				//alert(data);
								var json = JSON.parse(data);
								var datas=json["lists"];
								console.log(datas);
								 for(var i=0;i<datas.length;i++)
															{
															var csp_category=datas[i]["crm_submenu"];
															var hyperlinks = csp_category.replace(/ /g , "_");
															//console.log(hyperlinks);
															//console.log(csp_category);
															$(".submenus_list").append("<li><a href='"+hyperlinks+"'> "+csp_category+"</a></li>");
															} 
									}
									
		  });
}
</script>

