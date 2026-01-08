<?php
function showPost($row){

    $id = $row["post_id"];
    $title = $row['title'];
    $content = $row['content'];

    echo '
        <div class="post">
            <h3 class="post-title"><a href="../post/?id=' . $id . '">' . $title . '</a></h3>
            <p class="post-content">' . $content . '</p>
        </div>
    ';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    </a>
</body>
</html>