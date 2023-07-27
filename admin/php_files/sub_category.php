<?php
	include_once "database.php";

    // Add Sub Category
    if( isset($_POST['create']) ){
    	if(!isset($_POST['sub_cat_name']) || empty($_POST['sub_cat_name'])){
    		echo json_encode(array('error'=>'Title Field is Empty.'));
            exit;
    	}elseif(!isset($_POST['parent_cat']) || empty($_POST['parent_cat'])){
            echo json_encode(array('error'=>'Parent Category Field is Empty.'));
            exit;
        }else{
    		$db = new Database();

    		$title = $db->escapeString($_POST['sub_cat_name']);
            $parent_cat = $db->escapeString($_POST['parent_cat']);

    		$db->select('sub_categories','sub_cat_title',null,"sub_cat_title = '{$title}' AND  cat_parent_id = '{$parent_cat}'",null,null);
    		$exist = $db->getResult();
    		if(!empty($exist)){
    			echo json_encode(array('error'=>'This Title Already exist.'));
    		}else{
				$db->insertDB('sub_categories',array('sub_cat_title'=>$title,'cat_parent_id'=>$parent_cat,'sub_cat_status' => '1'));
				$response = $db->getResult();

				if(!empty($response)){
					echo json_encode(array('success'=>$response));
				}
    		}
    	}
    } 

    // Update Sub Category
    if( isset($_POST['update']) ){
    	if(!isset($_POST['sub_cat_id']) || empty($_POST['sub_cat_id'])){
    		echo json_encode(array('error'=>'ID is Empty.')); 
            exit;
    	}elseif(!isset($_POST['sub_cat_name']) || empty($_POST['sub_cat_name'])){
            echo json_encode(array('error'=>'Title Field is Empty.'));
            exit;
        }elseif(!isset($_POST['parent_cat']) || empty($_POST['parent_cat'])){
            echo json_encode(array('error'=>'Parent Category Field is Empty.'));
            exit;
        }else{
    		$db = new Database();

    		$cat_id = $db->escapeString($_POST['sub_cat_id']);
    		$cat_name = $db->escapeString($_POST['sub_cat_name']);
            $parent_cat = $db->escapeString($_POST['parent_cat']);

    		$db->updateDB('sub_categories',array('sub_cat_title'=>$cat_name,'cat_parent_id'=>$parent_cat),"sub_cat_id = '{$cat_id}'");
    		$response = $db->getResult();

    		if($response[0] == 0){
                echo json_encode(array('error'=>'Update Process Failed')); exit;
            } else {
                echo json_encode(array('success'=>$response)); exit;
            }
    	}
    }

    // Delete Sub Category
    if(isset($_POST['delete_id'])){

		$db = new Database();
		$id = $db->escapeString($_POST['delete_id']);
        
        $db->updateDB('sub_categories',array('sub_cat_status' => '0'),"sub_cat_id = '{$id}'");
        $response = $db->getResult();
        if($response[0] == 0){
            echo json_encode(array('error'=>'Delete Process Failed')); exit;
        } else {
            echo json_encode(array('success'=>$response)); exit;
        }		
	}

    // Update Category Status    
    if(isset($_POST['sub_cat_status'])){
        $db = new Database();
        $status = $db->escapeString($_POST['sub_cat_status']);
        $id = $db->escapeString($_POST['sub_cat_id']);

        $db->updateDB('sub_categories',array('sub_cat_status' => $status),"sub_cat_id = '{$id}'");
        $result = $db->getResult();

        if($response[0] == 0){
            echo json_encode(array('error'=>'Status Update Failed')); exit;
        } else {
            echo true; exit;
        }
    }
        

?>  
