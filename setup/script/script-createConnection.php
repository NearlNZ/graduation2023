<?php
    header('Content-Type: application/json; charset=utf-8');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $response = new stdClass();

    $server = $_POST['server'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];

    try {
        //Try to connect database
        $conn = new mysqli($server, $username, $password, $database);
        $conn->close();

        //Create database connection file
        $file = '../../data/connect.php';
        $content =  
            "<?php" .
            "\n\t\$server='$server';" .
            "\n\t\$username='$username';" .
            "\n\t\$password='$password';" .
            "\n\t\$database='$database';" .
            "\n\t\$graduationDB = new mysqli(\$server, \$username, \$password, \$database);" .
            "\n\tif(\$graduationDB->connect_error) die('<br>'.\$graduationDB->connect_error);" .
            "\n\t\$graduationDB->query('SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci');" .
            "\n\t\$graduationDB->query('SET character_set_results=utf8');" .
            "\n\t\$graduationDB->query('SET character_set_client=utf8');" .
            "\n\t\$graduationDB->query('SET character_set_connection=utf8');" .
            "\n\tdate_default_timezone_set('Asia/Bangkok');" .
            "\n?>";

        if (file_put_contents($file, $content) === false) {
            $response->status = "warning";
            $response->title = "เกิดข้อผิดพลาด";
            $response->text = "ไม่สามารถสร้างการเชื่อมต่อกับฐานข้อมูลโดยอัติโนมัติได้";
        } else {
            //Update config.json
            $config = json_decode(file_get_contents('../config.json'), true);
            $config['appDatabase'] = [
                'server' => $server,
                'username' => $username,
                'password' => $password,
                'database' => $database
            ];
            $config['appStatus']['isConnectServer'] = true;

            $newConfig = json_encode($config, JSON_PRETTY_PRINT);
            file_put_contents('../config.json', $newConfig);

            $response->status = "success";
            $response->title = "เชื่อมต่อสำเร็จ";
            $response->text = "ระบบกำลังสร้างการเชื่อมต่อกับฐานข้อมูล";
        }
    } catch (mysqli_sql_exception $e) {
        $response->status = "warning";
        $response->title = "เกิดข้อผิดพลาด";
        $response->text = "ไม่สามารถสร้างการเชื่อมต่อกับฐานข้อมูลได้ โปรดตรวจสอบข้อมูลการเชื่อมต่อและลองใหม่อีกครั้ง";
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();
?>