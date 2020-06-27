<?php
include("connection.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
</head>

<body>

	<div class="sticky">

		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-info" style="background-color: #595652">
		  <a class="navbar-brand" href="index.php">Healthcare Clinic</a>
		</nav>

		<!-- Registration Form -->
		<div class="container">
			<div class="col-md-6 mx-auto shadow-lg p-3 mb-5 bg-white rounded lgndiv">
				<div class="col-md-12 text-center">
					<h4 class="text-info">Create your Account</h4>
				</div>
				<form method="post">
				  <div class="form-group">
					<label for="id">ID:</label>
					<?php
					$select = "select user_id from user ORDER BY user_id DESC LIMIT 1";
					$result = $connect->prepare($select);
					$result->execute();	
					if($row = $result->fetchAll())
					{
						foreach($row as $r)
						$user_id = $r["user_id"] + 1;
					}
					else
					{
						$user_id = "101";
					}
					?>
					<input type="number" class="form-control" name="id" value="<?php echo $user_id; ?>" readonly required />
				  </div>
				  <div class="form-group">
					<label for="Name">Name:</label>
					<input type="text" class="form-control" name="name" required />
				  </div>
				  <div class="form-group">
					<label for="Email">Email:</label>
					<input type="email" class="form-control" name="email" required />
				  </div>
				  <div class="form-group">
					<label for="Contact">Contact:</label>
					<input type="text" class="form-control" name="contact" pattern="[0-9]{10}" MaxLength="10" required title="Kindly Enter 10 Digit Number" />
				  </div>
				  <div class="form-group">
					<label for="id">Gender:</label>
				  </div>
				  <div class="form-group">
					<label class="radio-inline"><input type="radio" name="gender" value="male" required > Male</label>
					<label class="radio-inline"><input type="radio" name="gender" value="female" required> Female</label>
				  </div>
				  <div class="form-group">
				  <label for="pwd">Password:</label>
				  <input type="password" class="form-control" name="password" required />
				  </div> 
				  <button type="submit" class="btn btn-info" name="submit">Submit</button>
				</form>
			</div>
		</div>

	</div>
				
	<?php 
	include('footer.php'); 

	/* submit details*/
	if(isset($_POST["submit"]))
	{
		$id = $_POST["id"];
		$name = $_POST["name"];
		$email = $_POST["email"];
		$contact = $_POST["contact"];
		$gender = $_POST["gender"];
		$password = $_POST["password"];
		
		$insert = "insert into user (user_id, user_name, user_email, user_gender, user_password, user_contact) values ('".$id."', '".$name."', '".$email."', '".$gender."', '".$password."', '".$contact."')";
		$result = $connect->prepare($insert);
		if($result->execute())
		{
			echo "<script>alert('Successfully Registered! Now you can login');window.location.href='index.php';</script>";
		}
	}
	?>
</body>
</html>