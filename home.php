<?php
  session_start();
   include_once('inc.php');
   $_SESSION['myID']; 

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container">
       <div class="jumbotron jumbotron-sm m-0 p-0">
           <div class="jumbotron jumbotron h-25 p-1 my-1">
             <div class="container">
                <h1 class="display-4 text-uppercase align-top">MoblieMBD.com</h1>
                <p class="lead">E-mail: nasir24k@gmail.com</p>
         </div>
      </div>
  <hr/>

		<div class="container my-0">	
		     <nav class="navbar">
					 <a href="home.php" class="btn btn-outline-secondary btn-sm" >Home</a>
					 <a href="home.php" class="btn btn-outline-secondary btn-sm" >Contact</a>
					 <a href="home.php" class="btn btn-outline-secondary btn-sm" >About us</a>
					 <a href="home.php" class="btn btn-outline-secondary btn-sm" >Sign-in</a>
					 <a href="home.php" class="btn btn-outline-secondary btn-sm" >Sign-up</a>
					 <a href="checkout.php" class="btn btn-outline-secondary btn-sm"  target="showda">checkout</a>
				 <form class="form-inline my-2 my-lg-0">
					  <input class="form-control mr-sm-2 btn-sm" type="search" placeholder="Search" aria-label="Search">
					  <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit">Search</button>
				</form>
			</nav>	
		</div>
 <hr/>
		<div class="row">
			<div class="col-2">
				<h1 class="align-top mb-2 ml-4">Brands</h1>
				<hr/>
				<ul lass="list-group">
						<?php
							$result=mysqli_query($db,"SELECT * FROM category_info ORDER BY `cat_name`");
							while($row=mysqli_fetch_row($result))
							{
							print '<li style="list-style: none"><a  class="list-group-item list-group-item-action"     href="showproduct.php?ID='.$row[0].'" target="showda">'.$row[1].'</a></li>';
							}
						?>
				</ul>
		    </div>
				   <div class="embed-responsive embed-responsive-21by9 col-10">
						<iframe class="embed-responsive-item position-absolute" src='showproduct.php' allowfullscreen name='showda'></iframe>
					</div>
		     </div>
		<hr>
<!-- Footer -->
<footer class="page-footer font-small mdb-color pt-4">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">MobileMBD.com</h6>
        <p>Address: Uttora Badda,Gulshan-1,Dhaka-1212</p>
         <p>+8801725-874024</p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
        <p>
          <a href="#!">MDBootstrap</a>
        </p>
        <p>
          <a href="#!">MDWordPress</a>
        </p>
        <p>
          <a href="#!">BrandFlow</a>
        </p>
        <p>
          <a href="#!">Bootstrap Angular</a>
        </p>
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
        <p>
          <a href="#!">Your Account</a>
        </p>
        <p>
          <a href="#!">Become an Affiliate</a>
        </p>
        <p>
          <a href="#!">Shipping Rates</a>
        </p>
        <p>
          <a href="#!">Help</a>
        </p>
      </div>

      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
        <p>
          <i class="fas fa-home mr-3"></i> UTTOR BADDA, GULSHAN-1, DHAKA-1212</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> nasir24k@gmail.com</p>
        <p>
          <i class="fas fa-phone mr-3"></i> +8801725-874024</p>
        <p>
          <i class="fas fa-print mr-3"></i> +8801682-122565</p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Footer links -->

    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-7 col-lg-8">

        <!--Copyright-->
        <p class="text-center text-md-left">© 2020 Copyright:
          <a href="home.php">
            <strong> MobileMBD.com</strong>
          </a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-5 col-lg-4 ml-lg-0">

        <!-- Social buttons -->
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-white-slight mx-1">
                <i class="fab fa-google-plus-g"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-floating btn-sm rgba-black-slight mx-1">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

</footer>
<!-- Footer -->
  </div>	
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>