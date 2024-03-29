<?php

	include('../core/init.php');

	if(isset($_POST['btnRegister']) AND !empty($_POST['btnRegister'])){

		$matricno = $globalclass->validateInput($_POST['matricno']);
		$fullname = $globalclass->validateInput($_POST['fullname']);
		$email = $globalclass->validateInput($_POST['email']);
		$phone = $globalclass->validateInput($_POST['phone']);
		$gender = $globalclass->validateInput($_POST['gender']);
		$level = $globalclass->validateInput($_POST['level']);
		$program = $globalclass->validateInput($_POST['program']);
		$department = $globalclass->validateInput($_POST['department']);
		$faculty = $globalclass->validateInput($_POST['faculty']);
		$password = $globalclass->validateInput($_POST['matricno']);

		if(empty($matricno) || empty($fullname) || empty($email) || empty($phone) || empty($gender) || empty($level) || empty($program) || empty($department) || empty($faculty)){
			$_SESSION['ErrorMessage'] = "All Fields are Required";
		}else if(!preg_match("/^[a-zA-Z0-9]*$/", $matricno)){
			$_SESSION['ErrorMessage'] = "Use a Valid Matric No";
		}else if(!preg_match("/^[a-z A-Z]*$/", $fullname)){
			$_SESSION['ErrorMessage'] = "Use a Valid";
		}else if(!preg_match("/^[0-9]*$/", $phone)){
			$_SESSION['ErrorMessage'] = "Use a Valid Phone Number";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['ErrorMessage'] =  "Email Address is Invalid";
        }elseif($user->checkEmail($email)){
			$_SESSION['ErrorMessage'] = "Email Address Already In Use";
		}else{

			$image_name = $_FILES['stu_image']['name'];

            //specifying the supported file extension
            $validextensions = ['jpg', 'png', 'jpeg'];
            $ext = explode('.', basename($_FILES['stu_image']['name']));

            //explode file name from dot(.)
            $file_extension = end($ext);

            $getImageID = uniqid().time(); #generate a unique id
            $hashImageID = sha1($getImageID); #encrypt the unique id
            $useImageID = substr($hashImageID, 2, 10); #split the unique id

            $image_name = $useImageID.".".$file_extension;
            $target = '../image/' . $image_name;

			$email = strtolower($email);
			$fullname = strtolower($fullname);

			$hash_password = sha1(md5($password));
          	$pass = substr($hash_password, 3, 12);
 			#var_dump($_POST);exit();

 			if(!in_array($file_extension, $validextensions)){ 
                $_SESSION['ErrorMessage'] = "Please select a valid picture format";
                return;
            }else {

            	if($user->register($matricno,$fullname,$email,$phone,$gender,$level,$program,$department,$faculty,$pass,$image_name,'Student','Active') === true){
					$_SESSION['SuccessMessage'] = "Account Has Been Created Successfully";
					move_uploaded_file($_FILES['stu_image']['tmp_name'], $target);
				}else{
					$_SESSION['ErrorMessage'] = "Failed To Create Account";
				}
            }
			
		}	
	}else if(isset($_POST['btnRemoveUser']) AND !empty($_POST['btnRemoveUser'])){

			$user_id = $globalclass->validateInput($_POST['user_id']);
			$user_image = $globalclass->validateInput($_POST['user_image']);

			if($globalclass->delete('tbluser','id',$user_id)){
				unlink("../image/".$user_image);
				$_SESSION['SuccessMessage'] = "User Removed Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Remove User";
			}

	}


?>