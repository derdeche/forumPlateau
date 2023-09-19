<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;

    
    class ForumController extends AbstractController implements ControllerInterface{

       
        // public function ListTopics(){
                  
        //    $topicManager = new TopicManager();

        //     return [
        //         "view" => VIEW_DIR."forum/listTopics.php",
        //         "data" => [
        //         "topics" => $topicManager->findAll(["topicDate", "DESC"])
        //         ]
        //     ];
        
        // }

        public function ListCategories(){
            $categoryManager = new CategoryManager();
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                "categories" => $categoryManager->findAll(["categoryName", "ASC"])
                ]
            ];
        }

        // public function ListPosts(){
                  
        //     $postManager = new PostManager();
 
        //      return [
        //         "view" => VIEW_DIR."forum/listPosts.php",
        //         "data" => 
        //         [
        //         "posts" => $postManager->findAll(["datePost", "DESC"])
        //          ]
        //      ];
         
        // }

        public function listTopicsByCategory($id){
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();
            if(isset($_SESSION['user'])){
    
    
            return [
                "view" => VIEW_DIR . "forum/listTopicsByCategory.php",
                "data" => [
                    "topics" => $topicManager->topicByCategory($id),
                    "categories" => $categoryManager->findOneById($id),
                    
                ]
            ];
            }
            else{                          
                $_SESSION["error"] = "Vous devez vous connecter pour voir la liste";
                $this->redirectTo('forum', 'listCategories');                
            }
        }

        public function listPostsByTopic($id){
            // Instanciation des gestionnaires de données   
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            // $locked = '0';
            // $statut= $topicManager->findOneById($id)->getLocked();
            // var_dump($statut);
            if($_SESSION['user'] ){
    
            // Retourne un tableau associatif avec les données pour la vue
            return [
                "view" => VIEW_DIR . "forum/listPostsByTopic.php", // Chemin de la vue à afficher
                "data" => [
                    "posts" => $postManager->postByTopic($id), // Liste des posts liés à un sujet
                    "topics" => $topicManager->findOneById($id) // Détails du sujet spécifié par son ID
                ]
            ];
            
          

                }
                else{                          
                    $_SESSION["error"] = "Vous devez vous connecter pour voir la liste";
                    $this->redirectTo('forum', 'listCategories');                
                }
            }
    

 
        public function addCategory(){
            // Instanciation du gestionnaire de catégories
            $categoryManager = new CategoryManager();

            // Vérifie si le formulaire a été soumis, si l'utilisateur est connecté et s'il a le rôle d'administrateur
            if (isset($_POST['submit']) && isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'ROLE_ADMIN'){

                // Récupération du nom de la catégorie depuis le formulaire
                $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // Vérifie si le nom de la catégorie est valide                                
                if ($categoryName ) {
                      // Ajoute la nouvelle catégorie à la base de données
                    $newCategory = $categoryManager->add(["categoryName" => $categoryName]);
                    
                    // Redirige vers une autre page après avoir ajouté la catégorie
                    $this->redirectTo('forum', 'listCategories', $newCategory);
                    
                }       // Affiche un message d'erreur si le nom de la catégorie n'est pas valide
            }
                        else{                          
                            $_SESSION["error"] = "Vous n'avez pas l'autorisation d'ajouter une Catégorie";
                            $this->redirectTo('forum', 'listCategories');
                            
                        }
                    
        }
                
        
                
    
        public function addTopic($id){
            // Instanciation des gestionnaires de données
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();
    
            // Récupération de l'ID de la catégorie à partir de la requête
            $idcategory= $categoryManager->findOneById($id)->getId();
    
            
            // Instanciation du gestionnaire d'utilisateurs
            $userManager = new UserManager();
            
            // Vérifiez si l'utilisateur est connecté
            if (isset($_SESSION['user']) && isset($_POST['submit'])|| $_SESSION['user']->getRole() == 'ROLE_ADMIN') {
                
                // Récupération de l'ID de l'utilisateur connecté
                $idUser= $_SESSION['user']->getId();

                // Initialisation de la variable $locked à 0    
                $locked= 0;

                    $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    // Vérifiez si le nom du sujet est valide
                    if ($topicName) {
                            // Ajout du nouveau sujet à la base de données
                        $newTopic = $topicManager->add(['topicName' => $topicName, 'category_id' => $idcategory, 'user_id' => $idUser, 'locked'=> 0]);
                        // var_dump($topicName);die;
    
                        // Redirection vers une autre page après avoir ajouté le sujet
                        $this->redirectTo('forum', 'listCategories', $newTopic);
                    
                    }    
            } 
            else { 
                $_SESSION["error"] = "Vous étes Banni";
                // L'utilisateur est banni redirection vers la page de liste catégories
                $this->redirectTo('forum', 'listCategories');
            }
        }
            
            
            
        
        
        public function addPost($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            $idTopic = $topicManager->findOneById($id)->getId();
            
            // var_dump($idUser);die;
            // $statut = $_SESSION['user']->getBan();
            var_dump($statut);
            
            // $topicManager->findOneById($id);
            if (isset($_SESSION['user']) && isset($_POST['submit'])  || $_SESSION['user']->getRole() == 'ROLE_ADMIN') {
                
                    $idUser = $_SESSION['user']->getId();
                    $postContent = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                    
                    if ($postContent ) {
                    // var_dump($postManager);
                        $newPost = $postManager->add(["text" => $postContent, "topic_id"=>$idTopic, "user_id" => $idUser]);
                        $this->redirectTo('forum', 'listCategories', $newPost);
                    }
                }
                     
            else { 
                $_SESSION["error"] = "Vous étes Banni";
                // L'utilisateur n'est pas connecté, vous pouvez rediriger vers la page d'acceuil
                $this->redirectTo('forum', 'listCategories');
            }
    
        }    
            public function deleteTopic($id){
                $TopicManager = new TopicManager();
                // $CategoryManager = new CategoryManager();
                $topic = $TopicManager->findOneById($id);
                $pseudo = $topic->getUser()->getPseudo();
                $user = $_SESSION['user']->getPseudo();      
                // var_dump($user);die;
                if($pseudo == $user || $_SESSION['user']->getRole() == 'ROLE_ADMIN'){
                
                    $TopicManager->delete($id);
                }
            
                else { $_SESSION["error"] = "Vous n'étes pas autorisé";

                }

                $this->redirectTo('forum', "listCategories", $topic);
                          
                                
            }
            
            public function deletePost($id){
                $PostManager = new PostManager();
                
                $post = $PostManager->findOneById($id);
                
                $pseudo = $post->getUser()->getPseudo();
                $user = $_SESSION['user']->getPseudo();
                // var_dump($user);die;
                if($pseudo == $user || $_SESSION['user']->getRole() == 'ROLE_ADMIN'){
                
                    $PostManager->delete($id);
                }
            
                else { $_SESSION["error"] = "Vous n'étes pas autorisé";

                }

                $this->redirectTo('forum', "listCategories", $post);
            }
            
    
            public function deleteCategory($id){
                $CategoryManager = new CategoryManager();
                if ( $_SESSION['user']->getRole() == 'ROLE_ADMIN'){
                // $TopicManager = new TopicManager();
                // $listTopic = $TopicManager->listTopics($id);
                    $category = $CategoryManager->findOneById($id);   
                }  
                else{                          
                $_SESSION["error"] = "Vous n'avez pas l'autorisation de supprimer une Catégorie";
                $this->redirectTo('forum', 'listCategories');
                
                }
                               
                $CategoryManager->delete($id);
                $this->redirectTo('forum', "listCategories", $category);
            }

            // public function banUser($id){
            //     $UserManager = new UserManager();
            //     $user = $UserManager->findOneById($id);
            //     $pseudo = $user->getPseudo();
            //     $user = $_SESSION['user']->getPseudo();
            //     var_dump($pseudo);
            //     if( $_SESSION['user']->getRole() == 'admin'){
                    
            //         $UserManager->ban($id);
            //         var_dump($id);
            //     }
            
            //     else { $_SESSION["error"] = "Vous n'étes pas autorisé";

            //     }

            //     $this->redirectTo('forum', "listCategories", $user);
            // }
    }
        
                
           

                
           
                         
          
                                                  
                
    
    
    
    
   





    


   

        





        


    










    