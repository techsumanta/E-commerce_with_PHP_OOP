<?php
	include_once "database.php";

    if(isset($_POST['create'])){
    	if(!isset($_POST['brand_name']) || empty($_POST['brand_name'])){
    		echo json_encode(array('error'=>'Title Field is Empty.'));
    	}elseif(!isset($_POST['sub_cat']) || empty($_POST['sub_cat'])){
            echo json_encode(array('error'=>'Sub Category Field is Empty.'));
        }else{

    		$db = new Database();

    		$title = $db->escapeString($_POST['brand_name']);
            $sub_cat = $db->escapeString($_POST['sub_cat']);    		

    		$db->select('brand','brand_title',null,"brand_title = '{$title}' AND  brand_subcat_id = '{$sub_cat}'",null,null);
    		$exist = $db->getResult();
    		if(!empty($exist)){
    			echo json_encode(array('error'=>'This Title Already exists.'));
    		}else{
				$db->insertDB('brand',array('brand_title'=>$title,'brand_subcat_id'=>$sub_cat,'brand_status'=>'1'));
				$response = $db->getResult();

				if(!empty($response)){
					echo json_encode(array('success'=>$response));
				}
    		}
    	}
    } 


    if( isset($_POST['update']) ){
    	if(!isset($_POST['brand_id']) || empty($_POST['brand_id'])){
    		echo json_encode(array('error'=>'ID is Empty.')); exit;
    	}elseif(!isset($_POST['brand_name']) || empty($_POST['brand_name'])){
            echo json_encode(array('error'=>'Title Field is Empty.'));
        }elseif(!isset($_POST['brand_sub_cat']) || empty($_POST['brand_sub_cat'])){
            echo json_encode(array('error'=>'Brand Category Field is Empty.'));
        }else{
    		$db = new Database();

    		$brand_id = $db->escapeString($_POST['brand_id']);
    		$brand_name = $db->escapeString($_POST['brand_name']);
            $brand_subcat = $db->escapeString($_POST['brand_sub_cat']);

    		$db->updateDB('brand',array('brand_title'=>$brand_name,'brand_subcat_id'=>$brand_subcat),"brand_id = '{$brand_id}'");
    		$response = $db->getResult();

    		if($response[0] == 0){
				echo json_encode(array('error'=>'Update Process Failed')); exit;
			} else {
				echo json_encode(array('success'=>$response)); exit;
			}
    	}
    }

    if(isset($_POST['delete_id'])){

		$db = new Database();

		$id = $db->escapeString($_POST['delete_id']);
        
		$db->deleteDB('brand',"brand_id ='{$id}'");
		$response = $db->getResult();
		if($response[0] == 0){
            echo json_encode(array('error'=>'Delete Process Failed')); exit;
        } else {
            echo json_encode(array('success'=>$response)); exit;
        }      
		
	} 

?>  
