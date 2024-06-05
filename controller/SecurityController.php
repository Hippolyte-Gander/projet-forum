<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        // connexion à la bdd
        $pdo = new PDO("mysql:host=localhost;dbname=php_hash;charset=utf8", "root", "");

        // filtrer saisie des champs du formulaire d'inscription
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
        $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($pseudo && $email && $pass1 && $pass2){
            $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
            $requete->execute(["email"=> $email]);
            $user = $requete>fetch();
            // si l'utilisateur existe
            if($user){
                header("Location: register.php"); exit; // MODIFIER la redirection pour adapter au  doc
            } else {
                // insertion utilisateur en bdd
                if($pass1 == $pass2 && strlen($pass1 >= 12)) {
                    $insertUser = $pdo->prepare("INSERT INTO user (pseudo, email, password) VALUES (:pseudo, :email, :password");
                    $insertUser->execute([
                        "pseudo" => $pseudo,
                        "email" => $email,
                        "password" => password_hash($pass1, PASSWORD_DEFAULT)
                    ]);
                    header("Location: login.php"); exit; // MODIFIER la redirection pour adapter au  doc
                } else {
                    // message "mdp non identiques ou mdp trop court"
                }
            }
        } else {
            // message "problème de saisie dans les champs de formulaire"
        }
    }
    
    public function login () {
        if($_POST["submit"]) {
            // connexion à la bdd
            $pdo = new PDO("mysql:host=localhost;dbname=php_hash;charset=utf8", "root", "");
            
            // filtrer saisie des champs du formulaire d'inscription
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($email && $password){
                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                $requete->execute(["email"=> $email]);
                $user = $requete>fetch();

                // si utilisateur existe
                if($user){
                    $hash = $user["password"];
                    if(password_verify($pasword, $hash)){
                        $_SESSION["user"] = $user;
                        header("Location: home.php"); exit; // MODIFIER la redirection pour adapter au  doc
                    } else {
                        header("Location: login.php"); exit; // MODIFIER la redirection pour adapter au  doc
                        // message d'erreur "utilisateur ou mdp incorrect"
                    }
                } else {
                    header("Location: login.php"); exit; // MODIFIER la redirection pour adapter au  doc
                    // message d'erreur "utilisateur ou mdp incorrect"
                }
                
            }
            header("Location: login.php"); exit; // MODIFIER la redirection pour adapter au  doc
        }
        
    public function logout () {
        unset($_SESSION["user"]);
        header("Location: home.php"); exit; // MODIFIER la redirection pour adapter au  doc
    }
    


    if(isset($_GET["action"])){
        case "register": register();
            break;
        case "login": login();
            break;
    }
}

