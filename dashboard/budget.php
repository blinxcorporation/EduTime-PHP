<?php
include '../server.php';

$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$username = $_SESSION['username'];
$mail = $_SESSION['emailaddress'];

  // Delete Budget Details
  if (isset($_POST['delete-Budget-btn'])) {
    $budgetID = $_POST['budget_id'];
    
    if (empty($budgetID)) {
      array_push($errors, "Budget ID is required");
    }
    if (count($errors) == 0) {
        $budget_delete_query = "DELETE FROM `budget_details` WHERE `budget_id`='$budgetID' ";
        $results = mysqli_query($db, $budget_delete_query);

          header('location: budget.php');
        }else{
          array_push($errors, "Unable to delete user");
          header('location: budget.php');
        }
    }

    // Update Budget Details
if (isset($_POST['update-Budget-btn'])) {
  $budgetid = $_POST['budgetid'];
  $budget_name = $_POST['budget_name'];
  $year = $_POST['year'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];

  if (empty($budgetid)) {
  	array_push($errors, "Budget ID is required");
  }
  if (empty($budget_name)) {
  	array_push($errors, "Budget Name is required");
  }
  if (empty($year)) {
  	array_push($errors, "Year is required");
  }
  if (empty($amount)) {
  	array_push($errors, "Amount is required");
  }
 if (empty($date)) {
  	array_push($errors, "Date is required");
  }
  
  if (count($errors) == 0) {
  	$budget_update_query = "UPDATE `budget_details` SET `budget_name`='$budget_name',`budget_year`='$year',`budget_amount`='$amount',`budget_date`='$date' WHERE `budget_id`='$budgetid' ";
  	$results = mysqli_query($db, $budget_update_query);


  	  header('location: budget.php');
  	}else{
  		array_push($errors, "Unable to push updates");
      header('location: budget.php');
  	}
  }

  // bgtid bgt bgtyear bgtamount add-bgt-btn
      // add Budget Details
if (isset($_POST['add-bgt-btn'])) {
  $budgetid = $_POST['bgtid'];
  $budget_name = $_POST['bgt_name'];
  $year = $_POST['bgtyear'];
  $amount = $_POST['bgtamount'];
  $date = $_POST['bgtdate'];

  if (empty($budgetid)) {
  	array_push($errors, "Budget ID is required");
  }
  if (empty($budget_name)) {
  	array_push($errors, "Budget is required");
  }
  if (empty($year)) {
  	array_push($errors, "Year is required");
  }
  if (empty($amount)) {
  	array_push($errors, "Amount is required");
  }
  if (empty($date)) {
  	array_push($errors, "Date is required");
  }
  
  if (count($errors) == 0) {
  	$budget_insert_query = "INSERT INTO `budget_details`(`budget_id`, `budget_name`, `budget_year`, `budget_amount`,`budget_date`) VALUES ('$budgetid','$budget_name','$year','$amount','$date')";
  	$results = mysqli_query($db, $budget_insert_query);


  	  header('location: budget.php');
  	}else{
  		array_push($errors, "Unable to push updates");
      header('location: budget.php');
  	}
  }
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Budget | WKEO </title>
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
              <h4 class="page-title">Budget Details</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb pr-5">
                  <ol class="breadcrumb ">
                    <li class="breadcrumb-item p-4">
                     <button type="button" class="btn btn-primary addBudgetBtn">Add Budget</button>
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
 
                  <h5 class="card-title">Budget Details</h5>

                  <div class="table-responsive">
                    <table
                      id="zero_config"
                      class="table table-striped table-bordered"
                    >
                      <thead>
                        <tr>
                        <!-- <th>Budget ID</th> -->
                          <th>Name</th>
                          <th>Year of Study</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
  if($_SESSION['username']){
      $data_fetch_query = "SELECT * FROM `budget_details` ORDER BY budget_year";
      $data_result = mysqli_query($db, $data_fetch_query);
      if ($data_result->num_rows > 0){
          while($row = $data_result->fetch_assoc()) {
              $id = $row['id'];
              $budgetID = $row['budget_id'];
              $budget_name = $row['budget_name'];
              $year = $row['budget_year'];
              $amount = $row['budget_amount'];
              $date = $row['budget_date'];

      echo "<tr> <td>" .$budget_name.  "</td>";
      echo "<td>" .$year."</td>";
      echo "<td>" ."KSH ".number_format($amount)."</td>";
      echo "<td>" .$date."</td>";
      echo "<td>
        
      <form method ='POST' action=''>
      <input  type='text' hidden readonly name='admin_id' value='$budgetID'>
      <input type='submit' data-id='$budgetID' data-name='$budget_name' data-year='$year'  data-amount='$amount' data-date='$date' value='Edit' name='edit-budget-btn' class='btn btn-success editBudgetBtn'>
      <input type='submit' data-id='$budgetID' value='Delete' name='budget-del-btn' class='btn btn-danger delBudgetBtn'>
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
                        <th>Name</th>
                          <th>Year of Study</th>
                          <th>Amount</th>
                          <th>Date</th>
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
    <div class="modal" id='deleteBudgetModal' tabindex="-1" role="dialog" style="color:black;font-weight:normal;">
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
        <p>Are you sure you want to delete this record?</p>
        <form method="POST" action="">
        <div class="form-group">
            <input type="text" readonly hidden class="form-control" id="BudgetID" required  name='budget_id'>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No Cancel</button>
        <button type="submit" name='delete-Budget-btn' class="btn btn-danger">Yes Delete!</button>
      </div>
        </form>
      </div>
      
      </div>
     
    </div>
  </div>
</div>




<div class="modal fade" id="editBudgetModal" tabindex="-1" role="dialog" aria-labelledby="editBudgetModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBudgetModalLabel">Edit Budget Details</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Budget ID:</label>
            <input type="text"  name="budgetid" readonly class="form-control" id="budgetid" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Budget Name:</label>
            <input type="text" name="budget_name" class="form-control" id="budget_name" required>
          </div>
     
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Year of Study:</label>
            <input type="number" name="year" class="form-control" id="year" required>
          </div>
         
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount:</label>
            <input type="number" name="amount" class="form-control" id="amount" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date:</label>
            <input type="date" name="date" class="form-control" id="date" required>
          </div>
         
     
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="update-Budget-btn">Update Details</button>
      </div>
        </form>
      </div>
     
    </div>
  </div>
</div>



<div class="modal fade" id="addBudgetModal" tabindex="-1" role="dialog" aria-labelledby="addBudgetModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBudgetModalLabel">Add a Budget</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Budget ID:</label>
            <input type="text"  name="bgtid"  class="form-control" id="bgtid" required placeholder="e.g BGT02">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Budget Name:</label>
            <input type="text" name="bgt_name" class="form-control" id="bgt" required>
          </div>
     
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Year:</label>
            <input type="number" name="bgtyear" class="form-control" id="bgtyear" required>
          </div>
         
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Amount:</label>
            <input type="number" name="bgtamount" class="form-control" id="bgtamount" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date:</label>
            <input type="date" name="bgtdate" class="form-control" id="bgtdate" required>
          </div>
         
     
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" name="add-bgt-btn">Submit</button>
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

    //add Budget details modal code
function addBudgetModal() {
    $("#addBudgetModal").modal("show");
  }

  let addBudgetButton = document.querySelector(".addBudgetBtn");

  addBudgetButton.addEventListener("click", function (e) {
      e.preventDefault();
       
      addBudgetModal();
    });


   //edit Budget details modal code
  function editBudgetModal() {
    $("#editBudgetModal").modal("show");
  }

  let editButtons = document.querySelectorAll(".editBudgetBtn");
  editButtons.forEach(function (editButton) {
    editButton.addEventListener("click", function (e) {
      e.preventDefault();
  
      let Budgetid = editButton.dataset.id;
      let budget_name = editButton.dataset.name;
      let amount = editButton.dataset.amount;
      let year = editButton.dataset.year;
      let date = editButton.dataset.date;
   
      document.getElementById("budgetid").value = Budgetid;
      document.getElementById("budget_name").value = budget_name;
      document.getElementById("year").value =year;
      document.getElementById("amount").value = amount;
      document.getElementById("date").value = date;
     
      editBudgetModal();
    });
  });


function deleteBudgetModal() {
  $("#deleteBudgetModal").modal("show");
}

  let deleteBtns = document.querySelectorAll(".delBudgetBtn");
  deleteBtns.forEach(function (deleteBtn) {
    deleteBtn.addEventListener("click", function (e) {
      e.preventDefault();
  
      let Budgetid = deleteBtn.dataset.id;
  
      document.getElementById("BudgetID").value = Budgetid;
   
  
      deleteBudgetModal();
    });
  });



</script>

  </body>
</html>
