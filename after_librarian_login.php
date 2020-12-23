<?php 
 session_start();
 if(isset($_SESSION["number"])){
    
}
else{
    header("location:student_login.html");
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>
LIBRARIAN PAGE
</title>

<link rel="stylesheet" href="newstyle.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>

<body>

    <label for="name"> <g>Name Of Student: </g> </label><?php include "database_connection.php"; $n=$_SESSION["number"]; 
    $query="select student_name from student_info where enorollment_number='$n'";
    $res=mysqli_query($conn,$query);
    if($res->num_rows >0){
        while($row=$res->fetch_assoc()){
            echo $row["student_name"];
        }
    }
    
    ?>  </br> </br>
<label for="enroll"> <g>Enrollment Number :</g> </label>  <?php  echo $_SESSION["number"]; ?> </br> </br>

<table border="1px" align="center">

<tr>
<th width="890px" colspan="5">CURRENT BOOK RECORDS</th>
</tr>

<tr>

<th width="100px"> <label for="bid">Book ID</label> </th>
<th width="300px"> <label for="bname">Book Name</label> </th>
<th width="200px"> <label for="bduedate">Isuue Date</label> </th>
<th width="200px"> <label for="bduedate">Due Date</label> </th>

</tr>

<?php
    include "database_connection.php";
    $num= $_SESSION["number"];
    //echo $num;
    $query="select book_name,book_number,issuedate from book_info where enrollment='$num'";
    $result = mysqli_query($conn,$query);
    if($result->num_rows >0){
        while($row=$result->fetch_assoc()){
             $d=$row["issuedate"];
            $date = new DateTime($d);//hepb
             $date->modify('+1 month');
            echo "<tr><td>".$row["book_number"]."</td><td>".$row["book_name"]."</td><td>".$row["issuedate"]."</td><td>".$date->format('yy-m-d')."</td></tr>";
        }
        echo "</table>";
    }
    else{
        //echo "0 result";
    }
    
?>


</table> <br> <br>

<f> New Book Entry </f> <br> <br>
<form action="lib.php" method="post">
<label for="nbid"><g>Enter Book ID :</g></label> <input type="text" name ="bookid"> <br> <br>
<label for="nbname"><g>Enter Book Name :</g></label> <input type="text" name="bookname"> <br> <br>
<label for ="ndate"><g>Enter date of purchese</g></label><input type="date" name="dop"><br><br>
<input type="submit" value="ISSUE BOOK" width="100px">
</form>
<br> <br>
<f> delete Book  </f> <br> <br>
<form action="delete.php" method="post">
<label for="nbid"><g>Enter Book ID :</g></label> <input type="text" name ="bookid"> <br> <br>
<label for="nbname"><g>Enter Book Name :</g></label> <input type="text" name="bookname"> <br> <br>

<input type="submit" value="RETURN BOOK" width="100px">
</form>
<form action="l_out.php">
   <input type="submit" value="logout" width="100px">
</form>

 

</body>
</html>