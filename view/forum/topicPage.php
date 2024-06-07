<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];
    ?>

<h1><?= $topic->getTitle() ?></h1>

<?php
if($posts) {
    foreach($posts as $post ){ 
        $date = new DateTime($post->getPostDate());
        $formattedDate = $date->format('d/m/Y \à H:i');    
        ?>

        <p><a href="#"><?= $post->getUser() ?></a> <?= $formattedDate ?> <br> 
        <?= $post->getContent() ?></p>
    <?php }
} else {
    echo "<p>Aucun post pour le moment!</p>";
} ?>

<form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="POST">
    <textarea name="content" id=""></textarea>
    <input type="submit" value="Poster">
</form>
