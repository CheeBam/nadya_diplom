<h3 class="text-center mb-3">Товари магазину <?=$shop['title']?></h3>
<div>
    <?php foreach($content as $chunk): ?>
    <div class="row">
        <?php foreach($chunk as $item): ?>
            <div class="col-md-4 text-center">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" height="180" src="<?=$item->image?>" alt="Зображення відсутне">
                    <div class="card-body">
                        <h5 class="card-title"><?=$item->brand->title?> <?=$item->title?></h5>
                        <p class="card-text"><?=$item->description?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Категорiя: <?=$item->category->title?></li>
                        <li class="list-group-item">Середня цiна: <?=$item->avg_price?></li>
                        <li class="list-group-item">Продано за весь час: <?=count($item->purchases)?> </li>
                    </ul>
                    <div class="card-body">
                        <div style="margin: 10px 0">
                            <a class="btn btn-primary" href="/product.php?id=<?=$item->id?>&shop=<?=$shop['title']?>"><i class="fas fa-shopping-cart"></i></a>
                            <span style="width: 30px; display: inline-block"></span>
                            <a class="btn btn-primary" href="/product-all.php?name=<?=$item->title?>"><i class="fas fa-trophy"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br/>
    <?php endforeach; ?>
</div>

