<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php
include('conn.php');

include 'header.php'; 

$user_id = $_SESSION['content']->user_id;

$sql = "SELECT * FROM shopping_cart WHERE user_id='$user_id' AND total_price != '0';";
$result = $mysqli->query($sql);
$contents = array();

while($row = $result->fetch_object())
{
	array_push($contents,$row);
}

if(isset($_GET["info"])){
    if($_GET["info"]=='1'){
        echo '<script>alert("Pay Successfully.");</script>';
    }
    elseif($_GET["info"]=='2'){
        echo '<script>alert("Payment Fail.");</script>';
    }
}


?>
   
<html>
    <head>
        <title>My Cart</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>

    
    <h2  style="margin:10px 90px">My Cart</h2>
	<div>
 
	</br>
    <center>
        <table class="table table-hover table-striped" style='width:90%'>
            <tr>
			
                <th style="width:3%">No.</th>
                <th style="width:3%">ID</th>
                <th style="width:30%">Book (Title x Quantity x Singel Price)</th>
                <th style="width:8%">Total</th>
				<th style="width:8%">Status</th>
				<th style="width:15%"><center>Payment Date</th>

                <th/>
			
            </tr>
            <?php 
            $n = 0;
            
            foreach($contents as $content){
               
				$cart_id = $content->cart_id;
				$cart_status = $content->cart_status;
				$price = $content->total_price;
                $n+=1;?>
                <form method=POST action='action_page.php'>
                <input hidden name='user_id' value='<?php echo $content->user_id;?>'/>
				<input hidden name='cart_id' value='<?php echo $content->cart_id;?>'/>
     
                <tr>
                    <td><center><?php echo $n; ?></center></td>
					<td><?php echo $content->cart_id; ?></td>
					<td><?php
					
					$sql2 = "SELECT * FROM book_in_cart WHERE cart_id='$cart_id';";
					$result2 = $mysqli->query($sql2);
					$books = array();

					while($row2 = $result2->fetch_object())
					{
						array_push($books,$row2);
					}
					
					foreach($books as $book){ 
						$book_id = $book->book_id;
						$book_quantity = $book->quantity;
						
						$sql3 = "SELECT * FROM book WHERE book_id='$book_id';";
						$result3 = $mysqli->query($sql3);
						
						if($row3 = $result3->fetch_object()){
            
							$book_title = $row3->book_title;
							$book_price = $row3->book_price;
        
						}
						?>
						
						<p><?php echo $book_title; ?> x <?php echo $book_quantity;?> x RM <?php echo $book_price;?></p>
						
					<?php	
					}	
					?>
					
					</td>
					<td>RM <?php echo $content->total_price; ?></td>
					<td><?php echo $content->cart_status; ?></td>
					<td><center><?php echo $content->payment_date; ?></center></td>

                    <td>
                    <center>
				
						<?php
						if($cart_status=="pending"&&$price!="0"){?>
							<button class='btn btn-success' name='payment' type="submit"  formaction='payment.php'> Pay </button>
						
						<?php  
						} ?>
					
                    </center>
                    </td>
                </tr>
                </form>
            <?php }
            if($n == 0)echo "<td/><td/><td/><td/><td/><td/><td/><td/><td/>";?>
            
        </table>
    </center>

    <?php include 'footer.php'; ?>

    </body>
    
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

    <script>
	
	function confirmation(){
        if (window.confirm("Do you want to do it?")) { 
            return true;
        }
        else return false;
    }
	
    </script>
</html>
