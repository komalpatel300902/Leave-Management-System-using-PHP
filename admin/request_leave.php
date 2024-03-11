<title>::Leave Management::</title>
<?php
session_start();
include 'connect.php';
if(isset($_SESSION['adminuser']))
	{
	echo "<link rel='stylesheet' type='text/css' href='style.css'>";
	echo "<center>";
	echo "<div class = 'textview'>";
	echo "<h1>Leave Management System</h1>";
	include 'adminnavi.php';
	echo "<h2>Please Select Your Leave Type</h2>";
	if(isset($_GET['err']))
				{
				echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
				}
	echo "<form action = 'leaverequest.php' method = 'post'>";
	$sql = "SELECT * FROM admins WHERE UserName = '".$_SESSION['adminuser']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
				{
				if($row['SickLeave'] > 0){
					echo "<button type = 'submit' name = 'type' value = 'Sick Leave' class = 'login-button shadow'>Sick Leave ".$row['SickLeave']. "</button>";	
					}
				else{
						echo "<button type = 'submit' name = 'type' value = 'Sick Leave' class = 'error-button shadow' disabled>Sick Leave".$row['SickLeave']."</button>";
					}
				if($row['EarnLeave'] > 0){
					echo "<button type = 'submit' name = 'type' value = 'Earn Leave' class = 'login-button shadow'>Earn Leave  ".$row['EarnLeave']."</button>";	
					}
				else{
						echo "<button type = 'submit' name = 'type' value = 'Earn Leave' class = 'error-button shadow' disabled>Earn Leave  ".$row['EarnLeave']."</button>";
					}
				if($row['CasualLeave'] > 0){
					echo "<button type = 'submit' name = 'type' value = 'Casual Leave' class = 'login-button shadow'>Casual Leave ".$row['CasualLeave']."</button>";	
					}
				else{
						echo "<button type = 'submit' name = 'type' value = 'Casual Leave' class = 'error-button shadow' disabled>Casual Leave ".$row['CasualLeave']."</button>";
					}
					echo "<br><br>";

				if($row['MaternityLeave'] > 0 && $row['gender'] == 'Female'){
					echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' class = 'login-button shadow'>Maternity Leave ".$row['MaternityLeave']."</button>";
					}
				else{
					echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' class = 'error-button shadow' disabled>Maternity Leave ".$row['MaternityLeave']."</button>";
				}
				if($row['optionalleave'] > 0){
					echo "<button type = 'submit' name = 'type' value = 'Optional Leave' class = 'login-button shadow' >Optional Leave ".$row['optionalleave']."</button>";
					}
				else{
					echo "<button type = 'submit' name = 'type' value = 'Optional Leave' class = 'error-button shadow' disabled>Optional Leave ".$row['optionalleave']."</button>";
				}
				if($row['NursingLeave'] > 0)
					{
					echo "<button type = 'submit' name = 'type' value = 'Nursing Leave' class = 'login-button shadow' >Nursing Leave ".$row['NursingLeave']."</button>";
					}
				else{
					echo "<button type = 'submit' name = 'type' value = 'Nursing Leave' class = 'error-button shadow' disabled>Nursing Leave ".$row['NursingLeave']."</button>";
				}
				echo "<br><br>";
				if($row['CommutionLeave'] > 0){	
					echo "<button type = 'submit' name = 'type' value = 'Commution Leave' class = 'login-button shadow' >Commution Leave ".$row['CommutionLeave']."</button>";
				}
				else{
					echo "<button type = 'submit' name = 'type' value = 'Commution Leave' class = 'error-button shadow' disabled>Commution Leave ".$row['CommutionLeave']."</button>";
				}
				if($row['StudyLeave'] > 0)
				{
					echo "<button type = 'submit' name = 'type' value = 'Study Leave' class = 'login-button shadow' >Study Leave ".$row['StudyLeave']."</button>";
				}
				else{
					echo "<button type = 'submit' name = 'type' value = 'Study Leave' class = 'error-button shadow' disabled>Study Leave ".$row['StudyLeave']."</button>";
				}
				}
		}
	echo "</form>";
	}
	else
		{
		header('location:index.php?err='.urlencode('Please Login for Accessing this page'));
		}
?>

<script type="text/javascript">
        function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
    </script>