<?php // /

session_start();

if( // sprawdzamy sesje / czy uzytkownik jest zalogowany
    isset( $_SESSION["userID"] )
){
    header("Location: /home/", true, 301);
    exit;
}
else{
    header("Location: /login/", true, 301);
    exit;
}