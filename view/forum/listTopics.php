<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=ListPosts&id="><?$this?><?=$topic->getTopicName()?></a></p> 
    
    <?php
}


// echo "<table >",

//     "<tr>",
//         "<th colspan ='2' >Foot</th>",
//         "<th >Natation</th>",
//         "<th >tennis</th>",
//         "<th >Musculation</th>",
//            "</tr>",

// "</table>";