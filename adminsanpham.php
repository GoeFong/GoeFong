<?php

include('config/config.php');
if(empty($_SESSION['user']) OR $_SESSION['user'] != 'admin'){
	header("Location:login.php");
}
	//$prd = $conn->select('ten_ncc ,ten_nsx, ten_loaisp', 'sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d','a.ma_loaisp=b.ma_loaisp and a.ma_nhacc=c.ma_ncc and a.ma_nhasx=d.ma_nsx');
	// $sql = $conn->query("SELECT * FROM sanpham ");
	


?>
<?php 
	require_once 'head.php';
?>
<body>
	<?php 
		require_once 'header-sidebar.php';
	?>
	<div class="mobile-menu-overlay"></div>
	<div  class="main-container">
		<div class="pd-ltr-20">

			<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Sản phẩm</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="admindashboard.php">Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">
										Sản phẩm
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
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Tên sản phẩm</label>
												<input
													class="form-control"
													type="text"
													id="ten_sp"
													placeholder="Tên sản phẩm"
												/>
											</div>
											
										</div>
										<div class="col-md-6 d-flex flex-row">
											
												<div class="form-group" style=" padding-right: 30px;">
													<label>Giá mua</label>
													<input type="number" required class="form-control" step="1000" id="sale_price_1" name="sale_price[]" />
													
												</div>
												<div class="form-group ">
													<label>Đơn vị tính</label>
													<select class="custom-select col-12" id="donvitinh">
														<option selected value="Kg">Kg</option>
														<option value="Hộp">Hộp</option>
														<option value="Bó">Bó</option>
														<option value="Cái">Cái</option>
														<option value="Lít">Lít</option>
														
													</select>
												</div>
											

										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Loại sản phẩm</label>
												<select name="name[]" id="name_1" class="custom-select col-12">
													
													<option value="">Chọn loại sản phẩm</option>
													<?php $sqlP = $conn->query("SELECT * FROM loaisanpham WHERE trangthai = 'Đang hoạt động' ORDER BY ten_loaisp ASC");
													while($rowP = $sqlP->fetch_array()){?>
													<option value="<?php echo $rowP['ma_loaisp']?>"><?php echo $rowP['ten_loaisp'];?></option>
													<?php }?>
												</select>
											</div>
											
										</div>
										<div class="col-md-6 d-flex flex-row">
											<div class="form-group" style=" padding-right: 30px;">
												<label>Giá bán</label>
												<input type="number" required class="form-control" style="width: 216px;height: 45px;" step="1000" id="sale_price_2" name="sale_price_2[]" />
									  
											</div>
											<div class="form-group" >
												<div class="col-12">
													<label>Ảnh</label>
													<input class="img-anh" type="file" id="product_image" name="product_image">

												</div>

											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Nhà cung cấp</label>
												<select name="ncc[]" id="ncc_1" class="custom-select col-12" >
													
													<option value="">Chọn nhà cung cấp</option>
													<?php $sqlP = $conn->query("SELECT * FROM nhacungcap  ORDER BY ten_ncc ASC");
													while($rowP = $sqlP->fetch_array()){?>
													<option value="<?php echo $rowP['ma_ncc']?>"><?php echo $rowP['ten_ncc'];?></option>
													<?php }?>
												</select>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Hạn sử dụng</label>
												<input
													class="form-control"
													id="hsd"
													placeholder="Ghi chú hạn sử dụng"
													type="text"
												/>
											</div>

										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Nhà sản xuất</label>
												<select name="nsx[]" id="nsx_1" class="custom-select col-12" >
													
													<option value="">Chọn nhà sản xuất</option>
													<?php $sqlP = $conn->query("SELECT * FROM nhasanxuat  ORDER BY ten_nsx ASC");
													while($rowP = $sqlP->fetch_array()){?>
													<option value="<?php echo $rowP['ma_nsx']?>"><?php echo $rowP['ten_nsx'];?></option>
													<?php }?>
												</select>
											</div>
											
										</div>
										<div class="col-md-6">
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
													href="#"
													class="btn btn-primary btn-sm pull-right"
													rel="content-y"
													data-toggle="collapse"
													role="button"
													>Lưu sản phẩm</a
												>
											</div>	
										</div>
									</div>
										
								</form>
							</div>
							
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div >
					<div class="card-box mb-30">
						<div class="pd-20">
							<h2 style="margin: 10px 0">Danh sách sản phẩm</h2>
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
										Thêm sản phẩm mới
									</a>
								</div> 
							
							</div>
					
						</div>
						<div   class="pb-20 ">
							<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid" >
								<a data-toggle="modal" data-target="#exampleModal" name="edit_sp" href="javascript:;">
									<div class="col">
										<div class="card">
											<img
												src="images/36.png"
												width="8"
												height="8"
												alt=""
												class="card-img-top p-20"
											/>
											<div class="card-body">
												<h6 class="card-title cursor-pointer">Dâu tây</h6>
												<div class="clearfix">
													<p class="mb-0 float-start">Còn <strong>10</strong></p>
													<p class="mb-0 float-end fw-bold"> <span>76.000 VND</span>
													</p>
												</div>
												<div class="d-flex align-items-center mt-3 fs-6">
													<div class="cursor-pointer"> </div>
														<div class="btn-group">
															<button type="button" class="btn btn-sm btn-outline-secondary">Buy Now</button>
															<button type="button" class="btn btn-sm btn-outline-secondary">Add to Cart</button>
														</div>
												</div>
											</div>
										</div>
									</div>
								</a>
							
							</div>



						</div>
					</div>
					
				</div>
				<!-- Simple Datatable End -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Thông tin sản phẩm</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Tên sản phẩm</label>
												<input
													class="form-control"
													type="text"
													id="ten_sp_md"
													placeholder="Tên sản phẩm"
												/>
											</div>
											
										</div>
										<div class="col-md-6 d-flex flex-row">
											
												<div class="form-group">
													<label>Giá mua</label>
													<input type="number" required class="form-control" step="1000" id="sale_price_md" name="sale_price[]" />
													
												</div>
												<div class="form-group ">
													<label>Đơn vị tính</label>
													<select class="custom-select col-12" id="donvitinh_md">
														<option selected value="Kg">Kg</option>
														<option value="Hộp">Hộp</option>
														<option value="Bó">Bó</option>
														<option value="Cái">Cái</option>
														<option value="Lít">Lít</option>
														
													</select>
												</div>
											

										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Loại sản phẩm</label>
												<select name="name[]" id="name_md" class="custom-select col-12">
													
													<option value="">Chọn loại sản phẩm</option>
													<?php $sqlP = $conn->query("SELECT * FROM loaisanpham WHERE trangthai = 'Đang hoạt động' ORDER BY ten_loaisp ASC");
													while($rowP = $sqlP->fetch_array()){?>
													<option value="<?php echo $rowP['ma_loaisp']?>"><?php echo $rowP['ten_loaisp'];?></option>
													<?php }?>
												</select>
											</div>
											
										</div>
										<div class="col-md-6 d-flex flex-row">
											<div class="form-group">
												<label>Giá bán</label>
												<input type="number" required class="form-control" step="1000" id="sale_price_md_2" name="sale_price_2[]" />
									  
											</div>
											<div class="form-group"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Nhà cung cấp</label>
												<select name="ncc[]" id="ncc_md" class="custom-select col-12" >
													
													<option value="">Chọn nhà cung cấp</option>
													<?php $sqlP = $conn->query("SELECT * FROM nhacungcap  ORDER BY ten_ncc ASC");
													while($rowP = $sqlP->fetch_array()){?>
													<option value="<?php echo $rowP['ma_ncc']?>"><?php echo $rowP['ten_ncc'];?></option>
													<?php }?>
												</select>
											</div>
											
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Hạn sử dụng</label>
												<input
													class="form-control"
													id="hsd_md"
													placeholder="Ghi chú hạn sử dụng"
													type="text"
												/>
											</div>

										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Nhà sản xuất</label>
												<select name="nsx[]" id="nsx_md" class="custom-select col-12" >
													
													<option value="">Chọn nhà sản xuất</option>
													<?php $sqlP = $conn->query("SELECT * FROM nhasanxuat  ORDER BY ten_nsx ASC");
													while($rowP = $sqlP->fetch_array()){?>
													<option value="<?php echo $rowP['ma_nsx']?>"><?php echo $rowP['ten_nsx'];?></option>
													<?php }?>
												</select>
											</div>
										</div>
										<div class="col-md-6">	
											<div class="form-group">
												<label>Trạng thái</label>
												<select  id="tt_md" class="custom-select col-12" >
													
													<option value="">Trạng thái</option>
													
													<option value="1">Đang hoạt động</option>
													<option value="0">Tắt</option>
													
												</select>
											</div>
										</div>
										
									</div>
									
								</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
							<button type="button" id="edit_spp" class="btn btn-primary">Lưu</button>
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
		};
		
	</script>
	<script>
	
	</script>

	
	<script>
	var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function (){
	var data;
	var table;
	var masppp;
	<?php 
		$sqlP =  $conn->query("SELECT a.*,b.ten_loaisp,c.ten_ncc,d.ten_nsx from sanpham a, loaisanpham b, nhacungcap c, nhasanxuat d GROUP BY a.ma_sp"); 
		$rows = array();
		while($row = $sqlP->fetch_array()){
			$rows[] = array('type'=>'Success','ma_sp'=>$row['ma_sp'],'ten_sp'=>$row['ten_sp'],'ten_loaisp'=>$row['ten_loaisp'],'gia_ban'=>$row['gia_ban'],'gia_mua'=>$row['gia_mua'],'thoigian_capnhat'=>$row['thoigian_capnhat'],'thoigian_tao'=>$row['thoigian_tao'],'trangthai'=>$row['trangthai'],'hansudung'=>$row['hansudung']);
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
				{ data: "ma_sp" },
				{ data: "ten_sp" },
				{ data: "ten_loaisp" },
				{ data: "trangthai" },
				{ data: "gia_ban" },
				{ data: "gia_mua" },
				{ data: "thoigian_tao" },
				{ data: "thoigian_capnhat" },
				{ data: "hansudung" },
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
                    url: 'ajax_thongtinsp.php',
                    datatype: "json",
                   // async: false,
				  	data:{data},
                    success: function (data) {
						var data = $.parseJSON(data);
						document.getElementById('ten_sp_md').value=data.ten_sp;
						document.getElementById('sale_price_md').value=data.gia_mua;
						document.getElementById('name_md').value=data.ma_loaisp;
						document.getElementById('sale_price_md_2').value=data.gia_ban;
						document.getElementById('donvitinh_md').value=data.donvitinh;
						document.getElementById('ncc_md').value=data.ma_nhacc;
						document.getElementById('nsx_md').value=data.ma_nhasx;
						document.getElementById('hsd_md').value=data.hansudung;
						document.getElementById('tt_md').value=data.trangthai;
						masppp=data.ma_sp;
						//console.log(data);
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
			var product_image = document.getElementById('product_image').files[0];
			
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

				var formData = new FormData();
				formData.append('file', files);
				formData.append('ten_sp', ten_sp_n);
				formData.append('ma_loaisp', ma_loaisp_n);
				formData.append('ma_ncc', ma_ncc_n);
				formData.append('ma_nsx', ma_nsx_n);
				formData.append('gia_mua', gia_mua_n);
				formData.append('gia_ban', gia_ban_n);
				formData.append('donvitinh', dvt_n);
				formData.append('hansudung', hansudung_n);
				formData.append('action_type', 'add_sp');
				$.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
                   // async: false,
				  	// data:{ten_sp:ten_sp_n,ma_loaisp:ma_loaisp_n,ma_ncc:ma_ncc_n,ma_nsx:ma_nsx_n,gia_mua:gia_mua_n,gia_ban:gia_ban_n,donvitinh:dvt_n,hansudung:hansudung_n,action_type:"add_sp"},
					data: formData,
					processData: false,
					contentType: false,
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
	<script>
		
	</script>
	<!-- Google Tag Manager (noscript) -->
	
	<!-- End Google Tag Manager (noscript) -->
</body>
	
	

