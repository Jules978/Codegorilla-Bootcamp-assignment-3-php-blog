<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $dsn = 'mysql:dbname=blog;host=127.0.0.1';
	$user_name = 'root';
	$pass_word = '';
	$db='blog';
	$new_category =   $_POST["newcategory"];

 	$connection = new PDO($dsn, $user_name, $pass_word);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
		$sql = "INSERT INTO categories (name) " ."VALUES (:new_category)";
		$statement = $connection->prepare($sql);
		$statement->bindParam(":new_category", $new_category);
			
		$statement->execute();
		echo $new_category. " has been added to the database.";
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