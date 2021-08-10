<form class="registryform" action="/" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="route" value="signup" required="required">
    <label for="login">Логин:</label>
    <input type="text" name="login" id="login">
    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required="required">
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" required="required">
    <label for="role">Кем Вы являетесь:</label>
    <div class="radiogroup" id="role">
        <input type="radio" name="role" value="Webmaster" id="webmaster" checked="checked">
        <label for="webmaster">Веб-мастер</label>
        <input type="radio" name="role" value="Advertiser" id="advertiser">
        <label for="advertiser">Рекламодатель</label>
    </div>
    <button type="submit">Регистрация</button>
    <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
</form>