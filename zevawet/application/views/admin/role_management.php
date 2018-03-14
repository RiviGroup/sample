<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Role Management</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Role Management</button>
                        </div>
                        <!-- /.panel-heading -->
                          <div class="panel-body">
                            <ul class="nav nav-tabs">
							  <li class="active"><a data-toggle="tab" href="#createrole">Create Role</a></li>
							  <li><a data-toggle="tab" href="#existingroles">Existing Roles</a></li>
							
							</ul>

							<div class="tab-content">
							  <div id="createrole" class="tab-pane fade in active">
								<h3>Create Role</h3>
								<div class="col-md-12">
									<div class="row">
										<p>Some content in menu 2.</p>
										
									</div>
								</div>
 							  </div>
							  <!-- Existing User-->
							  <div id="existingroles" class="tab-pane fade">
								<h3>Existing Roles</h3>
								<p>Some content in menu 2.</p>
							  </div>
							 
							</div>
							
                        </div>
                    <!-- /.panel -->
                </div>
			</div>
</div>

<script>
function showUser(id)
{
	$('#dataTables-example').hide();
	var fromdate = $("#fromdate").val();
    var todate = $("#todate").val();
	$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>fromdateandtodatedata/'+id,
			data: "fromdate="+fromdate+"&todate="+todate,
			success: function(datas){
				                    console.log(datas);
									}
								
									
		  });
}

</script>