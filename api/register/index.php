<?php // /api/register

use Dom\Mysql;

require_once("../db.php");

$conn = db_connect();

$username = trim($_POST["username"]) ?? '';
$password = trim($_POST["password"]) ?? '';

if( $username == '' || $password == '' ){
    header("Location: ../../?error=username_or_password_empty", true, 301);
    exit;
}  
if( strlen($username) > 20 ){
    header("Location: ../../?error=username_too_long", true, 301);
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT username FROM users where username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if( mysqli_num_rows($result) > 0 ){
    header("Location: ../../?error=username_already_taken", true, 301);
    exit;
}

$cost = $_ENV["BCRYPT_ROUNDS"] ?? 12;
$hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => $cost]);

$stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);
mysqli_stmt_execute($stmt);

$stmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);

$userID = $row['user_id'];

session_start();
$_SESSION["userID"] = $userID;

mysqli_close($conn);

header("Location: ../../home/", true, 301);
exit;