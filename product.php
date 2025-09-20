<?php include("inc/header.php"); ?>
<?php include("inc/config.php"); ?>


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

<div class="product-bg">
    <div class="product-bg-white">
        <div class="container">
            <div class="row">

                <!-- Filter Toggle Button (Mobile Only) -->
                <div class="col-12">
                    <button class="btn btn-dark btn-block filter-toggle-btn" onclick="toggleFilter()"><i class="fas fa-filter mr-3"></i>Filters</button>
                </div>

                <!-- Filter Sidebar -->
                <div class="col-lg-3 col-md-4 mb-4" id="mobileFilter">
                    <div class="filter-box">
                        <h5 class="mb-3">Filter Products</h5>
                        <form method="GET" action="product.php">
                            <div class="mb-4">
                                <h6>Category</h6>
                                <select name="cid" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    <?php
                                    $cat_q = "SELECT * FROM category WHERE cat_status = 1";
                                    $cat_res = mysqli_query($link, $cat_q);
                                    while ($cat_row = mysqli_fetch_assoc($cat_res)) {
                                        $selected = (isset($_GET['cid']) && $_GET['cid'] == $cat_row['cat_id']) ? "selected" : "";
                                        echo '<option value="'.$cat_row['cat_id'].'" '.$selected.'>'.$cat_row['cat_nm'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="min_price">Min Price</label>
                                    <input type="number" class="form-control" id="min_price" name="min_price" placeholder="₹0" min="0" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
                                </div>
                                <div class="form-group col-6">
                                    <label for="max_price">Max Price</label>
                                    <input type="number" class="form-control" id="max_price" name="max_price" placeholder="₹2000" min="0" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark btn-block">Apply Filter</button>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <?php
                        // Pagination
                        $limit = 4;
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        if ($page < 1) $page = 1;
                        $offset = ($page - 1) * $limit;

                        $conditions = "p_status = 1";
                        if (!empty($_GET['cid'])) 
                        {
                            $cid = (int)$_GET['cid'];
                            $conditions .= " AND p_cat = $cid";
                        }
                        if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) 
                        {
                            $min_price = (int)$_GET['min_price'];
                            $conditions .= " AND p_price >= $min_price";
                        }
                        if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) 
                        {
                            $max_price = (int)$_GET['max_price'];
                            $conditions .= " AND p_price <= $max_price";
                        }

                        // Product query
                        $p_q = "SELECT * FROM products WHERE $conditions LIMIT $offset, $limit";
                        $p_res = mysqli_query($link, $p_q);

                        if (mysqli_num_rows($p_res) == 0) 
                        {
                            echo '<div class="text-center w-100 p-5">
                                    <i class="fa fa-box-open fa-3x mb-3"></i>
                                    <h3>No Products Found</h3>
                                    <p>We couldn’t find any products matching your filters.</p>
                                  </div>';
                        } 
                        else 
                        {
                            while ($row = mysqli_fetch_assoc($p_res)) 
                            {
                                echo '<div class="col-6 col-md-4 col-lg-4 mb-4">
                                        <div class="product-box bg-white p-3 rounded shadow-sm h-100">
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
                    $count_q = "SELECT COUNT(*) as total FROM products WHERE $conditions";
                    $count_res = mysqli_query($link, $count_q);
                    $total_products = mysqli_fetch_assoc($count_res)['total'];
                    $total_pages = ceil($total_products / $limit);

                    if ($total_pages > 1) 
                    {
                        echo '<nav aria-label="Page navigation"><ul class="pagination justify-content-center mt-3">';
                        $prev_page = ($page > 1) ? $page - 1 : 1;
                        $next_page = ($page < $total_pages) ? $page + 1 : $total_pages;

                        $prev_query = http_build_query(array_merge($_GET, ['page' => $prev_page]));
                        echo '<li class="page-item'.($page <= 1 ? ' disabled' : '').'"><a class="page-link" href="?'.$prev_query.'">Previous</a></li>';

                        for ($i = 1; $i <= $total_pages; $i++) {
                            $query_string = http_build_query(array_merge($_GET, ['page' => $i]));
                            echo '<li class="page-item'.($page == $i ? ' active' : '').'"><a class="page-link" href="?'.$query_string.'">'.$i.'</a></li>';
                        }

                        $next_query = http_build_query(array_merge($_GET, ['page' => $next_page]));
                        echo '<li class="page-item'.($page >= $total_pages ? ' disabled' : '').'"><a class="page-link" href="?'.$next_query.'">Next</a></li>';
                        echo '</ul></nav>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function toggleFilter() {
    const filter = document.getElementById("mobileFilter");
    filter.style.display = (filter.style.display === "none" || filter.style.display === "") ? "block" : "none";
}
</script>

<?php include("inc/footer.php"); ?>
