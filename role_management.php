<?php
session_start();

$usersFile = "users.json";
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if (isset($_POST["edit_role"])) {
    $selectedUser = $_POST["select_user"];
    $newRole = $_POST["select_role"];

    if (isset($users[$selectedUser])) {
        // Update the user's role
        $users[$selectedUser]["role"] = $newRole;
        // Save the updated user data back to the JSON file
        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        header("Location: role_management.php");
        exit;
    }
} elseif (isset($_POST["delete_user"])) {
    $selectedUser = $_POST["select_user"];

    if (isset($users[$selectedUser])) {
        // Remove the user from the user data
        unset($users[$selectedUser]);
        // Save the updated user data back to the JSON file
        file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
        header("Location: role_management.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
</head>
<body>
    <form action="role_management.php" method="post">
        <label for="select_user">Select User:</label><br>
        <select name="select_user" id="select_user">
            <?php
            // Populate the dropdown with user emails from your user data
            foreach ($users as $email => $userData) {
                echo '<option value="' . $email . '">' . $email . '</option>';
            }
            ?>
        </select><br><br>
        <label for="select_role">Edit Role:</label><br>
        <select name="select_role" id="select_role">
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
            <option value="user">User</option>
        </select><br><br>
        <button type="submit" name="edit_role">Edit Role</button>
        <button type="submit" name="delete_user">Delete User</button>
    </form>
</body>
</html>
