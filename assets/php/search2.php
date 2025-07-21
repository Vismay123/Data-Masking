<?php

include('connection.php');
session_start();
$user= $_SESSION['username'];
$query = mysqli_query($conn,"select * from login1 where username='$user'");
$row= mysqli_fetch_array($query);
$Country=$row['Country'];
$output = '';
if (isset($_POST["query"])) {
   $search = mysqli_real_escape_string($conn, $_POST["query"]);
   $query =  "SELECT * FROM form1
  WHERE Country='$Country' && patient_name LIKE '%" . $search . "%'
  OR study_no LIKE '%" . $search . "%'
  OR staff_name LIKE '%" . $search . "%'
 ";
} else if($Country=='UK'){
   $query =  "SELECT * FROM form1";
}
else{
   $query = "SELECT * FROM form1 WHERE Country='$Country'";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
   $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Patient Name</th>
     <th>Study No</th>    
     <th>Staff Name</th>
    </tr>
 ';
   while ($row = mysqli_fetch_array($result)) {
      $output .= '
         <tr>
          <td><a href="display_form_1-6.php?pid=' . $row["pid"] . '">' . $row["patient_name"] . '</a></td>
          <td><a href="display_form_1-6.php?pid=' . $row["pid"] . '">' . $row["study_no"] . '</a></td>
          <td><a href="display_form_1-6.php?pid=' . $row["pid"] . '">' . $row["staff_name"] . '</a></td>
          <td><a href="../assets/php/delete2.php?pid=' . $row["pid"] . '"><button class="btn btn-danger">Delete</button></a></td>
         </tr>
        ';
   }
   echo $output;
} else {
   echo '';
}
