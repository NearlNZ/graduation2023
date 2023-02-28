<?php
    //Update config.json if connect.php not exists
    $config = json_decode(file_get_contents('config.json'), true);

    //Check if connect.php not create yet
    if(!file_exists('../data/connect.php')){
        $config['appDatabase'] = [
            'server' => null,
            'username' => null,
            'password' => null,
            'database' => null
        ];
        $config['appStatus'] = [
            'isConnectServer' => false,
            'isDatabaseReady' => false
        ];
    }
    
    //Update config.json
    $newConfig = json_encode($config, JSON_PRETTY_PRINT);
    file_put_contents('config.json', $newConfig);

    $database = (object) $config['appDatabase'];
    $status = (object) $config['appStatus'];
?>