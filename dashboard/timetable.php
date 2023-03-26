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
    
    //STEP 1: Initialize arrays to store units, lecturers, courses, departments, schools, rooms, and time slots
    $units = array();
    $lecturers = array();
    $courses = array();
    $departments = array();
    $schools = array();
    $rooms = array();
    $timeSlots = array();

    //STEP 2: ####### Get Unit Details, Lecturer taking the unit, Semester the unit is taught, 
   //course name for which the unit belongs, academic year group the lecturer taught that unit #######
    $units_query = "SELECT * FROM unit_details 
    INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id =unit_details.unit_code 
    INNER JOIN user_details ON user_details.pf_number = lecturer_unit_details.lecturer_id
    INNER JOIN unit_semester_details ON unit_semester_details.unit_id = lecturer_unit_details.unit_id
    INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id
    INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
    INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
    INNER JOIN course_group_details ON course_group_details.course_id = course_group_details.course_id
    GROUP BY unit_details.unit_code ORDER BY unit_details.unit_code ASC";

   $unit_results = mysqli_query($db,$units_query);
   
   if (mysqli_num_rows($unit_results) > 0) {

   
     // Create a file pointer for the CSV file
     $fp = fopen('unit_lecturer_details.csv', 'w');

     // Write the headers for the CSV file
     fputcsv($fp, array('Unit ID', 'Unit Name', 'Lecturer ID', 'Lecturer Name', 'Semester', 'Course Name', 'Course Group'));
 
     // Loop through the results and write each row to the CSV file
     while ($row = mysqli_fetch_assoc($unit_results)) {
         fputcsv($fp, array($row['unit_code'], $row['unit_name'], $row['pf_number'], $row['user_firstname']." ".$row['user_lastname'], $row['semester_id'], $row['course_shortform'], $row['academic_year_id']));
     }
 
     // Close the file pointer
     fclose($fp);

     //Push Unit_results to the $units array
     while ($row = mysqli_fetch_assoc($unit_results)) {
        $units[] = $row; // Add each row to the $units array
     }
    } else {
            // Query did not return any rows
            // Query was not successful
            // Get the error message
            $error_message = mysqli_error($db);
            
            // Display an error message to the user or log the error for further investigation
            echo "Error: " . $error_message;
        }

   //STEP 3: FETCH TIME SLOTS AND POPULATE TIMESLOTS ARRAY
   $timeslots = array(
    'Monday' => array(
        '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00',
        '15:00-17:00', '17:00-19:00'
    ),
    'Tuesday' => array(
        '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00',
        '15:00-17:00', '17:00-19:00'
    ),
    'Wednesday' => array(
        '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00',
        '15:00-17:00', '17:00-19:00'
    ),
    'Thursday' => array(
        '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00',
        '15:00-17:00', '17:00-19:00'
    ),
    'Friday' => array(
        '07:00-09:00', '09:00-11:00', '11:00-13:00', '13:00-15:00',
        '15:00-17:00', '17:00-19:00'
    ),
);

// Define the filename and path to save timeslots in a CSV file
// $filename = __DIR__ . '/timeslots.csv';
// $fp = fopen($filename, 'w');
// foreach ($timeslots as $day => $slots) {
//     fputcsv($fp, [$day]);
//     foreach ($slots as $slot) {
//         fputcsv($fp, [$slot]);
//     }
// }
// fclose($fp);

        
     
}//END OF FUNCTION





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