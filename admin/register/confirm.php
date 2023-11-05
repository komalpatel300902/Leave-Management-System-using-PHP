<link rel="shortcut icon" type="image/png" href="favicon.png"/>
<?php
session_start();

require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

include 'connect.php';
include 'mailer.php';
?>							
<link rel="stylesheet" href="style.css">
<title>::Leave Management::</title>
<?php
// // if(TRUE)
// // {
// 	$sql = "SELECT Dept,username FROM admins WHERE username = '".$_SESSION['adminuser']."'";
// 	$result = $conn->query($sql);
// 	if($result->num_rows > 0)
// 		{
// 			$row = $result->fetch_assoc();
// 			$dept = $row["Dept"];
// 		}
include '../navi.php';

if(isset($_GET['err']))
	{
		echo "<div class = 'error'><b><u>".htmlspecialchars($_GET['err'])."</u></b></div>";
	}
$errmsg = $sql = "";
$empname = trim($_POST['empname']);
$uname = trim($_POST['uname']);
$dept = $_POST['dept'];
$mailid = trim($_POST['mailid']);
$doj = trim($_POST['year-join'])."-".trim($_POST['month-join'])."-".trim($_POST['date-join']);
$dob = trim($_POST['year-birth'])."-".trim($_POST['month-birth'])."-".trim($_POST['date-birth']);
$dob2 = trim($_POST['date-birth'])."-".trim($_POST['month-birth'])."-".trim($_POST['year-birth']);
$gender = $_POST["gender"];
$empname = strip_tags($empname);
$uname = strip_tags($uname);
$mailid = strip_tags($mailid);
$doj = strip_tags($doj);
$dob = strip_tags($dob);
$dob2 = strip_tags($dob2);
$pass = $dob2;
$designation = strip_tags(trim($_POST['designation']));
$emptype = strip_tags(trim($_POST['factype']));
$empfee = strip_tags(trim($_POST['facfee']));
$earnleave = 0;
$sickleave = 0;
$casualleave = 0;
if(empty($empname) || empty($uname) || empty($mailid) || empty($doj) || empty($dob))
	{
		$errmsg.="One or more fields are empty...";
	}
else{
if(empty($doj))
	{
		$errmsg.="Date Of Joining is empty ! ";
	}
	if(empty($dob))
	{
		$errmsg.="Date Of Birth is empty ! ";
	}
if(strtotime($doj) > time())
	{
		$errmsg.=" Date Of Joining cannot be a future date..."; 
	}

$sql = "SELECT UserName,EmpEmail FROM employees";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
			if($uname == $row["UserName"])
				{
					$errmsg.=" Username ".$uname." already taken...";
				}
			if($mailid == $row["EmpEmail"])
				{
					$errmsg.=" Your Entered Email ID is already registered with another user...";
				}
		}
	}
if ((!filter_var($mailid, FILTER_VALIDATE_EMAIL)) || empty($mailid)) {
  $errmsg.="Invalid email ID...";
	}
}
$sql2 = "SELECT * FROM admins WHERE Dept = '".$dept."'";
if($conn->query($sql2) == TRUE)
	{
		$result = $conn->query($sql2);
		if($result->num_rows > 0)
			{
				while($row2 = $result->fetch_assoc())
					{
						$earnleave = $row2['SetEarnLeave'];
						$sickleave = $row2['SetSickLeave'];
						$casualleave = $row2['SetCasualLeave'];
					}
			}
	}
if(!empty($errmsg))
	{
	header('location:../ ../register_as_employee.php?err='.htmlspecialchars(urlencode($errmsg)));
	}
else
	{
		echo "<div class = 'reg-form'>";
		$pw = $uname;
		$sql = "INSERT INTO joining_request (UserName,EmpPass,EmpName,Dept,EarnLeave,SickLeave,CasualLeave,EmpEmail,DateOfJoin,Designation,EmpType,EmpFee,DateOfBirth,gender) VALUES "."('".$uname."','".$pw."','".$empname."','".$dept."','".$earnleave."','".$sickleave."','".$casualleave."','".$mailid."','".$doj."','".$designation."','".$emptype."','".$empfee."','".$dob."','".$gender."')";
		if ($conn->query($sql) === TRUE) {
			echo "<center>";
			echo "<strong> Registration Successful !</strong><br/><br/>";
			echo "<u>Registration Details :</u><br/>";
			echo "Username : ".$uname."<br/>";
			echo "Employee Name : ".$empname."<br/>";
			echo "Department : ".$dept."<br/>";
			echo "Email id : ".$mailid."<br/>";
			echo "Date Of Joining : ".$doj."<br/>";
			echo "Designation : ".$designation."<br/>";
			echo "Employment Type : ".$emptype." ; ".$empfee."<br/>";
			echo "Date Of Birth : ".$dob2."<br/>";
			$msg = "Registration Successful! \n\nUsername : ".$uname."\nEmployee Name : ".$empname."\nPassword : ".$pass."\nDepartment : ".$dept."\nEmail ID : ".$mailid."\nDate Of Joining (yyyy/mm/dd): ".$doj."\n\n\nThanks For Registering with us\n\n\n\nRegards,\nwebadmin, Leave Management System";
			$to = $mailid;
			$status = mailer($to,$msg);
			if($status == true)
				{
					echo "<br/>Please check the email ".$mailid." for the confirmation page.<br/>";
				}
			echo "</center>";
			echo "</div>";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
				}

		$dompdf = new Dompdf();
  
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
		<tr bgcolor="#3c4142" style="color:#FFF"><td colspan="3" align="left">Request for Joining GECR'.$empname.'</td></tr>
			</table>
		<table>
		<tr><th>Employee Name : </th><td>'.$empname.'</td></tr>
		<tr><th>Employee Designation : </th><td>'.$designation.'</td></tr>
		<tr><th>Employment Type : </th><td>'.$emptype.'</td></tr>
		<tr><th>Employee Department : </th><td>'.$dept.'</td></tr>
		<tr><th>Type Of Leave : </th><td>'.$emptype.'</td></tr>
		<tr><th>Employee Fee Structure : </th><td>'.$empfee.'</td></tr>
		
		<br><br><br>
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
		$name = "joining_request/".$uname.'_'.$mailid.'.pdf';
		file_put_contents($name,$dompdf->output());
		$conn->close();

	}
// }
// else
// {
// 	header('location:index.php?err='.urlencode('Please Login First To Access This Page !'));
// }


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