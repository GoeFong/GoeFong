<?php 
    include('config/config.php');
	
	
	if(!empty($_POST['action_type'])){
		$action_type = $conn->real_escape_string($_POST['action_type']);
	//	print_r($action_type);
		switch($action_type){
			case "get_detail_by_name":
				if(!empty($_POST['name'])){
					$name = $conn->real_escape_string($_POST['name']);
					$sql = $conn->query("SELECT * FROM sanpham WHERE barcode = '$name'");
					$numRow = $sql->num_rows;
					if($numRow > 0){
						$row = $sql->fetch_array();
						$detail = array('type'=>'Success','barcode'=>$row['barcode'],'ma_sp'=>$row['ma_sp'],'ten_sp'=>$row['ten_sp'],'gia_mua'=>$row['gia_mua'],'gia_ban'=>$row['gia_ban']);
						echo json_encode($detail);	
					}else{
						$detail = array('type'=>'Error');
						echo json_encode($detail);
					}
					
				}
			break;

			case "add_sp":
				$target_dir = "images/";
				$target_file = $target_dir . basename($_FILES["file"]["name"]);
				move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

				$parma['ma_sp'] = NULL;
				$parma['ten_sp'] = $conn->real_escape_string($_POST['ten_sp']);
				$parma['gia_ban'] = $conn->real_escape_string($_POST['gia_ban']);
				$parma['gia_mua'] = $conn->real_escape_string($_POST['gia_mua']);
				$parma['donvitinh'] = $conn->real_escape_string($_POST['donvitinh']);
				$parma['ma_loaisp'] = $conn->real_escape_string($_POST['ma_loaisp']);
				$parma['ma_nhasx'] = $conn->real_escape_string($_POST['ma_nsx']);
				$parma['ma_nhacc'] = $conn->real_escape_string($_POST['ma_ncc']);
				$parma['hansudung'] = $conn->real_escape_string($_POST['hansudung']);
				$parma['trangthai'] = 1;
				$parma['thoigian_tao'] = $conn->real_escape_string(date('Y-m-d h:i:s'));
				$parma['thoigian_capnhat'] = $conn->real_escape_string(date('Y-m-d h:i:s'));
				$parma['img'] = $conn->real_escape_string($target_file);
				$parma['barcode'] = NULL;
				$sql = sprintf('INSERT INTO sanpham (%s) VALUES ("%s")',implode(',',array_keys($parma)),implode('","',array_values($parma)));
				$conn->query($sql);
				if($conn->insert_id){
					$sql = $conn->query(" SELECT a.*,b.ten_loaisp,c.ten_ncc,d.ten_nsx from sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d  WHERE a.ma_sp =(SELECT MAX(ma_sp) FROM sanpham )");
						$numRow = $sql->num_rows;
						if($numRow > 0){
							$row = $sql->fetch_array();
							$barcode = '89302023' . str_pad($row['ma_sp'], 4, "0", STR_PAD_LEFT);
							$conn->query("UPDATE sanpham SET barcode = '$barcode' where ma_sp ='".$row['ma_sp']."' ");
							$detail = array('ma_sp'=>$row['ma_sp'],'ten_sp'=>$row['ten_sp'],'ten_loaisp'=>$row['ten_loaisp'],'trangthai'=>$row['trangthai'],'gia_ban'=>$row['gia_ban'],'gia_mua'=>$row['gia_mua'],'thoigian_tao'=>$row['thoigian_tao'],'thoigian_capnhat'=>$row['thoigian_capnhat'],'hansudung'=>$row['hansudung']);
							echo json_encode($detail);	
						}else{
							$detail = array('type'=>'Error');
							echo json_encode($detail);
						}
					
				}else{
					echo "Lỗi!!";
				}
			
			case "delete_sp":
				if(!empty($_POST['data'])){
					// $data = $_POST['data'];
					// $masp = $data['ma_sp'];
					$masp = $conn->real_escape_string($_POST['data']);
					$sql = "DELETE FROM sanpham WHERE ma_sp = '$masp'";
					// print_r($sql);
					if($conn->query($sql)){
						echo "Category Has Been Deleted Successfully !";
					}else{
						echo "Something Went Wrong !";
					}
				}
			break;
			case "edit_sp":
				$img="";
				if (isset($_FILES['file'])) {
					$target_dir = "images/";
					$target_file = $target_dir . basename($_FILES["file"]["name"]);
					if (file_exists($target_file)) {
						
						$img= $target_file;
					} else {
						// Upload file
						if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
						
							$img= $target_file;
						} else {
							
						}
					}
				}else{
					$img = $_POST['file'];
				}
				
				$id = $conn->real_escape_string($_POST['ma_sp']);
				$parma['ten_sp'] = $conn->real_escape_string($_POST['ten_sp']);
				$parma['gia_ban'] = $conn->real_escape_string($_POST['gia_ban']);
				$parma['gia_mua'] = $conn->real_escape_string($_POST['gia_mua']);
				$parma['donvitinh'] = $conn->real_escape_string($_POST['donvitinh']);
				$parma['ma_loaisp'] = $conn->real_escape_string($_POST['ma_loaisp']);
				$parma['ma_nhasx'] = $conn->real_escape_string($_POST['ma_nsx']);
				$parma['ma_nhacc'] = $conn->real_escape_string($_POST['ma_ncc']);
				$parma['hansudung'] = $conn->real_escape_string($_POST['hansudung']);
				$parma['trangthai'] = $conn->real_escape_string($_POST['trangthai']);
				$parma['img'] = $conn->real_escape_string($img);
				foreach($parma as $field => $val) {
					$fields[] = "$field = '$val'";
				}
				$query = "UPDATE sanpham SET " . join(', ', $fields) . " WHERE ma_sp = ".$id;
				print_r($query);
				
				if($conn->query($query)){
					$sql = $conn->query(" SELECT a.*,b.ten_loaisp,c.ten_ncc,d.ten_nsx from sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d WHERE a.ma_sp = '$id'");
					$numRow = $sql->num_rows;
					if($numRow > 0){
						$row = $sql->fetch_array();
						$detail = array('ma_sp'=>$row['ma_sp'],'ten_sp'=>$row['ten_sp'],'ten_loaisp'=>$row['ten_loaisp'],'trangthai'=>$row['trangthai'],'gia_ban'=>$row['gia_ban'],'gia_mua'=>$row['gia_mua'],'thoigian_tao'=>$row['thoigian_tao'],'thoigian_capnhat'=>$row['thoigian_capnhat'],'hansudung'=>$row['hansudung']);
						echo json_encode($detail);	
					}else{
						$detail = array('type'=>'Error');
						echo json_encode($detail);
					}
				}else{
					echo "Lỗi !!";
				}
			break;	
		}
	}
?>