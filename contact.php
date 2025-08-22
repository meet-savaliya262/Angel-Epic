<?php session_start();
    include("include/header.php");

    if(isset($_SESSION['status']) && $_SESSION['status']=="success") 
    {
        echo "<script>alert('Your form has been successfully sent!');</script>";
        unset($_SESSION['status']);
    }
    else if(isset($_SESSION['status']) && $_SESSION['status']=="error") 
    {
        echo "<script>alert(' Please fill all fields before submitting!');</script>";
        unset($_SESSION['status']);
    }
?>

      <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- contact -->
        <div class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action="contact_process.php" method="post">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <input class="form-control" placeholder="Your name" type="text" name="fnm">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <input class="form-control" placeholder="Email" type="text" name="email">
                                </div>
                                <div class=" col-md-12">
                                    <input class="form-control" placeholder="Phone" type="text" name="phone">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="textarea" placeholder="message" name="msg"></textarea>
                                </div>
                                <div class=" col-md-12">
                                    <button class="send">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- end contact -->
<!-- map -->
<div class="container-fluid padi">
         <div class="map">
            <img src="images/mapimg.jpg" alt="img"/>
         </div>
      </div>
      <!-- end map --> 
      
      
      

<?php
      include("inc/footer.php");
?>