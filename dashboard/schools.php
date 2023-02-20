<?php
include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); // replace 'login.php' with the URL of your login page
  exit;
}

if (!isset($_SESSION['role_name']) || $_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
  exit;
}



$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];

// Update School Details
if (isset($_POST['update-school-details-btn'])) {
  if ($_SESSION['role_name'] == 'Admin'){
  $school_id = $_POST['sch_id'];
  $school_name = $_POST['sch_name'];
  $school_short_form = $_POST['sch_short_form'];

//Data Validation
  if (empty($school_id)) {
  	array_push($errors, "School ID is required");
  }
  if (empty($school_name)) {
  	array_push($errors, "School Name is required");
  }
  if (empty($school_short_form)) {
  	array_push($errors, "School Short Form is required");
  }


  if (count($errors) == 0) {
  	$school_data_update_query = "UPDATE `school_details` SET `school_name`='$school_name',`school_shortform`='$school_short_form' WHERE `school_id` ='$school_id' ";
  	$results = mysqli_query($db, $school_data_update_query);

  	header('location: schools.php');
  	}else{
  	array_push($errors, "Unable to push updates");
    header('location: schools.php');
  	}
  }
}

  // Delete School Details
  if (isset($_POST['delete-school-btn'])) {
    if ($_SESSION['role_name'] == 'Admin'){
    $schoolID = $_POST['school_id'];
    
    if (empty($schoolID)) {
      array_push($errors, "School ID is required");
    }
    if (count($errors) == 0) {
        $school_data_delete_query = "DELETE FROM `school_details` WHERE `school_id`='$schoolID' ";
        $results = mysqli_query($db, $school_data_delete_query);

          header('location: schools.php');
        }else{
          array_push($errors, "Unable to delete user");
          header('location: schools.php');
        }
    }
  }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Schools | EDUTIME</title>
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
              <h4 class="page-title">School Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Schools
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
   
                  <h5 class="card-title">List of Schools</h5>

                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>School ID</th>
                          <th>School Name</th>
                          <th>Short Form</th>
                          <th>Date Added</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php
  if($_SESSION['pfno']){
      $data_fetch_query = "SELECT * FROM `school_details`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $school_id = $row['school_id'];
              $school_name = $row['school_name'];
              $school_shrtname = $row['school_shortform'];
              $date_created = $row['date_created'];



      echo "<tr> <td>" .$school_id.  "</td>";
      echo "<td>" .$school_name."</td>";
      echo "<td>" .$school_shrtname."</td>";
      echo "<td>" .$date_created."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden name='School_id' value='$school_id'>
      <input type='submit' data-schid='$school_id'  data-schname='$school_name'   data-schshort='$school_shrtname'  value='Edit Details' name='edit-School-btn' class='btn btn-success edit-School-modal-btn m-2'>
      <input type='submit' data-id= '$school_id' value='Delete School'  class='btn btn-danger deleteSchoolBtn'>
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
                        <th>School ID</th>
                          <th>School Name</th>
                          <th>Short Form</th>
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
    <div class="modal" id='deleteSchoolModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
        <p>Are you sure you want to delete this school?</p>
        <form method="POST" action="">
        <div class="form-group">
            <input type="text" hidden  class="form-control" id="schoolID" required readonly name='school_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="submit" name='delete-school-btn' class="btn btn-danger">Yes,Delete!</button>
      </div>
        </form>
      </div>
      
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="editSchoolModal" tabindex="-1" role="dialog" aria-labelledby="editSchoolModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSchoolModalLabel">Edit School Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="form-group">
            <input type="text" readonly hidden name="sch_id"  class="form-control" id="sch_id" required>
          </div>
        <div class="form-group">
            <label for="recipient-name" readonly class="col-form-label">School Name:</label>
            <input type="text" name="sch_name"  class="form-control" id="sch_name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Short Form:</label>
            <input type="text" name="sch_short_form" class="form-control" id="sch_short_form" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="update-school-details-btn">Update Details</button>
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
//edit School details modal code
function editSchoolModal() {
    $("#editSchoolModal").modal("show");
  }
  let editButtons = document.querySelectorAll(".edit-School-modal-btn");
  editButtons.forEach(function (editButton) {
    editButton.addEventListener("click", function (e) {
      e.preventDefault();
  
      let schoolid = editButton.dataset.schid;
      let sch_name = editButton.dataset.schname;
      let sch_short_name = editButton.dataset.schshort;


      document.getElementById("sch_id").value = schoolid ;
      document.getElementById("sch_name").value = sch_name;
      document.getElementById("sch_short_form").value = sch_short_name;

      editSchoolModal();
    });
  });


  //delete School modal query
    function deleteSchoolModal() {
    $("#deleteSchoolModal").modal("show");
  }
  let deleteBtns = document.querySelectorAll(".deleteSchoolBtn");
  deleteBtns.forEach(function (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
  
      let schoolid = deleteBtn.dataset.id;
  
      document.getElementById("schoolID").value = schoolid;
     
      deleteSchoolModal();
    });
  });

  </script>

  </body>
</html>
