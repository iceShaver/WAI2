<?php defined('RUNNING') or die("Access violation"); ?>
<form action="/auth/login" method="post">
    <label for="userName">Nazwa użytkownika:</label><br/>
    <input type="text" name="userName" id="userName" value="<?php safePrint($output['loginForm']['userName']); ?>" /><br/>
    <label for="password">Hasło:</label><br/>
    <input type="password" name="password" id="password" />
    <!--<input type="hidden" name="action" value="login" /><br /><br />-->
    <input type="submit" value="Zaloguj się" />
</form>
<br/>
<a href="/auth/newuser">Zarejestruj się</a>
<a href="/gallery/indexsavedpictures">Zapisane w tej sesji</a>