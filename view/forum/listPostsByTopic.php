<?php

$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];
$topicId = $_GET['id'];

// $categoryId = $_GET['id'];
    
?>

<h1>Tous les Posts</h1>

<?php
if($posts){
foreach($posts as $post ){ ?>

   
    <p><?=$post->getText()?> <?=$post->getDatePost()?><a><?=$post->getUser()->getPseudo()?></a>
    <form action="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>" method = POST  >
        <button type ="submit" name= "submit">Supprimer</button>
    </form></p>
<?php } ?>
<?php } else { ?>

    <?php $_SESSION["error"] = "Pas de posts dans ce sujet";?>
          
        <?php }  ?>

    
      
       
  
<p>ajouter un post</p>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topics->getId() ?>" method= POST>
    <label >text</label>
    <input type="text" name="text" id="text">
    <button type="submit" name="submit">Ajouter</button>
</form> 




