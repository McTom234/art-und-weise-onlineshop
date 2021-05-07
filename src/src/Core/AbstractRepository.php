<?php

namespace Core;
use PDO;
abstract class AbstractRepository {

    protected $pdo;
    protected $model;
    protected $table;
    protected $idName;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $this->model = $this->getModel();
        $this->table = $this->getTable();
        $this->idName = $this->getIdName();
    }

    abstract public function getModel();
    abstract public function getTable();
    abstract public function getIdName();

    public function fetch($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE $this->idName = :id");
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, $this->model);
        return $statement->fetch(PDO::FETCH_CLASS);
    }

    public function fetchAll(){
        $statement = $this->pdo->query("SELECT * FROM $this->table");
        return $statement->fetchAll(PDO::FETCH_CLASS, $this->model);
    }
    public function fetchNumber($number){
        $statement = $this->pdo->prepare("SELECT * FROM $this->table LIMIT :number");
        $statement->execute([':number' => $number]);
        return $statement->fetchAll(PDO::FETCH_CLASS, $this->model);
    }

}