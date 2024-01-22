<?php 
    include('config/config.php');
	// Lưu ảnh vào thư mục img trên server
	$data= $_POST['data'];

    $sql2 = $conn->query("SELECT * FROM banhang a, banhang b, sanpham c WHERE a.ma_hd = b.ma_hd AND a.ma_hd = ".$data['ma_hd']." AND b.barcode = c.barcode GROUP BY b.id_bh");
    $numRow = $sql2->num_rows;
    
    if ($numRow > 0) {
        while ($row = $sql2->fetch_assoc()) {
            $table_sp .= '<tr>
                <td class="dongtablehdb">'. $row['ten_sp'].' </td>
                <td class="dongtablehdb">'. $row['gia_ban'].' đ</td>
                <td class="dongtablehdb">'. $row['soluong'].'</td>
                <td class="dongtablehdb">'. $row['gia_ban']*$row['soluong'] .' đ</td>
            </tr>';
        }
    }else{
        $table_sp= '';
        
    }
	$detail = array(
		'type'=>$data['type'],
		'ma_hd'=>$data['ma_hd'],
        'tong_tien'=>$data['tong_tien'],
        'ma_nv'=>$data['ma_nv'],
        'ten_nv'=>$data['ten_nv'],
        'thoigian_tao'=>$data['thoigian_tao'],
        'table_html'=>$table_sp,
    );
	echo json_encode($detail);	
	
?>