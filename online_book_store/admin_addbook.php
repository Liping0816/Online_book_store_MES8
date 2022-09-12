<?php
include('conn.php');
include 'header.php';

if(isset($_GET["info"])){
    if($_GET["info"]=='2'){
        echo '<script>alert("Book with same ISBN or Title already exist");</script>';
    }
	elseif($_GET["info"]=='3'){
        echo '<script>alert("Add Success");</script>';
    }
}

$cats = array('Academic', 'Technology', 'Language', 'Recipe','Novel','Others');

?>

<html style="background-color: #1abc9c;">
<head>
    <title>Add_Book_Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        <?php include './css/register.css' ?>
    </style>
</head>
<body>

<form name='myForm' method='POST' action="action_page.php" onsubmit="return validation();">
 <div class="container">
    <h1>Add New Book</h1>
    <hr/>
    
    <div id='add_book_form'>
        <p>Please fill in this form to create a new book.</p>
		
		<label for="ISBN"><b>Book ISBN</b></label>
        <p id='ISBN_warning_1' class='warning hidden'>Please fill in Book ISBN</p>
        <input type="text" placeholder="Enter Book ISBN" name="ISBN" id="ISBN">
        
        <label for="title"><b>Title</b></label>
        <p id='title_warning_1' class='warning hidden'>Please fill in the title</p>
        <input type="text" placeholder="Enter Book Title" name="title" id="title">
        
		<label for="author"><b>Author</b></label>
        <p id='author_warning_1' class='warning hidden'>Please fill in the author</p>
        <input type="text" placeholder="Enter Book Author" name="author" id="author">

        <label for="price"><b>Price</b></label>
        <p id='price_warning_1' class='warning hidden'>Please fill in the price (RM)</p>
        <input type="text" placeholder="Enter Book Price" name="price" id="price">
        
		<label for="quantity"><b>Quantity</b></label>
        <p id='quantity_warning_1' class='warning hidden'>Please fill in the quantity of book</p>
        <input type="text" placeholder="Enter Book Quantity" name="quantity" id="quantity" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" />
		
		<label for='cat'><b>Select Book's Category</b></label>
        <select id='cat' name='cat'>
            <?php foreach($cats as $cat){
                $option = "<option value='$cat'>$cat</option>";
                echo $option;
            }
            ?>
        </select>
		
        <label for="detail"><b>Detail</b></label>
        <p id='detaiil_warning_1' class='warning hidden'>Please fill in the detail</p>
        <input type="text" placeholder="Enter Book Detail" name="detail" id="detail">
        

        <hr/>
        
        
    <button type="submit" name='add_book_action' class="addbtn">Add Book</button>
	<button type="button" name='add_book_action' class="addbtn" onclick='window.location = "book_list.php";'>Back to List</button>
    
    </div>
    
  </div>
  
</form>

</body>
</html>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script>
var rad = document.myForm.role;
var prev = null;
var role = null;


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