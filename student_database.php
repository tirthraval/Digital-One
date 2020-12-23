<?php
 include "database_connection.php";
 sleep(3);
 $enrollment=$_POST["enroll"];
 $name=$_POST["nam"];
 $mob=$_POST["mno"];
 $date=$_POST["birthdate"];
 $pass=$_POST["pass"];
 $query="insert into student_info (enorollment_number,student_name,mobile,dob,password) values('$enrollment','$name','$mob','$date','$pass');";
 $result = mysqli_query($conn,$query);
 //console.log($result);
 if($result)
 {   
    echo "sucssesfully register";
    sleep(3);
    header("location:student_login.html");
 }
 else{
    echo $result+""; 
    echo "eroor";
     
 }
?>