<?php include("includes/header.php"); ?>

<?php

require_once("admin/includes/init.php");

if(empty($_GET['id'])) {

    redirect('index.php');
}

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {

    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id, $author, $body);

    if($new_comment && $new_comment->save()) {

        redirect('photo.php?id=' . $photo->id);

    } else {

        $message = "There were some problems in saving the comment";
    }

} else {

    $author = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);

?>


<div class="row">

    <div class="col-lg-12">

        <!-- Title -->
        <h1><?php echo $photo->title ?></h1>

        <!-- Author -->
        <p class="lead">
            by Flladita Hazizaj
        </p>

        <hr>
        <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on </p>
        <hr>
        <!-- Preview Image -->
        <img  class="img-responsive" src="admin/<?php echo $photo->picture_path();?>" alt="">

        <hr>
        <!-- Post Content -->
            <p class="lead"> <?php echo $photo->description ?>
        <hr>

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <label for="author">Comment:</label>
                    <textarea name="body" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <?php if (!$comments == 0) {

            echo "<h4>Comments:</h4>";
        }?>

        <!-- Comments -->
        <?php foreach ($comments as $comment) : ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="admin-user-thumbnail user-image" src="<?php echo "admin/" .$comment->upload_directory.DS.$comment->image_placeholder;?>" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"> <?php echo $comment->author ?>
                        <small><?php echo $comment->time ?></small>
                    </h4>
                    <?php echo $comment->body ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>







