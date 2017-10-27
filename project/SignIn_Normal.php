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
$flag=0;
$s2= "SELECT * FROM Movement WHERE '$rollno'=Student_RollNo";
        $r2= $conn->query($s2);
        if($r2->num_rows > 0)
        { 
        while($row=$r2->fetch_assoc()) 
        {  
          
        $s3= "UPDATE Movement SET TimeIn=now() WHERE '$rollno'=Student_RollNo";
        if($conn->query($s3) === TRUE)
        {
          //echo "updated";
          if(!empty($row['LatePTime']) and date('h:i:s')>$row['LatePTime'])
            $flag=1;
        }
        else
          //echo "update failed";
        } 

        }
$sql= "SELECT * FROM St_Status WHERE '$rollno'=Student_RollNo";
$result = $conn->query($sql);
if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc()) 
        {

      
           if(TIME(now())>'7:00:00' or $flag=1)
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
        echo "Succesfully Signed In";
    }
else
    echo "Sorry, you have typed in wrong roll number!";    
        
$conn->close();
?>
