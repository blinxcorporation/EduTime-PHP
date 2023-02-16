<?php
include '../server.php';

$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$username = $_SESSION['username'];
$mail = $_SESSION['emailaddress'];

// Register Student
if (isset($_POST['student_register_btn'])) {
  // receive all input values from the form
  $student_ID=$_POST['student_id'];
  $fName =  $_POST['student_fname'];
  $mName =  $_POST['student_mname'];
  $lName =  $_POST['student_lname'];
  $sEmail =  $_POST['student_email'];
  $sNumber =  $_POST['student_phone'];
  $category=  $_POST['category'];
  $college=  $_POST['institution_name'];
  $course =  $_POST['course_name'];
  $duration =  $_POST['course_duration'];
  $startDate =  $_POST['start_date'];
  $endDate =  $_POST['end_date'];
  $yearOfStudy =  $_POST['yearofstudy'];
  $semester=  $_POST['current_semester'];

  // form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
if (empty($student_ID)) { array_push($errors, "Student ID is required"); }
if (empty($fName)) { array_push($errors, "First Name is required"); }
if (empty($lName)) { array_push($errors, "Last Name is required"); }
if (empty($sEmail)) { array_push($errors, "Email is required"); }
if (empty($sNumber)) { array_push($errors, "Phone Number is required"); }
if (empty( $category)) { array_push($errors, "Category is required"); }
if (empty( $college )) { array_push($errors, "College is required"); }
if (empty( $course )) { array_push($errors, "Course is required"); }
if (empty( $duration )) { array_push($errors, "Duration is required"); }
if (empty( $startDate )) { array_push($errors, "Start Date is required"); }
if (empty( $endDate )) { array_push($errors, "Finish Date is required"); }
if (empty( $yearOfStudy )) { array_push($errors, "Year of Study is required"); }
if (empty( $semester )) { array_push($errors, "Semester is required"); }

// first check the database to make sure
// a student does not already exist with the same username
$student_check_query = "SELECT * FROM `student_details` WHERE student_username='$student_ID'  LIMIT 1";
$result = mysqli_query($db, $student_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if student exists
  if ($user['student_username'] === $student_ID) {
    array_push($errors, "student ID already exists");
  }
}
// Finally, register student if there are no errors in the form
if (count($errors) == 0) {
  $student_register_query = "INSERT INTO `student_details`(`student_username`, `student_firstname`, `student_middlename`,`student_lastname`, `student_email`,`student_phone`)
  VALUES ('$student_ID','$fName','$mName','$lName','$sEmail','$sNumber')";
  mysqli_query($db, $student_register_query);

  $college_register_query = "INSERT INTO `student_institution_details`(`category`,`institution_name`, `course_name`, `course_duration`, `start_date`, `end_date`, `yearOfStudy`, `currentSemester`, `student_id`)
   VALUES ('$category','$college','$course','$duration','$startDate','$endDate','$yearOfStudy','$semester','$student_ID')";
  mysqli_query($db, $college_register_query);

  header('location: students.php');
  }else{
    header('location: add-student.php');
  }
}



?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
  <title>Add Student | WKEO </title>
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
     ?>      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row pt-5">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Add Student to WKEO System</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Add Student
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
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" method="POST" action="">
                  <div class="card-body">
                    <h4 class="card-title">Personal Info</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Username</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="sid"
                          name="student_id"
                          required
                          placeholder="Student ID / Birth Certificate Number"
                          
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >First Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="fname"
                          name="student_fname"
                          required
                          placeholder="Enter First Name "
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="mname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Middle Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="mname"
                          name="student_mname"
                        
                          placeholder="Enter Middle Name"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Last Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="lname"
                          name="student_lname"
                          required
                          placeholder="Enter Last Name"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="mail"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Email</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="email"
                          class="form-control"
                          id="mail"
                          name="student_email"
                          required
                          placeholder="e.g user@wxy.com"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="phone"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Phone</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="phone"
                          name="student_phone"
                          required
                          placeholder="0700000000"
                        />
                      </div>
                    </div>


                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Category</label
                      >
                      <div class="col-sm-9">
                    <select class="form-control" id="exampleFormControlSelect1" name="category" required>
                    <option>select...</option>
                        <option value="University">University</option>
                        <option value="College">College</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Others">Others</option>

                    </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Insitution Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="institution_name"
                          name="institution_name"
                          placeholder="Enter Insitution Name"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Course Name</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text"
                          class="form-control"
                          id="course_name"
                          name="course_name"
                          placeholder="Enter Course Name"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="duration"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Course Duration</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="course_duration"
                          name="course_duration"
                          placeholder="e.g 4"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Start Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="start_date"
                          name="start_date"
                          placeholder="Start Date"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="lname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >End Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="end_date"
                          name="end_date"
                          placeholder="End Date"
                        />
                      </div>
                    </div>


                    <div class="form-group row">
                      <label
                        for="duration"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Year of Study</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="yearofstudy"
                          name="yearofstudy"
                          placeholder="e.g 2"
                        />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label
                        for="duration"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Current Semester</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="number"
                          class="form-control"
                          id="current_semester"
                          name="current_semester"
                          placeholder="e.g 1"
                        />
                      </div>
                    </div>

                  </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
              <div class="border-top">
                  <div class="card-body">
            
                  <button type="submit" name="student_register_btn" class="btn btn-primary btn-lg">
                  Register Student
                      </button>
                  </div>
              </div>
            </div>
          <div class="col-md-3"></div>
        </div>
                </form>
              </div>
              
              <div class="col-md-2"></div>
           
              
   
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
    <!-- This Page JS -->
    <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../dist/js/pages/mask/mask.init.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
    <script>
      //***********************************//
      // For select 2
      //***********************************//
      $(".select2").select2();

      /*colorpicker*/
      $(".demo").each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
          control: $(this).attr("data-control") || "hue",
          position: $(this).attr("data-position") || "bottom left",

          change: function (value, opacity) {
            if (!value) return;
            if (opacity) value += ", " + opacity;
            if (typeof console === "object") {
              console.log(value);
            }
          },
          theme: "bootstrap",
        });
      });
      /*datwpicker*/
      jQuery(".mydatepicker").datepicker();
      jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
      });
      var quill = new Quill("#editor", {
        theme: "snow",
      });
    </script>
  </body>
</html>
