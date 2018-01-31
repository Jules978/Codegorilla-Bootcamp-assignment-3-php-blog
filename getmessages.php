<?php
	
if ($_SERVER['REQUEST_METHOD'] == 'GET') { //does stuff if the request method is get
	if(isset($_GET["action"]) && $_GET['action'] == "list") {
	 $dsn = 'mysql:dbname=blogdb;host=127.0.0.1';
$user_name = 'root';
$pass_word = '';
$db='blogdb';

		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try {
		$sql = 'SELECT id FROM chat ';  //WHERE mykey ="'.$mykey.'"
		$statement = $connection->query($sql); 
		$result = $statement->fetchall(\PDO::FETCH_ASSOC);
		
		$ids = array();

		foreach($result as $row) {
			$ids[] = $row["id"];
		}

		$resultJSON = json_encode($ids);

		echo $resultJSON;


		}


		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection
		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}

	} elseif(isset($_GET["action"]) && $_GET['action'] == "read") {
		$dsn = 'mysql:dbname=blogdb;host=127.0.0.1';
$user_name = 'root';
$pass_word = '';
$db='blogdb';
$postid =  $_GET['postid']; 

		
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
		$sql = 'SELECT * FROM blogposts ORDER BY ID DESC';  //WHERE id ="'.$postid.'"
		
		$statement = $connection->query($sql); 
		$result = $statement->fetchall(\PDO::FETCH_ASSOC);
		$blogJSON = json_encode($result);

		echo $blogJSON;
		
		}

		catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection

		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}


	}elseif(isset($_GET["action"]) && $_GET['action'] == "sort") {
		$dsn = 'mysql:dbname=blogdb;host=127.0.0.1';
$user_name = 'root';
$pass_word = '';
$db='blogdb';
$catagory =  $_GET['catagory']; 

		
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
		$sql = 'SELECT * FROM blogposts WHERE catagory ="'.$catagory.'" ORDER BY ID DESC ';  //WHERE id ="'.$postid.'"
		
		$statement = $connection->query($sql); 
		$result = $statement->fetchall(\PDO::FETCH_ASSOC);
		$blogJSON = json_encode($result);

		echo $blogJSON;
		
		}

		catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection

		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}


	}





	else {
		echo "GET REQUEST FAILED AGAIN"; 
	 
	}; 

   
}; 
?>



