<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Facebook API</title>
    <style>
      #fb-btn , #logout{
        display: none;
      }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
   
<script>
 window.fbAsyncInit = function() {
   FB.init({
     appId      : '448542122326414', // your app id
     cookie     : true,
     xfbml      : true,
     version    : 'v5.0' // graph api version in this case is v2.12
   });
     
   FB.getLoginStatus(function(response) {
           statusChangeCallback(response);
       });
     
 };

 (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

 function statusChangeCallback(response) {
       if (response.status === "connected") {
           console.log("Logged in and authenticated");
           setElements(true);
           graphAPI();
       } else {
           console.log("Not authenticated");
           setElements(false);
       }
   }

   function checkLoginState() {
       FB.getLoginStatus(function(response) {
           statusChangeCallback(response);
       });
   }

   function setElements(isLoggedIn){
     if(isLoggedIn){
        document.getElementById('fb-btn').style.display = 'none';
        document.getElementById('login-msg').style.display = 'none';
        document.getElementById('logout').style.display = 'block';
        document.getElementById('msg').style.display = 'block';
     } else {
        document.getElementById('fb-btn').style.display = 'block';
        document.getElementById('login-msg').style.display = 'block';
        document.getElementById('logout').style.display = 'none';
        document.getElementById('msg').style.display = 'none';
     }
   }

   function logout(){
     FB.logout(function(response){
       setElements(false);
     })
   }

   function graphAPI(){
     FB.api("me?fields=id,name,email" , function(response){
       if(response && !response.error){
         document.getElementById('msg').innerHTML += response.name + " (" + response.email + ")";
       }
     })
   }

</script>

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand" href="#">
        <fb:login-button 
          id="fb-btn"
          scope="public_profile,email"
          onlogin="checkLoginState();">
        </fb:login-button>
        <a id="logout" onclick="logout()" href="">Logout</a>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gmaps.html">Google Maps</a>
      </li>
    </ul>
  </div>
</nav>

<h3 id="login-msg">Please log in</h3>
<h3 class="mt-3" id="msg">Hello </h3>
  

</body>

</html>