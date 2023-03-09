<?php
    header('Content-Type: application/json; charset=utf-8');
    $current_date = new DateTime();
    $interval = new DateInterval('P1D');
    $datetemp = $current_date;

    $data = array();
    for ($i=0; $i < 10; $i++){
        $datetemp = date_add($datetemp, $interval);
        $datetemp->format('Y-m-d');
        array_push($data, ["Date"=> $datetemp, "Value" => rand(1000,9999)]);
    }

    $response = new stdClass();
    $response->status = "success";
    $response->title = "ดำเนินการสำเร็จ";
    $response->text = "กำลังเข้าสู่ระบบ กรุณารอสักครู่..."; 
    $response->data = $data;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>