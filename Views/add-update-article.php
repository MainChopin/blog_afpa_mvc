<head>
    <link rel="stylesheet" href="./assets/css/add-article.css">
</head> 

<div class="block p-20 form-container">
    <h1>Ecrire un article</h1>
    <form enctype="multipart/form-data" action="" method="POST">
        <div class="form-control">
            <label for="title">Titre</label>
            <input type="text" name="title" value="<?= $title ? $title : "" ?>">
            <?php if($errors['title'] !== "") : ?>
                <p class="text-danger"><?= $errors['title']?></p>
            <?php endif;?>
        </div>
        <div class="form-control">
            <label for="img">Image</label>
            <input type="file" name="img" id="img">
            <?php if($errors['img'] !== "") : ?>
                <p class="text-danger"><?= $errors['img']?></p>
            <?php endif;?>
        </div>
        <div class="form-control">                
            <label for="content">Description</label>
            <textarea name="content"><?= $content ? $content : "" ?></textarea>
            <?php if($errors['content'] !== "") : ?>
                <p class="text-danger"><?= $errors['content']?></p>
            <?php endif;?>
        </div> 
        <div class="form-action">
            <button class="btn-return btn" type="button"><a href="homepage">Annuler</a></button>
            <button class="btn-primary btn" type="submit">Sauvegarder</button>
        </div>                   
    </form>
</div>

