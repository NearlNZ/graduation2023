<?php
    //Update config.json if connect.php not exists
    $config = json_decode(file_get_contents('config.json'), true);

    if(!file_exists('../data/connect.php')){
        $config['databaseConnection'] = [
            'server' => '',
            'username' => '',
            'password' => '',
            'database' => ''
        ];
        $config['configurationSteps'] = [
            'connectDatabase' => false,
            'importData' => false
        ];

        $newConfig = json_encode($config, JSON_PRETTY_PRINT);
        file_put_contents('config.json', $newConfig);
    }

    $server = $config['databaseConnection']['server'];
    $username = $config['databaseConnection']['username'];
    $password = $config['databaseConnection']['password'];
    $database = $config['databaseConnection']['database'];
    
    $connectDatabase = $config['configurationSteps']['connectDatabase'];
    $importData = $config['configurationSteps']['importData'];
?>