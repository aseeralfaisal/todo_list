<!DOCTYPE>
<html>

<head>
    <title>Get Visitor's Current Location</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <style type="text/css">
        #container {
            color: #116997;
            border: 2px solid #0b557b00;
            border-radius: 5px;
        }

        p {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <script type="text/javascript">
        function getlocation() {
            if (navigator.geolocation) {
                if (document.getElementById('location').innerHTML == '') {
                    navigator.geolocation.getCurrentPosition(visitorLocation);
                }
            } else {
                $('#location').html('This browser does not support Geolocation Service.');
            }
        }

        function visitorLocation(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            console.log({
                lat,
                long
            })
            $.ajax({
                type: 'POST',
                url: 'get_location.php',
                data: 'latitude=' + lat + '&longitude=' + long,
                success: function(address) {
                    if (address) {
                        $("#location").html(address);
                    } else {
                        $("#location").html('Not Available');
                    }
                }
            });
        }
    </script>
    <input type="button" onclick="return getlocation()" value="Get Current Location" />
    <div id="container">
        <p>Your Current Location: <span id="location"></span></p>
    </div>
</body>

</html>