<?php
echo "<link rel = 'stylesheet' href= 'style.css'>";
echo "<link rel = 'stylesheet' href= 'table.css'>";
echo "<script type = 'text/javascript' src = 'JQuery.js'></script>";
echo "<center>";
echo "<div class = 'textview' >";
include 'connect.php';
echo "<h1>Leave Management System</h1>";
include 'clientnavi.php';
include 'period_searcher.php';
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
			echo "<h2>Request For A Leave for : ".$_POST['leavetype']."</h2>";
			echo "<form action = 'request_confirm.php' method = 'post' id = 'myform' enctype='multipart/form-data'>";
			echo "<table>";
			echo "<input type = 'hidden' name = 'empname' value = '".$row["EmpName"]."'>";
			echo "<input type = 'hidden' name = 'designation' value = '".$row["Designation"]."'>";
			echo "<input type = 'hidden' name = 'dept' value = '".$row["Dept"]."'>";
			echo "<input type = 'hidden' name = 'emptype' value = '".$row["EmpType"]."'>";
			echo "<input type = 'hidden' name = 'empfee' value = '".$row["EmpFee"]."'>";
			echo "<input type = 'hidden' name = 'leavetype' value = '".$_POST['leavetype']."'>";
			echo "<input type = 'hidden' name = 'leavedays' value = '".$_POST["leavedays"]."'>";
			echo "<input type = 'hidden' name = 'leaveyear' value = '".$_POST["leaveyear"]."'>";
			echo "<input type = 'hidden' name = 'leavemonth' value = '".$_POST["leavemonth"]."'>";
			echo "<input type = 'hidden' name = 'leavedate' value = '".$_POST["leavedate"]."'>";
			echo "<input type = 'hidden' name = 'endleaveyear' value = '".$_POST["endleaveyear"]."'>";
			echo "<input type = 'hidden' name = 'endleavemonth' value = '".$_POST["endleavemonth"]."'>";
			echo "<input type = 'hidden' name = 'endleavedate' value = '".$_POST["endleavedate"]."'>";
			echo "<input type = 'hidden' name = 'leavereason' value = '".$_POST["leavereason"]."'>";
			$empname = $row["EmpName"];
			$leavedate = $_POST['leaveyear']."/".$_POST['leavemonth']."/".$_POST['leavedate'];
			$endleavedate = $_POST['endleaveyear']."/".$_POST['endleavemonth']."/".$_POST['endleavedate'];
		echo $empname;
		echo "</table>";

		echo"<div id = 'division' >

		</div>";
		echo "<table>";
		$dates = get_range_of_dates($leavedate,$endleavedate);
		$s = data_printer($dates,$empname);
		if ($s != ""){
			echo "	<tr>
			<th>Date </th>
			<th>Day</th>
			<th>Period</th>		
			<th>Semester</th>
			<th>Branch</th>
			<th>Subject</th>
			<th>Engaged by faculty Name</th>
			";
			echo $s;
		}
		
		echo "</table>";

		echo"<script>
		$('#btn').click(function(){
			console.log('i am in cansole');
			var startdate = $('#leaveyear').val() +'/'+$('#leavemonth').val()+'/'+$('#leavedate').val();
		 	var enddate = $('#endleaveyear').val() +'/'+$('#endleavemonth').val()+'/'+$('#endleavedate').val()
			console.log(enddate);
			console.log(startdate);
			$('#division').append(`".$s."`+ startdate +`startdate `);
		});
		</script>";
		// echo"<script>

		// function getDatesInRange(startDate, endDate) {
		// 	const date = new Date(startDate.getTime());
		
		// 	var s = '';
		
		// 	while (date <= endDate) {
		// 	s = s+ '<option>'+date.getDate()+'-'+(date.getMonth()+1)+ '-'+date.getFullYear() +'</option>';
		// 	date.setDate(date.getDate() + 1);
		// 	}
		
		// 	return s;
		// }
		
		// //   const d1 = new Date('2022-01-18');
		// //         const d2 = new Date('2022-01-24'); 
		
		// //   console.log(getDatesInRange(d1, d2));
		
				
		// var days = daysdifference('03/19/2021', '03/31/2021');  
		   
		// console.log(days);  
			
		// function daysdifference(firstDate, secondDate){  
		// 	var startDay = new Date(firstDate);  
		// 	var endDay = new Date(secondDate);  
		
		    
		// 	var millisBetween = startDay.getTime() - endDay.getTime();  
		
		  
		// 	var days = millisBetween / (1000 * 3600 * 24);       
		// 	return Math.round(Math.abs(days));  
		// }  



		// $('#btn').click(function(){
		// console.log('i am in my function');
		// var n = $('#nvalue').val();

		// if(n==0){
		// 	$('#division').html(``);
		// }


		// if (n>0){
		// 	console.log($('#leaveyear').val() +'-'+$('#leavemonth').val()+'-'+$('#leavedate').val());
		// 	var startdate = $('#leaveyear').val() +'-'+$('#leavemonth').val()+'-'+$('#leavedate').val();
		// 	var enddate = $('#endleaveyear').val() +'-'+$('#endleavemonth').val()+'-'+$('#endleavedate').val()
		// const d1 = new Date(startdate);
		// const d2 = new Date(enddate);
		// console.log(d1,d2);
		// var s = getDatesInRange(d1, d2);
		
		// 	$('#division').html(`<table>
		// 	<tr>
		// 	<th>Date </th>
		// 	<th>Day</th>
		// 	<th>Period</th>		
		// 	<th>Semester</th>
		// 	<th>Branch</th>
		// 	<th>Subject</th>
		// 	<th>Engaged by faculty Name</th>
		// 	</tr>
		// 	</table>`);
		// 	var j = 0; 
			
		// 	for(var i = 0; i < n; i++){
				
		// 		$('#division').append(`<table> 
		// 		<tr>
		// 		<td><select type = 'text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:90px;'>`
			
		// 		+s+`</select></td>

		// 		<td><select type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:100px;'>
		// 		<option value = 'Monday'>Monday</option>
		// 		<option value = 'Tuesday'>Tuesday</option>
		// 		<option value = 'Wednesday'>Wednesday</option>
		// 		<option value = 'Thrusday'>Thrusday</option>
		// 		<option value = 'Friday'>Friday</option>
		// 		<option value = 'Saturday'>Saturday</option>
		// 		</select></td>
		// 		<td><select type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:50px;'>
		// 		<option value = '1'>1</option>
		// 		<option value = '2'>2</option>
		// 		<option value = '3'>3</option>
		// 		<option value = '4'>4</option>
		// 		<option value = '5'>5</option>
		// 		<option value = '6'>6</option>
		// 		<option value = '7'>7</option>
		// 		<option value = '8'>8</option></select></td>		
		// 		<td><select type='number' min = '1' max = '8' step = '1' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:40px;'>
		// 		<option value = '1'>1</option>
		// 		<option value = '2'>2</option>
		// 		<option value = '3'>3</option>
		// 		<option value = '4'>4</option>
		// 		<option value = '5'>5</option>
		// 		<option value = '6'>6</option>
		// 		<option value = '7'>7</option>
		// 		<option value = '8'>8</option></select></td>
		// 		<td><select type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:50px;'>
		// 		<option value = 'CSE'>CSE</option>
		// 		<option value = 'EEE'>EEE</option>
		// 		<option value = 'CIVIL'>CIVIL</option>
		// 		<option value = 'MECH'>MECH</option>
		// 		<option value = 'ET&T'>ET&T</option></select></td>
		// 		<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:100px;'></td>
				
		// 		<td><input type='text' name = 'value`+ ++j +`' class = 'textbox shadow selected' style='width:110px;'></td>
		// 		</tr>`);
		// 	}
		// 	$('#division').append('</table>');
		// }

		// });
		// </script>";


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