<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];
    ?>

<h1><?= $topic->getTitle() ?></h1>
<?php 
$user = App\Session::getUser();
if ($user) {
    $owner = $topic->getUser();
    $id= $topic->getId();
    if ($owner == $user) {
        if(!$topic->getClosed()) {
            echo "<a href='index.php?ctrl=forum&action=closeTopic&id=$id'>Close Topic</a>";
        } else {
            echo "<a href='index.php?ctrl=forum&action=openTopic&id=$id'>Open Topic</a>";
        }
    }
}

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
$status = $topic->getClosed();
if ($user) {
    if (!$status) {
        echo '<form action="index.php?ctrl=forum&action=addPost&id='.$topic->getId().'" method="POST">
            <textarea name="content" id=""></textarea>
            <input type="submit" value="Poster">
        </form>';
    } else {
        echo '<p>This topic is closed. </p>';
    }
} else {
    echo '<p>Please log in to write an answer. </p>';
}