<?php 
    include('config/config.php');
	// Lưu ảnh vào thư mục img trên server
	$data= $_POST['data'];
	$detail = array(
		'type'=>$data['type'],
		'ma_nv'=>$data['ma_nv'],
		'ten_nv'=>$data['ten_nv'],
		'diachi'=>$data['diachi'],
		'sdt'=>$data['sdt'],
		'email'=>$data['email'],
		'chuc_vu'=>$data['chuc_vu'],
		'ngaysinh'=>$data['ngaysinh'],
		'gioitinh'=>$data['gioitinh'],
		'ngaybd'=>$data['ngaybd']);
	echo json_encode($detail);	
	
?>