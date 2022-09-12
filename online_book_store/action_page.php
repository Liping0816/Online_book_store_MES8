<?php
include('conn.php');
session_start();


//-----------------------------Register------------------------------------------
if (isset($_POST['register_action']))
{	
	$role = '0';
	$name = htmlentities($_POST['name'], ENT_QUOTES);
	$email = htmlentities($_POST['email'], ENT_QUOTES);
	$phone = htmlentities($_POST['phone'], ENT_QUOTES);
	$bankAccount = htmlentities($_POST['bankAccount'], ENT_QUOTES);
	$address = htmlentities($_POST['address'], ENT_QUOTES);
	$password = htmlentities($_POST['password'], ENT_QUOTES);
    $bank = htmlentities($_POST['bank'], ENT_QUOTES);
    
    $sql = "SELECT * FROM user WHERE Email='$email' OR user_name='$name' OR credit_card_no='$bankAccount';";
    
    $result = $mysqli->query($sql);
	
	if($row = $result->fetch_object())
	{
        header("location:register.php?info=1");	
    }
    else
    {
		$sql = "INSERT INTO user(Email, user_name, contact_no, address, password, admin, credit_card_no, bank)
               VALUES ('$email', '$name', '$phone', '$address', '$password', '$role', '$bankAccount', '$bank')";

        $result = $mysqli->query($sql);
		header("location:login.php");
    }

}


//-------------------------Login----------------------------------------
elseif (isset($_POST['login_action']))
{	
	//$Ic = htmlentities($_POST['Ic'], ENT_QUOTES);
	$name = htmlentities($_POST['name'], ENT_QUOTES);
    $password = htmlentities($_POST['password'], ENT_QUOTES);    
	$role = htmlentities($_POST['role'], ENT_QUOTES);
    
    $sql = "SELECT * FROM user where user_name='$name' AND password='$password' AND admin='$role';";
	
    $result = $mysqli->query($sql);

    if($row = $result->fetch_object()){
			echo "found";
            session_start();

            if($role == '1'){
				$_SESSION["role"] = 'admin';
			}
			elseif($role == '0'){
				$_SESSION["role"] = 'user';
			}
			
            $_SESSION["content"] = $row;
            $_SESSION['code'] = rand(10000,99999);
			
			$user_id = $row->user_id;
			
			$sql = "SELECT * FROM shopping_cart WHERE user_id='$user_id' AND cart_status='pending';";
			$result = $mysqli->query($sql);
	
			if($row = $result->fetch_object()){
				header("location:home.php");
			}
			
			else{
				$sql = "INSERT INTO shopping_cart(cart_status, user_id, total_price, payment_date) 
						VALUES ('pending', '$user_id', '0', NULL);";

				$result = $mysqli->query($sql);
				header("location:home.php");
			}
         
    }
               
    else{
        header("location:login.php");
		echo '<script>alert("Account not exist");</script>';
    }
}


//------------------------Logout--------------------------------------
elseif(isset($_GET["logout"])){
    if($_GET["logout"]=='1'){
        echo '<script>alert("Log Out");</script>';
        session_start();
        session_destroy();
        header("location:home.php");
        exit;
    }
}



//-------------------Update Profile --------------------------------
elseif(isset($_POST["update_action"])){

	$email = htmlentities($_POST['email'], ENT_QUOTES);
	$user_id = htmlentities($_POST['user_id'], ENT_QUOTES);
	$phoneNumber = htmlentities($_POST['phone'], ENT_QUOTES);
	$bank = htmlentities($_POST['bank'], ENT_QUOTES);
	$bankAccount = htmlentities($_POST['bankAccount'], ENT_QUOTES);
    $address = htmlentities($_POST['address'], ENT_QUOTES);
	$old_password = htmlentities($_POST['old_password'], ENT_QUOTES);
	$new_password = htmlentities($_POST['new_password'], ENT_QUOTES);
	$chg = false;
    
	if($old_password != $new_password){
		$chg = true;
	}
	
    if($_SESSION['role'] == 'user'){
		
		if($chg == true){
			$password = htmlentities($_POST['new_password'], ENT_QUOTES);	
			$sql = "UPDATE user SET password='$password', bank='$bank', credit_card_no='$bankAccount', address='$address', contact_no='$phoneNumber' WHERE Email='$email';";
		}
		
		else{
			$sql = "UPDATE user SET bank='$bank', credit_card_no='$bankAccount', address='$address', contact_no='$phoneNumber' WHERE Email='$email';";
		} 
        
        if ($mysqli->query($sql) === TRUE){
            echo 'success update';            
        }
		
        $sql = "SELECT * FROM user where user_id='$user_id';";
        $result = $mysqli->query($sql);
            
        if($row = $result->fetch_object()){
            $_SESSION["content"] = $row;
        }
        header("location:update.php");
    }
	
    elseif($_SESSION['role'] == 'admin'){
        $password = htmlentities($_POST['admin_password'], ENT_QUOTES);
        $sql2 = "UPDATE user SET password='$password', bank='$bank', credit_card_no='$bankAccount', address='$address', contact_no='$phoneNumber' WHERE Email='$email';";
		
		if ($mysqli->query($sql2) === TRUE){
            header("location:user_list.php");            
        }
        
		else{
			header("location:home.php");  
		}
    } 

	else{
		echo 'error';
	}
    
}


//---------------------------Search Book------------------------------------

elseif(isset($_POST["search_action"])){
	
	$search_type = htmlentities($_POST['search_type'], ENT_QUOTES);
	$bookif = htmlentities($_POST['bookif'], ENT_QUOTES);
		
	$sql = "SELECT * FROM book WHERE '$search_type'=%'$bookif'%;";
	$result = $mysqli->query($sql);

	$contents = array();
	while($row = $result->fetch_object())
	{
		array_push($contents,$row);
	}
	
header("location:book_list.php?info=1");	

}


//-----------------------Add Book------------------------------------
elseif (isset($_POST["add_book_action"]))
{	
	//$role = '0';
	$ISBN = htmlentities($_POST['ISBN'], ENT_QUOTES);
	$title = htmlentities($_POST['title'], ENT_QUOTES);
	$author = htmlentities($_POST['author'], ENT_QUOTES);
	$price = htmlentities($_POST['price'], ENT_QUOTES);
	$quantity = htmlentities($_POST['quantity'], ENT_QUOTES);
	$cat = htmlentities($_POST['cat'], ENT_QUOTES);
	$detail = htmlentities($_POST['detail'], ENT_QUOTES);
    
    $sql = "SELECT * FROM book WHERE book_isbn='$ISBN' OR book_title='$title';";
    
    $result = $mysqli->query($sql);
	
	if($row = $result->fetch_object())
	{
        header("location:admin_addbook.php?info=2");	
    }
    else
    {
		$sql = "INSERT INTO book(book_isbn, book_title, book_author, book_categories, book_rating, book_price, book_quantity, book_detail)
               VALUES ('$ISBN', '$title', '$author', '$cat', '0.0', '$price', '$quantity', '$detail')";

        $result = $mysqli->query($sql);
		header("location:admin_addbook.php?info=3");
    }

}


//-------------------Update Book --------------------------------
elseif(isset($_POST["update_book_action"])){
	$book_id = (int)htmlentities($_POST['book_id'], ENT_QUOTES);
    $ISBN = htmlentities($_POST['ISBN'], ENT_QUOTES);
	$title = htmlentities($_POST['title'], ENT_QUOTES);
	$author = htmlentities($_POST['author'], ENT_QUOTES);
	$price = htmlentities($_POST['price'], ENT_QUOTES);
	$quantity = htmlentities($_POST['quantity'], ENT_QUOTES);
	$cat = htmlentities($_POST['cat'], ENT_QUOTES);
    $detail = htmlentities($_POST['detail'], ENT_QUOTES);
    

    $sql = "UPDATE book SET book_isbn='$ISBN', book_title='$title', book_author='$author', book_price='$price', book_quantity='$quantity', book_categories='$cat', book_detail='$detail' WHERE book_id='$book_id';";
	
	$result = $mysqli->query($sql);

    $sql = "SELECT * FROM book where book_id='$book_id';";
    $result = $mysqli->query($sql);
		
		
		if($row = $result->fetch_object()){
            
			//$_BOOK["content"] = $row;
			header("location:admin_editbook.php?info=1&book_id=$book_id");
        }
            
		else{
            header("location:admin_editbook.php?info=2&book_id=$book_id");            
        }
         
}

//-------------------Delete Book --------------------------------
elseif(isset($_POST["delete_book_action"])){
	$book_id = (int)htmlentities($_POST['book_id'], ENT_QUOTES);

    $sql = "DELETE FROM book WHERE book_id='$book_id';";
	
	$result = $mysqli->query($sql);

    $sql = "SELECT * FROM book where book_id='$book_id';";
    $result = $mysqli->query($sql);
		
		
		if($row = $result->fetch_object()){
            
			header("location:book_list.php?info=5");
        }
            
		else{
            header("location:book_list.php?info=6");            
        }
         
}


//-----------------------Add Cart------------------------------------
elseif (isset($_POST["add_cart_action"]))
{	
	//echo "A";
	
	$book_id = htmlentities($_POST['book_id'], ENT_QUOTES);
	$user_id = htmlentities($_POST['user_id'], ENT_QUOTES);
	$email = htmlentities($_POST['email'], ENT_QUOTES);
	$quantity = htmlentities($_POST['quantity'], ENT_QUOTES);
	$price = htmlentities($_POST['price'], ENT_QUOTES);
	$order_quantity = htmlentities($_POST['order_quantity'], ENT_QUOTES);
	$add_date = date("Y-m-d h:i:sa");


	if($order_quantity > $quantity){    //avoid over order 	
		header("location:book_list.php?info=7");
	}
	
	
	else{		
		$sum_price = $price * $order_quantity;
		$new_quantity = $quantity - $order_quantity;		
    
	
		$sql = "SELECT * FROM shopping_cart WHERE user_id='$user_id' AND cart_status='pending';";
		$result = $mysqli->query($sql);
	
	
		if($row = $result->fetch_object()){     
			
			$cart_id = $row->cart_id;
			$total_price = $row->total_price;
			$new_total_price = $total_price + $sum_price;
			
			$sql = "SELECT * FROM book_in_cart WHERE cart_id='$cart_id' AND book_id='$book_id';"; 
			$result = $mysqli->query($sql);
		
		
			if($row = $result->fetch_object()){        //same book already appear in cart
				
				$bic_quantity = $row->quantity;
				$newbic_quantity = $bic_quantity + $order_quantity;
				
				$bic_price = $row->sum_price;
				$newbic_price = $bic_price + $sum_price;
				
				$sql = "UPDATE book_in_cart SET quantity='$newbic_quantity', sum_price='$newbic_price' WHERE cart_id='$cart_id' AND book_id='$book_id';";
			
				$result = $mysqli->query($sql);	
			}
			
			
			else{       //add new book in cart
				
				$sql = "INSERT INTO book_in_cart(cart_id, book_id, quantity, sum_price, add_date) 
						VALUES ('$cart_id', '$book_id', '$order_quantity', '$sum_price', '$add_date');";
						
				$result = $mysqli->query($sql);	
			}	
			
			
			$sql = "UPDATE shopping_cart SET total_price='$new_total_price' WHERE cart_id='$cart_id';";
			
			$result = $mysqli->query($sql);		
					
			$sql = "UPDATE book SET book_quantity='$new_quantity' WHERE book_id='$book_id';";
			
			$result = $mysqli->query($sql);
			
			header("location:book_list.php?info=2");	
			
		}
			
		else{
			header("location:book_list.php?info=3");
		}
	}
	
}

//-------------------Confirm Order --------------------------------
elseif(isset($_POST["admin_confirm_action"])){
	$cart_id = (int)htmlentities($_POST['cart_id'], ENT_QUOTES);

    $sql = "UPDATE shopping_cart SET cart_status = 'confirmed' WHERE cart_id='$cart_id';";
	
	$result = $mysqli->query($sql);

    if ($mysqli->query($sql) === TRUE){
       header("location:admin_order_list.php?info=1");
    }
		
	else{
        header("location:admin_order_list.php?info=2");            
    }
         
}



//-------------------------Purchase Book----------------------------------------
elseif (isset($_POST['payment_action']))
{	
	$user_id = htmlentities($_POST['user_id'], ENT_QUOTES);
	$cart_id = htmlentities($_POST['cart_id'], ENT_QUOTES);
    $password = htmlentities($_POST['password'], ENT_QUOTES);    
	$credit_card_no = htmlentities($_POST['credit_card_no'], ENT_QUOTES);
	$payment_date = date("Y-m-d h:i:sa");
    
    $sql = "SELECT * FROM user where password='$password' AND credit_card_no='$credit_card_no' AND user_id='$user_id';";
	
    $result = $mysqli->query($sql);

    if($row = $result->fetch_object()){
			
		$sql = "UPDATE shopping_cart SET cart_status='paid', payment_date='$payment_date' WHERE user_id='$user_id' AND cart_id='$cart_id';";
		$result = $mysqli->query($sql);	
	}
	
    if ($mysqli->query($sql) === TRUE){
		
		$sql2 = "INSERT INTO shopping_cart(cart_status, user_id, total_price, payment_date) 
				 VALUES ('pending', '$user_id', '0', NULL);";

		$result2 = $mysqli->query($sql2);
				
        header("location:my_cart.php?info=1");
    }
		
	else{
        header("location:my_cart.php?info=2");            
    }
 
}

//-------------------Rate Book--------------------------------
elseif(isset($_POST["rate_book_action"])){
	$rate = (int)htmlentities($_POST['rate'], ENT_QUOTES);
	$book_id = (int)htmlentities($_POST['book_id'], ENT_QUOTES);
	
	$sql = "SELECT * FROM book where book_id='$book_id';";
	
    $result = $mysqli->query($sql);
	
	if($row = $result->fetch_object()){        		
			$book_rating = $row->book_rating;
			$book_rating_time = $row->book_rating_time;
	}	
	
	if($book_rating==0){
		$new_rating = $rate;
		$t = 1;
	}
	
	else{
		$r = $book_rating * $book_rating_time;
		$r = $r + $rate;
		$t = $book_rating_time + 1;
			
		$r = $r/$t;
		$new_rating = number_format($r,2);
		
	}
	
			
	$sql = "UPDATE book SET book_rating='$new_rating', book_rating_time='$t' WHERE book_id='$book_id';";
		
	$result = $mysqli->query($sql);	
	
	if ($mysqli->query($sql) === TRUE){
       header("location:book_detail.php?info=1&book_id=$book_id");
    }
		
	else{
        header("location:book_detail.php?info=2&book_id=$book_id");            
    }
}



else{
    header("location:home.php");
}

$mysqli->close();
?>
