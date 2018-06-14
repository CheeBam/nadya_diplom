<div>
    <h3 class="text-center mb-3">Список магазинів</h3>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Назва</th>
            <th scope="col">API шлях</th>
            <th scope="col">Статус</th>
            <th scope="col">Дії</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($shops as $item): ?>
        <tr>
            <th scope="row"><?= $item['id'] ?></th>
            <td><?= $item['title'] ?> </td>
            <td><?= $item['path'] ?></td>
            <td><?= $item['enabled'] ?></td>
            <td>
                <a href="/admin/edit/shop.php?id=<?= $item['id'] ?>">
                    <i class="fas fa-edit"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
