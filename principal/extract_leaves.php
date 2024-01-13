<html>
<head>
<title>::Leave Management::</title>
<link rel = 'stylesheet' href = 'style.css'>
<link rel = "stylesheet" href = "table.css">
</head>
<body>
<div class = 'textview'>
<?php
session_start();
if(isset($_SESSION['principal']))
	{
	?>
	<center>
	<h1>Leave Management System</h1>
	<?php include 'adminnavi.php'; 
	include 'connect.php'?>
	<h2>Extract All Leaves Of Your Employees</h2>
	<?php
	if(isset($_GET['msg']))
		{
			echo htmlspecialchars($_GET['msg']);
		}
	?>
	<form action = 'extract_leaves.php' method = 'post'>
		<table>
			<?php
			echo "Department : <select name = 'department'>
				<option>All</option><option>CSE</option><option>ET&T</option><option>CIVIL</option><option>EEE</option><option>MECH</option>
			</select>";
			$sql = "SELECT * FROM employees ";
			$result = $conn -> query($sql);
			if($result->num_rows > 0){
				
				echo"Employees: <select name = 'employee' class = 'reg-form-fields shadow selected'>
					<option>All</option>";
		  			
				while($row = $result->fetch_assoc()){
					echo"<option>".$row["EmpName"]."</option>";
				}
				echo"</select>";
			}
			// echo"Month: <select name = 'month' class = 'reg-form-fields shadow selected'>
			// 		<option>Jan</option>
			// 		<option>Feb</option>
			// 		<option>March</option>
			// 		<option>April</option>
			// 		<option>May</option>
			// 		<option>June</option>
			// 		<option>July</option>
			// 		<option>Agu</option>
			// 		<option>Sep</option>
			// 		<option>Oct</option>
			// 		<option>Nov</option>
			// 		<option>Dec</option>
			// 		</select>";
			echo"Leave Type: <select name = 'leave' class = 'reg-form-fields shadow selected'>
			<option>All</option>
			<option>Sick leave</option>
			<option>casual leave</option>
			<option>earn leave</option>
			<option>compassionate leave</option>
			<option>commution leave</option>
			<option>maternity leave</option>
			<option>study leave</option>
			<option>study leave</option>
			</select><br><br>";
			echo "<table ><tr><td>Starting Date : </td><td><input type = 'number' placeholder = 'dd' min = '1' max = '31' step = '1' name = 'datestart' class = '' style = 'width:50px;'><input type = 'number' placeholder = 'mm' min = '1' max = '12' step = '1' name = 'monthstart' class = '' style = 'width:50px;'><input type = 'number' placeholder = 'yyyy' min = '1965' max = '".date('Y')."' step = '1' name = 'yearstart' class = '' style = 'width:100px;'></td></tr>
			<tr><td>Ending Date : </td><td><input type = 'number' placeholder = 'dd' min = '1' max = '31' step = '1' name = 'dateend' class = '' style = 'width:50px;'><input type = 'number' min = '1' max = '12' step = '1' name = 'monthend' placeholder = 'mm' class = '' style = 'width:50px;'><input type = 'number'  min = '1965' max = '".date('Y')."' step = '1' name = 'yearend' placeholder = 'yyyy' class = '' style = 'width:100px;'></td></tr></table>";
			?>
			<tr><td><input type = 'submit' value = 'Extract' class = 'login-button shadow'></td></tr>
		</table>
	</form>
	</center>
<?php
$sql2 = "SELECT * FROM hod_leaves WHERE Status = 'Granted' ";
$sql = "SELECT * FROM emp_leaves WHERE principal_status = 'Granted' ";

if(isset($_POST["department"])){
	if($_POST["department"] != 'All' ){
		$sql = $sql." and Dept = '".$_POST["department"]."' ";
		$sql2 = $sql2." and Dept = '".$_POST["department"]."' ";
			
	}
}
if(isset($_POST["leave"])){
	if($_POST["leave"] != 'All' ){
		$sql = $sql."and LeaveType = '".$_POST["leave"]."' ";	
	}
}
if(isset($_POST["employee"])){
	if($_POST["employee"] != 'All' ){
		$sql = $sql."and EmpName = '".$_POST["employee"]."' ";
		
	}
}
if (isset($_POST['yearstart']) && isset($_POST['monthstart']) && isset($_POST['datestart']) && isset($_POST['yearend']) && isset($_POST['monthend']) && isset($_POST['dateend'])){
	if ($_POST['yearstart'] != "" && $_POST['monthstart'] != "" && $_POST['datestart'] != "" && $_POST['yearend'] != "" && $_POST['monthend'] != "" && $_POST['dateend'] != ""){

		$startdate = strip_tags(trim($_POST['yearstart']))."-".strip_tags(trim($_POST['monthstart']))."-".strip_tags(trim($_POST['datestart']));
		$enddate = strip_tags(trim($_POST['yearend']))."-".strip_tags(trim($_POST['monthend']))."-".strip_tags(trim($_POST['dateend']));
		$sql = $sql."and (StartDate >= '".$startdate."' AND EndDate <= '".$enddate."')";
		$sql2 = $sql2."and (StartDate >= '".$startdate."' AND EndDate <= '".$enddate."')";
	}
}
echo $sql2;
$result = $conn->query($sql2);
if($result->num_rows > 0)
	{	echo "";
		echo "<table>
		<h2>HOD Leaves</h2>
						<tr>
						<th>Employee Name</th>
						<th>Leave Type</th>
						<th>Request Date</th>
						<th>Leave Days</th>
						<th>Status</th>
						<th>Starting Date</th>
						<th>Ending Date</th>
						<th>Department</th>
						";
		$pdf_content = "<h1>Data Extraction For user : ".$_SESSION['principal']."</h1>
						<table>
						<tr>
						<th>Employee Name</th>
						<th>Leave Type</th>
						<th>Request Date</th>
						<th>Leave Days</th>
						<th>Status</th>
						<th>Starting Date</th>
						<th>Ending Date</th>
						<th>Department</th>
						";
		while($row = $result->fetch_assoc())
			{
				echo "<tr>
								<td>".$row['EmpName']."</td>
								<td>".$row['LeaveType']."</td>
								<td>".$row['RequestDate']."</td>
								<td>".$row['LeaveDays']."</td>
								<td>".$row['Status']."</td>
								<td>".$row['StartDate']."</td>
								<td>".$row['EndDate']."</td>
								<td>".$row['Dept']."</td>
								</tr>";
				$pdf_content .= "<tr>
								<td>".$row['EmpName']."</td>
								<td>".$row['LeaveType']."</td>
								<td>".$row['RequestDate']."</td>
								<td>".$row['LeaveDays']."</td>
								<td>".$row['Status']."</td>
								<td>".$row['StartDate']."</td>
								<td>".$row['EndDate']."</td>
								<td>".$row['Dept']."</td>
								</tr>";
			}
		}
echo $sql;
$result = $conn->query($sql);
if($result->num_rows > 0)
	{	
		echo "<table>
		<h2>Teacher Leaves</h2>;
						<tr>
						<th>Employee Name</th>
						<th>Leave Type</th>
						<th>Request Date</th>
						<th>Leave Days</th>
						<th>Status</th>
						<th>Starting Date</th>
						<th>Ending Date</th>
						<th>Department</th>
						";
		$pdf_content = "<h1>Data Extraction For user : ".$_SESSION['principal']."</h1>
						<table>
						<tr>
						<th>Employee Name</th>
						<th>Leave Type</th>
						<th>Request Date</th>
						<th>Leave Days</th>
						<th>Status</th>
						<th>Starting Date</th>
						<th>Ending Date</th>
						<th>Department</th>
						";
		while($row = $result->fetch_assoc())
			{
				echo "<tr>
								<td>".$row['EmpName']."</td>
								<td>".$row['LeaveType']."</td>
								<td>".$row['RequestDate']."</td>
								<td>".$row['LeaveDays']."</td>
								<td>".$row['Status']."</td>
								<td>".$row['StartDate']."</td>
								<td>".$row['EndDate']."</td>
								<td>".$row['Dept']."</td>
								</tr>";
				$pdf_content .= "<tr>
								<td>".$row['EmpName']."</td>
								<td>".$row['LeaveType']."</td>
								<td>".$row['RequestDate']."</td>
								<td>".$row['LeaveDays']."</td>
								<td>".$row['Status']."</td>
								<td>".$row['StartDate']."</td>
								<td>".$row['EndDate']."</td>
								<td>".$row['Dept']."</td>
								</tr>";
			}
		}
?>

<?php
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page!'));
	}
?>
</div>
</body>
</html>