<h3 class="text-center mb-3"><i><?=$product_name?></i> у всіх магазинах</h3>

<div class="row">
    <div class="col-4 text-center">
        <div id="carousel-block" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <?php for($i = 0; $i < count($carousel_data); $i++): ?>
                    <li data-target="#carousel-block" data-slide-to="<?=$i?>" <?php if ($i === 0) echo 'class="active"'?>></li>
                <?php endfor; ?>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <?php for($i = 0; $i < count($carousel_data); $i++): ?>
                    <div class="carousel-item <?php if ($i === 0) echo 'active'?>">
                        <div class="card w-100">
                            <img class="card-img-top" height="230" src="<?=$carousel_data[$i]['image']?>" alt="Нема зображення">
                            <div class="card-body">
                                <h5 class="card-title"><?=$carousel_data[$i]['brand']?> <?=$carousel_data[$i]['title']?></h5>
                                <p class="card-text"><?=$carousel_data[$i]['description']?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Магазин: <?=$carousel_data[$i]['shop']?></li>
                                <li class="list-group-item">Категорія: <?=$carousel_data[$i]['category']?></li>
                                <li class="list-group-item">Середня цiна: <?=$carousel_data[$i]['avg_price']?></li>
                                <li class="list-group-item">Продано за весь час: <?=$carousel_data[$i]['count_all']?> </li>
                            </ul>
                            <div class="card-body">
                                <div style="margin: 10px 0">
                                    <a class="btn btn-primary" href="/product.php?id=<?=$carousel_data[$i]['id']?>&shop=<?=$carousel_data[$i]['shop']?>"><i class="fas fa-trophy"></i></a>
                                    <div style="display: block; height: 25px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endfor; ?>
            </div>

            <a class="carousel-control-prev" href="#carousel-block" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#carousel-block" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <div class="col-md-8">
        <div id="chartContainerCounts" style="height: 300px; width: 100%; margin-bottom: 30px"></div>
        <div id="chartContainerPrices" style="height: 300px; width: 100%;"></div>
    </div>


</div>

<script>
    $(async () => {
        let data1 = <?php echo json_encode($chart_data) ?>;
        let data2 = <?php echo json_encode($chart_data) ?>;
        if (data1.length > 0) {
            await buildPrices(data1);
            buildCounts(data2);
        }
    });

    function toggleDataSeries(e) {
        e.dataSeries.visible = !(typeof (e.dataSeries.visible) === 'undefined' || e.dataSeries.visible);
        e.chart.render();
    }

    function buildCounts(data) {

        // noinspection JSAnnotator
        let counts = data.map((item) => {
            item.dataPoints = item.dataPoints.map((item2) => {
                return {
                    x: new Date(item2.date),
                    y: item2.cnt,
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

        $("#chartContainerCounts").CanvasJSChart(options);
    }

    async function buildPrices(data) {
        // noinspection JSAnnotator
        let prices = data.map((item) => {
            item.yValueFormatString = '#,###.## ₴';
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
                text: "Графік прибутку"
            },
            axisX: {
                valueFormatString: "DD MMM YYYY",
            },
            axisY: {
                suffix: " ₴",
                title: "Прибуток",
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

        $("#chartContainerPrices").CanvasJSChart(options);
    }

</script>
