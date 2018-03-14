<div id="page-wrapper" ng-app>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Menu Management List</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
		</div>
	</div>
					
<div class="row">
	<div class="col-lg-12">
	<form name="adding_menu" method="post" action="<?php echo base_url(); ?>Admin/menu_adding"
	>
		<div class="row">
		    <!--<form name="adding_menu" method="post">-->
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
						     <label class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Menu List</label>
						</div>
							<!-- /.panel-heading -->
						<div class="panel-body">
							<div>
							    <?php $i=1;foreach($list as $li){ ?>
							    <input type="checkbox" name="menu[]" id="checkp<?php echo $li->csp_category; ?>" class ="chk" onchange="check_menu('<?php echo $li->csp_category; ?>')" value="<?php echo $li->csp_category; ?>"> <?php echo $li->csp_category; ?></br>
							    <?php } ?>
							</div>						
						</div>
					</div>
							<!-- /.panel-body -->
				</div>
                    <!-- /.panel -->
				<div class="col-lg-3" id="hidden" style="display:none">
					<div>
						<div class="panel panel-default" >
							<div class="panel-heading">
							<label class="btn btn-info btn-sm">Sub Menu</label>
							</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<?php $i=1;foreach($list as $li){ ?>
							<span style="color:red" id="category<?php echo $li->csp_category; ?>"></span>
							<div  id="course<?php echo $li->csp_category; ?>">
							</div>
							<?php } ?>
						</div>
						</div>
					</div>
					<button class="btn btn-success" style="float:right">Create Menu</button>
				</div>
				<!--current menu-->
				<div class="col-lg-3">
					<div>
						<div class="panel panel-default" >
							<div class="panel-heading">
							<label class="btn btn-info btn-sm" type="button">Current Menu</label>
							<button class="btn btn-info btn-sm" type="button" id="edit_menus">Edit Menu</button>
							</div>
						<!-- /.panel-heading -->
						<div class="panel-body">
							<?php 
							$i=1;foreach($lists as $li){ ?>
							<span style="color:red"><i class="fa fa-times remove_menu" aria-hidden="true" id='<?php echo $li->menu_name; ?>' onclick="remove_menu('<?php echo $li->menu_name; ?>')"></i> <?php echo $li->menu_name; ?></span>
							<div  id="course"><?php $arr =explode(",",$li->submenu); foreach($arr as $a){ 
	echo "<i class='fa fa-times remove_submenu' aria-hidden='true' onclick='remove_submenu(".$a.")' id='"?><?php echo $a; ?><?php echo "'></i> ".$a."</br>"; } ?>
							</div><hr>
							<?php } ?>
						</div>
						</div>
					</div>
				</div>
			<!--</form>	-->	
			</div>
	</form>
    </div>
</div>
</div>

<script>
function check_menu(val)
{
	if($("#checkp"+val).is(':checked')){
    $("#hidden").show();
    $.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>Admin/get_submenulist/'+val,
			success: function(data) {
				
										var json = JSON.parse(data);
										var countriesdata=json["list"];
									    for(var i=0;i<countriesdata.length;i++)
																			{
																			var csp_category=countriesdata[i]["csp_category"];	
																			var csp_subcategorys=countriesdata[i]["csp_subcategory"];
																			$("#course"+csp_category).append('<input type="checkbox" id="ee" name="submenu['+csp_category+'][]" value="'+csp_subcategorys+'"> '+csp_subcategorys+'</br>');
																			}
																		    $("#category"+csp_category).append(csp_category);
                                                                																		
                                    }
		  });
} else {
	 
        $('#course'+val).empty().prepend('');
	    $('#category'+val).empty().prepend('');
}
}

function sub_menu(){
	
	var bb = document.getElementById("ee").value;
	for (var i = 0; i < bb.length; i++){
    var ne = document.getElementById("ee").value
    alert(ne);
	}
}

function remove_menu(val)
{
	
	var retVal = confirm("Are you want to remove menu "+ val +" ?");
    if( retVal == true ){
	document.location.href ="<?php echo base_url()?>Admin/remove_menu/"+val;
	return true;
	}
}

function remove_submenu(val)
{
	
	var retVal = confirm("Are you want to remove menu "+ val +" ?");
    if( retVal == true ){
	document.location.href ="<?php echo base_url()?>Admin/remove_menu/"+val;
	return true;
	}
}

function remove_submenu(val)
{
	alert(val);
	//var retVal = confirm("Are you want to remove menu "+ val +" ?");
    ///if( retVal == true ){
	//document.location.href ="<?php echo base_url()?>Admin/remove_menu/"+val;
	//return true;
	//}
}
</script>






