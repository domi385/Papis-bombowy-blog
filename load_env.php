<?php // load_env.php
$lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue; // komentarz
    list($name, $value) = explode('=', $line, 2);
    $_ENV[trim($name)] = trim($value);
}
