<div class="admin-system">
    <form class="admin-system__stats-form" action="" method="POST" enctype="multipart/form-data">
        <p>Статистика:</p>
        <input type="hidden" name="route" value="admin/system/Stats">
        <div>
            <label for="datefrom">От:</label>
            <input type="date" name="datefrom" id="datefrom">
        </div>
        <div>
            <label for="dateto">До:</label>
            <input type="date" name="dateto" id="dateto">
        </div>
        <button type="submit">Обновить</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
    <div class="admin-system__stats-output">
        <div class="stats-output__links">
            <label>Кол-во выданных ссылок: </label>
            <p class="links__output"></p>
        </div>
        <div class="stats-output__redirects">
            <label>Кол-во переходов: </label>
            <p class="redirects__output"></p>
            <div class="stats-output__rejections"> </div>
            <label>Кол-во отказов: </label>
            <p class="rejections__output"></p>
            <div class="stats-output__income"> </div>
            <label>Суммарный доход системы:</label>
            <p class="income__output"></p>
        </div>
    </div>
</div>