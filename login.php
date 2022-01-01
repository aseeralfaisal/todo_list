<?php
session_start();
$_SESSION['cookie_name'] = 'user';
$db = mysqli_connect("localhost", "root", "2021->2022", "todos");
if (!$db) {
    die(mysqli_connect_error());
}
$wrong_pass = "";
if (isset($_POST['login'])) {
    $name = $_POST['user'];
    $_SESSION['username'] = $_POST['user'];
    $pass = $_POST['pass'];
    $users = mysqli_query($db, "SELECT * FROM users");
    foreach ($users as $user) {
        if ($user['name'] == $name && $user['pass'] == $pass) {
            $_SESSION['userid'] = $user['id'];
            header("Location: index.php");
            $wrong_pass = "";
        } else {
            // header("Location: login.php");
            $wrong_pass = "<label>Wrong username or password</label>";
        }
    }
}
if (isset($_POST['register'])) {
    header("Location: register.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body>
    <div class="form-parent">
        <form class="form" action="login.php" method="post">
            <i id="icon" class="far fa-calendar-check"></i>
            <h1 class="title">ToDo List</h1>
            <input type="text" placeholder="Username" name="user">
            <input type="text" placeholder="Password" name="pass">
            <input id="submit" value="Login" type="submit" name="login">
            <form class='not-logged-in'>
                <label>No registered yet!</label>
                <input class='register' type='submit' name='register' value='Register'>
            </form>
            <?php
            if ($wrong_pass == true) {
                echo ($wrong_pass);
            }
            ?>
        </form>
    </div>
</body>

</html>