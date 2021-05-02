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
    <div class="header">
      <h1>Vehicle Spot Selection</h1>
      <h3>Web Programing - Project 4</h3>
    </div>


    <div id="game"></div>

    <div class="footer">
	<p> 
	Interesting.
	<br>
	<form action="creditCard.php" method="post">
	<input type="hidden" id="selectedId" name="finalId" value="">
	<input type="submit" value="next"/>
        
	<br>
	<br>
	</p>
    </div>
  </body>
<script type="text/javascript">
let cells;
let newCells;
let start = false;
let intervalId;
let numRows = 5;
let numCols = 10;
let oldselected;
let selected;

window.onload = () => {
  //cells = createCells();
  setStartingGrid();
};

function setStartingGrid() {
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
	button.style.backgroundColor = "white";
button.innerHTML = num;
    }
    gameDiv.appendChild(row);
  }
}

function gridClicked(clickedId) {
document.getElementById("selectedId").value = clickedId;
  let button = document.getElementById(clickedId);
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


</script>

</html>
