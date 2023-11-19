<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
include 'connect.php';
if(isset($_SESSION['adminuser']))
	{
	$setsickleave = strip_tags(trim($_POST['setsickleave']));
	$setearnleave = strip_tags(trim($_POST['setearnleave'])); 
	$setcasualleave = strip_tags(trim($_POST['setcasualleave']));
	$setcommutionleave = strip_tags(trim($_POST['setcommutionleave']));
	$setcompassionateleave = strip_tags(trim($_POST['setcompassionateleave'])); 
	$setnursingleave = strip_tags(trim($_POST['setnursingleave']));
	$setstudyleave = strip_tags(trim($_POST['setstudyleave'])); 
	$setmaternityleave = strip_tags(trim($_POST['setmaternityleave']));
	
	$sql2 = "SELECT Dept,username,SetEarnLeave,SetCasualLeave,SetSickLeave,SetCommutionLeave,SetCompassionateLeave,SetNursingLeave,SetStudyLeave,SetMaternityLeave FROM admins WHERE username = '".$_SESSION['adminuser']."'";
	$result = $conn->query($sql2);
	if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
				{
					$sql3 = "SELECT Dept,SickLeave,EarnLeave,CasualLeave,CommutionLeave,CompassionateLeave,NursingLeave,StudyLeave,MaternityLeave FROM employees WHERE Dept = '".$row["Dept"]."'";
					$result2 = $conn->query($sql3);
					if($result2->num_rows > 0)
						{
							while($row2 = $result2->fetch_assoc())
								{
									if($row2["EarnLeave"] == $row["SetEarnLeave"])
										{
											$update = "UPDATE employees SET EarnLeave = '".$setearnleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
									if($row2["SickLeave"] == $row["SetSickLeave"])
										{
											$update = "UPDATE employees SET SickLeave = '".$setsickleave."'WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
									if($row2["CasualLeave"] == $row["SetCasualLeave"])
										{
											$update = "UPDATE employees SET CasualLeave = '".$setcasualleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}

									if($row2["CommutionLeave"] == $row["SetCommutionLeave"])
										{
											$update = "UPDATE employees SET CommutionLeave = '".$setcommutionleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
									if($row2["CompassionateLeave"] == $row["SetCompassionateLeave"])
										{
											$update = "UPDATE employees SET CompassionateLeave = '".$setcompassionateleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
									if($row2["NursingLeave"] == $row["SetNursingLeave"])
										{
											$update = "UPDATE employees SET NursingLeave = '".$setnursingleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
									if($row2["StudyLeave"] == $row["SetStudyLeave"])
										{
											$update = "UPDATE employees SET StudyLeave = '".$setstudyleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
									if($row2["MaternityLeave"] == $row["SetMaternityLeave"])
										{
											$update = "UPDATE employees SET MaternityLeave = '".$setmaternityleave."' WHERE Dept = '".$row2["Dept"]."'";
											$conn->query($update);
										}
								}
						}
				}
		}
	
	$sql = "UPDATE admins SET SetSickLeave = '".$setsickleave."', SetEarnLeave = '".$setearnleave."', SetCasualLeave = '".$setcasualleave."', SetCommutionLeave = '".$setcommutionleave."', SetCompassionateLeave = '".$setcompassionateleave."', SetNursingLeave = '".$setnursingleave."', SetStudyLeave = '".$setstudyleave."', SetMaternityLeave = '".$setmaternityleave."' WHERE username = '".$_SESSION['adminuser']."'";
	if($conn->query($sql) == TRUE)
		{
		header('location:set_leaves.php?msg='.urlencode('Leaves Were Set Succesfully!'));
		}
	else
		{
		header('location:set_leaves.php?msg='.urlencode('Setting Of Leaves Failed!'));
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page!'));
	}
?>