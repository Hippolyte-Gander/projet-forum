<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];
    $posts = $result["data"]['posts'];
    ?>

<h1>List of topics in <?= $category->getName() ?></h1>

<?php
if($topics) {
    foreach($topics as $topic ){ 
        $formatedDate = $topic->getFormatedDate();?>
            <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> <?=  "posted on " . $formatedDate ?></p>
        <?php }
} else {
    echo "<p>Aucun topic pour le moment!</p>";
} ?>
<form action="index.php?ctrl=forum&action=addTopic&id=<?= $topic->getId() ?>" method="POST">
    <label for="">New Topic</label>
    <input type="text" name="title" id=""></input>
    <textarea name="content" id=""></textarea>
    <input type="submit" value="Poster">
</form>