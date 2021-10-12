<?php 
error_reporting(E_ERROR | E_PARSE);
$city = $_POST['city'];
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q='. $city . '&appid=1efa77b2b4e08a6805ed594b7bd635ce';
$query = @unserialize(file_get_contents('http://ip-api.com/php/'));
$my_city = $query['city'];
$my_city_api_url = 'https://api.openweathermap.org/data/2.5/weather?q='. $my_city . '&appid=1efa77b2b4e08a6805ed594b7bd635ce';
$location_name = explode('","cod":' , explode('"name":"', file_get_contents($api_url))[1])[0];
$description = explode('","icon' , explode(',"description":"', file_get_contents($api_url))[1])[0];
$temp = explode(',"' , explode('"temp":', file_get_contents($api_url))[1])[0] - 273.15;
$temp_min = explode(',"' , explode('"temp_min":', file_get_contents($api_url))[1])[0] - 273.15;
$temp_max = explode(',"' , explode('"temp_max":', file_get_contents($api_url))[1])[0] - 273.15;
$feels_like =  explode(',"' , explode('feels_like":', file_get_contents($api_url))[1])[0] - 273.15;
$pressure = explode(',"' , explode('pressure":', file_get_contents($api_url))[1])[0];
$humidity = explode(',' , explode('humidity":', file_get_contents($api_url))[1])[0];
$humidity = trim($humidity, '}');
$wind = explode(',"' , explode('"wind":{"speed":', file_get_contents($api_url))[1])[0];
?>
<?php if (file_get_contents($api_url)) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Weather Condition</title>
<link rel="shortcut icon" href="https://i.ibb.co/n3KHrKk/770b805d5c99c7931366c2e84e88f251-1.png">
<link rel="icon" type="image/png" href="https://i.ibb.co/n3KHrKk/770b805d5c99c7931366c2e84e88f251-1.png" sizes="192x192">
<link rel="apple-touch-icon" href="https://i.ibb.co/n3KHrKk/770b805d5c99c7931366c2e84e88f251-1.png" sizes="180x180">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css" />
<link rel="stylesheet" href="/style.css">

</head>
<body >
<div class="container" >
            <div class="row" >
                <div  class="col-md-6 mx-auto text-center bg-primary mt-5 p-5 rounded" style="background: #78c2ad;">
                    <h3 id="w-location">What's the weather like today in <br> <?php echo $location_name; ?> ?</h3>
                    <br>
                    <h3 id="w-string-currentDate"></h3>
                    <h3 id="w-desc" class="text-white"><?php echo $description; ?></h3>
                    <br>
                    <h3 id="w-string-temp">

<?php
if (strlen($temp) == 5) {
  echo substr($temp, 0, -1);
} else {echo $temp;} echo '°C'
?>

</h3>
<br>
<h4 id="w-string-day-night">Day: <?php
if (strlen($temp_max) == 5) {
  echo substr($temp_max, 0, -1);
} else {echo $temp_max;}
?>°C | Night: <?php  
if (strlen($temp_min) == 5) {
  echo substr($temp_min, 0, -1);
} else {echo $temp_min;}
?>°C</h4>
<ul id="w-details" class="list-group mt-3">
<li class="list-group-item" id="w-feels-like">Feels like: 
<?php if (strlen($feels_like) == 5) {
echo substr($feels_like, 0, -1);
} else {echo $feels_like;} ?>°C</li>
    <li class="list-group-item" id="w-pressure">Pressure: <?php echo $pressure; ?>hPa</li>
                        <li class="list-group-item" id="w-humidity">Humidity: <?php echo $humidity ?>%</li>
                        <li class="list-group-item" id="w-wind">Wind: <?php echo $wind ?>km/h</li>
                    </ul>
                    <hr>
                    <button type="button" id="change" class="btn btn-primary"data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Location</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="change_location.php">
          <div class="form-group">
            <input type="text" autocomplete="off" spellcheck="false"  name="city" class="form-control" id="recipient-name" placeholder="Enter City Name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save Changes">
        </form>
      </div>
    </div>
  </div>
</div>
<br> 
<p style="font-size: 14px; color: white; ">Sherif Abdullah Mahmoud © 2021 sherif.rf.gd</p>

</div>
</div>
</div>
<script>
console.log('Sherif Abdullah Mahmoud © 2021 sherif.rf.gd')
</script>
</body>
</html>
<?php  } else { ?>
<!-- ERORR 404 -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Weather Condition</title>
<link rel="shortcut icon" href="https://i.ibb.co/n3KHrKk/770b805d5c99c7931366c2e84e88f251-1.png">
<link rel="icon" type="image/png" href="https://i.ibb.co/n3KHrKk/770b805d5c99c7931366c2e84e88f251-1.png" sizes="192x192">
<link rel="apple-touch-icon" href="https://i.ibb.co/n3KHrKk/770b805d5c99c7931366c2e84e88f251-1.png" sizes="180x180">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css" />
<link rel="stylesheet" href="/style.css">
<style>
    body{
        background-color: #78c2ad;
    }

</style>
</head>
<body style="background-color: #78c2ad;" bgcolor="#78c2ad">
<center>
<div class="modal-content" style="width: 100%;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Erorr!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="change_location.php" abineguid="C1C03CAAA0FD42AC8BD19A9069C33874">
          <div class="form-group">
            <input type="text" name="city" autocomplete="off" spellcheck="false" class="form-control" id="recipient-name" placeholder="Please write a valid city name">
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Change">
        </form>
      </div>
    </div>
</center>
<script>
console.log('Sherif Abdullah Mahmoud © 2021 sherif.rf.gd')
</script>
</body>
</html>
<?php } ?>