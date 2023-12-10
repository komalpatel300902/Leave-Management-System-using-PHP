<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();
echo "<center>";
echo "<div class = 'textview'>";
echo "<h1>Leave Management System</h1>";
include 'connect.php';
include 'adminnavi.php';
if(isset($_SESSION['principal']))
		{
		if(isset($_GET['msg']))
			{
				echo "<div class = 'msg'><b><u>".htmlspecialchars($_GET['msg'])."</u></b></div>";
			}
		echo "<br/><h2>Welcome, " .strtoupper( $_SESSION["principal"]) ."</h2>";
		echo "<br>";
		echo "<h2>Set Email for Getting Notification : <h2>";
		echo "<form method = 'post'>";
		echo "<input type = 'email' class = 'textbox shadow selected' id = 'hodemail' name = 'hodemail' placeholder = 'abc@gmail.com'>";
		echo "<input type = 'submit' class = 'login-button shadow' name = 'hodemail_submit' >";
		echo "</form>";

		if(isset($_POST['hodemail_submit'])){
			$email = $_POST["hodemail"];
			$sql = "UPDATE principal SET email ='".$email."' WHERE username = '".$_SESSION["principal"]."'";
			$conn->query($sql);
		}
		$sql2 = "SELECT * FROM principal WHERE username = '".$_SESSION["principal"] ."'";
		if($conn->query($sql2) == TRUE)
			{
				$result = $conn->query($sql2);
				if($result->num_rows > 0)
					{
						while($row2 = $result->fetch_assoc())
							{
								$hodmailid = $row2['email'];
							}
					}
			}
		echo "<h2>Current Email : <bold>".$hodmailid."</bold></h2>";
		
		}
else
	{
		header('location:index.php?err='.urlencode('Please Login first to access this page'));
	}
echo "</div>";
echo "</center>";
?>

<html>
<head>
<title>::Leave Management::</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css">
