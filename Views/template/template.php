<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Blog AFPA</title>
</head>

<body>
    <div class="container">
        <header>
            <a href="homepage">Blog AFPA</a> 
            <ul class="header-menu">
                <li>
                <a href="add-update-article">Créer un article</a>
                </li>
            </ul>
        </header>
        <div class="content">               
            <div>
                <?= $content ?>
            </div>
        </div>
        <footer>2022 © Tous droits réservés</footer>
    </div>

</body>

</html>