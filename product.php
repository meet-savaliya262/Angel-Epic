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

<!-- our product -->

<div class="product-bg">
    <div class="product-bg-white">
        <div class="container">
            <div class="row">

               <?php
                  include("inc/config.php");
                  $p_q = "SELECT * FROM products WHERE p_status = 1";
                  $p_res = mysqli_query($link, $p_q);
                  if (mysqli_num_rows($p_res) == 0) 
                  {
                     echo "<p>No products found.</p>";
                  } 
                  else 
                  {
                     while ($row = mysqli_fetch_assoc($p_res)) 
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
    </div>
</div>
<?php
      include("inc/footer.php");
?>