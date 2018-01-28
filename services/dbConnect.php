<?php
	class Connect{
		private $conn;
		
		function __construct(){

		}

		public function connect(){
			include_once dirname(__FILE__).'/Constants.php';
			$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			if(mysqli_connect_errno()){
				echo "Failed to connect with database".mysqli_connect_err(); 
			}

			return $this->conn;
		}
	}
?>