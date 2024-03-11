<title>::Leave Management::</title>
<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user']))
	{
	echo "<link rel='stylesheet' type='text/css' href='style.css'>";
	echo "<link rel = 'stylesheet' href= 'table.css'>";
	echo "<center>";
	echo "<div class = 'textview'>";
	echo "<h1>Leave Management System</h1>";
	include 'clientnavi.php';
	echo "<h2>Please Select Your Leave Type</h2>";
	if(isset($_GET['err']))
				{
				echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
				}
	echo "<form action = 'leaverequest.php' method = 'post'>";
	$sql = "SELECT * FROM employees WHERE UserName = '".$_SESSION['user']."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
			echo "<table>";
			echo "<tr><th> * Leave Type : </th>
			<td>
			<select name = 'leavetype' id = 'leavetype' class = 'textbox shadow selected' >
			";
			while($row = $result->fetch_assoc())
				{
				if($row['SickLeave'] > 0){
					// echo "<button type = 'submit' name = 'type' value = 'Sick Leave' class = 'login-button shadow'>Sick Leave ".$row['SickLeave']. "</button>";	
					// echo "<option value = 'Sick Leave'>Sick Leave : ".$row['SickLeave']."</option>";
					}
				else{
						// echo "<button type = 'submit' name = 'type' value = 'Sick Leave' class = 'error-button shadow' disabled>Sick Leave".$row['SickLeave']."</button>";
					}
				if($row['EarnLeave'] > 0){
					// echo "<button type = 'submit' name = 'type' value = 'Earn Leave' class = 'login-button shadow'>Earn Leave  ".$row['EarnLeave']."</button>";	
					echo "<option value = 'Earn Leave'>Earn Leave : ".$row['EarnLeave']. "</option>";
					}
				else{
						// echo "<button type = 'submit' name = 'type' value = 'Earn Leave' class = 'error-button shadow' disabled>Earn Leave  ".$row['EarnLeave']."</button>";
					}
				if($row['CasualLeave'] > 0){
					// echo "<button type = 'submit' name = 'type' value = 'Casual Leave' class = 'login-button shadow'>Casual Leave ".$row['CasualLeave']."</button>";	
					echo "<option value = 'Casual Leave' >Casual Leave : ".$row['CasualLeave']."</option>";
					}
				else{
						// echo "<button type = 'submit' name = 'type' value = 'Casual Leave' class = 'error-button shadow' disabled>Casual Leave ".$row['CasualLeave']."</button>";
					}
					echo "<br><br>";

				if($row['MaternityLeave'] > 0 && $row['gender'] == 'Female'){
					echo "<option value = 'Maternity Leave'>Maternity Leave : ".$row['MaternityLeave']."</option>";
					// echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' class = 'login-button shadow'>Maternity Leave ".$row['MaternityLeave']."</button>";
					}
				else if($row['MaternityLeave'] > 0 && $row['gender'] == 'Male'){
					// echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' class = 'login-button shadow' >Paternity Leave ".$row['MaternityLeave']."</button>";
					echo "<option value = 'Maternity Leave'>PaternityLeave : ".$row['MaternityLeave']. "</option>";
				}
				else{
					// echo "<button type = 'submit' name = 'type' value = 'Maternity Leave' class = 'error-button shadow' disable >Paternity Leave ".$row['MaternityLeave']."</button>";
			
				}
				if($row['optionalleave'] > 0){
					// echo "<button type = 'submit' name = 'type' value = 'Optional Leave' class = 'login-button shadow' >Compassionate Leave ".$row['optionalleave']."</button>";
					echo "<option value = 'Optional Leave'>Optional Leave : ".$row['optionalleave']."</option>";
					}
				else{
					// echo "<button type = 'submit' name = 'type' value = 'Compassionate Leave' class = 'error-button shadow' disabled>Compassionate Leave ".$row['optionalleave']."</button>";
				}
				if($row['NursingLeave'] > 0)
					{
					// echo "<button type = 'submit' name = 'type' value = 'Nursing Leave' class = 'login-button shadow' >Nursing Leave ".$row['NursingLeave']."</button>";
					echo "<option value = 'Nursing Leave'>Child Care Leave : ".$row['NursingLeave']."</option>";
					}
				else{
					// echo "<button type = 'submit' name = 'type' value = 'Nursing Leave' class = 'error-button shadow' disabled>Nursing Leave ".$row['NursingLeave']."</button>";
				}
				echo "<br><br>";
				if($row['CommutionLeave'] > 0){	
					// echo "<button type = 'submit' name = 'type' value = 'Commution Leave' class = 'login-button shadow' >Commution Leave ".$row['CommutionLeave']."</button>";
					echo "<option value = 'Commution Leave'>Commuted Leave : ".$row['CommutionLeave']. "</option>";
				}
				else{
					// echo "<button type = 'submit' name = 'type' value = 'Commution Leave' class = 'error-button shadow' disabled>Commution Leave ".$row['CommutionLeave']."</button>";
				}
				if($row['StudyLeave'] > 0)
				{
					// echo "<button type = 'submit' name = 'type' value = 'Study Leave' class = 'login-button shadow' >Study Leave ".$row['StudyLeave']."</button>";
					// echo "<option value = 'Study Leave' >Study Leave : ".$row['SickLeave']."</option>";
				}
				else{
					// echo "<button type = 'submit' name = 'type' value = 'Study Leave' class = 'error-button shadow' disabled>Study Leave ".$row['StudyLeave']."</button>";
				}
				}
		}
		echo "</select>";
		
		echo "<tr><th> * Starting Date : </th>
		<td>
		<select name = 'leavedate' id = 'leavedate' class = 'textbox shadow selected' >
			<option value = '01'>1</option>
			<option value = '02'>2</option>
			<option value = '03'>3</option>
			<option value = '04'>4</option>
			<option value = '05'>5</option>
			<option value = '06'>6</option>
			<option value = '07'>7</option>
			<option value = '08'>8</option>
			<option value = '09'>9</option>
			<option value = '10'>10</option>
			<option value = '11'>11</option>
			<option value = '12'>12</option>
			<option value = '13'>13</option>
			<option value = '14'>14</option>
			<option value = '15'>15</option>
			<option value = '16'>16</option>
			<option value = '17'>17</option>
			<option value = '18'>18</option>
			<option value = '19'>19</option>
			<option value = '20'>20</option>
			<option value = '21'>21</option>
			<option value = '22'>22</option>
			<option value = '23'>23</option>
			<option value = '24'>24</option>
			<option value = '25'>25</option>
			<option value = '26'>26</option>
			<option value = '27'>27</option>
			<option value = '28'>28</option>
			<option value = '29'>29</option>
			<option value = '30'>30</option>
			<option value = '31'>31</option>
		</select>
		<select name = 'leavemonth' id = 'leavemonth' class = 'textbox shadow selected'>
			<option value = '01'>1</option>
			<option value = '02'>2</option>
			<option value = '03'>3</option>
			<option value = '04'>4</option>
			<option value = '05'>5</option>
			<option value = '06'>6</option>
			<option value = '07'>7</option>
			<option value = '08'>8</option>
			<option value = '09'>9</option>
			<option value = '10'>10</option>
			<option value = '11'>11</option>
			<option value = '12'>12</option>
		</select>
		<select name = 'leaveyear' id = 'leaveyear' class = 'textbox shadow selected'>
			<option value = '".date("Y")."'>".date("Y")."</option>
			<option value = '".(date("Y")+1)."'>".(date("Y")+1)."</option>
		</select>
		</td>
		</tr>";
		echo "<tr><th> * End Date : </th>
		<td>
		<select name = 'endleavedate' id = 'endleavedate' class = 'end textbox shadow selected' >
			<option value = '01'>1</option>
			<option value = '02'>2</option>
			<option value = '03'>3</option>
			<option value = '04'>4</option>
			<option value = '05'>5</option>
			<option value = '06'>6</option>
			<option value = '07'>7</option>
			<option value = '08'>8</option>
			<option value = '09'>9</option>
			<option value = '10'>10</option>
			<option value = '11'>11</option>
			<option value = '12'>12</option>
			<option value = '13'>13</option>
			<option value = '14'>14</option>
			<option value = '15'>15</option>
			<option value = '16'>16</option>
			<option value = '17'>17</option>
			<option value = '18'>18</option>
			<option value = '19'>19</option>
			<option value = '20'>20</option>
			<option value = '21'>21</option>
			<option value = '22'>22</option>
			<option value = '23'>23</option>
			<option value = '24'>24</option>
			<option value = '25'>25</option>
			<option value = '26'>26</option>
			<option value = '27'>27</option>
			<option value = '28'>28</option>
			<option value = '29'>29</option>
			<option value = '30'>30</option>
			<option value = '31'>31</option>
		</select>
		<select name = 'endleavemonth' id = 'endleavemonth' class = 'end textbox shadow selected'>
			<option value = '01'>1</option>
			<option value = '02'>2</option>
			<option value = '03'>3</option>
			<option value = '04'>4</option>
			<option value = '05'>5</option>
			<option value = '06'>6</option>
			<option value = '07'>7</option>
			<option value = '08'>8</option>
			<option value = '09'>9</option>
			<option value = '10'>10</option>
			<option value = '11'>11</option>
			<option value = '12'>12</option>
		</select>
		<select name = 'endleaveyear' id = 'endleaveyear' class = 'end textbox shadow selected'>
			<option value = '".date("Y")."'>".date("Y")."</option>
			<option value = '".(date("Y")+1)."'>".(date("Y")+1)."</option>
		</select>
		</td>
		</tr>";

		echo "<tr><th> * No Of Leave Days : </th><td><input type = 'number' min = '1' name = 'leavedays' class = 'textbox shadow selected' step = '1'></td></tr>";
		echo "<tr><th> * Resaon For Leave : </th><td><input type = 'text' name = 'leavereason' class = 'textbox shadow selected'></td></tr>";
		echo "<input type = 'file' accept = '.doc , .pdf , .docx' name = 'application' id = 'application'>";
		echo "</table>";
		
		echo "<button type = 'submit' class = 'login-button shadow' >Next</button>";
					



	// echo "<br/><tr><td><input type = 'submit' value = 'Request a Leave' class = 'login-button shadow'></td></tr>";
	
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