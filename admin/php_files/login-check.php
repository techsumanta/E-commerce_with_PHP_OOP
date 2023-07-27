<?php

include_once "database.php";

if(isset($_POST['login'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])) {
        echo json_encode(array('error'=>'username_empty'));
        exit;
    } else if(!isset($_POST['pass']) || empty($_POST['pass'])) {
        echo json_encode(array('error'=>'password_empty'));
        exit;
    } else {
        
        $db = new Database();
        $userName = $db->escapeString($_POST['name']);
        $password = md5($db->escapeString($_POST['pass']));
        
        $db->select('admin','admin_name',null,"admin_username = '$userName' AND admin_password = '$password'",null,0);
        $result = $db->getResult();        
                
        if(!empty($result)) {
            // start the Session
            session_start();
            // Set the Session Variables
            $_SESSION['admin_name'] = $result[0]['admin_name'];
            $_SESSION['admin_role'] = 'admin';
            echo json_encode(array('success'=>'true'));
            exit;
        } else {
            echo json_encode(array('error'=>'false'));
            exit;
        }

    }

}

if(isset($_POST['changePass'])){
    if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
        echo json_encode(array('error'=>'Old password is empty.')); exit;
    }else if(!isset($_POST['new_pass']) || empty($_POST['old_pass'])){
        echo json_encode(array('error'=>'New password is empty.')); exit;
    }else if($_POST['new_pass'] == $_POST['old_pass']){
        echo json_encode(array('error'=>'Old Password and New Password are Same Enter Another New Password')); exit;
    } else {      

        $db = new Database(); 
        $old = md5($db->escapeString($_POST["old_pass"]));
        $new = md5($db->escapeString($_POST["new_pass"]));        

        $db->updateDB('admin',array('admin_password'=>$new),"admin_password = '{$old}'");
        $response = $db->getResult();
            // echo json_encode(array('error'=>$response));

        if($response[0] == 0){
            echo json_encode(array('error'=>'Old Password not match')); exit;
        } else {
            echo json_encode(array('success'=>$response)); exit;
        }
    }
}

?>