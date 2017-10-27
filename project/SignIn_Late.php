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
$sql= "SELECT * FROM St_Status WHERE '$rollno'=Student_RollNo";
$result = $conn->query($sql);
if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc()) 
        {

      
          if(date('h:i:s')>'9:00:00')
          {
           $s4= "UPDATE St_Status SET Warning=Warning+1 WHERE '$rollno'=Student_RollNo"; 
           if($conn->query($s4) === TRUE)
           {
          //echo "updated";
           }
           else
          //echo "update failed";
          }
          $s1="UPDATE St_Status SET Status='1' WHERE '$rollno'=RollNo";
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
        $s3= "UPDATE Late_Reg SET TimeIn=now() WHERE '$rollno'=Student_RollNo";
        if($conn->query($s3) === TRUE)
        {
          //echo "updated";
        }
        else
          //echo "update failed";
        }  
        }
        echo "Succesfully Signed In";
    }
else
    echo "Sorry, you have typed in wrong roll number!";    
        
$conn->close();
?>
