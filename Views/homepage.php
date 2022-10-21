<head>
    <link rel="stylesheet" href="./assets/css/index.css">
</head>
<div class="flex">
    <?php foreach ($articles as $article) :?>
        <div class="p-50">
            <div class="card">
                <a href="">
                    <div class="card-img">
                        <img src="<?= $article->img?>" alt="Image Article">
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3><?= $article->title?></h3>
                        </div>
                        <div class="card-button">
                            <a href="view-article&id=<?= $article->id?>"><button class="btn">Détails</button></a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

