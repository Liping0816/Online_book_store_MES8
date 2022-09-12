
<html>

<head>
<head>
  <title>login</title>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/login.css">
</head>

<body style = "background-color: #1abc9c;">
  <div class="main" style="height:auto;"> 
    <p class="sign" align="center">Sign in</p>
        <form class="" method='POST' action="action_page.php" onsubmit="return validation();">
        <center>
            <input type="radio" name="role" id="admin" value="1" checked><b>Admin</b></input>
            <input type="radio" name="role" id="user" value="0" checked><b>User</b></input>
            <!-- <input type="radio" name="role" id="Requester" value="student" ><b>Student</b></input> -->
        </center>
        <hr/>
          
          <p align="center" id='name_warning_1' class='warning hidden'>Please fill in your name</p>
          <input name="name" id="name" class="un" type="text" align="center" placeholder="Name">
          
          <!-- <p align="center" id='Ic_warning_1' class='warning hidden'>Please fill in your Ic Number</p>
          <p align="center" id='Ic_warning_2' class='warning hidden'>Invalid Ic Number</p>
          <input name="Ic" id="Ic" class="un" type="text" align="center" placeholder="IC Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" >
          -->
		  
          <p align="center" id='password_warning_1' class='warning hidden'>Please fill in password</p>
          <input name="password" id="password" class="pass" type="password" align="center" placeholder="Password">
          
          <button align="center" class="submit" name='login_action'>Sign in</button>
    
	
		<br/>
		<br/>
        </form>
        <div class="container signin"  align="center">
           <p><a href="register.php">No account? Register</a>.</p>
        </div>    
		<br/>
    </div>
     
</body>

</html>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>
/*ic_val = false;
document.getElementById("Ic").onchange = function() {
    if (!this.value){
        $("#Ic_warning_1").show();
        $("#Ic_warning_2").hide();
        ic_val = false;
    }
    else{
        $("#Ic_warning_1").hide();
        
        if(this.value.length != 12){
            $("#Ic_warning_2").show();
            ic_val = false;
        }
        else {
            $("#Ic_warning_2").hide();
            ic_val = true;
        }
    }
};*/

document.getElementById("name").onchange = function() {
    if (!this.value)$("#name_warning_1").show();
    else $("#name_warning_1").hide();
};

document.getElementById("password").onchange = function() {
    if (!this.value)$("#password_warning_1").show();
    else $("#password_warning_1").hide();
};

function validation(){
    var val = true;
    
    if(!document.getElementById("name").value){$("#name_warning_1").show(); val = false;}
    /*if(!document.getElementById("Ic").value){$("#Ic_warning_1").show(); val = false;}
    else{
        if(!ic_val){
            $("#Ic_warning_2").show();
            val = false;
        }
        else{
            $("#Ic_warning_1").hide();
            $("#Ic_warning_2").hide();
        }
    }*/
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