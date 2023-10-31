<?php
session_start([
    "name" => "registration",
]);

$usersFile = "users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile, true)) : [];
// print_r($users);

if (isset($_POST["registration"])) {
    $name = $_POST["name"];
    $name = $_POST["email"];
    $name = $_POST["password"];

    // validation logic
    if (empty($name) || empty($email) || empty($password)) {
        $errorMsg = "Please fill all the input fields";
    } else {
        if (isset($users[$email])) {
            echo "This email already used";
        } else {
            $users[$email] = [
                "name" => $name,
                "password" => $password,
                "role" => ""
            ];

            $saveUsers ($users, $usersFile );
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Enter Name: </label> <br>
        <input type="text" name="name" id=""> <br> <br>
        <label for="">Enter Email: </label> <br>
        <input type="email" name="email" id=""> <br> <br>
        <label for="">Enter Password: </label> <br>
        <input type="password" name="password" id=""> <br> <br>
        <input type="submit" name="registration" id=""> <br> <br>

    </form>
</body>

</html>