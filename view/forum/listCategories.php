<?php
    $categories = $result["data"]['categories']; 
?>

<h1>List of categories</h1>

<?php
foreach($categories as $category ){ ?>
    <h4></h4>
    <p><a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?> </a></p>
<?php }