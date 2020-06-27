<?php
include('connection.php');
include('header.php');
if(isset($_SESSION["type"]))
{
	
?>
	<div class="container">  
		<br />
			<div class="table-responsive">  
			<h3 align="center">Hospital List</h3><br />
			<div id="grid_table">
			</div>
		</div>  
	</div>	
</div>

<?php include('footer.php'); ?>

<script>

	$('#grid_table').jsGrid
	({
		width: "100%",
		height: "480px",
		filtering: true,
		inserting:true,
		editing: true,
		sorting: true,
		paging: true,
		autoload: true,
		pageSize: 10,
		pageButtonCount: 5,
		deleteConfirm: "Do you really want to delete data?",
		pagerFormat: "Pages:  {pages}",

		controller:
		{
			/* On window load and for filter */
			loadData: function(filter)
			{
				return $.ajax({
				type: "GET",
				url: "hospitalResponse.php",
				data: filter
				});
			},
			/* For insert  Details*/
			insertItem: function(item)
			{
				return $.ajax({
				type: "POST",
				url: "hospitalResponse.php",
				data:item
				});
			},
			/* For Update Details */
			updateItem: function(item)
			{
				return $.ajax({
				type: "PUT",
				url: "hospitalResponse.php",
				data: item
				});
			},
			/* For delete Details */
			deleteItem: function(item)
			{
				return $.ajax({
				type: "DELETE",
				url: "hospitalResponse.php",
				data: item
				});
			},
		},

		fields: 
		[
			/* hospital Id text field  */
			{
				name: "id",
				type: "hidden",
				css: 'hide'
			},
			/* hospital Name text field  */
			{
				name: "Name",
				type: "text", 
				width: 150,
				
				insertcss : "name_css",
				css: "search_name",
				validate: 
				{
					validator: "required",
					message: "Kindly enter name"
				}    
			},
			/* hospital  Email Id text field  */
			{
				name: "Email", 
				type: "text", 
				email: true,
				width: 150,
				insertcss : "email_css",
				css: "search_email",
				filtercss : "search_email",
				validate: 
				[{
					message: "Kindly enter valid email id",
					validator: function(value,item)
					{
						if(value != "")
						{
							var updemail_text = null;
							var emailReg = new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i);
							/* fetch insert email textbox value*/
							var email_text = $(".email_css input[type=text]").val();	
							/* fetch length and value of update email textbox value*/
							updemail_length = $(".jsgrid-edit-row .search_email input[type=text]").length;
							updemail_text  = $(".jsgrid-edit-row .search_email input[type=text]").val();
							if(updemail_length != 0)
							{
								var rtest = emailReg.test(updemail_text);
							}
							else
							{
								var rtest = emailReg.test(email_text);
							}
							if(rtest != false)
							{
								return true;
							}
						}
					}
				}]
			},
			/* hospital Contact No. text field  */
			{
				name: "Contact", 
				type: "text", 
				width: 150, 
				insertcss : "contact_css",
				css: "search_contact",
				validate: 
				[{
					message: "Kindly enter valid Contact Number",
					validator: function(value,item)
					{
						if(value != "")
						{
							var updcontact_text = null;
							var contactReg = new RegExp(/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/);
							/* fetch insert contact textbox value*/
							var contact_text = $(".contact_css input[type=text]").val();
							/* fetch length and value of update contact textbox value*/
							updcontact_length = $(".jsgrid-edit-row .search_contact input[type=text]").length;
							updcontact_text = $(".jsgrid-edit-row .search_contact input[type=text]").val();
							if(updcontact_length != 0)
							{
								var ctest = contactReg.test(updcontact_text);
							}
							else
							{
								var ctest = contactReg.test(contact_text);
							}
							if(ctest != false)
							{
								return true;
							}
						}
					}
				}]
			},
			/* hospital Address text field  */
			{
				name: "Address", 
				type: "textarea", 
				width: 150, 
				insertcss : "address_css",
				css: "search_address",
				validate: 
				{
					validator: "required",
					message: "Kindly enter Address"
				} 
			},
			{
				type: "control"
			}
		]
	});

	/* add Placeholder Values */
	$(".name_css input[type=text]").attr("placeholder", "Enter Name");
	$(".email_css input[type=text]").attr("placeholder", "Enter Email");
	$(".contact_css input[type=text]").attr("placeholder", "Enter Contact Number");
	$(".address_css textarea").attr("placeholder", "Enter Address");
	$(".search_name input[type=text]").attr("placeholder", "Search By Name");
	$(".search_contact input[type=text]").attr("placeholder", "Search By Contact Number");
	$(".search_email input[type=text]").attr("placeholder", "Search By Email id");
	$(".search_address input[type=text]").attr("placeholder", "Search By Address");
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