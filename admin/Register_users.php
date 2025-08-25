<?php 
    include("inc/header.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
        if (isset($_SESSION['success']))
        {
            echo '<p class="alert alert-success">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
        }
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Users Informations</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                        include('../inc/config.php');
                        $s_q="select * from signup where s_status=1";
                        $s_res=mysqli_query($link,$s_q);
                        $co=1;
                        while($s_row=mysqli_fetch_assoc($s_res))
                        {
                          echo'<tr>
                                <td>'.$co.'</td>
                                <td>'.$s_row['s_fnm'].'</td>
                                <td>'.$s_row['s_email'].'</td>
                                <td>'.$s_row['s_pwd'].'</td>
                                </tr>';
                              $co++;
                        }

                    ?>
                  </tbody>
                </table>
                  </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php 
    include("inc/footer.php");

?>