<?php
include("connection.php");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
	$data = array
	(
		':hsp_name'   => "%" . $_GET['Name'] . "%",
		':hsp_email'   => "%" . $_GET['Email'] . "%",
		':hsp_contact'     => "%" . $_GET['Contact'] . "%",
		':hsp_address'    => "%" . $_GET['Address'] . "%"
	);
	$query = "SELECT * FROM hospital WHERE hsp_name LIKE :hsp_name AND hsp_email LIKE :hsp_email AND hsp_contact LIKE :hsp_contact AND hsp_address LIKE :hsp_address ORDER BY hsp_id DESC";
	$statement = $connect->prepare($query);
	$statement->execute($data);
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output[] = array(
		'id'    => $row['hsp_id'],   
		'Name'  => $row['hsp_name'],
		'Contact'   => $row['hsp_contact'],
		'Email'    => $row['hsp_email'],
		'Address'   => $row['hsp_address']
		);
	}
	header("Content-Type: application/json");
	echo json_encode($output);
}

if($method == "POST")
{
	$data = array
	(
		':hsp_name'   => $_POST['Name'],
		':hsp_email'   => $_POST['Email'],
		':hsp_contact'     => $_POST['Contact'],
		':hsp_address'    => $_POST['Address']
	); 
	$query = "INSERT INTO hospital (hsp_name, hsp_email, hsp_contact, hsp_address) VALUES (:hsp_name, :hsp_email, :hsp_contact, :hsp_address)";
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

if($method == 'PUT')
{
	/*  gets the contents of the php://input stream, and parses it into an array (stored as $_PUT) */
	parse_str(file_get_contents("php://input"), $_PUT);
	$data = array(
	':hsp_id'   => $_PUT['id'],
	':hsp_name' => $_PUT['Name'],
	':hsp_email' => $_PUT['Email'],
	':hsp_contact'   => $_PUT['Contact'],
	':hsp_address'  => $_PUT['Address']
	);
	$query = "UPDATE hospital  SET hsp_name = :hsp_name,  hsp_email = :hsp_email,  hsp_contact = :hsp_contact,  hsp_address = :hsp_address  WHERE hsp_id = :hsp_id";
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

if($method == "DELETE")
{
	/*  gets the contents of the php://input stream, and parses it into an array (stored as $_DELETE) */
	parse_str(file_get_contents("php://input"), $_DELETE);
	$query = "DELETE FROM hospital WHERE hsp_id = '".$_DELETE["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
}

?>