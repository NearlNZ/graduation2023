<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../data/connect.php");

    //1) Check if user not log in
    $account = (object) $_SESSION['SESSION-userAccount'] ?? null;
    if($account == null){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'ผู้ใช้ไม่ได้เข้าสู่ระบบอย่างถูกต้อง';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //2) Check if user not have permission to acceess
    if($account->level != 'Admin'){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'ผู้ใช้ไม่มีสิทธิในการใช้งานฟังก์ชันนี้';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //Pass) Download .sql file of connected database
    $filename = 'backup-' . date('Y-m-d-H-i-s') . '.sql';
    $temp_file = '../data/backup/'.$filename;
    $command = "mysqldump -u $username -p $password $database > $temp_file";
    exec($command);

    $response->status = 'success';
    $response->title = 'ดำเนินการสำเร็จ';
    $response->text = 'ระบบดำเนินการสำรองข้อมูลของท่านแล้ว';
    $response->url = $temp_file;
    $response->filename = $filename;
    $response->command = $command;
        
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    $graduationDB->close();
    exit();
?>