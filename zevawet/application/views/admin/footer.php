 <div class="footer " style="background:#000; color:#fff; padding:20px;">
	<div class="row">
		<div class="col">
			&copy;Copyright
		</div>
	</div>
  </div>
 <script src="<?php echo base_url(); ?>application/dist/js/sb-admin-2.js"></script>

	<!-- loaded templates -->
	<script src="<?php echo base_url(); ?>application/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>application/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>application/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>application/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>application/data/morris-data.js"></script>
    <script src="<?php echo base_url(); ?>application/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/js/table2csv.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 <!-- end template -->	  
  <script>
 $(document).ready(function() {
      $('#dataTables-example').DataTable({
            responsive: true
        });
		
	$('.remove_menu,.remove_submenu').hide();
	$('#edit_menus').click(function(){
	$('.remove_menu,.remove_submenu').toggle();
	});
   
	$('.remove_menu,.remove_submenu').click(function(){
	});
	
	

	
    });
	//add_multiple categories

 function add_category()
{
	document.forms["addcategory"].submit();
}



   rowNum = 0;
  function add_multiplecategories()
{
	 rowNum++;
	
	 $("#more").append('<div class="col-md-12 add_cat" id="add_cat_rem"><div class="col-lg-5"><div class="form-group"><label for="email" style="font-weight:bold">Category</label><input type="text" class="form-control" placeholder="Enter Category" name="category[]" id="category"></div></div><div class="col-lg-5"><div class="form-group"><label for="password"  style="font-weight:bold">Sub Category</label><input type="text" class="form-control"  placeholder="Enter SubCategory" name="subcategory[]" id="subcategory"></div></div><div class="col-lg-2"><div class="form-group"><label for="remove">&nbsp;</label><br> <button type="button" class="fa fa-minus-circle" aria-hidden="true" style="color:red" onclick=remove_div('+rowNum+') id="add_cat_rem_btn"></button></div></div></div>');
	 $("#add_cat_rem").attr('id', 'add_cat' + rowNum);
	 $("#add_cat_rem_btn").attr('id', 'add_cat_rem_btn' + rowNum);
	 
}
 
 
 function remove_div(id)
 {
	// alert(id);
	 $('#add_cat'+id).remove();
 }


//add_multiple products


 function add_product()
{
	document.forms["addproduct"].submit();
}



multipleproduct = 0
function add_multipleproduct()
{
	
	
	 multipleproduct++;
	
	 $("#multipleproduct").append('<div class="col-lg-12 add_prod" id="add_prod_rem"><div class="row" ><div class="col-lg-5"><div class="form-group"><label for="password"  style="font-weight:bold">Product</label><input type="text" class="form-control"  placeholder="Enter product" name="product[]" id="product"></div></div><div class="col-lg-5"><div class="form-group"><label for="password"  style="font-weight:bold">Sub Product</label><input type="text" class="form-control"  placeholder="Enter subproductname" name="subproduct[]" id="subproduct"></div></div><div class="col-lg-2"><div class="form-group"><label for="remove">&nbsp;</label><br> <button type="button" class="fa fa-minus-circle" aria-hidden="true" style="color:red" onclick=removepro_div('+multipleproduct+') id="add_pro_rem_btn"></button></div></div></div></div>');
	 $("#add_prod_rem").attr('id', 'add_prod' + multipleproduct);
	 $("#add_pro_rem_btn").attr('id', 'add_pro_rem_btn' + multipleproduct);
	 
}
 
 
 function removepro_div(id)
 {
	// alert(id);
	 $('#add_prod'+id).remove();
}

$('#exportcsv').click(function(){
	 
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	var today = dd +'-'+ mm +'-'+ yyyy;
	$("#dataTables-example").table2csv({
	  filename: 'Appointments-'+today+'.csv'
	});
})

 </script>
  
 </body>
</html>