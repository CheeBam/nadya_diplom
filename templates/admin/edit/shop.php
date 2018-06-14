<div>
    <form class="form" action="/handlers/admin.php" method="post">
        <div class="form-group">
            <label for="title">Имя</label>
            <input class="form-control" type="text" name="title" id="title" value="<?=$shop['title']?>">
        </div>

        <div class="form-group">
            <label for="api">Шлях до API</label>
            <input class="form-control" type="text" name="api" id="api" value="<?=$shop['path']?>">
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="active" name="is_active" <?=$shop['enabled'] == '1' ? 'checked' : ''?>>
            <label class="form-check-label" for="active">Активна</label>
        </div>

        <input type="hidden" name="id" value="<?=$shop['id']?>">
        <input type="hidden" name="operation_type" value="update_shop">

        <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
</div>
