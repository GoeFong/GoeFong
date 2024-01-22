<?php 
    include('config/config.php');
    $sql="SELECT 
    DATE_SUB(CURDATE(), INTERVAL n DAY) AS ngay, 
    COUNT(DISTINCT a.ma_nv) AS so_luong_thanh_vien, 
    COUNT(DISTINCT b.ma_hd) AS so_luong_hoa_don_ban
FROM 
    (
        SELECT 0 n UNION ALL
        SELECT 1 UNION ALL
        SELECT 2 UNION ALL
        SELECT 3 UNION ALL
        SELECT 4 UNION ALL
        SELECT 5 UNION ALL
        SELECT 6
    ) c 
    LEFT JOIN user a ON 1=1 
    LEFT JOIN hoadonban b ON a.ma_nv = b.ma_nv AND DATE(b.thoigian_tao) = DATE_SUB(CURDATE(), INTERVAL n DAY)
WHERE 
    DATE_SUB(CURDATE(), INTERVAL n DAY) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
GROUP BY 
    ngay 
ORDER BY 
    ngay ASC;";
    
    $result = $conn->query($sql);

    $thanh_vien_data = array();
    $hoa_don_ban_data = array();
    $categories = array('7 ngày trước', '6 ngày trước', '5 ngày trước', '4 ngày trước', '3 ngày trước', '2 ngày trước', 'Hôm nay');
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
            'height' => 300,
            'type' => 'line',
            'zoom' => array(
                'enabled' => false
            ),
            'dropShadow' => array(
                'enabled' => true,
                'color' => '#000',
                'top' => 18,
                'left' => 7,
                'blur' => 16,
                'opacity' => 0.2
            ),
            'toolbar' => array(
                'show' => false
            )
        ),
        'colors' => array('#f0746c', '#255cd3'),
        'dataLabels' => array(
            'enabled' => false
        ),
        'stroke' => array(
            'width' => array(3,3),
            'curve' => 'smooth'
        ),
        'grid' => array(
            'show' => false
        ),
        'markers' => array(
            'colors' => array('#f0746c', '#255cd3'),
            'size' => 5,
            'strokeColors' => '#ffffff',
            'strokeWidth' => 2,
            'hover' => array(
                'sizeOffset' => 2
            )
        ),
        'xaxis' => array(
            'categories' => $categories,
            'labels' => array(
                'style' => array(
                    'colors' => '#8c9094'
                )
            )
        ),
        'yaxis' => array(
            'min' => 0,
            'max' => 35,
            'labels' => array(
                'style' => array(
                    'colors' => '#8c9094'
                )
            )
        ),
        'legend' => array(
            'position' => 'top',
            'horizontalAlign' => 'right',
            'floating' => true,
            'offsetY' => 0,
            'labels' => array(
                'useSeriesColors' => true
            ),
            'markers' => array(
                'width' => 10,
                'height' => 10
            )
        )
    );

    $json_data = json_encode($options);

    // Thiết lập tiêu đề cho phản hồi HTTP
    header('Content-Type: application/json');

    // Trả về chuỗi JSON
    echo $json_data;
?>