<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
</head>
<body>
<link rel = "stylesheet" href = "style.css">
<div class = "textview">
<?php
echo "<h1>Leave Management System</h1>";
include 'adminnavi.php';
include 'connect.php';
include 'mailer.php';
$id =$_GET['id'];
$email = $id;
$empid = $_GET["empid"];
// if(filter_var($_GET['EmpEmail'],FILTER_VALIDATE_INT))
// 	{
// 		$id =$_GET['EmpEmail'];
		
// 	}
// else
// 	{
// 		header('location:home.php');
// 	}
if(isset($_SESSION['adminuser']))
	{
	$username_sql = "SELECT UserName FROM JOINING_REQUEST WHERE EmpEmail = '".$id."' AND id = '".$empid."'";
	$result = $conn->query($username_sql);
	$username =  $result->fetch_assoc();
	$sql = "INSERT INTO EMPLOYEES SELECT * FROM JOINING_REQUEST WHERE EmpEmail = '".$id."' AND id = '".$empid."'";
	// $sql = "SELECT id,EmpName,LeaveType,RequestDate,Status,LeaveDays,StartDate,EndDate FROM emp_leaves WHERE id='".$id."'";
	$result = $conn->query($sql);
	$sql2 = "DELETE FROM JOINING_REQUEST WHERE EmpEmail = '".$id."' AND id = '".$empid."'";
	$result = $conn->query($sql2);

	$conn->close();
	$msg = "Your joining request Has Been <bold>Approved<bold> ! <br>UserName : ".$username["UserName"]."<br>Password : ".$username["UserName"]."<br>";							
	$subject = "Joining Request Approved !";
	$status = mailer($email,$msg,$subject);
	echo "<script>
	window.location.href='index.php';
	</script>";
	}
	// if($result->num_rows > 0)
	// 	{
	// 	while($row = $result->fetch_assoc())
	// 		{
	// 		$leavedays = $row["LeaveDays"];
	// 		$sql2 = "SELECT id,EarnLeave,SickLeave,CasualLeave,EmpEmail FROM employees WHERE id = '".$empid."'";
	// 		$result2 = $conn->query($sql2);
	// 		if($result2->num_rows > 0)
	// 			{
	// 			while($row2 = $result2->fetch_assoc())
	// 				{
	// 				$earnleave = $row2["EarnLeave"];
	// 				$diff1 = $earnleave-$leavedays;
	// 				$sickleave = $row2["SickLeave"];
	// 				$diff2 = $sickleave-$leavedays;
	// 				$casualleave = $row2["CasualLeave"];
	// 				$diff3 = $casualleave-$leavedays;
	// 				$email = $row2["EmpEmail"];
					
	// 				if($row["LeaveType"] == "Earn Leave")
	// 					{
	// 					if($diff1 < 0)
	// 						echo "Processing Error !";
	// 					else
	// 						$sql3 = "UPDATE employees SET EarnLeave = '".$diff1."' WHERE id = '".$empid."'";
	// 					}
	// 				else if($row["LeaveType"] == "Sick Leave")
	// 					{
	// 					if($diff2 < 0)
	// 						echo "Processing Error !";
	// 					else
	// 						$sql3 = "UPDATE employees SET SickLeave = '".$diff2."' WHERE id = '".$empid."'";
	// 					}
	// 				else if($row["LeaveType"] == "Casual Leave")
	// 					{
	// 					if($diff3 < 0)
	// 						echo "Processing Error !";
	// 					else
	// 						$sql3 = "UPDATE employees SET CasualLeave = '".$diff3."' WHERE id = '".$empid."'";
	// 					}
	// 				if($conn->query($sql3) === TRUE)
	// 						{
	// 						$sql4 = "UPDATE emp_leaves SET Status = 'Granted' WHERE id = '".$id."'";
	// 						if($conn->query($sql4) === TRUE)
	// 							{
	// 							$msg = "Your Leave Has Been Granted Successfully ! <br>Employee Name : ".$row['EmpName']."<br>Leave Type : ".$row['LeaveType']."<br>No. Of Leave Days : ".$row['LeaveDays']."<br>Starting Date : ".$row['StartDate']."<br>End date : ".$row['EndDate']."<br><br><br>Thanks,<br>webadmin, Leave Management System";
	// 							$status = mailer($email,$msg);
								
	// 							if($status === TRUE)
	// 								{
	// 								echo "The Leave Request Status mail For ".$row['EmpName']." Has been sent to his/her registered email address !<br/>";
	// 								}
	// 							}
	// 						}
	// 				}
	// 			}
			
	// 		}
	// 	}
	// }
	else
		{
			header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>