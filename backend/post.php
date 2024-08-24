<?php
session_start();
include_once "./db.php";

// Check if the user is logged in
if (isset($_SESSION['id'])) { // Correct session key is 'id' based on your login code
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fact']) && isset($_POST['source'])) {
        $fact = $_POST['fact'];
        $source = $_POST['source'];

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO facts (user_id, fact, source) VALUES (:user_id, :fact, :source)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $_SESSION['id'],  
            'fact' => $fact,
            'source' => $source
        ]);

        // Check if the statement executed successfully
        if ($stmt) {
            header("Location:../index.php?message=New fact posted successfully");
            exit();
        } else {
            header("Location:../index.php?error=Error posting fact!");
            exit();
        }
    } else {
        header("Location:../index.php?error=Fact and Source are required fields!");
        exit();
    }
} else {
    header("Location:../index.php?error=Please login to post a fact!");
    exit();
}
