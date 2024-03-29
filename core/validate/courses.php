<?php

	include('../core/init.php');

	if(isset($_POST['btnAdd']) AND !empty($_POST['btnAdd'])){

		$course_code = $globalclass->validateInput($_POST['course_code']);
		$title = $globalclass->validateInput($_POST['title']);
		$unit = $globalclass->validateInput($_POST['unit']);

		if(empty($course_code) || empty($title) || empty($unit)){
			$_SESSION['ErrorMessage'] = "All Fields are Required";
		}else if(!preg_match("/^[a-zA-Z 0-9]*$/", $course_code)){
			$_SESSION['ErrorMessage'] = "Enter a Valid Course Code";
		}elseif($user->singleCheck('course_code','tblcourse',$course_code)){
			$_SESSION['ErrorMessage'] = "Course Code Already Exist";
		}else{

			$course_code = strtolower($course_code);
			$title = strtolower($title);
			$unit = $unit;

            if($user->addCourse($course_code,$title,$unit) === true){
				$_SESSION['SuccessMessage'] = "Course Created Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Create Course";
			}
            
			
		}	
	}else if(isset($_POST['btnRemoveCourse']) AND !empty($_POST['btnRemoveCourse'])){

			$course_id = $globalclass->validateInput($_POST['course_id']);

			if($globalclass->delete('tblcourse','id',$course_id)){
				$_SESSION['SuccessMessage'] = "Course Removed Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Remove Course";
			}

	}


?>