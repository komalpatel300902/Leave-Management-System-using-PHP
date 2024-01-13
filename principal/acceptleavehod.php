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

if(filter_var($_GET['id'],FILTER_VALIDATE_INT) && filter_var($_GET['empid'],FILTER_VALIDATE_INT))
	{
		$id =$_GET['id'];
		$empid =$_GET['empid'];
	}
else
	{
		header('location:home.php');
	}
if(isset($_SESSION['principal']))
	{
        if(TRUE)
            {
            $sql2 = "SELECT id,email FROM admins WHERE id = '".$empid."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
				while($row2 = $result2->fetch_assoc())
					{
					$email = $row2['email'];
                    }
                }

            $sql = "SELECT * FROM hod_leaves where id = '".$id."'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					
                
            
                    $sql4 = "UPDATE hod_leaves SET Status = 'Granted' WHERE id = '".$id."'";
                    if($conn->query($sql4) === TRUE){
                        $msg = "Your Leave Has Been Granted Successfully !<br>Employee Name : ".$row['EmpName']."<br>Leave Type : ".$row['LeaveType']."<br>No. Of Leave Days : ".$row['LeaveDays']."<br>Starting Date : ".$row['StartDate']."<br>End date : ".$row['EndDate']."<br><br><br>Thanks,<br>webadmin, Leave Management System";
                        $subject = "Leave Request Granted!";
                        $status = mailer($email,$msg,$subject);
                        
                        if($status === TRUE)
                            {
                            echo "The Leave Request Status mail For ".$row['EmpName']." Has been sent to his/her registered email address !<br/>";
                            }
                        echo "<script>
                            window.location.href='view_leaves.php';
                            </script>";
                    }
                }     
            }
        }
    
	// $sql = "SELECT id,EmpName,LeaveType,RequestDate,Status,LeaveDays,StartDate,EndDate FROM emp_leaves WHERE id='".$id."'";
	// $result = $conn->query($sql);
	// if($result->num_rows > 0)
	// 	{
	// 	while($row = $result->fetch_assoc())
	// 		{
	// 		$leavedays = $row["LeaveDays"];
	// 		$sql2 = "SELECT id,EarnLeave,SickLeave,CasualLeave,CommutionLeave,CompassionateLeave,NursingLeave,StudyLeave,MaternityLeave,EmpEmail FROM employees WHERE id = '".$empid."'";
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
	// 				$commutionleave = $row2["CommutionLeave"];
	// 				$diff4 = $commutionleave-$leavedays;
	// 				$compassionateleave = $row2["CompassionateLeave"];
	// 				$diff5 = $compassionateleave-$leavedays;
	// 				$nursingleave = $row2["NursingLeave"];
	// 				$diff6 = $nursingleave-$leavedays;
	// 				$studyleave = $row2["StudyLeave"];
	// 				$diff7 = $studyleave-$leavedays;
	// 				$maternityleave = $row2["MaternityLeave"];
	// 				$diff8 = $maternityleave-$leavedays;
	// 				$email = $row2["EmpEmail"];
					
	// 				// if($row["LeaveType"] == "Earn Leave")
	// 				// 	{
	// 				// 	if($diff1 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET EarnLeave = '".$diff1."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Sick Leave")
	// 				// 	{
	// 				// 	if($diff2 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET SickLeave = '".$diff2."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Casual Leave")
	// 				// 	{
	// 				// 	if($diff3 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET CasualLeave = '".$diff3."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Commution Leave")
	// 				// 	{
	// 				// 	if($diff3 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET CommutionLeave = '".$diff4."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Copassionate Leave")
	// 				// 	{
	// 				// 	if($diff3 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET CopassionateLeave = '".$diff5."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Nursing Leave")
	// 				// 	{
	// 				// 	if($diff3 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET NursingLeave = '".$diff6."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Study Leave")
	// 				// 	{
	// 				// 	if($diff3 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET StudyLeave = '".$diff7."' WHERE id = '".$empid."'";
	// 				// 	}
	// 				// else if($row["LeaveType"] == "Maternity Leave")
	// 				// 	{
	// 				// 	if($diff3 < 0)
	// 				// 		echo "Processing Error !";
	// 				// 	else
	// 				// 		$sql3 = "UPDATE employees SET MaternityLeave = '".$diff8."' WHERE id = '".$empid."'";
	// 				// 	}



				
	// 				}
	// 			}
			
	// 		}
	// 	}
	}
	else
		{
			header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
		}
?>
</div>
</body>
</html>