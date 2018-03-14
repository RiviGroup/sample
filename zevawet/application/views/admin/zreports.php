<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reports</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Reports</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>FirstName</th>
                                        <th>LastName</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
								
							<?php //$i=1; foreach($lists as $li){ ?>
                                    <tr class="odd gradeX">
									    <td><?php //echo $i; ?></td>
                                        <td><?php //echo $li->doctor_firstname; ?></td>
                                        <td><?php //echo $li->doctor_lastname; ?></td>
                                        <td><?php //echo $li->doctor_email; ?></td>
                                        <td><?php //echo $li->doctor_mobile; ?></td>
                                        <td><?php //if($li->doctor_gender == 1) { echo "Male"; } else if($li->doctor_gender == 2){ echo "Female"; } ?></td>
                                        <td class="center"><?php //echo  date('Y:m:d', strtotime($li->doctor_dob)); ?></td>
                                        <td class="center"><i class="fa fa-pencil-square-o"  aria-hidden="true" onclick="edit_function(<?php //echo $li->doctor_id; ?>)"></i></td>
                                    </tr>
							<?php //$i++; } ?>
                                  </tbody>
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
	 window.location.href="<?php echo base_url();?>Admin/edit_category/"+id;
    
}
</script> 
		  
