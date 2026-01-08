<?php // /home strona glowna
session_start();
if( !isset( $_SESSION["userID"] ) ){
    header("../?error=not_logged_in", true, 301);
    exit;
}

require_once("../api/db.php");
require_once("../components/heading.php");
require_once("../components/footer.php");
require_once("../components/post.php");

$conn = db_connect();

$userID = $_SESSION["userID"];

$posts = mysqli_query($conn, "SELECT * FROM posts ORDER BY post_id DESC");

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
    <?php heading("Strona Główna"); ?>

    <main>

        <?php while ( $row = mysqli_fetch_assoc( $posts ) ): ?>

            <?php showPost($row); ?>

        <?php endwhile; ?>

    </main>

</body>
</html>