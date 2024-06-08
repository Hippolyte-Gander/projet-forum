<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];
    ?>

<h1>Liste des topics</h1>

<?php
foreach($topics as $topic ){ 
    $formatedDate = $topic->getFormatedDate();?>

    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> <?=  "posted on " . $formatedDate ?></p>
<?php }
