<?php
session_start();
?>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<link rel="stylesheet" type="text/css" href="table.css">
<div class = "textview">
<center>
<?php


include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'adminnavi.php';
echo "<h2>View Employees' Leaves</h2>";
echo"<form method = 'post' action = 'view_leaves.php'>
Department: <select name = 'department'>
<option>All</option><option>CSE</option><option>ET&T</option><option>CIVIL</option><option>EEE</option><option>MECH</option>
<input type = 'submit'>
</select>
";
$count = 0;
$departmentinfo = "";
if(isset($_POST["department"])){
	if($_POST["department"] != 'All' ){
		$departmentinfo = " e.Dept = '".$_POST["department"]."' AND ";
		echo $departmentinfo;	
	}
}
if(isset($_SESSION['principal']))
	{
	$sql = "SELECT  username FROM principal WHERE username = '".$_SESSION['principal']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			if($_SESSION['principal'] == $row['username'])
				{
					// HOD SECTION
					$sql2 = "SELECT e.UserName,e.Id,e.Dept,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id,el.Dept, el.status FROM admins e, hod_leaves el WHERE e.Dept = el.Dept AND ".$departmentinfo." el.Status = 'Requested' AND e.EmpName = el.EmpName";
					
					$result2 = $conn->query($sql2);
					if($result2->num_rows > 0)
						{	echo "<h2>HOD Leave</h2>";
							echo "<table>";
							echo "<tr>";
							echo "<th>Employee Name</th>";
							echo "<th>Dept</th>";
							echo "<th>Leave Type</th>";
							echo "<th>Request Date</th>";
							echo "<th>Leave Days</th>";
							echo "<th>Starting Date</th>";
							echo "<th>Ending Date</th>";
							echo "<th>Documents</th>";
							echo "<th>Hod Action</th>";
							echo "<th>Action</th>";
							echo "</tr>";
							while ($row2 = $result2->fetch_assoc())
								{
								echo "<tr>";
								echo "<td>";
								echo $row2['EmpName'];
								echo "</td>";
								echo "<td>";
								echo $row2['Dept'];
								echo "</td>";
								echo "<td>";
								echo $row2['LeaveType'];
								echo "</td>";
								echo "<td>";
								echo $row2['RequestDate'];
								echo "</td>";
								echo "<td>";
								echo $row2['LeaveDays'];
								echo "</td>";
								echo "<td>";
								echo $row2['StartDate'];
								echo "</td>";
								echo "<td>";
								echo $row2['EndDate'];
								echo "</td>";
								if (file_exists("../admin/leaves/".$row2['UserName'].$row2["StartDate"].$row2["LeaveType"].$row2["EndDate"].".pdf")){
									echo "<td><a href = '../admin/leaves/".$row2['UserName'].$row2["StartDate"].$row2["LeaveType"].$row2["EndDate"].".pdf' target = '_blank'>Engagements</a>";
								}
								else{
									echo "<td><a href = '#'>Engagements</a>";
								}
								echo "<br>";
								if(file_exists("../admin/applications/".$row2['UserName'].$row2["StartDate"].".pdf")){
									echo "<a href = '../admin/applications/".$row2['UserName'].$row2["StartDate"].".pdf' target = '_blank'>Application</a></td>";
								}
								else{
									echo "<a href = '#'>Application</a></td>";
								}
								echo "<td>";
								echo $row2['status'];
								echo "</td>";
								
								echo "<td><a href = 'acceptleavehod.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Accept</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = 'rejectleavehod.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Reject</a></td>";
								echo "</tr>";
								$count++;
								}
							echo $count." Leave(s)";
						}
					echo "</table>";

				// TEACHER LEAVE SECTION
				$sql2 = "SELECT e.UserName,e.Id,e.Dept,e.EmpName,el.EmpName,el.LeaveType,el.RequestDate,el.LeaveDays,el.StartDate,el.EndDate,el.id,el.Dept, el.status FROM employees e, emp_leaves el WHERE e.Dept = el.Dept AND ".$departmentinfo." el.status = 'Forwarded' AND e.EmpName = el.EmpName";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0)
					{
						echo "<h2>Teachers Leave</h2>";
						echo "<table>";
						echo "<tr>";
						echo "<th>Employee Name</th>";
						echo "<th>Dept</th>";
						echo "<th>Leave Type</th>";
						echo "<th>Request Date</th>";
						echo "<th>Leave Days</th>";
						echo "<th>Starting Date</th>";
						echo "<th>Ending Date</th>";
						echo "<th>Documents</th>";
						echo "<th>Hod Action</th>";
						echo "<th>Action</th>";
						echo "</tr>";
						while ($row2 = $result2->fetch_assoc())
							{
							echo "<tr>";
							echo "<td>";
							echo $row2['EmpName'];
							echo "</td>";
							echo "<td>";
							echo $row2['Dept'];
							echo "</td>";
							echo "<td>";
							echo $row2['LeaveType'];
							echo "</td>";
							echo "<td>";
							echo $row2['RequestDate'];
							echo "</td>";
							echo "<td>";
							echo $row2['LeaveDays'];
							echo "</td>";
							echo "<td>";
							echo $row2['StartDate'];
							echo "</td>";
							echo "<td>";
							echo $row2['EndDate'];
							echo "</td>";
							if (file_exists("../client/leaves/".$row2['UserName'].$row2["StartDate"].$row2["LeaveType"].$row2["EndDate"].".pdf")){
								echo "<td><a href = '../client/leaves/".$row2['UserName'].$row2["StartDate"].$row2["LeaveType"].$row2["EndDate"].".pdf' target = '_blank'>Engagements</a>";
							}
							else{
								echo "<td><a href = '#'>Engagements</a>";
							}
							echo "<br>";
							if(file_exists("../client/applications/".$row2['UserName'].$row2["StartDate"].".pdf")){
								echo "<a href = '../client/applications/".$row2['UserName'].$row2["StartDate"].".pdf' target = '_blank'>Application</a></td>";
							}
							else{
								echo "<a href = '#'>Application</a></td>";
							}
							echo "<td>";
							echo $row2['status'];
							echo "</td>";
							
							echo "<td><a href = 'acceptleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Accept</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href = 'rejectleave.php?id=".$row2['id']."&empid=".$row2["Id"]."'>Reject</a></td>";
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