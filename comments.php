<?php
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dsn = 'mysql:dbname=blog;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blog';

	$msg =  $_POST["message"];
	$date = date(" F jS, Y (H:s): ");
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
		

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') { //does stuff if the request method is get
	if(isset($_GET["action"]) && $_GET['action'] == "read") {
		 $dsn = 'mysql:dbname=blog;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blog';

		$sectionid= $_GET["sectionid"];
		$int_sectionid = (int)$sectionid;
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try {
		$sql = 'SELECT * FROM comments WHERE article_id ="'.$int_sectionid.'"'; 
		$statement = $connection->query($sql); 
		$commentresult = $statement->fetchall(\PDO::FETCH_ASSOC);
		
		

		
		$commentJSON = json_encode($commentresult);

		//var_dump($resultJSON) ;
		//echo $commentJSON;
		echo $commentJSON;


		}


		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection
		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}

	} elseif(isset($_GET["action"]) && $_GET['action'] == "read") {
		 $dsn = 'mysql:dbname=blog;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blog';

		$id =  $_GET['id']; 
		$mykey= $_GET['mykey'];
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
		$getmsg = 'SELECT message FROM chat WHERE id ="'.$id.'" AND mykey ="'.$mykey.'"'; 
		$getusr = 'SELECT username FROM chat WHERE id ="'.$id.'" AND mykey ="'.$mykey.'"';
		$statement1 = $connection->query($getmsg); 
		$statement2 = $connection->query($getusr); 
		$result1 = $statement1->fetchcolumn();
		$result2 = $statement2->fetchcolumn();	
		$fullmessage = $result2." : ".$result1;	
		echo $fullmessage;
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

