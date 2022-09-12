<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php
include('conn.php');

include 'header.php'; 

if(isset($_GET["info"])){
	if($_GET["info"]=='2'){
        echo '<script>alert("Add to cart success");</script>';
    }
	
	elseif($_GET["info"]=='3'){
        echo '<script>alert("Add to cart fail");</script>';
    }
 
}


else{
	$sql = "SELECT * FROM book;";
	$result = $mysqli->query($sql);
}

$contents = array();
while($row = $result->fetch_object())
{
	array_push($contents,$row);
}

?>
   
<html>
    <head>
        <title>Book_list</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>

    
    <h2  style="margin:10px 90px">Book List</h2>
	<div>
    <form id='search_form' method='POST' action="book_list.php">
	
        <label for='search_type'><b>Select the way you search :</b></label>
		
        <select id='search_type' name='search_type'>
            <?php foreach($searchs as $search){
                $option = "<option value='$search'>$search</option>";
                echo $option;
            } ?>
		</select>
				
		<p align="center" id='keyword_warning_1' class='warning hidden'>Please fill in content</p>
		<input name="keyword" id="keyword" class="un" type="text" align="center" placeholder= "keyword">
		<?php $keyword='keyword' ?>
		
		</select>
		
		<button type="submit" name='search_action' class="searchbtn" onclick='window.location=book_list.php?info=7&search=$option&keyword=$keyword'>Search</button>
	</form>	
    </div>
	</br>
    <center>
        <table class="table table-hover table-striped" style='width:90%'>
            <tr>
			
                <th style="width:3%">No.</th>
                <th style="width:10%">ISBN</th>
                <th style="width:15%">Title</th>
                <th style="width:15%">Author</th>
				<th style="width:10%">Category</th>
				<th style="width:5%">Rating</th>
				<th style="width:8%"><center>Price</center></th>
                <th style="width:5%">Quantity</th>

                <th/>
			
            </tr>
            <?php 
            $n = 0;
            
            foreach($contents as $content){
                /*onclick="window.location.assign('action_page.php?edit=<?php echo $content->book_id;?>')" ;*/
                $n+=1;?>
                <form method=POST action='action_page.php'>
                <input hidden name='book_id' value='<?php echo $content->book_id;?>'/>
				<input hidden name='detail' value='<?php echo $content->book_detail;?>'/>
     
                <tr>
                    <td><center><?php echo $n; ?></center></td>
					<td><?php echo $content->book_isbn; ?></td>
					<td><?php echo $content->book_title; ?></td>
					<td><?php echo $content->book_author; ?></td>
					<td><?php echo $content->book_categories; ?></td>
					<td><center><?php echo $content->book_rating; ?></center></td>
                    <td><center>RM <?php echo $content->book_price; ?></center></td>
                    <td><center><?php echo $content->book_quantity; ?></center></td>
                    
                    <td>
                    <center>
					
                        <button class='btn btn-success' name='book_detail' type="submit" formaction='book_detail.php'>Detail</button>
						<?php
						if(isset($_SESSION["role"])){?>
							<button class='btn btn-success' name='add_cart' type="submit"  formaction='add_cart.php'> Add to Cart </button>
							
							<?php if($_SESSION["role"]=='admin'){ ?>
								<button class='btn btn-success' name='edit_book' type="submit" formaction='admin_editbook.php'> Edit </button>
								<button class='btn btn-danger' name='delete_book' type="submit" formaction='admin_deletebook.php'> Delete </button>
							<?php  
							}
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
