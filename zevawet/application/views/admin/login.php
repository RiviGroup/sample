 
 <div class="container-fluid" >
	<div class="row">
		 
		<div class="col-md-3 offset-md-8" style="margin-top:40px; margin-bottom:40px; padding:20px; border:1px solid #c3c3c3; border-radius:5px;">
		<p style="color:red"><?php echo $this->session->flashdata('message_login'); ?></p>
		<p style="color:red"><?php echo $this->session->flashdata('message_logout'); ?></p>
			<div class="col-md-12 text-center" >
				<h3>Login </h3>
			</div>
			<hr>
			<form  id="form" method="post" name="login_checkin" action="<?php echo base_url()?>login_checkin">
				<div class="form-group">
					<label for="email" style="font-weight:bold">Email-ID</label>
					<input type="text" class="form-control" placeholder="Enter your Email Id " name="email" id="email">
				</div>
				<div class="form-group">
					<label for="password"  style="font-weight:bold">Password</label>
					<input type="password" class="form-control"  placeholder="Enter your Password" name="password" id="password">
				</div>
				<button type="button" class="btn btn-primary btn-block" onclick="Admin_Login()">Login</button>
  			</form>
		</div>
	</div>
 </div>
 <div class="footer " style="background:#000; color:#fff; padding:20px;position:fixed;bottom:0px;width:100%;">
	<div class="row">
		<div class="col">
			&copy;Copyright
		</div>
	</div>
  </div>
 
 <script>
 function Admin_Login()
{
	
	var email = document.getElementById("email").value;
	var mobile = document.getElementById("password").value;
	document.forms["login_checkin"].submit();
}
 
 
 </script>