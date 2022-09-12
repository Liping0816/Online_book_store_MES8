<?php

include 'conn.php';

if(isset($_GET["info"])){
	if($_GET["info"]=='1'){
        echo '<script>alert("Rate Success");</script>';
		$book_id = htmlentities($_GET['book_id'], ENT_QUOTES);
    }
	
	elseif($_GET["info"]=='2'){
        echo '<script>alert("Rate Fail");</script>';
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
	$cat = $row->book_categories;
	$rating = $row->book_rating;
	$detail = $row->book_detail;
}

$rates = array('5', '4', '3', '2', '1');

?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <title>home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <link rel="stylesheet" type="text/css" href="./css/home.css">
  <body>

    <?php include 'header.php'; ?>

    <div class="row" style= 'margin:20px;'>
          <div class="side">
              <h2>Book</h2>
              <p>What you think about this book?</p>
			  
			  <form method=POST action='action_page.php'>
              <input hidden name='book_id' value='<?php echo $book_id;?>'/>
			  
		<?php   if(isset($_SESSION["role"])){
						
					if($_SESSION["role"]=='user'){ ?>
						
						<label for='rate'><b>Rate the book?(5~1 stars)</b></label>
						<br/>
						<select id='rate' name='rate'>
							<?php foreach($rates as $rate){
								$option = "<option value='$rate'>$rate</option>";
								echo $option; 
							}
							?>
						</select>
						<br/><br/>
						<button class='btn btn-success' name='rate_book_action' type="submit" > Submit Rating </button>
						<br/><br/>
						<button class='btn btn-success' name='add_cart' type="submit"  formaction='add_cart.php'> Add to Cart </button>
						
					<?php  }
							
					elseif($_SESSION["role"]=='admin'){ ?>
						<button class='btn btn-success' name='edit_book' type="submit" formaction='admin_editbook.php'> Edit </button>
						<br/><br/>
						<button class='btn btn-danger' name='delete_book' type="submit" formaction='admin_deletebook.php'> Delete </button>
					<?php  }
					} ?>
		
			  </form>

			
          </div>
          <div class="main">
              <h2>Book Detail</h2>
              <h3><?php echo $title; ?></h3>
              <div class="fakeimg" style="height:300px;">
                <img class="fakeimg" src="img/book_detail01.jpg" style="height:350px;">
              </div>
              <br/>
			  <br/>
			  <br/>
              <p style="font-size:130%;"><b>Book ISBN: </b><?php echo $ISBN; ?></p>
              <p style="font-size:130%;"><b>Book Title: </b><?php echo $title; ?></p>
			  <p style="font-size:130%;"><b>Book Author: </b><?php echo $author; ?></p>
			  <p style="font-size:130%;"><b>Book Price: RM <?php echo $price; ?></b></p>
			  <p style="font-size:130%;"><b>Book Categories: </b><?php echo $cat; ?></p>
			  <p style="font-size:130%;"><b>Book Rate: </b><?php echo $rating; echo ' Stars';?></p>
			  <p style="font-size:130%;"><b>Book Description: </b><?php echo $detail; ?></p>
              <br/>
        </div>
    </div>

    <?php include 'footer.php';?>

  </body>
</html>