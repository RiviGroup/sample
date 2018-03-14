<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category Management</h1>
                </div>
            </div>
           
            <div class="row">
			<div class="col-lg-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-info btn-sm">Edit Category</button>
                        </div>
		
	              <div class="panel-body">
					<form  id="editcategory" method="post" name="editcategory" action="<?php echo base_url()?>Admin/update_editcategory/<?php echo $edit_list->csp_id; ?>">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="email" style="font-weight:bold">Category</label>
								<input type="text" class="form-control" placeholder="Enter Category" name="category" id="category" value="<?php echo $edit_list->csp_category; ?>">
							</div>
						</div>
							    <div class="col-lg-4">
							        <div class="form-group">
								         <label for="password"  style="font-weight:bold">Sub Category</label>
								         <input type="text" class="form-control"  placeholder="Enter SubCategory" name="subcategory" id="subcategory" value="<?php echo $edit_list->csp_subcategory; ?>">
							         </div>
							    </div>
								 <div class="col-lg-4">
							        <div class="form-group">
								         <label for="Status"  style="font-weight:bold">Status</label>
										 <select name="status"  class="form-control" style="    height: 34px;">
												<option selected="yes" disabled="yes">Select Status</option>
										        <option value="Active"<?php if($edit_list->status == '0') { ?> selected="selected"<?php } ?>>Active</option>
										        <option value="InActive"<?php if($edit_list->status == '1') { ?> selected="selected"<?php } ?>>InActive</option>
												<option value="Suspended"<?php if($edit_list->status == '2') { ?> selected="selected"<?php } ?>>Suspended</option>
										</select>
										
							         </div>
							    </div>
					
							<div style="margin:10px;" class="pull-right">
								<button type="button" class="btn btn-primary" onclick="update_category(<?php echo $edit_list->csp_id; ?>)">Submit</button>
						    </div>
		            </form>
                 </div>
			</div>
</div>
</div>
<script>
function update_category(id)
{
	document.forms["editcategory"].submit();
	
}
</script>