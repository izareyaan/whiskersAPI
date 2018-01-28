<?php
	require('C:\xampp2\htdocs\whiskersAPI\services\dbOperations.php');

	$response = array(); 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['username']) and isset($_POST['password'])){
			$db = new Operations(); 

			if($db->loginUser($_POST['username'], $_POST['password'])){
				$user = $db->getUserByUsername($_POST['username']);

				$response['error'] = false; 
				$response['id'] = $user['user_id'];
				$response['fname'] = $user['first_name'];
				$response['lname'] = $user['last_name'];
				$response['email'] = $user['email'];
				$response['contact'] = $user['contact_number'];
				$response['address'] = $user['address_id'];
				$response['username'] = $user['username'];
				$response['message'] = "Login Successfully";
			}else{
				$response['error'] = true; 
				$response['message'] = "Invalid username or password";			
			}

		}else{
			$response['error'] = true; 
			$response['message'] = "Required fields are missing";
		}
	}

	echo json_encode($response);
	exit;
?>