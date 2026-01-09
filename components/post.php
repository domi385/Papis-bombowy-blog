<?php
function showPostSite($row){

    $id = $row['post_id'];
    $title = $row['title'];
    $date = $row['created_at'];
    $content = $row['content'];

    echo '
        <div class="post">
            <h1 class="post-title">' . htmlspecialchars($title) . '</h1>
            <h3>' . $date . '</h3>
            <p class="post-content">' . htmlspecialchars($content) . '</p>
        </div>
    ';
    
    // Display comments
    showComments($id);
    
    // Display comment form
    echo '
        <div class="comment-form-container">
            <h3>Dodaj komentarz</h3>
            <form method="POST" action="../comment/new/" class="comment-form">
                <input type="hidden" name="post_id" value="' . $id . '">
                <textarea name="content" required placeholder="Wpisz swój komentarz..." rows="4"></textarea>
                <button type="submit" class="submit-btn">Dodaj komentarz</button>
            </form>
        </div>
    ';
}

function showComments($post_id){
    require_once(__DIR__ . "/../api/db.php");
    $conn = db_connect();
    
    $stmt = mysqli_prepare($conn, "SELECT c.comment_id, c.user_id, c.content, c.created_at, u.username FROM comments c JOIN users u ON c.user_id = u.user_id WHERE c.post_id = ? ORDER BY c.created_at DESC");
    mysqli_stmt_bind_param($stmt, "i", $post_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    echo '<div class="comments-section">';
    
    if( mysqli_num_rows($result) > 0 ){
        echo '<h3>Komentarze</h3>';
        while( $row = mysqli_fetch_assoc($result) ){
            echo '
                <div class="comment">
                    <div class="comment-header">
                        <span class="comment-author">' . htmlspecialchars($row['username']) . '</span>
                        <span class="comment-date">' . $row['created_at'] . '</span>
                    </div>
                    <p class="comment-content">' . htmlspecialchars($row['content']) . '</p>
                </div>
            ';
        }
    } else {
        echo '<p class="no-comments">Brak komentarzy. Bądź pierwszy!</p>';
    }
    
    echo '</div>';
    mysqli_close($conn);
}

function showPost($row){

    $id = $row['post_id'];
    $title = $row['title'];
    $date = $row['created_at'];

    echo '
        <div class="post">
            <h1 class="post-title"><a href="../post/?id=' . $id . '">' . $title . '</a></h1>
            <h3>' . $date . '</h3>
        </div>
    ';
}
?>