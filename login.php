<?php
session_start();

$usersFile = "users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if (isset($_SESSION["email"])) {
    // User is already logged in, handle as needed
    $userRole = $users[$_SESSION["email"]]["role"];
    if ($userRole === "manager") {
        header("Location: manager.php");
        exit;
    } elseif ($userRole === "admin") {
        header("Location: role_management.php");
        exit;
    } else {
        header("Location: user.php");
        exit;
    }
}

if (isset($_POST["login"])) {
    $login_email = $_POST["email"];
    $login_password = $_POST["password"];

    if (isset($users[$login_email]) && $login_password === $users[$login_email]["password"]) {
        $_SESSION["email"] = $login_email;
        $userRole = $users[$login_email]["role"];
        
        if ($userRole === "manager") {
            header("Location: manager.php");
            exit;
        } elseif ($userRole === "admin") {
            header("Location: role_management.php");
            exit;
        } else {
            header("Location: user.php");
            exit;
        }
    } else {
        echo "User not found or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="POST">
        <label for="email">Enter Email:</label><br>
        <input type="text" name="email"><br><br>
        <label for="password">Enter Password:</label><br>
        <input type="password" name="password"><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
