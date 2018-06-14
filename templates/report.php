<div>
    <h3 class="text-center mb-3">Завантажити звіт</h3>

    <form action="/" method="get">
        <div class="row">
            <div class="offset-md-1 col-md-3">
                <label for="from">Дата початку</label>
                <input type="text" id="from" name="from" value=""class="form-control" aria-label="from" aria-describedby="basic-addon1">
            </div>
            <div class="col-md-3">
                <label for="to">Дата кінця</label>
                <input type="text" id="to" name="to" value="" class="form-control" aria-label="to" aria-describedby="basic-addon1">
            </div>
            <div class="col-md-1" style="text-align: center; margin-top: 37px;">
                <span>або</span>
            </div>
            <div class="col-md-3" style="margin-top: 8px;">
                <label for="date-button"> </label>
                <input type="button" id="all-time-button" class="btn btn-success w-100" value="За весь час">
            </div>
            <div class="col-md-1"></div>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                        Продажі по магазинам
                    </div>
                    <div class="card-body">
                        <button formmethod="get" id="all-purchases" class="btn btn-primary mb-4 mt-4"
                                formaction="/handlers/file/all-purchases.php">Завантажити файл</button>
                    </div>
                    <div class="card-footer text-muted">
                        Всі продажі та прибуток по кожному магазину
                    </div>
                </div>
            </div>
            <div class="col-md-4">
    <!--            <button formaction="action2">Action2</button>-->

            </div>
            <div class="col-md-4">

            </div>
        </div>

    </form>


</div>

<script>
    $(() => {
        $('#from').datepicker({dateFormat: 'dd-mm-yy'});
        $('#to').datepicker({dateFormat: 'dd-mm-yy'});

        $('#all-time-button').on('click', function () {
            window.location.href = '/report.php';
        });

        $('#all-purchases').on('click', async function () {
            let from = $('#from');
            let to = $('#to');



        });

    });

</script>
