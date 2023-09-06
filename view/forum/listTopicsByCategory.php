<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]["categories"];
// $category = $_GET['id'];
    
?>

<h1>liste sujets</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=ListPostsByTopic&id=<?= $topic->getId() ?>"><?=$topic->getTopicName()?></a></p>
    <a><?=$topic->getTopicDate()?></a> 
    
    <?php } ?>

<p>Ajouter un Sujet</p>


<form action="index.php?ctrl=forum&action=addTopic&id=<?= $id ?>" method = "POST"  >
   <label ></label>
   <input type="text" name="topicName" >
   <button type ="submit" name= "submit">Ajouter</button>
</form>

<p>Supprimer un Sujet</p>
<form action="index.php?ctrl=forum&action=deleteTopic&id=<?= $id ?>" method = "POST"  >
  
   <button type ="delete" name= "delete">Supprimer</button>
</form>


