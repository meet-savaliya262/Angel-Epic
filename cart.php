<?php
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
            <tr>
              <td><img src="images/1.jpg" alt="Product" class="product-img" /></td>
              <td>Product 1</td>
              <td class="price">$20.00</td>
            <td>
            <div class="quantity-buttons">
                <button class="btn btn-outline-secondary btn-sm quantity-minus">-</button>
                <input type="text" class="form-control form-control-sm quantity-input text-center" value="1" style="width: 50px;">
                <button class="btn btn-outline-secondary btn-sm quantity-plus">+</button>
            </div>
            </td>
              <td class="item-total">$20.00</td>
              <td><i class="fa fa-trash remove-btn"></i></td>
            </tr>
            <!-- More products can be added dynamically -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- Cart Summary -->
    <div class="col-lg-4">
      <div class="cart-summary">
        <h5>Cart Summary</h5>
        <hr />
        <div class="d-flex justify-content-between">
          <span>Subtotal</span>
          <span id="subtotal">$20.00</span>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <span>Total</span>
          <span id="total">$20.00</span>
        </div>
        <button class="btn btn-primary w-100 mt-4">Proceed to Checkout</button>
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

    // Optional: Prevent non-numeric input
    $(document).on('input', '.quantity-input', function () {
      const value = $(this).val().replace(/[^0-9]/g, '');
      $(this).val(value || 1);
    });
  });
</script>




<?php
    include("inc/footer.php");
?>
