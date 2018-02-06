<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
	$user_name = 'root';
	$pass_word = '';
	$db='blogv2';

	$blog_title =   $_POST["blogtitle"];
	$categories_string =  $_POST["blogcategories"];
	$categories_array = explode(',', $categories_string);
	$blog_text= $_POST["blogtext"];
	$date = date("F jS Y");

 	$connection = new PDO($dsn, $user_name, $pass_word);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
			$sql = "INSERT INTO articles (title, date, text) " .
			 "VALUES (:blog_title, :date, :blog_text)";
			$statement = $connection->prepare($sql);
			$statement->bindParam(":blog_title", $blog_title);
			$statement->bindParam(":date", $date);
			$statement->bindParam(":blog_text", $blog_text);
			$statement->execute();
		    $last_id = $connection->lastInsertId();
		    
		    echo $last_id;

		   foreach ($categories_array as $cat) {
    $int_cat = (int)$cat;
    $sql2 = "INSERT INTO articles_categories (article_id, category_id) " .
			 "VALUES (:last_id, :int_cat)";
			$statement = $connection->prepare($sql2);
			$statement->bindParam(":last_id", $last_id);
			$statement->bindParam(":int_cat", $int_cat);
		
			$statement->execute();
			echo $last_id;
			
			} 
			
			
			
			


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



