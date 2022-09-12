<?php

include 'conn.php';
session_start();

if(!isset($_SESSION['role'])){
    header("location:login.php");
}

if(!isset($_POST['detail']) and $_SESSION['role']=='user'){
    $role = $_SESSION['role'];
	$user_id = $_SESSION['content']->user_id;
    $name = $_SESSION['content']->user_name;
    $email = $_SESSION['content']->Email;
    $phoneNumber = $_SESSION['content']->contact_no;
    $mybank = $_SESSION['content']->bank;
    $bankAccount = $_SESSION['content']->credit_card_no;
    $address = $_SESSION['content']->address;
    $password = $_SESSION['content']->password;
}

else if($_SESSION['role'] == 'admin'){
    $user_id = htmlentities($_POST['user_id'], ENT_QUOTES);
    
    $sql = "SELECT * FROM user where user_id=$user_id;";
    $result = $mysqli->query($sql);
    if($row = $result->fetch_object()){
            
        $role = $row->admin;
		$user_id = $row->user_id;
        $name = $row->user_name;
        $email = $row->Email;
        $phoneNumber = $row->contact_no;
        $mybank = $row->bank;
        $bankAccount = $row->credit_card_no;
        $address = $row->address;
        $password = $row->password;
    }
}

$banks = array('Ambank', 'Bank Islam', 'CIMB', 'Maybank', 'Public Bank');

if(isset($_GET["info"])){
    if($_GET["info"]=='1'){
        echo '<script>alert("Update Successfully.");</script>';
    }
    elseif($_GET["info"]=='2'){
        echo '<script>alert("Update Fail.");</script>';
    }
}

?>

<link rel="stylesheet" href="./css/request.css">
<style>
input{
    width:60%;
}
</style>

<html style="background-color: #1abc9c;">
<head>
    <title>Update Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>

<form name='myForm' method='POST' action="action_page.php" onsubmit="return validation();">
  <div class="container">
    <h1>Personal Information</h1>
    
    <hr/>
   
    <div id='update_form' class='box' style='width:100%'>
        <input hidden name="role" value="<?php echo $role;?>"/>
		<input hidden name="user_id" value="<?php echo $user_id;?>"/>
        
        <label for="name"><b>Name</b></label>
        <input type="text" name="name" id="name" value="<?php echo $name;?>" readonly />     
     
        <label for="email"><b>Email</b></label>
        <input type="text" name="email" id="email"value="<?php echo $email;?>" readonly />

        <label for="phone"><b>Phone Number</b></label>
        <p id='phone_warning_1' class='warning hidden'>Please fill in your phone number</p>
        <input type="text" placeholder="Enter Phone Number" name="phone" id="phone"value="<?php echo $phoneNumber;?>" />
        
        <label for="address"><b>Address</b></label>
        <p id='address_warning_1' class='warning hidden'>Please fill your address</p>
        <input type="text" placeholder="Enter Address" name="address" id="address" value="<?php echo $address;?>" />
  
        <label for='bank'><b>Select your bank</b></label>
        <select id='bank' name='bank'>
            <?php foreach($banks as $bank){
                if($bank == $mybank)$option = "<option value='$bank' selected>$bank</option>";
                else $option = "<option value='$bank'>$bank</option>";
                echo $option;
            }
            ?>
        </select>
        
        <label for="bankAccount"><b>Credit Card Number</b></label>
        <p id='bankAccount_warning_1' class='warning hidden'>Please fill your credit card number</p>
        <input type="text" placeholder="Enter Bank Account" name="bankAccount" id="bankAccount" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo $bankAccount;?>"/>
        
        <?php
        if($_SESSION['role'] != 'admin'){ ?>
		
        <button type='button' id='chgPswBtn' class='btn'>Change Password</button>
        
        <hr/>

        <div id='chgPassword' class='box hidden' style='width:70%'>
            <label for="old_password"><b>Current Password</b></label>
            <p name='warning' id='old_password_warning_1' class='warning hidden'>Please write your password</p>
            <p name='warning' id='old_password_warning_2' class='warning hidden'>Password not true</p>
            <input type="password" placeholder="Enter Password" name="old_password" id="old_password">

            <label for="new_password"><b>New Password</b></label>
            <p name='warning' id='new_password_warning_1' class='warning hidden'>Please write your password</p>
            <input type="password" placeholder="Enter Password" name="new_password" id="new_password">

            <label for="repeat_password"><b>Repeat New Password</b></label>
            <p name='warning' id='repeat_password_warning_1' class='warning hidden'>Please repeat your password</p>
            <p name='warning' id='repeat_password_warning_2' class='warning hidden'>Password unmatched</p>
            <input type="password" placeholder="Repeat Password" name="repeat_password" id="repeat_password">
            </div>

            <?php } 
            else{ ?>
				<label for="user_id"><b>User ID</b></label>
				<input type="text" name="user_id" id="user_id" value="<?php echo $user_id;?>" readonly />     

                <label for="admin_password"><b>Password (Admin's View)</b></label>
                <p name='warning' id='admin_password_warning_1' class='warning hidden'>Please write the password</p>
                <input type="text" placeholder="Enter Password" name="admin_password" id="admin_password" value='<?php echo $password; ?>'>
            <?php } ?>
        <hr/>
		
		<script>var chg = false;</script>
        
        <div class = 'button_section'>
			<button type="submit" name='update_action' class="registerbtn" style = 'margin:5px;'>Save</button>
            <button type="button" name='back' class="registerbtn" style='background-color: red; margin: 5px;'onclick='window.location = "home.php";'>Back</button>
        </div>    
    </div>    
  </div>  
</form>

</body>
</html>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>

var role = '<?php echo $role; ?>';
var chg = false;
document.getElementById("chgPswBtn").onclick = function() {
    if (!chg){
        $("#chgPassword").show();
        $("#chgPswBtn").text('Cancel Changing Password');
        chg = true;
    }
    else{
        $("#chgPassword").hide();
        $("#chgPswBtn").text('Change Password');
        chg = false;
    }
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

document.getElementById("old_password").onchange = function() {
    if (!this.value)$("#old_password_warning_1").show();
    else $("#old_password_warning_1").hide();
    
};
document.getElementById("new_password").onchange = function() {
    if (!this.value)$("#new_password_warning_1").show();
    else $("#new_password_warning_1").hide();
    
};
document.getElementById("repeat_password").onchange = function() {
    if (!this.value)$("#repeat_password_warning_1").show();
    else $("#repeat_password_warning_1").hide();
    
};

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validation(){
    var val = true;
    
    if(!document.getElementById("email").value){$("#email_warning_1").show(); val = false;}
    if(!document.getElementById("phone").value){$("#phone_warning_1").show(); val = false;}
    if(!document.getElementById("address").value){$("#address_warning_1").show(); val = false;}
    if(!document.getElementById("bankAccount").value){$("#bankAccount_warning_1").show(); val = false;}
    
    if(chg){
        if(!document.getElementById("old_password").value){$("#old_password_warning_1").show(); val = false;}
        if(!document.getElementById("new_password").value){$("#new_password_warning_1").show(); val = false;}
        if(!document.getElementById("repeat_password").value){$("#repeat_password_warning_1").show(); val = false;}
		
        if(val && document.getElementById("repeat_password").value!=document.getElementById("new_password").value){
            $("#repeat_password_warning_2").show(); val = false;
        }
        else{
            $("#repeat_password_warning_2").hide();
        }
    }
    
    if(chg){
        if("<?php echo $password;?>" != document.getElementById('old_password').value){
            val = false;
            $("#old_password_warning_2").show();
        }
        else{
            $("#old_password_warning_2").hide();
        }
    }
    if(role == 'admin'){
        if(!document.getElementById("admin_password").value){
            $("#admin_password_warning_1").show();
            val = false;
        }
        else{
            $("#admin_password_warning_1").hide();
        }
    }
    if(!val) {
        alert('Please fill in all information and make sure all replies are true.');
    }
    
	
    return val;
}

</script>