<?php
      include("inc/header.php");

?>
      <!-- end header -->
      <section class="slider_section">
         <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">

            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="images/banner2.jpg" alt="First slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>Our <br> <strong class="black_bold">Latest </strong><br>
                           <strong class="yellow_bold">Product </strong></h1>
                        <p>It is a long established fact that a r <br>
                          eader will be distracted by the readable content of a page </p>
                        <a  href="#">see more Products</a>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>Our <br> <strong class="black_bold">Latest </strong><br>
                           <strong class="yellow_bold">Product </strong></h1>
                        <p>It is a long established fact that a r <br>
                          eader will be distracted by the readable content of a page </p>
                        <a  href="#">see more Products</a>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="third-slide" src="images/banner2.jpg" alt="Third slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1>Our <br> <strong class="black_bold">Latest </strong><br>
                           <strong class="yellow_bold">Product </strong></h1>
                        <p>It is a long established fact that a r <br>
                          eader will be distracted by the readable content of a page </p>
                        <a  href="#">see more Products</a>
                     </div>
                  </div>
               </div>

            </div>
            <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class='fa fa-angle-right'></i>
            </a>
            <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class='fa fa-angle-left'></i>
            </a>
            
         </div>

      </section>



<!-- CHOOSE  -->
      <div class="whyschose">
         <div class="container">

            <div class="row">
               <div class="col-md-7 offset-md-3">
                  <div class="title">
                     <h2>Why <strong class="black">choose us</strong></h2>
                     <span>Fastest repair service with best price!</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="choose_bg">
         <div class="container">
            <div class="white_bg">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="for_box">
                     <i><img src="icon/1.png"/></i>
                     <h3>Data recovery</h3>
                     <p>Perspiciatis eos quos totam cum minima autPerspiciatis eos quos</p>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="for_box">
                     <i><img src="icon/2.png"/></i>
                     <h3>Computer repair</h3>
                     <p>Perspiciatis eos quos totam cum minima autPerspiciatis eos quos</p>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="for_box">
                     <i><img src="icon/3.png"/></i>
                     <h3>Mobile service</h3>
                     <p>Perspiciatis eos quos totam cum minima autPerspiciatis eos quos</p>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="for_box">
                     <i><img src="icon/4.png"/></i>
                     <h3>Network solutions</h3>
                     <p>Perspiciatis eos quos totam cum minima autPerspiciatis eos quos</p>
                  </div>
               </div>
               <div class="col-md-12">
                  <a class="read-more">Read More</a>
               </div>
            </div>
         </div>
       </div>
      </div>
<!-- end CHOOSE -->


      <!-- our product -->
   <div class="product-bg">
      <div class="product-bg-white">
        <div class="container">
            <div class="row">

               <?php
                  include("inc/config.php");

                  // Pagination setup
                  $limit = 4; // ek page ma 4 product
                  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                  if ($page < 1) $page = 1;
                  $offset = ($page - 1) * $limit;

                  // Total products count
                  $count_q = "SELECT COUNT(*) as total FROM products WHERE p_status = 1";
                  $count_res = mysqli_query($link, $count_q);
                  $count_row = mysqli_fetch_assoc($count_res);
                  $total_products = $count_row['total'];
                  $total_pages = ceil($total_products / $limit);

                  // Product query with limit
                  $p_q = "SELECT * FROM products WHERE p_status = 1 LIMIT $offset, $limit";
                  $p_res = mysqli_query($link, $p_q);

                  if (mysqli_num_rows($p_res) == 0) 
                  {
                    echo '<div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <h3>No Products Found</h3>
                                <p>We couldn’t find any products matching your filters.<br>
                                    Try adjusting your search or browse all products.</p>
                                <a href="product.php" class="btn theme-btn">
                                    <i class="fa-solid fa-store"></i> Browse All Products
                                </a>
                            </div>';
                  } 
                  else 
                  {
                     while ($row = mysqli_fetch_assoc($p_res)) 
                     {
                        echo '<div class="col-6 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                 <div class="product-box">
                                 <a href="product-single.php?pid='.$row['p_id'].'">
                                    <i><img src="product_img/' . $row['p_img'] . '" style="height:200px;object-fit:cover;"></i>
                                    <h3>' . $row['p_nm'] . '</h3>
                                    <span>₹' . $row['p_price'] . '</span>
                                 </div>
                                 </a>
                              </div>';
                     }
                  }
               ?>
            
            </div>


 <!-- Pagination -->
<?php 
    if ($total_pages > 1) 
    {
        echo '<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">';

        // Prev
        $prev_disabled = ($page <= 1) ? ' disabled' : '';
        $prev_page = ($page > 1) ? $page - 1 : 1;
        echo '<li class="page-item'.$prev_disabled.'">
                <a class="page-link" href="?page='.$prev_page.'">Previous</a>
            </li>';

        // Numbers
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($page == $i) ? ' active' : '';
            echo '<li class="page-item'.$active.'">
                    <a class="page-link" href="?page='.$i.'">'.$i.'</a>
                </li>';
        }

        // Next
        $next_disabled = ($page >= $total_pages) ? ' disabled' : '';
        $next_page = ($page < $total_pages) ? $page + 1 : $total_pages;
        echo '<li class="page-item'.$next_disabled.'">
                <a class="page-link" href="?page='.$next_page.'">Next</a>
            </li>';

        echo '</ul>
            </nav>';
    }
?> 

        </div>
    </div>
</div>  

      <!-- end our product -->

      
      <!-- service --> 
      <div class="service">
         <div class="container">
            <div class="row">
               <div class="col-md-8 offset-md-2">
                  <div class="title">
                     <h2>Service <strong class="black">Process</strong></h2>
                     <span>Easy and effective way to get your device repair</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                  <div class="service-box">
                     <i><img src="icon/service1.png"/></i>
                     <h3>Fast service</h3>
                     <p>Exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea </p>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                  <div class="service-box">
                     <i><img src="icon/service2.png"/></i>
                     <h3>Secure payments</h3>
                     <p>Exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea </p>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                  <div class="service-box">
                     <i><img src="icon/service3.png"/></i>
                     <h3>Expert team</h3>
                     <p>Exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea </p>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                  <div class="service-box">
                     <i><img src="icon/service4.png"/></i>
                     <h3>Affordable services</h3>
                     <p>Exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea </p>
                  </div>
               </div>
               <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                  <div class="service-box">
                     <i><img src="icon/service5.png"/></i>
                     <h3> 1 Year warranty</h3>
                     <p>Exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea </p>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
      <!-- end service -->
      
      
<?php
      include("inc/footer.php");

?>