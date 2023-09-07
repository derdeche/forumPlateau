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

        public function register(){
            $userManager = new UserManager();

            if (isset($_POST['submit'])){
                $userName = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                var_dump($password);
                
                if ($userName && $email && $password){
                    $userManager = new UserManager();

                    $user = $userManager->add(["username" => $userName, "email"=>$email, "password"=>$password]);
                
                    return["view" => VIEW_DIR . "forum/listTopicsByCategory.php"];
                }
            }
            
        }
        
        
        // $user = $userManager->createObject($_POST);
        // $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));
        // $userManager->insert($user);
        // Session::addMessage("Vous êtes bien inscrit");
        // $this->redirect("security", "login");







    }
