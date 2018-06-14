<div>
    <h3 class="text-center mt-4 mb-4">Налаштування контенту головної сторінки</h3>

    <?php foreach ($content as $chunk): ?>
        <div class="row">
            <?php foreach ($chunk as $item): ?>
                <div class="col-md-6">
                    <div class="jumbotron">
                        <h5 class="display-6"><?=strtoupper($item['title'])?></h5>
                        <p class="lead"><?=$item['description']?></p>
                        <hr class="my-4">
                        <p class="lead">
                            <a class="btn btn-<?= $item['enabled'] === '1' ? 'danger' : 'primary'; ?> btn-lg setting-button"
                               href="#" role="button" data-enabled="<?= $item['enabled']?>" data-id="<?= $item['id']?>">
                                <?= $item['enabled'] === '1' ? 'Приховувати' : 'Показувати'; ?>
                            </a>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>

<script>

    $('.setting-button').on('click', function (e) {
        e.preventDefault();
        const self = $(this);
        if (!self.data('enabled')) {
            $.post({
                url: "/handlers/admin.php",
                data: {
                    operation_type: 'enable_main_content',
                    content_id: self.data('id')
                }
            }).done(function(data) {
                if (data.response) {
                    location.reload();
                }
            });
        } else {
            $.post({
                url: "/handlers/admin.php",
                data: {
                    operation_type: 'disable_main_content',
                    content_id: self.data('id')
                }
            }).done(function(data) {
                if (data.response) {
                    location.reload();
                }
            });
        }
    });

</script>

