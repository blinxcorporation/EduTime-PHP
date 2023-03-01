<!-- // Get the selected school id
$selectedSchoolId = mysqli_real_escape_string($db, $_GET['uni_schools']);

    // Retrieve the schools from the database
    $query = "SELECT * FROM department_details INNER JOIN school_department_details ON school_department_details.department_id = department_details.department_details WHERE school_department_details.school_id = '$selectedSchoolId'";
    $result = mysqli_query($db, $query); -->