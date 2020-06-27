<?php
include('../header.php');
include('../connection.php');
if(isset($_SESSION["type"]))
{
	
?>

<div class="container-fluid my-3">
	<h5>Welcome <?php echo $_SESSION["type"]; ?> !</h5>
	<hr/>
	<div class="container">
	<h3 class="text-center pt-5">Doctor Details</h3>
	<br />
	<div align="right">
		<div class="table-responsive" >
			<table id="product_data" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th data-column-id="doc_id" data-type="numeric" data-visible="false">ID</th>
						<th data-column-id="hsp_id">HOSPITAL NAME</th>
						<th data-column-id="doc_name">DOCTOR NAME</th>
						<th data-column-id="doc_mobile">CONTACT NUMBER</th>
						<th data-column-id="doc_email">EMAIL ID</th>
						<th data-column-id="doc_address">ADDRESS</th>
						<th data-column-id="doc_qualification">QUALIFICATION</th>
						<th data-column-id="doc_exp">EXPERIENCE</th>
						<th data-column-id="doc_specialization">SPECIALIZATION</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	</div>
</div>

</div>
<?php include('../footer.php'); ?>
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
		url: "DoctorResponse.php"
	});
});
</script>
</body>
</html>
<?php
}
else
{
	echo "<script>window.location.href='../index.php';</script>";
}
?>