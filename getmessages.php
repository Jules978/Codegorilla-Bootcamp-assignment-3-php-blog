<?php
	
if ($_SERVER['REQUEST_METHOD'] == 'GET') { //does stuff if the request method is get
	if(isset($_GET["action"]) && $_GET['action'] == "read") {
		$dsn = 'mysql:dbname=blog;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blog';

		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
			$sql = 'SELECT * FROM articles INNER JOIN categories ON articles.category_id=categories.id ORDER BY articles.aid DESC' ;  //WHERE id ="'.$postid.'"
					
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
		$dsn = 'mysql:dbname=blog;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blog';
		$category =  $_GET['category']; 
		
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
			$sql = 'SELECT * FROM articles INNER JOIN categories ON articles.category_id=categories.id WHERE category_id ="'.$category.'" ORDER BY articles.aid DESC';
			
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

	}elseif(isset($_GET["action"]) && $_GET['action'] == "cat") {
		$dsn = 'mysql:dbname=blog;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blog';
		
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
			$sql = 'SELECT * FROM categories';  //WHERE id ="'.$postid.'"
			
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



