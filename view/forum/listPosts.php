<?php

$posts = $result["data"]['posts'];
    
?>

<h1>Tous les Posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getText()?> <?=$post->getDatePost()?> </p>
    <?php
}
