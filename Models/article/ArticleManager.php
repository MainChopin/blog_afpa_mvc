<?php

namespace Models\article;

use Models\Database;

class ArticleManager extends Database
{

    public function getArticles()
    {

        $req = 'SELECT articles.*, users.prenom 
                    FROM articles
                    INNER JOIN users 
                    ON articles.iduser = users.id';

        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
        $articles = $statement->fetchAll();
        $statement->closeCursor();
        return $articles;
    }


    public function getArticle($id)
    {
        $req = "SELECT * FROM articles WHERE id = ?";

        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
        $article = $statement->fetch();
        $statement->closeCursor();
        return $article;
    }


    public function addArticle($title, $content, $img)
    {
        $req = "INSERT INTO articles (title, content, img, iduser) VALUES (?, ?, ?, ?)";

        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$title, $content, $img, 1]);
    }


    public function updateArticle($title, $content, $img, $id)
    {

        $req = "UPDATE articles
                SET
                    title = ?,
                    content = ?,
                    img = ?,
                    iduser = ?
                WHERE id = ?";

        $statementUpdate = $this->getBdd()->prepare($req);
        $statementUpdate->execute([$title, $content ,$img , 1, $id]);
    }


    public function deleteArticle($id)
    {
        $article = $this->getArticle($id);
        unlink($article->img);
        $req = "DELETE FROM articles WHERE id = ?";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$id]);
    }
}