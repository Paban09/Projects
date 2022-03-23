<?php 
session_start();
if (isset($_SESSION['A_UNAME'])) {
    session_destroy();
    header("location:homepage.php");   
}
else{
    header("location:homepage.php");
}
?>
