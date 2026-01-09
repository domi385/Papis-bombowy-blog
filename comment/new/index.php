<?php // /comment/new/index.php

session_start();

if( !isset( $_SESSION["userID"] ) ){
    header("../../?error=not_logged_in", true, 301);
    exit;
}

require_once("../../api/db.php");

$conn = db_connect();

$content = trim($_POST["content"]) ?? '';
$post_id = trim($_POST["post_id"]) ?? '';

if( $content == '' || $post_id == '' ){
    header("../../post/?id=" . $post_id . "&error=empty_content", true, 301);
    exit;
}

if( strlen($content) > 1000 ){
    header("../../post/?id=" . $post_id . "&error=content_too_long", true, 301);
    exit;
}

$user_id = $_SESSION["userID"];
$post_id = (int)$post_id;

$stmt = mysqli_prepare($conn, "INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "iis", $user_id, $post_id, $content);
mysqli_stmt_execute($stmt);

if( !$stmt ){
    die("Error: " . mysqli_error($conn));
}

mysqli_close($conn);

header("Location: ../../post/?id=" . $post_id, true, 301);
exit;
