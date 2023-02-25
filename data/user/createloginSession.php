<?php
    session_start();
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../connect.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    //1) Check if username exist
    $sql = "SELECT userID, userUsername, userLevel, userPassword, userDepartment FROM userAccount WHERE userUsername = ? LIMIT 1;";

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

    //2) Check if password not match
    $account=$userResult->fetch_assoc();
    if(!password_verify($password, $account['userPassword'])){
        $response->status = "warning";
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = "รหัสผ่านไม่ถูกต้อง โปรดตรวจสอบอีกครั้ง";
                
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //Pass) Create session for user
    $_SESSION['SESSION-userAccount'] = [
        "id" => $account['userID'],
        "username" => $account['userUsername'],
        "level" => $account['userLevel'],
        "department" => $account['userDepartment']
    ];

    $response->status = "success";
    $response->text = "กำลังเข้าสู่ระบบ กรุณารอสักครู่...";
    $response->level = $account['userLevel'];

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    $graduationDB->close();
    exit();
?>