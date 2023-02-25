<?php
	$server='localhost';
	$username='root';
	$password='';
	$database='graduationTemp';
	$graduationDB = new mysqli($server, $username, $password, $database);
	if($graduationDB->connect_error) die('<br>'.$graduationDB->connect_error);
	$graduationDB->query('SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci');
	$graduationDB->query('SET character_set_results=utf8');
	$graduationDB->query('SET character_set_client=utf8');
	$graduationDB->query('SET character_set_connection=utf8');
	date_default_timezone_set('Asia/Bangkok');
?>