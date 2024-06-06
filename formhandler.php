<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once "connect.php";

        $query = "INSERT INTO accounts (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = null;
        $pdo = null;

        header("Location: randomspacemedia.html");
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: randomspacemedia(register).html");
    die();
}
?>
