<?php
echo "<link rel = 'stylesheet' href= 'style.css'>";
echo "<link rel = 'stylesheet' href= 'table.css'>";
echo "<script type = 'text/javascript' src = 'JQuery.js'></script>";
echo "<center>";
echo "<div class = 'textview' >";
include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'clientnavi.php';
session_start();

if(isset($_SESSION['user']))
	{
	$user = $_SESSION['user'];
	$sql = "SELECT * FROM employees WHERE UserName = '".$user."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
		{
		while($row = $result->fetch_assoc())
			{
			echo "<body>";
			echo "<h2>Request For A Leave for : ".$_POST['type']."</h2>";
			echo "<form action = 'request_confirm.php' method = 'post' id = 'myform'>";
			echo "<table>";
			echo "<input type = 'hidden' name = 'empname' value = '".$row["EmpName"]."'>";
			echo "<input type = 'hidden' name = 'designation' value = '".$row["Designation"]."'>";
			echo "<input type = 'hidden' name = 'dept' value = '".$row["Dept"]."'>";
			echo "<input type = 'hidden' name = 'emptype' value = '".$row["EmpType"]."'>";
			echo "<input type = 'hidden' name = 'empfee' value = '".$row["EmpFee"]."'>";
			
			echo "<tr><th> * Starting Date : </th>
					<td>
					<select name = 'leavedate' class = 'textbox shadow selected' style='width:50px;'>
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
					<select name = 'leavemonth' class = 'textbox shadow selected'>
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
					<select name = 'leaveyear' class = 'textbox shadow selected'>
						<option value = '".date("Y")."'>".date("Y")."</option>
					</select>
					</td>
					</tr>";
					echo "<tr><th> * End Date : </th>
					<td>
					<select name = 'endleavedate' class = 'end textbox shadow selected' style='width:50px;'>
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
					<select name = 'endleavemonth' class = 'end textbox shadow selected'>
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
					<select name = 'endleaveyear' class = 'end textbox shadow selected'>
						<option value = '".date("Y")."'>".date("Y")."</option>
					</select>
					</td>
					</tr>";

			echo "<input type = 'hidden' name = 'leavetype' value = '".$_POST['type']."'>";
			echo "<tr><th> * No Of Leave Days : </th><td><input type = 'number' min = '1' name = 'leavedays' class = 'textbox shadow selected' step = '1'></td></tr>";
			echo "<tr><th> * Resaon For Leave : </th><td><input type = 'text' name = 'leavereason' class = 'textbox shadow selected'></td></tr>";
			echo "<input type = 'file' accept = '.doc , .pdf , .docx' name = 'application' id = 'application'>";
			
			
			
			
			// echo "<br/><tr><td><input type = 'submit' value = 'Request a Leave' class = 'login-button shadow'></td></tr>";
			echo "</table>";
			
			echo"<div >
			<span class = 'textbox shadow selected' style = 'border:0px;'>Number of engagement you want to make</span>
			<input type = 'number' class = 'textbox shadow selected' name ='rownumber' id = 'nvalue'>
			<span class = 'textbox shadow selected' name = 'submit1' id ='btn'>Click Me</span>
			</div>";

    		echo"<div id = 'division' >
			
			</div>";

			echo"<script>
			$('#btn').click(function(){
			console.log('i am in my function');
			var n = $('#nvalue').val();

			if(n==0){
				$('#division').html(``);
			}

			
			if (n>0){
				$('#division').html(`<table>
				<tr>
				<th>Date </th>
				<th>Day</th>
				<th>Period</th>		
				<th>Semester</th>
				<th>Branch</th>
				<th>Subject</th>
				<th>Engaged by faculty Name</th>
				</tr>
				</table>`);
				var j = 0;
				for(var i = 0; i < n; i++){
					
					$('#division').append(`<table> 
					<tr>
					<td><input type = 'text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:90px;'></td>
					<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:100px;'></td>
					<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:50px;'></td>		
					<td><input type='number' min = '1' max = '8' step = '1' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:40px;'></td>
					<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:50px;'></td>
					<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:100px;'></td>
					
					<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:110px;'></td>
					</tr>`);
				}
				$('#division').append('</table>');
			}
		
		});
		</script>";


		echo "<script>
			const form = document.getElementById('myform');
			form.addEventListener('keypress',function(e){
				if(e.keyCode === 13){
					e.preventDefault();

				}
			});

			const rows = document.getElementById('nvalue');
			form.addEventListener('keypress',function(e){
				if(e.keyCode === 13){
					document.getElementById('btn').click();

				}
			});
		</script>
		";
		echo "<br/><tr><td><input type = 'submit' value = 'Request a Leave' class = 'login-button shadow'></td></tr>";
		echo "</form>";
		echo "</div>";
		echo "</center>";
		echo "</body>";	
			
			
			}
		}
	}
else
	{
	header('location:index.php?err='.urlencode('Please Login First To Access This Site !'));
	}
?>
<title>::Leave Management::</title>
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