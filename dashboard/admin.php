<?php
include '../server.php';

$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$username = $_SESSION['username'];
$mail = $_SESSION['emailaddress'];

  // Delete Admin Details
  if (isset($_POST['delete-Admin-btn'])) {
    $adminID = $_POST['Admin_id'];
    
    if (empty($adminID)) {
      array_push($errors, "Admin ID is required");
    }
    if (count($errors) == 0) {
        $admin_delete_query = "DELETE FROM `admin_details` WHERE `admin_username`='$adminID' ";
        $results = mysqli_query($db, $admin_delete_query);

          header('location: admin.php');
        }else{
          array_push($errors, "Unable to delete user");
          header('location: admin.php');
        }
    }

    // Update Admin Details
if (isset($_POST['update-Admin-btn'])) {
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $emailAddress = $_POST['mail'];
  $phoneNum= $_POST['phonenum'];


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
  
  if (count($errors) == 0) {
  	$admin_update_query = "UPDATE `admin_details` SET `admin_firstname`='$fname',`admin_lastname`='$lname',`admin_email`='$emailAddress',`admin_phone`='$phoneNum' WHERE `admin_username` ='$username' ";
  	$results = mysqli_query($db, $admin_update_query);


  	  header('location: admin.php');
  	}else{
  		array_push($errors, "Unable to push updates");
      header('location: admin.php');
  	}
  }


?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Admins | WKEO </title>
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
              <h4 class="page-title">Admin Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Admins
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
 
                  <h5 class="card-title">Admin Details</h5>

                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                          <th>Admin's Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
  if($_SESSION['username']){
      $data_fetch_query = "SELECT * FROM `admin_details`";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $admin_id = $row['admin_username'];
              $admin_fname = $row['admin_firstname'];
              $admin_lname = $row['admin_lastname'];
              $admin_email = $row['admin_email'];
              $admin_phone = $row['admin_phone'];

         

      echo "<tr> <td>" .$admin_fname." ".$admin_lname.  "</td>";
      echo "<td>" .$admin_email."</td>";
      echo "<td>" .$admin_phone."</td>";
      echo "<td>
        
      <form method ='POST' action='admin.php'>
      <input  type='text' hidden readonly name='admin_id' value='$admin_id'>
      <input type='submit' data-id='$admin_id' data-phone='$admin_phone' data-fname='$admin_fname'  data-mname='$admin_mname' data-lname='$admin_lname' data-mail='$admin_email' value='Edit' name='edit-admin-btn' class='btn btn-success editAdminBtn'>
      <input type='submit' data-id= '$admin_id' value='Delete' name='admin-del-btn' class='btn btn-danger delAdmBtn'>
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
                        <th>Admin's Name</th>
                          <th>Email</th>
                          <th>Phone</th>
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
    <div class="modal" id='deleteAdminModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
            <input type="text" hidden class="form-control" id="AdminID" required readonly name='Admin_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No Cancel</button>
        <button type="submit" name='delete-Admin-btn' class="btn btn-danger">Yes Delete!</button>
      </div>
        </form>
      </div>
      
      </div>
     
    </div>
  </div>
</div>




<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAdminModalLabel">Edit Admin Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="form-group">
            <label for="recipient-name"hidden class="col-form-label">Username:</label>
            <input type="text" hidden name="username" readonly class="form-control" id="username" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" name="fname" class="form-control" id="fname" required>
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
        
       
     
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="update-Admin-btn">Update Details</button>
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

    //edit admin details modal code
function editAdminModal() {
    $("#editAdminModal").modal("show");
  }
  let editButtons = document.querySelectorAll(".editAdminBtn");
  editButtons.forEach(function (editButton) {
    editButton.addEventListener("click", function (e) {
      e.preventDefault();
  
      let Adminid = editButton.dataset.id;
      let fname = editButton.dataset.fname;
      let lname = editButton.dataset.lname;
      let mail = editButton.dataset.mail;
      let phone = editButton.dataset.phone;
 

      document.getElementById("username").value = Adminid;
      document.getElementById("fname").value = fname;
      document.getElementById("lname").value = lname;
      document.getElementById("mail").value = mail;
      document.getElementById("phonenum").value = phone;


      editAdminModal();
    });
  });

    //delete admin modal query
    function deleteAdminModal() {
    $("#deleteAdminModal").modal("show");
  }
  let deleteBtns = document.querySelectorAll(".delAdmBtn");
  deleteBtns.forEach(function (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
  
      let Adminid = deleteBtn.dataset.id;
  
      document.getElementById("AdminID").value = Adminid;
   
  
      deleteAdminModal();
    });
  });



</script>

  </body>
</html>
