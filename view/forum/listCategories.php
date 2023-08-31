<?php
$categories=$result["data"]["categories"];
?>
<h1>Catégories</h1>
<?php

foreach($categories as $categorie)
{?>
   <p> <?= $categorie->getNameCategorie() ?></p>;
<?php}?>