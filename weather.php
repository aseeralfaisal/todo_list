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
        <div class="main index">
            <h2>Weather Update</h2>
            <div class="container">
                <div class="todos">
                    <div class="dashboard-weather">
                        <div class="weather">
                            <?php
                            $url = "http://api.openweathermap.org/data/2.5/weather?id=1185241&appid=2fb31acb3d77dcef59ad783fdef147a3";
                            $json = file_get_contents($url);
                            $weather = json_decode($json, true);
                            // print_r($weather);
                            $temp = $weather['main']['temp'];
                            $feel = $weather['main']['feels_like'];
                            $tMin = $weather['main']['temp_min'];
                            $tMax = $weather['main']['temp_max'];
                            $hum = $weather['main']['humidity'];
                            $temp = $temp - 273.15;
                            $temp = round($temp, 2);
                            $temp = $temp . "°C";
                            $weatherTxt = $weather['weather'][0]['main'];
                            $icon = $weather['weather'][0]['icon'];
                            ?>
                            <img src="http://openweathermap.org/img/wn/<?php echo $icon ?>@4x.png" class="weather-img" alt="">
                            <h3>Dhaka</h3>
                            <br>
                            <p>Temperature: <?php echo $temp; ?></p>
                            <p>Temperature Feels Like: <?php echo round($feel - 273.15, 2); ?> °C</p>
                            <p>Temperature Maximum: <?php echo round($tMax - 273.15, 2); ?> °C</p>
                            <p>Temperature Minimum: <?php echo round($tMin - 273.15, 2); ?> °C</p>
                            <br>
                            <p>Weather: <?php echo $weatherTxt; ?></p>
                            <p>Humidity: <?php echo $hum; ?>%</p>
                            <br>
                        </div>

                    </div>
                </div>
                <!-- <div class="todos">
                    <img src="http://openweathermap.org/img/wn/<?php echo $icon ?>@4x.png" class="weather-img" alt="">
                </div> -->

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="./js/app.js"></script>
</body>

</html>