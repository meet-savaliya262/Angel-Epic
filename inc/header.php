<?php
   if (session_status() === PHP_SESSION_NONE) {
      session_start();
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>lighten</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
    <!-- other meta and link tags -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">


      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
       <link rel="stylesheet" href="css/owl.carousel.min.css"/>
  <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
      
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader --> 
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="head_top">
               <div class="container">
                  <div class="row">
                    <div class="col-md-4 offset-5">
                       <div class="top-box">
                        <ul class="sociel_link">
                           <li> <a href="https://www.facebook.com"> <i class="fa-brands fa-facebook"></i>   </a></li>
                           <li> <a href="https://www.twitter.com">  <i class="fa-brands fa-twitter"></i>   </a></li>
                           <li> <a href="https://www.whatsapp.com">  <i class="fa-brands fa-whatsapp"></i>  </a></li>
                           <li> <a href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                  </div>
                 
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo anglelogo"> <a href="index.php"><img src="images/logo2.png" alt="logo" /></a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <?php
                              $currentPage = basename($_SERVER['PHP_SELF']); // current page name like "product.php"
                           ?>

                              <ul class="menu-area-main">
                                 <li class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">
                                    <a href="index.php">Home</a>
                                 </li>

                                 <li class="<?= ($currentPage == 'product.php') ? 'active' : '' ?>">
                                    <a href="product.php">Product</a>
                                 </li>

                                 <li class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>">
                                    <a href="about.php">About</a>
                                 </li>

                                 <li class="<?= ($currentPage == 'contact.php') ? 'active' : '' ?>">
                                    <a href="contact.php">Contact</a>
                                 </li>

                                 <li class="<?= ($currentPage == 'orders.php') ? 'active' : '' ?>">
                                    <a href="orders.php">Orders</a>
                                 </li>

                                 <li class="<?= ($currentPage == 'cart.php') ? 'active' : '' ?>">
                                    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                                 </li>

                                 <li>
                                    <a onclick="openSearch()" href="#"><i class="fa-solid fa fa-search"></i></a>
                                 </li>
                              </ul>

                        </nav>
                     </div>
                  </div>
               </div>
                     
                <div id="searchOverlay" class="search-overlay">
                  <span class="close-btn" onclick="closeSearch()">&times;</span>
                  <form class="search-container" action="search_products.php" method="get">
                     <input type="text" name="s" placeholder="Search Products..." required>
                     <button type="submit"><i class="fas fa-search"></i></button>
                  </form>
               </div>

               
               <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <li>
                     <?php
                        if (isset($_SESSION['client']['status']) && $_SESSION['client']['status'] === true) {
                           echo '<a class="buy" href="logout.php">Logout</a>';
                        } else {
                           echo '<a class="buy" href="login.php">Login</a>';
                        }
                     ?>
                  </li>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
  $(document).ready(function () {
    $('#close-search').click(function () {
      $('#search-overlay').fadeOut();
    });

    $(document).on('keydown', function (e) {
      if (e.key === "Escape") {
        $('#search-overlay').fadeOut();
      }
    });
  });

  function openSearch() {
  document.getElementById("searchOverlay").classList.add("active");
  setTimeout(() => {
    document.querySelector("#searchOverlay input").focus();
  }, 300);
}

function closeSearch() {
  document.getElementById("searchOverlay").classList.remove("active");
}

// Close on ESC key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closeSearch();
  }
});
</script>


















