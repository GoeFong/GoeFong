<?php
    include('config/config.php');
    if(isset($_POST['action']) && !empty($_POST['action'])){
        $action = $_POST['action'];
        switch($action){
            case 'print':
                $sql = $conn->query(" SELECT * from hoadonban WHERE ma_hd =(SELECT MAX(ma_hd) FROM hoadonban )");
                $numRow1 = $sql->num_rows;
                if($numRow1 > 0){
                    $row = $sql->fetch_array();
                    $num = $row['ma_hd'];
                }else{
                    $num=0;
                   
                }
                $sql = $conn->query("SELECT * from hoadonban a, user b where ma_hd=".$num." AND b.ma_nv = a.ma_nv ");
                $numRow = $sql->num_rows;
                if($numRow > 0){
                    $row = $sql->fetch_array();
                    $detail = array(
                        'ma_hd'=>$row['ma_hd'],
                        'tong_tien'=>$row['tong_tien'],
                        'ma_nv'=>$row['ma_nv'],
                        'thoigian_tao'=>$row['thoigian_tao'],
                        'ten_nv'=>$row['ten_nv'],
                        'sdt'=>$row['sdt'],
                        'diachi'=>$row['diachi'],
                    );
                    
                }else{
                    $detail = array('type'=>'Error');
                   
                }

                $sql = $conn->query("SELECT * from banhang a, banhang b , sanpham c WHERE a.ma_hd= b.ma_hd =".$num." AND b.barcode = c.barcode GROUP BY b.id_bh");
                $numRow = $sql->num_rows;
                if($numRow > 0){
                    $row = $sql->fetch_array();
                    $detail_sp = array(
                        'id_bh'=>$row['id_bh'],
                        'ten_sp'=>$row['ten_sp'],
                        'ma_nv'=>$row['ma_nv'],
                        'soluong'=>$row['soluong'],
                        'gia_ban'=>$row['gia_ban'],
                    );
                    
                }else{
                    $detail_sp = array('type'=>'Error');
                   
                }
                $table_sp= '';
                $sql1 = $conn->query("SELECT * FROM hoadonban WHERE ma_hd = (SELECT MAX(ma_hd) FROM hoadonban)");
                $numRow1 = $sql1->num_rows;
                if($numRow1 > 0){
                    $row = $sql1->fetch_array();
                    $num = $row['ma_hd'];
                }else{
                    $num=0;
                   
                }
                $sql2 = $conn->query("SELECT * FROM banhang a, banhang b, sanpham c WHERE a.ma_hd = b.ma_hd AND a.ma_hd = ".$num." AND b.barcode = c.barcode GROUP BY b.id_bh");
                $numRow = $sql2->num_rows;
                
                if ($numRow > 0) {
                    while ($row = $sql2->fetch_assoc()) {
                        $table_sp .= '<tr>
                            <td>'. $row['ten_sp'].' </td>
                            <td>'. $row['gia_ban'].' đ</td>
                            <td>'. $row['soluong'].'</td>
                            <td>'. $row['gia_ban']*$row['soluong'] .' đ</td>
                        </tr>';
                    }
                }else{
                    $table_sp= '';
                   
                }

                $html ='

                <!DOCTYPE html>
                <html>
                <head>
                    <title>Hóa đơn bán hàng</title>
                    <style type="text/css">
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                        }
                        .container {
                            margin: 0 auto;
                            max-width: 800px;
                            padding: 20px;
                        }
                        h1 {
                            margin-top: 0;
                            text-align: center;
                        }
                        .invoice {
                            border: 1px solid #ccc;
                            margin-top: 30px;
                            padding: 20px;
                        }
                        .invoice h2 {
                            margin-top: 0;
                            margin-bottom: 20px;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            padding: 10px;
                            text-align: left;
                            border-bottom: 1px solid #ccc;
                        }
                        th {
                            background-color: #f2f2f2;
                            font-weight: normal;
                        }
                        .total {
                            text-align: right;
                        }
                        .total td:first-child {
                            font-weight: bold;
                        }
                        .footer {
                            text-align: center;
                            margin-top: 50px;
                            padding: 20px;
                            background-color: #f2f2f2;
                        }
                        .footer p {
                            margin: 0;
                            font-size: 14px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>HÓA ĐƠN BÁN HÀNG</h1>
                        <div class="invoice">
                            <h2>Thông tin hóa đơn</h2>
                            <table>
                                <tr>
                                    <th>Mã hóa đơn</th>
                                    <td>#HD' .$detail['ma_hd']. '</td>
                                </tr>
                                <tr>
                                    <th>Ngày xuất hóa đơn</th>
                                    <td>'.$detail['thoigian_tao'].'</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th>Thông tin nhân viên</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>Tên khách hàng</td>
                                    <td>'. $detail['ten_nv'] .'</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>'. $detail['diachi'] .'</td>
                                </tr>
                                <tr>
                                    <td>Điện thoại</td>
                                    <td>'. $detail['sdt'] .'</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                '.$table_sp.'  
                            </table>
                            <table class="total">
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td>'. $detail['tong_tien'].' đ</td>
                                </tr>
                                <tr>
                                    <td>Thành tiền</td>
                                    <td>'. $detail['tong_tien'].' đ</td>
                                </tr>
                            </table>
                        </div>
                        <div class="footer">
                            <p>Cảm ơn quý khách đã mua hàng tại cửa hàng thực phẩm của chúng tôi!</p>
                        </div>
                    </div>
                </body>
                </html>
                
                ';
                print_r($html);
                
                break;

                
            case 'add':
                $parma1['ma_hd'] = NULL; 
                $parma1['tong_tien'] = $conn->real_escape_string($_POST['tongtien']);
                $parma1['ma_nv'] = $conn->real_escape_string($_POST['id_nv']);
                $parma1['thoigian_tao'] = $conn->real_escape_string(date('Y-m-d h:i:s'));
                $sql = sprintf('INSERT INTO hoadonban (%s) VALUES ("%s")',implode(',',array_keys($parma1)),implode('","',array_values($parma1)));
                $conn->query($sql);
                print_r($sql);
                $sql = $conn->query(" SELECT * from hoadonban WHERE ma_hd =(SELECT MAX(ma_hd) FROM hoadonban )");
                $numRow = $sql->num_rows;
                if($numRow > 0){
                    $row = $sql->fetch_array();
                    $num = $row['ma_hd'];
                }else{
                    $num=0;
                   
                }
                $products = $_POST['product'];
                foreach($products as $product) {
                    $parma['id_bh'] = NULL; 
                    $parma['barcode'] = $conn->real_escape_string($product['barCode']);
                    $parma['soluong'] = $conn->real_escape_string($product['quantity']);
                    $parma['ma_hd'] = $conn->real_escape_string($num);
                    $sql = sprintf('INSERT INTO banhang (%s) VALUES ("%s")',implode(',',array_keys($parma)),implode('","',array_values($parma)));
                    $conn->query($sql);
                    print_r($sql);   
                 // xử lý thông tin sản phẩm ở đây
                }

           
        }
    }
    
    // $parma['id_bh'] = NULL; 
    // $parma['ma_sp'] = $conn->real_escape_string($value);
    // $parma['soluong'] = $conn->real_escape_string($_POST['soluong']);
// print_r($_POST);
?>
