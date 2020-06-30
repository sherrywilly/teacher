<?php
error_reporting(0);
include 'config.php';
$password = $_POST['tpass'];
$tid = $_POST['tid'];
if ($password != '') {
    $tname = $_POST['tname'];
    $temail = $_POST['temail'];
    $tphone = $_POST['tphone'];
   

    $sql = "update tbl_teacher set
    teacher_name = '$tname',
    teacher_emailid = '$temail',
    teacher_phno = '$tphone',
    teacher_password = '$password'
    where teacher_id = '$tid'";
    mysqli_query($conn,$sql);
    $output = array(
        'success'		=>	'update successfully'
    );
  
}else{

    $tname = $_POST['tname'];
    $temail = $_POST['temail'];
    $tphone = $_POST['tphone'];

    $query = "update tbl_teacher set
    teacher_name = '$tname',
    teacher_emailid = '$temail',
    teacher_phno = '$tphone',
    where teacher_id = '$tid'";
    if( mysqli_query($conn,$query)==TRUE){
    $output = array(
        'success'		=>	'update successfully'
    );
}else{
    $output = array(
        'success'		=>	'error successfully'
    );
}
}


echo json_encode($output);


?>


