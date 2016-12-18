<form action="?auth" method="post">
    <fieldset>
        <legend>Podaj swoje dane</legend>
        <label for="userName">Nazwa użytkownika:</label><br/>
        <input type="text" id="userName" name="userName" value="<?php  safePrint($output['registerForm']['userName']); ?>" /><br/>
        <label for="email">Adres e-mail:</label><br/>
        <input type="email" id="email" name="email" value="<?php  safePrint($output['registerForm']['email']); ?>" />
<br />
        <label for="password">Hasło:</label><br />
        <input type="password" id="password" name="password" />
<br />
        <label for="password2">Powtórz hasło:</label><br />
        <input type="password" id="password2" name="password2" />
<br />
        <input type="hidden" name="action" value="register" />
<br />
        <input type="submit" value="Zarejestruj" />
    </fieldset>
</form>