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
function generateTimetable($semester) {
  // Query the database to get the list of units that are active and selected by a lecturer
  $units_query = "SELECT * FROM unit_details
  INNER JOIN lecturer_unit_details ON lecturer_unit_details.lecturer_id = unit_details.unit_code 
  INNER JOIN user_details ON user_details.pf_number = lecturer_unit_details.lecturer_id
  INNER JOIN unit_semester_details ON unit_semester_details.unit_id =lecturer_unit_details.unit_id 
  INNER JOIN semester_details ON semester_details.semester_id = unit_semester_details.semester_id 
  WHERE unit_semester_details.semester_id='$semester'";
  
  $result = mysqli_query($db, $units_query);

  // Create a two-dimensional array to store the timetable
  $timetable = array(
    "Monday" => array(),
    "Tuesday" => array(),
    "Wednesday" => array(),
    "Thursday" => array(),
    "Friday" => array()
  );

  // Loop through the list of units
  while ($row = mysqli_fetch_assoc($result)) {
    $unit_id = $row['unit_code'];
    $unit_name = $row['unit_name'];
    $semester_id = $row['semester_id'];
    $semester_name = $row['semester_name'];
    $unit_type = $row['unit_type'];
    $room_type = $row['room_type'];
    $department = $row['department'];

    // Determine the capacity of the room based on the type of room and the department
    if ($room_type == 'Standard') {
      if ($department == 'IT') {
        $capacity = 50;
      } else if ($department == 'Business') {
        $capacity = 60;
      } else if ($department == 'Engineering') {
        $capacity = 70;
      }
    } else if ($room_type == 'Laboratory') {
      if ($department == 'IT') {
        $capacity = 30;
      } else if ($department == 'Business') {
        $capacity = 40;
      } else if ($department == 'Engineering') {
        $capacity = 50;
      }
    }

    // Determine the duration of the unit based on the type of unit
    if ($type == 'Theory') {
      $duration = 2;
    } else if ($type == 'ICT-Practical') {
      $duration = 3;
    } else if ($type == 'ELECT-Practical') {
      $duration = 4;
    }

    // Determine the number of groups based on the department and the semester
    if ($department == 'IT') {
      if ($semester == 'YEAR 1 SEMESTER 1' || $semester == 'YEAR 1 SEMESTER 2') {
        $num_groups = 2;
      } else if ($semester == 'YEAR 2 SEMESTER 1' || $semester == 'YEAR 2 SEMESTER 2') {
        $num_groups = 3;
      } else if ($semester == 'YEAR 3 SEMESTER 1' || $semester == 'YEAR 3 SEMESTER 2') {
        $num_groups = 4;
      } else if ($semester == 'YEAR 4 SEMESTER 1' || $semester == 'YEAR 4 SEMESTER 2') {
        $num_groups = 5;
      }
    } else if ($department == 'Business') {
      if ($semester == 'YEAR 1 SEMESTER 1' || $semester == 'YEAR 1 SEMESTER 2') {
        $num_groups = 2;
      } else if ($semester == 'YEAR 2 SEMESTER 1' || $semester == 'YEAR 2 SEMESTER 2') {
        $num_groups = 3;
      } else if ($semester == 'YEAR3 SEMESTER 1' || $semester == 'YEAR 3 SEMESTER 2') {
        $num_groups = 4;
        } else if ($semester == 'YEAR 4 SEMESTER 1' || $semester == 'YEAR 4 SEMESTER 2') {
        $num_groups = 5;
        }
        } else if ($department == 'Engineering') {
        if ($semester == 'YEAR 1 SEMESTER 1' || $semester == 'YEAR 1 SEMESTER 2') {
        $num_groups = 2;
        } else if ($semester == 'YEAR 2 SEMESTER 1' || $semester == 'YEAR 2 SEMESTER 2') {
        $num_groups = 3;
        } else if ($semester == 'YEAR 3 SEMESTER 1' || $semester == 'YEAR 3 SEMESTER 2') {
        $num_groups = 4;
        } else if ($semester == 'YEAR 4 SEMESTER 1' || $semester == 'YEAR 4 SEMESTER 2') {
        $num_groups = 5;
        }
        }
        // Loop through the days of the week
foreach ($timetable as $day => $slots) {
  // Loop through the time slots of the day
  for ($i = 0; $i <= 8; $i++) {
    // Check if the slot is available for all the groups
    $slot_available = true;
    for ($j = 1; $j <= $num_groups; $j++) {
      $group = $department . ' ' . 'GROUP ' . $j;
      $query = "SELECT COUNT(*) FROM timetable WHERE day='$day' AND slot=$i AND group_name='$group'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      if ($row['COUNT(*)'] > 0) {
        $slot_available = false;
      }
    }

    // Check if the slot is available for the lecturer
    $query = "SELECT COUNT(*) FROM timetable WHERE day='$day' AND slot=$i AND lecturer='$lecturer'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row['COUNT(*)'] > 0) {
      $slot_available = false;
    }

    // Check if the slot is available for the room
    $query = "SELECT COUNT(*) FROM timetable WHERE day='$day' AND slot=$i AND room_type='$room_type' AND capacity>=$num_groups";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row['COUNT(*)'] > 0) {
      $slot_available = false;
    }

    // If the slot is available, assign the unit to the slot
    if ($slot_available) {
      for ($j = 1; $j <= $num_groups; $j++) {
        $group = $department . ' ' . 'GROUP ' . $j;
        $query = "INSERT INTO timetable (day, slot, unit_name, lecturer, room_type, group_name, num_groups) VALUES ('$day', $i, '$unit', '$lecturer', '$room_type', '$group', $num_groups)";
        mysqli_query($conn, $query);
      }
      break;
    }
  }
}
// Disconnect from the database
mysqli_close($conn);

// Return the timetable
return $timetable;
}
}


//generate timetable
if (isset($_POST['generate-timetable-btn'])) {

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
                            <input type='button' value='Generate Timetable' name='generate-timetable-btn'
                                class='btn btn-primary float-end open-timetable-modal-btn m-2'>

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