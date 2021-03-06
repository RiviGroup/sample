<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Management</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">User Management</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
							  <li class="active"><a data-toggle="tab" href="#createuser">Create User</a></li>
							  <li><a data-toggle="tab" href="#existinguser">Existing User</a></li>
							
							</ul>

							<div class="tab-content">
							    <div id="createuser" class="tab-pane fade in active">
								<h3>Create User</h3>
								<div class="col-md-12">
									<form class="form-horizontal" method="post" name="create_user" action="<?php echo base_url(); ?>createuser">
										<div class="form-group">
										  <label class="control-label col-sm-2" for="email">Name <span style="color:red">*</span></label>
										  <div class="col-sm-4">
											<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" onblur="mobile_validation()">
										   <span id="namevalidation" style="color:red;display:none">Please enter name</span>
										  </div>
										  <label class="control-label col-sm-2" for="pwd">Email <span style="color:red">*</span></label>
										  <div class="col-sm-4">          
											<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" onblur="mobile_validation()">
										  <span id="emailvalidation" style="color:red;display:none">Please enter valid emailid</span>
										  </div>
										</div>
										<div class="form-group">
										  <label class="control-label col-sm-2" for="pwd">Mobile no <span style="color:red">*</span></label>
										  <div class="col-sm-4">          
											<input type="text" class="form-control" id="mobileno" placeholder="Enter Mobileno" name="mobileno" onblur="mobile_validation()">
										    <span id="mobilealida" style="color:red;display:none">Mobileno Already exist</span>
										    <span id="mobileempty" style="color:red;display:none">Please enter mobileno</span>
										  </div>
										  <label class="control-label col-sm-2" for="pwd">User Type <span style="color:red">*</span></label>
										  <div class="col-sm-4">          
											<select class="form-control" style="height:33px" id="usertype" name="usertype"  onchange="mobile_validation()">
											
											<option disabled="yes" selected="yes">Select Usertype</option>
											<?php foreach($roles as $role){ ?>
											 <option value="<?php echo $role->crm_role_id; ?>"><?php echo $role->crm_role_name; ?></option>
											<?php } ?>
											</select>
											<span id="selectvalu" style="color:red;display:none">Please select user type</span>
										  </div>
										  
										</div>
										<div class="form-group">
										 <div class="col-sm-offset-2 col-sm-10">
											<button type="button" class="btn btn-default" onclick="from_validation()">Submit</button>
										  </div>
										</div>
									  </form>
                                    </div>
 							     </div>
							  <!-- Existing User-->
							<div id="existinguser" class="tab-pane fade">
								<h3>Existing User</h3>
								<div class="row">
									 <div class="col-lg-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Existing User List</button>
												</div>
												<!-- /.panel-heading -->
												<div class="panel-body">
													<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
														<thead>
															<tr>
																<th>S.No</th>
																<th>Name</th>
																<th>Email</th>
																<th>Mobile No</th>
																<th>User Type</th>
																<th>Created On</th>
																<th>View</th>
															 </tr>
														</thead>
														<tbody>
														
													<?php $i=1; foreach($lists as $li){ ?>
															<tr class="odd gradeX">
																<td><?php echo $i; ?></td>
																<td><?php echo $li->admin_name; ?></td>
																<td><?php echo $li->admin_email; ?></td>
																<td><?php echo $li->admin_mobile; ?></td>
																<td><?php if($li->admin_type == 1) { echo "Admin"; } else if($li->admin_type == 2){ echo "Moderator"; } else if($li->admin_type == 3) { echo "Marketing"; }?></td>
																<td class="center"><?php echo  date('d-m-Y', strtotime($li->admin_created_on)); ?></td>
																<td class="center"><i class="fa fa-pencil-square-o"  aria-hidden="true" onclick="edit_existinguser(<?php echo $li->admin_id; ?>)"></i></td>
															</tr>
													<?php $i++; } ?>
														  </tbody>
													</table>
												 
												   
												</div>
												<!-- /.panel-body -->
											</div>
											<!-- /.panel -->
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
	var name = document.getElementById("name").value;
	if(name == ""){
		$("#namevalidation").show();
		return false;
	} else {
		$("#namevalidation").hide();
	}
	
	 var email = document.getElementById("email").value;
	if(email == ""){
		$("#emailvalidation").show();
		return false;
	} else if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		$("#emailvalidation").hide();
	} else {
		$("#emailvalidation").show();
		return false;
	}
	
	var mobile_no = document.getElementById("mobileno").value;
	if(mobile_no == ""){
		$("#mobileempty").show();
		 $("#mobilealida").hide();
		 return false;
	} else {
		$("#mobileempty").hide();
	}
	
	if(document.getElementById('usertype').value == "Select Usertype"){
	$("#selectvalu").show();
	return false;
	} else  {
	document.forms["create_user"].submit();
	//document.location.href = "<?php echo base_url(); ?>createuser";
	}
}

function mobile_validation()
{
	 var name = document.getElementById("name").value;
	if(name == ""){
		$("#namevalidation").show();
	} else {
		$("#namevalidation").hide();
	}
	
	 var email = document.getElementById("email").value;
	
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
		$("#emailvalidation").hide();
	} else {
		$("#emailvalidation").show();
	}
	
	var mobile_no = document.getElementById("mobileno").value;
	if(mobile_no == ""){
		$("#mobileempty").show();
		 $("#mobilealida").hide();
	} else {
		$("#mobileempty").hide();
	}
	
     $.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>mobilevalidation/'+mobile_no,
			success: function(datas){
				                   if(datas == 1)
								   {
									   $("#mobilealida").show();
								   } else {
									   $("#mobilealida").hide();
								   }
								   
									}
								
									
		  });
		  
		if(document.getElementById('usertype').value == "Select Usertype"){
	$("#selectvalu").show();
	} else {
		$("#selectvalu").hide();
	}  
		  
}

function edit_existinguser(id)
{
	
alert(id);	
}




   
      

</script>