
<?php

//header.php

include('config.php');
session_start();

if(!isset($_SESSION["teacher_id"]))
{
  header('location:login.php');
}else{

header('location:dashboard.php');

}

?>