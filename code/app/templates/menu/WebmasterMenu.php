<button class="webmaster-menu__subscriptions">Подписки</button>
<button class="webmaster-menu__subscribe">Подписаться</button>
<button class="webmaster-menu__stats">Статистика</button>
<div class="hr"></div>
<form action="/" method="POST">
    <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
    <button class="webmaster-menu__logout" type="submit">Выйти</button>
</form>
<noscript><a href="/webmaster/subscriptions">
        <button class="webmaster-menu__subscriptions">Подписки</button></a><a href="/webmaster/subscribe">
        <button class="webmaster-menu__subscribe">Подписаться</button></a><a href="/webmaster/stats">
        <button class="webmaster-menu__stats">Статистика</button></a>
    <form action="/" method="POST">
        <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
        <button class="webmaster-menu__logout" type="submit">Выйти</button>
    </form>
</noscript>