<!DOCTYPE html>
<html>
<head>
<link href="creditstyle.css" type="text/css" rel="stylesheet"/>
<script>

/*This is the js code block for the credit card type validation. 
All the return statements are set to false so it will not send
to .php file, and in order for you to see the credit card types.*/

// made up credit card numbers for you to try:
// 5123123512351235     mastercard
// 4444123415231234     visa
// 341241245612452      amex
function printCard(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}
function creditType(){
   var ccnumber=document.getElementById("card_num").value;

	
	var visa = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
    var mastercard = /^(?:5[1-5][0-9]{14})$/;
	var amex=/^(?:3[47][0-9]{13})$/;
  if(visa.test(ccnumber)==true)
        {printCard("cardType","visa");
        return false;
		
        }
		
		else if (mastercard.test(ccnumber)==true)
		{printCard("cardType","Mastercard")
		return false;
		}
		else if (amex.test(ccnumber)==true)
		{printCard("cardType","American Express")
		return false;
		}
      else
        {
		alert("Not valid");
		return false;
        }	
	

}
</script>
</head>
<body>
<h1>Credit Card Payment</h1>
<h3>Parking Spot: <?php echo $_POST['finalId'];?></h3>
	<div class="payment">
	<form name="creditForm" action="/action.php" onsubmit= "return creditType()"  method="post">
			<fieldset>

<ul>
	<li>
		<div>
			<label >Card Number  </label>
			<input class="card_number" name="card_number" id="card_num" type="text" size="16">
		</div>

		<div>
			<label>  Security Code</label>
			
				<input class="security_code" name="security_code" type="text" size="6">
				
				<input class="question_mark" name="question_mark" type="text" size="1" value="?" >
				
		</div>

	</li>

		<br>

	<li>
		<div>
			<label >Name on Card  </label>  
				<input id="card_number" name="card_number" type="text" size="14">
		</div>

<div>
	<label>  Expiration</label>
		<select id="months" name="months"  size="1" >
			<option value="MM">MM</option>
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
    

		</select>
	/
		<select id="year" name="year"  size="1">
			<option value="YY">YY</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>

		</select>
			
</div>
		</li>
		
	
	</ul>
 <input type="submit" value="Submit">    <div class="cardType" id="cardType"></div>
	</fieldset>
	
	</form>
</div>


<div class="personal_information">
		<form name="infoForm" action="/action.php" onsubmit= "return creditType()"  method="post">
			<fieldset>

<ul>
	<li>
		<div>
			<label >Address  </label>
			<input class="address" name="address" id="address" type="text" size="16">
		</div>

		<div>
			<label>Billing Address</label>
			
				<input class="bill_address" name="bill_address" type="text" size="16">
				
		</div>

	</li>

		<br>

	<li>
		<div>
			<label >Phone Number  </label>  
				<input id="phone_number" name="phone_number" type="text" size="10" value="( )">
		</div>
	</li>
		<br>
	
	</ul>
 
	</fieldset>
	
	</form>
</div>

</body>


</html>
