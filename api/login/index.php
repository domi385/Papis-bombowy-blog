<?php // /api/login
require_once("../../api/db.php"); // zeby byl db_connect()

$conn = db_connect(); // z /api/index.php

$username = $_POST["username"];
$password = $_POST["password"];

if($username == "" || $password == ""){
    header("Location: ../?error=username_or_password_empty", true, 301);
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT user_id, password, role, username FROM users WHERE username = ?");

mysqli_stmt_bind_param($stmt, "s", $username);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if( mysqli_num_rows($result) == 0 ){
    header("Location: ../../login/?error=username_not_found", true, 301);
    exit;
}

$row = mysqli_fetch_assoc($result);

mysqli_close($conn);

if( password_verify( $password, $row['password'] ) )
{
    session_start();

    $_SESSION["userID"] = $row['user_id'];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = $row["role"];

    header("Location: ../../home/", true, 301);
    exit;
}
else
{
    header("Location: ../../login/?error=wrong_password", true, 301);
    exit;
}