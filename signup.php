<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Sign up</title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div class="header">
			<h1>Booking Flights and Parking Services</h1>
		</div>
     	<div id = 'box'>
			<form action="signup-submit.php" method="post" enctype="multipart/form-data">
				<fieldset>
				<legend>New User Signup:</legend>
				<div id = 'line'>
					<strong> <label for="name">UserName <br>(letters & number): </label></strong>
			 		<input type="text" id="name" name="name" size="12" placeholder="5-12 characters" required>
				</div><br>
				<div id = 'line'>
            		<strong>
            		<label for="pw">Password <br>(letters & number):</label></strong>
					<input type="text" id="pw" name="pw" maxlength="12" size="12" placeholder="5-12 characters" required>
	    		</div><br>
	    		<input type="submit" value="Sign Up"/>
	    		</fieldset>
			</form>
		</div>
	</body>
</html>