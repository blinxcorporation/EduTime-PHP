<?php
include '../server.php';

$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$username = $_SESSION['username'];
$mail = $_SESSION['emailaddress'];

// Update Student Details
if (isset($_POST['update-student-details-btn'])) {
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $emailAddress = $_POST['mail'];
  $phoneNum= $_POST['phonenum'];
  $college= $_POST['college'];

  $course= $_POST['course'];
  $duration= $_POST['duration'];
  $start_date= $_POST['start_date'];
  $end_date= $_POST['end_date'];
  $yearofstudy= $_POST['yearofstudy'];
  $sem= $_POST['sem'];

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($fname)) {
  	array_push($errors, "First Name is required");
  }
  if (empty($lname)) {
  	array_push($errors, "Last Name is required");
  }
  if (empty($emailAddress)) {
  	array_push($errors, "Email is required");
  }
  if (empty($phoneNum)) {
  	array_push($errors, "Phone number is required");
  }
  if (empty($college)) {
  	array_push($errors, "College is required");
  }
  if (empty($course)) {
  	array_push($errors, "Course is required");
  }
  if (empty($duration)) {
  	array_push($errors, "Duration is required");
  }
  if (empty($start_date)) {
  	array_push($errors, "Start Date is required");
  }
  if (empty( $end_date)) {
  	array_push($errors, "End Date is required");
  }
  if (empty($yearofstudy)) {
  	array_push($errors, "Year of is required");
  }
  if (empty($sem)) {
  	array_push($errors, "Semester is required");
  }

  if (count($errors) == 0) {
  	$student_data_update_query = "UPDATE `student_details` SET `student_username`='$username',`student_firstname`='$fname',`student_middlename`='$mname',`student_lastname`='$lname',`student_email`='$emailAddress',`student_phone`='$phoneNum' WHERE `student_username` ='$username' ";
  	$results = mysqli_query($db, $student_data_update_query);

    $college_data_update_query = "UPDATE `student_institution_details` SET `institution_name`='$college',`course_name`='$course',`course_duration`='$duration',`start_date`='$start_date',`end_date`='$end_date',`yearOfStudy`='$yearofstudy',`currentSemester`='$sem' WHERE `student_id` = '$username'";
  	$results = mysqli_query($db, $college_data_update_query);

  	  header('location: students.php');
  	}else{
  		array_push($errors, "Unable to push updates");
      header('location: students.php');
  	}
  }

  // Delete student Details
  if (isset($_POST['delete-student-btn'])) {
    $studentID = $_POST['student_id'];
    
    if (empty($studentID)) {
      array_push($errors, "Student ID is required");
    }
    if (count($errors) == 0) {
        $student_data_delete_query = "DELETE FROM `student_details` WHERE `student_username`='$studentID' ";
        $results = mysqli_query($db, $student_data_delete_query);

          header('location: students.php');
        }else{
          array_push($errors, "Unable to delete user");
          header('location: students.php');
        }
    }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Students | WKEO </title>
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
              <h4 class="page-title">Student Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Students
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
   
                  <h5 class="card-title">List of Students</h5>

                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>Student's Name</th>
                          <th>Category</th>
                          <th>Institution</th>
                          <th>Email</th>
                          <th>Course</th>
                          <th>Progress</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php
  if($_SESSION['username']){
      $data_fetch_query = "SELECT * FROM `student_details`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $student_id = $row['student_username'];
              $fname = $row['student_firstname'];
              $mname = $row['student_middlename'];
              $lname = $row['student_lastname'];
              $studentEmail = $row['student_email'];
              $studentPhone = $row['student_phone'];

              $data_fetch = "SELECT * FROM `student_institution_details` WHERE `student_id` ='$student_id'";
              $result = mysqli_query($db, $data_fetch);
              if ($result->num_rows > 0){
                while($rw = $result->fetch_assoc()) {
                  $institution_id= $rw["institution_id"];
                  $category= $rw["category"];
                  $institution_name= $rw["institution_name"];
                  $duration= $rw["course_duration"];
                  $yearOfStudy= $rw["yearOfStudy"];
                  $semester= $rw["currentSemester"];
                  $course= $rw["course_name"];
                  $start_date= $rw["start_date"];
                  $end_date= $rw["end_date"];
                }}

      echo "<tr> <td>" .$fname." ".$lname.  "</td>";
      echo "<td>" .$category."</td>";
      echo "<td>" .$institution_name."</td>";
      echo "<td>" .$studentEmail."</td>";
      echo "<td>" .$course."</td>";
      echo "<td>" ."Year ".$yearOfStudy.","."Semester ".$semester."</td>";
      echo "<td>" .$start_date."</td>";
      echo "<td>" .$end_date."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='student_id' value='$student_id'>
      <input type='submit' data-id='$student_id' data-category='$category' data-fname='$fname' data-mname='$mname' data-lname='$lname' data-mail='$studentEmail' data-phone='$studentPhone' data-college='$institution_name' data-duration='$duration' data-yearofstudy='$yearOfStudy' data-sem='$semester' data-course='$course' data-start='$start_date' data-end='$end_date' value='Edit Details' name='edit-student-btn' class='btn btn-success edit-student-modal-btn m-2'>
      <input type='submit' data-id= '$student_id' value='Delete Student'  class='btn btn-danger deleteStudentBtn'>
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
                        <th>Student's Name</th>
                          <th>Category</th>
                          <th>Institution</th>
                          <th>Email</th>
                          <th>Course</th>
                          <th>Progress</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
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
    <div class="modal" id='deleteStudentModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
        <p>Are you sure you want to delete this user?</p>
        <form method="POST" action="">
        <div class="form-group">
            <input type="text" hidden  class="form-control" id="StudentID" required readonly name='student_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No Cancel</button>
        <button type="submit" name='delete-student-btn' class="btn btn-danger">Yes Delete!</button>
      </div>
        </form>
      </div>
      
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Student Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="form-group">
            <label for="recipient-name" hidden readonly class="col-form-label">Username:</label>
            <input type="text" readonly hidden name="username"  class="form-control" id="username" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" name="fname" class="form-control" id="fname" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Middle Name:</label>
            <input type="text" name="mname" class="form-control" id="mname">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Last Name:</label>
            <input type="text" name="lname" class="form-control" id="lname" required>
          </div>
         
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="email" name="mail" class="form-control" id="mail" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone:</label>
            <input type="text" name="phonenum" class="form-control" id="phonenum" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category:</label>
            <input type="text" name="category" class="form-control" id="category" required placeholder="University, College, Secondary, Others">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Institution:</label>
            <input type="text" name="college" class="form-control" id="college" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Course:</label>
            <input type="text" name="course" class="form-control" id="course" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Duration:</label>
            <input type="number" name="duration" class="form-control" id="duration" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Start Date:</label>
            <input type="date" name="start_date" class="form-control" id="start_date" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">End Date:</label>
            <input type="date" name="end_date" class="form-control" id="end_date" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Year of Study:</label>
            <input type="number" name="yearofstudy" class="form-control" id="yearofstudy" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Current Semester:</label>
            <input type="number" name="sem" class="form-control" id="semester" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="update-student-details-btn">Update Details</button>
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
//edit student details modal code
function editStudentModal() {
    $("#editStudentModal").modal("show");
  }
  let editButtons = document.querySelectorAll(".edit-student-modal-btn");
  editButtons.forEach(function (editButton) {
    editButton.addEventListener("click", function (e) {
      e.preventDefault();
  
      let studentid = editButton.dataset.id;
      let fname = editButton.dataset.fname;
      let mname = editButton.dataset.mname;
      let lname = editButton.dataset.lname;
      let mail = editButton.dataset.mail;
      let category = editButton.dataset.category;

      let phone = editButton.dataset.phone;
      let college = editButton.dataset.college;
      let duration = editButton.dataset.duration;
      let yearofstudy = editButton.dataset.yearofstudy;

      let sem = editButton.dataset.sem;
      let course = editButton.dataset.course;
      let start = editButton.dataset.start;
      let end = editButton.dataset.end;

      document.getElementById("username").value = studentid;
      document.getElementById("fname").value = fname;
      document.getElementById("mname").value = mname;
      document.getElementById("lname").value = lname;
      document.getElementById("mail").value = mail;
      document.getElementById("phonenum").value = phone;
      document.getElementById("college").value = college;
      document.getElementById("course").value = course;
      document.getElementById("duration").value = duration;
      document.getElementById("start_date").value = start;
      document.getElementById("end_date").value = end;
      document.getElementById("yearofstudy").value = yearofstudy;
      document.getElementById("semester").value = sem;
      document.getElementById("category").value = category;



      editStudentModal();
    });
  });


  //delete student modal query
    function deleteStudentModal() {
    $("#deleteStudentModal").modal("show");
  }
  let deleteBtns = document.querySelectorAll(".deleteStudentBtn");
  deleteBtns.forEach(function (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
  
      let Studentid = deleteBtn.dataset.id;
  
      document.getElementById("StudentID").value = Studentid;
   
  
      deleteStudentModal();
    });
  });

  </script>

  </body>
</html>
