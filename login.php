<?php
session_start();
include('connection.php');

if(isset($_POST["admin_email"]))
{
	$id = trim($_POST["admin_email"]);
	$password = trim($_POST["admin_pwd"]);

	$select = "select * from admin limit 1";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_assoc($result);

	if($id == $row["id"])
	{
		if($password == $row["password"])
		{
			echo "successfull";
			$_SESSION["type"] = "admin";
		}
		else
		{
			echo "Kindly enter proper Password";
		}
	}
	else
	{
		echo "Kindly enter proper Admin id";
	}
}
else
{
	$id = trim($_POST["user_email"]);
	$password = trim($_POST["user_pwd"]);

	$select = "select * from user where user_email = '".$id."'";
	$result = mysqli_query($con, $select);
	$row = mysqli_fetch_assoc($result);

	if($row)
	{
		if($password == $row["user_password"])
		{
			echo "successfull";
			$_SESSION["type"] = $row["user_name"];
			$_SESSION["id"] = $row["user_id"];
			
			$delete = "delete from chat where user_id = '".$_SESSION["id"]."'";
			$result = mysqli_query($con, $delete);		
		}
		else
		{
			echo "Kindly enter proper Password";
		}
	}
	else
	{
		echo "Kindly enter proper Email id";
	}
}
?>
