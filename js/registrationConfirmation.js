<script>//registrationConfirmation.js
//insert this file into home.php attach as onclick function to two button "Create an account" and "Cancel" 
//after uset fill in form or not must press Create an account - and are you sure? then click OK or cancel - you can measurre italics
// the same situation will be if user not to fill in a form- just resign and click Cancel - then pop up will ask - Are you sure? 
//if OK pressed insert into DB as resign. if Cancel pressed means SB decide to go back and register.

// this function will be onclick "Cancel" button 
function myFunction(){
  
  var txt;
  if(confirm("Are you sure that you'are leaving us?")){
	  
	  txt = "You really leaivng us. we are upset";
  } else{
	  
	  txt = "We are happy you decided to stay.Thank you";
  } 
   document.getElementById("leave").innerHTML = txt;
	
}// end of function
</script>
<script>
//funtion is usede on eshop.header page on button LOGOUT. 
//if user mouseover button- want to log out- display popup window with newsletter and offers

document.getElementById("but1").onmouseover = function() {showNewsletter()};

function showNewsletter(){
	
	document.getElementById("newsletter").style.display = "block";
	
}// end of function newsletter1()


</script>