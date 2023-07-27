<?php
	include_once "../config.php";
	
	// User Registration
	if(isset($_POST['create'])){
		if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
			echo json_encode(array('error'=>'First Name Field Empty.')); exit;
		}else if(!isset($_POST['l_name']) || empty($_POST['l_name'])){
			echo json_encode(array('error'=>'Last Name Field Empty.')); exit;
		}else if(!isset($_POST['username']) || empty($_POST['username'])){
			echo json_encode(array('error'=>'Username Field Empty.')); exit;
		}else if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
		  	echo json_encode(array('error'=>'Please Enter Correct Email Address.')); exit;
		}else if(!isset($_POST['password']) || empty($_POST['password'])){
			echo json_encode(array('error'=>'Password Field Empty.')); exit;
		}else{
			$db = new Database();

			$params = [
				'user_first_name' => $db->escapeString($_POST['f_name']),
				'user_last_name' => $db->escapeString($_POST['l_name']),
				'user_username' => $db->escapeString($_POST['username']),
				'user_password' => md5($db->escapeString($_POST['password'])),
				'user_status' => '1'
			];

			$db->select('user','user_username',null,"user_username = '{$params["user_username"]}'",null,null);
			$exist = $db->getResult();
			if(!empty($exist)){
				echo json_encode(array('error'=>'Username Already Exists.')); exit;
			}else{
				$db->insertDB('user',$params);
				$response = $db->getResult();
				// var_dump($response);exit;
				if(is_numeric($response[0])){
					session_start();
					$_SESSION["user_id"] = $response[0]; /* userid of the user */
	            	$_SESSION["username"] = $params['user_first_name'];
	            	$_SESSION["user_role"] = 'user'; /* for user */
					echo json_encode(array('success'=>'Registered Successfully')); exit;
				}else{
					echo json_encode(array('error'=>$response)); exit;
				}
			}
		}
	}

	// User Login
	if(isset($_POST['login'])){
		if(!isset($_POST['username']) || empty($_POST['username'])){
			echo json_encode(array('error'=>'Username Foeld is Empty.')); exit;
		}elseif(!isset($_POST['password']) || empty($_POST['password'])){
			echo json_encode(array('error'=>'Passowrd Foeld is Empty.')); exit;
		}else{
			$db = new Database();

			$username = $db->escapeString($_POST['username']);
			$password = md5($db->escapeString($_POST['password']));			

			$db->select('user','user_id,user_username,user_first_name',null,"user_username = '{$username}' AND user_password = '{$password}'",null,null);
			$response = $db->getResult();
						
			if(!empty($response)){
				if(count($response[0]) > 1){
					/* Start the session */
		            session_start();
		            /* Set session variables */
		            foreach($response as $row){
		            	$_SESSION["user_id"] = $row['user_id']; /* userid of the user */
		            	$_SESSION["username"] = $row['user_first_name'];
		            	$_SESSION["user_role"] = 'user'; /* for user */
		            }
		            
		            echo json_encode(array('success'=>'Logged In Successfully.')); exit;
				}else{
					echo json_encode(array('error'=>'Username and Password not matched.')); exit;
				}
			}else{
				echo json_encode(array('error'=>'Username and Password not matched.')); exit;
			}
		}
	}

	// User Logout
	if(isset($_POST['user_logout'])){
	    /* Start the session */
	    session_start();
	    /* remove all session variables */
	    session_unset();
	    /* destroy the session */
	    session_destroy();

	    echo 'true'; exit;
	}

	// User Profile Update
	if(isset($_POST['update'])){
		if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
			echo json_encode(array('error'=>'First Name Field Empty.')); exit;
		}else if(!isset($_POST['l_name']) || empty($_POST['l_name'])){
			echo json_encode(array('error'=>'Last Name Field Empty.')); exit;
		}else{
			$db = new Database();

			$params = [
				'user_first_name' => $db->escapeString($_POST['f_name']),
				'user_last_name' => $db->escapeString($_POST['l_name'])				
			];


			if(!session_id()){
				session_start();
			}
			$user_id = $_SESSION['user_id'];
			$db->updateDB('user',$params,"user_id = '{$user_id}'");
			$response = $db->getResult();			
			if(!empty($response)){
				echo json_encode(array('success'=>$response)); exit;
			}
			
		}
	}

	// User Change Password
	if(isset($_POST['modifyPass'])){
		// echo '1'; exit;
		if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
			echo json_encode(array('error'=>'Old Passowrd field Empty')); exit;
		}elseif(!isset($_POST['new_pass']) || empty($_POST['new_pass'])){
			echo json_encode(array('error'=>'New Passowrd field Empty')); exit;
		}else{
			$db = new Database();

			$old = md5($db->escapeString($_POST['old_pass']));
			$new = md5($db->escapeString($_POST['new_pass']));

			if(!session_id()){ session_start(); }

			$user_id = $_SESSION['user_id'];

			$db->select('user','user_id',null,"user_id = '{$user_id}' AND user_password = '{$old}'",null,null);
			$exist = $db->getResult();

			if(!empty($exist)){
				$response = $db->updateDB('user',array('user_password'=>$new),"user_id = '{$user_id}' AND user_password = '{$old}'");
				if(!empty($response)){
					echo json_encode(array('success'=>'success')); exit;
				}else{
					echo json_encode(array('error'=>'Password not changed.')); exit;
				}

			}else{
				echo json_encode(array('error'=>'Old Password is not matched.')); exit;
			}
		}
	}


?>