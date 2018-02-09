<?php
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    //add new word to database
    $dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
	$user_name = 'root';
	$pass_word = '';
	$db='blogv2';

	$word =  $_POST["word"];
	
	$connection = new PDO($dsn, $user_name, $pass_word);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
		$sql = "INSERT INTO autofinish (word)" .
		 "VALUES (:word)";
		
		$statement = $connection->prepare($sql);
		$statement->bindParam(":word", $word);
		$statement->execute();
		echo $word;
		}
		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection
		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}
		
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') { 
		
		//get autofinish words from database
		$dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';

		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		try {
			$sql = 'SELECT word FROM autofinish'; 
			$statement = $connection->query($sql); 
			$wordresult = $statement->fetchall(\PDO::FETCH_ASSOC);
			$wordJSON = json_encode($wordresult);
			echo $wordJSON;
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

