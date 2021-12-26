<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

if(empty($_GET['id'])) {

    redirect('photos.php');
}

$comment = Comment::find_by_id($_GET['id']);

if($comment) {

    $comment->delete();
    $session->message("The comment from {$comment->author} on {$comment->time}  has been deleted.");
    redirect('comments.php');

} else {

    redirect('comments.php');
}


?>