<div class="webmaster-subscribe">
    <form class="webmaster-subscribe__tematics" action="/webmaster/subscribe" method="GET">
        <div class="tematics__select">
            <label for="tematic">Тематика:</label>
            <select name="tematic" id="tematic"><?= $props['tematics'] ?></select>
        </div>
        <button type="submit">Загрузить "офферы"</button>
    </form>
    <div class="webmaster-subscribe__offers"><?= $props['offers'] ?></div>
</div>