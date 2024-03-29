<?php

	class GlobalClass {

		protected $pdo;

		function __construct($pdo){
			$this->pdo = $pdo;
		}

		public function validateInput($var){
			$var = htmlspecialchars($var);
			$var = trim($var);
			$var = stripcslashes($var);
			return $var;
		}

		public function delete($table,$column,$value){
			$stmt = $this->pdo->prepare("DELETE FROM `$table` WHERE `$column` = '$value' ORDER BY id");
			$stmt->execute();

			return true;
		}

		public function select($table){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectWhere($table,$column1,$value1){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column1` = '$value1' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function selectNotUser($table,$column1,$value1,$email){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column1` = '$value1' AND email != '$email' ");
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function countByOneColumn($table,$column1,$value1){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column1` = '$value1' ");
			$stmt->execute();
            
            $count = $stmt->rowCount();

        	return $count;
		}

		public function getStudentAttendance($matricno,$course_code,$session,$semester){
        	$stmt = $this->pdo->prepare("SELECT * FROM `tblattendance` WHERE `matricno` = :matricno AND `course_code` = :course_code AND `session` = :session AND `semester` = :semester ");
        	$stmt->bindParam(":matricno", $matricno, PDO::PARAM_STR);
			$stmt->bindParam(":course_code", $course_code, PDO::PARAM_STR);
			$stmt->bindParam(":session", $session, PDO::PARAM_STR);
			$stmt->bindParam(":semester", $semester, PDO::PARAM_STR);
        	$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

		public function count($table){
			$stmt = $this->pdo->prepare("SELECT * FROM `$table` ");
			$stmt->execute();
            
            $count = $stmt->rowCount();

        	return $count;
		}

		public function selectByOneColumn($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = '$value' ");
        	$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
        }

		public function login($email,$password){
			$stmt = $this->pdo->prepare("SELECT * FROM tbluser WHERE email = :email AND password = :password");
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->execute();
            
            $count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
		}

		public function singleCheck($column,$table,$value){
        	$stmt = $this->pdo->prepare("SELECT `$column` FROM `$table` WHERE `$column` = :value");
        	$stmt->bindParam(":value", $value, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

        public function doubleCheck($table,$column,$value,$column2,$value2){
        	$stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE `$column` = :value AND `$column2` = :value2 ");
        	$stmt->bindParam(":value", $value, PDO::PARAM_STR);
        	$stmt->bindParam(":value2", $value2, PDO::PARAM_STR);
        	$stmt->execute();

        	$count = $stmt->rowCount();

        	if($count > 0){
				return true;
			}else{
				return false;
			}
        }

		// Generate QR Code
        public function generateQRCode($text){
        	$path = '../asset/qrcode_img/'; // image path to store the qrcode
        	$file = $path . uniqid() . ".png";

        	// $ecc stores error correction capability('L')
        	$ecc = 'L';
        	$pixel_Size = 3;
        	$frame_Size = 3;

        	// Generate QR Code and Stores it in a directory given
        	QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size);

        	return "<center><img src='".$file."'></center>";
        }

	}

?>