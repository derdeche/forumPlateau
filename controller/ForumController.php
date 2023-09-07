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
    
            $postManager = new PostManager();
            $topicManager = new TopicManager();
    
            return [
                "view" => VIEW_DIR . "forum/listPostsByTopic.php",
                "data" => [
                    "posts" => $postManager->postByTopic($id),
                    "topics" => $topicManager->findOneById($id)
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
        $category = $categoryManager->findOneById($id);
         
         
        
                 
        if (isset($_POST['submit'])) {
            
            $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                      
            
            if ($topicName  ) 
            {
                // $category_id = $category->getId();
                
                $newTopic = $topicManager->add(['topicName'=>$topicName ,'category_id'=>$id, 'user_id'=>1]);
                var_dump($topicName);
                            
                $this->redirectTo('forum', 'listCategories', $newTopic);
                    
            }
        }
        
    }

    public function addPost($id){
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        // $topicManager->findOneById($id);
        
        if (isset($_POST['submit'])) 
        {
            
            $postContent = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           
            
            if ($postContent ) {
            // var_dump($postManager);
                $newPost = $postManager->add(["text" => $postContent, "topic_id"=>$id, "user_id" => 1]);
                $this->redirectTo('forum', 'listCategories', $newPost);
            }
       
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
   





    


   

        





        


    










    