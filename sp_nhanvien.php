<?php

include('config/config.php');
if(empty($_SESSION['user']) OR $_SESSION['user'] != 'user'){
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
    if(empty($_SESSION['user']) ){
        header("Location:login.php");
    }else if( $_SESSION['user'] == 'admin'){

        require_once 'header-sidebar.php';
    }else if( $_SESSION['user'] == 'user'){

        require_once 'header-sidebar_nv.php';
    }
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
					
				</div>
				<!-- Simple Datatable start -->
				<div >
					<div class="card-box mb-30">
						<div class="pd-20">
							<h2 style="margin: 10px 0">Danh sách sản phẩm</h2>
							<div class="row align-items-center">
								<div class="col-lg-3 col-xl-2">
									
								</div>
								<div class="col-lg-9 col-xl-10">
									<div class="float-lg-end">
										<div class="row row-cols-lg-auto g-2">
											<div class="col-12">
												<div class="position-relative">
													<input type="text" id="searchProduct" class="form-control ps-5" placeholder="Tìm Sản Phẩm..." value="<?php echo $_POST['search']?>"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>					
						</div>
						<div   class="pb-20 ">
							<div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 product-grid" >

							<?php
							$search =isset($_GET['search']) ? $_GET['search'] : '';
							if(isset($_GET['search'])) {
								$sql = "SELECT * FROM `sanpham` WHERE LOWER(ten_sp) LIKE CONCAT('%', LOWER(CONVERT('$search', BINARY)), '%') ORDER BY ma_sp DESC";
							} else {
								$sql = "SELECT * FROM `sanpham` ORDER BY ma_sp DESC";
							}
							$result = mysqli_query($conn, $sql);
							while ($row = mysqli_fetch_array($result)) {
								$id = $row['ma_sp'];
								$name = $row['ten_sp'];
								$price = (float)$row['gia_ban'];
								$image = $row['img'];
								$description = $row['hansudung'];
								// $quantity = (int)$row['quantity'];
								// $discount = (int)$row['discount'];
								// $discount_price = $price - ($price * $discount / 100);
								// $ranking = (float)$row['ranking'];
							?>
								<a data-toggle="modal" id="<?= $id ?>" data-target="#exampleModal" class="edit-product" name="edit_sp" href="javascript:;">

									<div class="col">
										<div class="card">
											
											<div class="card-body d-flex flex-column align-items-center justify-content-center">
												<img
													src="<?= $image ?>"
													width="8"
													height="8"
													alt=""
													class="card-img-top p-20"
												/>
												<h5 class="card-title cursor-pointer" style="color: #2800ff;"><?= $name ?></h5>
												<div class="clearfix">
													<h6 class="mb-0 float-end fw-bold"> <span>Giá:  </span></h6>
													<p class="mb-0 float-end fw-bold"> <span> <?= $price ?> VNĐ </span></p>
												</div>
												<div class="d-flex align-items-center mt-3 fs-6">
													<div class="cursor-pointer"> </div>
														<div class="btn-group">
														</div>
												</div>
											</div>
										</div>
									</div>
								</a>
								
								<?php
								}
								?>
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
											<div class="form-group">
												
											</div>
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
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
													<label>Ảnh: </label>
													<input class="img-anh" type="file" id="product_image_md" name="product_image_md" style="display: none;">
													<label for="product_image_md" id="product_image_label_md" style="color: #f60505;">Choose file</label>
													<input id="ma_sp_md"style="display: none;">
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label id="">Barcode: </label>
                                                <label  style="color: #f60505;" id="barcodemdnv"> </label>
                                            </div>
                                        </div>
                                    </div>
										
								</form>
						</div>
						<div class="modal-footer">
							<!-- <a href="#" onclick="confirmDelete();">Xóa</a> -->
							<button type="button" class="btn btn-secondary " data-dismiss="modal">Đóng</button>
							<!-- <button type="button" id="edit_spp" class="btn btn-primary">Lưu</button> -->
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
				console.log("2");
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
			var label = document.getElementById('product_image_label_md');
			var ma_ncc_n = document.getElementById('ncc_md').value;
			var id = document.getElementById('ma_sp_md').value;
			var ma_nsx_n = document.getElementById('nsx_md').value;
			var gia_mua_n = document.getElementById('sale_price_md').value;
			var gia_ban_n = document.getElementById('sale_price_md_2').value;
			var ma_loaisp_n =  document.getElementById('name_md').value;
			var ten_sp_n = document.getElementById('ten_sp_md').value;
			var hansudung_n = document.getElementById('hsd_md').value;
			var dvt_n = document.getElementById('donvitinh_md').value;
			var tt_n = document.getElementById('tt_md').value;
			var product_image = document.getElementById('product_image_md').files[0];
			if(product_image == null) product_image =label.textContent;
			
			var formData = new FormData();
				formData.append('file', product_image);
				formData.append('ten_sp', ten_sp_n);
				formData.append('ma_sp', id);
				formData.append('ma_loaisp', ma_loaisp_n);
				formData.append('ma_ncc', ma_ncc_n);
				formData.append('ma_nsx', ma_nsx_n);
				formData.append('gia_mua', gia_mua_n);
				formData.append('gia_ban', gia_ban_n);
				formData.append('donvitinh', dvt_n);
				formData.append('trangthai', tt_n);
				formData.append('hansudung', hansudung_n);
				formData.append('action_type', 'edit_sp');
				// console.log(formData);
				// console.log(id);
			
			
				$.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
					// async: false,
				  	// data:{trangthai:tt_n,ma_sp:masppp,ten_sp:ten_sp_n,ma_loaisp:ma_loaisp_n,ma_ncc:ma_ncc_n,ma_nsx:ma_nsx_n,gia_mua:gia_mua_n,gia_ban:gia_ban_n,donvitinh:dvt_n,hansudung:hansudung_n,action_type:"edit_sp"},
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {
						//thông báo
						// console.log(data);
						alert('Sửa sản phẩm thành công!');
						// Tải lại thông tin sản phẩm 
						location.reload();
						// Ẩn modal sửa sản phẩm
						$('#exampleModal').modal('hide');
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
				formData.append('file', product_image);
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
						//thông báo
						console.log(data);
						alert('Thêm sản phẩm thành công!');
						// Tải lại thông tin sản phẩm 
						location.reload();
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
		// Lấy thẻ label và input file
		var label = document.getElementById('product_image_label_md');
		var labelbcnv = document.getElementById('barcodemdnv');
		var input = document.getElementById('product_image_md');

		// Khi người dùng chọn file, lấy tên của file và hiển thị trên label
		input.addEventListener('change', function() {
		var fileName = input.value.split('\\').pop();  // Lấy tên của file
		label.textContent = fileName;  // Hiển thị tên của file trên label
		});

		$('a[name="edit_sp"]').click(function() {
			var id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				url: 'ajax_thongtinsp.php',
				datatype: "json",
				// async: false,
				data:{ma_sp: id},
				success: function (data) {
					var data = $.parseJSON(data);
					console.log(data);
					document.getElementById('ten_sp_md').value= data.ten_sp;
					document.getElementById('sale_price_md').value=data.gia_mua;
					document.getElementById('name_md').value=data.ma_loaisp;
					document.getElementById('sale_price_md_2').value=data.gia_ban;
					document.getElementById('donvitinh_md').value=data.donvitinh;
					document.getElementById('ncc_md').value=data.ma_nhacc;
					document.getElementById('nsx_md').value=data.ma_nhasx;
					document.getElementById('hsd_md').value=data.hansudung;
					document.getElementById('tt_md').value=data.trangthai;
					document.getElementById('ma_sp_md').value = data.ma_sp;
					label.textContent = data.img;
                    labelbcnv.textContent= data.barcode;
					// table.row.add( newRow ).draw();
				},
				error: function (data) {
					//  alert(data.status + ' ' + data.statusText);
				}
			});
		});
	</script>
	<script>
		document.getElementById("searchProduct").addEventListener("keypress", function(event) {
			if (event.keyCode === 13) { // kiểm tra nếu là phím Enter
				event.preventDefault(); // ngăn chặn hành động mặc định của phím Enter
				// Thực hiện hành động tìm kiếm ở đây
				// Ví dụ: gọi hàm searchProduct() để thực hiện tìm kiếm
				const searchValue = document.getElementById('searchProduct').value;
				window.location.href = `sp_nhanvien.php?search=${searchValue}`;
			}
		});
		// function searchProduct(event) {
		// 	if (event.keyCode === 13) { // keyCode 13 is the Enter key
		// 		const searchValue = document.getElementById('searchProduct').value;
		// 		window.location.href = `test.php?search=${searchValue}`;
		// 	}
		// };
	</script>
	
	<!-- Google Tag Manager (noscript) -->
	
	<!-- End Google Tag Manager (noscript) -->
</body>
	
	
<script>



function confirmDelete() {
	var result = confirm("Bạn có chắc chắn muốn thực hiện hành động này?");
	if (result) {
		var data = document.getElementById('ma_sp_md').value;

		$.ajax({
			type: 'POST',
			url: 'ajax_product.php',
			datatype: "json",
			// async: false,
			data:{data,action_type:"delete_sp"},
			success: function (data) {
				location.reload();
				// var data = $.parseJSON(data);
				// table.row(currentRow).remove().draw();
				// console.log(data);
				// table.row.add( newRow ).draw();
			},
			error: function (data) {
				//  alert(data.status + ' ' + data.statusText);
			}
		});
	}
	else{

	}
}
// document.querySelector('.modal-footer span').addEventListener('click', confirmDelete);

</script>

