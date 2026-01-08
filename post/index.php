<?php
require_once("../api/db.php");
require_once("../components/post.php");
require_once("../components/heading.php");
require_once("../components/backButton.php");

    $id = $_GET["id"];

    $conn = db_connect();

    $stmt = mysqli_prepare($conn, "SELECT * FROM posts WHERE post_id = ?");

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $post = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <? echo mysqli_num_rows($result); ?>
    
    <?php heading("Post"); ?>

    <main>
            <?php showPost($post); ?>
            <?php backButton(); ?>
    </main>

</body>
</html>