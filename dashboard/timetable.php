<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    //STEP 2: Get unit details
    $units_query = "SELECT * FROM unit_details 
                    INNER JOIN lecturer_unit_details ON lecturer_unit_details.unit_id = unit_details.unit_code 
                    INNER JOIN user_details ON user_details.pf_number = lecturer_unit_details.lecturer_id
                    INNER JOIN unit_semester_details ON unit_semester_details.unit_id = lecturer_unit_details.unit_id
                    INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id
                    INNER JOIN unit_course_details ON unit_course_details.unit_id = lecturer_unit_details.unit_id
                    INNER JOIN course_details ON course_details.course_id = unit_course_details.course_id
                    INNER JOIN course_group_details ON course_group_details.course_id = course_group_details.course_id
                    GROUP BY unit_details.unit_code ORDER BY unit_details.unit_code ASC";

    $unit_results = mysqli_query($db, $units_query);

    if (mysqli_num_rows($unit_results) > 0) {
        // Push Unit_results to the $units array
        while ($row = mysqli_fetch_assoc($unit_results)) {
            $units[] = $row; // Add each row to the $units array
        }

        // Create a file pointer for the CSV file
        $fp = fopen('unit_lecturer_details.csv', 'w');

        // Write the headers for the CSV file
        fputcsv($fp, array('Unit ID', 'Unit Name', 'Lecturer ID', 'Lecturer Name', 'Semester', 'Course Name', 'Course Group'));

        // Loop through the results and write each row to the CSV file
        foreach ($units as $unit) {
            fputcsv($fp, array($unit['unit_code'], $unit['unit_name'], $unit['pf_number'], $unit['user_firstname']." ".$unit['user_lastname'], $unit['semester_id'], $unit['course_shortform'], $unit['academic_year_id']));
        }

        // Close the file pointer
        fclose($fp);
    } else {
        // IF Query did not return any rows OR
        // Query was not successful
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

    //STEP 4: GET ROOM DETAILS AND PUSH THEM TO rooms array
    $rooms_query = "SELECT * FROM room_details
    INNER JOIN room_type_details ON room_type_details.room_type_id =room_details.room_type_id";
    $room_results = mysqli_query($db,$rooms_query);
    //populate room array
    // Loop through the room results and add each room to the $rooms array
    while ($room = mysqli_fetch_assoc($room_results)) {
            $rooms[] = array(
            'room_id' => $room['room_id'],
            'room_name' => $room['room_name'],
            'capacity' => $room['room_capacity'],
            'room_type' => $room['room_type']
        );
    }

   
 // STEP 5: Assign units to timeslots:

// shuffle the units randomly
shuffle($units);

// open the CSV file for writing
$csv_file = fopen('assignment.csv', 'w');

// write the header row to the CSV file
fputcsv($csv_file, array('Unit Code', 'Unit Name', 'Lecturer','Day', 'Time Slot', 'Room'));

// loop through each unit and assign to a timeslot, room, and day
foreach ($units as $unit) {
    // shuffle the timeslots, days, and rooms arrays randomly
    shuffle($timeslots);
    shuffle($days);
    shuffle($rooms);

    // loop through each day until a suitable timeslot is found
    foreach ($days as $day) {
        foreach ($timeslots as $dy => $slots) {
            $random_index = array_rand($slots);
            $random_timeslot = $slots[$random_index];
            // loop through each room until a suitable room is found
            foreach ($rooms as $room) {              
                // check if the room capacity is enough for the unit
                // var_dump($rooms);
                if ($room['capacity'] >= $unit['group_number']) {
                    // assign the unit to the timeslot, room, and day
                    $assignment = array(
                        'code' => $unit['unit_code'],
                        'unit' => $unit['unit_name'],
                        'lecturer' => $unit['lecturer_id'],
                        'day' => $day,
                        'timeslot' => $random_timeslot,
                        'room' => $room['room_name']
                    );
                    // var_dump($day);
                
                    $unit_id = $assignment['code'];
                    $unit_name= $assignment['unit'];
                    $day = $assignment['day'];
                    $timeslot = $assignment['timeslot'];
                    $room = $assignment['room'];
                    $lec = $assignment['lecturer'];

                    // save the assignment to the CSV file
                    fputcsv($csv_file, array($unit_id, $unit_name,$lec, $day, $timeslot, $room));

                    // save the assignment to the database or elsewhere
                    $assignment_query = "INSERT INTO `unit_room_time_day_allocation_details`(`unit_id`,`lecturer_id`, `room_id`, `time_slot_id`, `weekday_id`) VALUES ('$unit_id','$lec','$room','$timeslot','$day')";
                    $assignment_results = mysqli_query($db, $assignment_query);

                    // remove the assigned room from the list of available rooms
                    $room_index = array_search($room, $rooms);
                    unset($rooms[$room_index]);

                    // break out of the room loop
                    break;
                }
            }
            
            // check if the unit has been assigned to a room
            if (isset($assignment)) {
                // break out of the timeslot loop
                break;
            }
        }
        // check if the unit has been assigned to a timeslot and room
        if (isset($assignment)) {
            // break out of the day loop
            break;
        }
    }

} 

// close the CSV file
fclose($csv_file);


}//END OF FUNCTION


//generate timetable on clicking a button
if (isset($_POST['generate-timetable-btn'])) {

//generate TT
generateTimetable();

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

</body>

</html>