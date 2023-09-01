<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste sujets</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=ListPosts&id="><?$this?><?=$topic->getTopicName()?></a></p> 
    
    <?php } ?>

<p>Ajouter un Sujet</p>

<form action="index.php?ctrl=forum&action=addTopic" method = POST>
   <label ></label>
   <input type="text" name="category" >
   <button type ="submit">Ajouter</button>

</form>
