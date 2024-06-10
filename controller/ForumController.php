<?php
namespace Controller;

use App\Session;
use App\DAO;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;
use Model\Entities\User;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();
        $postManager = new PostManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics,
                "posts" => $posts
            ]
        ];
    }

    public function listPostsByTopic($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/topicPage.php",
            "meta_description" => "Liste des messages du topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    public function addPost($id) {

        $postManager = new PostManager();
        $user = Session::getUser();

        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($user){
            $userId = $user->getId();
            if($content) {
                $postManager->add([
                    "content"=> $content, 
                    "topic_id" => $id, 
                    "user_id" => $userId
                ]);
                $this->redirectTo("forum", "listPostsByTopic", $id);
            } else {
                // message "wrong input"
            }
        } else {
            // message "Please log in to post"
        }
    }

    public function addTopic($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $user = Session::getUser();

        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($user) {
            $userId = $user->getId();
            if($title && $content) {
               $newId = $topicManager->add([
                    "title"=> $title, 
                    "category_id" => $id, 
                    "user_id" => $userId
                ]);
                $postManager->add([
                    "content"=> $content, 
                    "topic_id" => $newId, 
                    "user_id" => $userId
                ]);
                $this->redirectTo("forum", "listPostsByTopic", $newId);
            } else {
                // message "wrong input"
            }
        } else {
            // message "Please log in to post"
        }
    }
}