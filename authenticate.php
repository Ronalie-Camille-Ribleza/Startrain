<?php

	session_start();
	require_once "connect.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		$stmt = $pdo->prepare("SELECT id, password FROM accounts WHERE username = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password']))
	{
        $_SESSION['user_id'] = $user['id'];
        header("Location: randomspacemedia.html");
        exit;
    }
	else
	{
        echo "Invalid username or password.";
    }
}
?>

