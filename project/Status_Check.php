<?php
$servername = "localhost";
$user = "root";
$pass = "password";
$dbname="LHdb";

$conn = new mysqli($servername,$user,$pass,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rollno=$_POST["rollno"];
$sql= "SELECT Status
       FROM St_Status
       WHERE Student_RollNo='$rollno'";
$result = $conn->query($sql);
if($result->num_rows > 0)
  { 
    while($row=$result->fetch_assoc()) 
      {
        if($row["St_Status"]=='1')
        	echo "You are Signed In"."<br><br>";
        else
        	echo "You are Signed Out"."<br><br>";
     }
  
  }
$conn->close();
?>
