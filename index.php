<?php

$address = "";
$error = "";
if ($_GET['address']){

    $address = urlencode($_GET['address']);
    $urlContents = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyAtMGnaWjHgywpksP9Mgvp0UGBSr6ESQdg");

    $addressArray = json_decode($urlContents,true);
    foreach ($addressArray['results'][0]['address_components'] as $adresses => $values){
        if ($values['types'][0] == 'postal_code'){
            $address = "The postal code is ".$values['long_name'];
        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Scrapper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style type="text/css">
        html { 
            background: url(img/background.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        body {
            background:none;
        }

        .container {
          text-align: center;
          margin-top:100px;
          width: 500px;
        }
        input {
          margin:20px;
        }

        #address{
          margin-top: 15px;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>What's The Postal Code</h1>
        
        
        <form>
          <div class="form-group">
            <label for="city">Enter your address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Eg. Joseph-Kindshoven">
           </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div id="address">
          <?php
            if($address){
              echo '<div class="alert alert-success" role="alert">
              '. $address.
            '</div>';
            } else {
              echo '<div class="alert alert-danger" role="alert">
              '.$error.
              '</div>';
            }
          ?>
        </div>
  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>