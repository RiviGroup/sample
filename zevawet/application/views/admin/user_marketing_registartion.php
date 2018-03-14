<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User Registration</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">User Registration</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">					
							    <div id="createuser" class="tab-pane fade in active">
 								<div class="col-md-12">
									<form class="form-horizontal" method="post" name="create_user" action="<?php echo base_url(); ?>createuser">
										<div class="form-group">
										  <label class="control-label col-sm-3" for="email">Enter Aadhar Number <span style="color:red">*</span></label>
										  <div class="col-sm-5">
											<input type="text" class="form-control" id="name" placeholder="Enter Aadhar Number" name="name" onblur="mobile_validation()">
										   <span id="namevalidation" style="color:red;display:none">Please enter Aadhar Number</span>
										  </div>
 										</div>
 										<div class="form-group">
										 <div class="col-sm-offset-3 col-sm-9">
											<button type="button" class="btn btn-success" onclick="from_validation()">Submit</button>
										  </div>
										</div>
									  </form>
                                    </div>
 							     </div>
							
							
							 
					</div>
                     
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
			</div>
</div>
