<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Referrer Management</h1>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-3">
				      
				</div>
			</div>
					
			<div class="row">
	         <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Referrer Management</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
							  <li class="active"><a data-toggle="tab" href="#refferaddtype">Referrer Add Type</a></li>
							  <li><a data-toggle="tab" href="#referrerreg">Referrer Register</a></li>
							
							</ul>

							<div class="tab-content">
							    <div id="refferaddtype" class="tab-pane fade in active">
								<h3>Referrer</h3>
								<div class="col-md-12">
									<form class="form-horizontal" method="post" name="referrer_add_type" action="<?php echo base_url(); ?>referrer_add_type">
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Category <span style="color:red">*</span></label>
										<div class="col-sm-4">
									    <input type="text" class="form-control" id="referrercategory" placeholder="Enter Referrer Category" name="referrercategory">
										<span id="namevalidation" style="color:red;display:none">Please enter name</span>
										</div>
										<label class="control-label col-sm-2" for="pwd">Refer Group <span style="color:red">*</span></label>
										<div class="col-sm-4">          
										<input type="text" class="form-control" id="referrer_group" placeholder="Enter Referrer Group" name="referrer_group">
										<span id="emailvalidation" style="color:red;display:none">Please enter valid emailid</span>
										</div>
										</div>
										
										
										
										<div class="form-group">
										 <div class="col-sm-offset-2 col-sm-10">
											<button type="button" class="btn btn-default" onclick="from_validation()">Submit</button>
										  </div>
										</div>
									  </form>
                                    </div>
									
								
									<div class="col-md-12">
									  <div class="panel-body">
									  	<hr>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Referrer Type</th>
                                        <th>Referrer Group</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
								
							<?php $i=1; foreach($referer_type as $li){ ?>
                                    <tr class="odd gradeX">
									    <td><?php echo $i; ?></td>
                                        <td><?php echo $li->ref_type_name; ?></td>
                                        <td><?php echo $li->ref_type_group; ?></td>
                                        <td><?php  if($li->ref_type_status == 1 ){ echo "Enable"; } else  { echo "Disable"; } ?></td>
                                       <td class="center"><a href="" data-toggle="modal" data-target="#myModal" onclick="edit_referrer(<?php echo $li->ref_type_id; ?>)"><i class="fa fa-pencil-square-o"  aria-hidden="true"  data-id="<?php echo $li->ref_type_id; ?>"></i></a></td>
                                    </tr>
							<?php $i++; } ?>
                                  </tbody>
                            </table>
                          </div>
						</div>
						
						<div id="myModal" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content" style="width:900px;margin-top:290px;margin-left:-180px">
										<div class="modal-header">
										<h4>Edit Referrer Type</h4>
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<!--<h4 class="modal-title">Confirmation</h4>-->
										</div>
										<div class="modal-body">
									     <div class="col-md-12">
									     <form class="form-horizontal" method="post" name="referrer_edit_type" action="<?php echo base_url(); ?>referrer_update_type">
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Category <span style="color:red">*</span></label>
										<div class="col-sm-4">
									    <input type="text" class="form-control" id="referrereditcategory" placeholder="Enter Referrer Category" name="referrereditcategory">
										<span id="namevalidation" style="color:red;display:none">Please enter name</span>
										</div>
										<label class="control-label col-sm-2" for="pwd">Refer Group <span style="color:red">*</span></label>
										<div class="col-sm-4">          
										<input type="text" class="form-control" id="referreredit_group" placeholder="Enter Referrer Group" name="referreredit_group">
										<input type="hidden"  class="form-control" id="referupdateid" placeholder="Enter Referrer Group" name="referupdateid">
										<span id="emailvalidation" style="color:red;display:none">Please enter valid emailid</span>
										</div>
										</div>
										
									    <div class="form-group">
										    <div class="col-sm-offset-2 col-sm-10">
											     <button type="button" class="btn btn-success" onclick="update_referrer()">Submit</button>
										     </div>
										</div>
									  </form>
                                    </div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											<!--<button type="button" class="btn btn-primary">Save changes</button>-->
										</div>
									</div>
								</div>
							</div>
						</div>
							  <!-- Existing User-->
							<div id="referrerreg" class="tab-pane fade">
								<h3>Referrer Register</h3>
							<div class="col-md-12">
									<form class="form-horizontal" method="post" name="referreg" action="<?php echo base_url(); ?>referrer_add_registration">
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Name <span style="color:red">*</span></label>
										<div class="col-sm-4">
									    <input type="text" class="form-control" id="referrername" placeholder="Enter Referrer Name" name="referrername">
										<span id="namevalidation" style="color:red;display:none">Please enter name</span>
										</div>
										<label class="control-label col-sm-2" for="pwd">Refer Type <span style="color:red">*</span></label>
										<div class="col-sm-4"> 
										<select class="form-control" style="height:33px" id="referrer_type" name="referrer_type"  onchange="select_group()">
											
											<option disabled="yes" selected="yes">Select Refer Type</option>
											<?php foreach($referer_type as $role){ ?>
											 <option value="<?php echo $role->ref_type_id; ?>"><?php echo $role->ref_type_name; ?></option>
											<?php } ?>
											</select>
										</div>
										</div>
										
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Group <span style="color:red">*</span></label>
										<div class="col-sm-4"> 
										<select class="form-control" style="height:33px" id="selectgroup" name="selectgroup">
											<option disabled="yes" selected="yes">Select Refer Group</option>
											</select>
										</div>
										<label class="control-label col-sm-2" for="pwd">Refer Location <span style="color:red">*</span></label>
										<div class="col-sm-4">          
										<input type="text" class="form-control" id="referrer_location" placeholder="Enter Location" name="referrer_location">
										<span id="emailvalidation" style="color:red;display:none">Please enter valid emailid</span>
										</div>
										</div>
										
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Code <span style="color:red">*</span></label>
										<div class="col-sm-4">
									    <input type="text" class="form-control" id="referrer_code" placeholder="Enter Referrer Code" name="referrer_code">
										<span id="namevalidation" style="color:red;display:none">Please enter name</span>
										</div>
										</div>
										
										<div class="form-group">
										 <div class="col-sm-offset-2 col-sm-10">
											<button type="button" class="btn btn-default" onclick="refer_validation()">Submit</button>
										  </div>
										</div>
									  </form>
                                    </div>
									
									<div class="col-md-12">
									  <div class="panel-body">
									  	<hr>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Referrer Type</th>
                                        <th>Referrer Group</th>
                                        <th>Referrer Name</th>
                                        <th>Referrer Location</th>
                                        <th>Referrer CODE</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
								
							<?php $i=1; foreach($referer_corporate as $li){ ?>
                                    <tr class="odd gradeX">
									    <td><?php echo $i; ?></td>
                                        <td><?php echo $li->ref_type_name; ?></td>
                                        <td><?php echo $li->ref_type_group; ?></td>
                                        <td><?php echo $li->ref_corp_name; ?></td>
                                        <td><?php echo $li->ref_corp_location; ?></td>
                                        <td><?php echo $li->ref_corp_code; ?></td>
                                        <td><?php  if($li->ref_corp_status == 1 ){ echo "Enable"; } else  { echo "Disable"; } ?></td>
                                       <td class="center"><a href="" data-toggle="modal" data-target="#myModals"><i class="fa fa-pencil-square-o"  onclick="edit_referrer_corporate(<?php echo $li->ref_corp_id; ?>)" aria-hidden="true" ></i></a></td>
                                    </tr>
							<?php $i++; } ?>
                                  </tbody>
                            </table>
                          </div>
						</div>
						
						<!--data modal loading-->
						<div id="myModals" class="modal fade">
								<div class="modal-dialog">
									<div class="modal-content" style="width:900px;margin-top:290px;margin-left:-180px">
										<div class="modal-header">
										<h4>Edit Referrer Register</h4>
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<!--<h4 class="modal-title">Confirmation</h4>-->
										</div>
										<div class="modal-body">
									     <div class="col-md-12">
									<form class="form-horizontal" method="post" name="edit_referreg" action="<?php echo base_url(); ?>referrer_edit_refer">
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Name <span style="color:red">*</span></label>
										<div class="col-sm-4">
										<input type="hidden"  class="form-control" id="edit_corp_referupdateid" placeholder="Enter Referrer Group" name="edit_corp_referupdateid">
									    <input type="text" class="form-control" id="edit_referrername" placeholder="Enter Referrer Name" name="edit_referrername">
										<span id="namevalidation" style="color:red;display:none">Please enter name</span>
										</div>
										<label class="control-label col-sm-2" for="pwd">Refer Type <span style="color:red">*</span></label>
										<div class="col-sm-4"> 
										<select class="form-control" style="height:33px;" id="edit_referrer_types" name="edit_referrer_types"  onchange="edit_select_group()">
											
											<!--<option disabled="yes" selected="yes">Select Refer Type</option>-->
											<?php foreach($referer_type as $role){ ?>
											 <option value="<?php echo $role->ref_type_id; ?>"><?php echo $role->ref_type_name; ?></option>
											<?php } ?>
											</select>
										</div>
										</div>
										
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Group <span style="color:red">*</span></label>
										<div class="col-sm-4"> 
										<select class="form-control" style="height:33px" id="edit_referrer_group" name="edit_referrer_group">
											
											</select>
										</div>
										<label class="control-label col-sm-2" for="pwd">Refer Location <span style="color:red">*</span></label>
										<div class="col-sm-4">          
										<input type="text" class="form-control" id="edit_referrer_location" placeholder="Enter Location" name="edit_referrer_location">
										<span id="emailvalidation" style="color:red;display:none">Please enter valid emailid</span>
										</div>
										</div>
										
										<div class="form-group">
										<label class="control-label col-sm-2" for="email">Refer Code <span style="color:red">*</span></label>
										<div class="col-sm-4">
									    <input type="text" class="form-control" id="edit_referrer_code" placeholder="Enter Referrer Code" name="edit_referrer_code">
										<span id="namevalidation" style="color:red;display:none">Please enter name</span>
										</div>
										</div>
										
										<div class="form-group">
										 <div class="col-sm-offset-2 col-sm-10">
											<button type="button" class="btn btn-default" onclick="edit_refer_validation()">Submit</button>
										  </div>
										</div>
									  </form>
                                    </div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
											<!--<button type="button" class="btn btn-primary">Save changes</button>-->
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
				</div>
                        <!-- /.panel-body -->
            </div>
                    <!-- /.panel -->
        </div>
    </div>
</div>
<script>
function from_validation()
{
	
	document.forms["referrer_add_type"].submit();
	
}

function edit_refer_validation()
{
	
	document.forms["edit_referreg"].submit();
	
}

function refer_validation()
{
	
	document.forms["referreg"].submit();
	
}

//select drop down for register

function select_group()
{
 
 $("#selectgroup").empty().prepend();
 var refer_type = document.getElementById("referrer_type").value;
 $.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>select_refer_type',
		data: "referre_type="+refer_type,
		success: function(datas){
				//alert('suman'+datas);
				                    var json = JSON.parse(datas);
									var dropdownlist = json["lists"];
									console.log(dropdownlist);
                                    for(var i=0;i<dropdownlist.length;i++){
                                                       var sel_type_id = dropdownlist[i]['ref_type_id'];
                                                       var sel_stype_ghroup = dropdownlist[i]['ref_type_group'];
                                                      // alert(sel_subcategory);
                                                       $("#selectgroup").append('<option value="'+sel_type_id+'">'+sel_stype_ghroup+'</option>');
                                                       }
								    }
			});
}


//end for regioster drop down


//edit drop_down for register

function edit_select_group()
{
 
 $("#edit_referrer_group").empty().prepend();
 var refer_type = document.getElementById("edit_referrer_types").value;
 $.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>select_refer_type',
		data: "referre_type="+refer_type,
		success: function(datas){
				//alert('suman'+datas);
				                    var json = JSON.parse(datas);
									var dropdownlist = json["lists"];
									console.log(dropdownlist);
                                    for(var i=0;i<dropdownlist.length;i++){
                                                       var sel_type_id = dropdownlist[i]['ref_type_id'];
                                                       var sel_stype_ghroup = dropdownlist[i]['ref_type_group'];
                                                      // alert(sel_subcategory);
                                                       $("#edit_referrer_group").append('<option value="'+sel_type_id+'">'+sel_stype_ghroup+'</option>');
                                                       }
								    }
			});
}

//end for drop down for edit register


function edit_referrer(id)
{
       var refer_type = id;
   $.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>edit_referrer/'+refer_type,
			success: function(datas){
				
				                    var json = JSON.parse(datas);
									var dropdownlist = json["lists"];
									console.log(dropdownlist);
                                  
                                    var sel_type_name = dropdownlist['ref_type_name'];
                                    var sel_stype_ghroup = dropdownlist['ref_type_group'];
                                    var sel_type_id = dropdownlist['ref_type_id'];
                                    $('#referrereditcategory').val(dropdownlist['ref_type_name']);
									$('#referreredit_group').val(dropdownlist['ref_type_group']);
									$('#referupdateid').val(dropdownlist['ref_type_id']);
									}
			});
	
}

function update_referrer()
{
	document.forms["referrer_edit_type"].submit();
}

function edit_referrer_corporate(id)
{
	//var $persons = $("#edit_referrer_types").empty();
	var refer_corp_id = id;
    $.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>edit_corp_referrer/'+refer_corp_id,
			success: function(data){
			
			
				                    var json = JSON.parse(data);
									var dropdownlist = json["listss"];
									var sel_type_name = dropdownlist['ref_type_name'];
                                    var sel_stype_ghroup = dropdownlist['ref_type_group'];
                                    var sel_type_id = dropdownlist['ref_type_id'];
                                    $('#edit_referrername').val(dropdownlist['ref_corp_name']);
									$("#edit_referrer_types").append('<option value="'+dropdownlist['ref_type_id']+'">'+dropdownlist['ref_type_name']+'</option>');
									$('#edit_referrer_group').append('<option value="'+dropdownlist['ref_corp_group']+'">'+dropdownlist['ref_type_group']+'</option>');
									$('#edit_referrer_location').val(dropdownlist['ref_corp_location']);
									$('#edit_referrer_code').val(dropdownlist['ref_corp_code']);
									$('#edit_corp_referupdateid').val(dropdownlist['ref_corp_id']);
									}
								
								
	});
	
	
}


</script>