<?php

namespace Controllers\article;

use Models\article\ArticleManager;

class ArticleController{
    private $articleManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager();
    }

    public function getArticles()
    {
        $articles = $this->articleManager->getArticles();
        require_once './Views/homepage.php';
    }

    public function getArticle()
    {
        $id = $_GET['id'] ?? '';
        $article = $this->articleManager->getArticle($id);
        require_once './Views/view-article.php';
    }

    public function addArticle()
    {
        require_once "./Views/includes/errors.php";
        $errors = [
            'title' => '',
            'img' => '',
            'content' => '',
        ];

        $title = '';
        $content= '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, [
                'title' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK
                ],
        
                'content' => [
                    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK
                ]
            ]);
            

            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';

            if ($_FILES["img"]["name"]) {
                $target_dir = "./img/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
                if (file_exists($target_file)) {
                    $errors['img'] = ERROR_EXIST_IMG;
                }
            
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $errors['img'] = ERROR_FORMAT_IMG;
                }
            
                
            }else{
                $errors['img'] = ERROR_REQUIRED_IMG;
            }

            if(!$title){
                $errors['title'] = ERROR_REQUIRED_TITLE;
            }elseif(mb_strlen($title) < 7 ){
                $errors['title'] = ERROR_TOO_SHORT_TITLE;
            }elseif(mb_strlen($title) > 75){
                $errors['title'] = ERROR_TOO_LONG_TITLE;
            }
        
            if(!$content){
                $errors['content'] = ERROR_REQUIRED_CONTENT;
            }elseif(mb_strlen($content) < 7 ){
                $errors['content'] = ERROR_TOO_SHORT_CONTENT;
            }elseif(mb_strlen($content) > 500){
                $errors['content'] = ERROR_TOO_LONG_CONTENT;
            }
            

            if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                $this->articleManager->addArticle($title, $content, $target_file);
                header('Location: homepage');
            }
        }

        require_once './Views/add-update-article.php';
    }


    public function removeArticle()
    {
        $id = $_GET['id'] ?? '';;
        $this->articleManager->deleteArticle($id);
        header('Location: homepage');
    }


    public function updateArticle()
    {
        $id = $_GET['id'] ?? '';

        if ($id) {
            $article = $this->articleManager->getArticle($id);
        }

        require_once "./Views/includes/errors.php";
        $errors = [
            'title' => '',
            'img' => '',
            'content' => '',
        ];

        $_POST = filter_input_array(INPUT_POST, [
            'title' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK
            ],
    
            'content' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK
            ]
        ]);

        $title = $article->title;
        $content = $article->content;
        $current_img = $article->img;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';


            if(!$title){
                $errors['title'] = ERROR_REQUIRED_TITLE;
            }elseif(mb_strlen($title) < 7 ){
                $errors['title'] = ERROR_TOO_SHORT_TITLE;
            }elseif(mb_strlen($title) > 75){
                $errors['title'] = ERROR_TOO_LONG_TITLE;
            }
        
            if(!$content){
                $errors['content'] = ERROR_REQUIRED_CONTENT;
            }elseif(mb_strlen($content) < 7 ){
                $errors['content'] = ERROR_TOO_SHORT_CONTENT;
            }elseif(mb_strlen($content) > 500){
                $errors['content'] = ERROR_TOO_LONG_CONTENT;
            }

            if ($_FILES["img"]["name"]) {
                $target_dir = "./img/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
                if (file_exists($target_file)) {
                    $errors['img'] = ERROR_EXIST_IMG;
                }
            
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $errors['img'] = ERROR_FORMAT_IMG;
                }
                
                if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
                    unlink($current_img);
                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                    $current_img = $target_file;
                }
                
            }

            if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                $this->articleManager->updateArticle($title, $content, $current_img, $id);
                header('Location: homepage');
            }

        }

        require_once './Views/add-update-article.php';
    }
}