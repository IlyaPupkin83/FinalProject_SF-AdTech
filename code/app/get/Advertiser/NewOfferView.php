<div class="advertiser-new">
    <form class="advertiser-new__form" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="advertiser/offers/new">
        <label for="title">Название:</label>
        <input type="text" name="title" autocomplete="off" id="title" required="required">
        <label for="link">Ссылка: </label>
        <input type="text" name="link" autocomplete="off" id="link" required="required">
        <label for="cost">Стоимость перехода по ссылке (₽):</label>
        <input type="number" name="cost" id="cost" min="0.1" step="0.1" required="required">
        <label for="tematics">Тематика:</label>
        <select name="tematics[]" id="tematics" multiple="multiple" size="6" required="required"><?= $props['tematicsList'] ?></select>
        <div class="advertiser-new__image">
            <label class="image__label" for="image">
                <p>Изображение: <span class="label__filename"></span></p>
                <p class="label__icon">⇓</p>
            </label>
            <input class="image__button" type="file" name="image" id="image">
        </div>
        <button type="submit">Создать</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
</div>