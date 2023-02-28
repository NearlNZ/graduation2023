<?php
    //Get config from config.json 
    $config = json_decode(file_get_contents('config.json'), true);

    //Check if connect.php not exists
    if (!file_exists('../data/connect.php')) {
        $config['appDatabase'] = [
            'server' => null,
            'username' => null,
            'password' => null,
            'database' => null
        ];

        $config['appStatus'] = [
            'isConnectServer' => false,
            'isDatabaseReady' => false,
            'isAccountReady' => false
        ];
    } else {
        $config['appStatus']['isConnectServer'] = true;

        //Check if useraccount table exists in the database
        require_once('../data/connect.php');
        $sql = "SHOW TABLES LIKE 'useraccount';";
        $result = $graduationDB->query($sql);

        if ($result->num_rows == 0) {
            $config['appStatus']['isDatabaseReady'] = false;
            $config['appStatus']['isAccountReady'] = false;
        } else {
            $config['appStatus']['isDatabaseReady'] = true;

            //Check if there is an admin user account
            $sql = "SELECT userID from useraccount where userLevel = 'Admin';";
            $result = $graduationDB->query($sql);

            if ($result->num_rows == 0) {
                $config['appStatus']['isAccountReady'] = false;
            } else {
                $config['appStatus']['isAccountReady'] = true;
            }
        }
    }
    
    // Update config.json
    file_put_contents('config.json', json_encode($config, JSON_PRETTY_PRINT));

    // Convert appDatabase and appStatus arrays to objects
    $database = (object) $config['appDatabase'];
    $status = (object) $config['appStatus'];
?>