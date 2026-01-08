<?php // /api/db.php
require_once(__DIR__ . '/../load_env.php');
function db_connect()
{
    $host = $_ENV["DB_HOST"];
    $user = $_ENV["DB_USER"];
    $pass = $_ENV["DB_PASS"];
    $db = $_ENV["DB_NAME"];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect($host, $user, $pass, $db);

    // README
    /* 
    Taka sprawa, że niby nie zrobiłem ani die() ani exit(), ale i tak wywali,
    bo jest mysqli_report
    */

    return $conn;
}