<?php
include('header.php');
include('connection.php');
if(isset($_SESSION["type"]))
{
	
?>

<div class="container my-5">
	<h3 class="text-center pt-5">User Details</h3>
	<br />
	<div align="right">
		<div class="table-responsive" >
			<table id="product_data" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th data-column-id="user_id" data-type="numeric">ID</th>
						<th data-column-id="user_name">Name</th>
						<th data-column-id="user_contact">Contact</th>
						<th data-column-id="user_email">Email</th>
						<th data-column-id="user_gender">Gender</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

</div>

<?php include('footer.php'); ?>

<script>
$(document).ready(function(){
	var productTable = $('#product_data').bootgrid({
		ajax: true,
		rowSelect: true,
		post: function()
		{
		return{
		id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
		};
		},
		url: "userResponse.php"
	});
});
</script>

</body>
</html>
<?php
}
else
{
	echo "<script>window.location.href='index.php';</script>";
}