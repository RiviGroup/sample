<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category Management List</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Add Category</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
								
							<?php $i=1; foreach($list as $li){ ?>
                                    <tr class="odd gradeX">
									    <td><?php echo $i; ?></td>
                                        <td><?php echo $li->csp_category; ?></td>
                                        <td><?php echo $li->csp_subcategory; ?></td>
                                        <td><?php if($li->status == 0) { echo "Active"; } else if($li->status == 1){ echo "Inactive"; } else { echo "Suspended"; } ?></td>
                                        <td class="center"><?php echo  date('Y:m:d', strtotime($li->csp_datetime)); ?></td>
                                        <td class="center"><i class="fa fa-pencil-square-o"  aria-hidden="true" onclick="edit_function(<?php echo $li->csp_id; ?>)"></i></td>
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

<div id="add_category" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <h1><?php echo  $this->session->flashdata('message_register'); ?></h1>
   <div class="modal-content">
      <div class="modal-header">
       <h4 class="modal-title">Add Category</h4>
		 <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
       </div>
      <div class="modal-body">
            <div class="col-lg-12">
				<form  id="addcategory" method="post" name="addcategory" action="<?php echo base_url()?>Admin/addcategory">
					<div class="row" >
					<div class="col-lg-12 add_cat" id="add_cat">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="email" style="font-weight:bold">Category</label>
								<input type="text" class="form-control" placeholder="Enter Category" name="category[]" id="category">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								 <label for="password"  style="font-weight:bold">Sub Category</label>
								 <input type="text" class="form-control"  placeholder="Enter SubCategory" name="subcategory[]" id="subcategory">
							 </div>
						</div>
					</div>	
						<div id="more"></div>
						
						<div class="col-lg-12" style="text-align:center">
						<button type="button" class="btn btn-primary" onclick="add_multiplecategories()" class="addmorelink">Add More</button>
						<button type="button" class="btn btn-success" onclick="add_category()">Submit</button>
					</div>
					</div>
		        </form>
			</div>
        </div>
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
		  
