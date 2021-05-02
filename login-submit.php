<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Login Successful</title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
    <div class="header">
			<h1>Booking Flights and Parking Services</h1>
		</div>
	  <div id = 'box'>
      <form action="test.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <legend>Welcome!</legend>
            <label><?=directl();?></label>
            <br>
            <p>
              Happy Booking!
            </p>
            <br>
            <input type="submit" value="Go Back to Main Page"/>
        </fieldset>
      </form>
    </div>	
	</body>


	<?php
  function directl(){
    if(!isset($_COOKIE['user'])){
      return login();}
    elseif(empty($_COOKIE['user'])){
      return login();}
    else{ return $_COOKIE['user'];}
  }

	function login(){
    $error = false;
		$req = array('name','pw');
    $errtype = 'empty field';
    setcookie('backpage', "login.php", time() + (86400 * 30), "/");

		foreach($req as $field1){
		  if(!$error && !isset($_POST[$field1])){ $error = true;}
        elseif (empty($_POST[$field1])) {$error = true;}
	  }

    if(!$error){
		  if (strlen($_POST['name'])<5 || strlen($_POST['name'])>12) {
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

    $originstring = file_get_contents('users.txt');
    $data = explode("\n",$originstring);

    $newuser = $_POST['name'].",".$_POST['pw']."\n";

    try {
      $finduser = false;
      $passwordmatch = false;
      foreach($data as $field){
        if(!empty($field)){
          $ppl = explode(',',$field);
          if($ppl[0] == $_POST['name']){ 
            $finduser = true;
            if($ppl[1] == $_POST['pw']){
              $passwordmatch = true;
              setcookie('user',  $_POST['name'], time() + (86400 * 30), "/");
            }
          } 
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
    return $_POST['name'];
    // return;
  }
	?>
</html>
