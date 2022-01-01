<?php
$db = mysqli_connect("localhost", "root", "", "todos");
if (!$db) {
    die(mysqli_connect_error());
}
$datas = mysqli_query($db, "SELECT * FROM users");
$exists = "";
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    mysqli_query($db, "INSERT INTO users (name, pass) VALUES ('$user', '$pass')");
    mysqli_query($db, "CREATE TABLE $user (todo VARCHAR(20))");
    foreach ($datas as $data) {
        if ($data['name'] === $user) {
            $exists = "<label class='msg'>User Already Exists</label>";
        }
    }
    header("Location: login.php");
}
mysqli_free_result($datas);
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
    <div class="form-parent">
        <form class="form" action="register.php" method="post">
            <i id="icon" class="far fa-calendar-check"></i>
            <h1 class="title">ToDo List</h1>
            <input type="text" placeholder="Username" name="user">
            <input type="text" placeholder="Password" name="pass">
            <input id="submit" value="Register" type="submit" name="submit">
            <?php
            echo ("$exists");
            ?>
        </form>
    </div>
</body>
</html>