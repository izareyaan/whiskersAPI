<?php
	class Operations{
		private $conn; 

		function __construct(){

			require_once dirname(__FILE__).'/dbConnect.php';
			$db = new Connect();
			$this->conn = $db->connect();

		}

		public function createUser($fname, $lname, $contact, $email, $username, $password){
			if($this->isUserEmailExist($username, $email)){
				return 0;
			}else{
				//$pass = md5($password);
				$stm = $this->conn->prepare("INSERT INTO `user` (`user_id`, `address_id`, `username`, `user_type`, `user_status`, `date_registered`, `first_name`, `last_name`, `contact_number`, `email`, `password`, `profile_pic`) VALUES (NULL, '1', ?, 'Standard', 'Active', CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, '')");
				$stm->bind_param("ssssss", $username, $fname, $lname, $contact, $email, $password);

				if($stm->execute()){
					return 1;
				}else{
					return 2;
				}
			}
		}

		public function loginUser($username, $password){
			//$pass = md5($password);
			$stm = $this->conn->prepare("SELECT * FROM user WHERE username=? and password=?");
			$stm->bind_param("ss", $username, $password);
			$stm->execute();
			$stm->store_result();
			return $stm->num_rows > 0; 
		}

		private function isUserEmailExist($username, $email){
			$stm = $this->conn->prepare('SELECT * FROM user WHERE username=? or email=?');
			$stm->bind_param("ss", $username, $email);
			$stm->execute();
			$stm->store_result(); 
			return $stm->num_rows > 0; 
		}

		public function getUserByUsername($username){
			$stm = $this->conn->prepare("SELECT * FROM `user` WHERE username=?");
			$stm->bind_param("s",$username);
			$stm->execute();
			return $stm->get_result()->fetch_assoc();
		}
	}
?>