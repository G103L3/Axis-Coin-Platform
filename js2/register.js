function check_special_chars(string){
  var format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]*$/;

    if( string.match(format) ){
      return true;
    }else{
      return false;
    }
}
function check_email(string){
  var format = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    if( !string.match(format) ){
      return true;
    }else{
      return false;
    }
}
function check_password(string){
  var format = /^[!^*()_+\-=\[\]{};':"\\|,<>\/?]*$/;
  var format2 = /^[a-zA-Z0-9@#$%&]*$/;

    if( string.match(format) ){
      return true;
    }else{
      if(string.match(format2)){
        if(string.length < 6){
          return true;
        }else{
          return false;
        }
      }else{
        return true;
      }

    }
}
function check_input(){
  let elements = document.getElementsByClassName('is-invalid');
  if(elements.length == 0){
    document.getElementById("submit_register").classList.remove("disabled");
  }else{
    document.getElementById("submit_register").classList.add("disabled");
  }
}
  const username = document.getElementById('username');
  const name = document.getElementById('name');
  const surname = document.getElementById('surname');
  const email = document.getElementById('email');
  const password1 = document.getElementById('password1');
  const password2 = document.getElementById('password2');
  const id_card = document.getElementById('id_card');

  username.addEventListener('focusout', (event) => {
    document.getElementById("username").classList.remove("is-invalid");
    document.getElementById("wrong_username").style.display = "none";
    document.getElementById("required_username").style.display = "none";
    document.getElementById("used_username").style.display = "none";
    var usernameV = $('#username').val();
    if(check_special_chars(usernameV)){
      document.getElementById("username").classList.add("is-invalid");
      document.getElementById("wrong_username").style.display = "block";
    }
    if(usernameV == ""){
      document.getElementById("username").classList.add("is-invalid");
      document.getElementById("required_username").style.display = "block";
    }
    check_input();
});
name.addEventListener('focusout', (event) => {
  document.getElementById("name").classList.remove("is-invalid");
  document.getElementById("wrong_name").style.display = "none";
  document.getElementById("required_name").style.display = "none";
  var nameV = $('#name').val();
  if(check_special_chars(nameV)){
    document.getElementById("name").classList.add("is-invalid");
    document.getElementById("wrong_name").style.display = "block";
  }
  if(nameV == ""){
    document.getElementById("name").classList.add("is-invalid");
    document.getElementById("required_name").style.display = "block";
  }
  check_input();
});
surname.addEventListener('focusout', (event) => {
  document.getElementById("surname").classList.remove("is-invalid");
  document.getElementById("wrong_surname").style.display = "none";
  document.getElementById("required_surname").style.display = "none";
  var surnameV = $('#surname').val();
  if(check_special_chars(surnameV)){
    document.getElementById("surname").classList.add("is-invalid");
    document.getElementById("wrong_surname").style.display = "block";
  }
  if(surnameV == ""){
    document.getElementById("surname").classList.add("is-invalid");
    document.getElementById("required_surname").style.display = "block";
  }
  check_input();
});
email.addEventListener('focusout', (event) => {
  document.getElementById("email").classList.remove("is-invalid");
  document.getElementById("wrong_email").style.display = "none";
  document.getElementById("required_email").style.display = "none";
  document.getElementById("used_email").style.display = "none";
  var emailV = $('#email').val();
  if(check_email(emailV)){
    document.getElementById("email").classList.add("is-invalid");
    document.getElementById("wrong_email").style.display = "block";
  }
  if(emailV == ""){
    document.getElementById("email").classList.add("is-invalid");
    document.getElementById("required_email").style.display = "block";
  }
  check_input();
});
password1.addEventListener('focusout', (event) => {
  document.getElementById("password1").classList.remove("is-invalid");
  document.getElementById("wrong_password").style.display = "none";
  var password1V = $('#password1').val();
  var password2V = $('#password2').val();

  if(check_password(password1V)){
    document.getElementById("password1").classList.add("is-invalid");
    document.getElementById("wrong_password").style.display = "block";
  }
  document.getElementById("different_password").style.display = "none";
  document.getElementById("password2").classList.remove("is-invalid");

  if(password1V != password2V && password2V != ""){
    document.getElementById("password2").classList.add("is-invalid");
    document.getElementById("different_password").style.display = "block";
  }
  check_input();
});
password2.addEventListener('focusout', (event) => {
  document.getElementById("password2").classList.remove("is-invalid");
  document.getElementById("different_password").style.display = "none";
  var password1V = $('#password1').val();
  var password2V = $('#password2').val();

  if(password1V != password2V && password1V != ""){
    document.getElementById("password2").classList.add("is-invalid");
    document.getElementById("different_password").style.display = "block";
  }
  check_input();
});

id_card.addEventListener('focusout', (event) => {

  document.getElementById("id_card").classList.remove("is-invalid");
  document.getElementById("wrong_id_card").style.display = "none";
  document.getElementById("required_id_card").style.display = "none";
  document.getElementById("used_id_card").style.display = "none";
  var id_cardV = $('#id_card').val();
  if(check_special_chars(id_cardV) || id_cardV.length != 9){
    document.getElementById("id_card").classList.add("is-invalid");
    document.getElementById("wrong_id_card").style.display = "block";
  }
  if(id_cardV == ""){
    document.getElementById("id_card").classList.add("is-invalid");
    document.getElementById("required_id_card").style.display = "block";
  }
  check_input();
});
function submit_signup(){

  var username = $("#username").val();
  var name = $("#name").val();
  var surname = $("#surname").val();
  var email = $("#email").val();
  var password = $("#password1").val();
  var group_id = $("#group_id").text();
  var referral_user = $("#referral_user").text();
  var id_card_number = $("#id_card").val();

  $.post(
    '/no-logged/scripts/signup.php',   // url
       { username: username, name: name, surname: surname, email: email, password : password, group_id: group_id, referral_user: referral_user, id_card_number: id_card_number}, // data to be submit
       function(data) {// success callback
         if(data[0][0] == "used_username"){
           document.getElementById("username").classList.add("is-invalid");
           document.getElementById("used_username").style.display = "block";
         }
         if(data[0][0] == "used_email"){
           document.getElementById("email").classList.add("is-invalid");
           document.getElementById("used_email").style.display = "block";
         }
         if(data[0][0] == "used_id_card"){
           document.getElementById("id_card").classList.add("is-invalid");
           document.getElementById("used_id_card").style.display = "block";
         }
         if(data[0][0] == "success"){
           location.href = "../../panel.php";
         }
        },
      'json')
}
