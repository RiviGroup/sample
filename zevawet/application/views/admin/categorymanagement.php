<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category Management</h1>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-3">
				        <h4>Add Category </h4>
				</div>
			</div>
					
			<div class="row">
	            <div class="col-lg-10">
					<form  id="addproduct" method="post" name="addproduct" action="<?php echo base_url()?>Admin/addproduct">
						<div class="col-lg-5">
							<div class="form-group">
								<label for="email" style="font-weight:bold">Product Name</label>
								<input type="text" class="form-control" placeholder="Enter productname" name="product[]" id="product">
							</div>
						</div>
							    <div class="col-lg-5">
							        <div class="form-group">
								         <label for="password"  style="font-weight:bold">Subproduct Name</label>
								         <input type="text" class="form-control"  placeholder="Enter subproductname" name="subproduct[]" id="subproduct">
							         </div>
							    </div>
							<div  id="more"></div>
							<div style="margin:10px;" class="pull-right">
								<a onclick="add_more()" class="addmorelink" style="color:#06f; cursor:pointer">+ Add more </a>
							    <button type="button" class="btn btn-primary" onclick="add_product()">Submit</button>
						    </div>
		            </form>
                 </div>
			</div>
</div>
 <script>
 function add_product()
{
	document.forms["addproduct"].submit();
}
 
  function add_more()
{
	 $("#more").append('<div class="col-lg-5"><div class="form-group"><label for="email" style="font-weight:bold">Product Name</label><input type="text" class="form-control" placeholder="Enter productname" name="product[]" id="product"></div></div><div class="col-lg-5"><div class="form-group"><label for="password"  style="font-weight:bold">Subproduct Name</label><input type="text" class="form-control"  placeholder="Enter subproductname" name="subproduct[]" id="subproduct"></div></div>');
	
}
 
 </script>
  
    
		  

 