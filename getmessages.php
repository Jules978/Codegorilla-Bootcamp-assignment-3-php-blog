<?php

//load articles from database, no sort, highest id first	
if ($_SERVER['REQUEST_METHOD'] == 'GET') { //does stuff if the request method is get
	if(isset($_GET["action"]) && $_GET['action'] == "read") {
		
		$dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';

		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
			$sql = 'SELECT * FROM articles  ORDER BY a_id DESC' ; 
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

	//load articles in category from database
	}elseif(isset($_GET["action"]) && $_GET['action'] == "sort") {
		
		$dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';
		$category =  $_GET['category']; 
		
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
			$sql = 'SELECT * FROM articles_categories JOIN articles on articles_categories.article_id = articles.a_id JOIN categories on articles_categories.category_id = categories.c_id WHERE c_id ="'.$category.'" ORDER BY articles.a_id DESC';
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

	//get all category names from database
	}elseif(isset($_GET["action"]) && $_GET['action'] == "cat") {
		$dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';
		
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {		
			$sql = 'SELECT * FROM categories';  
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



