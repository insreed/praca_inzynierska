<?php
$env = parse_ini_file("../.env");
$db_host = $env["DB_HOST"];
$db_login = $env["DB_LOGIN"];
$db_password = $env["DB_PASSWORD"];
$db_database = $env["DB_DATABASE"];
$conn = new mysqli($db_host, $db_login, $db_password, $db_database);
mysqli_set_charset($conn, "utf8");