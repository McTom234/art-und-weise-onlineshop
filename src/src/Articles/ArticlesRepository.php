<?php

namespace Articles;
use Core\AbstractRepository;
use PDO;

class ArticlesRepository extends AbstractRepository {

    public function getModel()
    {
        return "Articles\\ArticleModel";
    }

    public function getTable()
    {
        return "article";
    }

    public function getIdName()
    {
        return "article_ID";
    }

}
