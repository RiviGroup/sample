<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ZevA</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/assets/css/bootstrap.min.css">
	<!--<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>-->
 <style>
 	.footer {
 			left: 0;
			bottom: 0;
			width: 100%;
			background-color: red;
			color: white;
			text-align: center;
		}
	.user-info{
		color:#fff
	}
	.nav{display: block;}
	
	.remove_submenu{
		color:red;
	}
	.submenus_list{
		list-style:none;
	}
	.submenus_list>li{
		padding:5px;
		
	}
</style>
	<link href="<?php echo base_url(); ?>application/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>application/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	
</head>
   <body>
   <div class="container-fluid" style="background:#000;">
	<div class="row" style="padding:15px;" >
		<div class="col-md-2" >
		<?php if($this->session->userdata('firstname') !=""){ ?>
				<a class="navbar-brand" href="<?php echo base_url(); ?>dashboard"><img src="<?php echo base_url(); ?>application/logo/logo.png" width="70%"></a>
		<?php } else { ?>
		    <a class="navbar-brand" href="<?php echo base_url(); ?>admin_login"><img src="<?php echo base_url(); ?>application/logo/logo.png" width="70%"></a>
		<?php } ?>
		</div>
		<div class="col-md-8">
		</div>
		<div class="col-md-2">
			<?php if($this->session->userdata('firstname') != ""){ ?>
			 <ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle user-info" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('firstname');?> 
					</a>
					<ul class="dropdown-menu dropdown-user">
 						<li><a href="<?php echo base_url()?>Admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
			</ul>	
			<?php } ?>
		</div>
		
	</div>
   </div>
 