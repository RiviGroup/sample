<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Appointment List</h1>
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
                            <!--<button class="btn btn-info btn-sm" name="appointmentlist" id="appointmentlist">Appointment List</button>-->
							 <button class="btn btn-success btn-sm" name="exportcsv" id="exportcsv">Export Csv</button>
							
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body table-responsive">
						 
						 <div id="advsrchdiv"  style="padding:10px; border:1px solid #ccc; display:none">
							<h4 class="text-center">Advanced Search</h4>
							 <form name="advance" method="post">
							 <div class="col-md-3" >
							 <select name="searchbyname" id="searchbyname" class="form-control" style="height:34px;;">
									<option disabled="yes" selected="yes">Select Search By</option>
									 <option value="1">Appointment id</option>
									 <option value="2">Appointment userid</option>
									 <option value="3">Appointment doctorid</option>
									 <option value="4">Appointment status</option>
									 <option value="5">Userame</option>
									 <option value="6">Doctorname</option>
							</select>
							</div>
							<div class="col-md-3">
							 <input class="form-control" type="text" name="advancedtext" id="advancedtext" placeholder="Advanced search" >
							 </div>
							<div class="col-md-3">
							 <input class="form-control" type="date"   name="fromdate" onblur="daterange()" id="fromdate" data-date-inline-picker="true"/>
							 </div>
							<div class="col-md-3" style="margin-bottom:10px">
							 <input class="form-control" type="date" name="todate" id="todate"   onblur="daterange()"  data-date-inline-picker="true" />
							 <span style="color:red;display:none" id="maintaingdate">Date should be less than 90 days</span>
							 </div>
							 <div >
 							 <button type="button" id="dismis" onclick="advance_search()" class="btn btn-primary">Submit</button>
							 </div>
 							 </form>
						 </div>
						 <div>
							<a href="#" onclick="advancedsearch()" class="pull-right">Advance search</a>
						 </div>
						 
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" style=" width:100%; overflow-x: hidden;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Appointment id</th>
                                        <th>Appointment Userid</th>
                                        <th>Username</th>
                                        <th>Appointment Doctorid</th>
                                        <th>Doctorname</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Status</th>
                                        <th>Appointment Fee</th>
                                        <th>Appointment Summary</th>
                                        <th>Appointment Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="show_table">
								
							<?php $i=1; foreach($lists as $li){ ?>
                                    <tr class="odd gradeX">
									    <td ><?php echo $i; ?></td>
                                        <td><?php echo $li->appointment_id; ?></td>
                                        <td><?php echo $li->appointment_user_id; ?></td>
                                        <td><?php echo $li->user_firstname. ' '.$li->user_lastname; ?> </td>
                                        <td><?php echo $li->appointment_doctor_id; ?></td>
										<td><?php echo $li->doctor_firstname.' '.$li->doctor_lastname; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($li->appointment_date)); ?></td>
                                        <td><?php echo $li->appointment_status; ?></td>
                                        <td><?php echo $li->appointment_fee; ?></td>
                                        <td><?php echo $li->appointment_summary; ?></td>
                                        <td><?php echo $li->appointment_notes; ?></td>
                                    </tr>
							<?php $i++; } ?>
                                  </tbody>
								  
								    <tbody id="adv_show_table">
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


function advancedsearch(){
	$("#advsrchdiv").toggle();
} 


function daterange()
{
	var from_date = document.getElementById("fromdate").value;
	var to_date = document.getElementById("todate").value;
	var date = new Date(from_date);
    var newdate = new Date(date);
	newdate.setDate(newdate.getDate() + 90);
    var dd = newdate.getDate();
	var dat = dd < 10 ? '0' + dd : '' + dd;
	var mm = newdate.getMonth() + 1;
	var month = mm < 10 ? '0' + mm : '' + mm;
    var y = newdate.getFullYear();
	var someFormattedDate = y + '-' + month + '-' + dat;
	
    if(someFormattedDate <= to_date && to_date != ""){
		//alert("suman");
		$("#maintaingdate").show();
		
	} else {
		//alert("ddd");
		$("#maintaingdate").hide();
		
	}
  
}

function advance_search()
{
	var uid = $("#searchbyname").val();
	$("#show_table").hide();
	$( "#adv_show_table").empty().append();
	var from_date = $("#fromdate").val();
	var to_date = $("#todate").val();
	var advanced_text = $("#advancedtext").val();
	var date = new Date(from_date);
	var newdate = new Date(date);
	newdate.setDate(newdate.getDate() + 90);
    var dd = newdate.getDate();
	var dat = dd < 10 ? '0' + dd : '' + dd;
	var mm = newdate.getMonth() + 1;
	var month = mm < 10 ? '0' + mm : '' + mm;
    var y = newdate.getFullYear();
	var someFormattedDate = y + '-' + month + '-' + dat;
	
	if(someFormattedDate <= to_date && to_date != ""){
		
		$("#maintaingdate").show();
		return flase;
	} else if(advanced_text == "") {
		alert("Pleae select values");
		$("#show_table").show();
		return false;
	} else if(from_date != "" && to_date == ""){
          alert('Please select to date');
		  return false;

    } else {
		//alert('sam');
		$("#maintaingdate").hide();
	$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>advanced_searching',
			data: "advanced_search="+advanced_text+"&fromdate="+from_date+"&todate="+to_date+"&id="+uid,
			success: function(datas){
				//alert(datas);
				                    var json = JSON.parse(datas);
									var dropdownlist = json["advanced_searches"];
									console.log(dropdownlist);
									 var a = 1;
									jQuery.each(dropdownlist, function( i, val ) {
										//alert(i);
										//var dttime= val['appointment_date'];
										var dat = val['appointment_date'].split(' ')[0]
                                    $( "#adv_show_table").append('<tr class="odd gradeX"><td>'+a+'</td><td>'+val['appointment_id']+'</td><td>'+val['appointment_user_id']+'</td><td>'+val['user_firstname']+' '+val['user_lastname']+'</td><td>'+val['doctor_id']+'</td><td>'+val['doctor_firstname']+' '+val['doctor_lastname']+'</td><td>'+dat+'</td><td>'+val['appointment_status']+'</td><td>'+val['appointment_fee']+'</td><td>'+val['appointment_summary']+'</td><td>'+val['appointment_notes']+'</td>');
									a++;
									});
									}
			});
	
	 }
}


</script> 
		  
