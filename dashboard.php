<?php 
    include('config/config.php');
    $sql="SELECT 
    DATE_FORMAT(thang, '%Y-%m') AS thang,
    COUNT(DISTINCT a.ma_nv) AS so_luong_thanh_vien, 
    COUNT(DISTINCT b.ma_hd) AS so_luong_hoa_don_ban
FROM 
    (
        SELECT 
            DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL n MONTH), '%Y-%m-01') AS thang
        FROM 
            (SELECT 0 n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL 
             SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11) c
    ) months
    LEFT JOIN user a ON DATE_FORMAT(a.ngaybd, '%Y-%m') <= months.thang
    LEFT JOIN hoadonban b ON a.ma_nv = b.ma_nv
        AND DATE(b.thoigian_tao) >= months.thang
        AND DATE(b.thoigian_tao) < DATE_ADD(months.thang, INTERVAL 1 MONTH)
GROUP BY 
    thang;";
    
    $result = $conn->query($sql);

    $thanh_vien_data = array();
    $hoa_don_ban_data = array();
    $categories = array('12 tháng trước','11 tháng trước','10 tháng trước','9 tháng trước','8 tháng trước','7 tháng trước', '6 tháng trước', '5 tháng trước', '4 tháng trước', '3 tháng trước', '2 tháng trước', 'Tháng này');
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($thanh_vien_data, (int) $row['so_luong_thanh_vien']);
        array_push($hoa_don_ban_data, (int) $row['so_luong_hoa_don_ban']);
    }
    
    $options = array(
        'series' => array(
            array(
                'name' => 'Thành viên',
                'data' => $thanh_vien_data
            ),
            array(
                'name' => 'Hóa đơn bán',
                'data' => $hoa_don_ban_data
            )
        ),
        'chart' => array(
            'height' => 350,
            'type' => 'bar',
            'parentHeightOffset' => 0,
            'fontFamily' => 'Poppins, sans-serif',
            'toolbar' => array(
                'show' => false,
            ),
        ),
        'colors' => ['#1b00ff', '#f56767'],
        'grid' => array(
            'borderColor' => '#c7d2dd',
            'strokeDashArray' => 5,
        ),
        'plotOptions' => array(
            'bar' => array(
                'horizontal' => false,
                'columnWidth' => '25%',
                'endingShape' => 'rounded'
            ),
        ),
        'dataLabels' => array(
            'enabled' => false
        ),
        'stroke' => array(
            'show' => true,
            'width' => 2,
            'colors' => ['transparent']
        ),
        'xaxis' => array(
            'categories' => $categories,
            'labels' => array(
                'style' => array(
                    'colors' => ['#353535'],
                ),
            ),
            'axisBorder' => array(
                'color' => '#8fa6bc',
            )
        ),
        'yaxis' => array(
            'title' => array(
                'text' => ''
            ),
            'labels' => array(
                'style' => array(
                    'colors' => '#353535',
                    'fontSize' => '16px',
                ),
            ),
            'axisBorder' => array(
                'color' => '#f00',
            )
        ),
        'legend' => array(
            'horizontalAlign' => 'right',
            'position' => 'top',
            'fontSize' => '16px',
            'offsetY' => 0,
            'labels' => array(
                'colors' => '#353535',
            ),
            'markers' => array(
                'width' => 10,
                'height' => 10,
                'radius' => 15,
            ),
            'itemMargin' => array(
                'vertical' => 0
            ),
        ),
        'fill' => array(
            'opacity' => 1
        ),
        'tooltip' => array(
            'style' => array(
                'fontSize' => '15px',
                'fontFamily' => 'Poppins, sans-serif',
            ),
            'y' => array(
                'formatter' => 'function (val) {
                    return val
                }'
            )
        )
    );

    $json_data = json_encode($options);

    // Thiết lập tiêu đề cho phản hồi HTTP
    header('Content-Type: application/json');

    // Trả về chuỗi JSON
    echo $json_data;
?>