<button class="admin-menu__system">Система</button>
<button class="admin-menu__users">Пользователи</button>
<button class="admin-menu__tematic">Тематики</button>
<div class="hr"></div>
<form action="/" method="POST">
    <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
    <button class="admin-menu__logout" type="submit">Выйти</button>
</form>
<noscript><a href="/admin/system">
        <button class="admin-menu__system">Система</button></a><a href="/admin/users">
        <button class="admin-menu__users">Пользователи</button></a><a href="/admin/tematic">
        <button class="admin-menu__tematic">Тематики</button></a>
    <form action="/" method="POST">
        <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
        <button class="admin-menu__logout" type="submit">Выйти</button>
    </form>
</noscript>