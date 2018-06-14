<div>
    <h3 class="text-center mb-3"> <?=$product->brand->title?> <?=$product->title?> у магазинi <?=ucfirst($shop_title)?></h3>

    <div class="row">

        <div class="col-md-4 text-center">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" height="180" src="<?=$product->image?>" alt="Нема зображення">
                <div class="card-body">
                    <h5 class="card-title"><?=$product->brand->title?> <?=$product->title?></h5>
                    <p class="card-text"><?=$product->description?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Категорiя: <?=$product->category->title?></li>
                    <li class="list-group-item">Актуальна цiна: <?=$product->act_price?></li>
                    <li class="list-group-item">Середня цiна: <?=$product->avg_price?></li>
                    <li class="list-group-item">Продано за весь час: <?=count($product->purchases)?> </li>
                </ul>
                <div class="card-body">
                    <div style="margin: 10px 0">
                        <a class="btn btn-primary" href="#"><i class="fas fa-trophy"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div id="chartContainerPrices" style="height: 300px; width: 100%; margin-bottom: 30px"></div>
            <div id="chartContainerAmounts" style="height: 300px; width: 100%;"></div>
        </div>

    </div>


</div>

<script type="text/javascript">

    let prices = <?php echo json_encode($product->purchases) ?>;
    let amounts = <?php echo json_encode($amounts) ?>;

    window.onload = function() {

        // console.log(amounts);

        let dataPrices = [];
        let dataAmounts = [];

        let optionPrices =  {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік ціни"
            },
            toolTip:{
                shared: true
            },
            axisX: {
                valueFormatString: "DD MMM YYYY",
            },
            axisY: {
                suffix: " ₴",
                title: "Ціна",
                includeZero: false
            },
            data: [{
                type: "spline",
                yValueFormatString: "#,###.## ₴",
                dataPoints: dataPrices
            }]
        };

        let optionAmounts = {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Графік кількості покупок",
                titleFontSize: 18,
            },
            data: [
                {
                    type: "column",
                    dataPoints: dataAmounts
                }
            ]
        };

        function buildPrices(data) {
            for (let i = 0; i < data.length; i++) {
                dataPrices.push({
                    x: new Date(data[i].date),
                    y: data[i].price
                });
            }
            $('#chartContainerPrices').CanvasJSChart(optionPrices);
        }

        function buildAmounts(data) {
            for (let i = 0; i < data.length; i++) {
                dataAmounts.push({
                    x: new Date(data[i].date),
                    y: data[i].count
                });
            }
            $('#chartContainerAmounts').CanvasJSChart(optionAmounts);
        }

        buildPrices(prices);
        buildAmounts(amounts);
    };

</script>
