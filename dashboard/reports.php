<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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


if (isset($_POST['download-school-btn'])) {
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    // Set the file name
    header('Content-Disposition: attachment; filename="school_details.pdf"');

    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set the font and font size for the document
    $pdf->SetFont('Arial', 'B', 14);

    // Add the logo to the document
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 25, 10, 50, 0, 'PNG');

    // Write the title of the document
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 50, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Maseno University', 0, 1, 'C');
    $pdf->Cell(0, 10, 'School Details', 0, 1, 'C');

    // Set the font and font size for the table headers
    $pdf->SetFont('Arial', 'B', 12);

    // Write the headers of the table
    $pdf->Cell(50, 10, 'School ID', 1);
    $pdf->Cell(90, 10, 'School Name', 1);
    $pdf->Cell(40, 10, 'Short Form', 1);
    $pdf->Ln();


    // Query to get the school details
    $sql = "SELECT * FROM school_details";
    $result = mysqli_query($db, $sql);

    // Set the font and font size for the table rows
    $pdf->SetFont('Arial', '', 10);

    // Loop through the results and write them to the table
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(50, 10, $row['school_id'], 1);
        $pdf->Cell(90, 10, $row['school_name'], 1);
        $pdf->Cell(40, 10, $row['school_shortform'], 1);
        $pdf->Ln();
    }
    }

    // Close the database connection and output the PDF
    mysqli_close($db);
    $pdf->Output('D', 'school_details.pdf');

        // header('location: ./reports.php');
}
    

$pfno = $_SESSION['pfno'];
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Reports | EDUTIME</title>
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
                    <h4 class="page-title">Reports</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Reports
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
                <div class="col-md-3">
                    <a href="#" name="faculty-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-download "></i>
                                    </h1>
                                    <!-- <h6 class="text-light">Faculty Details</h6> -->
                                    <input type="submit" name="download-school-btn" class="btn btn-info"
                                        value="Download Faculty Details" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>



                <div class="col-md-3">
                    <a href="">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <i class="fa fa-file-download"></i>
                                </h1>
                                <h6 class="text-light">Department Details</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <form method="POST" action="">
                        <a href="">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-cloud-download-alt"></i>
                                    </h1>
                                    <h6 class="text-light">Course Details</h6>
                                </div>
                            </div>
                        </a>

                    </form>
                </div>

                <div class="col-md-3">
                    <a href="">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    <i class="fa fa-file-excel"></i>
                                </h1>
                                <h6 class="text-light">Unit Details</h6>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3">
                    <a href="">
                        <div class="card card-hover">
                            <div class="box bg-secondary text-center">
                                <h1 class="font-light text-white">
                                    <i class="fa fa-file-pdf"></i>
                                </h1>
                                <h6 class="text-light">Lecturer Details</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    <i class="fa fa-cloud-download-alt"></i>
                                </h1>
                                <h6 class="text-light">Room Details</h6>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="timetable.csv" download>
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">
                                    <i class="fa fa-file-excel"></i>
                                </h1>
                                <h6 class="text-light">Timetable</h6>
                            </div>
                        </div>
                    </a>
                </div>



            </div>
            <!--close row-->

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
                        <p>Are you sure you want to delete this Timeslot?</p>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="timeSlot_ID" required hidden readonly
                                    name='timeSlot_id'>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" name='delete-timeslot-btn'
                                    class="btn btn-danger">Yes,Delete!</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- add new Academic Year-->
    <div class="modal fade" id="addTimeSlotModal" tabindex="-1" role="dialog" aria-labelledby="addTimeSlotModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTimeSlotModalLabel">
                        Add a Timeslot
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-5">
                                    <label for="academic-year">Start Time: (e.g 07:00 AM)</label>
                                    <input type="time" class="form-control" placeholder="e.g 2019" name="start_time"
                                        id="start_time_id" min="07:00" max="19:00" required />
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: 24px">-</p>
                                </div>
                                <div class="col-md-5">
                                    <label for="academic-year">End Time: (e.g 01:00 PM)</label>
                                    <input type="time" class="form-control" placeholder="e.g 2019" name="end_time"
                                        id="end_time_id" min="07:00" max="19:00" required />
                                </div>
                                <div class="modal-footer mt-4">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success" name="add-timeslot-btn">
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
    <!-- <div class="modal fade" id="editAcademicYearModal" tabindex="-1" role="dialog" aria-labelledby="editAcademicYearModalLabel" aria-hidden="true">
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
</div> -->


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
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });

    //add timeslot details modal code
    function openAddTimeSlotModal() {
        $("#addTimeSlotModal").modal("show");
    }
    let openAddTimeslotModalBtn = document.querySelector(".open-timeslot-modal-btn");
    openAddTimeslotModalBtn.addEventListener("click", function(e) {
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
    function deleteTimeslotModal() {
        $("#deleteTimeslotModal").modal("show");
    }
    let deleteBtns = document.querySelectorAll(".deleteTimeslotBtn");
    deleteBtns.forEach(function(deleteBtn) {
        deleteBtn.addEventListener("click", function(e) {
            e.preventDefault();

            let slot_id = deleteBtn.dataset.id;

            document.getElementById("timeSlot_ID").value = slot_id;

            deleteTimeslotModal();
        });
    });
    </script>

</body>

</html>