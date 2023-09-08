<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;

    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){}

        public function toRegister(){
            return [
                "view" => VIEW_DIR."security/register.php"              
            ];
        }

        public function register(){
            $userManager = new UserManager();

            var_dump("test");
             if(isset ($_POST['submit']) ){
                $userName = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if ($userName && $email && $password ){
                    // $userManager = new UserManager();
                    $user = $userManager->add([
                        "pseudo" => $userName, 
                        "email"=>$email, 
                        "password"=>$password
                        
                    ]);
                    var_dump("test");
                                       
                    return[
                        "view" => VIEW_DIR . "forum/.php"
                    ];
                }
            }
                
            }
        
        
        // $user = $userManager->createObject($_POST);
        // $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
        // $userManager->insert($user);
        // Session::addMessage("Vous êtes bien inscrit");
        // $this->redirect("security", "login");







    }
