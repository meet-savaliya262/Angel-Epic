<?php session_start();
    include("inc/header.php");
?>

<div class="container py-5">
  <div class="row">
    <!-- Cart Table -->
    <div class="col-lg-8">
      <h4 class="mb-4">Shopping Cart</h4>
      <div class="table-responsive">
        <table class="table align-middle table-bordered">
          <thead class="table-light">
            <tr>
              <th>Product</th>
              <th>Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody id="cart-items">
            <?php 
              $total=0;
              if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
              {
                foreach($_SESSION['cart'] as $val)
                {
                  $total_price=$val['qty'] * $val['price'];
                  $total += $total_price;
                  echo '<tr>
                          <td><img src="product_img/'.$val['img'].'" alt="Product" class="product-img" style="width:60px;height:60px;object-fit:cover;" /></td>
                          <td>'.$val['nm'].'</td>
                          <td class="price">₹'.$val['price'].'</td>
                          <td>
                            <form action="addtocart.php" method="post" class="d-flex align-items-center">
                              <input type="hidden" name="update_qty" value="1">
                              <input type="hidden" name="pid" value="'.$val['id'].'">
                              <div class="quantity-buttons d-flex">
                                <button type="button" class="btn btn-outline-secondary btn-sm quantity-minus">-</button>
                                <input type="text" name="qty" class="form-control form-control-sm quantity-input text-center mx-1" value="'.$val['qty'].'" style="width: 50px;">
                                <button type="button" class="btn btn-outline-secondary btn-sm quantity-plus">+</button>
                                <button type="submit" class="btn btn-sm btn-success ms-2">Update</button>
                              </div>
                            </form>
                          </td>
                          <td class="item-total">₹'.$total_price.'</td>
                          <td><a href="addtocart.php?rid='.$val['id'].'" class="text-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>';
                }
              } else {
                echo '<tr><td colspan="6" class="text-center">Your cart is empty</td></tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Cart Summary -->
    <div class="col-lg-4">
      <div class="cart-summary p-3 border rounded">
        <h5>Cart Summary</h5>
        <hr />
        <div class="d-flex justify-content-between">
          <span>Subtotal</span>
          <span id="subtotal">₹<?php echo $total; ?></span>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <span>Total</span>
          <span id="total">₹<?php echo $total; ?></span>
        </div>
        <a href="checkout.php" class="btn btn-primary w-100 mt-4">Proceed to Checkout</a>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
  $(document).ready(function () {
    // Only increase quantity input value
    $(document).on('click', '.quantity-plus', function () {
      const input = $(this).siblings('.quantity-input');
      let current = parseInt(input.val()) || 1;
      input.val(current + 1);
    });

    // Only decrease quantity input value (min 1)
    $(document).on('click', '.quantity-minus', function () {
      const input = $(this).siblings('.quantity-input');
      let current = parseInt(input.val()) || 1;
      if (current > 1) {
        input.val(current - 1);
      }
    });

    // Prevent non-numeric input
    $(document).on('input', '.quantity-input', function () {
      const value = $(this).val().replace(/[^0-9]/g, '');
      $(this).val(value || 1);
    });
  });
</script>

<?php
    include("inc/footer.php");
?>
