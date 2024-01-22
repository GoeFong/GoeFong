	<?php 
		require_once 'head.php';
		include('config/config.php');
		if(empty($_SESSION['user']) OR $_SESSION['user'] != 'admin'){
			header("Location:login.php");
		}
		print_r($_SESSION);
	?>
	<body>
		<?php 
			require_once 'header-sidebar.php';
		?>



		<!-- <div class="mobile-menu-overlay"></div> -->

		<div class="main-container">
			<div class="pd-ltr-20">
				<div class="card-box pd-20 height-100-p mb-30">
					<div class="row align-items-center">
						<div class="col-md-4">
						<img src="images/banner-img.jpg" alt="" />
						</div>
						<div class="col-md-8">
							<h4 class="font-20 weight-500 mb-10 text-capitalize">
								Hệ thống quản lý cửa hàng thực phẩm
								<div class="weight-600 font-30 text-blue">Wellcome</div>
							</h4>
							<p class="font-18 max-width-600">
								Cửa hàng thực phẩm là nơi cung cấp các loại thực phẩm cho người tiêu dùng. Các cửa hàng thực phẩm có thể bán các loại thực phẩm tươi sống, đông lạnh, đồ khô và các loại đồ uống khác nhau. Các cửa hàng thực phẩm cũng có thể bán các sản phẩm chế biến sẵn như bánh mì, bánh ngọt và các món ăn khác.
							</p>
						</div>
					</div>
				</div>
				<div class="title pb-20">
					<h2 class="h3 mb-0">Tổng quan cửa hàng</h2>
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<?php 
										$sql = $conn->query("SELECT COUNT(*) as tonghdt FROM hoadonban WHERE thoigian_tao BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW();");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>		
									<div class="weight-700 font-24 text-dark"><?= $row['tonghdt']?></div>
									<?php	}else{
									
										}
									?>
									
									<div class="font-14 text-secondary weight-500">
										Tổng hóa đơn tuần
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy dw dw-calendar1"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">

									<?php 
										$sql = $conn->query("SELECT COUNT(*) as tongthv FROM user;");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>	
									<div class="weight-700 font-24 text-dark"><?= $row['tongthv']?></div>

									<?php	}else{
											
										}
									?>
									<div class="font-14 text-secondary weight-500">
										Tổng thành viên
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<span class="icon-copy ti-heart"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">

									<?php 
										$sql = $conn->query("SELECT COUNT(*) as tongusr FROM user where chuc_vu = 'user';");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>	
									<div class="weight-700 font-24 text-dark"><?= $row['tongusr'] ?></div>

									<?php	}else{
											
										}
									?>
									<div class="font-14 text-secondary weight-500">
										Tổng nhân viên
									</div>

								</div>
								<div class="widget-icon">
									<div class="icon">
										<i
											class="icon-copy dw dw-user1"
											aria-hidden="true"
										></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<?php 
										$sql = $conn->query("SELECT SUM(tong_tien) as doanhthu FROM hoadonban");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
										$doanhthu = number_format( $row['doanhthu'], 0, ',', '.') . ' đ';
									?>	
									<div class="weight-700 font-24 text-dark"><?= $doanhthu?></div>
									<?php	}else{
											
										}
									?>

									<div class="font-14 text-secondary weight-500">Doanh thu</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy fa fa-money" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		
				<div class="row">
					<div class="col-md-8 mb-20">
						<div class="card-box height-100-p pd-20">
							<div
								class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3"
							>
								<div class="h5 mb-md-0">Tình trạng hoạt động cửa hàng</div>
								<div class="form-group mb-md-0">
									<select class="form-control form-control-sm selectpicker">
										<option value="">1 tuần trước</option>
										<option value="">1 tháng trước</option>
										<option value="">6 tháng trước</option>
										<option value="">1 năm trước</option>
									</select>
								</div>
							</div>
							<div id="activities-chart"></div>
						</div>
					</div>
					<div class="col-md-4 mb-20">
						<div
							class="card-box min-height-200px pd-20 mb-20"
							data-bgcolor="#455a64"
						>
							<div class="d-flex justify-content-between pb-20 text-white">
								<div class="icon h1 text-white">
									<i class="fa fa-calendar" aria-hidden="true"></i>
									<!-- <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i> -->
								</div>
								<div class="font-14 text-right">
									<?php 
										$sql = $conn->query("SELECT 
										CONCAT(
										  ROUND(
											(tong_thang_nay - tong_thang_truoc) / tong_thang_truoc * 100, 
											2
										  ), 
										  '%'
										) AS kq 
									  FROM (
										SELECT 
										  SUM(IF(MONTH(thoigian_tao) = MONTH(NOW()), 1, 0)) AS tong_thang_nay,
										  SUM(IF(YEAR(thoigian_tao) = YEAR(NOW()) AND MONTH(thoigian_tao) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)), 1, 0)) AS tong_thang_truoc
										FROM hoadonban
									  ) AS temp;");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>	
									<div><i class="icon-copy ion-arrow-up-c"></i><?= $row['kq']?></div>
									<?php	}else{
											
										}
									?>
									<div class="font-12">Trong tháng vừa rồi</div>
								</div>
							</div>
							<div class="d-flex justify-content-between align-items-end">
								<div class="text-white">
									<?php 
										$sql = $conn->query("SELECT COUNT(*) as tonghd FROM hoadonban");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>	
									<div class="font-14">Tổng đơn bán</div>
									<div class="font-24 weight-500"><?= $row['tonghd']?></div>
									<?php	}else{
											
										}
									?>
								</div>
								<div class="max-width-150">
									<div id="appointment-chart"></div>
								</div>
							</div>
						</div>
						<div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
							<div class="d-flex justify-content-between pb-20 text-white">
								<div class="icon h1 text-white">
									<i  class="ti-heart" aria-hidden="true"></i>
								</div>
								<div class="font-14 text-right">

									<?php 
										$sql = $conn->query("SELECT 
										CONCAT(
										  ROUND(
											(tong_thang_nay / tong_nv) * 100, 
											2
										  ), 
										  '%'
										) AS phan_tram 
									  FROM (
										SELECT 
										  SUM(IF(MONTH(ngaybd) = MONTH(NOW()), 1, 0)) AS tong_thang_nay,
										  COUNT(*) AS tong_nv
										FROM user
									  ) AS temp;");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>	
									<div><i class="icon-copy ion-arrow-down-c"></i> <?= $row['phan_tram']?></div>

									<?php	}else{
											
										}
									?>
									<div class="font-12">Trong tháng vừa rồi</div>
								</div>
							</div>
							<div class="d-flex justify-content-between align-items-end">
								<div class="text-white">
									<?php 
										$sql = $conn->query("SELECT COUNT(*) as tongnv FROM user WHERE ngaybd BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW();");
										$numRow = $sql->num_rows;
										if($numRow > 0){
										$row = $sql->fetch_array();
									?>	
									<div class="font-14">Thành viên mới</div>
									<div class="font-24 weight-500"><?= $row['tongnv']?></div>
									<?php	}else{
											
										}
									?>
								</div>
								<div class="max-width-150">
									<div id="surgery-chart"></div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-8 mb-30">
						<div class="card-box height-100-p pd-20">
							<h2 class="h4 mb-20">Thống kê thành viên</h2>
							<div id="chart5"></div>
						</div>
					</div>
					<div class="col-xl-4 mb-30">
						<div class="card-box height-100-p pd-20">
							<h2 class="h4 mb-20">Chỉ tiêu của tháng</h2>
							<div id="chart6"></div>
						</div>
					</div>
				</div>
				<div class="card-box mb-30">
					<h2 class="h4 pd-20">Sản phẩm bán chạy nhất</h2>
					<table class="data-table table nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">Sản phẩm</th>
								<th>Tên sản phẩm</th>
								<th>Loại sản phẩm</th>
								<th>Đơn vị tính</th>
								<th>Giá bán</th>
								<th>Số lượng đã bán</th>
								<th class="datatable-nosort">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="table-plus">
									<img
										src="images/36.png"
										width="70"
										height="70"
										alt=""
									/>
								</td>
								<td>
									<h5 class="font-16">Dâu tây</h5>
									
								</td>
								<td>Trái cây tươi</td>
								<td>Kg</td>
								<td>76.000 VND</td>
								<td>10</td>
								<td>
									<div class="dropdown">
										<a
											class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
											href="#"
											role="button"
											data-toggle="dropdown"
										>
											<i class="dw dw-more"></i>
										</a>
										<div
											class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
										>
											<a class="dropdown-item" href="#"
												><i class="dw dw-eye"></i> View</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-edit2"></i> Edit</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-delete-3"></i> Delete</a
											>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="table-plus">
									<img
										src="images/34.png"
										width="70"
										height="70"
										alt=""
									/>
								</td>
								<td>
									<h5 class="font-16">Dưa lưới</h5>
									
								</td>
								<td>Trái cây tươi</td>
								<td>Kg</td>
								<td>32.000 VND</td>
								<td>3</td>
								<td>
									<div class="dropdown">
										<a
											class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
											href="#"
											role="button"
											data-toggle="dropdown"
										>
											<i class="dw dw-more"></i>
										</a>
										<div
											class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
										>
											<a class="dropdown-item" href="#"
												><i class="dw dw-eye"></i> View</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-edit2"></i> Edit</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-delete-3"></i> Delete</a
											>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="table-plus">
									<img
										src="images/11.png"
										width="70"
										height="70"
										alt=""
									/>
								</td>
								<td>
									<h5 class="font-16">Táo da đỏ</h5>

								</td>
								<td>Trái cây tươi</td>
								<td>Kg</td>
								<td>34.000 VND</td>
								<td>4</td>
								<td>
									<div class="dropdown">
										<a
											class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
											href="#"
											role="button"
											data-toggle="dropdown"
										>
											<i class="dw dw-more"></i>
										</a>
										<div
											class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
										>
											<a class="dropdown-item" href="#"
												><i class="dw dw-eye"></i> View</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-edit2"></i> Edit</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-delete-3"></i> Delete</a
											>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="table-plus">
									<img
										src="images/86.png"
										width="70"
										height="70"
										alt=""
									/>
								</td>
								<td>
									<h5 class="font-16">Nho khô</h5>
									
								</td>
								<td>Thực phẩm khô</td>
								<td>Kg</td>
								<td>47.900 VND</td>
								<td>3</td>
								<td>
									<div class="dropdown">
										<a
											class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
											href="#"
											role="button"
											data-toggle="dropdown"
										>
											<i class="dw dw-more"></i>
										</a>
										<div
											class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
										>
											<a class="dropdown-item" href="#"
												><i class="dw dw-eye"></i> View</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-edit2"></i> Edit</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-delete-3"></i> Delete</a
											>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="table-plus">
									<img
										src="images/33.png"
										width="70"
										height="70"
										alt=""
									/>
								</td>
								<td>
									<h5 class="font-16">Hành tây</h5>
									
								</td>
								<td>Thực phẩm khô</td>
								<td>Túi</td>
								<td>69.000 VND</td>
								<td>3</td>
								<td>
									<div class="dropdown">
										<a
											class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
											href="#"
											role="button"
											data-toggle="dropdown"
										>
											<i class="dw dw-more"></i>
										</a>
										<div
											class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
										>
											<a class="dropdown-item" href="#"
												><i class="dw dw-eye"></i> View</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-edit2"></i> Edit</a
											>
											<a class="dropdown-item" href="#"
												><i class="dw dw-delete-3"></i> Delete</a
											>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					2022
				</div>
			</div>
		</div>
		<!-- welcome modal start -->
		
		<!-- welcome modal end -->
		<!-- js -->
		<script src="scripts/core.js"></script>
		<script src="scripts/script.min.js"></script>
		<script src="scripts/process.js"></script>
		<script src="scripts/layout-settings.js"></script>
		<script src="plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="plugins/apexcharts/apexcharts.min.js"></script>
		<script src="scripts/dashboard.js"></script>
		<script src="scripts/dashboard3.js"></script>
		
		<!-- Google Tag Manager (noscript) -->
		
		<!-- End Google Tag Manager (noscript) -->
	</body>

