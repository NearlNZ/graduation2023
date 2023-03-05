<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../../data/connect.php");

    //0) Exit if user not verified key yet.
    session_start();
    if (!isset($_SESSION['GR-session-keyVerified']) || $_SESSION['GR-session-keyVerified'] != true) {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "จำเป็นต้องทำการยืนยันตัวตนก่อนใช้งาน";
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    }

    //Set parameter
    $option = $_POST['option'];
    $uploadFile = $_FILES['uploadFile']['tmp_name'] ?? null;
    $config = json_decode(file_get_contents('../config.json'), true);

    function resetDatabase($database){
        // Drop all data tables in the database
        $database->query("SET FOREIGN_KEY_CHECKS=0");
        $tableList = $database->query("SHOW TABLES")->fetch_all(MYSQLI_NUM);
        foreach ($tableList as $table) {
            $database->query("DROP TABLE IF EXISTS `$table[0]`");
        }
        $database->query("SET FOREIGN_KEY_CHECKS=1");
    }

    //1) Set sql source depend on create option
    if ($option == "import") {
        $sql = file_get_contents($uploadFile);
    } else if ($option == "create") {
        $sql = file_get_contents("../../assets/file/graduationDB-empty.sql");
    } else {
        $response->status = "error";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "ตัวเลือกการสร้างฐานข้อมูลไม่ถูกต้อง";

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $graduationDB->close();
        exit();
    }

    //Pass) Create database
    resetDatabase($graduationDB);
    if ($graduationDB->multi_query($sql) === TRUE) {
        //Update config.json
        $config['appStatus']['isDatabaseReady'] = true;

        $newConfig = json_encode($config, JSON_PRETTY_PRINT);
        file_put_contents('../config.json', $newConfig);

        $response->status = "success";
        $response->title = "ดำเนินการสำเร็จ";
        $response->text = "ระบบได้สร้างฐานข้อมูลใหม่แล้ว";
    } else {
        resetDatabase($graduationDB);

        //Update config.json
        $config['appStatus']['isDatabaseReady'] = false;

        $newConfig = json_encode($config, JSON_PRETTY_PRINT);
        file_put_contents('../config.json', $newConfig);

        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "ไม่สามารถสร้างฐานข้อมูลได้ : " . $graduationDB->error;
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    $graduationDB->close();
    exit();
?>