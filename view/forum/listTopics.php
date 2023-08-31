<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTopicName()?> <?=$topic->getTopicDate()?> <?=$topic->getid()?></p>
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