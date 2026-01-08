<?php // /login strona logowania/rejestracji
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank - Logowanie i Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container" id="login-form">
        <h1>Logowanie</h1>
        <form method="post" action="../api/login/">
            <label for="username">Nazwa użytkownika</label>
            <input type="text" id="login-input-username" name="username" placeholder="Wprowadź nazwę użytkownika" required>

            <label for="password">Hasło</label>
            <input type="password" id="login-input-password" name="password" placeholder="Wprowadź hasło" required>

            <input type="submit" value="Zaloguj się">
        </form>
        <div class="toggle-link">
            <a href="#register" onclick="toggleForms()">Nie masz konta? Zarejestruj się</a>
        </div>
    </div>

    <div class="auth-container" id="register-form" style="display: none;">
        <h1>Rejestracja</h1>
        <form method="post" action="../api/register/">
            <label for="username">Nazwa użytkownika</label>
            <input type="text" id="login-input-username" name="username" placeholder="Wprowadź nazwę użytkownika" required>

            <label for="password">Hasło</label>
            <input type="password" id="login-input-password" name="password" placeholder="Wprowadź hasło" required>

            <input type="submit" value="Zaloguj się">
        </form>
        <div class="toggle-link">
            <a href="#login" onclick="toggleForms()">Masz już konto? Zaloguj się</a>
        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>