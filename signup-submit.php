<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Sign up success</title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
      <div class="header">
         <h1>Booking Flights and Parking Services</h1>
		</div>
	   <div id = 'box'>
        <form action="login.php" method="post" enctype="multipart/form-data">
            <fieldset>
               <legend>Welcome!</legend>
               <label>Your Username: <?=signup()?></label>
               <br>
               <label>Your Password: <?=$_POST['pw']?></label>
               <br>
               <button name="logintype" class ='button' type="submit" value="login1">Go to Login</button>
            </fieldset>
        </form>
      </div>	
	</body>

	<?php function 
   signup(){
      $error = false;
		$req = array('name','pw');
      $errtype = "empty field";
      setcookie('backpage', "signup.php", time() + (86400 * 30), "/");
		foreach($req as $field){
		   if(!$error && !isset($_POST[$field])){ $error = true;}
            elseif (empty($_POST[$field])) {$error = true;}
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
       
      $single = fopen('users.txt','a');
      $originstring = file_get_contents('users.txt');
      $data = explode("\n",$originstring);
      $newuser = $_POST['name'].",".$_POST['pw'].",1\n";

      try {
         foreach($data as $field){
            $ppl = explode(',',$field);
            $errtype = 'account exist';
            if($ppl[0] == $_POST['name']){ 
               setcookie('prev', $errtype, time() + (86400 * 30), "/");
               header("Location: error.php");
               exit();
            }
         }
      } catch (Exception $e) {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
      }

      fwrite($single,$newuser);
      fclose($single);
      setcookie('name',$_POST['name'],time() + (86400 * 30), "/"); 
      return $_POST['name'];
   }
   ?>
</html>