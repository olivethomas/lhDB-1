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
$securityID=$_POST["securityID"];
//echo "5 latest entries";
$s5="SELECT * FROM Movement WHERE $rollno=Student_RollNo ORDER BY TimeIn DESC LIMIT 5";
$res= $conn->query($s5);
if($res->num_rows >0)
{
  echo "<table>";
  while($row=$res->fetch_assoc())
  {
    echo "<tr><td>" . $row['Place'] . "</td><td>" . $row['TimeOut'] . "</td></tr>". $row['TimeIn'] . "</td></tr>";

  }
  echo "</table>";
}
$sql= "SELECT * FROM St_Status WHERE '$rollno'=RollNo";
$timestamp= date("Y-m-d H:i:s");
$result = $conn->query($sql);
if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc()) 
        {

      
          $s1="UPDATE St_Status SET Status='0' WHERE '$rollno'=RollNo";
          if($conn->query($s1) === TRUE) 
          {
            //echo "updated";
          }   
          else
          //echo "update failed";
        }

        $s2= "SELECT * FROM LateReg WHERE '$rollno'=Student_RollNo";
        $r2= $conn->query($s2);
        if($r2->num_rows > 0)
        { 
        while($row=$r2->fetch_assoc()) 
        {  
        $s3= "INSERT INTO LateReg (Student_RollNo,Security_SecurityID,TimeOut) VALUES ('$rollno','$securityID','$timestamp')";
        if($conn->query($s3) === TRUE)
        {
          //echo "updated";
        }
        else
          //echo "update failed";
        }  
        }
        echo "Succesfully Signed Out";
    }
else
    echo "Sorry, you have typed in wrong roll number!";    
        
$conn->close();
?>
