<?php
error_reporting(0);
include 'config.php';
session_start();

$attendance_date = date("Y-m-d");
//echo $student_id;
//var_dump($_POST);
$sem = $_POST['sem'];
$error = 0;

if ($_POST["action"] == "Add") {
    $student_id = $_POST["student_id"];
    $teacher_id = $_SESSION['teacher_id'];
    $grade_id = $_POST['grade_id'];
    $sql = "select * from tbl_attendance where attendance_date = '$attendance_date' and grade_id = '$grade_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        //  echo 'failed';
        $error++;
        $error_message = 'Attendance date already exist';
    } else{

        for ($count = 0; $count < count($student_id); $count++) {

            $st_id = $student_id[$count];
            // $student_id = $student_id[$count];
            $st_id;
            $status = $_POST["att_status" . $student_id[$count] . ""];

            $teacher_id = $_SESSION["teacher_id"];
            $grade_id = $_POST['grade_id'];
            $query = "INSERT INTO tbl_attendance 
 (student_id,grade_id, sem, attendance_status, attendance_date, teacher_id) 
 VALUES ('$st_id', '$grade_id','$sem','$status', '$attendance_date','$teacher_id')";
            mysqli_query($conn, $query);
        }
        $success_message = 'data inserted successfully';
        
    }
}
if ($error > 0) {
    $output = array(
        'error' => true,
        'error_attendance_date' => $error_message
    );
} else{
    $output = array(
        'success'      =>  $success_message
    );

}


echo json_encode($output);
?>