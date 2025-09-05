<?php
    include("inc/header.php");
    include("inc/config.php");

    if (isset($_GET['pid'])) {
        $pid = $_GET['pid'];
        $q = "SELECT * FROM products, category
              WHERE p_cat = cat_id AND p_id = '$pid'
              AND p_status = 1";
        $res = mysqli_query($link, $q);
        $row = mysqli_fetch_assoc($res);
    } else {
        echo "<h3>Product not found.</h3>";
        exit;
    }
?>

<div class="container py-4">
  <div class="row">
    <!-- Product Image -->
    <div class="col-md-6 mb-3">
      <img src="product_img/<?php echo $row['p_img']; ?>" alt="Product Image" class="product-img">
    </div>

    <!-- Product Info -->
    <div class="col-md-6">
      <h2><?php echo $row['p_nm']; ?></h2>
      <p class="price mb-3">₹<?php echo $row['p_price']; ?></p>
      <p class="mb-4"><strong>Short Description:</strong> <?php echo $row['p_short_desc']; ?></p>
      <p class="mb-4"><strong>Additional Information:</strong> <?php echo $row['p_add_info']; ?></p>

      <?php
        $sta = 0;
        if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $val) {
            if ($val['nm'] == $row['p_nm'] && $val['price'] == $row['p_price'] && $val['img'] == $row['p_img']) {
              $sta = 1;
            }
          }
        }

        if ($sta == 0) {
      ?>
          <form action="addtocart.php" method="post">
            <div class="form-group row align-items-center">
              <label class="col-sm-3 col-form-label"><strong>Quantity</strong></label>
              <div class="col-sm-9">
                <div class="quantity-control">
                  <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty()">−</button> 
                  <input type="number" id="qty" name="qty" value="1" min="1">
                  <button type="button" class="btn btn-outline-secondary" onclick="increaseQty()">+</button>
                </div>
              </div>
            </div>

            <input type="hidden" name="pid" value="<?php echo $row['p_id']; ?>">

            <button type="submit" class="btn btn-add btn-block mt-3">Add to Cart</button>
          </form>
      <?php
        } else {
          echo '<span class="btn btn-warning">Item Already in Cart</span>';
        }
      ?>

      <!-- Extra Info -->
      <div class="mt-4">
        <p><strong>Category:</strong> &nbsp;<?php echo $row['cat_nm']; ?></p>
        <p><strong>Weight:</strong> &nbsp;<?php echo $row['p_weight']; ?></p>

        <div class="share-icons">
          <p><strong>Share on:</strong>
          <a href="#"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <b><hr></b>

  <!-- Long Description -->
  <div class="row mt-4">
    <div class="col-12">
      <h4>Product Details</h4>
      <p>&nbsp;<?php echo $row['p_description']; ?></p>
    </div>
  </div>
</div>

<script>
  function increaseQty() {
    let qty = document.getElementById("qty");
    qty.value = parseInt(qty.value) + 1;
  }

  function decreaseQty() {
    let qty = document.getElementById("qty");
    if (parseInt(qty.value) > 1) {
      qty.value = parseInt(qty.value) - 1;
    }
  }
</script>

<?php include("inc/footer.php"); ?>
