<?php
// Simple file-based storage for demonstration purposes
$filename = 'users.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Check if the username already exists
    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($users as $user) {
            list($storedUsername, ) = explode('|', $user);

            if ($username === $storedUsername) {

                header("Location: ext.php");
                exit;
            }
        }
    }

    // Add the user data to users.txt
    $userData = $username . '|' . $password . '|' . $address . '|' . $email . '|' . $phone . PHP_EOL;
    file_put_contents($filename, $userData, FILE_APPEND | LOCK_EX);

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['address'] = $address;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    header("Location: Sreg.php");
    exit;
}
  
?>
