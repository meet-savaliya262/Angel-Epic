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

                  // Pagination setup
                  $limit = 4; // ek page ma 9 product
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
if ($total_pages > 1) {
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
<?php
      include("inc/footer.php");
?>
