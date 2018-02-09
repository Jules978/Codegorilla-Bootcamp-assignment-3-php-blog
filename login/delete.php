<?php
//delete comments from database	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST["action"]) && $_POST['action'] == "remove") {
	    $dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';

		$commentid =  $_POST["commentid"];
		$int_commentid = (int)$commentid;
	 
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$sql = 'DELETE FROM comments WHERE comment_id="'.$int_commentid.'"';
			$statement = $connection->query($sql); 
			echo "comment removed";
		}

		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection

		if(isset($_SERVER['HTTP_REFERER'])) {
		    $previous = $_SERVER['HTTP_REFERER'];
		}
	} elseif(isset($_POST["action"]) && $_POST['action'] == "block") {

		$dsn = 'mysql:dbname=blogv2;host=127.0.0.1';
		$user_name = 'root';
		$pass_word = '';
		$db='blogv2';

		$articleid =  $_POST["articleid"];
		$int_articleid = (int)$articleid;
			 
		$connection = new PDO($dsn, $user_name, $pass_word);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$sql = 'UPDATE articles SET disable_comments = "true" WHERE a_id="'.$int_articleid.'"'; 

			$statement = $connection->query($sql); 
			echo $int_articleid." commentsection removed";
		}
		catch(PDOException $e) {
		 echo $sql . "<br>" . $e->getMessage();
		}

		$connection = null; // Close connection

			if(isset($_SERVER['HTTP_REFERER'])) {
		    	$previous = $_SERVER['HTTP_REFERER'];
			}
}else {
		echo "GET REQUEST FAILED AGAIN"; 
	}; 
}
?>

