<?php

$posts = $result["data"]['posts'];
// $topics = $result["data"]['topics'];
$topicId = $_GET['id'];

// $categoryId = $_GET['id'];
    
?>

<h1>Tous les Posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getText()?> <?=$post->getDatePost()?> </p>
    <?php
}
