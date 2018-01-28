<?php
	require('C:\xampp2\htdocs\whiskersAPI\services\dbOperations.php');

	$response = array(); 

	if($_SERVER['REQUEST_METHOD']=='POST'){

		if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['contact']) && isset($_POST['email'])){
			if(isset($_POST['username']) && isset($_POST['password'])){
				$db = new Operations();
				$result = $db->createUser($_POST['fname'],
											$_POST['lname'],
											$_POST['contact'],
											$_POST['email'],
											$_POST['username'],
											$_POST['password']
										);

				if($result == 1){
					$response['error'] = false; 
					$response['message'] = "User registered successfully";
				}elseif($result == 2){
					$response['error'] = true; 
					$response['message'] = "Some error occurred please try again";			
				}elseif($result == 0) {
					$response['error'] = true; 
					$response['message'] = "It seems you are already registered, please choose a different email and username";	
				}
			}
		}

	}

	echo json_encode($response);
	exit;
?>