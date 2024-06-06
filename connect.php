<?php

	$dsn = "mysql:host=localhost;dbname=startrainaccs;";
	$name = "root";
	$pass = "";
	
	try
	{
		$pdo = new PDO($dsn, $name, $pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Connection failed " . $e->getMessage();
	}

?>