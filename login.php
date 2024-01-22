
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Hệ thống quản lý cửa hàng thực phẩm</title>
		<!-- favicon -->
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="images/icons8-grocery-shelf-cloud-32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="images/icons8-grocery-shelf-cloud-16.png"
		/>
		

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="css/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="css/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="css/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		
		<!-- End Google Tag Manager -->
	</head>
	
	<body class="login-page">
		
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center justify-content-center">
					
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Đăng nhập vào hệ thống</h2>
							</div>
							<form  >
								<div class="select-role">
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
										<label class="btn active">
											<input type="radio" name="roles" id="admin" value="admin" />
											<div class="icon">
												<img
													src="images/briefcase.svg"
													
													alt=""
												/>
											</div>
											<span>Tôi là</span>
											Quản lý
										</label>
										<label class="btn">
											<input type="radio" name="roles" id="user" value="user" />
											<div class="icon">
												<img
													src="images/person.svg"
													
													alt=""
												/>
											</div>
											<span>Tôi là</span>
											Nhân viên
										</label>
									</div>
								</div>
								<div class="input-group custom">
									<input
										type="email"
										class="form-control form-control-lg"
										placeholder="abc@gmail.com"
										id="emailInput"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="icon-copy dw dw-user1"></i
										></span>
									</div>
								</div>
								<div class="input-group custom">
									<input
										id="pwInput"
										type="password"
										class="form-control form-control-lg"
										placeholder="**********"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>
								<div class="row pb-30">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											
										</div>
									</div>
									<div class="col-6">
										<div class="forgot-password">
											<a href="forgot-password.php">Quên mật khẩu</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											
											<!-- use code for form submit -->
											<input class="btn btn-primary btn-lg btn-block" id="dang_nhap" type="" value="Đăng Nhập">
										
											<!-- <button
												class="btn btn-primary btn-lg btn-block"
												onclick="login()"
												href=""
												>Sign In</button
											>
										 -->
									</div>
								</div>
							</form>
						</div>
					</div>
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
		<!-- Google Tag Manager (noscript) -->
		
		<!-- End Google Tag Manager (noscript) -->

		<script>
		$('#dang_nhap').click(function(){
			var emailip = document.getElementById('emailInput').value;
			var passwordip =  document.getElementById('pwInput').value;
			var radios = document.getElementsByName('roles');
			var roleip;
			for (var i = 0, length = radios.length; i < length; i++) {
				if (radios[i].checked) {
					// do whatever you want with the checked radio
					roleip = radios[i].value;

					// only one radio can be logically checked, don't check the rest
					break;
				}
			}
			if(roleip == null)
			{
				//alert(roleip);
				alert("Chọn chức vụ trước khi đăng nhập!!");
			}
			else if(emailip == "")
			{
			
				alert("Nhập email trước khi đăng nhập!!");
			}
			else if(passwordip == "")
			{
				alert("Nhập mật khẩu trước khi đăng nhập!!");
			}
			else{
				$.ajax({
					type:"POST",  
					url : "ajax_login.php",
					dataType:"json",
					data:{email:emailip,password:passwordip,role:roleip},
					success:function(data){
						console.log(data);
						if(data.type == 'Success')
						{
							if(data.chuc_vu == "admin"){

								window.location="http://localhost/test/admindashboard.php";
							}
							if(data.chuc_vu == "user"){
								location.replace('http://localhost/test/hoa_don.php');
							}
						}
						// else alert("Sai tai khoan hoac mat khau!!!");
						//$('#err').html(result);
					},
					error: function (e) {
						alert("Đăng nhập không thành công!!");
						}
				});

			}
			// alert(passwordip);
		});
	</script>
	</body>
</html>
