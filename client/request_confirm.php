<html>
<head>
<title>::Leave Request Confirmation::</title>
<?php
session_start();
include 'connect.php';
include 'leave_mailer.php';
include 'clientnavi.php';

require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

$user = $_SESSION['user'];
echo "<link rel='stylesheet' type='text/css' href='style.css'>";
echo "<div class = 'textview'>";
echo "<center>";
if(isset($user))
	{
	$leavetype = $_POST['leavetype'];
	$leavedays = $_POST['leavedays'];
	$leavedate = $_POST['leaveyear']."-".$_POST['leavemonth']."-".$_POST['leavedate'];
	$endleavedate = $_POST['endleaveyear']."-".$_POST['endleavemonth']."-".$_POST['endleavedate'];
	$date = date_create($leavedate);
	$duration = $leavedays." days";
	$interval = date_interval_create_from_date_string($duration);
	$enddate = date_add($date,$interval);
	$end = date_format($enddate,"Y-m-d");
	$empname = $_POST['empname'];
	$emptype = $_POST['emptype'];
	$designation = $_POST['designation'];
	$emptype = $_POST['emptype'];
	$empfee = $_POST['empfee'];


	$rownumber = $_POST['rownumber'];
	$n = 0;
	for($i = 0; $i < $rownumber; $i++){
		$value1 = $_POST['value'.++$n];
		$value2 = $_POST['value'.++$n];
		$value3 = $_POST['value'.++$n];
		$value4 = $_POST['value'.++$n];
		$value5 = $_POST['value'.++$n];
		$value6 = $_POST['value'.++$n];
		$value7 = $_POST['value'.++$n];
		$query = "INSERT INTO engagementrecord VALUES('".$value1."','".$value2."','".$value3."','".$value4."','".$value5."','".$value6."','".$value7."')";
		mysqli_query($conn, $query);

	}
	
	$leavereason = $_POST['leavereason'];
	$dept = $_POST['dept'];

	$target_dir = "applications/";
	$target_file = $target_dir.basename($_FILES['application']['name']);

	if (move_uploaded_file($_FILES['application']['tmp_name'], $target_file))
		{
		$target_location="applications/".basename($_FILES['application']["name"]);
		$ext = pathinfo($target_location, PATHINFO_EXTENSION);
		$new="applications/".$_SESSION['user'].$leavedate.".".$ext;
		rename($target_location,$new);
		// header('location:home.php');
		}


		if(!empty($leavedays))

			{
				if(strtotime($leavedate) > time())
				{
				$sql = "SELECT * FROM employees WHERE UserName='".$user."'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if($row["UserName"] == $user)
							{
								if($leavetype === "Sick Leave")
								{
									if(($leavedays <= $row["SickLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$name = "leaves/".$user.$leavedate.$leavetype.$end.'.pdf';
										$sql2 = "INSERT INTO emp_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											
											$status = mailer($to,$msg,$empname);
											
												if($status == true)
													echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
										}
									else
									{
									header('location:request_leave.php?err='.urlencode("You cannot ask for sick leaves more than that of your account !"));
									}
								}
								else if($leavetype === "Earn Leave")
								{
									if(($leavedays <= $row["EarnLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$name = "leaves/".$user.$leavedate.$leavetype.$end.'.pdf';
										$sql2 = "INSERT INTO emp_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											
											$status = true;//mailer($to,$msg,$empname);
										
												if($status == true)
													echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
										}
									else
									{
									header('location:request_leave.php?err='.urlencode("You cannot ask for earn leaves more than that of your account !"));
									}
								}
								else if($leavetype === "Casual Leave")
								{
									if(($leavedays <= $row["CasualLeave"]) || $leavedays < 0)
										{
										$empname = $row["EmpName"];
										$to = $row["EmpEmail"];
										$name = "leaves/".$user.$leavedate.$leavetype.$end.'.pdf';
										$sql2 = "INSERT INTO emp_leaves(EmpName,LeaveType,LeaveDays,StartDate,EndDate,Dept) VALUES('".$empname."','".$leavetype."','".$leavedays."','".$leavedate."','".$end."','".$row['Dept']."')";
											if (mysqli_query($conn, $sql2))
											{
											$msg = "The Leave Request generated by you is as follows : \nEmployee Name : ".$empname."\nLeave Days Requested : ".$leavedays."\nType of leave : ".$leavetype."\nStarting Date of Leave : ".$leavedate."\n\n\nThank You,\nwebadmin,Leave Management System.";
											
											$status = true;//mailer($to,$msg,$empname);
												if($status == true)
													echo "Request Has Been Sucessfully Submitted.<br/>Please Check Your email for your leave request<br/>";
											}
											else
											{
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
											}
										}
									else
									{
									header('location:request_leave.php?err='.urlencode("You cannot ask for casual leaves more than that of your account !"));
									}
								}
							}
						}
					}
error_reporting(0);

// $target_dir = "applications/";
// $FileName = $_FILES["application"]["name"];
// $TmpName = $_FILES["application"]["tmp_name"];
// move_uploaded_file($TmpName,$FileName);



 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
  
$strm = '';
$n = 0;
for ($i = 0; $i <$rownumber;$i++){

	$strm .='
	<tr>
	<td>'.$_POST['value'.++$n].'</td>
	<td>'.$_POST['value'.++$n].'</td>
	<td>'.$_POST['value'.++$n].'</td>
	<td>'.$_POST['value'.++$n].'</td>
	<td>'.$_POST['value'.++$n].'</td>
	<td>'.$_POST['value'.++$n].'</td>
	<td>'.$_POST['value'.++$n].'</td>
	</tr>';
}

$pdf_content='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
		
			<style type="text/css">							
				#pdf_header, #pdf_container{ border: 1px solid black; padding:10px; align : center;}				
				#pdf_header{ margin:10px auto 0px; border-bottom:none; }				
				table{width:100%;  border: 1px solid black; }				
				#pdf_container{margin:0px auto; }
				.rpt_title{ background:#99CCFF; }
                tr{font-family: sans-serif;text-align: right;}
                td{text-align:left;}
                th{text-align: left; }
                #engagement td,#engagement th{border-collapse: collapse; border:1px solid black; }															
			</style>
							
			<body>
			<div id="pdf_header" >
			<table border="0" cellspacing="1" cellpadding="2">
			<tr id="hdRow">
				<td width="20%"><img src="GECR.jpg" height = 50 width = 50></td>				
				<td width="30%" text-align="left">Government Engineering College<br/>Sejbahar, 492015</td>
				</tr>
			</table>
			</div>
			<div id="pdf_container" >
			<table border="0" cellspacing="1" cellpadding="2">
			<tr bgcolor="#3c4142" style="color:#FFF"><td colspan="3" align="left">Leave Request Copy Of : '.$empname.'</td></tr>
	 		</table>
			<table>
			<tr><th>Employee Name : </th><td>'.$empname.'</td></tr>
			<tr><th>Employee Designation : </th><td>'.$designation.'</td></tr>
			<tr><th>Employment Type : </th><td>'.$emptype.'</td></tr>
			<tr><th>Employee Department : </th><td>'.$dept.'</td></tr>
			<tr><th>Employee Fee Structure : </th><td>'.$empfee.'</td></tr>
			<tr><th>Starting Date Of Leave (yyyy-mm-dd): </th><td>'.$leavedate.'</td></tr>
			<tr><th>No. Of Leave Days : </th><td>'.$leavedays.'</td></tr>
			<tr><th>Reason For Leave : </th><td>'.$leavereason.'</td></tr>
			<tr><th>Type Of Leave : </th><td>'.$leavetype.'</td></tr>
            <br><br><br>
            </table>
			<table style = "width: 100%; border-collapse: collapse;" id = "engagement">
					<tr><th>Date </th>
					<th>Day</th>		
					<th>Period</th>
					<th>Semester</th>
					<th>Branch</th>
					<th>Subject</th>
					<th style = "max-width: 60px;">Engage by faculty Name</th></tr>
					'.$strm.'					
					
				</table>
			</div></body></html>'
			;
			// $name = $user.$leavedate.$leavetype.$end.'.pdf';
			// $reportPDF = createPDF($pdf_content, $name);

			$dompdf->loadHtml($pdf_content); 
			
			// (Optional) Setup the paper size and orientation 
			$dompdf->setPaper('A4', 'portrait'); 
			
			// Render the HTML as PDF 
			$dompdf->render(); 
			
			// Output the generated PDF (1 = download and 0 = preview) 
			// $dompdf->stream("codexworld", array("Attachment" => 0));
			$name = "leaves/".$user.$leavedate.$leavetype.$end.'.pdf';
			file_put_contents($name,$dompdf->output());
			$conn->close();
				}
				else
					{
					header('location:request_leave.php?err='.urlencode('Start Date is invalid !'));
					}
			}
		
		else
			{
			header('location:request_leave.php?err='.urlencode('Pl. Enter some details !'));
			}
	}
	else
	{
	header('location:index.php?err='.urlencode('Please Login first to access this page'));
	}
echo "</center>";
echo "</div>";
$conn->close();
function createPDF($pdf_content, $filename){
	
	$path='leaves/';
	$dompdf=new DOMPDF();
	$dompdf->load_html($pdf_content);
	$dompdf->render();
	$output = $dompdf->output();
	file_put_contents($path.$filename, $output);
	return $filename;		
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
</head>
</html>