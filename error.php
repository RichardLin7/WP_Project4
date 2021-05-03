<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Error</title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div class="header">
			<h1>Booking Flights and Parking Services</h1>
		</div>
    	<div id = 'box'>
    		<fieldset>
        		<legend>Error: <?=$_COOKIE['prev'];?> </legend>
        		<form action= '<?=$_COOKIE['backpage']?>' method="post" enctype="multipart/form-data">
        		<div id = 'line'><label><?=errors();?></label><br><br>
        		<input type="submit" value="Back"/>
			</fieldset>	
		</div>
	</body>

	<?php
	function errors() {
	$prev = $_COOKIE['prev'];
  	switch($prev){
    	case "empty field":
       		return "At least one field is empty";
	    	break;
		case "invalid name":
	   		return "Username is invalid, it must be a 5~12 long and only contains numbers and letters";
	    	break;
		case "invalid password":
	    	return "Password is invalid, it must be a 5~12 long and only contains numbers and letters";
	    	break;
		case "account exist":
	    	return "The username is already in use";
	    	break;
		case "account not found":
		    return "The username is not in our database";
		    break;
		case "incorrect password":
		    return "The password does not match your username";
		    break;
		case "not login":
		    return "Please login before play the game";
		    break;
 	   default:
			return "Undefined error";
       }
	setcookie("prev", "", time() - 3600,'/');
	}
	?>
</html>