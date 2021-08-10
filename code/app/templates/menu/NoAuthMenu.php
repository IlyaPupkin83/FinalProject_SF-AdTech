<form action="/" method="POST">
    <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
    <button class="noAuth-menu__logout" type="submit">Выйти</button>
</form>