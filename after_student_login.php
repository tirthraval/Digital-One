<?php
session_start();

if(isset($_SESSION["en"])){
    $enroll=$_SESSION["en"];
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
<title>STUDENT LIBRARY RECORDS</title>

<link rel="stylesheet" href="newstyle.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script></head>

<body>

    <label for="name"> <g>Name Of Student: </g> </label>  <?php include "database_connection.php";
    $query="select student_name from student_info where enorollment_number='$enroll'";
    $res=mysqli_query($conn,$query);
     //echo $query;
    if($res->num_rows >0){
        while($row=$res->fetch_assoc()){
            echo $row["student_name"];
        }   
    }
?> <br> <br>
<label for="enroll"> <g>Enrollment Number :</g> </label> <?php echo $enroll; ?> <br> <br>

<table align="center">
<tr>
<th width="890px" colspan="5">CURRENT BOOK RECORDS</th>
</tr>

<tr>

<th width="100px"> <label for="bid">Book ID</label> </th>
<th width="300px"> <label for="bname">Book Name</label> </th>
<th width="200px"> <label for="bduedate">Due Date</label> </th>

</tr>

<?php
    include "database_connection.php";
  
    //echo $num;
    $query="select book_name,book_number,issuedate from book_info where enrollment='$enroll'";
    $result = mysqli_query($conn,$query);
    if($result->num_rows >0){
        while($row=$result->fetch_assoc()){
            $d=$row["issuedate"];
            $date = new DateTime($d);//hepb
             $date->modify('+1 month');
            echo "<tr><td>".$row["book_number"]."</td><td>".$row["book_name"]."</td><td>".$date->format('d-m-Y')."</td></tr>";
        }
        //echo "</table>";
    }
    else{
       // echo "0 result";
    }
    
    ?>


</table>
    <br> <br>

    <form method="post">
        <input type="submit"  value="PENALTY CHECK" name="button" width="100px">
    </form><br><br>
    <form action="l_out.php">
   <input type="submit" value="logout" width="100px">
</form>
    <?php
        //echo $_SESSION["book_number"];
        //echo $panulty; 
        
        if(array_key_exists('button', $_POST)) { 
            button(); 
        } 
       
        function button() { 
            include "database_connection.php";
            $num=$_SESSION["en"];
            
    $qu="select book_name,penalty from penalty_info where enrollment='$num'";
    $res = mysqli_query($conn,$qu);
    if($res->num_rows >0){
        echo "<table align='center'>
                    <tr>
                    <th width='890px' colspan='5'>PENLTY RECORDS</th>
                    </tr>

                    <tr>
                    <th width='200px'> <label for='bname'>Book Name</label> </th>
                    <th width='200px'> <label for='bduedate'>penalty</label> </th>

                    </tr>";
        while($row=$res->fetch_assoc()){
            
            echo "<tr><td>".$row["book_name"]."</td><td>".$row["penalty"]."</td></tr>";
        }
        echo "</table>";
    }
    else{
        echo "<script>alert('you do not have any penalty')</script>";
    }
            
            
        } 
       
    ?> 

</body>
</html>