<div id="div1" align="center"; style="background-color:#666666;z-index:2000;box-shadow:5px 0px 20px #000;color:#ffffff; width:180px; padding:10px;position:fixed; bottom:0;left:20px"><div style="font-size:13px;" >This website uses cookies to track and improve the visitor experience.These cookies do not hold any personal data.<br /><br /><a href="cookies.php" style="color:#999999;"> Learn more </a><br /><br /><input onClick="CookiesAccepted()" style="background-color:#333333;border:none;height:31px;color:#FFFFFF" id="button1" type="button" value="Continue"></div></div><script> function setCookie(c_name,value,exdays){ var exdate=new Date(); exdate.setDate(exdate.getDate() + exdays); var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString()); document.cookie=c_name + "=" + c_value; } function getCookie(c_name)
{ var i,x,y,ARRcookies=document.cookie.split(";"); for (i=0;i<ARRcookies.length;i++) { x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("=")); y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1); x=x.replace(/^\s+|\s+$/g,""); if (x==c_name) { return unescape(y); } } } var agree = getCookie("agreed"); if (agree!="10")  { document.write(""); }  else  { document.getElementById('div1').style.display="none"; } function CookiesAccepted()  { setCookie("agreed", "10", 365); document.getElementById('div1').style.display="none"; } </script>