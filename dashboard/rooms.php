<?php
include '../server.php';
//deny access to schools.php if user is not an admin
if (!isset($_SESSION['role_name']) && $_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}
//Get Session data
$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

//Add Room
//generate room id function
function generate_room_id($room_name) {
    // Slugify the room name
    $slugified_name = strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $room_name)));
    // Add the prefix "RM_" to the slugified name
    $room_id = "RM_" . $slugified_name;

    return $room_id;
}

if (isset($_POST['add-room-btn'])) {
  $room_name = $_POST['room_name'];
  $room_id = generate_room_id($room_name);
  $room_type = $_POST['room_type_id'];
  $room_capacity = $_POST['room_capacity'];
 
  if (empty($room_name)) {
    array_push($errors, "Room Name is required");
  }
  if (empty($room_type)) {
    array_push($errors, "Room Type is required");
  }
  if (empty($room_capacity)) {
    array_push($errors, "Room Capacity is required");
  }

  if (count($errors) == 0) {
    $add_room_query = "INSERT INTO `room_details`(`room_id`, `room_name`, `room_type_id`, `room_capacity`) VALUES ('$room_id','$room_name','$room_type','$room_capacity')";
    $results = mysqli_query($db, $add_room_query );

      header('location: ./rooms.php');
    }else{
      array_push($errors, "Unable to add room");
      header('location: ./rooms.php');
    }
  }

// Update Semester Details
if (isset($_POST['update-semester-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $semester_id = $_POST['sem_id'];
  $semester_name = $_POST['sem_name'];

//Data Validation
  if (empty($semester_id)) {
  	array_push($errors, "Semester ID is required");
  }
  if (empty($semester_name)) {
  	array_push($errors, "Semester Name is required");
  }

if (count($errors) == 0) {
  $sem_data_update_query = "UPDATE `semester_details` SET `semester_name`='$semester_name' WHERE `semester_id`='$semester_id'";
  $results = mysqli_query($db, $sem_data_update_query);

  header('location: semesters.php');
  }else{
  array_push($errors, "Unable to push semester updates");
  header('location: semesters.php');
  }
}
}

  // Delete semester Details
if (isset($_POST['delete-semester-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $semesterID = $_POST['semester_id'];
  
  if (empty($semesterID)) {
    array_push($errors, "Semester ID is required");
  }
  if (count($errors) == 0) {
      $sem_data_delete_query = "DELETE FROM `semester_details` WHERE `semester_id`='$semesterID' ";
      $results = mysqli_query($db, $sem_data_delete_query);

        header('location: semesters.php');
      }else{
        array_push($errors, "Unable to delete department");
        header('location: semesters.php');
      }
  }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Rooms | EDUTIME</title>
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
              <h4 class="page-title">Room Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Rooms
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
            <h5 class="card-title">List of Rooms</h5>
            <input type='button' value='Add a Room' name='open-room-modal-btn' class='btn btn-primary float-end open-room-modal-btn m-2'>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
    <tr>
    <th>Room ID</th>
    <th>Room Name</th>
    <th>Room Type</th>
    <th>Room Capacity</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `room_details` INNER JOIN room_type_details ON room_type_details.room_type_id = room_details.room_type_id";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $room_id = $row['room_id'];
              $room_name = $row['room_name'];
              $room_type = $row['room_type'];
              $room_capacity = $row['room_capacity'];
              $date_created = $row['date_added'];

      echo "<tr> <td>" .$room_id.  "</td>";
      echo "<td>" .$room_name."</td>";
      echo "<td>" .$room_type."</td>";
      echo "<td>" .$room_capacity."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='room_id' value='$room_id'>
      <input type='submit' data-room_id='$room_id'  data-room_name='$room_name' data-room_type='$room_type' data-room_capacity='$room_capacity' value='Edit Details' name='edit-room-btn' class='btn btn-success edit-room-modal-btn m-2'>
      <input type='submit' data-id= '$room_id' value='Delete Room'  class='btn btn-danger deleteRoomBtn'>
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
    <th>Room ID</th>
    <th>Room Name</th>
    <th>Room Type</th>
    <th>Room Capacity</th>
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

<!-- add new Room-->
<div class="modal fade" id="addRoomModal" tabindex="-1" role="dialog" aria-labelledby="addRoomModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRoomModalLabel">Add a Room</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Room Name:</label>
            <input type="text" name="room_name"  class="form-control" id="room_name_id" required placeholder="e.g TB 1">
          </div>
          <div class="form-group">
    <label for="exampleFormControlSelect1">Select Room Type</label>
    <select class="form-control" id="exampleFormControlSelect1" name="room_type_id">
<option value="">Select Room Type</option>
<?php $sql=mysqli_query($db,"select * from room_type_details");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['room_type_id']);?>"><?php echo htmlentities($rw['room_type']);?></option>
<?php
}
?>
    </select>
  </div>
  <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Room Capacity:</label>
            <input type="number" name="room_capacity"  class="form-control" id="room_capacity_id" required placeholder="e.g 60">
          </div>

          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-info" name="add-room-btn">Submit</button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<!--edit Semester details-->
<div class="modal fade" id="editSemesterModal" tabindex="-1" role="dialog" aria-labelledby="editSemesterModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSemesterModalLabel">Edit Semester Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
            <input type="text" readonly name="sem_id" readonly hidden class="form-control" id="semester_id" required>
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Semester Name:</label>
            <input type="text" name="sem_name"  class="form-control" id="semester_name_id" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="update-semester-details-btn">Update Details</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Delete semester model-->
<div class="modal" id='deleteSemesterModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
    <p>Are you sure you want to delete this Semester?</p>
    <form method="POST" action="">
    <div class="form-group">
        <input type="text" hidden  class="form-control" id="semesterID" required readonly name='semester_id'>
      </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
    <button type="submit" name='delete-semester-btn' class="btn btn-danger">Yes,Delete!</button>
  </div>
    </form>
  </div>
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

//add Room details modal code
function openAddRoomModal() {
  $("#addRoomModal").modal("show");
}
let openAddRoomModalBtn = document.querySelector(".open-room-modal-btn");

openAddRoomModalBtn.addEventListener("click", function (e) {
  e.preventDefault();
  openAddRoomModal();
});

//edit Semester details modal code
// function editSemesterModal() {
//     $("#editSemesterModal").modal("show");
//   }
//   let editButtons = document.querySelectorAll(".edit-semester-modal-btn");
//   editButtons.forEach(function (editButton) {
//     editButton.addEventListener("click", function (e) {
//       e.preventDefault();
  
//       let sem_id = editButton.dataset.semid;
//       let sem_name = editButton.dataset.sem_name;

//       document.getElementById("semester_id").value = sem_id;
//       document.getElementById("semester_name_id").value = sem_name;

//       editSemesterModal();
//     });
//   });

//   //delete Semester modal query
//     function deleteSemesterModal() {
//     $("#deleteSemesterModal").modal("show");
//   }
//   let deleteBtns = document.querySelectorAll(".deleteSemesterBtn");
//   deleteBtns.forEach(function (deleteBtn) {
//     deleteBtn.addEventListener("click", function (e) {
//       e.preventDefault();
  
//       let sem_id = deleteBtn.dataset.id;
  
//       document.getElementById("semesterID").value = sem_id;
     
//       deleteSemesterModal();
//     });
//   });

  </script>

  </body>
</html>
