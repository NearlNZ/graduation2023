<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../connect.php");

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
    $sql = "SELECT userID FROM userAccount WHERE userUsername = ?;";

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

    $sql = "INSERT 
            INTO userAccount(userUsername, userPassword, userLevel, userDepartment)
            VALUES(?, ?, ?, ?);";
    
    $stmt =  $graduationDB->stmt_init(); 
    $stmt->prepare($sql);
    $stmt->bind_param('ssss', $username, $hashPassword, $level, $department);

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