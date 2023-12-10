<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="table.css">
</head>
<body>
<?php
echo "<div class = 'textview'>";
echo "<h1>Leave Management System</h1>";
include 'connect.php';
include 'adminnavi.php';
$condition = "";
$count = 0;
if(isset($_SESSION['adminuser']))
	{
	if(isset($_GET['msg']))
		{
			echo "<div class = 'msg'><b><u>".htmlspecialchars($_GET['msg'])."</u></b></div>";
		}
	echo "<div class = 'textview'>";
	echo "<center>";
	echo "<h2>Search for the employee to be deleted</h2>";
	echo "<table>";
	echo "<form method = 'post' action = 'searchemp.php'>";
	echo "<tr><td><input type = 'text' name = 'name' class = 'textbox shadow selected'></td><td><input type = 'submit' name = 'submit' value = 'Search' class = 'login-button shadow'></td></tr>";
	echo "</form>";
	echo "</table>";
	echo "</center>";
	echo "</div>";
	if(!empty($_POST['name'])){
	
		if(!preg_match("/[^a-z_\-0-9]/i", $_POST['name'])){
   			$name=$_POST['name'];
	 		$condition = "WHERE  EmpName LIKE '%" . $name . "%' OR UserName LIKE '%" . $name  ."%'";
		}
	}
		$sql="SELECT UserName, EmpName, EmpEmail, Dept,EarnLeave,SickLeave,CasualLeave, id FROM employees ".$condition;
		$result = $conn->query($sql);
		echo "<br>";
		echo "<table>";
		// echo "<h2>Employee Search Results</h2>";
		echo "<tr><th>Username</th><th>Employee Name</th><th>Employee email</th><th>Department</th><th>Earn Leaves</th><th>Sick Leaves</th><th>Casual Leaves</th></tr>";
		if ($result->num_rows > 0) {
			$sql2 = "SELECT Dept FROM admins WHERE username = '".$_SESSION['adminuser']."'";
			$result2 = $conn->query($sql2);
			if($result2->num_rows > 0){
				while($row2 = $result2->fetch_assoc()){
					while($row = $result->fetch_assoc()){
						if($row2["Dept"] == $row["Dept"])
							{
							echo "<tr><td>" . $row["UserName"]. "</td><td>" . $row["EmpName"]. "</td><td>" . $row["EmpEmail"]."</td><td>".$row["Dept"]."</td><td>".$row["EarnLeave"]."</td><td>".$row["SickLeave"]."</td><td>".$row["CasualLeave"]."</td>";
							echo "<td><a href = 'empdelete.php?id=".$row["id"]."&user=".$row["UserName"]."'>Delete This User</a></td></tr>";
							$count++;
							}
					}
				}
			}
			
			echo $count." results";
			echo "</table>";
		}
		else{
			echo $count." results";
		}
		
  	// else
	// {
	// 	echo "<div class = 'textview'>";
	// 	echo  "Please enter a search query ";
	// 	echo "<a href = 'searchemp.php'>try again?</a>";
	// }
  	echo "</div>";
}
	
else
	{
		header('location:index.php?err='.urlencode('Please login first to access this page !'));
	}
?>
</body>
</html>