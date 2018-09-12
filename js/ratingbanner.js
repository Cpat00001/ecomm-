function banner(){

    //this function create cookie, then PHP function insert values to DB,
	//marketer will be able to measure how many times banner was displayed
   
    document.getElementById("ratingbanner").style.display = "block";
    document.cookie = "banner= yes; expires=0; path=/";
}


document.getElementById("bannerbutton").onclick = function() {hideBanner()};

function hideBanner(){
 
  //function hide banner and create cookie.the cookie will be taken by PHP function and sent to DB as user refuse this product
  // amount of displaying AD divide to refuse click button allow to measure CTR (click throught rate of banner)
 document.getElementById("ratingbanner").style.display = "none";
 document.cookie = "banner2= true; expires=0; path=/";
 
 if(document.cookie.replace(/(?:(?:^|.*;\s*)banner2\s*\=\s*([^;]*).*$)|^.*$/, "$1") === "true"){
 
    document.getElementById("ratingbanner").style.display = "none";
 
  } // end of function hideBanner()

} // end of function hideBanner()

document.getElementById("bannerbutt").onclick = function() {register()};

function register(){
  // this function set another cookie - says that user interested-ACCEPT ad-participate,and clicked image with game
  //which will be sent to PHP and base on it the user email will be sent to DB
  //set time in this cookie - to be able not to measure all the time that SB accepted an offer 2nd,3rd time in the sme session
  var now = new Date();
  var time = now.getTime();
  var expireTime = time + 60*1000;
  now.setTime(expireTime);
  //var tempExp = 'Wed, 31 Oct 2012 08:50:17 GMT';
  document.cookie = 'banner3=accept;expires='+now.toGMTString()+';path=/';
  //document.cookie = "banner4=<?php echo $product_id ?>; expires=0;path=/";
} // end of function register()

// ################################ below functions for ratingbanner2 for users who didnt rated products category:movie

/*
function banner2(){

    //function copied from above,but in this banner this function only display banner onload body,do not create cookie - no need 
	//in case where baner do not displayed personalised message,no need to measure it 
  
    document.getElementById("ratingbanner2").style.display = "block";
    
}

document.getElementById("bannerbutton").onclick = function() {hideBanner()};

function hideBanner(){
 
  //function hide banner and create cookie. in this case cookie will be needed to keep banner hidden. see if statement below
 document.getElementById("ratingbanner2").style.display = "none";
 document.cookie = "banner2= true; expires=0; path=/";
 
 //this IF statement check if button to hide banner was clicked - if yest then do not show banner til the end of user session
 if(document.cookie.replace(/(?:(?:^|.*;\s*)banner2\s*\=\s*([^;]*).*$)|^.*$/, "$1") === "true"){
 
    document.getElementById("ratingbanner2").style.display = "none";
 
  } // end of function hideBanner()

} // end of function hideBanner()

*/
