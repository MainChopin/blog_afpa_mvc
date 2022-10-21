<?php

use Controllers\article\ArticleController;

function autoload($class)
{
    require_once "$class.php";
}
spl_autoload_register("autoload");

$articleController = new ArticleController();
$page = $_GET['page'] ?? '';

ob_start();
if (empty($page)) {
    // mettre un chemin dynamique
    $articleController->getArticles();
} else {
    if ($page === 'homepage') {
        $articleController->getArticles();
    } elseif ($page === 'update-article') {
        $articleController->updateArticle();
    } elseif ($page === 'add-update-article') {
        $articleController->addArticle();
    } elseif ($page === 'view-article') {
        $articleController->getArticle();
    } elseif ($page === 'remove-article') {
        $articleController->removeArticle();
    }
}
$content = ob_get_clean();
require_once './Views/template/template.php';