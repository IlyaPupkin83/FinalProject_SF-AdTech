<form class="authform" action="/" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="route" value="signin">
    <label for="login">Логин:</label>
    <input class="authform__login" type="text" name="login" id="login" required="required">
    <label for="password">Пароль:</label>
    <input class="authform__password" type="password" name="password" id="password" required="required">
    <button type="submit">Войти</button>
    <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
</form>