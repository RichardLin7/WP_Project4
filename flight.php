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
  <?php 
  $ret = loginstate();
  ?>
    <div class="header">
      <h1>Book Flight Selection</h1>
      <h3>Web Programing - Project 4</h3>
    </div>
    <div class="websitelinks">
      <a href="<?=$ret[6]?>"><?=$ret[5]?></a>
			<a href="<?=$ret[3]?>"><?=$ret[1]?></a>
			<a href="<?=$ret[2]?>" style="<?=$ret[4] ?>"><?=$ret[0]?></a>
		</div>

    <div id="game"></div>
    <div class="footer">
	<p> 
	Interesting.
	<br>
	<form action="creditCard.php" method="post">
	  <input type="hidden" id="flightId" name="flightId" value="">
	<input type="submit" onvalue="Next"/>
        
	<br>
	<br>
	</p>
    </div>
  </body>
<?php 
  function loginstate(){
    $flight = true;
    $logins = false;
    if(isset($_COOKIE['user']))
      if(!empty($_COOKIE['user']))
        $logins = true;
      if(!$logins){
            if($flight == false){
                $array = array("Sign Up", "Login","signup.php","login.php","","Book Flight", "flight.php");
            }else{
                $array = array("Sign Up", "Login","signup.php","login.php","","Reserve Parking","test.php");
            }
      }else{
            if($flight == false){
                $array = array("", "Log out", "", "logout.php","display: none;","Book Flight", "flight.php");
            }else{
                $array = array("", "Log out", "", "logout.php","display: none;","Reserve Parking","test.php");
        }
     } 
     return $array;
  }
?>

<script type="text/javascript">
let cells;
let newCells;
let start = false;
let intervalId;
let numRows = 4;
let numCols = 10;
let oldselected;
let selected;
let takenSpots= [];

 window.onload = async () => {


  await getSpaces();
  setStartingGrid();
};

function getSpaces(){
const Http = new XMLHttpRequest();
  const url = "https://project4node.herokuapp.com/bookings";
  Http.open("GET", url, false);

  Http.onload = () => {
    const data = JSON.parse(Http.response);
    takenSpots = data.taken;
    discookie =JSON.stringify(takenSpots);
    document.cookie = "parkingarray="+discookie+"; expires=Thu, 18 Dec 2022 12:00:00 UTC"
	  console.log(takenSpots);
  };

  Http.send();
}


function setStartingGrid() {
console.log(takenSpots + "yo");
  let gameDiv = document.getElementById("game");
  for (let i = 0; i < numRows; i++) {
    let row = document.createElement("div");
    row.classList.add("row");
    for (let j = 0; j < numCols; j++) {
      let num = i * numCols + j;
      let button = document.createElement("button");
      button.classList.add("testButton");
      button.setAttribute("id", num);
      row.appendChild(button);
      button.setAttribute("onclick", "gridClicked(this.id)");

	if(takenSpots.includes(num)){
	button.style.backgroundColor = "black";
	}
	else{
      button.style.backgroundColor = "white";
	}
      button.innerHTML = num;
    }
    gameDiv.appendChild(row);
  }
}

function gridClicked(clickedId) {
  let button = document.getElementById(clickedId);
if(button.style.backgroundColor != "black"){
document.getElementById("flightId").value = clickedId;
  let x = Math.floor(clickedId / numRows);
  let y = clickedId % numCols;
oldselected = selected;
selected = clickedId;


button.style.backgroundColor = "blue";
if(oldselected != 'undefined'){
let oldButton = document.getElementById(oldselected);
oldButton.style.backgroundColor = "white";
}


//if(button.style.backgroundColor != "white"){
  //button.style.backgroundColor = "white";
//}
//else{
//button.style.backgroundColor = "blue";
//}
}
}
</script>

</html>
