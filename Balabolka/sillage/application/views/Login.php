<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #861B2E;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 40px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
 
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;

}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<script type="text/javascript">
$(document).ready(function() {
	$(function() {
             $('#LoginForm input').focus(function()
	{
		$('.msge_erreur').html('');

	});
   $("#button").click (function(){
var User=$("#User").val();
var Password=$("#Password").val();
$.ajax
({
type:"POST",
url: "<?php echo URL?>Login",
data:"User="+User+"&Password="+Password,
success:function(data)
{
 if(data=='false')   
 $('.msge_erreur').html('La combinaison nom utlisateur , mot de passe est incorrecte');
else
$("#LoginForm").submit();
}
});
});

        });
    });
</script>
 
</head>
<body>



<div id="id01" class="modal">
 
    <form id="LoginForm"  class="modal-content animate" action="<?php echo base_url("Main/FicheAssure") ?>">
   
    <div class="container"> 
      <h2>Authentification</h2>
      <label for="uname"><b>Utilisateur</b></label>
      <input type="text" placeholder="Entrer le nom d'utilisateur" id="User" name="uname" required>

      <label for="psw"><b>Mot de passe</b></label>
      <input type="password" placeholder="Entrer le mot de passe" id="Password" name="psw" required>
      <span class='msge_erreur' style="color:red" > </span>
      <button type="button" id="button">S'authentifier</button>
     
    
     </div>
  </form>
</div>


</body>
</html>


