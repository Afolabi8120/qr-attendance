<?php
	
	include('core/init.php');

	if(isset($_POST['qrcode'])){

		$name = $globalclass->validateInput($_POST['qrcode']);
		$_SESSION['student'] = $name;

		$date = date("d M Y");
		$time_in = date("g:i A");
		$time_out = date("g:i A");

		if($globalclass->selectByOneColumn('matricno','tbluser',$name)){

			if($attendance->checkAttendance($name,$date) === true){
				if($attendance->updateAttendance($name,$date,$time_out) === true){
					$_SESSION['SuccessMessage'] = "Checkout Successful";
					header('location: take-attendance');
				}else{
					$_SESSION['ErrorMessage'] = "Checkout Not Successful";
					header('location: take-attendance');
				}
			}else if($attendance->checkAttendance($name,$date) === false){
				if($attendance->addAttendance($name,$date,$time_in,"") === true){
					$_SESSION['SuccessMessage'] = "Checkin Successful";
					header('location: take-attendance');
				}else{
					$_SESSION['ErrorMessage'] = "Checkin Not Successful";
					header('location: take-attendance');
				}
			}

		}else if(!$globalclass->selectByOneColumn('matricno','tbluser',$name)){
			$_SESSION['ErrorMessage'] = "Student Record Does Not Exist";
			unset($_SESSION['ErrorMessage']);
			header('location: index.php');
		}		

	}

?>