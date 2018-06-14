<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>[Admin] Monitoring</title>
    <script src="../../scripts/jquery.js"></script>
    <script src="../../scripts/bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" href="../../styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>
<body>

<script type="text/javascript">
    function goBack() {
        history.back();
    }
</script>

<div class="container">
    <div class="col-12">
        <nav class="navbar navbar-toggleable-md navbar-light mb-3">
            <a class="navbar-brand" href="/admin/main.php">
                <img src="../../styles/images/logo.png" width="25" height="25" style="margin-top: -5px" alt="">
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand"><b><i><a href="/admin/main.php" style="color: black">Monitoring Admin Panel</a></i></b></span>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php foreach($menu_items['main'] as $item): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?= $item['link'] ?>">
                                <?= $item['title'] ?>
                            </a>
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
