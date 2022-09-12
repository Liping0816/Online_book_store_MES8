<link rel="stylesheet" href="./css/listpage.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <div class="header" style='padding: 5px 80px;'>
        <h1 style='font-weight: bold; text-shadow: 1px 1px black'>ONLINE BOOK STORE</h1>
        <p style='font-weight: bold; text-shadow: 1px 1px black'>Buy Books Online</p>
  <!--      <div center>
            <img class="mySlides" src="img/header01.jpg" style="height:400px;width:100%;max-height:100%">
            <img class="mySlides" src="img/header02.jpg" style="height:400px;width:100%;max-height:100%">
            <img class="mySlides" src="img/header03.jpg" style="height:400px;width:100%;max-height:100%">
			<img class="mySlides" src="img/header04.jpg" style="height:400px;width:100%;max-height:100%">
        </div>
-->
    </div>

<div class="navbar">
    <a href="home.php">| Home |</a>
	<a href="book_list.php">| Book |</a>
	
    <?php
    session_start();
    
    if(isset($_SESSION["role"])){
        if($_SESSION["role"]=='admin'){
            echo '<a href="admin_addbook.php">| Add Book |</a>';
			echo '<a href="user_list.php">| User List |</a>';
			echo '<a href="admin_order_list.php">| Order List |</a>';
        }
 
        elseif($_SESSION["role"]=='user'){
            echo '<a href="my_cart.php">| My Cart |</a>';
			echo '<a href="update.php">| My Profile |</a>';
        }
        echo '<a href="action_page.php?logout=1" class="right">Logout</a>';
        
    }
    else{
        echo '<a href="login.php" class="right">Sign in</a>';
        echo '<a href="register.php" class="right">Register</a>';
    }

    
    ?>
</div>

<script>
// Automatic Slideshow - change image every 3 seconds
var myIndex = 0;
carousel();

function carousel() {
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