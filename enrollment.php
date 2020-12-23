<?php
 session_start();
 $_SESSION["number"]=$_POST["enroll"];
 header("location:after_librarian_login.php");
?>