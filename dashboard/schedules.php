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
if ($_SESSION['role_name'] !== 'Dean' && $_SESSION['role_name'] !== 'Lecturer' &&  $_SESSION['role_name'] !== 'Chairperson') {
    // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
    header("Location: index.php"); // replace 'index.php' with the URL of a non-privileged page
    exit;
  }
  

  //sessions  

  $pfno = $_SESSION['pfno'];
  $salutation= $_SESSION['salutation'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $name = $_SESSION['fname'] . " ".$_SESSION['lname'];
  $mail = $_SESSION['email'];
  
//Download Personal TT
if (isset($_POST['download-personal-tt-btn'])) {

    $lec = $_POST['lec_pf'];
    $lec_name = $_POST['lec_name'];
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    
    // Set the file name
    $filename = $lname . '-timetable.pdf';
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Create a new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set the font and font size for the document
    $pdf->SetFont('Arial', 'B', 14);

    // Add the logo to the document
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 25, 10, 50, 0, 'PNG');
    
    // Query to get the school details
    $sql = "SELECT *
    FROM unit_room_time_day_allocation_details urtd1
    INNER JOIN lecturer_unit_details lud ON urtd1.unit_id = lud.unit_id
    INNER JOIN user_details ud ON lud.lecturer_id = ud.pf_number
    INNER JOIN unit_room_time_day_allocation_details urtd2 ON urtd1.unit_id = urtd2.unit_id
    WHERE urtd2.lecturer_id = 'PF01'";
    $result = mysqli_query($db, $sql);

    // Write the title of the document
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 50, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Maseno University', 0, 1, 'C');
    $pdf->Cell(0, 10,$salutation." ".$lname."'s"." Personal Timetable", 0, 1, 'C');

    // Set the font and font size for the table headers
    $pdf->SetFont('Arial', 'B', 12);

    // Write the headers of the table
    $pdf->Cell(40, 10, 'Unit', 1);
    $pdf->Cell(50, 10, 'Day', 1);
    $pdf->Cell(50, 10, 'Room', 1);
    $pdf->Cell(50, 10, 'Time', 1);
    $pdf->Ln();


    // Set the font and font size for the table rows
    $pdf->SetFont('Arial', '', 10);

    // Loop through the results and write them to the table
    if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40, 10, $row['unit_id'], 1);
        $pdf->Cell(50, 10, $row['weekday'], 1);
        $pdf->Cell(50, 10, $row['room_id'], 1);
        $pdf->Cell(50, 10, $row['time_slot_id'], 1);
        $pdf->Ln();
    }
    }

    // Close the database connection and output the PDF
    mysqli_close($db);
    $pdf->Output('D', $filename);

        // header('location: ./reports.php');
}
    


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
                <?php
    if ($_SESSION['role_name'] === 'Admin'){
    // display the HTML code if the session variable 'role_name' is set to 'Admin'
    ?>
                <div class="col-md-3">
                    <a href="#" name="faculty-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Faculty Details</h6>
                                    <input type="submit" name="download-school-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="department-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf "></i>
                                    </h1>
                                    <h6 class="text-light">Department Details</h6>
                                    <input type="submit" name="download-department-btn" class="btn btn-success"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="course-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Course Details</h6>
                                    <input type="submit" name="download-course-btn" class="btn btn-cyan"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="unit-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Unit Details</h6>
                                    <input type="submit" name="download-unit-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="unit-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-secondary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Lecturer Details</h6>

                                    <input type="submit" name="download-lecturer-btn" class="btn btn-success"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="lecturer-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Room Details</h6>
                                    <input type="submit" name="download-room-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="timetable.csv" download>
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-excel"></i>
                                    </h1>
                                    <h6 class="text-light">Timetable</h6>
                                    <a href="timetable.csv" class="btn btn-success" download>Download</a>
                                </div>
                            </div>
                        </form>
                    </a>
                </div>
                <?php
    }
    ?>


                <!-- personal TT -->
                <?php
if ($_SESSION['role_name'] === 'Chairperson' || $_SESSION['role_name'] === 'Lecturer' || $_SESSION['role_name'] === 'Dean'){
// display the HTML code if the session variable 'role_name' is set to 'Admin'
?>
                <div class="col-md-3">
                    <a href="#" name="lecturer-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Personal Timetable</h6>
                                    <input type='text' readonly hidden value='<?php echo $pfno; ?>' name='lec_pf'>
                                    <input type='text' readonly hidden value='<?php echo $name; ?>' name='lec_name'>
                                    <input type="submit" name="download-personal-tt-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="lecturer-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Departmental Timetable</h6>
                                    <input type="submit" name="download-department-tt-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>
                        </form>
                    </a>
                </div>
                <?php
}
?>


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
    </script>

</body>

</html>