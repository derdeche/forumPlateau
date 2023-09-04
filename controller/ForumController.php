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

 
        
    public function addCategory($id){
        $categoryManager = new CategoryManager();
                            
    
            if (isset($_POST['submit'])) {
    
                $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                             
            if ($categoryName ) {
    
                $newCategory = $categoryManager->add(["categoryName" => $categoryName]);
                 
                 $this->redirectTo('forum', 'listCategories', $newCategory);
            }
        }
        
    }

        





        


    }










