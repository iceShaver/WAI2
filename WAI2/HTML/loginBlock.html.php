<form action="?module=auth" method="post">
    <label for="userName">Nazwa użytkownika:</label><br/>
    <input type="text" name="userName" id="userName" /><br/>
    <label for="password">Hasło:</label><br/>
    <input type="password" name="password" id="password" />
    <input type="hidden" name="action" value="login" /><br />
    <input type="submit" value="Zaloguj się" />
</form>