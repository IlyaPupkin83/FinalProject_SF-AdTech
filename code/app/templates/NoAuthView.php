<div class="noAuth">
	<p>Уважаемый(ая) <?= $_SESSION['user'] ?>, Ваша учетная запись проверяется администратором. Зайдите позже!</p></br>
	<p>Обновить статус:</p>

	<form action="/" method="POST" class="noAuth__form">
		<input type="hidden" name="route" value="RefreshAuth" /><input type="hidden" name="csrf" value="<?= $props['token'] ?>" />
		<button class="noAuth__refresh" type="submit">Обновить</button>
	</form>
</div>