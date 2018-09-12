// forms.js 
//this file will be attached to home.php JS handles with cookies display window 
// and submited registrations forms

//this function fires window onload home.php with cookie policy and button accept/refuse


//this function fires after click button register with "long" registration form
function showDiv(){
	
	var x = document.getElementById("register1");
	
	if(x.style.display === "none"){
		
		x.style.display = "block";
	}else{
		
		x.style.display = "none";
	}
	
}
	
//this function fires after click button register with "basic" registration form
//this option is temporary paused as registration form works as only one big with option to additional input fields.
//for those who fulfill additional field is provided a small surprise when they try to logout from e-shop after first login
/*function showDivTwo(){
	
	var x = document.getElementById("register2");
	
	if(x.style.display === "none"){
		
		x.style.display = "block";
	}else{
		
		x.style.display = "none";
	}
	


function funk1(){
	
	document.getElementById('cookie').style.display = "none";	

}


function funk2(){
	document.getElementById("cookie").style.display = "block";
	
}
*/
	
	
	
	








































