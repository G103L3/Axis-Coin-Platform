const username = document.getElementById('username');
const password = document.getElementById('password');

function check_input(){
  let elements = document.getElementsByClassName('is-invalid');
  if(elements.length == 0){
    document.getElementById("submit_login").classList.remove("disabled");
  }else{
    document.getElementById("submit_login").classList.add("disabled");
  }
}

username.addEventListener('focusout', (event) => {
  document.getElementById("username").classList.remove("is-invalid");
  document.getElementById("wrong_username").style.display = "none";
  document.getElementById("required_username").style.display = "none";
  var usernameV = $('#username').val();
  if(usernameV == ""){
    document.getElementById("username").classList.add("is-invalid");
    document.getElementById("required_username").style.display = "block";
  }
  check_input();
});
password.addEventListener('focusout', (event) => {
  document.getElementById("password").classList.remove("is-invalid");
  document.getElementById("wrong_password").style.display = "none";
  document.getElementById("required_password").style.display = "none";
var passwordV = $('#password').val();
if(passwordV == ""){
  document.getElementById("password").classList.add("is-invalid");
  document.getElementById("required_password").style.display = "block";
}
check_input();
});

function submit_login(){
  var username = $("#username").val();
  var password = $("#password").val();

  $.post(
    '/no-logged/scripts/login.php',   // url
       { username: username, password : password}, // data to be submit
       function(data) {// success callback
         if(data[0][0] == "wrong_username"){
           document.getElementById("username").classList.add("is-invalid");
           document.getElementById("wrong_username").style.display = "block";
         }
         if(data[0][0] == "wrong_password"){
           document.getElementById("password").classList.add("is-invalid");
           document.getElementById("wrong_password").style.display = "block";
         }
         if(data[0][0] == "success"){
           location.href = "../../panel.php";
         }
        },
      'json')
}
