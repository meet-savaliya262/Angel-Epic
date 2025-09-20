<?php
include("inc/header.php");
?>

<div class="brand_color">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Our Products</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Section -->
<div class="product-bg">
    <div class="product-bg-white">
        <div class="container">
            <div class="row">

                <!-- Sidebar Filters (Desktop) -->
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="filter-box p-3 shadow-sm rounded">
                        <h4>Filter Products</h4>
                        <hr>
                        <label>Category</label>
                        <select id="category" class="form-select mb-2">
                            <option value="">All Categories</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home & Living</option>
                        </select>

                        <label>Brand</label>
                        <select id="brand" class="form-select mb-2">
                            <option value="">All Brands</option>
                            <option value="nike">Nike</option>
                            <option value="samsung">Samsung</option>
                            <option value="apple">Apple</option>
                        </select>

                        <label>Price</label>
                        <select id="price" class="form-select mb-2">
                            <option value="">Any Price</option>
                            <option value="0-500">₹0 – ₹500</option>
                            <option value="500-1000">₹500 – ₹1000</option>
                            <option value="1000-5000">₹1000 – ₹5000</option>
                        </select>
                    </div>
                </div>

                <!-- Mobile Filter Toggle -->
                <div class="col-12 d-lg-none mb-3 text-end">
                    <button class="btn btn-outline-primary w-100" onclick="toggleFilter()">Show/Hide Filters</button>
                </div>

                <!-- Mobile Filters -->
                <div class="col-12 d-lg-none" id="mobileFilter" style="display:none;">
                    <div class="filter-box p-3 shadow-sm rounded mb-3">
                        <h4>Filter Products</h4>
                        <label>Category</label>
                        <select id="category-mobile" class="form-select mb-2">
                            <option value="">All Categories</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="home">Home & Living</option>
                        </select>

                        <label>Brand</label>
                        <select id="brand-mobile" class="form-select mb-2">
                            <option value="">All Brands</option>
                            <option value="nike">Nike</option>
                            <option value="samsung">Samsung</option>
                            <option value="apple">Apple</option>
                        </select>

                        <label>Price</label>
                        <select id="price-mobile" class="form-select mb-2">
                            <option value="">Any Price</option>
                            <option value="0-500">₹0 – ₹500</option>
                            <option value="500-1000">₹500 – ₹1000</option>
                            <option value="1000-5000">₹1000 – ₹5000</option>
                        </select>
                    </div>
                </div>

                <!-- Products List -->
                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        <?php
                        include("inc/config.php");

                        // Pagination
                        $limit = 4;
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        if ($page < 1) $page = 1;
                        $offset = ($page - 1) * $limit;

                        // Products query
                        $p_q = "SELECT * FROM products WHERE p_status = 1 LIMIT $offset, $limit";
                        $p_res = mysqli_query($link, $p_q);

                        if (mysqli_num_rows($p_res) == 0) {
                            echo '<div class="text-center w-100 p-5">
                                    <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                                    <h3>No Products Found</h3>
                                    <p>We couldn’t find any products matching your filters.</p>
                                  </div>';
                        } else {
                            while ($row = mysqli_fetch_assoc($p_res)) {
                                echo '<div class="col-6 col-md-4 col-lg-4 mb-4">
                                        <div class="product-box shadow-sm p-2 rounded h-100">
                                            <a href="product-single.php?pid='.$row['p_id'].'" class="text-decoration-none text-dark">
                                                <img src="product_img/'.$row['p_img'].'" class="img-fluid mb-2" style="height:200px;object-fit:cover;">
                                                <h5>'.$row['p_nm'].'</h5>
                                                <span>₹'.$row['p_price'].'</span>
                                            </a>
                                        </div>
                                      </div>';
                            }
                        }
                        ?>
                    </div>

                    <!-- Pagination -->
                    <?php 
                    $count_q = "SELECT COUNT(*) as total FROM products WHERE p_status = 1";
                    $count_res = mysqli_query($link, $count_q);
                    $total_products = mysqli_fetch_assoc($count_res)['total'];
                    $total_pages = ceil($total_products / $limit);

                    if($total_pages > 1){
                        echo '<nav aria-label="Page navigation"><ul class="pagination justify-content-center mt-3">';

                        // Previous
                        $prev_page = ($page > 1) ? $page - 1 : 1;
                        $prev_disabled = ($page <= 1) ? ' disabled' : '';
                        echo '<li class="page-item'.$prev_disabled.'"><a class="page-link" href="?page='.$prev_page.'">Previous</a></li>';

                        // Page numbers
                        for($i=1; $i<=$total_pages; $i++){
                            $active = ($page == $i) ? ' active' : '';
                            echo '<li class="page-item'.$active.'"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                        }

                        // Next
                        $next_page = ($page < $total_pages) ? $page + 1 : $total_pages;
                        $next_disabled = ($page >= $total_pages) ? ' disabled' : '';
                        echo '<li class="page-item'.$next_disabled.'"><a class="page-link" href="?page='.$next_page.'">Next</a></li>';

                        echo '</ul></nav>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JS for Mobile Filter -->
<script>
function toggleFilter() {
    const filter = document.getElementById("mobileFilter");
    filter.style.display = (filter.style.display === "none" || filter.style.display === "") ? "block" : "none";
}
</script>

<?php
include("inc/footer.php");
?>
