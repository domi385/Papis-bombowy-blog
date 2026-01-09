<?php
function heading($title){
    $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';

    $newPost = $_SESSION["role"] == 'admin' ? "<a href='../post/new/'>Nowy post</a>" : "";

    echo "
        <header>
            <h1>$title</h1>
            <div class='header-right'>
                <span>User: $username </span>

                $newPost  
                
                <a href='../../'>Strona główna</a>

                <a href='../logout/' class='logout-btn'>Wyloguj</a>
            </div>
        </header>
    ";
}