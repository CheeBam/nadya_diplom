<div>

    <h3 class="text-center mb-3">Категорія <?=$category['title']?></h3>

    <div>
        <ul class="nav nav-pills nav-fill mb-3" id="myTab" role="tablist">
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
                <?php foreach($shop['products'] as $chunk): ?>
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
                                            <a class="btn btn-primary" href="#"><i class="fas fa-trophy"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <br/>
                <?php endforeach; ?>
            </div>
            <?php $i++; endforeach;?>
        </div>
    </div>



</div>
