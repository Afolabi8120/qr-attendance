<?php

	include('../core/init.php');

	if(isset($_POST['btnAdd']) AND !empty($_POST['btnAdd'])){

		$lecturer_id = $_POST['lecturer_id'];
		$course_id = $_POST['course_id'];
		$level = $_POST['level'];
		$program = $_POST['program'];
		$semester = $_POST['semester'];
		$session = $_POST['session'];

		#var_dump($_POST);exit();

		if(empty($lecturer_id) || empty($course_id) || empty($level) || empty($program) || empty($semester) || empty($session)){
			$_SESSION['ErrorMessage'] = "All Fields are Required";
		}else if(!preg_match("/^[0-9]*$/", $lecturer_id)){
			$_SESSION['ErrorMessage'] = "Invalid Staff ID";
		}else if(!preg_match("/^[a-z A-Z0-9]*$/", $course_id)){
			$_SESSION['ErrorMessage'] = "Invalid Course ID";
		}
		// elseif($user->checkIfCourseExist($lecturer_id,$course_id,$level,$program,$semester,$session) === true){
		// 	$_SESSION['ErrorMessage'] = "Course already assigned to the selected lecturer for the selected course, level, program, semester and session";
		// 	return;
		// }
		else{

			$lecturer_id = $globalclass->validateInput($_POST['lecturer_id']);
			$course_id = $globalclass->validateInput($_POST['course_id']);
			$level = $globalclass->validateInput($_POST['level']);
			$program = $globalclass->validateInput($_POST['program']);
			$semester = $globalclass->validateInput($_POST['semester']);
			$session = $globalclass->validateInput($_POST['session']);

            if($user->assignCourse($lecturer_id,$course_id,$level,$program,$semester,$session) === true){
				$_SESSION['SuccessMessage'] = "Course Assigned Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Assign Course";
			}
            
			
		}	
	}else if(isset($_POST['btnRemoveCourse']) AND !empty($_POST['btnRemoveCourse'])){

			$course_id = $globalclass->validateInput($_POST['course_id']);

			if($globalclass->delete('tblassign_course','id',$course_id)){
				$_SESSION['SuccessMessage'] = "Course Removed Successfully";
			}else{
				$_SESSION['ErrorMessage'] = "Failed To Remove Course";
			}

	}


?>