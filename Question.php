<?php
include('header.php');
include('connection.php');
if(isset($_SESSION["type"]))
{
	
?>
	<div class="container">  
		<br />
		<div class="table-responsive my-5">  
		<h3 align="center" class="pt-5">Question List</h3><br />
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
					url: "QuestionResponse.php",
					data: filter
					});
				},
				/* For insert  Details*/
				insertItem: function(item)
				{
					return $.ajax({
					type: "POST",
					url: "QuestionResponse.php",
					data:item
					});
				},
				/* For Update Details */
				updateItem: function(item)
				{
					return $.ajax({
					type: "PUT",
					url: "QuestionResponse.php",
					data: item
					});
				},
				/* For delete Details */
				deleteItem: function(item)
				{
					return $.ajax({
					type: "DELETE",
					url: "QuestionResponse.php",
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
					name: "main",
					title: "Main Keyword",
					type: "text", 
					width: 150,
					insertcss : "main_css",
					css: "search_main",
					validate: 
					{
						validator: "required",
						message: "Kindly enter Main Keyword"
					}    
				},
				/* k1 text field  */
				{
					name: "k1",
					title: "Key 1",
					type: "text", 
					width: 150,
					insertcss : "k1_css",
					css: "search_k1",
					validate: 
					{
						validator: "required",
						message: "Kindly enter Key1"
					}    
				},
				/* k2 text field  */
				{
					name: "k2",
					title: "Key 2",
					type: "text", 
					width: 150,
					insertcss : "k2_css",
					css: "search_k2",
					validate: 
					{
						validator: "required",
						message: "Kindly enter Key2"
					}    
				},
				/* k3 text field  */
				{
					name: "k3",
					title: "Key 3",
					type: "text", 
					width: 150,
					insertcss : "k3_css",
					css: "search_k3",
					validate: 
					{
						validator: "required",
						message: "Kindly enter Key3"
					}
				},
				/* k4 text field  */
				{
					name: "k4",
					title: "Key 4",
					type: "text", 
					width: 150,
					insertcss : "k4_css",
					css: "search_k4",
					validate: 
					{
						validator: "required",
						message: "Kindly enter Key4"
					}  
				},
				/* Answer text field  */
				{
					name: "answer",
					title: "Answer",
					type: "textarea", 
					width: 150,
					insertcss : "answer_css",
					css: "search_answer",
					validate: 
					{
						validator: "required",
						message: "Kindly enter Answer"
					}    
				},
				{
					type: "control"
				}
			]
		});

		/* Add placeholder to text field */
		$(".main_css input[type=text]").attr("placeholder", "Enter Main Keyword");
		$(".k1_css input[type=text]").attr("placeholder", "Enter Key 1");
		$(".k2_css input[type=text]").attr("placeholder", "Enter Key 2");
		$(".k3_css input[type=text]").attr("placeholder", "Enter Key 3");
		$(".k4_css input[type=text]").attr("placeholder", "Enter Key 4");
		$(".answer_css textarea").attr("placeholder", "Enter Answer");
		$(".search_main input[type=text]").attr("placeholder", "Search By Main Keyword");
		$(".search_k1 input[type=text]").attr("placeholder", "Search By Key 1");
		$(".search_k2 input[type=text]").attr("placeholder", "Search By Key 2");
		$(".search_k3 input[type=text]").attr("placeholder", "Search By Key 3");
		$(".search_k4 input[type=text]").attr("placeholder", "Search By Key 4");
		$(".search_answer input[type=text]").attr("placeholder", "Search By Answer");
	</script>
</body>
</html>
<?php
}
else
{
	echo "<script>window.location.href='index.php';</script>";
}