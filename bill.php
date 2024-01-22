

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
					<td>#HD<?= $detail['ma_hd'] ?></td>
				</tr>
				<tr>
					<th>Ngày xuất hóa đơn</th>
					<td><?= $detail['thoigian_tao'] ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<th>Thông tin nhân viên</th>
					<th></th>
				</tr>
				<tr>
					<td>Tên khách hàng</td>
					<td><?= $detail['ten_nv'] ?></td>
				</tr>
				<tr>
					<td>Địa chỉ</td>
					<td><?= $detail['diachi'] ?></td>
				</tr>
				<tr>
					<td>Điện thoại</td>
					<td><?= $detail['sdt'] ?></td>
				</tr>
			</table>
			<table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>

                </thead>
                
				
                
			</table>
			<table class="total">
				<tr>
					<td>Tổng tiền</td>
					<td><?= $detail['tongtien']?> đ</td>
				</tr>
				<tr>
					<td>Thành tiền</td>
					<td><?= $detail['tongtien']?> đ</td>
				</tr>
			</table>
		</div>
		<div class="footer">
			<p>Cảm ơn quý khách đã mua hàng tại cửa hàng thực phẩm của chúng tôi!</p>
		</div>
	</div>
</body>
</html>

