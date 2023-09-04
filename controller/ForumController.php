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
                "categories" => $categoryManager->findAll(["categoryName"])
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
    
            $postManager = new PostManager();
            $topicManager = new TopicManager();
    
            return [
                "view" => VIEW_DIR . "forum/listPostsByTopic.php",
                "data" => [
                    "posts" => $postManager->postByTopic($id),
                    "topic" => $topicManager->findOneById($id)
                ]
            ];
        }

    // public function addCategory() {
    
    //     $categoryManager = new CategoryManager();
    //     $user = Session::getUser();
   
    //     // Vérifiez si les données requises existent
            
	
	// 	if (isset($_POST["submit"])) {
			
	// 		$category= filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_SPECIAL_CHARS);
    //     }                 
             
                
                       
    //     // Préparez la requête SQL avec un paramètre de liaison
                
    //             $
        
               
    //     $sql = "INSERT INTO " . $this->category . " (categoryName) VALUES (:categoryName)";
        
      
               
    //     try {
    //         // Utilisez la méthode d'insertion du gestionnaire de catégories
    //         $result = $categoryManager->insertCategory($sql, $categoryName);
        
                    
        
                   
    //     // Vérifiez si l'insertion s'est bien déroulée
    //                 if ($result) {
                        
                       
    //     // Redirigez l'utilisateur vers une page de succès ou effectuez une autre action
                        
                       
    //     // Vous pouvez rediriger en utilisant header('Location: ...');
    //                 } else {
    //                     echo "Erreur lors de l'insertion de la catégorie.";
    //                 }
    //             } catch (\PDOException $e) {
    //                 echo $e->getMessage();
    //                 die();
    //             }
    //         } 
    //             }
            
        
                
    //      {
                
               
    //     echo "Données de catégorie manquantes.";
    //         }
        


        





        


    }










