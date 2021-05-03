<!DOCTYPE html>
<html lang="en">
	<head><meta charset="UTF-8">
		<title>Logout</title>
		<link href="test.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
        <div class="header">
            <h1>Booking Flights and Parking Services</h1>
		</div>
        <div id = 'box'>
        <fieldset>
            <legend>You have been <?=logout();?></legend>
            <form action= 'test.php' method="post" enctype="multipart/form-data">
            <input type="submit" value="Back"/>
	    </fieldset>	
        </div>
	</body>

    <?php function logout() {
        setcookie("user", "", time() - 3600,'/');
        return "logged out.";
        }
    ?>
</html>