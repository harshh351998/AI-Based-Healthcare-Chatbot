<?php
include('../connection.php');
$query = '';
	$data = array();
	$records_per_page = 10;
	$start_from = 0;
	$current_page_number = 0;
	if(isset($_POST["rowCount"]))
	{
	 $records_per_page = $_POST["rowCount"];
	}
	else
	{
	 $records_per_page = 10;
	}
	if(isset($_POST["current"]))
	{
	 $current_page_number = $_POST["current"];
	}
	else
	{
	 $current_page_number = 1;
	}
	$start_from = ($current_page_number - 1) * $records_per_page;
	$query .= "SELECT * FROM doctor ";
	if(!empty($_POST["searchPhrase"]))
	{
	 $query .= 'WHERE (doc_name LIKE "%'.$_POST["searchPhrase"].'%" ';
	 $query .= 'OR hsp_id LIKE "%'.$_POST["searchPhrase"].'%" ) ';
	}
	else
	{ 
	 $query .= 'ORDER BY doc_id ASC ';
	} 
	if($records_per_page != -1)
	{
	 $query .= " LIMIT " . $start_from . ", " . $records_per_page;
	}
	$result = mysqli_query($con, $query);
	$query1 = "SELECT * FROM `doctor`";
	$result1 = mysqli_query($con, $query1);
	$total_records = mysqli_num_rows($result1);
	while($row = mysqli_fetch_assoc($result))
	{
	 $data[] = $row;
	}
		$output = array(
	 'current'  => intval($_POST["current"]),
	 'rowCount'  => $total_records,
	 'total'   => intval($total_records),
	 'rows'   => $data
	);
	echo json_encode($output);
	?>