<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
?>
<html>
<head>
<title>::Leave Management::</title>
<link rel="stylesheet" href="admin/register/style.css">

</head>
<body>
<div class="reg-form">
<center>
<h1>Leave Management System</h1>
<?php
include 'navi.php';?>
<h2>New Employee Registration</h2>
<i><div class = 'error'>*indicates mandatory fields</div></i>
<?php
if(isset($_GET['err']))
	{
		echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
	}
if(TRUE)
	{
	echo"<form id = 'myform' action = 'admin/register/confirm.php' method = 'post'>";
	echo"<table style = 'padding-top: 30px;'>
	<tr><td><div class = 'error'>*</div> Employee Name : </td><td><input type = 'text' name = 'empname' class = 'reg-form-fields shadow selected' placeholder = 'Employee Name'></td></tr>
<tr><td><div class = 'error'>*</div> Username : </td><td><input type = 'text' name = 'uname' class = 'reg-form-fields shadow selected' placeholder = 'Employee Username'></td></tr>
<tr><td><div class = 'error'>*</div> Date of joining (dd/mm/yyyy): <td><input type = 'number' name = 'date-join' min = '1' max = '31' class = 'date-of-joining shadow selected' step = '1' placeholder = 'dd' style='width:50px;'><input type = 'number' name = 'month-join' min = '1' max = '12' class = 'date-of-joining shadow selected' step = '1' placeholder = 'mm' style='width:50px;'><input type = 'number' name = 'year-join' min = '1985' max = '".date('Y')."' class = 'date-of-joining shadow selected' step = '1' placeholder = 'yyyy' style='width:100px;'></td></tr>
<tr><td><div class = 'error'>*</div> Date of birth (dd/mm/yyyy): <td><input type = 'number' name = 'date-birth' min = '1' max = '31' class = 'date-of-joining shadow selected' step = '1' placeholder = 'dd' style='width:50px;'><input type = 'number' name = 'month-birth' min = '1' max = '12' class = 'date-of-joining shadow selected' step = '1' placeholder = 'mm' style='width:50px;'><input type = 'number' name = 'year-birth' min = '1901' max = '".date('Y')."' class = 'date-of-joining shadow selected' step = '1' placeholder = 'yyyy' style='width:100px;'></td></tr>
<tr><td><div class = 'error'>*</div> Employee email id : </td><td><input type = 'text' name = 'mailid' class = 'reg-form-fields shadow selected' placeholder = 'Employee Email ID'></td></tr>
<tr><td><div class = 'error'>*</div> Department : </td><td><select name = 'dept' class = 'reg-form-fields shadow selected'>
						<option>CSE</option><option>ET&T</option><option>MECH</option><option>CIVIL</option><option>EEE</option>
				  </select>
				  </td></tr>
<tr><td><div class = 'error'>*</div> Gender : </td><td><select name = 'gender' class = 'reg-form-fields shadow selected'>
						<option>Male</option><option>Female</option>
				  </select>
				  </td></tr>
<tr><td><div class = 'error'>*</div> Designation : </td><td><input type = 'text' name = 'designation' class = 'reg-form-fields shadow selected' placeholder = 'Employee Designation'></td></tr>
<tr><td><div class = 'error'>*</div> Employment Type : </td><td><select name = 'factype' class = 'reg-form-fields shadow selected'>
						<option>Permanent</option><option>Ad-hoc</option><option>Fix</option>
				  </select>
				  <select name = 'facfee' class = 'reg-form-fields shadow selected'>
						<option>Grant In Aid</option><option>Self Finance</option>
				  </select></td></tr>
<tr><td><input type = 'submit' value = 'Submit' class = 'registration shadow'></td></tr>
</form>
</table>
</center>
</div>";
	}
	// else
	// {
	// 	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
	// }

	echo "<script>
			const form = document.getElementById('myform');
			form.addEventListener('keypress',function(e){
				if(e.keyCode === 13){
					e.preventDefault();

				}
			});
		</script>"
?>
</body>
</html>