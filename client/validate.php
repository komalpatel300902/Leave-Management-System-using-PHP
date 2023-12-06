<?php
session_start();
include 'connect.php';
require 'update_leaves.php';
// $username = strip_tags(trim($_POST['uname']));
// $password = strip_tags(trim($_POST['pass']));
$username =$_POST['uname'];
$password = $_POST['pass'];
// $sql = "SELECT UserName, EmpPass,UpdateStatus,Dept FROM employees";
$sql = "SELECT * FROM employees";
// $result = $conn->query($sql);(
$result = mysqli_query($conn,$sql) or die("Query Failed");
if($result->num_rows>0){
	
	while($row = mysqli_fetch_assoc($result)) {
		
        if(($username == $row["UserName"]) && ($password == $row["EmpPass"]))
			{
			$_SESSION["user"] = $username;
			$dept = $row["dept"];
			$status = update_leaves($username,$dept);
			if($status  === true)
				{
				header('location:home.php?msg='.urlencode('Your Leaves Were Updated Successfully !'));
				exit();
				}
			else{
				header('location:index.php');
			}
		}
		else{
			header('location:index.php?err='.urlencode('Username Or Password Incorrect'));
			exit();
		}
		
    }
}
else
	{
		echo "Database Empty ! Please register some employees first";
	}	
?>