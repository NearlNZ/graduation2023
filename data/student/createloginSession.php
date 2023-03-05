<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../connect.php");

    //Set parameter
    $cardID = $_POST['cardID'];
    $confirmCardID = $_POST['confirmCardID'];

    //1) Check if cardID match
    if($cardID != $confirmCardID){
        $response->status = "warning";
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = "รหัสประจำตัวประชาชนไม่ตรงกัน โปรดตรวจสอบอีกครั้ง";
                
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //2) Check if username exist
    $sql = "SELECT std_id, std_card_id, std_name, std_lastname FROM student_Account WHERE std_card_id = ? LIMIT 1;";

    $stmt =  $graduationDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $userResult = $stmt-> get_result();
    $stmt->close();

    if($userResult->num_rows == 0){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'ไม่พบบัญข้อมูลบัณฑิตในระบบ โปรดตรวจสอบอีกครั้ง';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //Pass) Create session for user
    $account=$userResult->fetch_assoc();

    $_SESSION['GR-session-userAccount'] = [
        "id" => $account['std_id'],
        "username" => $account['std_name']."  ".$account['std_lastname'],
        "level" => "บัณฑิต",
    ];

    $response->status = "success";
    $response->text = "กำลังเข้าสู่ระบบ กรุณารอสักครู่...";

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    $graduationDB->close();
    exit();
?>