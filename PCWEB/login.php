<?php
session_start(); // Start the session

ob_start(); // Start output buffering

$filename = 'users.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if users.txt exists and is not empty
    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($users as $user) {
            list($storedUsername, $storedPassword) = explode('|', trim($user));

            // Compare entered username and password with stored ones
            if ($username === $storedUsername && $password === $storedPassword) {
                $_SESSION['username'] = $username; // Store username in session
                header("Location: account.php"); // Redirect to user account page
                exit;
            }
        }
    }

    // If no match, show invalid username/password message
    header("Location: invalid.php");
    exit;
}

ob_end_flush(); // Flush the output buffer
?>
