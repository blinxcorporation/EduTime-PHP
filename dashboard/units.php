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

// Update Course Details
if (isset($_POST['update-course-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $crs_id = $_POST['crs_id'];
  $department_id = $_POST['crs_dpt_id'];
  $course_name = $_POST['crs_name'];
  $course_short_name = $_POST['crs_short_name'];


//Data Validation
  if (empty($crs_id)) {
  	array_push($errors, "Course ID is required");
  }
  if (empty($department_id)) {
  	array_push($errors, "Department ID is required");
  }
  if (empty($course_name)) {
  	array_push($errors, "Course Name is required");
  }
  if (empty($course_short_name)) {
  	array_push($errors, "Course Short Name is required");
  }

if (count($errors) == 0) {
  $course_data_update_query = "UPDATE `course_details` SET `course_name`='$course_name',`course_shortform`='$course_short_name' WHERE `course_id` ='$crs_id'";
  $results = mysqli_query($db, $course_data_update_query);

  $crs_dpt_update_query = "UPDATE `department_course_details` SET `department_id`='$department_id' WHERE `course_id` ='$crs_id'";
  $results = mysqli_query($db, $crs_dpt_update_query);

  header('location: courses.php');
  }else{
  array_push($errors, "Unable to push updates");
  header('location: courses.php');
  }
}
}

  // Delete course Details
if (isset($_POST['delete-course-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $courseID = $_POST['course_id'];
  
  if (empty($courseID)) {
    array_push($errors, "Course ID is required");
  }
  if (count($errors) == 0) {
      $crs_data_delete_query = "DELETE FROM `course_details` WHERE `course_id`='$courseID' ";
      $results = mysqli_query($db, $crs_data_delete_query);

        header('location: courses.php');
      }else{
        array_push($errors, "Unable to delete user");
        header('location: courses.php');
      }
  }
}

//add unit
if (isset($_POST['add-unit-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $course_id = $_POST['uni_course_id'];
  $unit_code = $_POST['unit_code'];
  $unit_name = $_POST['unit_name'];
  $unit_type = $_POST['unit_type'];
  $unit_status = $_POST['unit_status'];
  $sem_id = $_POST['uni_semester_id'];

  if (empty($unit_code)) {
    array_push($errors, "Unit ID is required");
  }
  if (empty($unit_name)) {
    array_push($errors, "Unit Name is required");
  }
  if (empty($unit_type)) {
    array_push($errors, "Unit Type is required");
  }
  if (empty($unit_status)) {
    array_push($errors, "Unit Status is required");
  }
  if (empty($sem_id)) {
    array_push($errors, "Sem ID is required");
  }

  
  if (count($errors) == 0) {
    $add_unit_query = "INSERT INTO `unit_details`(`unit_code`, `unit_name`, `unit_type`, `unit_active`) VALUES ('$unit_code','$unit_name','$unit_type','$unit_status')";
    $results = mysqli_query($db, $add_unit_query);

    // //link unit with course
    $add_crs_unit_query = "INSERT INTO `unit_course_details`(`unit_id`, `course_id`) VALUES ('$unit_code','$course_id')";
    $results_crs_unit = mysqli_query($db, $add_crs_unit_query);

    // //link unit with semester
    $add_crs_sem_query = "INSERT INTO `unit_semester_details`(`unit_id`, `semester_id`) VALUES ('$unit_code','$sem_id')";
    $results_crs_unit = mysqli_query($db, $add_crs_sem_query);

      header('location: ./units.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./units.php');
    }
  }
}
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Units| EDUTIME</title>
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
    <div class="row">
      <div class="col-12">

            <div class="card">
          <div class="card-body">
            <h5 class="card-title">List of Units</h5>
            <input type='button' value='Add a Unit' name='open-unit-modal-btn' class='btn btn-primary float-end open-unit-modal-btn m-2'>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
    <tr>
    <th>Unit ID</th>
    <th>Unit Name</th>
    <th>Status</th>
    <th>Course</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `unit_details` INNER JOIN unit_course_details ON unit_course_details.unit_id = unit_details.unit_code INNER JOIN course_details ON unit_course_details.course_id = course_details.course_id";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $unit_id = $row['unit_code'];
              $unit_name = $row['unit_name'];
              $unit_type = $row['unit_type'];
              $unit_active = $row['unit_active'];//string (1,0)
              $course_id = $row['course_id'];
              $course_short_name = $row['course_shortform'];
              $date_added = $row['date_added'];
              $unit_status= ($unit_active) ? "Active" : "Inactive";

                echo "<tr> <td>" .$unit_id.  "</td>";
                echo "<td>" .$unit_name."</td>";
                echo "<td>" .$unit_status."</td>";
                echo "<td>" .$course_short_name."</td>";
                echo "<td>" .$date_added."</td>";
                echo "<td>
                <form method ='POST' action=''>
                <input  type='text' hidden name='unit_id' value='$unit_id'>
                <input type='submit' data-unit_id='$unit_id'  data-unit_name='$unit_name' value='Edit Details' name='edit-unit-btn' class='btn btn-success edit-unit-modal-btn m-2'>
                <input type='submit' data-id= '$unit_id' value='Delete Unit'  class='btn btn-danger deleteUnitBtn'>
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
    <th>Unit ID</th>
    <th>Unit Name</th>
    <th>Status</th>
    <th>Course</th>
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

    <!-- delete course modal-->
    <div class="modal" id='deleteCourseModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
        <p>Are you sure you want to delete this Course?</p>
        <form method="POST" action="">
        <div class="form-group">
            <input type="text"  hidden class="form-control" id="courseID" required readonly name='course_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" name='delete-course-btn' class="btn btn-danger">Yes,Delete!</button>
      </div>
        </form>
      </div>
      
      </div>
     
    </div>
  </div>
</div>


<!--edit Course details-->
<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCourseModalLabel">Edit Course Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <input type="text" readonly  name="crs_id"  class="form-control" id="crs_id" required>
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Department Name:</label>
            <select class="form-control" id="crs_dpt_id" name="crs_dpt_id" value="" required>
    <option value="">Select Department..</option>
    <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from department_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
    <option value="<?php echo htmlentities($rw['department_id']);?>">Department of <?php echo htmlentities($rw['department_name']);?></option>
    <?php
    }
    ?>
  </select>
          </div>
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Course Name:</label>
            <input type="text" name="crs_name"  class="form-control" id="crs_name" required>
          </div>
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Short Name:</label>
            <input type="text" name="crs_short_name"  class="form-control" id="crs_short_name" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="update-course-details-btn">Update Details</button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

<!-- add new unit-->
<div class="modal fade" id="addUnitModal" tabindex="-1" role="dialog" aria-labelledby="addUnitModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUnitModalLabel">Add a Unit</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="">
<div class="form-group">
  <label for="uni_course_id">Select Course:</label>
  <select class="form-control" id="uni_course_id" name="uni_course_id" required>
    <option value="">Select Course..</option>
    <?php 
    // Retrieve the departments from the database
    $sql=mysqli_query($db,"select * from course_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
    <option value="<?php echo htmlentities($rw['course_id']);?>"><?php echo htmlentities($rw['course_name']);?></option>
    <?php
    }
    ?>
  </select>
</div>
      <div class="form-group">
          <label for="recipient-name" readonly class="col-form-label">Unit Code:</label>
          <input type="text" name="unit_code"  class="form-control" id="unit_code_id" required placeholder="e.g CIT 101">
        </div>
      <div class="form-group">
          <label for="recipient-name" readonly class="col-form-label">Unit Name:</label>
          <input type="text" name="unit_name"  class="form-control" id="unit_name_id" required placeholder="e.g Software Project Management">
        </div>
      <div class="form-group">
          <label for="recipient-name" readonly class="col-form-label">Unit Type:</label>
          <select class="form-control" id="unit_type_id" name="unit_type" required>
          <option value="" selected>Select Unit Type...</option>
          <option value="Theory">Theory</option>
          <option value="ICT-Practical">ICT-Practical</option>
          <option value="CHEM-Practical">CHEM-Practical</option>
          <option value="BIO-Practical">BIO-Practical</option>
          <option value="PHY-Practical">PHY-Practical</option>
    </select>
        </div>
        <div class="form-group">
  <label for="uni_semester_id">Select Semester:</label>
  <select class="form-control" id="uni_semester_id" name="uni_semester_id" required>
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
      <div class="form-group">
          <label for="recipient-name" readonly class="col-form-label">Unit Status:</label>
          <select class="form-control" id="unit_status_id" name="unit_status" required>
          <option value="" selected>select status...</option>
          <option value="1">Active</option>
          <option value="0">In-Active</option>
    </select>
        </div>
   
        <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-info" name="add-unit-btn">Submit</button>
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

//add Unite details modal code
function openUnitModal() {
  $("#addUnitModal").modal("show");
}
let openAddUnitModalBtn = document.querySelector(".open-unit-modal-btn");
openAddUnitModalBtn.addEventListener("click", function (e) {
  e.preventDefault();
  openUnitModal();
});

// //edit Course details modal code
function editCourseModal() {
    $("#editCourseModal").modal("show");
  }
  let editButtons = document.querySelectorAll(".edit-course-modal-btn");
  editButtons.forEach(function (editButton) {
    editButton.addEventListener("click", function (e) {
      e.preventDefault();
  
      let crsid = editButton.dataset.crsid;
      let crs_name = editButton.dataset.crsname;
      let crs_shortname = editButton.dataset.crs_short_name;
      let crs_dptname = editButton.dataset.crs_dpt_id;

      document.getElementById("crs_id").value = crsid;
      document.getElementById("crs_name").value = crs_name;
      document.getElementById("crs_short_name").value = crs_shortname;
      document.getElementById("crs_dpt_id").value = crs_dptname;

      // pre-select the option in the dropdown menu
      const select = document.querySelector('#crs_dpt_id');
      // console.log(select)
      select.value = crs_dptname;
   
      editCourseModal();
    });
  });


  // delete Course modal query
    function deleteCourseModal() {
    $("#deleteCourseModal").modal("show");
  }
  let deleteBtns = document.querySelectorAll(".deleteCourseBtn");
  deleteBtns.forEach(function (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
  
      let crsid = deleteBtn.dataset.id;
  
      document.getElementById("courseID").value = crsid;
     
      deleteCourseModal();
    });
  });

  </script>

  </body>
</html>
