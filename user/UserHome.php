<?php
include('../header.php');
include('../connection.php');
if(isset($_SESSION["type"]))
{
	
?>

<div class="container-fluid my-3">
	<h5>Welcome <?php echo $_SESSION["type"]; ?>!</h5>
	<hr/>
</div>

</div>
<?php include('../footer.php'); ?>
</body>
</html>
<?php
}
else
{
	echo "<script>window.location.href='../index.php';</script>";
}
?>