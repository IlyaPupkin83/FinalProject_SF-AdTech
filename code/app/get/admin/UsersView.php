<div class="admin-users">
    <form class="admin-users__ban" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="admin/users/Ban">
        <label for="banUser">Имя пользователя</label>
        <input type="text" name="name" autocomplete="off" id="banUser" required="required">
        <button type="submit">Заблокировать</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
    <form class="admin-users__no-auth" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="route" value="admin/users/Auth">
        <p>Неавторизованные пользователи:</p>
        <select name="noauth[]" multiple="multiple" size="10" required="required"><?= $props['noAuthList'] ?></select>
        <button type="submit" name="route" value="admin/users/Auth">Разрешить</button>
        <input type="hidden" name="csrf" value="<?= $props['token'] ?>">
    </form>
</div>