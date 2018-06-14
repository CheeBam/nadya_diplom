<div>
    <h3 class="text-center">Категорії</h3>

    <div>
        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
<!--        <ul class="nav nav-tabs" id="myTab" role="tablist">-->
            <?php $i = 0; foreach($shops as $shop): ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($i === 0) echo 'active'; ?>" id="shop-tab-<?=$shop['id']?>" data-toggle="tab" href="#shop<?=$shop['id']?>" role="tab" aria-controls="shop<?=$shop['id']?>" aria-selected="true"><?=$shop['title']?></a>
                </li>
            <?php $i++; endforeach;?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php $i = 0; foreach($shops as $shop): ?>
                <div class="tab-pane fade <?php if ($i === 0) echo 'show active'; ?>" id="shop<?=$shop['id']?>" role="tabpanel" aria-labelledby="shop-tab-<?=$shop['id']?>">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Назва</th>
                            <th scope="col">Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($shop['categories'] as $category): ?>
                                <tr>
                                    <th scope="row"><?= $category->id ?></th>
                                    <td><?= $category->title ?> </td>
                                    <td>
                                        <a class="add-category-link"
                                           data-category="<?=$category->title?>"
                                           data-id="<?=$category->id?>" href="#">
                                            <i class="far fa-plus-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php $i++; endforeach;?>
        </div>
    </div>

    <h2 class="text-center">Обрані категорії</h2>

    <div id="own-table">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Назва</th>
                <th scope="col">Статус</th>
                <th scope="col">Дії</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($categories as $category): ?>
                <tr>
                    <th scope="row"><?= $category['id'] ?></th>
                    <td><?= $category['title'] ?> </td>
                    <td><?= $category['enabled'] ?></td>
                    <td>
                        <a class="<?= $category['enabled'] === '1' ? 'disable' : 'enable'?>-category-link"
                           data-category="<?=$category['title']?>"
                           data-id="<?=$category['id']?>" href="#">
                            <i class="fas fa-toggle-<?= $category['enabled'] === '1' ? 'on' : 'off'?>"></i>
                        </a>
                        <span style="width: 10px; display: inline-block;"></span>
                        <a class="delete-category-link"
                           data-category="<?=$category['title']?>"
                           data-id="<?=$category['id']?>" href="#">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $('.delete-category-link').click(function(e) {
        e.preventDefault();
        const self = $(this);
        const reallyDelete = confirm('Действительно удалить категорию ' + self.data('category'));
        if (reallyDelete) {
            $.post({
                url: "/handlers/admin.php",
                data: {
                    operation_type: 'delete_category',
                    category_id: self.data('id')
                }
            }).done(function(data) {
                if (data.response) {
                    self.parent().parent().remove();
                }
            });
        }
    });

    $('#own-table').on("click", ".enable-category-link", function (e) {
        e.preventDefault();
        const self = $(this);
        $.post({
            url: "/handlers/admin.php",
            data: {
                operation_type: 'enable_category',
                category_id: self.data('id')
            }
        }).done(function(data) {
            if (data.response) {
                // self.parent().prev().html('1');
                // self.children().removeClass('fa-toggle-off').addClass('fa-toggle-on');
                location.reload();
            }
        });
    });

    $(document).on("click", ".disable-category-link", function (e) {
        e.preventDefault();
        const self = $(this);
        $.post({
            url: "/handlers/admin.php",
            data: {
                operation_type: 'disable_category',
                category_id: self.data('id')
            }
        }).done(function(data) {
            if (data.response) {
                // self.parent().prev().html('0');
                // self.children().removeClass('fa-toggle-on').addClass('fa-toggle-off');
                location.reload();
            }
        });
    });

    $('.add-category-link').click(function(e) {
        e.preventDefault();
        const self = $(this);
        $.post({
            url: "/handlers/admin.php",
            data: {
                operation_type: 'add_category',
                category_title: self.data('category')
            }
        }).done(function(data) {
            if (data) {
                if (data.response === 0) {
                    alert('Така категорія вже записана!');
                } else {
                    location.reload();
                }
            }
        });
    });


</script>
