<?php // /post/new/index.php - create new post
session_start();
if( !isset( $_SESSION["userID"] ) ){
    header("../../../?error=not_logged_in", true, 301);
    exit;
}

require_once("../../api/db.php");
require_once("../../components/heading.php");
require_once("../../components/footer.php");

$conn = db_connect();
$categories = mysqli_query($conn, "SELECT * FROM categories");
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy Post</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    
    <?php heading("Nowy Post"); ?>

    <main>
        <div class="new-post-container">
            <form method="POST" action="../../api/post/new/" class="new-post-form">
                <div class="form-group">
                    <label for="title">Tytuł:</label>
                    <input type="text" id="title" name="title" required placeholder="Wpisz tytuł posta">
                </div>

                <div class="form-group">
                    <label for="content">Treść:</label>
                    <textarea id="content" name="content" required placeholder="Wpisz treść posta" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="category">Kategoria:</label>
                    <select id="category" name="category" required>
                        <option value="">-- Wybierz kategorię --</option>
                        <?php while ( $row = mysqli_fetch_assoc( $categories ) ): ?>
                            <option value="<?php echo $row['category_id']; ?>">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Dodaj Post</button>
                <a href="../../home/" class="cancel-btn">Anuluj</a>
            </form>
        </div>
    </main>

    <?php footer(); ?>

</body>
</html>
