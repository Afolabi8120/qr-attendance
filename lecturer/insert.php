<?php
	
	include('../core/init.php');

	if(isset($_POST['qrcode'])){

		$id = $globalclass->validateInput($_POST['course_id']);
		$name = $globalclass->validateInput($_POST['qrcode']);
		$course_code = $globalclass->validateInput($_POST['course_code']);
		$lecturer_id = $globalclass->validateInput($_POST['lecturer_id']);
		$session = $globalclass->validateInput($_POST['session']);
		$semester = $globalclass->validateInput($_POST['semester']);
		$_SESSION['student'] = $name;

		$date = date("d M Y");
		$time_in = date("g:i A");
		$time_out = date("g:i A");

		if($globalclass->selectByOneColumn('matricno','tbluser',$name)){

			if($attendance->checkAttendance($name,$lecturer_id,$course_code,$date) === true){
				$_SESSION['ErrorMessage'] = "Attendance Already Taken";
				header('location: take-attendance?id='.$id);
			}

			if($attendance->checkAttendance($name,$lecturer_id,$course_code,$date) === false){
				if($attendance->addAttendance($name,$lecturer_id,$course_code,$date,$time_in,"",$session,$semester) === true){
					unset($_SESSION['ErrorMessage']);
					$_SESSION['SuccessMessage'] = "Attendance Successfully Taken";
					header('location: take-attendance?id='.$id);
				}else{
					$_SESSION['ErrorMessage'] = "Failed To Take Attendance";
					header('location: take-attendance?id='.$id);
				}
			}

		}else if(!$globalclass->selectByOneColumn('matricno','tbluser',$name)){
			$_SESSION['ErrorMessage'] = "Student Record Does Not Exist";
			header('location: take-attendance?id='.$id);
		}		

	}

?>