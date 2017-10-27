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

$sql = "SELECT * FROM LateReg"; 
$result = $conn->query($sql);
if($result->num_rows > 0)
{
	echo "<table>"; 
	while($row=$result->fetch_assoc())
	{  
		echo "<tr><td>" . $row['Student_RollNo'] . "</td><td>" . $row['Security_SecurityID'] . "</td></tr>". $row['Place'] . "</td></tr>". $row['TimeOut'] . "</td></tr>". $row['GateIn'] . "</td></tr>". $row['GateOut'] . "</td></tr>". $row['TimeIn'] . "</td></tr>"; 
	}
	echo "</table>"; 
}
else


$conn->close();
?>