<div>
    <form action="/" method="get">
    <h3 class="text-center">Головна сторінка</h3>
        <hr/>

        <div class="row">
            <input type="hidden" name="dates" value="true">
            <div class="offset-md-1 col-md-3">
                <label for="from">Дата початку</label>
                <input type="text" id="from" name="from" value="<?=$time_from?>"class="form-control" aria-label="from" aria-describedby="basic-addon1" required>
            </div>
            <div class="col-md-3">
                <label for="to">Дата кінця</label>
                <input type="text" id="to" name="to" value="<?=$time_to?>" class="form-control" aria-label="to" aria-describedby="basic-addon1" required>
            </div>
            <div class="col-md-2" style="margin-top: 31px;">
                <label for="date-button"> </label>
                <input type="submit" id="date-button" class="btn btn-primary" value="Отримати дані">
            </div>
            <div class="col-md-2" style="margin-top: 31px;">
                <label for="date-button"> </label>
                <input type="button" id="all-time-button" class="btn btn-success" value="За весь час">
            </div>
            <div class="col-md-1"></div>
        </div>
        <?php if ($parts['price_categories'] || $parts['count_categories']): ?>
            <hr class="mb-3"/>
            <h4 class="text-center mt-3 mb-3">Пошук по категорії</h4>
            <div class="row">
                <div class="col-md-2 mt-2 offset-md-1">
                    <label for="select-category">Виберіть категорію</label>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" id="select-category">
                            <option value="0">Не вибрано</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['title'] ?>"><?= $category['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 ml-3">
                    <button class="btn btn-primary" type="button" id="categories-button">Побудувати графік</button>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($parts['count_categories']): ?>
            <div id="count-categories-container">
                <hr class="mb-3"/>
                <div id="countCategories" style="height: 300px; width: 100%;"></div>
            </div>
        <?php endif; ?>
        <?php if ($parts['price_categories']): ?>
            <div id="price-categories-container">
                <hr class="mb-3"/>
                <div id="priceCategories" style="height: 300px; width: 100%;"></div>
            </div>
        <?php endif; ?>
        <?php if ($parts['count_names'] || $parts['price_names']): ?>
            <hr class="mb-3"/>
            <h4 class="text-center mt-3 mb-3">Пошук по товару</h4>
            <div class="row">
                <div class="col-md-3 mt-2 offset-md-1">
                    <label for="select-category">Введіть назву товару</label>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control" id="names-input">
                    </div>
                </div>
                <div class="col-md-2 ml-3">
                    <button class="btn btn-primary" type="button" id="names-button">Побудувати графік</button>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($parts['count_names']): ?>
            <div id="count-names-container">
                <hr class="mb-3"/>
                <div id="countNames" style="height: 300px; width: 100%;"></div>
            </div>
        <?php endif; ?>
        <?php if ($parts['price_names']): ?>
            <div id="price-names-container">
                <hr class="mb-3"/>
                <div id="priceNames" style="height: 300px; width: 100%;"></div>
            </div>
        <?php endif; ?>
        <?php if ($parts['top_products']): ?>
            <hr/>
            <h3 class="text-center mb-3">Топ продаж</h3>
            <div class="row">
                <?php foreach($top_products as $item): ?>
                    <div class="col-md-4 text-center">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" height="180" src="<?=$item->product->image?>" alt="Зображення відсутне">
                            <div class="card-body">
                                <h5 class="card-title"><?=$item->product->brand->title?> <?=$item->product->title?></h5>
                                <p class="card-text"><?=$item->product->description?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Категорiя: <?=$item->product->category->title?></li>
                               <!-- <li class="list-group-item">Середня цiна: <?=$item->avg_price?></li>-->
                                <li class="list-group-item">Продано: <?=$item->amount?> </li>
                            </ul>
                            <div class="card-body">
                                <div style="margin: 10px 0">
                                    <a class="btn btn-primary" href="/product.php?id=<?=$item->product->id?>&shop=<?=$item->shop?>"><i class="fas fa-shopping-cart"></i></a>
                                    <span style="width: 30px; display: inline-block"></span>
                                    <a class="btn btn-primary" href="/product-all.php?name=<?=$item->product->title?>"><i class="fas fa-trophy"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($parts['count_purchases']): ?>
            <hr class="mb-3"/>
            <div id="countPurchases" style="height: 300px; width: 100%;"></div>
        <?php endif; ?>
        <?php if ($parts['price_purchases']): ?>
            <hr class="mb-3"/>
            <div id="pricePurchases" style="height: 300px; width: 100%;"></div>
        <?php endif; ?>
        <?php if ($parts['count_month_purchases']): ?>
            <hr class="mb-3"/>
            <h4 class="text-center mb-3">Таблиця кількісті продаж по місяцям</h4>

            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col">Магазини\Місяці</th>
                    <?php foreach($count_month_purchases['dates'] as $date): ?>
                        <td scope="col"><?=$date['string']?></td>
                    <?php endforeach;?>
                    <th scope="col">Всього</th>
                </thead>
                <tbody>
                    <?php foreach($count_month_purchases['values'] as $value): ?>
                        <tr>
                            <th><?=$value['name']?></th>
                            <?php foreach($count_month_purchases['dates'] as $date): ?>
                                <td>
                                    <?php foreach($value['data'] as $item2): ?>
                                        <?php echo $item2->date == $date['value'] ? $item2->count : ''; ?>
                                    <?php endforeach;?>
                                </td>
                            <?php endforeach;?>
                            <th><?=$value['sum']?></th>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php endif; ?>
        <?php if ($parts['price_month_purchases']): ?>
            <hr class="mb-3"/>
            <h4 class="text-center mb-3">Таблиця прибутку по місяцям</h4>

            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col">Магазини\Місяці</th>
                    <?php foreach($price_month_purchases['dates'] as $date): ?>
                        <td scope="col"><?=$date['string']?></td>
                    <?php endforeach;?>
                    <th scope="col">Всього</th>
                </thead>
                <tbody>
                <?php foreach($price_month_purchases['values'] as $value): ?>
                    <tr>
                        <th><?=$value['name']?></th>
                        <?php foreach($price_month_purchases['dates'] as $date): ?>
                            <td>
                                <?php foreach($value['data'] as $item2): ?>
                                    <?php echo $item2->date == $date['value'] ? $item2->price : ''; ?>
                                <?php endforeach;?>
                            </td>
                        <?php endforeach;?>
                        <th><?=$value['sum']?></th>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        <?php endif; ?>
    </form>
</div>

<!--suppress BadExpressionStatementJS -->
<script>
    $(() => {
        $('#from').datepicker({ dateFormat: 'dd-mm-yy' });
        $('#to').datepicker({ dateFormat: 'dd-mm-yy' });

        $('#all-time-button').on('click', function () {
            window.location.href = '/';
        });

        hideBlocks();

        let parts = <?php echo json_encode($parts) ?>;

        $('#categories-button').on('click', async function () {
            if (parts.count_categories) {
                await buildCountCategories();
            }
            if (parts.price_categories) {
                buildPriceCategories();
            }
        });

        $('#names-button').on('click', async function () {
            if (parts.count_names) {
                await buildCountNames();
            }
            if (parts.price_names) {
                buildPriceNames();
            }
        });

        if (parts.count_purchases.length > 0) {
            buildCountPurchases();
        }
        if (parts.price_purchases.length > 0) {
            buildPricePurchases();
        }
    });

    function hideBlocks(name = null) {
        if (name === null) {
            $('#count-categories-container').hide();
            $('#price-categories-container').hide();
            $('#count-names-container').hide();
            $('#price-names-container').hide();
        } else {
            $(`#${name}`).hide();
        }
    }

    function showBlocks(name = null) {
        if (name === null) {
            $('#count-categories-container').show();
            $('#price-categories-container').show();
            $('#count-names-container').show();
            $('#price-names-container').show();
        } else {
            $(`#${name}`).show();
        }
    }

    function ajaxRequest(url) {
        return new Promise(function (resolve) {
            $.ajax({
                type: "GET",
                dataType: 'JSONP',
                jsonpCallback: 'callback',
                url,
                success: (data) => {
                    resolve(data);
                }
            });
        });
    }

    async function getCategoriesData(type) {
        let category = $('#select-category').val();
        if (category === '0') {
            hideBlocks(`${type}-categories-container`);
            return false;
        } else {
            showBlocks(`${type}-categories-container`);
        }

        let shops = <?php echo json_encode($shops) ?>;
        let result = [];

        for (let shop of shops) {
            let url = shop.path + `/purchase/all/category/${type}/${category}/${window.location.search}`;
            let info = await ajaxRequest(url);
            if (info) {
                result.push({
                    name: shop.title,
                    type: 'column',
                    showInLegend: true,
                    dataPoints: info.map((item) => {
                        if (type === 'count') {
                            return {
                                x: new Date(item.date),
                                y: item.count,
                            }
                        } else if (type === 'price') {
                            return {
                                x: new Date(item.date),
                                y: item.price,
                            }
                        }
                    }),
                });
            }
        }
        return result;
    }

    async function buildPriceCategories() {
        let data = await getCategoriesData('price');
        let options = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік прибутку по категорії: " + $('#select-category').val()
            },
            axisX: {
                valueFormatString: "MMM YYYY",
            },
            axisY: {
                suffix: " ₴",
                title: "Ціна",
                includeZero: true,
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            toolTip:{
                shared: true
            },
            data,
        };

        $("#priceCategories").CanvasJSChart(options);
    }

    async function buildCountCategories() {
        let data = await getCategoriesData('count');

        let options = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік кількості продаж категорії: " + $('#select-category').val()
            },
            axisX: {
                valueFormatString: "MMM YYYY",
            },
            axisY: {
                title: "Ціна",
                includeZero: true,
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            toolTip:{
                shared: true
            },
            data,
        };

        $("#countCategories").CanvasJSChart(options);
    }

    function toggleDataSeries(e) {
        e.dataSeries.visible = !(typeof (e.dataSeries.visible) === 'undefined' || e.dataSeries.visible);
        e.chart.render();
    }

    function buildCountPurchases() {
        let counts = <?php echo json_encode($parts['count_purchases']) ?>;
        // noinspection JSAnnotator
        counts = counts.map((item) => {
            item.dataPoints = item.dataPoints.map((item2) => {
                return {
                    x: new Date(item2.date),
                    y: item2.count,
                }
            });
            return item;
        });

        let options = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік кількості продаж"
            },
            axisX: {
                valueFormatString: "DD MMM YYYY",
            },
            axisY: {
                title: "Кількість",
                includeZero: true,
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            toolTip:{
                shared: true
            },
            data: counts,
        };

        $("#countPurchases").CanvasJSChart(options);
    }

    function buildPricePurchases() {
        let prices = <?php echo json_encode($parts['price_purchases']) ?>;
        // noinspection JSAnnotator
        prices = prices.map((item) => {
            item.dataPoints = item.dataPoints.map((item2) => {
                return {
                    x: new Date(item2.date),
                    y: item2.price,
                }
            });
            return item;
        });

        let options = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік прибутку по товару"
            },
            axisX: {
                valueFormatString: "DD MMM YYYY",
            },
            axisY: {
                suffix: " ₴",
                title: "Ціна",
                includeZero: true,
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            toolTip:{
                shared: true
            },
            data: prices,
        };

        $("#pricePurchases").CanvasJSChart(options);
    }

    async function getNamesData(type) {
        let name = $('#names-input').val();
        if (name === '') {
            hideBlocks(`${type}-names-container`);
            return false;
        } else {
            showBlocks(`${type}-names-container`);
        }

        let shops = <?php echo json_encode($shops) ?>;
        let result = [];

        for (let shop of shops) {
            let url = shop.path + `/purchase/all/names/${type}/${name}/${window.location.search}`;
            let info = await ajaxRequest(url);
            if (info) {
                result.push({
                    name: shop.title,
                    type: 'spline',
                    showInLegend: true,
                    dataPoints: info.map((item) => {
                        if (type === 'count') {
                            return {
                                x: new Date(item.date),
                                y: item.count,
                            }
                        } else if (type === 'price') {
                            return {
                                x: new Date(item.date),
                                y: item.price,
                            }
                        }
                    }),
                });
            }
        }
        return result;
    }

    async function buildCountNames() {
        let data = await getNamesData('count');

        let options = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік кількості продаж товару: " + $('#names-input').val()
            },
            axisX: {
                valueFormatString: "DD MMM YYYY",
            },
            axisY: {
                title: "Кількість",
                includeZero: true,
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            toolTip:{
                shared: true
            },
            data,
        };

        $("#countNames").CanvasJSChart(options);
    }

    async function buildPriceNames() {
        let data = await getNamesData('price');

        let options = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік прибутку по товару: " + $('#names-input').val()
            },
            axisX: {
                valueFormatString: "DD MMM YYYY",
            },
            axisY: {
                suffix: " ₴",
                title: "Ціна",
                includeZero: true,
            },
            legend:{
                cursor: "pointer",
                fontSize: 16,
                itemclick: toggleDataSeries
            },
            toolTip:{
                shared: true
            },
            data,
        };

        $("#priceNames").CanvasJSChart(options);
    }

</script>

