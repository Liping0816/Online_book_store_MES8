<?php
if(isset($_GET["info"])){
    if($_GET["info"]=='1'){
        echo '<script>alert("User already exist");</script>';
    }
}

$banks = array('Ambank', 'Bank Islam', 'CIMB', 'Maybank', 'Public Bank');

?>

<html style="background-color: #1abc9c;">
<head>
    <title>Register_Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include './css/register.css' ?>
    </style>
</head>
<body>

<form name='myForm' method='POST' action="action_page.php" onsubmit="return validation();">
 <div class="container">
    <h1>Register New Account</h1>
    <hr/>
    
 <!--   <div class='box'>
        <label for="role"><b>You want to be a?</b></label>
        <br/>
        <input type="radio" name="role" id="Donor" value="donor" ><b>Donor</b></input>
        <input type="radio" name="role" id="Requester" value="student" ><b>Requester</b></input>
        <br/>
    </div>
 
    <hr/>
-->
    <div id='register_form'>
        <p>Please fill in this form to create a new account.</p>
        
        <label for="name"><b>Name</b></label>
        <p id='name_warning_1' class='warning hidden'>Please fill in your name</p>
        <input type="text" placeholder="Enter First Name" name="name" id="name">
        
<!--        <label for="Ic"><b>Ic Number</b></label>
        <p id='Ic_warning_1' class='warning hidden'>Please fill in your Ic Number</p>
        <p id='Ic_warning_2' class='warning hidden'>Invalid Ic Number</p>
        <input type="text" placeholder="Enter Ic Number" name="Ic" id="Ic" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" />
-->        
        <label for="email"><b>Email</b></label>
        <p id='email_warning_1' class='warning hidden'>Please fill in your email</p>
        <p id='email_warning_2' class='warning hidden'>Invalid email</p>
        <input type="text" placeholder="Enter Email" name="email" id="email">

        <label for="phone"><b>Contact Number</b></label>
        <p id='phone_warning_1' class='warning hidden'>Please fill in your phone number</p>
        <input type="text" placeholder="Enter Phone Number" name="phone" id="phone">
        
        <label for="address"><b>Address</b></label>
        <p id='address_warning_1' class='warning hidden'>Please fill your address</p>
        <input type="text" placeholder="Enter Address" name="address" id="address">
        
        <label for='bank'><b>Select your bank</b></label>
        <select id='bank' name='bank'>
            <?php foreach($banks as $bank){
                $option = "<option value='$bank'>$bank</option>";
                echo $option;
            }
            ?>
        </select>
        
        <label for="bankAccount"><b>Credir Card Number</b></label>
        <p id='bankAccount_warning_1' class='warning hidden'>Please fill your credit card number</p>
        <input type="text" placeholder="Enter Bank Account" name="bankAccount" id="bankAccount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" />
        
        <label for="password"><b>Password</b></label>
        <p name='warning' id='password_warning_1' class='warning hidden'>Please write your password</p>
        <input type="password" placeholder="Enter Password" name="password" id="password">

        <label for="psw_repeat"><b>Confirm Password</b></label>
        <p name='warning' id='password_repeat_warning_1' class='warning hidden'>Please repeat your password</p>
        <p name='warning' id='password_repeat_warning_2' class='warning hidden'>Password unmatched</p>
        <input type="password" placeholder="Repeat Password" name="password_repeat" id="password_repeat">
        <hr/>
        
        
    <button type="submit" name='register_action' class="registerbtn">Register</button>
    
    </div>
    
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>
var rad = document.myForm.role;
var prev = null;
var role = null;


document.getElementById("name").onchange = function() {
    if (!this.value)$("#name_warning_1").show();
    else $("#name_warning_1").hide();
};

document.getElementById("email").onchange = function() {
    if (!this.value){
        $("#email_warning_1").show();
        $("#email_warning_2").hide();
    }
    else{
        $("#email_warning_1").hide();
        
        if(!validateEmail(this.value))$("#email_warning_2").show();
        else $("#email_warning_2").hide();
    }
};

document.getElementById("phone").onchange = function() {
    if (!this.value)$("#phone_warning_1").show();
    else $("#phone_warning_1").hide();
};

document.getElementById("address").onchange = function() {
    if (!this.value)$("#address_warning_1").show();
    else $("#address_warning_1").hide();
};

document.getElementById("bankAccount").onchange = function() {
    if (!this.value)$("#bankAccount_warning_1").show();
    else $("#bankAccount_warning_1").hide();
};
document.getElementById("password").onchange = function() {
    if (!this.value)$("#password_warning_1").show();
    else $("#password_warning_1").hide();
};
document.getElementById("password_repeat").onchange = function() {
    if (!this.value)$("#password_repeat_warning_1").show();
    else $("#password_repeat_warning_1").hide();
    
};

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validation(){
    var val = true;
    
    if(!document.getElementById("name").value){$("#name_warning_1").show(); val = false;}
    if(!document.getElementById("email").value){$("#email_warning_1").show(); val = false;}
    if(!document.getElementById("Ic").value){$("#Ic_warning_1").show(); val = false;}
    if(!document.getElementById("phone").value){$("#phone_warning_1").show(); val = false;}
    if(!document.getElementById("address").value){$("#address_warning_1").show(); val = false;}
    if(!document.getElementById("bankAccount").value){$("#bankAccount_warning_1").show(); val = false;}
    if(!document.getElementById("password").value){$("#password_warning_1").show(); val = false;}
    if(!document.getElementById("password_repeat").value){$("#password_repeat_warning_1").show(); val = false;}
    
   
    if(val==true){
        if(document.getElementById("password").value != document.getElementById("password_repeat").value){
            $("#password_repeat_warning_2").show();
            alert('The repeated password not match password');
        }
    }
    else {alert('Please fill in all the blank');}
    
    return val;
}

</script>