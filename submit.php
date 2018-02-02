<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dsn = 'mysql:dbname=blog;host=127.0.0.1';
	$user_name = 'root';
	$pass_word = '';
	$db='blog';

	$blog_title =   $_POST["blogtitle"];
	$blog_category =  $_POST["blogcategory"];
	$blog_text= $_POST["blogtext"];
	$date = date("F jS Y");

 	$connection = new PDO($dsn, $user_name, $pass_word);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
			$sql = "INSERT INTO articles (title, date, category_id, text) " .
			 "VALUES (:blog_title, :date, :blog_category, :blog_text)";
			$statement = $connection->prepare($sql);
			$statement->bindParam(":blog_title", $blog_title);
			$statement->bindParam(":date", $date);
			$statement->bindParam(":blog_category", $blog_category);
			$statement->bindParam(":blog_text", $blog_text);
			$statement->execute();
			echo $blog_text;
		}

		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection

		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}
		
} 
?>



