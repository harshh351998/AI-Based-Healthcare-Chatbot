<?php
session_start();
session_destroy();
include("connection.php");

$delete = "delete from chat where user_id = '".$_SESSION["id"]."'";
$result = mysqli_query($con, $delete);

echo "<script>window.location.href = 'index.php';</script>";
?>