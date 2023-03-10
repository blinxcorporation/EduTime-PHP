<?php
include '../server.php';
//deny access to courses.php if user is not an admin
if (!isset($_SESSION['role_name']) && $_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}

$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Select Units| EDUTIME</title>
  <?php
include '../assets/components/header.php';
?>
  </head>

  <body>

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
     ?>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb pt-5">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Units Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Units
                    </li>

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
          <!-- Start Page Content -->
          <!-- ============================================================== -->
    <div class="row mb-4">
      <div class="col-12">

            <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="font-size:20px">Select Semester</h5>
            <form method="POST" action="">
                <div class="row">
            <div class="form-group col-md-5">
            <select class="form-control form-control-lg" id="uni_semester_id" name="uni_semester_id" required>
    <option value="">Select Semester..</option>
    <?php 
    // Retrieve the semesters from the database
    $sql=mysqli_query($db,"select * from semester_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
    <option value="<?php echo htmlentities($rw['semester_id']);?>"><?php echo htmlentities($rw['semester_name']);?></option>
    <?php
    }
    ?>
  </select>
            </div>
            <div class="form-group col-md-7">
                <input type="submit" name="select-sem-btn" class="btn btn-outline-success form-control-lg" value="View Units"  style="font-size:16px; font-weight:bold;"></input>  <strong style="font-size:16px">*Select a Semester to Diplay Active Units</strong>
                </div>
            </div>
            </form>
        </div>
    </div>
  </div>

  <?php
if (isset($_POST['select-sem-btn'])) {
    if ($_SESSION['role_name'] == 'Chairperson' || $_SESSION['role_name'] == 'Dean' || $_SESSION['role_name'] == 'Lecturer'){
    $sem_id = $_POST['uni_semester_id'];
  
    if (empty($sem_id)) {
      array_push($errors, "Sem ID is required");
    }
  
    if (count($errors) == 0) {
      $fetch_unit_query = "SELECT * FROM `unit_details` INNER JOIN unit_semester_details ON unit_semester_details.unit_id = unit_details.unit_code INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id INNER JOIN unit_course_details ON unit_course_details.unit_id = unit_details.unit_code INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id INNER JOIN department_course_details ON department_course_details.course_id =course_details.course_id INNER JOIN department_details ON department_details.department_id = department_course_details.department_id INNER JOIN lecturer_department_details ON lecturer_department_details.department_id =department_details.department_id  WHERE unit_details.unit_active = 'Active' AND unit_semester_details.semester_id = '$sem_id' AND lecturer_department_details.lecturer_id='$pfno'";
      $data_result = mysqli_query($db, $fetch_unit_query);

      if ($data_result->num_rows > 0){ while($row = $data_result->fetch_assoc())
{ $id = $row['id']; $unit_id = $row['unit_code']; $unit_name =
$row['unit_name']; $unit_type = $row['unit_type']; $unit_active =
$row['unit_active'];//string (1,0) $course_id = $row['course_id'];
$course_short_name = $row['course_shortform']; $date_added = $row['date_added'];
$semester_id = $row['semester_id']; $semester_name = $row['semester_name']; 
echo"
<div class='col-md-3'>
<div class='card'>
    <div class='card-header' style='background-color:#dff0d8; color:#3c763d;font-weight:bold; font-size:16px'>
        $unit_id
    </div>
    <div class='card-body'>
      <h5 class='card-title text-primary'>$unit_name</h5>
      <p class='card-text'>$semester_name</p>
      <div class='form-check'>
      <input type='checkbox' class='form-check-input' name='unit-code-selected' value='$unit_id' id='exampleCheck1'>
    </div>
    </div>
 
  </div>

</div>
";
 }
 }else{ 
  echo "No Requests Found";
 } 
} else{ 
  echo "No Data Found";
} 
  } 
  } 
?>

</div>

    
      
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
    <?php
    include '../assets/components/footer.php';
    ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div> <!--end of container-->
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
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

  </script>

  </body>
</html>
