<div class="admin-tematic">
    <form class="admin-tematic__new" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="admin/tematic/New">
        <label for="newTematic">Тематика</label>
        <input type="text" name="name" autocomplete="off" id="newTematic" required="required">
        <button type="submit">Создать</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
    <form class="admin-tematic__del" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="admin/tematic/Del">
        <p> Список тематик:</p>
        <select name="tematics[]" multiple="multiple" size="10" required="required">
            <?= $props['tematics'] ?></select>
        <button type="submit">Удалить</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
</div>