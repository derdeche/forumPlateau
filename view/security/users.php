<?php
$users = $result["data"]["users"];

foreach ($users as $user) { ?>
    <p><?= $user->getPseudo() ?></p>
    <p><?= $user->getEmail() ?></p>
    <p><?= $user->getRole() ?></p>
    <p><?= $user->getRegistrationDate() ?></p>
<?php } ?>


