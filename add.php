<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "todos");
$username = $_SESSION['username'];

if(!$username){
    header("Location: ./login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Todos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="wrapper">
    <div class="sidebar">
            <div style="display: flex; align-items: center;">
                <i id="icon" class="far fa-calendar-check" style="font-size: 28px; margin: 6px; color: #333;"></i>
                <label class="logo" style="margin-top: 7px; color: #333; font-family: 'Comfortaa'; font-size: 20px; font-weight: bold;">
                    ToDo List</label>
                <div class="close">
                    <span class="fas fa-bars" style="color: #333;"></span>
                </div>
                <div class="user" style="margin-left: 20px; margin-bottom: 8px;">
                    <span class="fas fa-user-circle" style="color: #333; font-size: 28px;"></span>
                    <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold; text-transform: uppercase;">
                        <?php echo '<lebel>' . $username . '</label>' ?></label>
                </div>
            </div>
            <ul style="margin-top: -12px;">
                <li class="active"><a href="index.php">
                        <span style="font-size: 32px; color: #333;" class="fas fa-check-circle"></span>
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">
                            Dashboard
                        </label>
                    </a></li>
                <li class=""><a href="add.php">
                        <span class="fas fa-calendar-plus" style="font-size: 32px; color: #333;">
                        </span>
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">
                            Add Todo
                        </label>
                    </a></li>
                <li>
                    <a style="display: flex; align-items: center;" href="weather.php">
                        <span class="fas fa-cloud-rain" style="font-size: 32px;  color: #333;">
                        </span style="font-size: 40px;">
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">Weather Update</label>
                    </a>
                </li>
            </ul>
            <div class="out">
                <a style="display: flex; align-items: center;" href="./inc/logout.php"> <span class="fas fa-sign-out-alt" style="font-size: 32px;  color: #333;"></span>
                    <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold; margin: 5px;">
                        Logout
                    </label>
                </a>
            </div>
        </div>
        <div class="main index">
            <h2>Add New Todo</h2>
            <div class="">
                <?php 
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyfields"){
                            echo '<div class="alert-danger">Fill in all fields!</div>';
                        }
                        else if($_GET['error'] == "sqlerror" || $_GET['error'] == "submit"){
                            echo '<div class="alert-danger">Something went wrong!</div>';
                        }
                    }
                    if(isset($_GET['added'])){
                        if($_GET['added'] == "success"){
                            echo '<div class="alert-success">Todo added!</div>';
                        }
                    }
                ?>
            </div>
            <div class="add">
                <form action="./inc/add-todo.php" method="post" class="form">
                    <div class="">
                        <label for="title">Title</label>
                        <input id="title" type="text" placeholder="Title of Todo" name="title" class="form-control"
                            require>
                    </div>
                    <div class="">
                        <label for="date">Date</label>
                        <input id="date" type="date" placeholder="date of Todo" name="date" class="form-control"
                            require>
                    </div>
                    <div class="">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="desc" cols="30" rows="10"></textarea>
                    </div>
                    <input class="submit" type="submit" name="submit">
                </form>
            </div>
        </div>
    </div>
    </div>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="./js/app.js"></script>
</body>

</html>