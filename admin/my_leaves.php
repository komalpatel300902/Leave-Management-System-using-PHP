<link rel = "stylesheet" type = "text/css" href = "style.css">
<link rel = "stylesheet" type = "text/css" href = "table.css">
<title>::Leave Management::</title>
<?php
session_start();
if(isset($_SESSION['adminuser']))
	{
	echo "<div class = 'textview'>";
	include 'connect.php';
	echo "<h1>Leave Management System</h1>";
	include 'adminnavi.php';
	echo "<center>";
	echo "<h2>My All Leaves</h2>";
	$sql = "SELECT id,UserName,EmpName FROM admins WHERE UserName = '".$_SESSION['adminuser']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			$name = $row["EmpName"];
			$sql2 = "SELECT * FROM hod_leaves WHERE EmpName = '".$name."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
				echo "<table>";
				echo "<tr><th>Name</th>";
				echo "<th>Type Of Leave</th>";
				echo "<th>Request Date</th>";
				echo "<th>Days Of Leave</th>";
				echo "<th>Start Date</th>";
				echo "<th>End Date</th>";
				echo "<th>Status</th>";
				echo "<th>More Data</th></tr>";
				while($row2 = $result2->fetch_assoc())
					{
					echo "<tr><td>".$row2["EmpName"]."</td>";
					echo "<td>".$row2["LeaveType"]."</td>";
					echo "<td>".$row2["RequestDate"]."</td>";
					echo "<td>".$row2["LeaveDays"]."</td>";
					echo "<td>".$row2["StartDate"]."</td>";
					echo "<td>".$row2["EndDate"]."</td>";
					echo "<td>".$row2["Status"]."</td>";
					echo "<td><a href = 'leaves/".$_SESSION['adminuser'].$row2["StartDate"].$row2["LeaveType"].$row2["EndDate"].".pdf' target = '_blank'>Download</a></td>";
					}
				echo "</table>";
				echo "</center>";
				echo "</div>";
				}
			}
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
	exit();
	}
?>