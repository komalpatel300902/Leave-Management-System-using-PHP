<?php
session_start();
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="../style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="../table.css">
<div class = "textview">
<center>
<?php


include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'adminnavi.php';
echo "<h2> Employee's Joining Request</h2>";
$count = 0;
if(isset($_SESSION['adminuser']))
	{
	$sql = "SELECT Dept, username FROM admins WHERE username = '".$_SESSION['adminuser']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			if($_SESSION['adminuser'] == $row['username'])
				{
				
				$sql2 = "SELECT e.UserName,e.Id,e.Dept,e.EmpName,e.EmpEmail , e.Designation FROM joining_request e WHERE e.Dept = '".$row['Dept']."'";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0)
					{
						echo "<table>";
						echo "<tr>";
						echo "<th>Employee Name</th>";
						echo "<th>Email id</th>";
						echo "<th>Designation</th>";
						echo "<th>Department</th>";
						// echo "<th>Starting Date</th>";
						// echo "<th>Ending Date</th>";
						echo "<th>Documents</th>";
						echo "<th>Action</th>";
						echo "</tr>";
						while ($row2 = $result2->fetch_assoc())
							{
							echo "<tr>";
							echo "<td>";
							echo $row2['EmpName'];
							echo "</td>";
							echo "<td>";
							echo $row2['EmpEmail'];
							echo "</td>";
							echo "<td>";
							echo $row2['Designation'];
							echo "</td>";
							echo "<td>";
							echo $row2['Dept'];
							echo "</td>";
							// echo "<td>";
							// echo $row2['StartDate'];
							// echo "</td>";
							// echo "<td>";
							// echo $row2['EndDate'];
							// echo "</td>";
							if (file_exists("joining_request/".$row2['UserName']."_".$row2["EmpEmail"].".pdf")){
								echo "<td><a href = 'joining_request/".$row2['UserName']."_".$row2["EmpEmail"].".pdf' target = '_blank'>see applicant</a></td>";
							}
							else{
								echo "<td><a href = '#'>see application</a></td>";
							}
													
							echo "<td><a href ='accept_request.php?id=".$row2['EmpEmail']."'>Accept</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							echo " <a href = 'reject_request.php?id=".$row2['EmpEmail']."'>Reject</a></td>";
							echo "</tr>";
							$count++;
							}
						echo $count." Leave(s)";
					}
				echo "</table>";
				}
			else
				{
				header("location:index.php?err=".urlencode('Please login first to view this page !'));
				}
			}
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please login first to view this page !'));
	}
?>
</div>
</center>