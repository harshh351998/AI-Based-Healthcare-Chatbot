<?php
include("connection.php");
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
	$data = array
	(
		':main'   => "%" . $_GET['main'] . "%",
		':k1'   => "%" . $_GET['k1'] . "%",
		':k2'     => "%" . $_GET['k2'] . "%",
		':k3'    => "%" . $_GET['k3'] . "%",
		':k4'    => "%" . $_GET['k4'] . "%",
		':answer'    => "%" . $_GET['answer'] . "%"
	);
	$query = "SELECT * FROM question WHERE main LIKE :main AND k1 LIKE :k1 AND k2 LIKE :k2 AND k3 LIKE :k3 AND k4 LIKE :k4 AND answer LIKE :answer ORDER BY ques_id DESC";
	$statement = $connect->prepare($query);
	$statement->execute($data);
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output[] = array(
		'id'    => $row['ques_id'],   
		'main'  => $row['main'],
		'k1'   => $row['k1'],
		'k2'    => $row['k2'],
		'k3'   => $row['k3'],
		'k4'   => $row['k4'],
		'answer'   => $row['answer'],
		);
	}
	header("Content-Type: application/json");
	echo json_encode($output);
}

if($method == "POST")
{
	$data = array
	(
		':main'   => strtolower($_POST['main']),
		':k1'   => strtolower($_POST['k1']),
		':k2'     => strtolower($_POST['k2']),
		':k3'    => strtolower($_POST['k3']),
		':k4'    => strtolower($_POST['k4']),
		':answer'    => $_POST['answer'],
	); 
	$query = "INSERT INTO question (main, k1, k2, k3, k4, answer) VALUES (:main, :k1, :k2, :k3, :k4, :answer)";
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

if($method == 'PUT')
{
	/*  gets the contents of the php://input stream, and parses it into an array (stored as $_PUT) */
	parse_str(file_get_contents("php://input"), $_PUT);
	$data = array(
	':id'   => $_PUT['id'],
	':main' => $_PUT['main'],
	':k1' => $_PUT['k1'],
	':k2'   => $_PUT['k2'],
	':k3'  => $_PUT['k3'],
	':k4'  => $_PUT['k4'],
	':answer'  => $_PUT['answer']
	);
	$query = "UPDATE hospital  SET main = :main, k1 = :k1, k2 = :k2, k3 = :k3, k4 = :k4, answer = :answer WHERE ques_id = :id";
	$statement = $connect->prepare($query);
	$statement->execute($data);
}

if($method == "DELETE")
{
	/*  gets the contents of the php://input stream, and parses it into an array (stored as $_DELETE) */
	parse_str(file_get_contents("php://input"), $_DELETE);
	$query = "DELETE FROM question WHERE ques_id = '".$_DELETE["id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
}

?>