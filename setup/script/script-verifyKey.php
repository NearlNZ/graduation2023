<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    session_start();

    //Set parameter
    $key = $_POST['key'] ?? null;

    //1) Check for required parameter
    if($key == null){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'โปรดระบุ configuration key';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    //2) Check if configuration key incorrect
    $config = json_decode(file_get_contents('../config.json'), true);
    $storedKey = $config['configKey'];

    if ($key != $storedKey) {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "configuration key ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง";

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    //Pass) Create session for setup
    $response->status = "success";
    $response->title = "ตรวจสอบสำเร็จ";
    $response->text = "กำลังเปิดใช้งาน System Configuration";

    $_SESSION['GR-session-keyVerified'] = true;

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();
?>