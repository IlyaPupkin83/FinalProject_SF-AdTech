<button class="advertiser-menu__offers">Мои "офферы"</button>
<button class="advertiser-menu__new">Создать "оффер"</button>
<button class="advertiser-menu__statistic">Статистика</button>
<div class="hr"></div>
<form action="/" method="POST">
    <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
    <button class="advertiser-menu__logout" type="submit">Выйти</button>
</form>
<noscript><a href="/advertiser/offers">
        <button class="advertiser-menu__offers">Мои "офферы"</button></a><a href="/advertiser/new">
        <button class="advertiser-menu__new">Создать "оффер"</button></a><a href="/advertiser/statistic">
        <button class="advertiser-menu__statisti">Статистика</button></a>
    <form action="/" method="POST">
        <input type="hidden" name="route" value="signout" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
        <button class="advertiser-menu__logout" type="submit">Выйти</button>
    </form>
</noscript>