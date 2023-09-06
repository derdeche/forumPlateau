<?php

$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
// $topicId = $_GET['id'];

// $categoryId = $_GET['id'];
    
?>

<h1>Tous les Posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getText()?> <?=$post->getDatePost()?> </p>
    <?php
}?>

<p>ajouter un post</p>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $id ?>" method= POST>
    <label >text</label>
    <input type="text" name="text" id="text">
    <button type="submit" name="submit">Ajouter</button>
</form>

<p>Supprimer un post</p>

<form action="index.php?ctrl=forum&action=deletePost&id=<?= $id ?>" method = "POST"  >
  
   <button type ="delete" name= "delete">Supprimer</button>
</form>


