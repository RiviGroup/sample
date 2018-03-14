<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product Management</h1>
                </div>
            </div>
           
            <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-info btn-sm">Edit Product</button>
                        </div>
		
	              <div class="panel-body">
					<form  id="update_product" method="post" name="update_product" action="<?php echo base_url()?>Admin/updateproduct/<?php echo $edit_list->prod_id; ?>">
						 <div class="col-lg-3">
							<div class="form-group">
									        <label for="Status"  style="font-weight:bold">Category</label>
										       <select name="category"  class="form-control" style="height:34px;">
												<option selected="yes" disabled="yes">Select Category</option>
												<?php foreach($list as $li){ ?>
										        <option value="<?php echo $li->csp_id; ?>"<?php if($li->csp_id == $edit_list->cat_id){ ?> selected="selected"<?php } ?>><?php echo $li->csp_category; ?></option>
										        <?php } ?>
											   </select>
										   </div>
							</div>
					
							    <div class="col-lg-3">
							       <div class="form-group">
									        <label for="Status"  style="font-weight:bold">Sub Category</label>
										       <select name="subcategory"  class="form-control" style="height:34px;">
												<option selected="yes" disabled="yes">Select SubCategory</option>
												<?php foreach($list as $li){ ?>
										        <option value="<?php echo $li->csp_id; ?>"<?php if($li->csp_id == $edit_list->subcate_id){ ?> selected="selected"<?php } ?>><?php echo $li->csp_subcategory; ?></option>
										        <?php } ?>
											   </select>
										   </div>
							    </div>
								
								<div class="col-lg-2">
							<div class="form-group">
								<label for="email" style="font-weight:bold">Product Name</label>
								<input type="text" class="form-control" placeholder="Enter product" name="product" id="product" value="<?php echo $edit_list->prod_name; ?>">
							</div>
						</div>
								
								<div class="col-lg-2">
							<div class="form-group">
								<label for="email" style="font-weight:bold">Subproduct Name</label>
								<input type="text" class="form-control" placeholder="Enter subproduct" name="subproduct" id="subproduct" value="<?php echo $edit_list->subprod_name; ?>">
							</div>
						</div>
								
								 <div class="col-lg-2">
							        <div class="form-group">
								         <label for="Status"  style="font-weight:bold">Status</label>
										 <select name="status"  class="form-control" style="    height: 34px;">
												<option selected="yes" disabled="yes">Select Status</option>
										        <option value="Active"<?php if($edit_list->prod_status == '0') { ?> selected="selected"<?php } ?>>Active</option>
										        <option value="InActive"<?php if($edit_list->prod_status == '1') { ?> selected="selected"<?php } ?>>InActive</option>
												<option value="Suspended"<?php if($edit_list->prod_status == '2') { ?> selected="selected"<?php } ?>>Suspended</option>
										</select>
										
							         </div>
							    </div>
					
							<div style="margin:10px;" class="pull-right">
								<button type="button" class="btn btn-primary" onclick="updateproduct(<?php echo $edit_list->prod_id; ?>)">Submit</button>
						    </div>
		            </form>
                 </div>
			</div>
</div>
</div>
<script>
function updateproduct(id)
{
	document.forms["update_product"].submit();
}
</script>