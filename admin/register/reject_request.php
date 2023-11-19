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

$id = $_GET['id'];
$email = $id;
$empid = $_GET["empid"];
if(isset($_SESSION['adminuser']))
	{
	
	// $sql = "SELECT * FROM emp_leaves WHERE id='".$id."'";
	$sql2 = "DELETE FROM JOINING_REQUEST WHERE EmpEmail = '".$id."' AND id = '".$empid."'";
	$result = $conn->query($sql2);
	$msg = "Your joining request Has Been <bold>Declined<bold> !";							
	$subject = "Joining Request Declined";
	$status = mailer($email,$msg,$subject);
	$conn->close();
	echo "<script>
	window.location.href='index.php';
	</script>";
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
	}
?>
</div>
</body>
</html>