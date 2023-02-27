<?php
    function resetDatabase($database) {
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

    header('Content-Type: application/json; charset=utf-8');
    $response = new stdClass();
    require_once("../../data/connect.php");
    
    $fileType = $_POST['uploadType'];
    $uploadFile = $_FILES['uploadFile']['tmp_name'];
    $config = json_decode(file_get_contents('../config.json'), true);

    resetDatabase($graduationDB);

    if($fileType = ".sql"){
        //Import .sql data
        $sql_contents = file_get_contents($uploadFile);
        $sql_queries = explode(';', $sql_contents);

        $errorMessage = "";
        $errorCount = 0;
        $count = 0;
        foreach ($sql_queries as $sql){
            if ($sql != "") {
                if ($graduationDB->query($sql) === FALSE){
                    $errorCount++;
                    $errorMessage = $graduationDB->error;
                    break;
                }else{
                    $count++;
                }
            }
        }

        if($errorCount > 0 && $errorMessage != 'Query was empty'){
            resetDatabase($graduationDB);

            //Update config.json
            $config['appStatus'] = [
                'isConnectServer' => true,
                'isDatabaseReady' => false
            ];

            $newConfig = json_encode($config, JSON_PRETTY_PRINT);
            file_put_contents('../config.json', $newConfig);

            $response->status = "warning";
            $response->title = "เกิดข้อผิดพลาด";
            $response->text = $errorMessage;
        }else{
            //Update config.json
            $config['appStatus'] = [
                'isConnectServer' => true,
                'isDatabaseReady' => true
            ];

            $newConfig = json_encode($config, JSON_PRETTY_PRINT);
            file_put_contents('../config.json', $newConfig);

            $response->status = "success";
            $response->title = "ดำเนินการสำเร็จ";
            $response->text = $count." Queries ถูกดำเนินการในการนำเข้าข้อมูลครั้งนี้";
        }
    }
    else if($fileType = ".xlsx"){
        //Import .sql data
    }else{
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "ประเภทไฟล์ข้อมูลไม่ถูกต้อง รองรับไฟล์ .sql และ .xlsx เท่านั้น";
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    $graduationDB->close();
    exit();
?>