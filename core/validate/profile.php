<?php

	include('./core/init.php');

	if(isset($_POST['btnUpdateProfile']) AND !empty($_POST['btnUpdateProfile'])){

		$surname = $globalclass->validateInput($_POST['surname']);
		$oname = $globalclass->validateInput($_POST['oname']);
		$phone = $globalclass->validateInput($_POST['phone']);
		$gender = $globalclass->validateInput($_POST['gender']);
		$dob = $globalclass->validateInput($_POST['dob']);
		$phone = $globalclass->validateInput($_POST['phone']);
		$address = $globalclass->validateInput($_POST['address']);
		$email = $_SESSION['user'];

		if(empty($surname) || empty($oname) || empty($phone) || empty($gender) || empty($dob) || empty($phone) || empty($address)){
			$_SESSION['ErrorMessage'] = "All Fields are Required";
		}else if(!preg_match("/^[a-z A-Z]*$/", $surname)){
			$_SESSION['SuccessMessage'] = "Use a Valid Surname";
		}else if(!preg_match("/^[a-z A-Z]*$/", $oname)){
			$_SESSION['SuccessMessage'] = "Use a Valid Name for the Other Name field";
		}else if(!preg_match("/^[0-9]*$/", $phone)){
			$_SESSION['SuccessMessage'] = "Use a Valid Phone Number";
		}else{

			$getUserData = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['user']);

			if($user->updateProfile($getUserData->id,$surname,$oname,$email,$phone,$gender,$dob,$address) === true){
				$_SESSION['SuccessMessage'] = "Profile Updated Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Update Profile";
			}
		}

	}else if(isset($_POST['btnChangePassword']) AND !empty($_POST['btnChangePassword'])){

		$password = $globalclass->validateInput($_POST['password']);
		$cpassword = $globalclass->validateInput($_POST['cpassword']);

		if(empty($password) || empty($cpassword)){
			$_SESSION['ErrorMessage'] = "All Password Fields are Required";
		}else if($password != $cpassword){
			$_SESSION['ErrorMessage'] = "Both Password do Not Match";
		}else{

			$hash_password = sha1(md5($password));
            $pass = substr($hash_password, 3, 12);
			$getUserData = $globalclass->selectByOneColumn('email','tbluser',$_SESSION['user']);

			if($user->updatePassword($getUserData->id,$pass) === true){
				$_SESSION['SuccessMessage'] = "Password Changed Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Change Password";
			}

		}

	}


?>