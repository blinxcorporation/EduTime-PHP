<?php
include '../server.php';

$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$username = $_SESSION['username'];
$mail = $_SESSION['emailaddress'];
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Dashboard | EDUTIME </title>
<?php
include '../assets/components/header.php';
?>

  </head>

  <body >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <?php
     include '../assets/components/topbar.php';
     ?>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->


      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <?php
     include '../assets/components/sidebar.php';
     ?>      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->



      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item p-4"><a href="#">Home</a></li>
                   
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <!-- ============================================================== -->
          <!-- Sales Cards  -->
          <!-- ============================================================== -->
          <div class="row p-3">
            <!-- Column -->
            <div class="col-md-4">
              <a href="./schools.php">
              <div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-view-dashboard"></i>
                  </h1>
                  <h6 class="text-white">Schools</h6>
                </div>
              </div>
              </a>
            </div>
            <!-- Column -->
        
            <!-- Column -->
            <div class="col-md-4">
              <a href="./students.php">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-account-box"></i>
                  </h1>
                  <h6 class="text-white">Students</h6>
                </div>
              </div>
            </a>
            </div>
      
            <!-- Column -->
            <div class="col-md-4">
            <a href="./add-admin.php">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-account-key"></i>
                  </h1>
                  <h6 class="text-white">Add an Admin</h6>
                </div>
              </div>
            </div>

</div>



<div class="row p-3">
            <!-- Column -->
            <div class="col-md-4">
              <a href=".//add-student.php">
              <div class="card card-hover">
                <div class="box bg-warning text-center">
                  <h1 class="font-light text-white">
                    <i class=" mdi mdi-account-box"></i>
                  </h1>
                  <h6 class="text-white">Add a Student</h6>
                </div>
              </div>
              </a>
            </div>
            <!-- Column -->
        
            <!-- Column -->
            <div class="col-md-4">
              <a href="./admin.php">
              <div class="card card-hover">
                <div class="box bg-primary text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-security"></i>
                  </h1>
                  <h6 class="text-white">List of Admins</h6>
                </div>
              </div>
            </a>
            </div>
      
            <!-- Column -->
            <div class="col-md-4">
            <a href="./budget.php">
              <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-wallet"></i>
                  </h1>
                  <h6 class="text-white">Budget</h6>
                </div>
              </div>
            </div>

</div>



  
       
            
       


        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php
    include '../assets/components/footer.php';
    ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      <!-- </div> -->
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../assets/libs/flot/excanvas.js"></script>
    <script src="../assets/libs/flot/jquery.flot.js"></script>
    <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../dist/js/pages/chart/chart-page-init.js"></script>
  </body>
</html>
