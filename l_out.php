<?php
    
    session_start();
    session_unset();
    session_destroy();
    sleep(3);
    header('location:student_login.html');
    //header("Location:student_reg.html");
?>