<?php
    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../../data/connect.php");

    $option = $_POST['option'];
    $uploadFile = $_FILES['uploadFile']['tmp_name'] ?? null;
    $config = json_decode(file_get_contents('../config.json'), true);

    function resetDatabase($database){
        // Drop all data tables in the database
        $database->query("SET FOREIGN_KEY_CHECKS=0");
        $tables = array();
        $result = $database->query("SHOW TABLES");
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $tables[] = $row[0];
        }
        foreach ($tables as $table) {
            $database->query("DROP TABLE IF EXISTS `$table`");
        }
        $database->query("SET FOREIGN_KEY_CHECKS=1");
    }

    resetDatabase($graduationDB);

    if ($option == "import") {
        //Import data from uploaded file
        $sql = file_get_contents($uploadFile);
    } else {
        //Create new empty database
        $sql = file_get_contents("../../assets/file/graduationDB-empty.sql");
    }

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