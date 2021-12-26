<?php include("includes/header.php"); ?>

<?php if (!$session->is_signed_in()) {redirect("login.php");} ?>

<?php $photos = Photo::find_all(); ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <?php include("includes/top_nav.php")?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include("includes/side_nav.php")?>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Photos
                    </h1>
                    <p class="bg-success">
                        <?php echo $message ?>
                    </p>
                    <a href="upload.php" class="btn btn-primary">Add Photo</a>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($photos as $photo) : ?>
                                <tr>
                                    <td><img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path();?>" alt="" </td>
                                    <div class="action_link">
                                        <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                                        <a href="../photo.php?id=<?php echo $photo->id ?>">View</a>
                                    </div>
                                    <td> <?php echo $photo->author?> </td>
                                    <td> <?php echo $photo->title?> </td>
                                    <td> <?php echo $photo->description?> </td>
                                    <td>
                                        <div>
                                        <?php
                                        $comments = Comment::find_the_comments($photo->id);
                                        $comments_number = count($comments);
                                        if($comments_number == 1) {

                                            echo '<a href="comment_photo.php?id=' . $photo->id . '">View ' . count($comments) . ' Comment</a>';

                                        } elseif(!$comments_number == 0) {

                                            echo '<a href="comment_photo.php?id=' . $photo->id . '">View ' . count($comments) . ' Comments</a>';

                                        } else {

                                            echo "No comments <br>for this photo";
                                        }
                                        ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table> <!--End of table-->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>