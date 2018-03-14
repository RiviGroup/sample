<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patients List</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Registrations</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body table-responsive">
                            <table  class="table table-bordered table-condensed" id="dataTables-example" style=" width:100%; overflow-x: hidden;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Patient Id</th>
                                        <th>FirstName</th>
                                        <th>LastName</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Device</th>
                                        <th>View Profile</th>
                                    </tr>
                                </thead>
								
							<?php $i=1; foreach($lists as $li){ ?>
                                    <tr class="odd gradeX">
									    <td><?php echo $i; ?></td>
									    <td><?php echo $li->user_id; ?></td>
                                        <td><?php echo $li->user_firstname; ?></td>
                                        <td><?php echo $li->user_lastname; ?></td>
                                        <td><?php echo $li->user_email; ?></td>
                                        <td><?php echo $li->user_mobile; ?></td>
                                        <td><?php if($li->user_gender == 1) { echo "Male"; } else if($li->user_gender == 2){ echo "Female"; } ?></td>
										 <td><?php echo $li->user_city; ?></td>
										  <td><?php echo $li->user_state; ?></td>
										  <td><?php echo $li->user_is_active; ?></td>
                                        <td class="center"><?php echo  date('Y-m-d', strtotime($li->user_created_on)); ?></td>
										 <td><?php echo $li->user_device_type; ?></td>
                                        <td class="center"><a href="#" onclick="edit_function(<?php echo $li->user_id; ?>)">View</a></td>
                                    </tr>
							<?php $i++; } ?>
                          </table>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
			</div>
</div>

 
  <!---->
 <script>
 function edit_function(id)
{
	 window.location.href="<?php echo base_url();?>patient_page/"+id;
    
}
</script> 
		  
