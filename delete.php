<?php
include "database_connection.php";
session_start();
$enroll = $_SESSION["number"];
$bid = $_POST["bookid"];
$bname = $_POST["bookname"];
$_SESSION["book_number"]=$bid;
$q="select issuedate from book_info WHERE book_number='$bid'and enrollment='$enroll';";
 $res=mysqli_query($conn,$q);
    if($res->num_rows >0){
        while($row=$res->fetch_assoc()){
            $dob =$row["issuedate"];
        }
    }
$current_date=date("y/m/d");
//echo $current_date;
$date = new DateTime($dob);//hepb
$date->modify('+1 month');
if($current_date < $date->format("y/m/d"))
{
    $sq="insert into penalty_info (book_id,book_name,enrollment,penalty)values('$bid','$bname','$enroll',10);";
    $ress=mysqli_query($conn,$sq);
    echo $ress+"";
   
}
$query="delete from book_info WHERE book_number='$bid'and enrollment='$enroll';";
$result = mysqli_query($conn,$query);
  //console.log($result);
   if($result)
 {   
    //echo "sucssesfully register";
    sleep(3);
    header("location:after_librarian_login.php");
 }
 else{
    
    echo "eroor";
   
     
 }
?>