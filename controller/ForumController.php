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

 
        
    public function addCategory(){
        $categoryManager = new CategoryManager();
                            
    
            if (isset($_POST['submit'])) {
    
                $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                             
            if ($categoryName ) {
    
                $newCategory = $categoryManager->add(["categoryName" => $categoryName]);
                 
                 $this->redirectTo('forum', 'listCategories', $newCategory);
                 
                }
        }
        
    }

    
    public function addTopic($id){
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        // $category = $categoryManager->findOneById($id);
        
                 
        if (isset($_POST['submit'])) {
            
            $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category_id = filter_input(INPUT_POST, "$category->getId()", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            var_dump($topicName);
            
            // $category_id = filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            
            if ($topicName  ) {
                // $category_id = $category->getId();
    
                $newTopic = $topicManager->add(["topicName" => $topicName, "category_id" =>$category_id]);
               
                 
                $this->redirectTo('forum', 'listTopicsByCategory', $newTopic);


                 
                }
        }
        
    }

    // public function deleteTopic($id){
    //     $TopicManager = new TopicManager();
    //     $PostManager = new PostManager();
    //     $listPost = $PostManager->listPosts($id);
        
       
                
    //             if (isset($listPost) && !empty($listPost)) {
                   
    //                 foreach ($listPost as $post) {
    //                     $PostManager->delete($post->getId());
    //                 }
    //                 $TopicManager->delete($id);
    //                 $this->redirectTo('forum', "listCategories");
    //             }
    //         }




        
    }	

    


   

        





        


    










