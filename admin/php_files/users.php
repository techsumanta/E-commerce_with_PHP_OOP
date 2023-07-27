<?php
	include_once "database.php";
	
	// View User Details
	if(isset($_POST['user_view'])){
		$db = new Database();

		$id = $db->escapeString($_POST['user_view']);

		$db->select('user','user_first_name,user_last_name,user_username,user_email,user_status',null,"user_id = '{$id}'",null,null);
		$result = $db->getResult();
		echo json_encode($result); exit;
	}

	// Update User Status
	if(isset($_POST['status_id'])){
		$id = $_POST['user_id'];
		$status_id = $_POST['status_id'];

		$db = new Database();
		if($status_id == '1'){
			$db->updateDB('user',array('user_status'=>'0'),"user_id = '{$id}'");
		}else{
			$db->updateDB('user',array('user_status'=>'1'),"user_id = '{$id}'");
		}
		$response = $db->getResult();
		if(!empty($response)){
			echo json_encode(array('sucess'=>'success'));
		}

	}

	// Delete User
	if(isset($_POST['delete_id'])){

		$db = new Database();

		$id = $db->escapeString($_POST['delete_id']);
        // $db->deleteDB('user',"user_id ='{$id}'");
        $response = $db->getResult();
        if(!empty($response)){
            echo json_encode(array('success'=>$response)); exit;
        }

		
	} 


?>