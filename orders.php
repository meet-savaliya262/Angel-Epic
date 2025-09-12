<?php


if(!isset($_SESSION['client']['id'])){
   header("Location:login.php");
   exit;
}
include("inc/header.php");
include("inc/config.php");


$uid = $_SESSION['client']['id'];

// Fetch user orders
$q = "SELECT * FROM userorder WHERE o_uid='$uid' ORDER BY o_time DESC";
$res = mysqli_query($link, $q);
?>

<!-- Page Title -->
<div class="brand_color">
   <div class="container">
      <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Your Orders</h2>
               </div>
            </div>
      </div>
   </div>
</div>

<!-- Orders Section -->
<section class="py-5 bg-light">
    <div class="container">
        <?php 
        if(mysqli_num_rows($res) > 0) {
            while($row = mysqli_fetch_assoc($res)) {
                $pids = json_decode($row['o_pid']);
                $ids = implode(",", $pids);
                $p_q = "SELECT * FROM products WHERE p_id IN ($ids)";
                $p_res = mysqli_query($link, $p_q);
                if(!$p_res){
                    die("MySQL Error: " . mysqli_error($link));
                }
        ?>

        <div class="card mb-5 shadow-sm border-0 rounded-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <div>
                    <strong>Order Date:</strong> <?php echo date("d M Y", strtotime($row['o_time'])); ?>
                </div>
                <span class="badge bg-dark text-white"><?php echo $row['o_payment']; ?></span>
            </div>

            <div class="card-body">
               
               <div class="row g-4 mt-3">
                  <?php while($p_row = mysqli_fetch_assoc($p_res)) { ?>
                     <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">
                           <img src="product_img/<?php echo $p_row['p_img']; ?>" 
                           class="card-img-top" 
                           alt="<?php echo $p_row['p_nm']; ?>" 
                           style="height:200px; object-fit:cover;">
                           <div class="card-body">
                              <h5 class="card-title"><?php echo $p_row['p_nm']; ?></h5>
                              <p class="card-text text-muted"><?php echo $p_row['p_description']; ?></p>
                           </div>
                           <div class="card-footer bg-white border-top">
                              <strong class="text-primary">₹<?php echo $p_row['p_price']; ?></strong>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                     <p class="mt-3 ml-3"><b>Shipping Address:</b> <?php echo $row['o_address_line1'].' , '.$row['o_city'].' , '.$row['o_state']; ?></p>
                     <p class="mt-3 ml-3"><b>Mobile No:</b> <?php echo $row['o_phone']; ?></p>
                </div>
            </div>
        </div>

        <?php 
            } 
        } else {
            echo '<div class="alert alert-info text-center">You have not placed any orders yet.</div>';
        } 
        ?>
    </div>
</section>

<?php 
include("inc/footer.php");
?>