<?php
	include('database/config.php');
	include('classes/GlobalClass.php');
	include('classes/User.php');
	include('classes/Attendance.php');

	global $pdo;

	$globalclass = new GlobalClass($pdo);
	$user = new User($pdo);
	$attendance = new Attendance($pdo);

	session_start();

	function ErrorMessage(){
	    if(isset($_SESSION['ErrorMessage'])){
	        $output = '<div class = "alert alert-danger text-bold" role = "alert">';
	        $output .= htmlentities($_SESSION['ErrorMessage']);
	        $output .= '</div>';
	        $_SESSION['ErrorMessage'] = null;
	        return $output;
	    }

	}

	function SuccessMessage(){
	    if(isset($_SESSION['SuccessMessage'])){
	        $output = '<div class = "alert alert-success text-bold" role = "alert">';
	        $output .= htmlentities($_SESSION['SuccessMessage']);
	        $output .= '</div>';
	        $_SESSION['SuccessMessage'] = null;
	        return $output;
	    }

	}

	date_default_timezone_set("Africa/Lagos");


?>