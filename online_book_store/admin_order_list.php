<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php
include('conn.php');
include 'header.php';

if(!isset($_SESSION['role'])){
    header("location:login.php");
}

if($_SESSION['role'] != 'admin'){
    header("location:home.php");
    exit;
}

if(isset($_GET["info"])){
	if($_GET["info"]=='1'){
        echo '<script>alert("Confirm success");</script>';
    }
	
	elseif($_GET["info"]=='2'){
        echo '<script>alert("Confirm action error");</script>';
    }
}

if(isset($_GET["group"])){
    $specific = $_GET["group"];
    $sql = "SELECT * FROM shopping_cart WHERE cart_status='$specific' AND total_price != '0';";
}

else {
    $specific = '';
    $sql = "SELECT * FROM shopping_cart WHERE total_price != '0';";
}

$result = $mysqli->query($sql);

$contents = array();
while($row = $result->fetch_object()){
    array_push($contents,$row);
}
?>

<html>
    <head>
        <title>admin_order_list</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>

    <h2 style='margin:10px 90px;'>Order List</h2>
    <table style='margin:10px 90px; width:90%'>
        <tr style='width:5%'>
            <td style="width:15%"><center><a href='admin_order_list.php'>All</center></td>
            <td style="width:15%"><center><a href='admin_order_list.php?group=pending'>Pending</center></td>
            <td style="width:15%"><center><a href='admin_order_list.php?group=paid'>Wait For Confirm (Paid)</center></td>
			<td style="width:15%"><center><a href='admin_order_list.php?group=confirmed'>Confimed</center></td>
            <td style="width:20%"/>
        </tr>
    </table>
    

    <center>
        <table class="table table-hover table-striped" style='width:90%'>
            <tr>
			
                <th style="width:3%">No.</th>
                <th style="width:8%">Cart ID</th>
				<th style="width:8%">User ID</th>
                <th style="width:30%">Book (Title x Quantity x Singel Price)</th>
                <th style="width:8%">Total</th>
				<th style="width:8%">Status</th>
				<th style="width:18%"><center>Payment Date</th>

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
                <input hidden name='cart_id' value='<?php echo $content->cart_id;?>'/>
                
                <tr>
                    <td><center><?php echo $n; ?></center></td>
					<td><center><?php echo $content->cart_id; ?></center></td>
					<td><center><?php echo $content->user_id; ?></center></td>
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
					<td><center><?php echo $content->cart_status; ?></center></td>
					<td><center><?php echo $content->payment_date; ?></center></td>
                    <td>
                        <center>
                            <?php
						if($cart_status=="paid"&&$price!="0"){?>
							<button class='btn btn-success' name='admin_confirm_action' type="submit" > Confirm </button>
						
						<?php  
						} ?>
                        </center>
                    </td>
                </tr>
                </form>
            <?php }?>        
        </table>
    </center>

    <?php include 'footer.php'; ?>

    </body>
    
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

    <script>
    // Automatic Slideshow - change image every 3 seconds
    var myIndex = 0;
    carousel();

    function carousel(){
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";
        }   
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 3000);
    }
    </script>
</html>
