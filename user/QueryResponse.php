<?php
include("../connection.php");
session_start();

if(isset($_POST["question"]))
{
	/* replace special characters */
	$question = preg_replace('/[^A-Za-z0-9\. -]/', '', $_POST["question"]);
	
	$split = "";
	$key = array();
	$answer = "";
	$str = "";
	
	/* data store into array */
	$split = explode(" ", strtolower(trim($question)));
	
	/* all articles */
	$common = array("abt", "n", "nd", "guys", "be", "doing", "what" ,"will", "ask", "should" ,"its", "any", "the", "it", "we", "hot", "about", "interested", "interest", "let", "get", "wanted", "well", "self", "may", "a", "an", "m", "by", "im", "looking", "available", "possible", "availability", "per", "to", "you", "me", "he", "she", "they", "we", "how", "it", "i", "are", "and", "to", "for", "of", "with", "is", "an", "at", "very", "too", "tell", "now", "need", "urgent", "urgently", "mean" , "help", "no", "this", "if", "couldn't", "could", "would", "wouldn't", "can", "can't", "in", "on", "him", "did", "all", "not", "get", "sent", "send", "do", "you", "u", "hv", "have", "had", "hd", "give","pls", "please", "your", "ur", "urs", "yours", "any", "using", "use", "uses", "relate", "related", "new", "contain", "contains", "or", "that", "i", "am", "get", "getting", "gets", "after", "all", "but", "from", "frm", "my", "so", "know", "knows", "of", "go", "though", "through", "which", "othr", "nw", "nd", "urg", "plz", "relates", "containing", "got", "want", "only", "arent", "based", "ne", "wid", "they", "that", "thats", "thats", "these", "until", "was", "wasnt", "suppose", "proj", "system", "here", "r", "my", "mine", "list", "topics", "domain", "project", "projects", "my", "myself", "am");
	
	foreach($split as $data)
	{
		if (!in_array($data, $common)) 
		{
			$select = "select * from question where main like '%".$data."%'";
			$result = mysqli_query($con, $select);
			$row = mysqli_fetch_array($result);	
			if($row)
			{
				$key = array($row["k1"], $row["k2"], $row["k3"], $row["k4"]);				
				$answer = $row["answer"];				
				break;
			}
			else{
				$answer = "Sorry! I am not getting, what are you saying";
				//$insert = "UPDATE `chat` SET `answer`='".$answer."' WHERE `chat_id` = '".$_POST["id"]."'";
				//$result1 = mysqli_query($con, $insert);
			}	
		}
	}
	
	
	if(isset($key)){
		
		$str = '<div class="row">
							<div class="col-md-1 text-right pr-0 mt-auto">
								<i class="fas fa-stethoscope" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
							</div>
							&nbsp;&nbsp;
							<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 20px 0px;">	
								<span>'.$answer.'</span>
							</div>
							<div class="col-md-3">
							</div>
						</div>
						<br/>';
				$insert = "UPDATE `chat` SET `answer`='".$answer."' WHERE `chat_id` = '".$_POST["id"]."'";
				$result1 = mysqli_query($con, $insert);
	}
	else{
		
		foreach($split as $data)
		{
			if (in_array($data, $key)) 
			{	
				$str = '<div class="row">
							<div class="col-md-1 text-right pr-0 mt-auto">
								<i class="fas fa-stethoscope" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
							</div>
							&nbsp;&nbsp;
							<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 20px 0px;">	
								<span>'.$answer.'</span>
							</div>
							<div class="col-md-3">
							</div>
						</div>
						<br/>';
				$insert = "UPDATE `chat` SET `answer`='".$answer."' WHERE `chat_id` = '".$_POST["id"]."'";
				$result1 = mysqli_query($con, $insert);
				break;
			}
			else
			{
				$str = '<div class="row">
							<div class="col-md-1 text-right pr-0 mt-auto">
								<i class="fas fa-stethoscope" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
							</div>
							&nbsp;&nbsp;
							<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 20px 0px;">
								<span>Sorry! I am not getting, what are you saying</span>
							</div>
							<div class="col-md-3">
							</div>
						</div>
						<br/>';
						
				$insert = "UPDATE `chat` SET `answer`='Sorry! I am not getting, what are you saying' WHERE `chat_id` = '".$_POST["id"]."'";
				$result1 = mysqli_query($con, $insert);
				
			}
		}
	
	}	
	
	echo $str;
}
else
{
	$id = $_POST["id"];
	$question = addslashes($_POST["input"]);
	$insert = "INSERT INTO `chat`(`chat_id`, `user_id`, `question`) VALUES ('".$id."', '".$_SESSION["id"]."', '".$question."')";
	$result = mysqli_query($con, $insert);
	if($result)
	{
		$output["question_div"] = '<div class="row"">
										<div class="col-md-3">
										</div>
										<div class="col-md-8" style="background-color: #80808047;padding: 10px;border-radius: 20px 20px 0px 20px;">
											<span>'.$question.'</span>
										</div>
										<div class="col-md-1  text-right pl-0 mt-auto">
											<i class="fa fa-user" style="background-color: #03a9f4;padding: 5px;color: white;border-radius: 16px;"></i>
										</div>
									</div>
									<br/>';
		$output["question"] = $question;
		$output["id"] = $id;
		echo json_encode($output);
		
	}
} 

?>