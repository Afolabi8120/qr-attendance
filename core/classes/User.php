<?php

	class User extends GlobalClass {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		public function checkEmail($email){
        	$stmt = $this->pdo->prepare("SELECT email FROM tbluser WHERE email = :email");
        	$stmt->bindParam(":email", $email, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        public function getAttendanceByDate($lecturer_id,$course_code){
        	$stmt = $this->pdo->prepare("SELECT u.id,c.course_code,c.session,c.semester,c._date FROM tbluser AS u INNER JOIN tblattendance AS c ON u.id = c.lecturer_id WHERE c.lecturer_id = '$lecturer_id' AND c.course_code = '$course_code' GROUP BY u.id,c.course_code,c.session,c.semester,c._date ");
        	$stmt->execute();
        	return $stmt->fetchAll();
        }

        public function getAttendance($lecturer_id,$course_code,$semester,$session,$_date){
        	$stmt = $this->pdo->prepare("SELECT * FROM tblattendance WHERE lecturer_id = '$lecturer_id' AND course_code = '$course_code' AND semester = '$semester' AND session = '$session' AND _date = '$_date' ");
        	$stmt->execute();
        	return $stmt->fetchAll();
        }

		public function fetch(){
        	$stmt = $this->pdo->prepare("SELECT u.*,c._date,c.time_in,c.time_out FROM tbluser AS u INNER JOIN tblattendance AS c ON u.matricno = c.matricno");
        	$stmt->execute();
        	return $stmt->fetchAll();
        }

		public function fetchWhere($lecturer_id,$course_code,$date){
        	$stmt = $this->pdo->prepare("SELECT u.*,c.* FROM tbluser AS u INNER JOIN tblattendance AS c ON u.matricno = c.matricno WHERE c.lecturer_id = '$lecturer_id' AND c.course_code = '$course_code' AND c._date = '$date' ");
        	$stmt->execute();
        	return $stmt->fetchAll();
        }

        public function fetchWhereDesc($date){
        	$stmt = $this->pdo->prepare("SELECT u.*,c._date,c.time_in,c.time_out FROM tbluser AS u INNER JOIN tblattendance AS c ON u.matricno = c.matricno WHERE c._date = '$date' ORDER BY id DESC ");
        	$stmt->execute();
        	return $stmt->fetchAll();
        }

        public function register($matricno,$fullname,$email,$phone,$gender,$level,$program,$department,$faculty,$password,$picture,$usertype,$status){
			$stmt = $this->pdo->prepare("INSERT INTO tbluser (matricno,fullname,email,phone,gender,level,program,department,faculty,password,picture,usertype,status) VALUES(:matricno,:fullname,:email,:phone,:gender,:level,:program,:department,:faculty,:password,:picture,:usertype,:status)");
			$stmt->bindParam(":matricno", $matricno, PDO::PARAM_STR);
			$stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":gender", $gender, PDO::PARAM_STR);
			$stmt->bindParam(":level", $level, PDO::PARAM_STR);
			$stmt->bindParam(":program", $program, PDO::PARAM_STR);
			$stmt->bindParam(":department", $department, PDO::PARAM_STR);
			$stmt->bindParam(":faculty", $faculty, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":picture", $picture, PDO::PARAM_STR);
			$stmt->bindParam(":usertype", $usertype, PDO::PARAM_STR);
			$stmt->bindParam(":status", $status, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function updatePassword($id,$password){
			$stmt = $this->pdo->prepare("UPDATE tbluser SET password=:password WHERE id=:id");
			$stmt->bindParam(":id", $id, PDO::PARAM_INT);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function addCourse($course_code,$course_title,$unit){
			$stmt = $this->pdo->prepare("INSERT INTO tblcourse (course_code,course_title,unit) VALUES(:course_code,:course_title,:unit)");
			$stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
			$stmt->bindParam(":course_title", $course_title, PDO::PARAM_STR);
			$stmt->bindParam(":unit", $unit, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function assignCourse($lecturer_id,$course_id,$level,$program,$semester,$session){
			$stmt = $this->pdo->prepare("INSERT INTO tblassign_course (lecturer_id,course_code,level,program,semester,session) VALUES(:lecturer_id,:course_id,:level,:program,:semester,:session)");
			$stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_STR);
			$stmt->bindParam(":course_id", $course_id, PDO::PARAM_STR);
			$stmt->bindParam(":level", $level, PDO::PARAM_STR);
			$stmt->bindParam(":program", $program, PDO::PARAM_STR);
			$stmt->bindParam(":semester", $semester, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function checkIfCourseExist($lecturer_id,$course_code,$level,$program,$semester,$session){
        	$stmt = $this->pdo->prepare("SELECT * FROM tblassign_course WHERE lecturer_id = :lecturer_id AND course_code=:course_code AND level=:level AND program=:program AND semester=:semester AND session=:session");
        	$stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_STR);
        	$stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
        	$stmt->bindParam(":level", $level, PDO::PARAM_STR);
        	$stmt->bindParam(":program", $program, PDO::PARAM_STR);
        	$stmt->bindParam(":semester", $semester, PDO::PARAM_STR);
        	$stmt->bindParam(":session", $session, PDO::PARAM_STR);
        	$stmt->execute();

        	return true;
        }

	}

?>