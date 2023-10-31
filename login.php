<?php
session_start();

$usersFile = "users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

echo $_SESSION["email"];

 if (isset($_POST["login"])) {

     $login_email = $_POST["email"];
     echo ($login_email); 

     if ($_SESSION["email"] === $login_email){
        foreach ($users as $user) {
            if ($user["role"] === "manager") {
                header("Location: manager.php");
            } else if($user["role"] === "admin") {
                header("Location: role_management.php");
            } else {
                header("Location: user.php");
            }
        }
        echo "user found";
     } else {
        echo "user not found";
     }
    
    // foreach ($users as $user) {

    //     if ()
    // }



//         // if ($user["role"] === "x") {
//         //     header("Location: user.php");
//         // } 
        
//    }
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <label for="">Enter Email:</label> <br>
        <input type="text" name="email"> <br> <br>
        <label for="">Enter Password:</label> <br>
        <input type="text" name="password"> <br> <br>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>