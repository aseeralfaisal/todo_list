<?php
session_start();
$conn = mysqli_connect("localhost", "root", "2021->2022", "todos");
$username = $_SESSION['username'];

if (!$username) {
    header("Location: ./login.php");
}

if (mysqli_connect_error()) {
    die($conn->connect_error);
} else {
    $results = mysqli_query($conn, "SELECT * FROM `todos`  WHERE `user` = " . $_SESSION['userid'] . " ORDER BY id DESC");
}

$json = file_get_contents('timezones.json');
$json_data = json_decode($json, true);

$timezone = new DateTime("now", new DateTimeZone('America/los_angeles'));
$date = $timezone->format('Y-m-d');
$str =  substr($date, 8);
$currentDate = (int)$str;
$ip_address = file_get_contents('http://checkip.dyndns.com/');
$PublicIP = str_replace("Current IP Address: ", "", $ip_address);
$json = file_get_contents("http://ip-api.com/json");
$jsonResult = json_decode($json, true);

if (isset($_POST['submit'])) {
    $cookie_name = "zone";
    $cookie_value = $_POST['timezone'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    header("Location: index.php");
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
                <i id="icon" class="far fa-calendar-check fa-gradient" style="font-size: 28px; margin: 6px; color: #333;"></i>
                <label class="logo" style="margin-top: 7px; color: #333; font-family: 'Comfortaa'; font-size: 20px; font-weight: bold;">
                    ToDo List</label>
                <div class="close">
                    <span class="fas fa-bars" style="color: #333;"></span>
                </div>
                <div class="user" style="margin-left: 20px; margin-bottom: 8px;">
                    <span class="fas fa-user-circle fa-gradient" style="color: #333; font-size: 28px;"></span>
                    <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold; text-transform: uppercase;">
                        <?php echo '<lebel>' . $username . '</label>' ?></label>
                </div>
            </div>
            <ul style="margin-top: -220px;">
                <li class="active"><a href="index.php">
                        <span style="font-size: 32px; color: #333;" class="fas fa-check-circle fa-gradient"></span>
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">
                            Dashboard
                        </label>
                    </a></li>
                <li class=""><a href="add.php">
                        <span class="fas fa-calendar-plus fa-gradient" style="font-size: 32px; color: #333;">
                        </span>
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">
                            Add Todo
                        </label>
                    </a></li>
                <li>
                    <a style="display: flex; align-items: center;" href="weather.php">
                        <span class="fas fa-cloud-rain fa-gradient" style="font-size: 32px;  color: #333;">
                        </span style="font-size: 40px;">
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">Weather Update</label>
                    </a>
                </li>
                <li>
                    <a style="display: flex; align-items: center;" href="loc.php">
                        <span class="fas fa-cogs fa-gradient" style="font-size: 32px;  color: #333;">
                        </span style="font-size: 40px;">
                        <label style="font-family: 'Comfortaa'; font-size: 16px; font-weight: bold;">Settings</label>
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
        <div class="main index" style="margin-top: 40px;">

            <div style="margin-left: 70px;" style="background: #d0e0e6; padding: 20px;">
                <form action="loc.php" method="POST">
                    <select name="timezone" id="timezone" style="padding: 7px 20px; font-size: 16px;">
                        <option value=<?php echo $_COOKIE['zone']; ?>><?php echo $_COOKIE['zone']; ?></option>
                        <option value="Asia/Dhaka">Asia/Dhaka</option>
                        <option value="America/New_York">America/New_York</option>
                        <option value="America/New_York">Asia/Kolkata</option>
                        <option value="America/New_York">Europe/London</option>
                        <input id="btn" type="submit" value="Save" name="submit" style="background: #444; border: none; color: #fff; padding: 10px 20px;">

                    </select><br>
                </form>
                <div style="margin-top: 20px; margin-left: 5px;">
                    <?php
                    foreach ($jsonResult as $key => $value) {
                        echo '<label style="text-transform: capitalize; font-size: 20px; color: #333; font-weight: bold">' . $key . ':</label> 
                    <label style="text-transform: capitalize; font-size: 20px; margin-left: 6px; color: #333">' . $value . '</label>
                    <br>';
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