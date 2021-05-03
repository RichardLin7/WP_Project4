<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vehicle Spot Selection</title>
    <link rel="stylesheet" type="text/css" href="test.css" />
  </head>
  <body>
  <?php $ret = loginstate();?>
    <div class="header">
      <h1>Booking Flights and Parking Services</h1>
      <h3>Web Programing - Project 4</h3>
    </div>
    <div class="websitelinks">
		<a href="<?=$ret[3]?>"><?=$ret[1]?></a>
		<a href="<?=$ret[2]?>" style="<?=$ret[4] ?>"><?=$ret[0]?></a>
	</div>
    <div id = 'box'>
        <form action="test.php" method="post" enctype="multipart/form-data">
            <fieldset>
               <legend>Your Order has been placed! <?=checkout()?>!</legend>
               <br>
               <label>We look forward to seeing you!</label>
               <br>
               <br>
               <button name="logintype" class ='button' type="submit" value="login1">Back to Hompage</button>
            </fieldset>
        </form>
      </div>	
  </body>
<?php 
  function loginstate(){
    $logins = false;
    if(isset($_COOKIE['user']))
      if(!empty($_COOKIE['user']))
        $logins = true;
      if(!$logins){
           $array = array("Sign Up", "Login","signup.php","login.php","");
      }else{
           $array = array("", "Log out", "", "logout.php","display: none;");
     } 
     return $array;
  }
  
  function checkout(){
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb+srv://proj4user:NH0QH1bumcajxjHp@cluster0.vfbdf.mongodb.net/Project4?retryWrites=true&w=majority");
    $collection = $client->Project4->users;   

    if(isset($_Cookie['parking'])){
        $updateResult = $collection->updateOne(
            [ 'username' => $_COOKIE['user']],
            [ '$set' => [ 'creditcard' => $_POST['card_num'], 'booked_parking_space' => $_COOKIE['parking']]]
        ); 
        setcookie("parking", "", time() - 3600,'/');
    }

    // if(isset($_POST['flight']) && $_POST['flight'] != ""){
    //     $updateResult = $collection->updateOne(
    //         [ 'username' => $_COOKIE['user']],
    //         [ '$set' => [ 'creditcard' => $_POST['card_num'], 'booked_flight' => $_POST['flight']]]
    //     ); 
    // }
    return;
  }
?>
</html>
