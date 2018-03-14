<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient Page</h1>
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
                            <button class="btn btn-info btn-sm" name="addcat" id="addcat" data-toggle="modal" data-target="#add_category">Patient Page</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="nav nav-tabs">
							  <li class="active"><a data-toggle="tab" href="#Overview">Overview</a></li>
							  <li><a data-toggle="tab" href="#Appointments">Appointments</a></li>
							  <li><a data-toggle="tab" href="#Payments">Payments</a></li>
							  <li><a data-toggle="tab" href="#Invoice">Invoice</a></li>
							</ul>

							<div class="tab-content">
							  <div id="Overview" class="tab-pane fade in active">
								<h3>Patient Overview</h3>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											 
<?php if($lists->user_photo != ""){ ?><img  style="height:170px" src="<?php echo base_url(); ?>application/images/<?php echo $lists->user_photo; ?>"> <?php } else { ?><img  style="height:170px"  src="<?php echo base_url();?>application/images/<?php echo "images.png" ?>" ><?php } ?>											
										</div>
										<div class="col-md-9">
											<h4><?php echo $lists->user_firstname.'&nbsp;'.$lists->user_lastname; ?></h4>
											<h6>Patient Id <?php echo $lists->user_id; ?></h6>											
											<hr>
											<span><i class="fa fa-envelope"></i> <?php echo $lists->user_email; ?></span><br>
											<span><i class="fa fa-mobile"></i> <?php echo $lists->user_mobile; ?></span><br>
											<span><b>Gender:</b> <?php if($lists->user_gender == 1) { echo "Male"; } else { echo "Female"; } ?></span> &nbsp
											<span><b>Dob:</b> <?php echo date("d-m-Y", strtotime($lists->user_dob)); ?></span>
											<span><b>Age:</b> 
											<?php
											$dateOfBirth = date("d-m-Y", strtotime($lists->user_dob));
											$today = date("Y-m-d");
											$diff = date_diff(date_create($dateOfBirth), date_create($today));
											echo $diff->format('%y'); ?></span><br>
											<span><i class="fa fa-map-marker"></i> <?php echo $lists->user_address; ?>,</span><br>
											<span><?php echo $lists->user_city; ?>,</span>
											<span><?php echo $lists->state_name; ?></span>
										</div>
									</div>
								</div>
 							  </div>
							  <!-- Appointments-->
							  <div id="Appointments" class="tab-pane fade">
								<h3>Appointments</h3>
								<div class="col-md-12" >
									<div class="row">
										<div class="col-md-3">
											<?php if($lists->user_photo != ""){ ?><img  style="height:90px" src="<?php echo base_url(); ?>application/images/<?php echo $lists->user_photo; ?>"> <?php } else { ?><img  style="height:90px"  src="<?php echo base_url();?>application/images/<?php echo "images.png" ?>" ><?php } ?>											
										</div>
										<div class="col-md-5">
											<h4><?php echo $lists->user_firstname.'&nbsp;'.$lists->user_lastname; ?></h4> 
											<h6>Patient Id <?php echo $lists->user_id; ?></h6>
										</div>
										<div class="col-md-4">
											<span><i class="fa fa-envelope"></i> <?php echo $lists->user_email; ?></span><br>
											<span><i class="fa fa-mobile"></i> <?php echo $lists->user_mobile; ?></span><br>
											<span><b>Gender:</b> <?php if($lists->user_gender == 1) { echo "Male"; } else { echo "Female"; } ?></span> &nbsp
											<span><b>Dob:</b> <?php echo date("d-m-Y", strtotime($lists->user_dob)); ?></span>
											<span><b>Age:</b> 
											<?php
											$dateOfBirth = date("d-m-Y", strtotime($lists->user_dob));
											$today = date("Y-m-d");
											$diff = date_diff(date_create($dateOfBirth), date_create($today));
											echo $diff->format('%y'); ?></span><br>
											<span><i class="fa fa-map-marker"></i> <?php echo $lists->user_address; ?>,</span><br>
											<span><?php echo $lists->user_city; ?>,</span>
											<span><?php echo $lists->state_name; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<hr>
											<div class="col-md-9">
												<label>Select Date Range</label>
												From 
												<input type="date" name="fromdate" id="fromdate" onChange="showUser('<?php echo $lists->user_id; ?>')" data-date-inline-picker="true" />
												To 
												<input type="date" name="todate" id="todate" onChange="showUser('<?php echo $lists->user_id; ?>')" data-date-inline-picker="true" />
											</div>
											<div class="col-md-3">
												<button type="button" value="Generate Report">Generate Report</Button><br>
												<span style="font-size:10px; color:red">* Report will be generated in .csv format</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 table-responsive" >
											<hr>
											 <table  class="table table-bordered table-condensed  " id="dataTables-example" style=" width:100%; overflow-x: hidden;">
												<thead>
													<th>Appointment Id</th>
													<th>Date</th>
													<th>Service</th>
													<th>Clinician</th>
													<th>Duration</th>
													<th>Fee</th>
													<th>Other Charges</th>
													<th>Discounts</th>
													<th>Status</th>
 													<th>Rating</th>
													<th>Comments</th>
												</thead>
												<?php 
												foreach($appointment as $li) { ?>
												<tr class="odd gradeX">
													<td><?php echo $li->appointment_id; ?></td>
													<td><?php echo date("d-m-Y", strtotime($li->appointment_date)); ?></td>
													<td><?php echo $li->appointment_date; ?></td>
													<td><?php echo $li->doctor_firstname; ?></td>
													<td><?php echo $li->appointment_doctor_id; ?></td>
													<td><?php echo $li->appointment_fee; ?></td>
													<td><?php echo $li->appointment_total_fee; ?></td>
													<td><?php echo $li->appointment_convenience_fee; ?></td>
													<td><?php echo $li->appointment_transaction_status; ?></td>
													<td><?php echo $li->appointment_transaction_status; ?></td>
													<td><?php echo $li->appointment_transaction_status; ?></td>
													 
												</tr>
												<?php } ?>
											 </table>
										</div>
									</div>
								</div>
							  </div>
							  <!-- Payments -->
							  <div id="Payments" class="tab-pane fade">
								<h3>Payments</h3>
								<div class="col-md-12" >
									<div class="row">
										<div class="col-md-3">
											<?php if($lists->user_photo != ""){ ?><img  style="height:90px" src="<?php echo base_url(); ?>application/images/<?php echo $lists->user_photo; ?>"> <?php } else { ?><img  style="height:90px"  src="<?php echo base_url();?>application/images/<?php echo "images.png" ?>" ><?php } ?>											
										</div>
										<div class="col-md-5">
											<h4><?php echo $lists->user_firstname.'&nbsp;'.$lists->user_lastname; ?></h4> 
											<h6>Patient Id <?php echo $lists->user_id; ?></h6>
										</div>
										<div class="col-md-4">
											<span><i class="fa fa-envelope"></i> <?php echo $lists->user_email; ?></span><br>
											<span><i class="fa fa-mobile"></i> <?php echo $lists->user_mobile; ?></span><br>
											<span><b>Gender:</b> <?php if($lists->user_gender == 1) { echo "Male"; } else { echo "Female"; } ?></span> &nbsp
											<span><b>Dob:</b> <?php echo date("d-m-Y", strtotime($lists->user_dob)); ?></span>
											<span><b>Age:</b> 
											<?php
											$dateOfBirth = date("d-m-Y", strtotime($lists->user_dob));
											$today = date("Y-m-d");
											$diff = date_diff(date_create($dateOfBirth), date_create($today));
											echo $diff->format('%y'); ?></span><br>
											<span><i class="fa fa-map-marker"></i> <?php echo $lists->user_address; ?>,</span><br>
											<span><?php echo $lists->user_city; ?>,</span>
											<span><?php echo $lists->state_name; ?></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<hr>
											<div class="col-md-9">
												<label>Select Date Range</label>
												From 
												<select>
													<option></option>
												</select>
												To 
												<select>
													<option></option>
												</select>
											</div>
											<div class="col-md-3">
												<button type="button" value="Generate Report">Generate Report</Button><br>
												<span style="font-size:10px; color:red">* Report will be generated in .csv format</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<hr>
											 <table class="table table-bordered" >
												<thead>
													<th>Appointment Id</th>
													<th>Date</th>
													<th>Service</th>
													<th>Clinician</th>
													<th>Duration</th>
													<th>Fee</th>
													<th>Other Charges</th>
													<th>Discounts</th>
													<th>Status</th>
 													<th>Rating</th>
													<th>Comments</th>
												</thead>
												<?php $i=0;foreach($appointment as $li){ ?>
												<tr class="odd gradeX">
													<td><?php echo $i; ?></td>
													<td><?php echo $li->appointment_id; ?></td>
													<td><?php echo $li->appointment_date; ?></td>
													<td><?php echo $li->appointment_doctor_id; ?></td>
													<td><?php echo $li->appointment_doctor_id; ?></td>
													<td><?php echo $li->appointment_fee; ?></td>
													<td><?php echo $li->appointment_total_fee; ?></td>
													<td><?php echo $li->appointment_convenience_fee; ?></td>
													<td><?php echo $li->appointment_transaction_status; ?></td>
													<td><?php echo $li->appointment_transaction_status; ?></td>
													<td><?php echo $li->appointment_transaction_status; ?></td>
													 
												</tr>
												<?php } ?>
											 </table>
										</div>
									</div>
								</div>
							  </div>
							   <!-- invoice -->
							  <div id="Invoice" class="tab-pane fade">
								<h3>Invoice</h3>
								<p>Some content in menu 2.</p>
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