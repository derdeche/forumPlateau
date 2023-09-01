<?php
$categories=$result["data"]["categories"];
?>
<h1>Catégories</h1>
<?php

foreach($categories as $categorie)
{?>
   <p> <a href="index.php?ctrl=forum&action=ListTopics&id="><?$this?><?= $categorie->getCategoryName() ?></a></p>

<?php } ?>

<p>Ajouter une Catégorie</p>

<form action="index.php?ctrl=forum&action=addCategory" method = POST>
   <label ></label>
   <input type="text" name="category" >
   <button type ="submit" name="submit">Ajouter</button>

</form>