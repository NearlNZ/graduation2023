<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../connect.php");

    //0) Exit if user not verified key yet.
    session_start();
    if (!isset($_SESSION['SESSION-userAccount']) && (!isset($_SESSION['SESSION-keyVerified']) || $_SESSION['SESSION-keyVerified'] != true)) {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "จำเป็นต้องทำการยืนยันตัวตนก่อนใช้งาน";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    //Set parameter
    $id = uniqid("UUID-").rand(100,999);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'] ?? null;
    $level = $_POST['userLevel'] ?? 'Officer';
    $department = $_POST['userDepartment'] ?? '';

    //1) Check if password and confirm password not match when confirm password not null
    if($confirmPassword != null && $password != $confirmPassword){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'รหัสผ่านไม่ตรงกัน โปรดตรวจสอบและลองใหม่อีกครั้ง';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //2) Check if username already exist
    $sql = "SELECT user_id FROM user_Account WHERE user_name = ?;";

    $stmt =  $graduationDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt-> get_result();
    $stmt->close();

    if($result->num_rows > 0){
        $response->status = 'warning';
        $response->title = 'เกิดข้อผิดพลาด';
        $response->text = 'Username นี้ได้ทำการลงทะเบียนไปแล้ว';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //Pass) Create new account
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_Account(user_id, user_name, user_password, user_level, user_department)
            VALUES(?, ?, ?, ?, ?);";
    
    $stmt =  $graduationDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('sssss', $id, $username, $hashPassword, $level, $department);

    if($stmt->execute()){
        $stmt->close();

        $response->status = 'success';
        $response->title = 'ดำเนินการสำเร็จ';
        $response->text = 'เพิ่มบัญชีผู้ใหม่เข้าสู่ระบบแล้ว';
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }else{
        echo $graduationDB->error;
    }

    $graduationDB->close();
    exit();
?>