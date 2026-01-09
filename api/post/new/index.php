<?php // /api/post/new

session_start();

if( !isset( $_SESSION["userID"] ) ){
    header("../../../?error=not_logged_in", true, 301);
    exit;
}

require_once("../../db.php");

$conn = db_connect();

$title = trim($_POST["title"]) ?? '';
$content = trim($_POST["content"]) ?? '';

if( $title == '' || $content == '' ){
    header("../../../post/new/?error=empty_fields", true, 301);
    exit;
}

if( strlen($title) > 50 ){
    header("../../../post/new/?error=title_too_long", true, 301);
    exit;
}

if( strlen($content) > 10000 ){
    header("../../../post/new/?error=content_too_long", true, 301);
    exit;
}

$stmt = mysqli_prepare($conn, "INSERT INTO posts (title, content, category) VALUES (?, ?, 1)");
mysqli_stmt_bind_param($stmt, "ss", $title, $content);
mysqli_stmt_execute($stmt);

if( !$stmt ){
    die("Error: " . mysqli_error($conn));
}

mysqli_close($conn);

header("Location: ../../../home/", true, 301);
exit;
