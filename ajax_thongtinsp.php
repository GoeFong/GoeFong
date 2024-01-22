<?php 
    include('config/config.php');

    if(!empty($_POST['ma_sp'])){
        $masp = $_POST['ma_sp'];
        // $a = "SELECT a.*,b.ten_loaisp,c.ten_ncc,d.ten_nsx from sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d WHERE ma_sp = '$masp'";
        // print_r($a);
        $sql = $conn->query("SELECT a.*,b.ten_loaisp,c.ten_ncc,d.ten_nsx from sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d WHERE ma_sp = '$masp' GROUP BY ma_sp");
        
        $numRow = $sql->num_rows;
        if($numRow > 0){
            $row = $sql->fetch_array();
            $detail = array('barcode'=>$row['barcode'],'ma_sp'=>$row['ma_sp'],'ten_sp'=>$row['ten_sp'],'ten_loaisp'=>$row['ten_loaisp'],'ma_loaisp'=>$row['ma_loaisp'],'donvitinh'=>$row['donvitinh'],'ten_nsx'=>$row['ten_nsx'],'ma_nhasx'=>$row['ma_nhasx'],'ten_ncc'=>$row['ten_ncc'],'ma_nhacc'=>$row['ma_nhacc'],'trangthai'=>$row['trangthai'],'gia_ban'=>$row['gia_ban'],'gia_mua'=>$row['gia_mua'],'thoigian_tao'=>$row['thoigian_tao'],'thoigian_capnhat'=>$row['thoigian_capnhat'],'hansudung'=>$row['hansudung'],'img'=>$row['img']);
            echo json_encode($detail);	
        }else{
            $detail = array('type'=>'Error');
            echo json_encode($detail);
        }
    }
?>