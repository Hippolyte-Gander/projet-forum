<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id
                ORDER BY topicDate DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function closeTopic($id) {
        $sql = "UPDATE topic SET closed=1 WHERE id_topic = :id";
        DAO::update($sql, ['id' => $id]); 
    }

    public function openTopic($id) {
        $sql = "UPDATE topic SET closed=0 WHERE id_topic = :id";
        DAO::update($sql, ['id' => $id]); 
    }
}