<?php
include("connection.php");
$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
	$query1 = "SELECT * FROM `doctor`";
	$statement1 = $connect->prepare($query1);
	$statement1->execute();
	$total_records = $statement1->rowCount();

	$query = '';
	$data = array();
	$records_per_page = 10;
	$start_from = 0;
	$current_page_number = 0;
	if(isset($_GET["rowCount"]))
	{
	 $records_per_page = $_GET["rowCount"];
	}
	else
	{
	 $records_per_page = 10;
	}
	if(isset($_GET["current"]))
	{
	 $current_page_number = $_GET["current"];
	}
	else
	{
	 $current_page_number = 1;
	}
	$start_from = ($current_page_number - 1) * $records_per_page;
	$query .= "SELECT * FROM doctor ";
	if(!empty($_GET["searchPhrase"]))
	{
	 $query .= 'WHERE (doc_name LIKE "%'.$_GET["searchPhrase"].'%" ';
	 $query .= 'OR hsp_id LIKE "%'.$_GET["searchPhrase"].'%" ) ';
	} 
	else
	{ 
	 $query .= 'ORDER BY doc_id ASC ';
	} 
	if($records_per_page != -1)
	{
	 $query .= " LIMIT " . $start_from . ", " . $records_per_page;
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	
	foreach($result as $row)
	{
	 $data[] = $row;
	}
		$output = array(
	 'current'  => intval($_GET["current"]),
	 'rowCount'  => $total_records,
	 'total'   => intval($total_records),
	 'rows'   => $data
	);
	echo json_encode($output);
}

else if($method == 'POST')
{
	$postdata = array
	(
	'edit_hname' => $_POST["edit_hname"],
	'edit_dname' => $_POST["edit_dname"],
	'edit_number' => $_POST["edit_number"],
	'edit_email' => $_POST["edit_email"],
	'edit_address' => addslashes($_POST["edit_address"]),
	'edit_experience' => $_POST["edit_experience"],
	'gender' => $_POST["gender"],
	'edit_qualification' => addslashes($_POST["edit_qualification"]),
	'edit_specialization' => addslashes($_POST["edit_specialization"]),
	);
	$query = "INSERT INTO `doctor`(`hsp_id`, `doc_name`, `doc_mobile`, `doc_email`, `doc_address`, `doc_gender`, `doc_qualification`, `doc_exp`, `doc_specialization`) VALUES ('".$postdata["edit_hname"]."', '".$postdata["edit_dname"]."', '".$postdata["edit_number"]."', '".$postdata["edit_email"]."', '".$postdata["edit_address"]."', '".$postdata["gender"]."', '".$postdata["edit_qualification"]."', '".$postdata["edit_experience"]."', '".$postdata["edit_specialization"]."')";
	$data = $connect->prepare($query);
	if($data->execute())
	{
	echo "Details added successfully!";
	}
	echo $query;
}

else if($method == 'REQUEST')
{
	parse_str(file_get_contents("php://input"), $_REQUEST);	
	if(isset($_REQUEST["doc_idDel"]))
	{
		$query = "SELECT * FROM doctor WHERE doc_id = '".$_REQUEST["doc_idDel"]."'";
		$data = $connect->prepare($query);
		$data->execute();
		$result = $data->fetchAll();
		foreach($result as $row)
		{
		$output["doc_id"] = $row["doc_id"];
		$output["doc_name"] = $row["doc_name"];
		}
	}
	else
	{
		$query = "SELECT * FROM `doctor` WHERE doc_id = '".$_REQUEST["doc_id"]."'";
		$data = $connect->prepare($query);
		$data->execute();
		$result = $data->fetchAll();

		foreach($result as $row)
		{
			$output["doc_id"] = $row["doc_id"];
			$output["hsp_id"] = $row["hsp_id"];
			$output["doc_name"] = $row["doc_name"];
			$output["doc_mobile"] = $row["doc_mobile"];
			$output["doc_email"] = $row["doc_email"];
			$output["doc_address"] = $row["doc_address"];	
			$output["doc_gender"] = $row["doc_gender"];
			$output["doc_qualification"] = $row["doc_qualification"];
			$output["doc_exp"] = $row["doc_exp"];
			$output["doc_specialization"] = $row["doc_specialization"];
		}
	}
	echo json_encode($output);
}

else if($method == 'PUT')
{
	parse_str(file_get_contents("php://input"), $_PUT);
	$edit_hname = $_PUT["edit_hname"];
	$edit_id = $_PUT["edit_id"];
	$edit_number = $_PUT["edit_number"];
	$edit_email = $_PUT["edit_email"];
	$edit_address = $_PUT["edit_address"];
	$edit_experience = $_PUT["edit_experience"];
	$edit_qualification = addslashes($_PUT["edit_qualification"]);
	$edit_specialization = addslashes($_PUT["edit_specialization"]);
	
	$query = "UPDATE `doctor` SET `hsp_id`='".$edit_hname."', `doc_mobile`='".$edit_number."', `doc_email`='".$edit_email."', `doc_address`='".$edit_address."', `doc_exp`='".$edit_experience."', `doc_qualification`= '".$edit_qualification."', `doc_specialization`='".$edit_specialization."'  WHERE `doc_id` = '".$edit_id."' ";
	$result = $connect->prepare($query);
	if($result->execute())
	{
			echo "Details updated successfully";
	}
}

else if($method == 'DELETE')
{
	parse_str(file_get_contents("php://input"), $_DELETE);
	$query = "DELETE FROM doctor WHERE doc_id = '".$_DELETE["doc_id1"]."'";
	$result = $connect->prepare($query);
	if($result->execute())
	{
		echo "Successfully Deleted";
	}
}
?>