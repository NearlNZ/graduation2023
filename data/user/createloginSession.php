<?php
    header('Content-Type: application/json; charset=utf-8');
    session_start();
    $response = new stdClass();
    require_once("../connect.php");

    //Set parameter
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    //1) Check for required parameter
    if($username == null || $password == null){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'โปรดระบุชื่อผู้ใช้และรหัสผ่านของท่าน';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //2) Check if username exist
    $sql = "SELECT user_id, user_name, user_level, user_password, user_department 
            FROM user_Account 
            WHERE user_name = ? 
            LIMIT 1;";

    $stmt =  $graduationDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $userResult = $stmt-> get_result();
    $stmt->close();

    if($userResult->num_rows == 0){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'ไม่พบบัญชีผู้ใช้ในระบบ โปรดตรวจสอบอีกครั้ง';

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //3) Check if password not match
    $account=$userResult->fetch_assoc();
    if(!password_verify($password, $account['user_password'])){
        $response->status = "warning";
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = "รหัสผ่านไม่ถูกต้อง โปรดตรวจสอบอีกครั้ง";

		echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //Pass) Create session for user
    $_SESSION['GR-session-userAccount'] = [
        "id" => $account['user_id'],
        "username" => $account['user_name'],
        "level" => $account['user_level'],
        "department" => $account['user_department']
    ];

    $response->status = "success";
    $response->text = "กำลังเข้าสู่ระบบ กรุณารอสักครู่...";
    $response->level = $account['user_level'];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    $graduationDB->close();
    exit();
?>