<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "todos");
$username = $_SESSION['username'];

if (!$username) {
    header("Location: ./login.php");
}

if (mysqli_connect_error()) {
    die($conn->connect_error);
} else {
    $results = mysqli_query($conn, "SELECT * FROM `todos`  WHERE `user` = " . $_SESSION['userid'] . " ORDER BY id DESC");
}

// print_r(getdate());
// print_r(getdate()['year']);
// print_r(getdate()['mon']);
// print_r(getdate()['mday']);

$date = date('Y-m-d');
$str =  substr($date, 8);
$currentDate = (int)$str;


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
                <!-- <li>
                    <a style="display: flex; align-items: center;" href="location2.php">
                        <span class="fas fa-street-view" style="font-size: 32px;  color: #333;">
                        </span style="font-size: 40px;">
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">Location</label>
                    </a>
                </li> -->
            </ul>
            <div class="out">
                <a style="display: flex; align-items: center;" href="./inc/logout.php"> <span class="fas fa-sign-out-alt" style="font-size: 32px;  color: #333;"></span>
                    <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold; margin: 5px;">
                        Logout
                    </label>
                </a>
            </div>
        </div>
        <div class="main index" style="margin-top: 40px;">
            <!-- <h2>Todo List</h2> -->
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "sqlerror" || $_GET['error'] == "submit") {
                    echo '<div class="alert-danger">Something went wrong!</div>';
                }
            }
            if (isset($_GET['deleted'])) {
                if ($_GET['deleted'] == "success") {
                    echo '<div class="alert-success">Todo deleted!</div>';
                }
            }
            if (isset($_GET['done'])) {
                if ($_GET['done'] == "success") {
                    echo '<div class="alert-success">Todo compeleted!</div>';
                }
            }
            ?>
            <div class="container">
                <div class="todos">
                    <div class="title" style="font-family: 'Comfortaa'; font-weight: bold;">
                        <i class="fas fa-list" style="font-size: 22px; color: lightgreen;"></i>
                        Todos
                    </div>
                    <div class="dashboard">
                        <?php
                        foreach ($results as $result) {
                            $todoDateStr = substr($result['date'], 8);
                            $todoDate = (int)$todoDateStr;
                            if ($result['done'] == 0) {
                                if ($todoDate > $currentDate) {

                        ?>
                                    <div class="card">
                                        <h3 style="font-family: 'Comfortaa'; font-weight: bold; text-transform: capitalize;"><?php echo $result['title'] ?></h3>
                                        <p style="font-family: 'Comfortaa'; font-weight: bold;"><?php echo $result['description'] ?></p>
                                        <div class="date">
                                            <span class="fas fa-calendar-alt"></span> <?php
                                                                                        echo '
                                                                                        <label style="font-family: Comfortaa; font-weight: bold;">' . $result['date'] . '</label>
                                                                                        ';
                                                                                        ?>
                                        </div>
                                        <div class="border-top">
                                            <a href="./inc/delete.php?id=<?php echo $result['id'] ?>" class="trash"><span class="far fa-trash-alt"></span>
                                                <label style="color: red; font-family: Comfortaa; font-weight: bold; margin: 0 1px;">
                                                    Delete
                                                </label>
                                            </a>
                                            <a style="cursor: pointer;" href="./inc/done.php?id=<?php echo $result['id'] ?>" class="done"><i class="far fa-circle"></i>
                                                <label style="font-family: Comfortaa; font-weight: bold; margin: 0 1px; cursor: pointer;">
                                                    To-do
                                                </label>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="card">
                                        <h3 style="font-family: 'Comfortaa'; font-weight: bold; text-transform: capitalize"><?php echo $result['title'] ?></h3>
                                        <p style="font-family: 'Comfortaa'; font-weight: bold;"><?php echo $result['description'] ?></p>
                                        <div class="date">
                                            <span class="fas fa-calendar-alt"></span>
                                            <?php
                                            echo '
                                        <label style="color: red; font-family: Comfortaa; font-weight: bold;">' . $result['date'] . '</label>
                                        ';
                                            ?>

                                        </div>
                                        <div class="border-top">
                                            <a href="./inc/delete.php?id=<?php echo $result['id'] ?>" class="trash"><span class="far fa-trash-alt"></span>
                                                <label style="color: red; font-family: Comfortaa; font-weight: bold; margin: 0 1px; cursor: pointer;">
                                                    Delete
                                                </label>
                                            </a>
                                            <a href="./inc/done.php?id=<?php echo $result['id'] ?>" class="done"><i class="far fa-circle"></i>
                                                <label style="font-family: Comfortaa; font-weight: bold; margin: 0 1px;">
                                                    To-do
                                                </label>
                                            </a>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
                <div class="compeleted">
                    <div class="title" style="font-family: 'Comfortaa'; font-weight: bold;">
                    <i class="fas fa-check-double" style="font-size: 22px; color: lightblue;"></i>
                        Competed
                    </div>
                    <div class="dashboard-done">

                        <?php
                        foreach ($results as $result) {
                            if ($result['done'] == 1) {
                        ?>

                                <div class="card">
                                    <h3 style="font-family: 'Comfortaa'; font-weight: bold; text-transform: capitalize"><?php echo $result['title'] ?></h3>
                                    <p style="font-family: 'Comfortaa'; font-weight: bold;"><?php echo $result['description'] ?></p>
                                    <div class="date">
                                        <span class="fas fa-calendar-alt"></span> <?php echo $result['date'] ?>
                                    </div>
                                    <div class="border-top">
                                        <a href="./inc/delete.php?id=<?php echo $result['id'] ?>" class="trash"><span class="far fa-trash-alt"></span>
                                            <label style="color: red; font-family: Comfortaa; font-weight: bold; margin: 0 1px; cursor: pointer;">
                                                Delete
                                            </label>
                                        </a>
                                        <a href="./inc/done.php?id=<?php echo $result['id'] ?>" class="done"><i class="fas fa-check-circle"></i>
                                            <label style="font-family: Comfortaa; font-weight: bold; margin: 0 1px;">
                                                Done
                                            </label>
                                        </a>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="./js/app.js"></script>
</body>

</html>