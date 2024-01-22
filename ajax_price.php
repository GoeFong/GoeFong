<?php 
    include('config/config.php');
    if(!empty($_POST['name'])){
        $name = $conn->real_escape_string($_POST['name']);
        $sql = $conn->query("SELECT * FROM sanpham WHERE barcode = '$name'");
        $numRow = $sql->num_rows;
        if($numRow > 0){
            $row = $sql->fetch_array();
            $detail = array('type'=>'Success','ma_sp'=>$row['ma_sp'],'gia_ban'=>($row['gia_ban']*$_POST['soluong']));
            echo json_encode($detail);	
        }else{
            $detail = array('type'=>'Error');
            echo json_encode($detail);
        }
    }
?>