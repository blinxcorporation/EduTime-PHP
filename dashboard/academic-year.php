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
        array_push($errors, "Unable to delete Course");
        header('location: courses.php');
      }
  }
}

function generate_academic_year_id($year1, $year2) {
  $crs_prefix = 'YR';
  $id =strtoupper($crs_prefix."_".$year1."_".$year2);
  return $id;
}

//add academic-year
if (isset($_POST['add-academic-year-btn'])) {
  $year_1 = $_POST['acad_year_1'];
  $year_2 = $_POST['acad_year_2'];

  if (empty($year_1)) {
    array_push($errors, "Year 1 is required");
  }
  if (empty($year_2)) {
    array_push($errors, "Year 2 is required");
  }

  if (count($errors) == 0) {

    //generate academic year id
    $academic_yr_id = generate_academic_year_id($year_1,$year_2);
    $academic_year = $year_1 ."/".$year_2;

    $add_academic_yr_query = "INSERT INTO `academic_year`(`academic_year_id`, `academic_year`) VALUES ('$academic_yr_id','$academic_year')";
    $results = mysqli_query($db, $add_academic_yr_query);

      header('location: ./academic-year.php');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: ./academic-year.php');
    }
  }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Academic-Year | EDUTIME</title>
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
              <h4 class="page-title">Academic Year Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Academic Year
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
            <h5 class="card-title">List of Academic Years</h5>
            <input type='button' value='Add Academic Year' name='open-academic-year-btn' class='btn btn-primary float-end open-academic-year-modal-btn m-2'>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
<thead>
    <tr>
    <th>Year ID</th>
    <th>Academic Year</th>
    <th>Date Added</th>
    <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if($_SESSION['role_name'] == 'Admin'){
      $data_fetch_query = "SELECT * FROM `academic_year`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $year_id = $row['academic_year_id'];
              $year_desc = $row['academic_year'];
              $date_created = $row['date_added'];

      echo "<tr> <td>" .$year_id.  "</td>";
      echo "<td>" .$year_desc."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='course_id' value='$course_id'>
      <input type='submit' data-crsid='$course_id'  data-crsname='$course_name' data-crs_short_name='$shortname' data-crs_dpt_id='$department_id' value='Edit Details' name='edit-course-btn' class='btn btn-success edit-course-modal-btn m-2'>
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
    <th>Year ID</th>
    <th>Academic Year</th>
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
        <p>Are you sure you want to delete this Academic Year?</p>
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

<!-- add new Academic Year-->
<div class="modal fade" id="addAcademicYearModal" tabindex="-1" role="dialog" aria-labelledby="addAcademicYearModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAcademicYearModalLabel">Add a Academic Year</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
      <div class="form-group">
      <div class="row">
      <label for="academic year">Academic Year e.g (2019/2020)</label>
    <div class="col-md-5">
      <input type="number" class="form-control" placeholder="e.g 2019" name="acad_year_1" id="acad_year_1_id" min="1990" max="3099" required>
    </div>
    <div class="col-md-2">
        <p style="font-size:24px;">/</p>
</div>
    <div class="col-md-5">
    <input type="number" class="form-control" placeholder="e.g 2020" name="acad_year_2" id="acad_year_2_id" min="1991" max="3099" required>
    </div>
  </div>
        <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-info" name="add-academic-year-btn">Submit</button>
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

//add academic year details modal code
function openAcademicYearModal() {
  $("#addAcademicYearModal").modal("show");
}
let openAcademicYearModalBtn = document.querySelector(".open-academic-year-modal-btn");
openAcademicYearModalBtn.addEventListener("click", function (e) {
  e.preventDefault();
  openAcademicYearModal();
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
