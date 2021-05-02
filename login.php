<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Login</title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div class="header">
			<h1>Booking Flights and Parking Services</h1>
		</div>
     	<div id = 'box'>
			<form action="login-submit.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Login:</legend>
					<div id = 'line'>
						<strong> <label for="name">UserName: </label> </strong>
			 			<input type="text" id="name" name="name" size="12" required>
					</div><br><br>
					<div id = 'line'>
             			<strong> <label for="pw">Password: </label> </strong>
			 			<input type="text" id="pw" name="pw" maxlength="12" size="12" required>
	          		</div><br><br>
	    			<input type="submit" value="Login"/>
				</fieldset>
			</form>
		</div>
	</body>
</html>