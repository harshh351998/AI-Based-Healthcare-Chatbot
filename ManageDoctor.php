<?php
include('header.php');
include('connection.php');
if(isset($_SESSION["type"]))
{
   
?>
<div class="container">
	<br/>
	<h3 class="text-center" >Doctor List</h3>
	<br />
	<div align="right">
		<button type="button" id="add_button" data-toggle="modal" data-target="#doctor_modal" class="btn text-white btn-lg" style="background-color: #17a2b8; border-color: #17a2b8;">Add Doctor Details</button>
		<div class="table-responsive" >
			<table id="product_data" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th data-column-id="doc_id" data-type="numeric" data-visible="false">ID</th>
						<th data-column-id="hsp_id">Hospital Name</th>
						<th data-column-id="doc_name">Doctor Name</th>
						<th data-column-id="doc_mobile">Contact Number</th>
						<th data-column-id="doc_email">Email Id</th>
						<th data-column-id="doc_address">Address</th>
						<th data-column-id="doc_qualification">Qualification</th>
						<th data-column-id="doc_exp">Experience</th>
						<th data-column-id="doc_specialization">Specialization</th>
						<th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- Add Car Modal -->
<div id="doctor_modal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<form id="doctor_form">
			<div class="modal-content shadow-lg p-3 mb-5 bg-white rounded text-left">
				<div class="modal-body">
					<u><h4 >Personal Details: </h4></u>
					<hr/>
					<div class="row">
						<input type="text" name="edit_id" id="edit_id" class="form-control"  style="display: none"/>
						<div class="col-md-6 mt-4">
							<label>Hospital Name</label>
							<select name="edit_hname" id="edit_hname" class="form-control">
								<option>--Select Hospital Name--</option>
								<?php
								$brand = "SELECT hsp_id, hsp_name from hospital";
								$brand_result = mysqli_query($con, $brand);
								$brand_count = mysqli_num_rows($brand_result);
								if($brand_count > 0)
								{
								while($brand_row = mysqli_fetch_array($brand_result))
								{
								?>
								<option value="<?php echo $brand_row["hsp_name"] ?>"><?php echo $brand_row["hsp_name"] ?></option>
								<?php
								}
								}
								?>
							</select>
						</div>
						<div class="col-md-6 mt-4">
							<label>Doctor Name</label>
							<input type="text" name="edit_dname" id="edit_dname" class="form-control"  required />
						</div>
						<div class="col-md-6 mt-4">
							<label>Contact Number</label>
							<input type="text" name="edit_number" id="edit_number" class="form-control" pattern="[0-9]{10}" MaxLength="10" required title="Kindly Enter 10 Digit Number"  />
						</div>
						<div class="col-md-6 mt-4">
							<label>Email Id</label>
							<input type="email" name="edit_email" id="edit_email" class="form-control" required  />
						</div>
						<div class="col-md-12 mt-4">
							<label>Address</label>
							<textarea name="edit_address" id="edit_address" class="form-control" required ></textarea>
						</div>
						<div class="col-md-12 mt-4" id="gender_selection">
							<div class="form-group">
								<p class="font-weight-bold text-left" style="font-size:18px;">Gender :</p>
							</div>
							<div class="radio">
								<label style="color: black;">
								<input type="radio" name="gender" value="Male" required>
								Male
								</label>
								<label style="color: black;">
								<input type="radio" name="gender" value="Female" required>
									Female
								</label>
							</div>
						</div>
						<div class="col-md-6 mt-4">
							<label>Qualification</label>
							<input type="text" name="edit_qualification" id="edit_qualification" class="form-control" required  />
						</div>
						<div class="col-md-6 mt-4">	
							<label>Experience</label>
							<input type="text" name="edit_experience" id="edit_experience" class="form-control" required  />
						</div>
						<div class="col-md-6 mt-4">
							<label>Specialization</label>
							<textarea name="edit_specialization" id="edit_specialization" class="form-control" required ></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn bg-success text-white" value="Add" />
					<button type="button" data-dismiss="modal" class="btn bg-danger class text-white">Close</button>
				</div>	
			</div>
		</form>
	</div>
</div>

<!-- The Confirmation Modal -->
<div id="delete" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="delete_form">
			<div class="modal-content shadow-lg p-3 mb-5 bg-white rounded text-left">
				<div class="modal-header">
					<h4 class="modal-title">Confirmation Deletion</h4>
				</div>
				<div class="modal-body">
					<input type="text" name="doc_id1" id="doc_id1" class="form-control" style="display: none"/>
					<h6>Are you sure you want to delete <mark><label name="doc_name1" class="font-weight-bold" id="doc_name1"></label></mark>  Doctor Details?</h6>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="operation1" id="operation1" />
					<input type="submit" name="action1" id="action1" class="btn bg-success text-white" value="Yes" />
					<button type="button" data-dismiss="modal" class="btn bg-danger class text-white">No</button>
				</div>
			</div>
		</form>
	</div>
</div>

</div>

<?php
include('footer.php');
?>

<script>
/* Fetch data from data base */
	$(document).ready(function(){
		var productTable = $('#product_data').bootgrid({
		ajax: true,
		rowSelect: true,
		ajaxSettings: {
        method: "GET",
        cache: false
		},
		post: function()
		{
		return{
		id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
		};
		},
		url: "doctorResponse.php",
		formatters: {
		"commands": function(column, row)
		{ 
		return "<button type='button' class='btn btn-xs update' data-row-id='"+row.doc_id+"' style='padding: 0px; color: #17a2b8;'> <i class='material-icons'>edit</i></button>" + 
		"<button type='button' class='btn btn-xs delete' data-row-id='"+row.doc_id+"' style='padding: 0px; color:indianred;'><i class='material-icons'>delete_forever</i></button>";
		}
		}
	});

/* Form submission for insert and update */
	$(document).on('submit', '#doctor_form', function(event){
		event.preventDefault();
		var operation = $('#operation').val();
		var hospital_name = $("#edit_hname").val();
			if(hospital_name == "--Select Hospital Name--")
			{
				alert("Kindly select Hospital Name");
				$("#doctor_modal").modal('show');
			}
			else
			{
				if(operation == "Add")
				{
						$.ajax({
						url:"doctorResponse.php",
						method:"POST",
						data:new FormData(this),
						contentType: false,
						cache : false,
						processData: false,
						success:function(data)
						{
						alert(data);
						window.location.href="ManageDoctor.php";
						}
						});
				}
				else{
					var edit_id = $('#edit_id').val();
					var edit_hname = $('#edit_hname').val();
					var edit_number = $('#edit_number').val();
					var edit_email = $('#edit_email').val();
					var edit_address = $('#edit_address').val();
					var edit_qualification = $('#edit_qualification').val();
					var edit_experience = $('#edit_experience').val();
					var edit_specialization = $('#edit_specialization').val();

					$.ajax({
					url:"doctorResponse.php",
					method:"PUT",
					data:{edit_hname:edit_hname, edit_id:edit_id, edit_number:edit_number, edit_email:edit_email, edit_address:edit_address, edit_qualification:edit_qualification, edit_experience:edit_experience, edit_specialization: edit_specialization},
					success:function(data)
					{
					alert(data);
					window.location.href="ManageDoctor.php";
					}
					});
				}
			}
	});
	
/* fetch data for updation data */
	$(document).on("loaded.rs.jquery.bootgrid", function()
	{
		productTable.find(".update").on("click", function(event)
		{	
		var doc_id = $(this).data("row-id");
		$.ajax({
			url:"doctorResponse.php",
			method:"REQUEST",
			data:{doc_id:doc_id},
			dataType:"json",
			success:function(data)
			{
			$('#action').css("display", "initial");
			$('#doctor_modal').modal('show');
			$('#edit_id').val(data.doc_id);
			$('#edit_hname').val(data.hsp_id);
			$('#edit_dname').val(data.doc_name);
			$('#edit_number').val(data.doc_mobile);
			$('#edit_email').val(data.doc_email);
			$('#edit_address').val(data.doc_address);
			$('#edit_qualification').val(data.doc_qualification);
			$('#edit_experience').val(data.doc_exp);
			$('#edit_specialization').val(data.doc_specialization);

			$("#edit_dname").attr("readonly", "true");
			$("#gender_selection").css("display","none");
			$("input[name=gender]").removeAttr("required");

			$('#action').val("Edit");
			$('#operation').val("Edit");
			}
		});
		});
	});

/* fetch data for delete */
	$(document).on("loaded.rs.jquery.bootgrid", function()
	{
		productTable.find(".delete").on("click", function(event)
		{
		var doc_idDel = $(this).data("row-id");

		$.ajax({
			url:"doctorResponse.php",
			method:"REQUEST",
			data:{doc_idDel:doc_idDel},
			dataType:"json",
			success:function(data)
			{
			$('#delete').modal('show');
			$('#doc_id1').val(data.doc_id);
			$('#doc_name1').text(data.doc_name);
			$('#action1').val("Yes");
			$('#operation1').val("Delete");
			}
		});
		});
	}); 
	
/* form submission on delete */
	$(document).on('submit', '#delete_form', function(event){
		event.preventDefault();
		var doc_id1 = $('#doc_id1').val();
		$.ajax({
			url:"doctorResponse.php",
			method:"DELETE",
			data:{doc_id1:doc_id1},
			success:function(data)
			{
			alert(data);
			window.location.href="ManageDoctor.php";
			}
			});
	});
});

/* add button click */
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#doctor_form')[0].reset();
		$('#action').val("Add");
		$('#operation').val("Add");
		$("#edit_dname").removeAttr("readonly");
		$("#gender_selection").css("display","initial");
		$("input[name=gender]").attr("required", "true");
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
?>