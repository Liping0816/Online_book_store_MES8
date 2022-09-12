<?php

include 'conn.php';
session_start();

if(!isset($_SESSION['role'])){
    header("location:login.php");
}

$user_id = $_SESSION['content']->user_id;
$sql = "SELECT * FROM user where user_id=$user_id;";
$result = $mysqli->query($sql);

if($row = $result->fetch_object()){
            
	$user_id = $row->user_id;
    $name = $row->user_name;
    $phoneNumber = $row->contact_no;
    $mybank = $row->bank;
    $bankAccount = $row->credit_card_no;
    $address = $row->address;
    $password = $row->password;
}

$cart_id = htmlentities($_POST['cart_id'], ENT_QUOTES);
$user_id2 = htmlentities($_POST['user_id'], ENT_QUOTES);

$sql2 = "SELECT * FROM shopping_cart WHERE cart_id='$cart_id'";
$result2 = $mysqli->query($sql2);

if($row2 = $result2->fetch_object()){
            
	$cart_id = $row2->cart_id;
	$total_price = $row2->total_price;
	$cart_status = $row2->cart_status;
		
}

if($user_id != $user_id2 or $cart_status!="pending"){
	header("location:my_cart.php?info=2");
}

?>

<html>

<head>
<head>
  <title>payment</title>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/login.css">
</head>

<body style = "background-color: #1abc9c;">
  <div class="main" style="height:auto;"> 
    <p class="sign" align="center">Purchase Book</p>
        <form class="" method='POST' action="action_page.php" onsubmit="return validation();">
		<input hidden name='cart_id' value='<?php echo $cart_id;?>'/>
		<input hidden name='user_id' value='<?php echo $user_id;?>'/>
        
		<input name="name" id="name" class="un" type="text" align="center" value="<?php echo $name;?>" readonly />
	
		<input name="address" id="address" class="un" type="text" align="center" value="<?php echo $address;?>" readonly />
		
		<input name="total_price" id="total_price" class="un" type="text" align="center" value="<?php echo 'RM'; echo $total_price;?>" readonly />
 
        <p align="center" id='credit_warning_1' class='warning hidden'>Please fill in your Credit Card Number</p>
        <input name="credit_card_no" id="credit_card_no" class="un" type="text" align="center" placeholder="Credit Card Number" >
          
		<p align="center" id='password_warning_1' class='warning hidden'>Please fill in password</p>
        <input name="password" id="password" class="pass" type="password" align="center" placeholder="Password">
          
        <button align="center" class="submit" name='payment_action'>Pay</button>
		<br/>
		<br/>
		<button align="center" class="submit" name='back' onclick='window.location = "home.php";'>Back</button>
    
	
		<br/>
		<br/>
        </form>
        <div class="container signin"  align="center">
           <p><a href="update.php">Update Address?</a></p>
        </div>    
		<br/>
    </div>
     
</body>

</html>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>

document.getElementById("credit_card_no").onchange = function() {
    if (!this.value)$("#credit_warning_1").show();
    else $("#credit_warning_1").hide();
};

document.getElementById("password").onchange = function() {
    if (!this.value)$("#password_warning_1").show();
    else $("#password_warning_1").hide();
};

function validation(){
    var val = true;
    
    if(!document.getElementById("credit_card_no").value){$("#credit_warning_1").show(); val = false;}
    if(!document.getElementById("password").value){$("#password_warning_1").show(); val = false;}
    
    return val;
}

function asking_msg(msg, regrex_rule){
    var next=true;
    while(next){
        input = prompt(msg);

        if(input == null)return false;
        else if(input){
            if(regrex_rule != 'null'){
                if(input.match(regrex_rule)){
                return input;
                }
                else alert('Format not true.');            
            }            
            else {
                return input;            
            }
        }
    }
}
var regrex_code = /^\d{6}$/;


/*function forgetPassword(){
    
    name = document.getElementById("name").value;
    //Ic = document.getElementById("Ic").value;

    radios = document.getElementsByName("role");
    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            role = radios[i].value;
            break;
        }
    }

    if(name){
        code = asking_msg("A 6-digit code is sent to your email, Please verify here.", regrex_code);
        if(code){
            psw = asking_msg("Please reset your password.", 'null');
            if(psw){
                alert('Password is updated, please login again');
                var msg = 'action_page.php?forgetPassword=yes&code='+code+'&role='+role+'&Ic='+Ic+'&psw='+psw;
                window.location.href = msg;
            }
        }
        else alert('Cancel');
    }
    else{
        alert('Please fill in the field other than password.');
    }    
}*/
</script>