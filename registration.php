<?php
session_start();

$usersFile = "users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];


// print_r($users);

function saveUsers($file, $users)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

if (isset($_POST["registration"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // validation logic
    if (empty($username) || empty($email) || empty($password)) {
    //    echo "Please fill all the input fields";
       
    } else {
        if (isset($users[$email])) {
            $errorMsg = "This email already used";
        } else {
            $users[$email] = [
                "username" => $username,
                "password" => $password,
                "role" => ""
            ];
            // print_r($users);
            saveUsers($usersFile, $users);
            $_SESSION["email"] = $email;

            header("Location: login.php");

            // if(isset($users[$email]["role"]) && $users[$email]["role"] === "admin") {
            //     header("Location: role_management.php");
               
            // }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta username="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Enter Name: </label> <br>
        <input type="text" name="username" id="" required> <br> <br>
        <label for="">Enter Email: </label> <br>
        <input type="email" name="email" id="" required> <br> <br>
        <label for="">Enter Password: </label> <br>
        <input type="password" name="password" id="" required> <br> <br>
        <input type="submit" name="registration" id=""> <br> <br>

    </form>
</body>

</html>