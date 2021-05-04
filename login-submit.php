<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Login Successful</title>
		<link href="test.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
    <div class="header">
			<h1>Booking Flights and Parking Services</h1>
		</div>
	  <div id = 'box'>
      <form action="test.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <legend>Welcome!</legend>
            <br>
            <p>
              Happy Booking!
            </p>
            <br>
            <input type="submit" value="Go Back to Parking"/>
        </fieldset>
      </form>
    </div>	
    <?=directl();?>
	</body>


	<?php
  function directl(){
    if(!isset($_COOKIE['user'])){
      return login();}
    elseif(empty($_COOKIE['user'])){
      return login();}
    else{ return;}
  }

	function login(){
    $error = false;
		$req = array('user','pw');
    $errtype = 'empty field';
    setcookie('backpage', "login.php", time() + (86400 * 30), "/");

		foreach($req as $field1){
		  if(!$error && !isset($_POST[$field1])){ $error = true;}
        elseif (empty($_POST[$field1])) {$error = true;}
	  }

    if(!$error){
		  if (strlen($_POST['user'])<5 || strlen($_POST['user'])>12) {
        $error = true;
        $errtype = 'invalid name';
      }
    }

    if(!$error){   
      if (strlen($_POST['pw'])<5 || strlen($_POST['pw'])>12) {
        $error = true;
        $errtype = 'invalid password';
      }
    }

    if($error){
      setcookie('prev', $errtype, time() + (86400 * 30), "/");
      header("Location: error.php");
      exit();
    }

    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb+srv://proj4user:NH0QH1bumcajxjHp@cluster0.vfbdf.mongodb.net/Project4?retryWrites=true&w=majority");
    $collection = $client->Project4->users;

    try {
      $finduser = false;
      $passwordmatch = false;
      $cursor = $collection->findOne(['username' => $_POST['user']]);
      if($cursor != null){ 
            $finduser = true;
            $cursor = $collection->findOne(['password' => $_POST['pw']]);
            if($cursor != null){
              $passwordmatch = true;
              setcookie('user',  $_POST['user'], time() + (86400 * 30), "/");
            }
          } 
    }
    catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    if(!$finduser){
      $errtype = 'account not found';
      setcookie('prev', $errtype, time() + (86400 * 30), "/");
      header("Location: error.php");
      exit();
    }

    if(!$passwordmatch){
      $errtype = 'incorrect password';
      setcookie('prev', $errtype, time() + (86400 * 30), "/");
      header("Location: error.php");
      exit();
    }
    return;
  }
	?>
</html>
