<?php
	include('config/config.php');
	if(empty($_SESSION['user']) OR $_SESSION['user'] != 'admin'){
		header("Location:login.php");
	}
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
								<h4>Hóa đơn</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="admindashboard.php">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Hóa đơn
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
									<section>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Tên thành viên</label>
													<input
														class="form-control"
														type="text"
														placeholder="Tên thành viên"
														id="ten"
													/>
												</div>
												
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email</label>
													<input
														class="form-control"
														placeholder="abc@gmail.com"
														type="email"
														id="email"
													/>
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Địa chỉ</label>
													<input
														class="form-control"
														placeholder="quận(huyện),thành phố(tỉnh)"
														type="text"
														id="diachi"
													/>
												</div>

											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Mật khâu</label>
													<input class="form-control" id="matkhau" value="password" type="password" />
													
												</div>
											</div>
										</div>
										<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Số điện thoại</label>
														<input
															class="form-control"
															placeholder="(+84)...."
															type="text"
															id="sdt"
														/>
													</div>
	
												</div>
												
												
												<div class="col-md-6">
													<div class="form-group">
														<label>Nhập lại mật khẩu</label>
														<input class="form-control" id="matkhau2" value="password" type="password" />
													</div>
												</div>

										</div>
										<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Ngày sinh</label>
														<input
															class="form-control date-picker"
															placeholder="Chọn ngày sinh"
															id="ngaysinh"
														/>
													</div>
												</div>
												<div class="col-md-6">
													<label>Chức vụ</label>
													<select id="chucvu" class="custom-select col-12">
														<option selected="" value= "0">Nhân viên</option>
														<option value="1">Admin</option>
														
													</select>
												</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													
													<label>Giới tính</label>
													<select id="gioitinh" class="custom-select col-12">
														<option selected="" value= "0">Nam</option>
														<option value="1">Nữ</option>
														
													</select>
													
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
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
															onclick=""
															id="add_sp"
															href=""
															class="btn btn-primary btn-sm pull-right"
															rel="content-y"
															data-toggle="collapse"
															role="button"
															>Thêm</a
														>
													</div>	
												</div>
											</div>
										</div>
											
											
									</section>
									
								</form>
							</div>
							
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h2 style="margin: 10px 0">Danh sách hóa đơn</h2>
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
								
									href="hoa_don.php"
									class="btn btn-primary btn-sm scroll-click float-right"
								
									role="button">
									Thêm hóa đơn mới
								</a>
							</div> 
						
						</div>
				
					</div>
					<div class="pb-20 ">

						<table id="example1"class="table data-table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th scope="col" class="table-plus all">Mã hóa đơn</th>
									<th scope="col">Tổng tiền</th>
									<th scope="col">Mã nhân viên</th>
									<th scope="col">Tên nhân viên</th>
									<th scope="col">Thời gian tạo</th>
									<th scope="col" class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<!-- <tbody>
								
							</tbody> -->
							<tfoot>
								
							</tfoot>
						</table>
						
					</div>
				</div>
				<!-- Simple Datatable End -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Thông tin hóa đơn</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tên nhân viên</label>
										<input
											class="form-control"
											type="text"
											id="ten_nhanvien_md"
											placeholder="Tên nhân viên"
										/>
									</div>
									
								</div>
								<div class="col-md-6 ">
									
									<div class="form-group">
										<label >Ngày tạo hóa đơn</label>
										<input  id="ngaytaohd_md" class="form-control date-picker" placeholder="Chọn ngày tạo hóa đơn" type="text">
									</div>
									

								</div>
							</div>
			
							
										
						</form>
                            <div class="invoice">
                                <table class="hoadonadtable">
                                    <thead>
                                        <tr>
                                            <th class="dongtbl dongtablehdb">Sản phẩm</th>
                                            <th class="dongtbl dongtablehdb">Đơn giá</th>
                                            <th class="dongtbl dongtablehdb">Số lượng</th>
                                            <th class="dongtbl dongtablehdb">Thành tiền</th>
                                        </tr>

                                    </thead>
                                   <tbody>

                                   </tbody>
                                   
                                </table>
                                <table class="total hoadonadtable">
                                    <tr>
                                        <td class="dongtablehdb">Tổng tiền</td>
                                        <td class="dongtablehdb" id="tongtien_hd"> đ</td>
                                    </tr>
                                    <tr>
                                        <td class="dongtablehdb">Thành tiền</td>
                                        <td class="dongtablehdb" id="tongthanhtien_hd"> đ</td>
                                    </tr>
                                </table>
                            </div>
						</div>
                        
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
							<button type="button" id="" class="btn btn-primary">Lưu</button>
						</div>
						</div>
					</div>
				</div>
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
<script>
	$(document).ready(function (){
	var data;
	var table;
	var masppp;
	<?php 
		$sqlP =  $conn->query(" SELECT * FROM hoadonban a, user b WHERE a.ma_nv = b.ma_nv GROUP BY a.ma_hd"); 
		$rows = array();
		while($row = $sqlP->fetch_array()){
			$rows[] = array(
				'type'=>'Success',
				'ma_hd'=>$row['ma_hd'],
				'tong_tien'=>$row['tong_tien'],
				'ma_nv'=>$row['ma_nv'],
				'ten_nv'=>$row['ten_nv'],
				'thoigian_tao'=>$row['thoigian_tao'],
				);
		?>	
		<?php }
	?>;
		$("#example1").dataTable().fnDestroy();
		data = <?php echo json_encode($rows);?>;
			// console.log(data);
		table=$('#example1').DataTable( {
			
			// "processing": true,
			data,
			columnDefs: [{
					"targets": -1,
					"render": function (data, type, row) {
						var checkbox = '<div class="dropdown"><a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"><i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"><a class="dropdown-item edit_sp" data-toggle="modal" data-target="#exampleModal" name="edit_sp" href="javascript:;"><i class="dw dw-edit2"></i>Edit</a><a class="dropdown-item delete_sp" name="delete_sp" href="javascript:;"><i class="dw dw-delete-3"></i>Delete</a></div></div>';
						return checkbox;
					}
				}],
			columns: [
				{ data: "ma_hd" },
				{ data: "tong_tien" },
				{ data: "ma_nv" },
				{ data: "ten_nv" },
				{ data: "thoigian_tao" },
				{ data: null  }
			]  

			} );
			

			
			$("#example1").on('click','.delete_sp',function(){
				// get the current row
				var currentRow=$(this).closest("tr"); 
				
				var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
				var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
				var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
				var data =table.row(currentRow).data();
				
				$.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
                   // async: false,
				  	data:{data,action_type:"delete_sp"},
                    success: function (data) {
						// var data = $.parseJSON(data);
						table.row(currentRow).remove().draw();
						console.log(data);
    					// table.row.add( newRow ).draw();
                    },
                    error: function (data) {
                      //  alert(data.status + ' ' + data.statusText);
                    }
                });
			});
			var row_edit;
			$("#example1").on('click','.edit_sp',function(){
				// get the current row
				var currentRow=$(this).closest("tr"); 
				row_edit=currentRow;
				var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
				var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
				var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
				var data =table.row(currentRow).data();
				// console.log(data);
				// var new_window = window.open('ajax_thongtinsp.php');
				$.ajax({
                    type: 'POST',
                    url: 'ajax_hoadonad.php',
                    datatype: "json",
                   // async: false,
				  	data:{data},
                    success: function (data) {
						var data = $.parseJSON(data);
                        var table_html = data.table_html;
						document.getElementById('ten_nhanvien_md').value=data.ten_nv;
						document.getElementById('ngaytaohd_md').value=data.thoigian_tao;
						document.getElementById('tongtien_hd').textContent=data.tong_tien;
						document.getElementById('tongthanhtien_hd').textContent=data.tong_tien;
						var tbody = document.querySelector('.hoadonadtable tbody');
                         tbody.innerHTML = table_html;
                        
						//  masppp=data.ma_hd;
						 console.log(data);
    					// table.row.add( newRow ).draw();
                    },
                    error: function (data) {
                      //  alert(data.status + ' ' + data.statusText);
                    }
                });
				

				
				
			});
		$('#edit_spp').click(function(){
			var ma_ncc_n = document.getElementById('ncc_md').value;
			var ma_nsx_n = document.getElementById('nsx_md').value;
			var gia_mua_n = document.getElementById('sale_price_md').value;
			var gia_ban_n = document.getElementById('sale_price_md_2').value;
			var ma_loaisp_n =  document.getElementById('name_md').value;
			var ten_sp_n = document.getElementById('ten_sp_md').value;
			var hansudung_n = document.getElementById('hsd_md').value;
			var dvt_n = document.getElementById('donvitinh_md').value;
			var tt_n = document.getElementById('tt_md').value;
			// console.log();
			// console.log(2);
			
			
				$.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
                   // async: false,
				  	data:{trangthai:tt_n,ma_sp:masppp,ten_sp:ten_sp_n,ma_loaisp:ma_loaisp_n,ma_ncc:ma_ncc_n,ma_nsx:ma_nsx_n,gia_mua:gia_mua_n,gia_ban:gia_ban_n,donvitinh:dvt_n,hansudung:hansudung_n,action_type:"edit_sp"},
                    success: function (data) {
						// var a ={"ma_sp":"2","ten_sp":"d\u00e2u t\u00e2y edit","ten_loaisp":"loaisp_1","trangthai":"1","gia_ban":"35000","gia_mua":"27000","thoigian_tao":"2022-11-10 10:29:36","thoigian_capnhat":"2022-11-10 10:29:36","hansudung":"1 th\u00e1ng"};
						var data = $.parseJSON(data);
						// console.log(data);
						table.row(row_edit).data(data).draw();
                    },
                    error: function (data) {
                      //  alert(data.status + ' ' + data.statusText);
                    }
                });


		
		});
		$('#add_sp').click(function(){
			var ma_ncc_n = document.getElementById('ncc_1').value;
			var ma_nsx_n = document.getElementById('nsx_1').value;
			var gia_mua_n = document.getElementById('sale_price_1').value;
			var gia_ban_n = document.getElementById('sale_price_2').value;
			var ma_loaisp_n =  document.getElementById('name_1').value;
			var ten_sp_n = document.getElementById('ten_sp').value;
			var hansudung_n = document.getElementById('hsd').value;
			var dvt_n = document.getElementById('donvitinh').value;
			// console.log();
			// console.log(2);
			
			if(ten_sp_n == "")
			{
			
				alert("Nhập tên sản phẩm trước khi lưu!!");
			}
			else if(ma_loaisp_n == "")
			{
				alert("Chọn loại sản phẩm trước khi lưu!!");
			}
			else if(ma_ncc_n == "")
			{
				alert("Chọn nhà cung cấp trước khi lưu!!");
			}
			else if(ma_nsx_n == "")
			{
				alert("Chọn nhà sản xuất trước khi lưu!!");
			}
			else if(gia_mua_n == "" )
			{
				//alert(roleip);
				alert("Đặt giá mua trước khi lưu!!");
			}
			else if(gia_ban_n == "")
			{
				alert("Đặt giá bán trước khi lưu!!");
			}
			else if(hansudung_n == "")
			{
				alert("Nhập hạn sử dụng trước khi lưu!!");
			}
			else if(donvitinh == "")
			{
				alert("Nhập hạn sử dụng trước khi lưu!!");
			}
			else{
				$.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
                   // async: false,
				  	data:{ten_sp:ten_sp_n,ma_loaisp:ma_loaisp_n,ma_ncc:ma_ncc_n,ma_nsx:ma_nsx_n,gia_mua:gia_mua_n,gia_ban:gia_ban_n,donvitinh:dvt_n,hansudung:hansudung_n,action_type:"add_sp"},
                    success: function (data) {
						var data = $.parseJSON(data);
						var newRow =data;
						// console.log(data);
    					table.row.add( newRow ).draw();
                    },
                    error: function (data) {
                      //  alert(data.status + ' ' + data.statusText);
                    }
                });


			}
		});

});
</script>

