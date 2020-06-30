<?php

include 'config.php';

session_start();
//var_dump($_POST);
$error = 0;
if (isset($_POST['teacher_emailid'])) {
    if (empty($_POST['teacher_emailid']) || empty($_POST['teacher_password'])) {
        $error++;
    } else {
        $query = "select * from tbl_teacher where teacher_emailid='" . $_POST['teacher_emailid'] . "' and teacher_password='" . $_POST['teacher_password'] . "'";
        $result = mysqli_query($conn, $query);

        if ($res =mysqli_fetch_assoc($result)) {
            $_SESSION['teacher_id'] = $res['teacher_id'];
            $_SESSION['teacher_emailid'] = $_POST['teacher_emailid'];
            $_SESSION['grade_id'] = $res['teacher_grade_id'];
        } else {
            $erremail = 'invalid details';
        $errpas = 'invalid details';
            $error++;
        }
    }
} else {
    echo 'Not Working Now Guys';
}
if($error > 0)
{
	$output = array(
        'error'			=>	true,
        'erremail'	=>	$erremail,
		'errpas'	=>	$errpas
	);
}
else
{
	$output = array(
		'success'		=>	true
	);
}

echo json_encode($output);


?>
