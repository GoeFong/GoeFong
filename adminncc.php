<?php
	include('config/config.php');
	if(empty($_SESSION['user']) OR $_SESSION['user'] != 'admin'){
		header("Location:login.php");
	}
	//$prd = $conn->select('ten_ncc ,ten_nsx, ten_loaisp', 'sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d','a.ma_loaisp=b.ma_loaisp and a.ma_nhacc=c.ma_ncc and a.ma_nhasx=d.ma_nsx');
	$sql = $conn->query("SELECT * FROM nhacungcap ");
	$numRow = $sql->num_rows;

?>
<?php 
	require_once 'head.php';
?>
<body>
	<?php 
		require_once 'header-sidebar.php';
	?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			
			<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Nhà cung cấp</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="admindashboard.php">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Nhà cung cấp
									</li>
								</ol>
							</nav>
						</div>
						
						
					</div>
					<div class="row">
						
					</div>
					<div class="collapse collapse-box" id="basic-form1">
						<div class="add-box">
							
							
							<div class="pd-20 card-box mb-30">
								<form>
									<div class="form-group">
										<label>Tên nhà cung cấp</label>
										<input
											class="form-control"
											type="text"
											placeholder="Tên nhà cung cấp"
										/>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input
											class="form-control"
											placeholder="abc@gmail.com"
											type="email"
										/>
									</div>
									<div class="form-group">
										<label>Số điện thoại</label>
										<input
											class="form-control"
											placeholder="(+84)...."
											type="text"
										/>
									</div>
									<div class="form-group">
										<label>Địa chỉ</label>
										<input
											class="form-control"
											placeholder="quận(huyện),thành phố(tỉnh)"
											type="text"
										/>
									</div>
									<div class="clearfix" >

										<a
											onclick="myFunction()"
											id="off"
											href=""
											class="btn btn-primary btn-sm pull-left"
											rel="content-y"
											data-toggle="collapse"
											role="button"
											>Hủy thêm</a
										>
										<a
											onclick="myFunction()"
											id="off"
											href=""
											class="btn btn-primary btn-sm pull-right"
											rel="content-y"
											data-toggle="collapse"
											role="button"
											>Thêm</a
										>
									</div>	
								</form>
							</div>
							
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h2 style="margin: 10px 0">Danh sách nhà cung cấp</h2>
						<div class="row">
							<div class=" col-lg-12 ">	
								<a
									class="btn btn-secondary dropdown-toggle float-left"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									Tháng 10 Năm 2022
								</a>

								<a 
									onclick="myFunction()"
									id = "on"
									href="#basic-form1"
									class="btn btn-primary btn-sm scroll-click float-right"
									rel="content-y"
									data-toggle="collapse"
									role="button">
									Thêm nhà cung cấp mới
								</a>
							</div> 
						
						</div>
				
					</div>
					<div class="pb-20">
						
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus  ">Mã nhà cung cấp</th>
									<th>Tên nhà cung cấp</th>
									<th>Số điện thoại</th>
									<th>Email</th>
									<th>Địa chỉ</th>
									<th>Ngày tạo</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									 while($numRow){
										$row = $sql->fetch_array();
										$numRow--;
									?>
									<tr>
										<td  class="table-plus text-right"><?php echo $row['ma_ncc']?></td>
										<td><?php echo $row['ten_ncc'] ?></td>
										<td><?php echo $row['sdt'] ?></td>
										<td><?php echo $row['email'] ?></td>
										<td><?php echo $row['diachi'] ?></td>
										<td><?php echo $row['thoigian_tao'] ?></td>
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
													<!-- <a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													> -->
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
									<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->
				<!-- Export Datatable End -->
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				//////
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
	<script src="scripts/datatable-setting.js"></script>
	<script type="text/javascript">
		var on = document.getElementById("on");
		var off = document.getElementById("off");
		var form = document.getElementById("basic-form1");
		function myFunction() {  
		if (on.style.display === "none") {  
			off.style.display = "none";
			form.style.display = "none";
			on.style.display = "inherit";
		} else {
			off.style.display = "inherit";
			form.style.display = "inherit";
			on.style.display = "none";
			}
		}
	</script>
	<!-- Google Tag Manager (noscript) -->
	
	<!-- End Google Tag Manager (noscript) -->
</body>

