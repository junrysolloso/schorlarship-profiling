<?php
	require 'config.php';
	class db_class extends db_connect{		
		public function __construct(){
			$this->connect();
		}		
		public function create($OtherCourse, $Description){
			$stmt = $this->conn->prepare("INSERT INTO `course_info` (`Course`, `Description`) VALUES (?, ?)") or die($this->conn->error);
			$stmt->bind_param("ss", $OtherCourse, $Description);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
 	}	
?>