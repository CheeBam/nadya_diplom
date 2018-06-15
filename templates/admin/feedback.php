<div>
    <h3 class="text-center mb-3">Відгуки</h3>
    <div>
        <?php foreach ($feedback as $item): ?>
            <div class="row">
                <div class="card w-100 mb-3">
                    <div class="card-header">
                        <?=$item['name']?>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p><?=$item['description']?></p>
                        </blockquote>
                    </div>
                    <div class="card-footer text-muted">
                        Від: <i><?=$item['email']?></i>
                        <cite style="float: right" title="Source Title"><?=$item['date']?></cite></footer>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
