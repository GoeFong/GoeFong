<?php 
    include('config/config.php');
    $goal=1000;
    $goaldt= array();
    array_push($goaldt, $goal.' hóa đơn bán');

    $sql="SELECT COUNT(*) as tonghd FROM hoadonban WHERE MONTH(thoigian_tao) = MONTH(NOW()) AND YEAR(thoigian_tao) = YEAR(NOW());";
    
    $result = $conn->query($sql);
    $numRow = $result->num_rows;
    $detail= array();
    if($numRow > 0){
        $row = $result->fetch_array();
        // $detail = array('tonghd'=>$row['tonghd']);
        array_push($detail, (float) ($row['tonghd']*100)/$goal);
    }else{
        array_push($detail, (float) 0);
    }

    
    $options =array(
        'series' =>  $detail,
        'chart' => array(
            'height' => 350,
            'type' => 'radialBar',
            'offsetY' => 0
        ),
        'colors' => ['#0B132B', '#222222'],
        'plotOptions' => array(
            'radialBar' => array(
                'startAngle' => -135,
                'endAngle' => 135,
                'dataLabels' => array(
                    'name' => array(
                        'fontSize' => '16px',
                        'color' => null,
                        'offsetY' => 120
                    ),
                    'value' => array(
                        'offsetY' => 76,
                        'fontSize' => '22px',
                        'color' => null,
                        
                    )
                )
            )
        ),
        'fill' => array(
            'type' => 'gradient',
            'gradient' => array(
                'shade' => 'dark',
                'shadeIntensity' => 0.15,
                'inverseColors' => false,
                'opacityFrom' => 1,
                'opacityTo' => 1,
                'stops' => [0, 50, 65, 91]
            ),
        ),
        'stroke' => array(
            'dashArray' => 4
        ),
        'labels' => $goaldt
    );
    $json_data = json_encode($options);

    // Loại bỏ các khoảng trắng thừa trong chuỗi JSON
    $json_data = trim($json_data);

    // Thiết lập tiêu đề cho phản hồi HTTP
    header('Content-Type: application/json');

    // Trả về chuỗi JSON
    echo $json_data;
?>