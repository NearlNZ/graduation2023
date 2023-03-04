<?php
    // Set the database information
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database_name = 'db_graduation';

    // Set the output file path and name
    $output_file = 'temp.sql';

    // Connect to the database
    $mysqli = new mysqli($host, $user, $password, $database_name);

    // Check for errors
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }

    // Fetch all tables in the database
    $tables = array();
    $result = $mysqli->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    // Loop through the tables and write the SQL statements to the output file
    $file = fopen($output_file, 'w');
    foreach ($tables as $table) {
        $result = $mysqli->query("SELECT * FROM $table");
        $num_fields = mysqli_num_fields($result);

        $table_create = $mysqli->query("SHOW CREATE TABLE $table");
        $table_create_row = $table_create->fetch_row();
        $table_create_sql = $table_create_row[1] . ";";

        fwrite($file, "\n" . $table_create_sql . "\n");

        while ($row = $result->fetch_row()) {
            $sql = "INSERT INTO $table VALUES (";
            for ($i = 0; $i < $num_fields; $i++) {
                $sql .= "'" . $mysqli->real_escape_string($row[$i]) . "'";
                if ($i < ($num_fields - 1)) {
                    $sql .= ",";
                }
            }
            $sql .= ");";
            fwrite($file, $sql . "\n");
        }
    }
    fclose($file);

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($output_file) . '"');
    header('Content-Length: ' . filesize($output_file));
    readfile($output_file);
    unlink($output_file);
?>