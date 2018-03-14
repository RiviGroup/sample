<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Management List</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Add Product</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Product</th>
                                        <th>Subproduct</th>
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
                                        <td><?php echo $li->prod_name; ?></td>
                                        <td><?php echo $li->subprod_name; ?></td>
                                        <td><?php if($li->prod_status == 0) { echo "Active"; } else if($li->prod_status == 1){ echo "<p style='color:red'>Inactive</p>"; } else { echo "<p style='color:red'>Suspended</p>";} ?></td>
                                        <td class="center"><?php echo date('Y:m:d', strtotime($li->prod_regdatetime)); ?></td>
                                        <td class="center"><i class="fa fa-pencil-square-o" aria-hidden="true" onclick="edit_function(<?php echo $li->prod_id; ?>)" ></i></td>
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
		        <h4 class="modal-title">Add Product</h4>
			    <button type="button" class="close" data-dismiss="modal" id="close1">&times;</button>
		  </div>
			  <div class="modal-body">
				   <div class="col-lg-12">
						<form  id="addproduct" method="post" name="addproduct" action="<?php echo base_url()?>Admin/addproduct">
							<div class="col-lg-12 add_prod" id="add_prod">
								 <div class="row" >
									<div class="col-lg-6">
									    <div class="form-group">
									        <label for="Status"  style="font-weight:bold">Category</label>
										       <select name="category"  class="form-control" style="height:34px;">
												<option selected="yes" disabled="yes">Select Category</option>
												<?php foreach($lists as $list){ ?>
										        <option value="<?php echo $list->csp_id; ?>"><?php echo $list->csp_category; ?></option>
										        <?php } ?>
											   </select>
										   </div>
									     </div>
									<div class="col-lg-6">
										<div class="form-group">
									        <label for="Status"  style="font-weight:bold">Sub Category</label>
										       <select name="subcategory"  class="form-control" style="height:34px;">
												<option selected="yes" disabled="yes">Select SubCategory</option>
										        <?php foreach($lists as $list){ ?>
										        <option value="<?php echo $list->csp_id; ?>"><?php echo $list->csp_subcategory; ?></option>
										        <?php } ?>
										       </select>
										</div>
									</div>
									</div>
								<div class="row" >
									<div class="col-lg-6">
										<div class="form-group">
											<label for="password"  style="font-weight:bold">Product</label>
											<input type="text" class="form-control"  placeholder="Enter subproductname" name="product[]" id="subproduct">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="password"  style="font-weight:bold">Sub Product</label>
											<input type="text" class="form-control"  placeholder="Enter subproductname" name="subproduct[]" id="subproduct">
										</div>
									</div>
								</div>	
								<div id="multipleproduct"></div>
								<div class="col-lg-12" style="text-align:center">
								<button type="button" class="btn btn-primary" onclick="add_multipleproduct()" class="addmorelink">Add More</button>
								<button type="button" class="btn btn-success" onclick="add_product()">Submit</button>
								</div>
						</div>
					</form>
				</div>
		   </div>
      </div>
</div>
<!---->
<script>
 function edit_function(id)
{
	window.location.href="<?php echo base_url();?>Admin/edit_product/"+id;
}
</script> 		  
