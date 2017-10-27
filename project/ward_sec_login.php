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

$id=$_POST["id"];
$password=$_POST["password"];
$who=$_POST["who"];


if(strcmp($who, "Security")==0)    
    {
    	$gate=$_POST["gate"];
    	$sql= "SELECT * FROM Security WHERE '$id'=SecurityID and '$password'=Password";
    	$result = $conn->query($sql);
		if($result->num_rows > 0)
		{
    		echo "Login successful";
    		while($row=$result->fetch_assoc()) 
    		{

      
				$s1="UPDATE Security SET gate='$gate' WHERE '$id'=SecurityID";
				if($conn->query($s1) === TRUE) 
					{
  					//echo "updated";
					}		
				else
					//echo "update failed";
      		}

		}
		else
    		echo "auth failed. Try again";
      
    }

else if(strcmp($who, "Warden")==0)
	{
		$sql= "SELECT * FROM Warden WHERE '$id'=WardenID and '$password'=Password";
    	$result = $conn->query($sql);
    	if($result->num_rows>0)
    		echo "Login Succesful";
    	else
    		echo "auth failed. Try again";
	}    

$conn->close();
?>
