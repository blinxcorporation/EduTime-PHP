<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

//deny access to courses.php if user is not an admin
if ($_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}

$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

//generate timetable function
function generateTimetable($sem) {
  //Fetch Units selected by Lecturers
  $units_query = "SELECT * FROM unit_details 
  INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id = unit_details.unit_code
  INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
  INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
  INNER JOIN unit_semester_details ON unit_semester_details.unit_id = lecturer_unit_details.unit_id
  INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id
  INNER JOIN department_course_details ON department_course_details.course_id = course_details.course_id
  INNER JOIN department_details ON department_details.department_id = department_course_details.department_id
  INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id
  INNER JOIN school_details ON school_details.school_id = school_department_details.school_id
  ";
  $unit_results = mysqli_query($db, $units_query);
}

//generate timetable on clicking a button
if (isset($_POST['generate-timetable-btn'])) {
//Get Selected Semester
$sem = $_POST['semester_id'];

//generate TT
generateTimetable($semester);

}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Timetables | EDUTIME</title>
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
                    <h4 class="page-title">Timetable Details</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Timetables
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
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Generate Timetable</h5>


                            <form method="POST" action="">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control" id="sem_id" name="semester_id">
                                                    <option value="" selected>Select semester...</option>
                                                    <option value="SEM1">Semester 1</option>
                                                    <option value="SEM2">Semester 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary"
                                                name="generate-timetable-btn">Generate Timetable</button>
                                        </div>
                                    </div>
                                </form>

                            </form>
                            <!--CSV file in an iframe-->
                            <!-- <iframe src="" width="100%" height="400"></iframe> -->


                        </div>
                    </div>
                </div>
            </div>
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
    </div>
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
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $("#zero_config").DataTable();
    </script>

</body>

</html>