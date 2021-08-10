<div class="advertiser-offers">
    <input type="hidden" name="csrf" id="csrf" value="<?= $props['token'] ?>">
    <div class="advertiser-offers__enable">
        <p class="enable__title">Активные "офферы"</p><?= $props['offers-list'] ?>
    </div>
    <div class="advertiser-offers__disable" action="" method="POST">
        <p class="disable__title">Неактивные "офферы"</p><?= $props['disable-list'] ?>
    </div>
</div>