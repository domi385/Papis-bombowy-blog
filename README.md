# Przygotowanie
Ustawić dane w .env, żeby połączyć się z bazą danych

# Lista endpointów
- / (http://localhost/) - jeśli użytkownik jest zalogowany - przenosi na /home, jeśli nie - to na /login
- /home - strona główna
- /login - strona logowania/rejestracji
- /logout - wylogowanie, konkretnie to zamknięcie sesji

### /post/ - pliki do obsługi wyświetlania podstrony posta i formularza do tworzenia nowych
- /post/new - formularz do tworzenia nowego posta
- /post/?id={$post_id} - podstrona konkretnego posta

### /api/ - pliki do obsługi bazy danych
- /api/db.php - plik z funkcją db_connect do łączenia z bazą danych
- /api/login - logika logowania
- /api/register - logika rejestracji (no shit, who would have thought)