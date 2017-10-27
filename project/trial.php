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

$sql= "SELECT RollNo, Name FROM Student";
$result = $conn->query($sql);
if($result->num_rows > 0)
  { 
    while($row=$result->fetch_assoc()) 
      {
       
          echo "Roll Number:  ";
          echo $row["RollNo"] ."<br>";
          echo "Name:  ";
          echo $row["Name"] . "<br><br>";
     }
  
  }
$conn->close();
?>
