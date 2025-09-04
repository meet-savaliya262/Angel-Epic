<?php 
include("inc/header.php");
?>

<div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>our product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- product section -->
<section class="product_section layout_padding">
  <div class="container">

    <div class="row">
      <?php
        include("inc/config.php");
        $s=$_GET['s'];
        $q = "SELECT * FROM products where p_nm LIKE '%".$s."%' AND p_status=1";
        
        $res = mysqli_query($link, $q);

        if (mysqli_num_rows($res) <= 0) 
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
            while ($row = mysqli_fetch_assoc($res)) 
            {
            echo '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
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
  </div>
</section>

<?php 
include("inc/footer.php");
?>
