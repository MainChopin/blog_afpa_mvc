<head>
    <link rel="stylesheet" href="./assets/css/view-article.css">
</head>
<div class="block p-20 form-container">
    <div class="flex">
        <div class="article-title">
            <h1><?= $article->title?></h1>
        </div>
        <div class="article-description">
            <p><?= $article->content?></p>
        </div>
        <div class="article-img">
            <img src="<?= $article->img?>" alt="Image Article">
        </div>
        <div class="article-button">
            <a href="remove-article&id=<?= $article->id?>"><button class="btn btn-danger">Supprimer</button></a>
            <a href="update-article&id=<?= $article->id?>"><button class="btn btn-primary">Modifier</button></a>
        </div>
    </div>
</div>
