<div class="webmaster-stats">
    <form class="webmaster-stats__form" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="webmaster/stats/show">
        <h3>Статистика: <span class="webmaster-stats__offer-name"></span></h3>
        <div class="webmaster-stats__output">
            <div class="output__redirects"><span>Переходов: </span><span id="redirects"></span></div>
            <div class="output__costs"><span>Доход: </span><span id="costs"></span><span>₽</span></div>
        </div>
        <p>Временной период:</p>
        <div class="webmaster-stats__date">
            <div>
                <label for="datefrom">От:</label>
                <input type="date" name="datefrom" id="datefrom">
            </div>
            <div>
                <label for="dateto">До:</label>
                <input type="date" name="dateto" id="dateto">
            </div>
        </div>
        <p>"Оффер":</p>
        <div class="webmaster-stats__offers radiogroup"><?= $props['offers-list'] ?></div>
        <button type="submit">Обновить</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
</div>