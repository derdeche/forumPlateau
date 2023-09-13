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

       
        public function ListTopics(){
                  
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                "topics" => $topicManager->findAll(["topicDate", "DESC"])
                ]
            ];
        
        }

        public function ListCategories(){
            $categoryManager = new CategoryManager();
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                "categories" => $categoryManager->findAll(["categoryName", "ASC"])
                ]
            ];
        }

        public function ListPosts(){
                  
            $postManager = new PostManager();
 
             return [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => 
                [
                "posts" => $postManager->findAll(["datePost", "DESC"])
                 ]
             ];
         
         }

        public function listTopicsByCategory($id){
    
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();
    
            return [
                "view" => VIEW_DIR . "forum/listTopicsByCategory.php",
                "data" => [
                    "topics" => $topicManager->topicByCategory($id),
                    "categories" => $categoryManager->findOneById($id)
                ]
            ];
        }

        public function listPostsByTopic($id){

            // Instanciation des gestionnaires de données   
            $postManager = new PostManager();
            $topicManager = new TopicManager();
    
            // Retourne un tableau associatif avec les données pour la vue
            return [
                "view" => VIEW_DIR . "forum/listPostsByTopic.php", // Chemin de la vue à afficher
                "data" => [
                    "posts" => $postManager->postByTopic($id), // Liste des posts liés à un sujet
                    "topics" => $topicManager->findOneById($id) // Détails du sujet spécifié par son ID
                ]
            ];
        }

 
        public function addCategory(){
            // Instanciation du gestionnaire de catégories
            $categoryManager = new CategoryManager();

            // Vérifie si le formulaire a été soumis, si l'utilisateur est connecté et s'il a le rôle d'administrateur
            if (isset($_POST['submit']) && isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'admin'){

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
            if (isset($_SESSION['user']) && isset($_POST['submit'])) {
                
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
            } else {
                // L'utilisateur n'est pas connecté, vous pouvez rediriger vers une page de connexion
                $this->redirectTo('forum', 'login');
            }
        }
            
            
            
        
        
        public function addPost($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            $idTopic = $topicManager->findOneById($id)->getId();
            // var_dump($idUser);die;
            
            
            // $topicManager->findOneById($id);
            if (isset($_SESSION['user']) && isset($_POST['submit'])) {
                
                    $idUser = $_SESSION['user']->getId();
                    $postContent = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                    
                    if ($postContent ) {
                    // var_dump($postManager);
                        $newPost = $postManager->add(["text" => $postContent, "topic_id"=>$idTopic, "user_id" => $idUser]);
                        $this->redirectTo('forum', 'listCategories', $newPost);
                    }
                
            }	
            else { 
                // L'utilisateur n'est pas connecté, vous pouvez rediriger vers une page de connexion
                $this->redirectTo('forum', 'login');
            }
    
        }    
            public function deleteTopic($id){
                $TopicManager = new TopicManager();
                // $CategoryManager = new CategoryManager();
                $topic = $TopicManager->findOneById($id);      
                var_dump($id);
                // $category_id = $CategoryManager->$category->getId();
                
                
                $TopicManager->delete($id);
                $this->redirectTo('forum', "listCategories", $topic);
                // }
            }
            
            public function deletePost($id){
                $PostManager = new PostManager();
                // $TopicManager = new TopicManager();
                $post = $PostManager->findOneById($id);
                // $topic_id = $TopicManager->getId();
                $PostManager->delete($id);
                $this->redirectTo('forum', "listCategories", $post);
            }
            
    
            public function deleteCategory($id){
                $CategoryManager = new CategoryManager();
                // $TopicManager = new TopicManager();
                // $listTopic = $TopicManager->listTopics($id);
                    $category = $CategoryManager->findOneById($id);      
                        
            // if (isset($listTopic) && !empty($listTopic))
            //     {
        
            // foreach ($listTopic as $topic) {
            //     $TopicManager->delete($topic->getId());
            //     }
                $CategoryManager->delete($id);
                $this->redirectTo('forum', "listCategories", $category);
                }
    }
        
                
           


                
           
                         
          
                                                  
                
    
    
    
    
   





    


   

        





        


    










    