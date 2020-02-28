<?php
require_once '../load.php';
confirm_logged_in();

if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    if(empty($fname) || empty($username) || empty($password) || empty($email)){
        $message = 'Please fill all the fields';
    }else{
        createUser($fname, $username, $password, $email);
        //All data are pre-processed, and good to go
        //send it to the user creating API
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h2>Create User</h2>
    <?php echo !empty($message)? $message:''; ?>
    <form action="admin_createuser.php" method="post">
        <label>First Name:</label><br>
        <input type="text" name="fname" value=""><br>

        <label>Email:</label><br>
        <input type="text" name="email" value=""><br>

        <label>Username:</label><br>
        <input type="text" name="username" value=""><br>

        <label>Password:</label><br>
        <input type="password" name="password" value=""><br>

        <button name="submit" type="submit">Create User</button>
    </form>
    
</body>
</html>