<?php

include 'conn.php';
session_start();

if(isset($_GET["info"])){
    if($_GET["info"]=='1'){
        echo '<script>alert("Update Successfully.");</script>';
		$book_id = htmlentities($_GET['book_id'], ENT_QUOTES);
    }
    elseif($_GET["info"]=='2'){
        echo '<script>alert("Update Fail.");</script>';
		$book_id = htmlentities($_GET['book_id'], ENT_QUOTES);
    }
	elseif($_GET["info"]=='3'){
        echo '<script>alert("Update from detail.");</script>';
		$book_id = htmlentities($_GET['book_id'], ENT_QUOTES);
    }
}

else{
	$book_id = htmlentities($_POST['book_id'], ENT_QUOTES);
}
   
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
    <title>Update Book Info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/register.css">
</head>
<body>

<form name='myForm' method='POST' action="action_page.php" onsubmit="return validation();">
  <div class="container">
    <h1>Book Information</h1>
    
    <hr/>
   
    <div id='update_form' class='box' style='width:100%'>
		<input hidden name="book_id" value="<?php echo $book_id;?>"/>
        
        <label for="ISBN"><b>Book ISBN</b></label>
		<p id='ISBN_warning_1' class='warning hidden'>Please fill in ISBN</p>
        <input type="text" placeholder="Update ISBN" name="ISBN" id="ISBN" value="<?php echo $ISBN;?>"/>     
     
        <label for="title"><b>Title</b></label>
		<p id='title_warning_1' class='warning hidden'>Please fill in title</p>
        <input type="text" placeholder="Update Title" name="title" id="title" value="<?php echo $title;?>"/>

		<label for="author"><b>Author</b></label>
		<p id='author_warning_1' class='warning hidden'>Please fill author</p>
        <input type="text" placeholder="Update Author" name="author" id="author" value="<?php echo $author;?>"/>

        <label for="price"><b>Price</b></label>
        <p id='price_warning_1' class='warning hidden'>Please fill in the price</p>
        <input type="text" placeholder="Update Price" name="price" id="price"value="<?php echo $price;?>" />
		
		<label for="quantity"><b>Quantity</b></label>
        <p id='quantity_warning_1' class='warning hidden'>Please fill in the quantity</p>
        <input type="text" placeholder="Update Quantity" name="quantity" id="quantity"value="<?php echo $quantity;?>" />
        
		<label for='cat'><b>Select Categories</b></label>
        <select id='cat' name='cat'>
            <?php foreach($cats as $cat){
                if($cat == $thiscat)$option = "<option value='$cat' selected>$cat</option>";
                else $option = "<option value='$cat'>$cat</option>";
                echo $option;
            }
            ?>
        </select>
		
        <label for="detail"><b>Detail</b></label>
        <p id='detail_warning_1' class='warning hidden'>Please fill in the book detail</p>
        <input type="text" placeholder="Update Book Detail" name="detail" id="detail" value="<?php echo $detail;?>" />
      
 
        <hr/>
        
        <div class = 'button_section'>
            <button type="submit" name='update_book_action' class="registerbtn" style = 'margin:5px;'>Save</button>
            <button type="button" name='back' class="registerbtn" style='background-color: red; margin: 5px;'onclick='window.location = "book_list.php";'>Back</button>
        </div>    
    </div>    
  </div>  
</form>

</body>
</html>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>


document.getElementById("ISBN").onchange = function() {
    if (!this.value)$("#ISBN_warning_1").show();
    else $("#ISBN_warning_1").hide();
};

document.getElementById("title").onchange = function() {
    if (!this.value)$("#title_warning_1").show();
    else $("#title_warning_1").hide();
};

document.getElementById("author").onchange = function() {
    if (!this.value)$("#author_warning_1").show();
    else $("#author_warning_1").hide();
};

document.getElementById("price").onchange = function() {
    if (!this.value)$("#price_warning_1").show();
    else $("#price_warning_1").hide();
};

document.getElementById("quantity").onchange = function() {
    if (!this.value)$("#quantity_warning_1").show();
    else $("#quantity_warning_1").hide();
};

document.getElementById("detail").onchange = function() {
    if (!this.value)$("#detail_warning_1").show();
    else $("#detail_warning_1").hide();
};


function validation(){
    var val = true;
    
    if(!document.getElementById("ISBN").value){$("#ISBN_warning_1").show(); val = false;}
	if(!document.getElementById("title").value){$("#title_warning_1").show(); val = false;}
    if(!document.getElementById("author").value){$("#author_warning_1").show(); val = false;}
    if(!document.getElementById("price").value){$("#price_warning_1").show(); val = false;}
	if(!document.getElementById("quantity").value){$("#quantity_warning_1").show(); val = false;}
    if(!document.getElementById("detail").value){$("#detail_warning_1").show(); val = false;}  
 
   
    if(val!=true){
        alert('Please fill in all the blank');
	}
    
    return val;
}

</script>