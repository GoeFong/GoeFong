<?php
include('config/config.php');
// Lấy giá trị tìm kiếm từ URL nếu có
$searchValue = isset($_GET['search']) ? $_GET['search'] : '';
if(isset($_GET['search'])) {
    $sql = "SELECT * FROM `tb_product` WHERE LOWER(name) LIKE CONCAT('%', LOWER(CONVERT('$search', BINARY)), '%') ORDER BY id_product DESC";
} else {
    $sql = "SELECT * FROM `tb_product` ORDER BY id_product DESC";
}

// Thực hiện câu truy vấn và lấy kết quả
$result = mysqli_query($conn, $sql);


// Hàm searchProduct để thực hiện tìm kiếm sản phẩm
function searchProduct($searchValue) {
  // Chuyển hướng tới trang search.php với giá trị tìm kiếm trên URL
  header("Location: search.php?search=$searchValue");
  exit();
}

// Hàm displayProducts để hiển thị kết quả tìm kiếm
function displayProducts($result) {
  // Kiểm tra số lượng sản phẩm tìm được
  if (mysqli_num_rows($result) > 0) {
    // Duyệt qua từng sản phẩm và hiển thị thông tin
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='product'>";
      echo "<h3>" . $row['name'] . "</h3>";
      echo "<p>" . $row['description'] . "</p>";
      echo "<span>" . $row['price'] . "</span>";
      echo "</div>";
    }
  } else {
    // Nếu không tìm thấy sản phẩm nào, hiển thị thông báo
    echo "<p>Không tìm thấy sản phẩm nào.</p>";
  }
}

?>