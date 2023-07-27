<?php
    include_once "database.php";

    // Add Category

    if(isset($_POST['create'])) {
        if(!isset($_POST['cat']) || empty($_POST['cat'])) {
            echo json_encode(array('error' => 'Category field is Empty'));
        } else {
            $db = new Database();
            $category = $db->escapeString($_POST['cat']);
            $db->select('categories','cat_title',null,"cat_title='{$category}'",null,null);
            $exist = $db->getResult();            

            if(!empty($exist)) {
                echo json_encode(array('error' => 'Category Already Exist'));
            } else {
                $db->insertDb('categories', array('cat_title' => $category, 'cat_status' => '1'));
                $response = $db->getResult();
                if(!empty($response)) {
                    echo json_encode(array('success' => $response));
                }
            }
        }
    }

    // Update Category

    if(isset($_POST['update'])) {
        if(!isset($_POST['cat_id']) || empty($_POST['cat_id'])) {
            echo json_encode(array('error' => 'Id is Empty'));
            exit;
        }
        if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])) {
            echo json_encode(array('error' => 'Category field is Empty'));
            exit;
        } else {
            $db = new Database();
            $cat_id = $db->escapeString($_POST['cat_id']);
            $cat_name = $db->escapeString($_POST['cat_name']);

            $db->updateDB('categories',array('cat_title' => $cat_name),"cat_id = '{$cat_id}'");
            $response = $db->getResult();

            if($response[0] == 0){
                echo json_encode(array('error'=>'Update Process Failed')); exit;
            } else {
                echo json_encode(array('success'=>$response)); exit;
            }
        }
    }

    // Delete Category

    if(isset($_POST['delete_id'])) {
        $db = new Database();
        $id = $db->escapeString($_POST['delete_id']);

        $db->updateDB('categories',array('cat_status' => '0'),"cat_id = '{$id}'");
        $response =$db->getResult();

        if($response[0] == 0){
            echo json_encode(array('error'=>'Delete Process Failed')); exit;
        } else {
            echo json_encode(array('success'=>$response)); exit;
        }
    }

    // Update Category Status

    if(isset($_POST['Cat_Status'])){
        $db = new Database();
        $status = $db->escapeString($_POST['Cat_Status']);
        $id = $db->escapeString($_POST['Cat_id']);

        $db->updateDB('categories',array('cat_status' => $status),"cat_id = '{$id}'");
        $result = $db->getResult();

        if($response[0] == 0){
            echo json_encode(array('error'=>'Status Update Failed')); exit;
        } else {
            echo true; exit;
        }
    }


?>