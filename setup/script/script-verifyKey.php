<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    session_start();

    //Set parameter
    $key = $_POST['key'];

    $config = json_decode(file_get_contents('../config.json'), true);
    $storedKey = $config['configKey'];

    if ($key === $storedKey) {
        $response->status = "success";
        $response->title = "ตรวจสอบสำเร็จ";
        $response->text = "กำลังเปิดใช้งาน System Configuration";

        $_SESSION['GR-session-keyVerified'] = true;
    } else {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "configuration key ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง";
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();
?>