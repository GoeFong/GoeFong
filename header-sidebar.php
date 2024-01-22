<div class="pre-loader">
	<div class="pre-loader-box">
		<div class="loader-logo">
			<img src="images/icons8-grocery-shelf-70-light.png" alt="" />
		</div>
		<div class="loader-progress" id="progress_div">
			<div class="bar" id="bar1"></div>
		</div>
		<div class="percent" id="percent1">0%</div>
		<div class="loading-text">Loading...</div>
	</div>
</div>

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<!-- <div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div> -->
				<!-- <div class="header-search">
					<form>
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input
								type="text"
								class="form-control search-input"
								placeholder="Tìm kiếm ở đây"
							/>
						</div>
					</form>
				</div> -->
				
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li>
										<a href="#">
											<img src="images/img.jpg" alt="" />
											<h3>Người dùng 1</h3>
											<p>
												đây là thông báo từ người dùng </p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="images/photo1.jpg" alt="" />
											<h3>Người dùng 2</h3>
											<p>
												đây là thông báo từ người dùng </p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="images/photo2.jpg" alt="" />
											<h3>Người dùng 3</h3>
											<p>
												đây là thông báo từ người dùng </p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="images/photo3.jpg" alt="" />
											<h3>Người dùng 4</h3>
											<p>
												đây là thông báo từ người dùng </p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="images/photo4.jpg" alt="" />
											<h3>Người dùng 5</h3>
											<p>
												đây là thông báo từ người dùng </p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="images/img.jpg" alt="" />
											<h3>Người dùng 6</h3>
											<p>
												đây là thông báo từ người dùng </p>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="images/user_people_man_add_icon.png" alt="" />
							</span>
							<span class="user-name"> <?php echo $_SESSION['ten_nv']?> </span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="#"
								><i class="dw dw-user1"></i> Thông tin tài khoản</a
							>
							<a class="dropdown-item" href="#"
								><i class="dw dw-settings2"></i> Cài đặt</a
							>
							<a class="dropdown-item" href="#"
								><i class="dw dw-help"></i> Help</a
							>
							<a class="dropdown-item" href="logout.php" id="dang_xuat"  
								><i class="dw dw-logout"></i> Đăng xuất</a
							>
						</div>
					</div>
				</div>
				
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Cài đặt trang
					<span class="btn-block font-weight-400 font-12"
						>Cài đặt giao diện người dùng</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">

					<h4 class="weight-600 font-18 pb-10">Giao diện thanh công cụ</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light header-white"
							>Trắng</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark header-dark active"
							>Đen</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Ký hiệu danh sách mục</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Ký hiệu các mục</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo ">
				<a href="admindashboard.php" class="flex  justify-content-center ">
					<img src="images/icons8-grocery-shelf-70-light.png" alt="" class="dark-logo" />
					<img
						src="images/icons8-grocery-shelf-70.png"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="admindashboard.php" class="dropdown-toggle">
								<span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
								<div class="pre-loader">
									<div class="pre-loader-box">
										<div class="loader-logo">
											<img src="images/icons8-grocery-shelf-70-light.png" alt="" />
										</div>
										<div class="loader-progress" id="progress_div">
											<div class="bar" id="bar1"></div>
										</div>
										<div class="percent" id="percent1">0%</div>
										<div class="loading-text">Loading...</div>
									</div>
								</div>
							</a>
							
						</li>
						<li class="dropdown">
							<a href="hoadonad.php" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"
									>
									<!-- <i class="icon-copy dw dw-user1"></i >-->
								</span>
								<!-- <span class="micon bi bi-textarea-resize"></span -->
								<span class="mtext">Hóa đơn</span>
							</a>
							
						</li>

						<li class="dropdown">
							<a href="adminnv.php" class="dropdown-toggle">
								<span class="micon"
									><i class="icon-copy dw dw-user1"></i
								></span>
								<!-- <span class="micon bi bi-textarea-resize"></span -->
								<span class="mtext">Nhân viên</span>
							</a>
							
						</li>


						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon"
									><i class="icon-copy fa-solid fa-seedling"></i
								></span>
								<!-- <span class="micon bi bi-textarea-resize"></span -->
								<span class="mtext">Sản phẩm</span>
							</a>
							<ul class="submenu">
								<li><a href="test.php">Sản phẩm</a></li>
								<li><a href="adminloaisp.php">Loại sản phẩm</a></li>
								<li><a href="adminncc.php">Nhà cung cấp</a></li>
								<li><a href="adminnsx.php">Nhà sản xuất</a></li>
							</ul>
						</li>
						
						<!-- <li class="dropdown">
							<a href="admintv.php" class="dropdown-toggle">
								<span class="micon"
									><i class="icon-copy bi bi-person-heart"></i
								></span>
								<span class="mtext">Thành viên</span>
							</a>
							<ul class="submenu">
							</ul>
						</li> -->

						<li>
							<div class="sidebar-small-cap">Extra</div>
						</li>
						<li>
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-pdf"></span
								><span class="mtext">Công cụ</span>
							</a>
							<ul class="submenu">
								<li><a href="hoa_don.php">Hóa đơn</a></li>
								
							</ul>
							<!-- <ul class="submenu">
								<li><a href="test.php">a</a></li>
								
							</ul> -->
						</li>
					</ul>
				</div>
			</div>
		</div>

		