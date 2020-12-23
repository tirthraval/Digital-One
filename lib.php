<?php
 include "database_connection.php";
 session_start();
// include "after_librarian_login.php";
  $enroll = $_SESSION["number"];
  $bid = $_POST["bookid"];
  $bname = $_POST["bookname"];
  $purchse_date = $_POST["dop"];
  
  
  $query="insert into book_info (book_number,book_name,issuedate,enrollment) values('$bid','$bname','$purchse_date','$enroll');";
  $result = mysqli_query($conn,$query);
  //console.log($result);
   if($result)
 {   
    echo "sucssesfully register";
    sleep(3);
    header("location:after_librarian_login.php");
 }
 else{
    echo $result;
    echo $query;
    echo "eroor";
    echo $enroll;
     
 }
    
?>