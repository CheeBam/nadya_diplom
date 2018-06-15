<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Monitoring</title>
    <script src="../scripts/jquery.js"></script>
    <script src="../scripts/jquery-ui.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="../scripts/bootstrap.js"></script>
    <script src="../scripts/jquery.canvasjs.min.js"></script>
    <script src="../scripts/canvasjs.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../styles/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>

<div id="container" class="container">
    <div class="col-12">
        <nav class="mb-3 navbar navbar-toggleable-md navbar-light">
            <a class="navbar-brand" href="/">
                <img src="../styles/images/logo.png" width="25" height="25" style="margin-top: -5px" alt=""><span style="margin-left: -2px"><b>onitoring</b></span>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php foreach($menu_items['main'] as $item): ?>
                        <li class="nav-item dropdown">
                            <?php if (isset($item['sub']) && count($item['sub'] > 0)): ?>
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown<?=$item['id']?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $item['title'] ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown<?=$item['id']?>">
                                    <?php foreach($item['sub'] as $key => $value): ?>
                                        <?php if ($key !== 0):?>
                                            <div class="dropdown-divider"></div>
                                        <?php endif; ?>
                                        <a class="dropdown-item" href="<?=$item['sub_link']?>.php?id=<?=$value['id']?>"><?=$value['title']?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <a class="nav-link" href="<?= $item['link'] ?>">
                                    <?= $item['title'] ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php foreach($menu_items['right'] as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $item['link'] ?>">
                                <?= $item['title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
