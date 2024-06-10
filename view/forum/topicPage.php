<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];
    ?>

<h1><?= $topic->getTitle() ?></h1>

<?php
if($posts) {
    foreach($posts as $post ){ 
        $formatedDate = $post->getFormatedDate();?>

        <p><a href="#"><?= $post->getUser() ?></a> <?= " posted on ".$formatedDate ?> <br> 
        <?= $post->getContent() ?></p>
    <?php }
} else {
    echo "<p>Aucun post pour le moment!</p>";
}
$user = App\Session::getUser();
if ($user) {
    echo '<form action="index.php?ctrl=forum&action=addPost&id='.$topic->getId().'" method="POST">
        <textarea name="content" id=""></textarea>
        <input type="submit" value="Poster">
    </form>';
} else {
    echo '<p>Please log in to write an answer. </p>';
}