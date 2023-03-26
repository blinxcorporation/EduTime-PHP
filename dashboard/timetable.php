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

//generate timetable function
function generateTimetable() {
    //GET database connection string inside function
    global $db;
    
    // Initialize arrays to store units, lecturers, courses, departments, schools, rooms, and time slots
    $units = array();
    $lecturers = array();
    $courses = array();
    $departments = array();
    $schools = array();
    $rooms = array();
    $timeSlots = array();

    //get Units and the lecturers teaching the unit
    $units_query = "SELECT * FROM unit_details 
    INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id =unit_details.unit_code 
    INNER JOIN user_details ON user_details.pf_number = lecturer_unit_details.lecturer_id
    INNER JOIN unit_semester_details ON unit_semester_details.unit_id = lecturer_unit_details.unit_id
    INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id
    INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
    INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
    INNER JOIN course_group_details ON course_group_details.course_id = course_details.course_id
    ";
   $unit_results = mysqli_query($db,$units_query);
   
   //save unit and lecturer details on a csv file
     // Create a file pointer for the CSV file
     $fp = fopen('unit_lecturer_details.csv', 'w');

     // Write the headers for the CSV file
     fputcsv($fp, array('Unit ID', 'Unit Name', 'Lecturer ID', 'Lecturer Name', 'Semester', 'Course Name', 'Course Group'));
 
     // Loop through the results and write each row to the CSV file
     while ($row = mysqli_fetch_assoc($unit_results)) {
         fputcsv($fp, array($row['unit_code'], $row['unit_name'], $row['pf_number'], $row['user_firstname']." ".$row['user_lastname'], $row['semester_name'], $row['course_name'], $row['academic_year_id']));
     }
 
     // Close the file pointer
     fclose($fp);
}





//generate timetable on clicking a button
if (isset($_POST['generate-timetable-btn'])) {

//generate TT
generateTimetable($sem);

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
                                <?php echo $units;?>
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
                            <!--CSV file in an iframe-->
                            <iframe src="" width="100%" height="400"></iframe>


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