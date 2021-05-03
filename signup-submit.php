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
               <legend>Welcome <?=signup()?>!</legend>
               <br>
               <label>Start preping for your next trip today!</label>
               <br>
               <br>
               <button name="logintype" class ='button' type="submit" value="login1">Go to Login</button>
            </fieldset>
        </form>
      </div>	
	</body>

   <?php 
   function signup(){
      $error = false;
		$req = array('user','pw');
      $errtype = "empty field";
      setcookie('backpage', "signup.php", time() + (86400 * 30), "/");
		foreach($req as $field){
		   if(!$error && !isset($_POST[$field])){ $error = true;}
            elseif (empty($_POST[$field])) {$error = true;}
	   }

      if(!$error){
		   if (strlen($_POST['user'])<5 || strlen($_POST['user'])>12) {
                $error = true;
                $errtype = 'invalid user';
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

      // $cursor = $collection->find(['user' => $_POST['user'], 'password' => $_POST['pw']]);
      $cursor = $collection->findOne(['username' => $_POST['user']]);

      if($cursor != null){
         $errtype = 'account exist';
         setcookie('prev', $errtype, time() + (86400 * 30), "/");
         header("Location: error.php");
         exit();
      }

      $result = $collection->insertOne( [ 'createdAt' => date("Y-m-d H:i:s"), 'username' => $_POST['user'], 'password' => $_POST['pw'], 'fname' => $_POST['fname'], 'lname' => $_POST['lname'] ] );
      setcookie('user',$_POST['user'],time() + (86400 * 30), "/"); 
      return $_POST['fname'];
   }
   ?>
</html>