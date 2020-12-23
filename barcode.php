<?php
 include "database_connection.php";
//echo $_POST["mail"]
if($_POST["mail"]=="tirth" && $_POST["pass"]=="123")
{
    header("location:barcode.html");
    
}

else{
    $id=$_POST["mail"];
    $pwd=$_POST["pass"];
//echo $id;

$query="Select * from student_info where enorollment_number='$id' and password='$pwd';";
$result=mysqli_query($conn,$query);
//echo $result+"";

if(mysqli_num_rows($result) == 1)  
{
   // echo mysqli_num_rows($result);
    session_start();
    $_SESSION['en']=$id;
    header("location:after_student_login.php");
}        
else{
    echo "<script type='text/JavaScript'>  
     alert('wrongid password'); 
     </script>";
    sleep(3);
    header("location:student_login.html");}
}
?>