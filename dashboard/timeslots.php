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

//generate timeslot id
function generateTimeslotID($start_time, $end_time) {
  // Format the start time, end time, and date to create the timeslot ID
  $formatted_start_time = date('Hi', strtotime($start_time));
  $formatted_end_time = date('Hi', strtotime($end_time));
  $prefix = 'TM_';
  
  // Combine the formatted start time, end time, and date to create the timeslot ID
  $timeslot_id = $prefix ."". $formatted_start_time . '_' . $formatted_end_time;
  
  return $timeslot_id;
}

//add timeslot
if (isset($_POST['add-timeslot-btn'])) {
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];

  if (empty($start_time)) {
    array_push($errors, "Start Time is required");
  }
  if (empty($end_time)) {
    array_push($errors, "Start is required");
  }

  if (count($errors) == 0) {
    //generate timeslot id
    $timeslot_id = generateTimeslotID($start_time, $end_time);


    $add_timeslot_query = "INSERT INTO `time_slot_details`(`slot_id`, `start_time`, `end_time`) VALUES ('$timeslot_id','$start_time','$end_time')";
    $results = mysqli_query($db, $add_timeslot_query);

      header('location: ./timeslots.php');
    }else{
      array_push($errors, "Unable to add timeslots");
      header('location: ./timeslots.php');
    }
  }

// Update Academic Year Details
if (isset($_POST['update-academic-year-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $academic_year_id = $_POST['academic_year_id'];
  $academic_year = $_POST['academic_year'];

//Data Validation
  if (empty($academic_year_id)) {
  	array_push($errors, "Academic Year ID is required");
  }
  if (empty($academic_year)) {
  	array_push($errors, "Academic Year is required");
  }

if (count($errors) == 0) {
  $academic_yr_update_query = "UPDATE `academic_year` SET `academic_year`='$academic_year' WHERE `academic_year_id`='$academic_year_id'";
  $results = mysqli_query($db, $academic_yr_update_query);


  header('location: academic-year.php');
  }else{
  array_push($errors, "Unable to push updates");
  header('location: academic-year.php');
  }
}
}

  // Delete Academic Year Details
if (isset($_POST['delete-academic-year-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $academic_year_id = $_POST['academic_year_id'];
  
  if (empty($academic_year_id)) {
    array_push($errors, "Academic Year ID is required");
  }
  if (count($errors) == 0) {
      $academic_yr_data_delete_query = "DELETE FROM `academic_year` WHERE `academic_year_id`='$academic_year_id' ";
      $results = mysqli_query($db, $academic_yr_data_delete_query);

        header('location: academic-year.php');
      }else{
        array_push($errors, "Unable to delete academic year");
        header('location: academic-year.php');
      }
  }
}
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Timeslots | EDUTIME</title>
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
              <h4 class="page-title">Timeslot Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Timeslots
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
            <h5 class="card-title">List of Timeslots</h5>
            <input type='button' value='Add a Timeslot' name='open-timeslot-btn' class='btn btn-primary float-end open-timeslot-modal-btn m-2'>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
    <tr>
    <th>Timeslot ID</th>
    <th>Time Frame</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `time_slot_details`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $slot_id = $row['slot_id'];
              $start_time = $row['start_time'];
              $end_time = $row['end_time'];
              $date_added = $row['date_added'];

      echo "<tr> <td>" .$slot_id.  "</td>";
      echo "<td>" .$start_time." - ".$end_time. "</td>";
      echo "<td>" .$date_added."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='slot_id' value='$slot_id'>
      <input type='submit' data-id='$slot_id' data-start_time='$start_time' data-end_time='$end_time' value='Edit Details' name='edit-timeslot-btn' class='btn btn-success edit-timeslot-btn m-2'>
      <input type='submit' data-id= '$slot_id' value='Delete Timeslot'  class='btn btn-danger deleteTimeslotBtn'>
      </form>
      </td> </tr>";
      }
      
      }else{
      echo "<td>"."No Requests Found"."</td>";
      }
      
      } else{
          echo "<td>"."No Data Found"."</td>";
      }

?>
  </tbody>
  <tfoot>
    <tr>
    <th>Timeslot ID</th>
    <th>Time Frame</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
  </tfoot>
</table>
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

    <!-- delete timeslot modal-->
    <div class="modal" id='deleteTimeslotModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color:red">⚠ Warning!</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <div class="modal-body">
        <p>Are you sure you want to delete this Academic Year?</p>
        <form method="POST" action="">
        <div class="form-group">
            <input type="text"  hidden class="form-control" id="academic_year_ID" required readonly name='academic_year_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" name='delete-academic-year-btn' class="btn btn-danger">Yes,Delete!</button>
      </div>
        </form>
      </div>
      
      </div>
     
    </div>
  </div>
</div>

<!-- add new Academic Year-->
<div
  class="modal fade"
  id="addTimeSlotModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="addTimeSlotModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTimeSlotModalLabel">
          Add a Timeslot
        </h5>
        <button
          type="button"
          class="close"
          data-bs-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="">
          <div class="form-group">
            <div class="row">
            
              <div class="col-md-5">
              <label for="academic-year">Start Time: (e.g 07:00 AM)</label>
                <input
                  type="time"
                  class="form-control"
                  placeholder="e.g 2019"
                  name="start_time"
                  id="start_time_id"
                  min="07:00" max="19:00"
                  required
                />
              </div>
              <div class="col-md-2">
                <p style="font-size: 24px">-</p>
              </div>
              <div class="col-md-5">
              <label for="academic-year">End Time: (e.g 01:00 PM)</label>
              <input
                  type="time"
                  class="form-control"
                  placeholder="e.g 2019"
                  name="end_time"
                  id="end_time_id"
                  min="07:00" max="19:00"
                  required
                />
              </div>
              <div class="modal-footer mt-4">
                <button
                  type="button"
                  class="btn btn-danger"
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
                <button
                  type="submit"
                  class="btn btn-success"
                  name="add-timeslot-btn"
                >
                  Submit
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--edit academic year details-->
<div class="modal fade" id="editAcademicYearModal" tabindex="-1" role="dialog" aria-labelledby="editAcademicYearModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAcademicYearModalLabel">Edit Academic Year Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
      <div class="form-group">
      <div class="row">
    <div class="col-md-5 pb-4">
    <label for="academic year">Start Time: (e.g 07:26 AM)</label>
    <input type="text" class="form-control" readonly hidden name="academic_year_id" id="academic_year_id" required>
      <input type="text" class="form-control" placeholder="e.g 2019/2020" name="academic_year" id="academic_year_name" required>
    </div>
    <div class="col-md-5 pb-4">
    <label for="academic year">Start Time: (e.g 07:26 AM)</label>
    <input type="text" class="form-control" readonly hidden name="academic_year_id" id="academic_year_id" required>
      <input type="text" class="form-control" placeholder="e.g 2019/2020" name="academic_year" id="academic_year_name" required>
    </div>
        <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-success" name="update-academic-year-btn">Update Details</button>
    </div>
      </form>
    </div>
    
  </div>
</div>
</div>






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

<script>
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

//add timeslot details modal code
function openAddTimeSlotModal() {
  $("#addTimeSlotModal").modal("show");
}
let openAddTimeslotModalBtn = document.querySelector(".open-timeslot-modal-btn");
openAddTimeslotModalBtn.addEventListener("click", function (e) {
  e.preventDefault();
  openAddTimeSlotModal();
});

// //edit editAcademicYear details modal code
// function editAcademicYearModal() {
//     $("#editAcademicYearModal").modal("show");
//   }
//   let editButtons = document.querySelectorAll(".edit-academic-year-btn");
//   editButtons.forEach(function (editButton) {
//     editButton.addEventListener("click", function (e) {
//       e.preventDefault();
  
//       let year_id = editButton.dataset.id;
//       let academic_year_desc = editButton.dataset.year_name;

//       document.getElementById("academic_year_id").value = year_id;
//       document.getElementById("academic_year_name").value = academic_year_desc;

//       editAcademicYearModal();
//     });
//   });


  // delete Academic Year modal query
  //   function deleteAcademicYearModal() {
  //   $("#deleteAcademicYearModal").modal("show");
  // }
  // let deleteBtns = document.querySelectorAll(".deleteAcademicYearBtn");
  // deleteBtns.forEach(function (deleteBtn) {
  //   deleteBtn.addEventListener("click", function (e) {
  //     e.preventDefault();
  
  //     let academic_yr_id = deleteBtn.dataset.id;
  
  //     document.getElementById("academic_year_ID").value = academic_yr_id;
     
  //     deleteAcademicYearModal();
  //   });
  // });

  </script>

  </body>
</html>
