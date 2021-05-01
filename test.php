<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conway's Game of Life</title>
    <link rel="stylesheet" type="text/css" href="test.css" />
  </head>
  <body>
    <?php $ret = loginstate();?>
    <div class="header">
      <h1>Conway's Game of Life - Game</h1>
      <h3>Web Programing - Project 3</h3>
    </div>

    <div class="websitelinks">
      <a href="<?=$ret[3]?>"><?=$ret[1]?></a>
			<a href="<?=$ret[2]?>" style="<?=$ret[4] ?>"><?=$ret[0]?></a>
    </div>

    <div id="game"></div>

    <div class="footer">
      <h2>Play Controls</h2>
      <p>
        <select name="pattern" id="pattern" onchange="showPattern(this.value)">
          <option value="default">Default</option>
          <option value="block">Block</option>
          <option value="blinker">Blinker</option>
          <option value="beacon">Beacon</option>
          <option value="glider">Glider</option>
          <option value="random">Random</option>
        </select>
        <br />
        <button onclick="startGame()" id="start">START</button><br />
        <button onclick="stopGame()" id="stop">STOP</button><br />
        <button id="next">INCREMENT 1 GENERATION</button><br />
        <button id="nextall">INCREMENT 23 GENERATIONS</button><br />
        <button onclick="resetGame()" id="reset">RESET GAME</button><br />
      </p>
    </div>
  </body>
  <?php
    function loginstate(){
    $logins = false;
	$user = $_COOKIE['user'];
    if(isset($_COOKIE['user']))
      if(!empty($_COOKIE['user']))
        $logins = true;
		$user = $_COOKIE['user'];
     if(!$logins){
           $array = array("Sign Up", "Login","signup.php","login.php","");
     }else{
           $array = array("", "Log out", "", "logout.php","display: none;");
     } 
     return $array;
    }
	?>
</html>
<script src="test.js"></script>
