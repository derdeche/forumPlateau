<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

    public function topicByCategory($id)
    {

        $sql = "SELECT id_topic, topicName, topicDate, topic.user_id, 
                            COUNT(post.topic_id) as nbPosts
                    FROM " . $this->tableName . " topic
                    INNER JOIN post ON post.topic_id = topic.id_" . $this->tableName . "
                    WHERE topic.category_id = :id
                    GROUP BY topic.id_" . $this->tableName . "
                    ORDER BY topic.topicDate DESC";


        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function suppTopic($id)
    {
        $sql = "DELETE FROM ".$this->tableName."
            WHERE id_".$this->tableName."=:id";

        DAO::delete($sql, ['id' => $id]);
    }


    }