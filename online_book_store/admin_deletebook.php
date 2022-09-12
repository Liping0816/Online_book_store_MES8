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

$cats = array('Academic', 'Technology', 'Language', 'Recipe','Novel','Others');



?>

<link rel="stylesheet" href="./css/request.css">
<style>
input{
    width:60%;
}
</style>

<html style="background-color: #1abc9c;">
<head>
    <title>Delete Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>

<form name='myForm' method='POST' action="action_page.php">
  <div class="container">
    <h1>Book Information</h1>
    
    <hr/>
   
    <div id='delete_form' class='box' style='width:100%'>
		<input hidden name="book_id" value="<?php echo $book_id;?>"/>
        
        <label for="ISBN"><b>Book ISBN</b></label>
        <input type="text" name="ISBN" id="ISBN" value="<?php echo $ISBN;?>" readonly />     
     
        <label for="title"><b>Title</b></label>
        <input type="text" name="title" id="title" value="<?php echo $title;?>" readonly />

		<label for="author"><b>Author</b></label>
        <input type="text" name="author" id="author" value="<?php echo $author;?>" readonly />

        <label for="price"><b>Price</b></label>
        <input type="text" name="price" id="price"value="<?php echo $price;?>" readonly />
		
		<label for="quantity"><b>Quantity</b></label>
        <input type="text" name="quantity" id="quantity"value="<?php echo $quantity;?>" readonly />
        
		<label for="cat"><b>Categories</b></label>
        <input type="text" name="cat" id="cat" value="<?php echo $thiscat;?>" readonly />
		
        <label for="detail"><b>Detail</b></label>
        <input type="text" name="detail" id="detail" value="<?php echo $detail;?>" readonly />
      
 
        <hr/>
        
        <div class = 'button_section'>
            <button type="submit" name='delete_book_action' class='btn btn-danger' >Confirm Delete</button>			
			<button type="submit" name='edit_book' class='btn btn-success' formaction='admin_editbook.php' ;> Edit </button>
            <button type="button" name='back' class='btn btn-danger' onclick='window.location = "book_list.php";'>Back</button>
        </div>    
    </div>    
  </div>  
</form>

</body>
</html>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>


</script>