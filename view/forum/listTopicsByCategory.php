<?php

$topics = $result["data"]['topics'];
$categories = $result["data"]["categories"];
$categoryId = $_GET['id'];
    
?>

<h1>liste sujets</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=ListPostsByTopic&id=<?= $topic->getId() ?>"><?=$topic->getTopicName()?></a></p>
    <a><?=$topic->getTopicDate()?></a> 
    
    <?php } ?>

<p>Ajouter un Sujet</p>

<form action="index.php?ctrl=forum&action=addTopic" method = POST>
   <label ></label>
   <input type="text" name="category" >
   <button type ="submit">Ajouter</button>

</form>