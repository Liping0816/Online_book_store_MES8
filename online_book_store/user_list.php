<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php
include('conn.php');

include 'header.php'; 

$sql = "SELECT * FROM user;";
$result = $mysqli->query($sql);

$contents = array();
while($row = $result->fetch_object())
{
	array_push($contents,$row);
}

?>
   
<html>
    <head>
        <title>User list</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>

    <h2  style="margin:10px 90px">User List</h2>
	<div>
	
	</br>
    <center>
        <table class="table table-hover table-striped" style='width:90%'>
            <tr>
			
                <th style="width:3%"><center>No.</th>
                <th style="width:3%"><center>ID</th>
                <th style="width:15%"><center>Email</th>
                <th style="width:15%"><center>Name</th>
				<th style="width:5%"><center>Contact No</th>
				<th style="width:15%"><center>Address</th>
				<th style="width:8%"><center>Card No</center></th>
                <th style="width:8%"><center>Bank</th>
				<th style="width:7%"><center>Password</th>
				<th style="width:2%"><center>Admin?</center></th>

                <th/>
			
            </tr>
            <?php 
            $n = 0;
            
            foreach($contents as $content){
                $n+=1;?>
                <form method=POST action='action_page.php'>    
				<input hidden name='user_id' value='<?php echo $content->user_id;?>'/>		
				
                <tr>
                    <td><center><?php echo $n; ?></center></td>
					<td><center><?php echo $content->user_id; ?></td>
					<td><center><?php echo $content->Email; ?></td>
					<td><center><?php echo $content->user_name; ?></td>
					<td><center><?php echo $content->contact_no; ?></td>
					<td><center><?php echo $content->address; ?></center></td>
                    <td><center><?php echo $content->credit_card_no?></center></td>
                    <td><center><?php echo $content->bank; ?></center></td>
					<td><center><?php echo $content->password; ?></center></td>
					<td><center><?php echo $content->admin; ?></center></td>
                    
                    <td>
                    <center>
					
                        <button class='btn btn-success' name='update' type="submit" formaction='update.php'>Detail</button>
						
                    </center>
                    </td>
                </tr>
                </form>
            <?php }
            if($n == 0)echo "<td/><td/><td/><td/><td/><td/><td/><td/><td/><td/>";?>
            
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
