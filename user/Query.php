<?php
include('../header.php');
include("../connection.php");
if(isset($_SESSION["type"]))
{
	$query = "select * from chat where user_id = '".$_SESSION["id"]."' order by chat_id ASC";
	$data = mysqli_query($con, $query);
	$count = mysqli_num_rows($data);
		
?>

<div class="container-fluid my-3">
	<h5>Welcome <?php echo $_SESSION["type"]; ?>!</h5>
	<hr/>
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<div class="shadow-lg mb-5 bg-white rounded" style="box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important; padding: 1rem 0px 1rem 1rem;">
				<br/>
				<div id="main" style="height: 350px;overflow-y: scroll;overflow-x: hidden;">
					<div id="loading">	
						<img src="../images/dots.gif" class="img-responsive" width="20%"/>
					</div>
					<div id="chat" style="display:none;">			
						<div class="row">
							<div class="col-md-1 text-right pr-0 mt-auto">
							<i class="fas fa-stethoscope" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
							</div>
							&nbsp;&nbsp;<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 20px 0px;">
								<span>Hii, Welcome to our chatbot! How can i help you?</span>
							</div>
							<div class="col-md-3">
							</div>
						</div>
						<br/>
						<?php
						/* if last chats are in database */
						if($count > 0)
						{
							while($row = mysqli_fetch_array($data))
							{
								echo '<div class="row">
										<div class="col-md-3">
										</div>
										<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 0px 20px;">
											<span>'.$row["question"].'</span>
										</div>
										<div class="col-md-1  text-right pl-0 mt-auto">
											<i class="fa fa-user" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
										</div>
									  </div>
									  <br/>';
								if($row["answer"] != "")
								{
									echo '<div class="row">
											<div class="col-md-1 text-right pr-0 mt-auto">
												<i class="fas fa-stethoscope" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
											</div>
											&nbsp;&nbsp;
											<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 20px 0px;">
												<span>'.$row["answer"].'</span>
											</div>
											<div class="col-md-3">
											</div>
										  </div>
										  <br/>';
								}
							}
						}
						?>
					</div>
				</div>
				<br/>
				<form method="post" id="send">
					<div class="input-group" style="border: 1px solid gray;border-radius: 21px;padding: 3px;">
						<?php
						$select = "select chat_id from chat ORDER BY chat_id DESC LIMIT 1";
						$result = $connect->prepare($select);
						$result->execute();	
						if($row = $result->fetchAll())
						{
							foreach($row as $r)
							$chat_id = $r["chat_id"] + 1;
						}
						else
						{
							$chat_id = "1";
						}
						?>
						<input type="text" class="form-control" name="id" value="<?php echo $chat_id; ?>" id="chat_id" style="display:none;" />
						  <input type="text" class="form-control" placeholder="Type Something..." style="background-image: none;" name="input" id="input" required />
						  <span class="input-group-btn">
						  
							<button class="btn btn-default" type="submit" style="margin-bottom: 0px; color: gray;" name="submit">
								<i class="material-icons">send</i>
							</button>
						  </span>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>

</div>
<?php 
include('../footer.php'); 
?>

<script>

var interval = null;
var height = 0;

$(document).ready(function() {
	/* fetch height of chat box for scroll */
	height = parseInt($("#chat").height());
	$('#main').animate({ scrollTop: height });
	<?php
	if($count > 0)
	{
	?>
		$("#loading").css("display", "none");
		$("#chat").css("display", "initial");
	<?php
	}
	else
	{
	?>
		interval = setInterval(updateDiv, 2000);
	<?php
	}
	?>
});

function updateDiv(){
	$("#loading").css("display", "none");
	$("#chat").css("display", "initial");
	clearInterval(interval); 
}

/* submit question */
$(document).on('submit', '#send', function(event){
	var data = $("#input").val().replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
	event.preventDefault();
	
	$.ajax({
		url:"QueryResponse.php",
		method:"POST",
		data:new FormData(this),
		dataType:"json",
		contentType: false,
		cache: false,
		processData:false,
		success:function(data)
		{
			/*On question insert*/
			$("#input").val('');
			$("#chat").append(data.question_div);
			var id = parseInt(data.id);
			
			id = id+1;
			$("#chat_id").val(id);
			
			/* auto scroll down */
			$('#main').animate({scrollTop: $('#main').prop("scrollHeight")});
			
			/* add gif icon */
			interval = setInterval(function()
			{ 		
				$("#chat").append('<div class="row temp_loading"><div class="col-md-1 text-right pr-0 mt-auto"><i class="fas fa-stethoscope" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i></div>&nbsp;&nbsp;<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 20px 0px;"><span><img src="../images/dots.gif" class="img-responsive" width="20%"/></span></div><div class="col-md-3"></div></div><br/>');
				
				/* auto scroll down */
				$('#main').animate({scrollTop: $('#main').prop("scrollHeight")});
				
				clearInterval(interval);
				/* fetch answer from database */
				var interval1 = setInterval(function()
				{
					loading(data.question, data.id);
					clearInterval(interval1);
				},1000);	
			}, 1000);
			
		}
	});
});

function loading(question, id){
	$.ajax({
		url:"QueryResponse.php",
		method:"POST",
		data:{question:question, id:id},
		success:function(data)
		{
			$("#chat").append(data);
			$(".temp_loading").css("display", "none");
			/* auto scroll down */
			$('#main').animate({scrollTop: $('#main').prop("scrollHeight")});
		}
});
}	
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