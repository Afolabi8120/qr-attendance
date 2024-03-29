<?php

	class Attendance extends GlobalClass {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

        public function addAttendance($matricno,$lecturer_id,$course_code,$_date,$time_in,$time_out,$session,$semester){
			$stmt = $this->pdo->prepare("INSERT INTO tblattendance (matricno,lecturer_id,course_code,_date,time_in,time_out,session,semester) VALUES(:matricno,:lecturer_id,:course_code,:_date,:time_in,:time_out,:session,:semester)");
			$stmt->bindParam(":matricno", $matricno, PDO::PARAM_STR);
			$stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_STR);
			$stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
			$stmt->bindParam(":_date", $_date, PDO::PARAM_STR);
			$stmt->bindParam(":time_in", $time_in, PDO::PARAM_STR);
			$stmt->bindParam(":time_out", $time_out, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->bindParam(":semester", $semester, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

		public function checkAttendance($matricno,$lecturer_id,$course_code,$date){
			$stmt = $this->pdo->prepare("SELECT * FROM tblattendance WHERE matricno = :matricno AND lecturer_id=:lecturer_id AND course_code=:course_code AND  _date = '$date' AND time_in != '' ");
			$stmt->bindParam(":matricno", $matricno, PDO::PARAM_STR);
			$stmt->bindParam(":lecturer_id", $lecturer_id, PDO::PARAM_STR);
			$stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
			#$stmt->bindParam(":date", $date, PDO::PARAM_STR);
			$stmt->execute();
            
            $count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
		}

		public function updateAttendance($matricno,$date,$time_out){
			$stmt = $this->pdo->prepare("UPDATE tblattendance SET time_out = :time_out WHERE matricno = :matricno AND _date = :date ");
			$stmt->bindParam(":matricno", $matricno, PDO::PARAM_STR);
			$stmt->bindParam(":date", $date, PDO::PARAM_STR);
			$stmt->bindParam(":time_out", $time_out, PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}

	}

?>