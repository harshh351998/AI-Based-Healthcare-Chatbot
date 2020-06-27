<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous' />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
		<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
		<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous" />

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script> 
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
		<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
		<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

		<?php
		if(isset($_SESSION["type"]))
		{
		if($_SESSION["type"] == "admin")
		{
		?>  
		<link rel="stylesheet" href="css/style.css" />
		<?php
		}
		else
		{
		?>
		<link rel="stylesheet" href="../css/style.css" />
		<?php
		}
		}
		else
		{
		?>
		<link rel="stylesheet" href="css/style.css" />
		<?php
		}
		?>
	</head>

	<body>
		<div class="sticky">

			<?php
			if(isset($_SESSION["type"]))
			{
			?>
				<nav class="navbar navbar-expand-lg navbar-dark bg-info" style="background-color: #595652">
				<a class="navbar-brand" href="#">HealthCare Clinic</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
				<?php
				if($_SESSION["type"] == "admin")
				{
				?>
					<ul class="navbar-nav">
						<li class="nav-item mr-2">
							<a class="nav-link" href="Managehospital.php"><i class="fa fa-plus-square"></i> Hospitals</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="ManageDoctor.php"><i class='fas fa-stethoscope'></i> Doctors</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="Question.php"><i class='fa fa-question'></i> Questions</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="ViewUser.php"><i class='fa fa-users'></i> User Details</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="logout.php"><i class='fa fa-unlock'></i> Logout</a>
						</li>
					</ul>
				<?php
				}
				else
				{
				?>
					<ul class="navbar-nav">
						<li class="nav-item mr-2">
							<a class="nav-link" href="UserHome.php"><i class="fa fa-home"></i> Home</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="Hospitals.php"><i class="fa fa-plus-square"></i> Hospitals</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="Doctors.php"><i class='fas fa-stethoscope'></i> Doctors</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="Query.php"><i class='fas fa-comment-dots'></i> Query</a>
						</li>
						<li class="nav-item mr-2">
							<a class="nav-link" href="../logout.php"><i class='fa fa-unlock'></i> Logout</a>
						</li>
					</ul>
				<?php
				}
			}
			else
			{
			?>
				<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top" style="background-color: #595652">
				<a class="navbar-brand" href="index.php">Healthcare Clinic</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item mr-2">
						<a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="#about"><i class="fa fa-edit"></i> About</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="#contact"><i class="fa fa-phone"></i> Contact</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="#a_login"><i class="fa fa-lock"></i> Admin Login</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="#u_login"><i class="fa fa-lock"></i> User Login</a>
					</li>
				</ul>
			<?php
			}
			?>
			</div>
			</nav>