<?php
function update_leaves($user,$dept)
	{
	include 'connect.php';
	$current_date = strtotime(date("Y-m-d"));
	
	$sql2 = "SELECT SetSickLeave,SetCasualLeave,SetEarnLeave,SetCommutionLeave,SetMaternityLeave,SetNursingLeave,SetPaternityLeave,SetStudyLeave,SetCompassionateLeave,Dept FROM admins WHERE Dept = '".$dept."'";
	if($conn->query($sql2) == TRUE)
		{
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0)
				{
					while($row2 = $result2->fetch_assoc())
						{
							$setsickleave = $row2["SetSickLeave"];
							$setearnleave = $row2["SetEarnLeave"];
							$setcasualleave = $row2["SetCasualLeave"];
							$setcommuteleave = $row2["SetCommutionLeave"];
							$setcompassionateleave = $row2["SetCompassionateLeave"];
							$setmaternityleave = $row2["SetMaternityLeave"];
							$setpaternityleave = $row2["SetPaternityLeave"];
							$setstudyleave = $row2["SetStudyLeave"];
							$setnursingleave = $row2["SetNursingLeave"];
							
							
						}
				}
		}
	
	$sql = "SELECT * FROM employees WHERE UserName = '".$user."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			if($row['gender'] == "Female"){
				$matleave = $setmaternityleave;
			}
			else{
				$matleave = $setpaternityleave;
			}
			if(strtotime($row["DateOfJoin"]) == strtotime('today'))
				{
					return false;
				}
			else if(strtotime($row["UpdateStatus"]) < strtotime('today'))
			{
				$date = $row["DateOfJoin"];
				$day = date("d",strtotime($date));
				$month = date("m",strtotime($date));
				$year = date("Y");
				$joining_date = $year."-".$month."-".$day;
				$joining_date = strtotime($joining_date);
				if($current_date == $joining_date)
					{
					$earnleave = $row["EarnLeave"] + $setearnleave;
					if($earnleave >= 300)
						{
						$earnleave = 300;
						}
					$sickleave = $row["SickLeave"] + $setsickleave;
					$casualleave = $setcasualleave;
					$studyleave = $setstudyleave;
					$maternityleave = $matleave;
					$commuteleave = $setcommuteleave;
					$compassionateleave = $setcompassionateleave;
					$nursingleave = $setnursingleave;
					
					$sql2 = "UPDATE employees SET EarnLeave = '".$earnleave."',SickLeave = '".$sickleave."',CasualLeave = '".$casualleave."', CommutionLeave = '".$commuteleave."', CompassionateLeave = '".$compassionateleave."', MaternityLeave = '".$maternityleave."', NursingLeave = '".$nursingleave."',StudyLeave = '".$studyleave."', UpdateStatus = '".date("Y-m-d")."' WHERE id = '".$row["id"]."'";
					if($conn->query($sql2) == TRUE)
						{
						return true;
						}
					}
					else
					{
						return false;
					}
			}
			else if($row["UpdateStatus"] == "0000-00-00")
			{
				$date = $row["DateOfJoin"];
				$day = date("d",strtotime($date));
				$month = date("m",strtotime($date));
				$year = date("Y");
				$joining_date = $year."-".$month."-".$day;
				$joining_date = strtotime($joining_date);
				if($current_date == $joining_date)
					{
					$earnleave = $row["EarnLeave"] + $setearnleave;
					if($earnleave >= 300)
						{
						$earnleave = 300;
						}
					$sickleave = $row["SickLeave"] + $setsickleave;
					$casualleave = $setcasualleave;
					$studyleave = $setstudyleave;
					$maternityleave = $matleave;
					$commuteleave = $setcommuteleave;
					$compassionateleave = $setcompassionateleave;
					$nursingleave = $setnursingleave;
					$sql2 = "UPDATE employees SET EarnLeave = '".$earnleave."',SickLeave = '".$sickleave."',CasualLeave = '".$casualleave."', CommuteLeave = '".$commuteleave."', CompassionateLeave = '".$compassionateleave."', MaternityLeave = '".$maternityleave."', NursingLeave = '".$nursingleave."',StudyLeave = '".$studyleave."',UpdateStatus = '".date("Y-m-d")."' WHERE id = '".$row["id"]."'";
					if($conn->query($sql2) == TRUE)
						{
						return true;
						}
					}
					else
					{
						return false;
					}
			}
			else
				{	
				return false;
				}
			}
		}
	}
?>