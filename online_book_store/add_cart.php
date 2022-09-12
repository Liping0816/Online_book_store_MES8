<?php

include 'conn.php';
session_start();

$book_id = htmlentities($_POST['book_id'], ENT_QUOTES);

  
    $sql = "SELECT * FROM book WHERE book_id='$book_id';";
	
	$result = $mysqli->query($sql);
	
    if($row = $result->fetch_object()){
	
		$book_id = $row->book_id;
		$ISBN = $row->book_isbn;
		$title = $row->book_title;
		$author = $row->book_author;
		$price = $row->book_price;
		$quantity = $row->book_quantity;
		$thiscat = $row->book_categories;
		$rating = $row->book_rating;
		$detail = $row->book_detail;
	}


if(!isset($_SESSION['role'])){
    header("location:login.php");
}

    $role = $_SESSION['role'];
    $name = $_SESSION['content']->user_name;
	$user_id = $_SESSION['content']->user_id;
    $email = $_SESSION['content']->Email;
    $phoneNumber = $_SESSION['content']->contact_no;
    $mybank = $_SESSION['content']->bank;
    $bankAccount = $_SESSION['content']->credit_card_no;
    $address = $_SESSION['content']->address;
    $password = $_SESSION['content']->password;


?>

<link rel="stylesheet" href="./css/request.css">
<style>
input{
    width:60%;
}
</style>

<html style="background-color: #1abc9c;">
<head>
    <title>Add Book To Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>

<form name='myForm' method='POST' action="action_page.php" onsubmit="return validation();">
  <div class="container">
    <h1>Buy This Book</h1>
    
    <hr/>
   
    <div id='addcart_form' class='box' style='width:100%'>
		<input hidden name="book_id" value="<?php echo $book_id;?>"/>
		<input hidden name="user_id" value="<?php echo $user_id;?>"/>
		<input hidden name="quantity" value="<?php echo $quantity;?>"/>
        
        <label for="email"><b>Your Email</b></label>
        <input type="text" name="email" id="email" value="<?php echo $email;?>" readonly />     
     
        <label for="title"><b>Title</b></label>
        <input type="text" name="title" id="title" value="<?php echo $title;?>" readonly />

		<label for="author"><b>Author</b></label>
        <input type="text" name="author" id="author" value="<?php echo $author;?>" readonly />
		
		<label for="rating"><b>Rating</b></label>
        <input type="text" name="rating" id="rating" value="<?php echo $rating;?>" readonly />

        <label for="price"><b>Price</b></label>
        <input type="text" name="price" id="price"value="<?php echo $price;?>"  readonly />
		
		<label for="order_quantity"><b>Quantity</b></label>
        <p id='quantity_warning_1' class='warning hidden'>Please fill in the quantity</p>
        <input type="text" placeholder="Order Quantity" name="order_quantity" id="order_quantity" value="1" />   
 
        <hr/>
        
        <div class = 'button_section'>
            <button type="submit" name='add_cart_action' class="registerbtn" style = 'margin:5px;'>Add to Cart</button>
            <button type="button" name='back' class="registerbtn" style='background-color: red; margin: 5px;'onclick='window.location = "book_list.php";'>Back</button>
        </div>    
    </div>    
  </div>  
</form>

</body>
</html>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>


document.getElementById("quantity").onchange = function() {
    if (!this.value)$("#quantity_warning_1").show();
    else $("#quantity_warning_1").hide();
};

function validation(){
    var val = true;
    
	if(!document.getElementById("quantity").value){$("#quantity_warning_1").show(); val = false;}
 
    if(val!=true){
        alert('Please fill in all the blank');
	}
    
    return val;
}

</script>