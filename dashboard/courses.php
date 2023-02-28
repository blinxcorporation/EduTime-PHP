<?php
include '../server.php';
//deny access to schools.php if user is not an admin
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

// Update Department Details
if (isset($_POST['update-department-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin' || $_SESSION['role_name'] == 'Dean'){
  $department_id = $_POST['dpt_id'];
  $department_name = $_POST['dpt_name'];


//Data Validation
  if (empty($department_id)) {
  	array_push($errors, "Department ID is required");
  }
  if (empty($department_name)) {
  	array_push($errors, "Department Name is required");
  }

if (count($errors) == 0) {
  $department_data_update_query = "UPDATE `department_details` SET `department_name`='$department_name' WHERE `department_id` ='$department_id' ";
  $results = mysqli_query($db, $department_data_update_query);

  header('location: departments.php');
  }else{
  array_push($errors, "Unable to push updates");
  header('location: departments.php');
  }
}
}

  // Delete department Details
if (isset($_POST['delete-department-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $departmentID = $_POST['department_id'];
  
  if (empty($departmentID)) {
    array_push($errors, "Department ID is required");
  }
  if (count($errors) == 0) {
      $dpt_data_delete_query = "DELETE FROM `department_details` WHERE `department_id`='$departmentID' ";
      $results = mysqli_query($db, $dpt_data_delete_query);

        header('location: departments.php');
      }else{
        array_push($errors, "Unable to delete user");
        header('location: departments.php');
      }
  }
}

function capitalizeWords($string) {
  return ucwords(strtolower($string));
}

function generate_department_id($faculty_name, $department_name) {
  // Convert faculty and department names to uppercase
  $faculty_name = strtoupper($faculty_name);
  $department_name = strtoupper($department_name);

  // Remove any non-alphabetic characters from the faculty and department names
  $faculty_name = preg_replace('/[^A-Z]/', '', $faculty_name);
  $department_name = preg_replace('/[^A-Z]/', '', $department_name);

  // Extract the first two letters of the faculty name and the last two letters of the department name
  $faculty_code = substr($faculty_name, 0, 4);
  $department_code = substr($department_name, -2);

  // Generate a random 3-digit number between 100 and 999
  $random_number = rand(100, 999);

  // Combine the faculty code, department code, and random number to form the department ID
  $department_id = $faculty_code . $department_code . $random_number;

  // Return the department ID
  return $department_id;
}



//add department
if (isset($_POST['add-department-btn'])) {
  $school_id = $_POST['uni_schools'];
  $dpt_name = $_POST['department_name'];

  if (empty($school_id)) {
    array_push($errors, "School ID is required");
  }
  if (empty($dpt_name)) {
    array_push($errors, "Department name is required");
  }
  
  if (count($errors) == 0) {
    // Example usage of generate_dpt_id function

    //generate department id
$department_id = generate_department_id($school_id, $dpt_name);

    $add_dpt_query = "INSERT INTO `department_details`(`department_id`, `department_name`) VALUES ('$department_id','$dpt_name')";
    $results = mysqli_query($db, $add_dpt_query);

    //link sch with dpt
    $add_sch_dpt_query = "INSERT INTO `school_department_details`(`school_id`, `department_id`) VALUES ('$school_id','$department_id')";
    $results_sch_dpt = mysqli_query($db, $add_sch_dpt_query);

      header('location: ./departments.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./departments.php');
    }
  }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Courses | EDUTIME</title>
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
              <h4 class="page-title">Course Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Courses
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
            <h5 class="card-title">List of Courses</h5>
            <input type='button' value='Add a Course' name='open-course-modal-btn' class='btn btn-primary float-end open-course-modal-btn m-2'>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
    <tr>
    <th>Course ID</th>
    <th>Course Name</th>
    <th>School</th>
    <th>Department</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `course_details` INNER JOIN department_course_details ON department_course_details.course_id = course_details.course_id INNER JOIN department_details ON department_course_details.department_id = department_details.department_id INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id INNER JOIN school_details ON school_details.school_id =school_department_details.school_id  ";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $course_id = $row['course_id'];
              $course_name = $row['course_name'];
              $school_name = $row['school_name'];
              $department_name = $row['department_name'];
              $date_created = $row['date_added'];



      echo "<tr> <td>" .$course_id.  "</td>";
      echo "<td>" .$course_name."</td>";
      echo "<td>" .$school_name."</td>";
      echo "<td>" .$department_name."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='Course_id' value='$course_id'>
      <input type='submit' data-crsid='$course_id'  data-crsname='$course_name'  value='Edit Details' name='edit-course-btn' class='btn btn-success edit-course-modal-btn m-2'>
      <input type='submit' data-id= '$course_id' value='Delete Course'  class='btn btn-danger deleteCourseBtn'>
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
    <th>Course ID</th>
    <th>Course Name</th>
    <th>School</th>
    <th>Department</th>
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
            <input type="text" hidden  class="form-control" id="courseID" required readonly name='course_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" name='delete-department-btn' class="btn btn-danger">Yes,Delete!</button>
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
        
            <input type="text" readonly hidden name="crs_id"  class="form-control" id="crs_id" required>
          
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">Course Name:</label>
            <input type="text" name="crs_name"  class="form-control" id="crs_name" required>
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

<!-- add new Course-->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCourseModalLabel">Add a Course</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="POST" action="">

<!-- Add an onchange event to the school select element -->
<div class="form-group">
  <label for="uni_school_id">Select School</label>
  <select class="form-control" id="uni_school_id" name="uni_schools" onchange="getDepartments()">
    <option value="">Select school..</option>
    <?php 
    // Retrieve the schools from the database
    $sql=mysqli_query($db,"select * from school_details");
    while ($rw=mysqli_fetch_array($sql)) {
    ?>
    <option value="<?php echo htmlentities($rw['school_id']);?>">School of <?php echo htmlentities($rw['school_name']);?></option>
    <?php
    }
    ?>
  </select>
</div>

<!-- Add a new div to display the departments -->
<div class="form-group" id="department_div">
  <!-- Add a hidden field to store the selected school id -->
<input type="hidden" id="selected_school_id" name="selected_school_id" value="">
  <label for="uni_department_id">Select Department</label>
  <select class="form-control" id="uni_department_id" name="uni_departments">
    <option value="">Select Department..</option>

    <?php 
// Get the selected school id
$selectedSchoolId = $_GET['selected_school_id'];

    // Retrieve the schools from the database
    $sql=mysqli_query($db,"SELECT * FROM department_details INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_id WHERE school_department_details.school_id ='$selectedSchoolId' ");
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
          <input type="text" name="Course_name"  class="form-control" id="crs_name" required placeholder="e.g Bachelor of Science in Information Technology">
        </div>
        <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-info" name="add-course-btn">Submit</button>
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

//add Course details modal code
function openCourseModal() {
  $("#addCourseModal").modal("show");
}
let openAddCourseModalBtn = document.querySelector(".open-course-modal-btn");
openAddCourseModalBtn.addEventListener("click", function (e) {
  e.preventDefault();
  openCourseModal();
});

function getDepartments() {
    // Get the selected school id
    var selectedSchoolId = document.getElementById("uni_school_id").value;
    // alert(selectedSchoolId)
    // Set the selected school id in the hidden field
    document.getElementById("selected_school_id").value = selectedSchoolId;
    
    // Make an AJAX request to retrieve the departments
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "departments.php?department_id=" + selectedSchoolId, true);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Update the department select element
            console.log(this.responseText);
            document.getElementById("uni_department_id").innerHTML = this.responseText;
        }
    };
    xhr.send();
}

// //edit Department details modal code
// function editDepartmentModal() {
//     $("#editDepartmentModal").modal("show");
//   }
//   let editButtons = document.querySelectorAll(".edit-department-modal-btn");
//   editButtons.forEach(function (editButton) {
//     editButton.addEventListener("click", function (e) {
//       e.preventDefault();
  
//       let departmentid = editButton.dataset.dptid;
//       let dpt_name = editButton.dataset.dptname;

//       document.getElementById("dpt_id").value = departmentid ;
//       document.getElementById("dpt_name").value = dpt_name;

//       editDepartmentModal();
//     });
//   });


  //delete Department modal query
  //   function deleteDepartmentModal() {
  //   $("#deleteDepartmentModal").modal("show");
  // }
  // let deleteBtns = document.querySelectorAll(".deleteDepartmentBtn");
  // deleteBtns.forEach(function (deleteBtn) {
  //   deleteBtn.addEventListener("click", function (e) {
  //     e.preventDefault();
  
  //     let dptid = deleteBtn.dataset.id;
  
  //     document.getElementById("departmentID").value = dptid;
     
  //     deleteDepartmentModal();
  //   });
  // });

  </script>

  </body>
</html>
