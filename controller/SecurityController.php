<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use App\Session;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        $userManager = new UserManager();

        if(isset($_POST["submit"])) {
            // filtrer saisie des champs du formulaire d'inscription
            $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            if($nickname && $email && $pass1 && $pass2){
                // var_dump("ok");die;
                // si l'utilisateur existe
                // if($email->getUser()){
                //     // $this->redirectTo("security", "index");
                // } else {
                    // insertion utilisateur en bdd
                    if($pass1 == $pass2 && strlen($pass1 >= 4)) {
                        $userManager->add([
                            "nickname" => $nickname,
                            "mail" => $email,
                            "password" => password_hash($pass1, PASSWORD_DEFAULT)
                        ]);
                        $this->redirectTo("security", "login");
                    } else {
                        echo "mdp non identiques ou mdp trop court";
                    }
                // }
            } else {
                // alert("insert valid informations");
            }
        }

        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "Page d'inscription"
        ];
    }
    
    public function index(){
        
    }
        
    
    public function login () {

        $userManager = new UserManager();
        
        if(isset($_POST["submit"])) {
            // filtrer saisie des champs du formulaire d'inscription
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            if($email && $password){
                // si utilisateur existe

                $user = $userManager->checkUserExists($email);

                if($user){
                    $hash = $user->getPassword();
                    if(password_verify($password, $hash)){
                        Session::setUser($user);
                        $this->redirectTo("forum", "index");
                    } else {
                        $this->redirectTo("security", "login");
                        // alert("insert valid informations");
                    }
                } else {
                    $this->redirectTo("security", "login");
                }
                
            }
            $this->redirectTo("security", "login");
        }

        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Page de connexion"
        ];
    }    
    
    public function logout () {
        
        if(Session::getUser()) {
            Session::setUser(null);
            $this->redirectTo("security", "login");    
        }
    }
}