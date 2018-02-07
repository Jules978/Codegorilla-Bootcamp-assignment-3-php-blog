<?php
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    //add new comment to database
    $dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
	$user_name = 'root';
	$pass_word = '';
	$db='blogv2';

	$msg =  $_POST["message"];
	$date = date(" d.M.Y: ");
	$fullmessage = $date.$msg;
	$sectionid= $_POST["sectionid"];
	$int_sectionid = (int)$sectionid;
 
	$connection = new PDO($dsn, $user_name, $pass_word);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
		$sql = "INSERT INTO comments (comment, article_id)" .
		 "VALUES (:fullmessage,:int_sectionid)";
		
		$statement = $connection->prepare($sql);
		$statement->bindParam(":fullmessage", $fullmessage);
		$statement->bindParam(":int_sectionid", $int_sectionid);
		$statement->execute();
			
		echo $fullmessage;
		}
		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection
		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}
		
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') { 
	if(isset($_GET["action"]) && $_GET['action'] == "read") {
		
		//get comments from database
		$dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';

		$sectionid= $_GET["sectionid"];
		$int_sectionid = (int)$sectionid;
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try {
			$sql = 'SELECT * FROM comments WHERE article_id ="'.$int_sectionid.'"ORDER BY comment_id DESC'; 
			$statement = $connection->query($sql); 
			$commentresult = $statement->fetchall(\PDO::FETCH_ASSOC);
			$commentJSON = json_encode($commentresult);
			echo $commentJSON;
		}

		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection
		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}

	} else {
		echo "GET REQUEST FAILED AGAIN";
	};
};
?>

