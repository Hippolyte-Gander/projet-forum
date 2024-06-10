<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];
    $posts = $result["data"]['posts'];
    $user = App\Session::getUser();
    // var_dump($category->getName()); die;
    ?>

<h1>List of topics in <?= $category->getName() ?></h1>

<?php
if($topics) {
    foreach($topics as $topic ){
        $owner = $topic->getUser();
        $status = $topic->getClosed();
        $idTopic= $topic->getId();
        $formatedDate = $topic->getFormatedDate();?>
        <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?> <?=  "posted on " . $formatedDate ?></p>
        <?php
        if ($owner == $user) {
                if(!$topic->getClosed()) {
                    echo "<a href='index.php?ctrl=forum&action=closeTopicInList&id=$idTopic'>Close Topic</a>";
                } else {
                    echo "<a href='index.php?ctrl=forum&action=openTopicInList&id=$idTopic'>Open Topic</a>";
                }
        }
    }
} else {
    echo "<p>Aucun topic pour le moment!</p>";
}
$user = App\Session::getUser();
if($user) {
    echo '<form action="index.php?ctrl=forum&action=addTopic&id='.$topic->getId().'" method="POST">
        <label for="">New Topic</label>
        <input type="text" name="title" id=""></input>
        <textarea name="content" id=""></textarea>
        <input type="submit" value="Poster">
    </form>';
} else {
    echo '<p>Please log in to creat a topic. </p>';
}